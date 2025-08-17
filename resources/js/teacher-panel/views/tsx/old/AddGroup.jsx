import React from "react";
import axios from '../../../../axiosConfig';

import "../scss/AddGroup.scss";
import {useMutation, useQuery, useQueryClient} from "react-query";
import {useFormik} from "formik";
import * as yup from "yup";
import {toast} from "react-toastify";
import Error from "../../../../Error";

export default function GroupList() {
    // Access the client
    const queryClient = useQueryClient();

    const tourRecords = useQuery('Tour', async () =>
    {
        const {data} = await axios.get('/tours');
        console.log(data.data);
        tourRecords.data = data.data;
        return tourRecords;
    });
    let initialValue = {
        title: "",
        location: "",
        sDate: "",
        eDate: "",
        price: "",
        type: "",
        capacity: "",
        transportation: "",
        breakfast: "",
        lunch: "",
        dinner: "",
        description: ""
    };

    const formik = useFormik({
        initialValues: initialValue,
        validationSchema: yup.object().shape({
            title: yup.string().required("Please Enter your Group Title").min(3).max(150),
            location: yup.string().required("Please Enter your Location").min(3).max(150),
            sDate: yup.string().required("Please Enter your Start Date").min(3).max(150),
            eDate: yup.string().required("Please Enter your End Date").min(3).max(150),
            price: yup.number().required("Please Enter your Tour Price").min(1).max(1000000000),
            type: yup.string().required("Please Enter your Tour Type").min(1).max(2),
            capacity: yup.string().required("Please Enter your Tour Capacity").min(1).max(3).matches(
                /^[1-9][0-9]?$|^100$/,
                "Must contain a number between 1 and 100"
            ),
            transportation: yup.string().required("Please Enter your Tour Transportation").min(3).max(150),
            breakfast: yup.string().required("Please Enter your Tour Breakfast").min(3).max(150),
            lunch: yup.string().required("Please Enter your Tour Lunch").min(3).max(150),
            dinner: yup.string().required("Please Enter your Tour Dinner").min(3).max(150),
            description: yup.string().required("Please Enter your Description").min(20).max(500)
        }),
        onSubmit: values => {
            postGroupList.mutate({
                id: formik.values.id,
                title: formik.values.title,
                location: formik.values.location,
                sDate: formik.values.sDate,
                eDate: formik.values.eDate,
                price: formik.values.price,
                capacity: formik.values.capacity,
                transportation: formik.values.transportation,
                breakfast: formik.values.breakfast,
                lunch: formik.values.lunch,
                dinner: formik.values.dinner,
                type: formik.values.type,
                description: formik.values.description
            });
        }
    });

    // Create a new record
    const postGroupList = useMutation(async (data) => {
        toastId.current = toast.loading("Posting...", {
            closeButton: true, theme: "colored", type: toast.TYPE.INFO
        });
        const response = await axios.post('http://landatrip.test/api/account/contact-info/detail', data);
        return response.data;
    }, {
        onSuccess: data => {
            toast.update(toastId.current, {
                render: "It has saved",
                theme: "colored",
                type: toast.TYPE.SUCCESS,
                autoClose: 6000,
                closeButton: true,
                isLoading: false,
                draggable: true,
                draggablePercent: 60
            });
            formik.resetForm();
        }, onError: () => {
            toast.update(toastId.current, {
                render: "It has a problem on editing",
                theme: "colored",
                type: toast.TYPE.ERROR,
                autoClose: 6000,
                closeButton: true,
                isLoading: false,
                draggable: true,
                draggablePercent: 60
            });
        }, onSettled: () => {
        }
    });

    const toastId = React.useRef(null);

    if (tourRecords.isLoading)
    {
        return <h2>Loading...</h2>;
    }

    // Show Error message in query of all record on mounting
    if (tourRecords.isError)
    {
        return <Error message={tourRecords.error.message} />;
    }

    return (<>
        <div className="bg-white w-100 h-auto p-3 rounded-4">
            <div className="row d-flex flex-row justify-content-around">
                <div className="row">
                    <h4>
                        <b>Add New Group</b>
                    </h4>
                    <hr/>
                    <form onSubmit={formik.handleSubmit}>
                        <div className="row">
                            <div className="w-100 mb-7">
                                <label className="mb-2 w-100">
                                    <b>Group Title<span className="text-orange ms-1">*</span></b>
                                    <input id="title" className="form-control mt-2 p-2" type="text" name="title" placeholder="Enter your tour name" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                </label>
                                {formik.touched.title && formik.errors.title ? (<div className="alert alert-warning" role="alert">{formik.errors.title}</div>
                                ) : null}
                            </div>
                            <div className="w-100 mb-7">
                                <label className="mb-2 w-100">
                                    <b>Tours<span className="text-orange ms-1">*</span></b>
                                    <select className="form-select mt-2 form-control p-2">
                                        { tourRecords.data.data.map((value, key)=> (
                                            <option value={value.id}>{value.title}</option>
                                        ))}
                                    </select>                                </label>
                                {formik.touched.location && formik.errors.location ? (<div className="alert alert-warning" role="alert">{formik.errors.location}</div>
                                ) : null}
                            </div>
                            <div className="col-24 col-md-12 mb-7">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>Start Date<span className="text-orange ms-1">*</span></b><input id="sDate" className="form-control mt-2" type="date" name="sDate" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 col-md-12 mb-7">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>End Date<span className="text-orange ms-1">*</span></b>
                                        <input id="eDate" className="form-control mt-2" type="date" name="eDate" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                    </label>
                                    {formik.touched.eDate && formik.errors.eDate ? (<div className="alert alert-warning" role="alert">{formik.errors.eDate}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 col-md-12 mb-7">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>Price<span className="text-orange ms-1">*</span></b>
                                        <input id="price" className="form-control mt-2" type="text" name="price" placeholder="$500" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                    </label>
                                    {formik.touched.price && formik.errors.price ? (<div className="alert alert-warning" role="alert">{formik.errors.price}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="form-group col-24 col-md-12 mb-7">
                                <label className="mb-2">
                                    <b>Tour Type<span>*</span></b>
                                </label>
                                <div className="radio-main d-flex mb-2 form-control">
                                    <div className="form-check me-7">
                                        <label className="form-check-label">
                                            Private
                                            <input type="radio" value="1" name="type" className="form-check-input" checked={String(formik.values.type) === "1"} onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                        </label>
                                    </div>
                                    <div className="form-check me-7">
                                        <label className="form-check-label">
                                            Public
                                            <input type="radio" value="2" name="type" className="form-check-input" checked={String(formik.values.type) === "2"} onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                        </label>
                                    </div>
                                    {formik.touched.type && formik.errors.type ? (<div className="alert alert-warning" role="alert">{formik.errors.type}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 col-md-12 mb-7">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>Tour capacity<span className="text-orange ms-1">*</span></b>
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="capacity" className="form-control bg-transparent w-100 p-2 border-0" type="number" name="capacity" placeholder=" 15" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <i className="fa-solid fa-user-plus text-secondary opacity-95 fs-4 me-3 mt-3 ms-2"></i>
                                        </div>
                                    </label>
                                    {formik.touched.capacity && formik.errors.capacity ? (<div className="alert alert-warning" role="alert">{formik.errors.capacity}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 col-md-12 mb-7">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>Transportation<span className="text-orange ms-1">*</span></b>
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" placeholder=" Airplane" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <i className="fa-solid fa-plane-departure text-secondary opacity-95 fs-4 me-3 mt-3 ms-2"></i>
                                        </div>
                                    </label>
                                    {formik.touched.transportation && formik.errors.transportation ? (<div className="alert alert-warning" role="alert">{formik.errors.transportation}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 col-md-8 mb-4">
                                <label className="mb-2 w-100">
                                    <b>Breakfast<span className="text-orange ms-1">*</span></b>
                                    <input id="breakfast" className="form-control mt-2 p-2" type="text" name="breakfast" placeholder="Enter breakfast" onChange={ formik.handleChange } onBlur={ formik.handleBlur } />
                                </label>
                                { formik.touched.breakfast && formik.errors.breakfast ? (
                                    <div className="alert alert-warning" role="alert">{ formik.errors.breakfast }</div>
                                ) : null }
                            </div>
                            <div className="col-24 col-md-8 mb-4">
                                <label className="mb-2 w-100">
                                    <b>Lunch<span className="text-orange ms-1">*</span></b>
                                    <input id="lunch" className="form-control mt-2 p-2" type="text" name="lunch" placeholder="Enter lunch" onChange={ formik.handleChange } onBlur={ formik.handleBlur } />
                                </label>
                                { formik.touched.lunch && formik.errors.lunch ? (
                                    <div className="alert alert-warning" role="alert">{ formik.errors.lunch }</div>
                                ) : null }
                            </div>
                            <div className="col-24 col-md-8 mb-4">
                                <label className="mb-2 w-100">
                                    <b>Dinner<span className="text-orange ms-1">*</span></b>
                                    <input id="dinner" className="form-control mt-2 p-2" type="text" name="dinner" placeholder="Enter dinner" onChange={ formik.handleChange } onBlur={ formik.handleBlur } />
                                </label>
                                { formik.touched.dinner && formik.errors.dinner ? (
                                    <div className="alert alert-warning" role="alert">{ formik.errors.dinner }</div>
                                ) : null }
                            </div>
                            <div className="form-group mt-1 mb-3">
                                <label className="w-100 fw-bold w-100">Description<span className="text-orange ms-1">*</span>
                                    <textarea className="form-control mt-2" name="description" placeholder="Please write a short description" rows="10" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                </label>
                                {formik.touched.description && formik.errors.description ? (<div className="alert alert-warning" role="alert">{formik.errors.description}</div>
                                ) : null}
                            </div>
                        </div>
                        {/*submit*/}
                        <div className="d-flex flex-row justify-content-end">
                            <input type="submit" value={formik.isValid ? "Submit" : "Fill information"} className="btn btn-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24" disabled={!(formik.isValid && formik.dirty)}/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </>);
};
