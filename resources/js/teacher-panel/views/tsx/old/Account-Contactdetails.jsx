import React from "react";
import axios from '../../../../axiosConfig';
import "../scss/Account-Contactdetails.scss";
import { useMutation, useQuery, useQueryClient } from "react-query";
import { useFormik } from "formik";
import * as yup from "yup";
import { toast } from "react-toastify";
import {route} from "../../../helpers";
import {useTranslation} from "react-i18next";
import {SkeletonFramework} from "../../../../SkeletonFramework";
import Error from "../../../../Error";

export default function AccountContactDetails(){

    const { t } = useTranslation();

    // Access the client
    const queryClient = useQueryClient();

    // Queries to get all records
    const contactDetail = useQuery('contactDetail', async () =>
    {
        const {data} = await axios.get(route("api.web.v1.teacher-panel.account-info.details.index"));
        contactDetail.data = data.data;
        await formik.setFieldValue("fname", data.data.fname);
        await formik.setFieldValue("lname", data.data.lname);
        await formik.setFieldValue("title", data.data.title);
        await formik.setFieldValue("slug", data.data.slug);
        await formik.setFieldValue("sex", data.data.sex);
        await formik.setFieldValue("about_me", data.data.about_me);
        return contactDetail;
    });

    let initialValue = {
        fname : "", lname : "", title : "", slug : "", sex : "", about_me : ""
    };

    const formik = useFormik({
        initialValues : initialValue,
        validationSchema : yup.object().shape({
            fname : yup.string().required().min(3).max(150),
            lname : yup.string().required().min(3).max(150),
            title : yup.string().required().min(3).max(150),
            slug : yup.string().required().min(3).max(150),
            sex : yup.number().required().min(1).max(3),
            about_me : yup.string().required().min(3).max(550)
        }),
        onSubmit : values =>
        {
            postContactDetails.mutate({
                id : formik.values.id,
                fname : formik.values.fname,
                lname : formik.values.lname,
                title : formik.values.title,
                slug : formik.values.slug,
                sex : formik.values.sex,
                about_me : formik.values.about_me
            });
        }
    });

    // Create a new record
    const postContactDetails = useMutation(async (data) =>
    {
        toastId.current = toast.loading("Posting...", {
            closeButton : true, theme : "colored", type : toast.TYPE.INFO
        });
        const response = await axios.put(route("api.web.v1.teacher-panel.account-info.details.update"), data);
        return response.data;
    }, {
        onSuccess : data =>
        {
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
            contactDetail.refetch();
            formik.resetForm();
        }, onError : () =>
        {
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
        }, onSettled : () =>
        {
        }
    });

    const toastId = React.useRef(null);


    // Show Error message in query of all record on mounting/
    if (contactDetail.isError)
    {
        return <Error message={contactDetail.error.message} />;
    }

    return (<>
        <div className="bg-white w-100 h-auto p-3 rounded-4">
            <div className="row d-flex flex-row justify-content-around">
                <div className="row">
                    <h4>
                        <b>{t("My Account Info")}</b>
                    </h4>
                    <hr/>
                    <form onSubmit={ formik.handleSubmit }>
                        <div className="row">
                            <div className="col-24 col-md-12 col-lg-8 col-xl-6 mb-4">
                                <label className="mb-2 w-100">
                                    <b>{t("First Name")}<span className="text-orange ms-1">*</span></b>
                                    {
                                        contactDetail.isLoading ? (
                                            <SkeletonFramework height={40} width={150} className={"mt-2 w-100"}/>
                                        ) : (
                                            <input id="fname" className="form-control" type="text" name="fname" placeholder="Enter your first name" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.fname } defaultValue={ contactDetail.data.fname }/>
                                        )
                                    }
                                </label>
                                { formik.touched.fname && formik.errors.fname ? (
                                    <div className="alert alert-warning" role="alert">{ formik.errors.fname }</div>
                                ) : null }
                            </div>
                            <div className="col-24 col-md-12 col-lg-8 col-xl-6 mb-4">
                                <label className="mb-2 w-100">
                                    <b>{t("Last Name")}<span className="text-orange ms-1">*</span></b>
                                    {
                                        contactDetail.isLoading ? (
                                            <SkeletonFramework height={40} width={150} className={"mt-2 w-100"}/>
                                        ) : (
                                            <input id="lname" className="form-control" type="text" name="lname" placeholder="Enter your last name" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.lname }/>
                                        )
                                    }
                                </label>
                                { formik.touched.lname && formik.errors.lname ? (
                                    <div className="alert alert-warning" role="alert">{ formik.errors.lname }</div>
                                ) : null }
                            </div>
                            <div className="col-24 col-md-12 col-lg-8 col-xl-6 mb-4">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>{t("Job Title")}<span className="text-orange ms-1">*</span></b>
                                        {
                                            contactDetail.isLoading ? (
                                                <SkeletonFramework height={40} width={150} className={"mt-2 w-100"}/>
                                            ) : (
                                                <input id="title" className="form-control" type="text" name="title" placeholder="Enter your position or title" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.title }/>
                                            )
                                        }
                                    </label>
                                    { formik.touched.title && formik.errors.title ? (
                                        <div className="alert alert-warning" role="alert">{ formik.errors.title }</div>
                                    ) : null }
                                </div>
                            </div>
                            <div className="col-24 col-md-12 col-lg-8 col-xl-6 mb-4">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>{t("Profile Slug")}<span className="text-orange ms-1">*</span></b>
                                        {
                                            contactDetail.isLoading ? (
                                                <SkeletonFramework height={40} width={150} className={"mt-2 w-100"}/>
                                            ) : (
                                                <input id="slug" className="form-control" type="text" name="slug" placeholder="Your profile add: e.g. https://landatrip.com/your-name" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.slug }/>
                                            )
                                        }
                                    </label>
                                    { formik.touched.slug && formik.errors.slug ? (
                                        <div className="alert alert-warning" role="alert">{ formik.errors.slug }</div>
                                    ) : null }
                                </div>
                            </div>
                        </div>
                        <div className="form-group ">
                            <label className="mb-2 mt-3">
                                <b>{t("Gender")}<span>*</span></b>
                            </label>
                        </div>
                        <div className="radio-main d-md-flex d-sm-block  mb-2">
                            {
                                contactDetail.isLoading ? (
                                    <div className="form-check me-4">
                                        <label className=" d-flex form-check-label">
                                            <SkeletonFramework height={20} width={20} borderRadius={50} className={"me-1"}/>
                                            <SkeletonFramework height={20} width={50}/>
                                        </label>
                                    </div>
                                ) : (
                                    <div className="form-check me-4">
                                        <label className="form-check-label">
                                            {t("Male")}
                                            <input type="radio" value="1" name="sex" className="form-check-input" checked={ String(
                                                formik.values.sex) === "1" } onChange={ formik.handleChange } onBlur={ formik.handleBlur }/>
                                        </label>
                                    </div>
                                )
                            }
                            {
                                contactDetail.isLoading ? (
                                    <div className="form-check me-4">
                                        <label className=" d-flex form-check-label">
                                            <SkeletonFramework height={20} width={20} borderRadius={50} className={"me-1"}/>
                                            <SkeletonFramework height={20} width={50}/>
                                        </label>
                                    </div>
                                ) : (
                                    <div className="form-check me-4">
                                        <label className="form-check-label">
                                            {t("Female")}
                                            <input type="radio" value="2" name="sex" className="form-check-input" checked={ String(
                                                formik.values.sex) === "2" } onChange={ formik.handleChange } onBlur={ formik.handleBlur }/>
                                        </label>
                                    </div>
                                )
                            }
                            {
                                contactDetail.isLoading ? (
                                    <div className="form-check me-4">
                                        <label className=" d-flex form-check-label">
                                            <SkeletonFramework height={20} width={20} borderRadius={50} className={"me-1"}/>
                                            <SkeletonFramework height={20} width={200}/>
                                        </label>
                                    </div>
                                ) : (
                                    <div className="form-check">
                                        <label className="form-check-label">
                                            {t("Prefer not to say my gender")}
                                            <input type="radio" value="3" name="sex" className="form-check-input" checked={ String(
                                                formik.values.sex) === "3" } onChange={ formik.handleChange } onBlur={ formik.handleBlur }/>
                                        </label>
                                    </div>
                                )
                            }
                            { formik.touched.sex && formik.errors.sex ? (
                                <div className="alert alert-warning" role="alert">{ formik.errors.sex }</div>
                            ) : null }
                        </div>
                        <hr/>
                        <div className="form-group mt-1 mb-3">
                            <label className="w-100 fw-bold w-100">{t("About me")}<span className="text-orange ms-1">*</span>
                                {
                                    contactDetail.isLoading ? (
                                        <SkeletonFramework height={250} />
                                    ) : (
                                        <textarea className="form-control mt-2" name="about_me" placeholder="Please write a short description about your hobby, interested and yourself" rows="10" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.about_me }/>
                                    )
                                }

                            </label>
                            { formik.touched.about_me && formik.errors.about_me ? (
                                <div className="alert alert-warning" role="alert">{ formik.errors.about_me }</div>
                            ) : null }
                        </div>
                        <div className="d-flex flex-row justify-content-end">
                            {
                                contactDetail.isLoading ? (
                                    <SkeletonFramework className={"rounded-pill bg-orange"} height={35} width={250}/>
                                ) : (
                                    <input type="submit" value={ formik.isValid ? "Submit" : "Fill information" } className="btn btn-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24" disabled={ !(formik.isValid && formik.dirty) }/>

                                )
                            }
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </>);
    // }
};
