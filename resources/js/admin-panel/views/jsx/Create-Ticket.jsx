import React, {useEffect, useRef, useState} from "react";
import {useMutation, useQuery, useQueryClient} from "react-query";
import axios from '../../../axiosConfig';
import {route} from "../../helpers";
import {useFormik} from "formik";
import * as yup from "yup";
import {toast} from "react-toastify";
import {useTranslation} from "react-i18next";
import Select,{components } from 'react-select';

const { SingleValue, Option } = components;

const Control = ({ children, ...props }) => {
    const style = { cursor: 'pointer' };
    return (
        <components.Control {...props} className="border-0 p-0 "  >
            {children}
        </components.Control>
    );
};
const IconSingleValue = (props) => (
    <SingleValue {...props} className="bg-gray rounded-2 border-1 border-dark py-1 px-2 m-1" >
        <img src={`/storage/users/profile/${props.data.profile}`} style={{ height: '30px', width: '30px', borderRadius: '50%', marginRight: '10px' }}/>
        {props.data.short_label}
        <button className="border-0 bg-gray" onClick={props.clearValue}><i className="fa-solid fa-x fa-2xs"></i></button>
    </SingleValue>
);

const IconOption = (props) =>(
    <Option {...props}>
        <img src={`/storage/users/profile/${props.data.profile}`}  style={{ height: '30px', width: '30px', borderRadius: '50%', marginRight: '10px' }}/>
        {props.data.label}
    </Option>
);

export default function CreatTicket() {
    const {t} = useTranslation();
    const [listPost, setListPost] = useState([]);
    const [loading, setLoading] = useState(false);

    let initialValue = {
        title: "", users: "", message: "", priority:""
    };

    const formik = useFormik({
        initialValues: initialValue, validationSchema: yup.object().shape({
            users: yup.array().required("The target user or users are required").max(50),
            // users: yup.array().max(50),
            title: yup.string("Title is required").min(5).max(75),
            priority: yup.string("Title is required").min(0).max(2),
            message: yup.string().required("Message is required").min(10).max(450)
        }), onSubmit: values => {
            createNewTicket.mutate({
                users: formik.values.users,
                title: formik.values.title,
                priority: formik.values.priority,
                message: formik.values.message
            });
        }
    });

    // Searching
    const createNewTicket = useMutation(async (data) => {
        toastId.current = toast.loading("Posting...", {
            closeButton : true, theme : "colored", type : toast.TYPE.INFO
        });
        const response = await axios.post(route('api.web.v1.admin-panel.tickets.store'), data);
        return response.data;
    }, {
        onSuccess: (res) => {
            toast.update(toastId.current, {
                render : "It has saved",
                theme : "colored",
                type : toast.TYPE.SUCCESS,
                autoClose : 6000,
                closeButton : true,
                isLoading : false,
                draggable : true,
                draggablePercent : 60
            });
            setListPost(res.data);
            setLoading(false);
            formik.resetForm();
            console.log(res)
        }, onError: () => {
            toast.update(toastId.current, {
                render : "It has a problem on editing",
                theme : "colored",
                type : toast.TYPE.ERROR,
                autoClose : 6000,
                closeButton : true,
                isLoading : false,
                draggable : true,
                draggablePercent : 60
            });
            console.log("error in searching");
            setLoading(false);
        }, onSettled: () => {
        }
    });

    // Create a new Ticket
    const toastId = useRef(null);

    // Searching
    const searchingKeyword = useMutation(async (data) => {
        const response = await axios.post(route('api.web.v1.admin-panel.ticket.search'), data);
        return response.data;
    }, {
        onSuccess: (res) => {
            setListPost(res.data);
            setLoading(false);
        }, onError: () => {
            console.log("error in searching");
            setLoading(false);
        }, onSettled: () => {
        }
    });
    const handleChange =  (e)=> {
        setLoading(true);
        if (e && e.length > 3) {
            searchingKeyword.mutate({keyword: e});
        }
        setTimeout(function () {
            setLoading(false);
        }, 750)
    }

    const handleSelected =  (e)=> {
        console.log(e)
        let array = e.map((item,key)=>{
            return item.id ? [item.id] : ""
        })
        formik.setFieldValue("users", array);
    }

    const priorityList = [
        {name: "Low", value: 0},
        {name: "Mediate", value: 1},
        {name: "High", value: 2},
    ]

    const priorityChanger = (e) => {
        console.log(e);
        formik.values.priority = e.target.value;
    }
    return (<>
        <div className="bg-white w-100 h-auto p-3 rounded-4">
            <div className="row d-flex flex-row justify-content-around">

                <div className="row">
                    <h5><b>{t("Create a new ticket")}</b></h5>
                    <hr/>
                </div>
                <div className="row mt-7">
                    <form onSubmit={formik.handleSubmit}>
                        <div className="form-control d-flex justify-content-center mb-4 mx-auto p-0 text-secondary">
                            <i className="fa-regular fa-magnifying-glass fs-4 align-self-center mx-auto ms-3"></i>
                            <Select name="users"  options={listPost} isMulti onInputChange={(e) => {handleChange(e)}} onChange={ (e) => {handleSelected(e)}}
                                    className="form-control border-0" isLoading={loading} components={{Control, MultiValue: IconSingleValue, Option: IconOption}}
                                    theme={(theme) => ({
                                        ...theme,
                                        borderRadius: 0,
                                        colors: {
                                            ...theme.colors,
                                            primary25: '#D5D5D5',
                                        },
                                    })}
                            />
                        </div>
                        <div className="row">
                            <div className="col-24 col-md-12 col-xl-12 mb-4">
                                <label className="w-100 mb-2">
                                    <b>{t("Subject")}<span className="text-orange ms-1">*</span></b>
                                    <input name="title" className="form-control w-100 mt-2" type="text"
                                           onChange={formik.handleChange} onBlur={formik.handleBlur}
                                           value={formik.values.title} placeholder={t("Subject")}/>
                                </label>
                                {formik.touched.title && formik.errors.title ? (
                                    <div className="alert alert-warning" role="alert">{formik.errors.title}</div>
                                ) : null}
                            </div>
                            <div className="col-24 col-md-12 col-xl-12 mb-4">
                                <label className="mb-2 w-100"><b>{t("Priority")}<span
                                    className="text-orange ms-1">*</span></b>
                                    <select className="form-control form-select mt-2" id="inputGroupSelect01"
                                            name="priority" onChange={e => {
                                        priorityChanger(e)
                                    }} onBlur={e => {
                                        priorityChanger(e)
                                    }}>
                                        {priorityList.map((value, key) => (
                                            <option key={key} value={value.value}>{t(value.name)}</option>
                                        ))}
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div className="row">
                            <div className="col-24 mb-4">
                                <label className="mb-2 w-100">
                                    <b>{t("Message")}<span className="text-orange ms-1">*</span></b>
                                    <textarea rows="10" className="form-control mt-2" name="message"
                                              placeholder={t("Your message")} onChange={formik.handleChange}
                                              onBlur={formik.handleBlur} value={formik.values.message}></textarea>
                                </label>
                                {formik.touched.message && formik.errors.message ? (
                                    <div className="alert alert-warning" role="alert">{formik.errors.message}</div>
                                ) : null}
                            </div>
                            <div className="d-flex flex-row justify-content-end">
                                {/*<input type="submit" value={formik.isValid ? t("Send") : t("Empty Content")}*/}
                                {/*       className="btn btn-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24"*/}
                                {/*       disabled={!(formik.isValid && formik.dirty)} onClick={()=>{*/}
                                {/*           console.log(listPost)*/}

                                {/*}}/>*/}
                                <input type="submit" value={ formik.isValid ? t("Submit") : t("Fill information") } className="btn btn-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24" disabled={ !(formik.isValid && formik.dirty) }/>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </>);
}
