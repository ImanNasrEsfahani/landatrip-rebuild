import React, {useState} from "react";
import axios from '../../../../axiosConfig';
import "../scss/AddTour.scss";
import {useMutation, useQuery, useQueryClient} from "react-query";
import {useFormik} from "formik";
import * as yup from "yup";
import {toast} from "react-toastify";
import Error from "../../../../Error";


// Import React FilePond
import { FilePond, registerPlugin } from 'react-filepond';

// Import FilePond styles
import 'filepond/dist/filepond.min.css';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import {value} from "lodash/seq";

export default function GroupList() {

    const [ files, setFiles ] = useState([]);

    const queryClient = useQueryClient();

    // const locationRecords = useQuery('Tour', async () =>
    // {
    //     const {data} = await axios.get('/locations');
    //     console.log(data.data);
    //     locationRecords.data = data.data;
    //     return locationRecords;
    // });

    function onUpload(fieldName, file, metadata, load, error, progress, abort, transfer, options)
    {
        // set data
        const formData = new FormData();
        formData.append('file', file, file.name);

        // related to aborting the request
        const CancelToken = axios.CancelToken;
        const source = CancelToken.source();

        // the request itself
        axios({
            method : 'post',
            url : 'http://landatrip.test/api/files/upload/temp-store',
            data : formData,
            cancelToken : source.token,
            onUploadProgress : (e) =>
            {
                progress(e.lengthComputable, e.loaded, e.total);
            }
        }).then(response =>
        {
            load(response.data);
            formik.values.file = response.data;
        }).catch((thrown) =>
        {
            if (axios.isCancel(thrown))
            {
                console.log('Request canceled', thrown.message);
            } else
            {
                // handle error
            }
        });

        // Setup abort interface
        return {
            abort : () =>
            {
                source.cancel('Operation canceled by the user.');
            }
        };

    }

    function onRevert()
    {
        formik.values.file = "";
    }


    function titleChange(e)
    {
        formik.values.title = e.target.value;
    }

    let initialValue = {
        title: "",
        location: "",
        days: "",
        nights: "",
        price: "",
        type: "",
        capacity: "",
        transportation: "",
        breakfast: "",
        lunch: "",
        dinner: "",
        description: "",
        overview :"",
        file : ""
    };

    const formik = useFormik({
        initialValues: initialValue,
        validationSchema: yup.object().shape({
            title: yup.string().required("Please Enter your Tour Title").min(3).max(150),
            skills: yup.string().required("Please Enter your Tour skills").min(3).max(150),
            location: yup.string().required("Please Enter your Location").min(3).max(150),
            price: yup.number().required("Please Enter your Tour Price").min(1).max(1000000000),
            type: yup.string().required("Please Enter your Tour Type").min(1).max(2),
            capacity: yup.string().required("Please Enter your Tour Capacity").min(1).max(3).matches(/^[1-9][0-9]?$|^100$/,"Must contain a number between 1 and 100"),
            days: yup.string().required("Please Enter your Tour Days").min(1).max(3).matches(/^[1-9][0-9]?$|^100$/,"Must contain a number between 1 and 100"),
            nights: yup.string().required("Please Enter your Tour Nights").min(1).max(3).matches(/^[1-9][0-9]?$|^100$/,"Must contain a number between 1 and 100"),
            transportation: yup.string().required("Please Enter your Tour Transfer vehicle").min(3).max(150),
            breakfast: yup.string().required("Please Enter your Tour Breakfast").min(3).max(150),
            lunch: yup.string().required("Please Enter your Tour Lunch").min(3).max(150),
            dinner: yup.string().required("Please Enter your Tour Dinner").min(3).max(150),
            description: yup.string().required("Please Enter your Description").min(20).max(500),
            overview: yup.string().required("Please Enter your Overview").min(20).max(500)
        }),
        onSubmit: values => {
            postGroupList.mutate({
                id: formik.values.id,
                title: formik.values.title,
                location: formik.values.location,
                skills: formik.values.skills,
                days: formik.values.days,
                nights: formik.values.nights,
                price: formik.values.price,
                capacity: formik.values.capacity,
                transportation: formik.values.transportation,
                breakfast: formik.values.breakfast,
                lunch: formik.values.lunch,
                dinner: formik.values.dinner,
                type: formik.values.type,
                description: formik.values.description,
                overview: formik.values.overview,
                file : formik.values.file
            });
        }
    });

    // Create a new record
    // const postGroupList = useMutation(async (data) => {
    //     toastId.current = toast.loading("Posting...", {
    //         closeButton: true, theme: "colored", type: toast.TYPE.INFO
    //     });
    //     const response = await axios.post('http://landatrip.test/api/account/contact-info/detail', data);
    //     return response.data;
    // }, {
    //     onSuccess: data => {
    //         toast.update(toastId.current, {
    //             render: "It has saved",
    //             theme: "colored",
    //             type: toast.TYPE.SUCCESS,
    //             autoClose: 6000,
    //             closeButton: true,
    //             isLoading: false,
    //             draggable: true,
    //             draggablePercent: 60
    //         });
    //         formik.resetForm();
    //     }, onError: () => {
    //         toast.update(toastId.current, {
    //             render: "It has a problem on editing",
    //             theme: "colored",
    //             type: toast.TYPE.ERROR,
    //             autoClose: 6000,
    //             closeButton: true,
    //             isLoading: false,
    //             draggable: true,
    //             draggablePercent: 60
    //         });
    //     }, onSettled: () => {
    //     }
    // });

    const toastId = React.useRef(null);


    // if (locationRecords.isLoading)
    // {
    //     return <h2>Loading...</h2>;
    // }
    //
    // // Show Error message in query of all record on mounting
    // if (locationRecords.isError)
    // {
    //     return <Error message={locationRecords.error.message} />;
    // }

    return (<>
        <div className="bg-white w-100 h-auto p-3 rounded-4">
            <div className="row d-flex flex-row justify-content-around">
                <div className="row">
                    <h4>
                        <b>Add New Tour</b>
                    </h4>
                    <hr/>
                    <form onSubmit={formik.handleSubmit}>
                        <div className="row">
                            <div className="w-100 mb-7">
                                <label className="mb-2 w-100">
                                    <b>Tour Title<span className="text-orange ms-1">*</span></b>
                                    <input id="title" className="form-control mt-2 p-2" type="text" name="title" placeholder="Enter your tour name" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                </label>
                                {formik.touched.title && formik.errors.title ? (<div className="alert alert-warning" role="alert">{formik.errors.title}</div>
                                ) : null}
                            </div>
                            <div className="form-group mt-1 mb-3">
                                <label className="w-100 fw-bold w-100">Tour Description<span className="text-orange ms-1">*</span>
                                    <textarea className="form-control mt-2" name="description" placeholder="Please write a short description" rows="6" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                </label>
                                {formik.touched.description && formik.errors.description ? (<div className="alert alert-warning" role="alert">{formik.errors.description}</div>
                                ) : null}
                            </div>
                            <div className="form-group mt-1 mb-3">
                                <label className="w-100 fw-bold w-100">Overview<span className="text-orange ms-1">*</span>
                                    <textarea className="form-control mt-2" name="overview" placeholder="Please write a short overview" rows="6" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                </label>
                                {formik.touched.overview && formik.errors.overview ? (<div className="alert alert-warning" role="alert">{formik.errors.overview}</div>
                                ) : null}
                            </div>
                            <div className="col-24 col-md-6 mb-7">
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
                            <div className="col-24 col-md-6 mb-7">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>Location<span className="text-orange ms-1">*</span></b>
                                        <select className="form-select mt-2 form-control p-2" >
                                            {/*{ locationRecords.data.data.map((value, key)=> (*/}
                                            {/*    <option value={value.id}>{value.city_name}, {value.country_name}</option>*/}
                                            {/*    ))}*/}
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div className="col-24 col-md-12 mb-7">
                                <label className="mb-2 w-100">
                                    <b>Skills<span className="text-orange ms-1">*</span></b>
                                    <input id="skills" className="form-control mt-2 p-2" type="text" name="skills" placeholder="Enter skills" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                </label>
                                {formik.touched.skills && formik.errors.skills ? (<div className="alert alert-warning" role="alert">{formik.errors.skills}</div>
                                ) : null}
                            </div>
                            <div className="col-24 col-md-6 mb-7">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>Days<span className="text-orange ms-1">*</span></b>
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="days" className="form-control bg-transparent w-100 p-2 border-0" type="number" name="days" placeholder=" 5" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <i className="fa-solid fa-sun-bright text-secondary opacity-95 fs-4 me-3 mt-3 ms-2"></i>
                                        </div>
                                    </label>
                                    {formik.touched.days && formik.errors.days ? (<div className="alert alert-warning" role="alert">{formik.errors.days}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 col-md-6 mb-7">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>Nights<span className="text-orange ms-1">*</span></b>
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="nights" className="form-control bg-transparent w-100 p-2 border-0" type="number" name="nights" placeholder=" 4" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <i className="fa-solid fa-moon text-secondary opacity-95 fs-4 me-3 mt-3 ms-2"></i>
                                        </div>
                                    </label>
                                    {formik.touched.nights && formik.errors.nights ? (<div className="alert alert-warning" role="alert">{formik.errors.nights}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 col-md-12 mb-7">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>Transfer vehicle<span className="text-orange ms-1">*</span></b>
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" placeholder=" Airplane" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <i className="fa-solid fa-plane-departure text-secondary opacity-95 fs-4 me-3 mt-3 ms-2"></i>
                                        </div>
                                    </label>
                                    {formik.touched.transportation && formik.errors.transportation ? (<div className="alert alert-warning" role="alert">{formik.errors.transportation}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 col-md-12 mb-7">
                                <div className="form-group">
                                        <label className="mb-2 w-100">
                                            <b>Include<span className="text-orange ms-1">*</span></b>
                                            <hr className="my-2"/>
                                            <div className="d-flex flex-row p-0 form-control mt-2">
                                                <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" placeholder=" Enter include" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                                <button className="border-0 bg-transparent"><i className="fa-solid fa-plus text-green opacity-95 fs-4 me-2 mt-1"></i></button>
                                            </div>
                                        </label>
                                        {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                        ) : null}
                                </div>
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <button className="border-0 bg-transparent"><i className="fa-solid fa-minus text-danger opacity-95 fs-4 me-2 mt-1"></i></button>
                                        </div>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 col-md-12 mb-7">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>Exclude<span className="text-orange ms-1">*</span></b>
                                        <hr className="my-2"/>
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" placeholder=" Enter exclude" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <button className="border-0 bg-transparent"><i className="fa-solid fa-plus text-green opacity-95 fs-4 me-2 mt-1"></i></button>
                                        </div>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <button className="border-0 bg-transparent"><i className="fa-solid fa-minus text-danger opacity-95 fs-4 me-2 mt-1"></i></button>
                                        </div>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 mb-7">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>Highlights<span className="text-orange ms-1">*</span></b>
                                        <hr className="my-2"/>
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" placeholder=" Enter highlights" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <button className="border-0 bg-transparent"><i className="fa-solid fa-plus text-green opacity-95 fs-4 me-2 mt-1"></i></button>
                                        </div>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <button className="border-0 bg-transparent"><i className="fa-solid fa-minus text-danger opacity-95 fs-4 me-2 mt-1"></i></button>
                                        </div>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 mb-2">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <b>Itinerary Detail<span className="text-orange ms-1">*</span></b>
                                        <hr className="my-2"/>
                                        <div className="row py-4 px-1 mx-0 form-control mt-2">
                                            <div className="col-24 d-flex justify-content-between">
                                                <input id="transportation" className="form-control bg-white shadow w-50 p-2 border-0" type="text" name="transportation" placeholder="Add Itinerary Topic" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                                <button className="border-0 bg-transparent "><i className="fa-solid fa-plus text-green opacity-95 fs-4 me-2 mt-1"></i></button>
                                            </div>
                                            <div className="col-24">
                                                <textarea className="form-control mt-2 bg-white shadow" name="description" placeholder="Add Itinerary Detail " rows="6" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            </div>
                                        </div>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 mb-7">
                                <div className="form-group">
                                    <label className="mb-2 w-100">
                                        <div className="row py-4 px-1 mx-0 form-control mt-2">
                                            <div className="col-24 d-flex justify-content-between">
                                                <input id="transportation" className="form-control bg-white shadow w-50 p-2 border-0" type="text" name="transportation" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                                <button className="border-0 bg-transparent "><i className="fa-solid fa-minus text-danger opacity-95 fs-4 me-2 mt-1"></i></button>
                                            </div>
                                            <div className="col-24">
                                                <textarea className="form-control mt-2 bg-white shadow" name="description" rows="6" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            </div>
                                        </div>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 col-md-12 mb-7 row">
                                <b>Add certificates<span className="text-orange ms-1">*</span></b>
                                <hr className="my-2 w-95 ms-3"/>
                                <div className="form-group col-24 col-md-12">
                                        <div className="d-flex flex-row py-5 px-2 form-control mt-2 w-100">
                                            <input type="hidden" className="form-control w-100 mt-2" name="file"/>
                                            <div className="w-100">
                                            <FilePond files={ files } allowMultiple={ true } maxFiles={ 3 } server={{ fetch : null, process : onUpload, load : null, revert : onRevert, restore : null }} name="files" labelIdle='Drag & Drop your image or <span className="filepond--label-action">Browse</span>'/>
                                            { formik.touched.file && formik.errors.file ? (<div className="alert alert-warning" role="alert">{ formik.errors.file }</div>) : null }
                                            </div>
                                            <button className="border-0 bg-transparent align-self-start"><i className="fa-solid fa-plus text-green opacity-95 fs-4"></i></button>
                                        </div>
                                </div>
                                <div className="form-group col-24 col-md-12">
                                    <label className="mb-2 w-100">
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <button className="border-0 bg-transparent"><i className="fa-solid fa-minus text-danger opacity-95 fs-4 me-2 mt-1"></i></button>
                                        </div>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 col-md-12 mb-7 row">
                                <b>Add tour brochure<span className="text-orange ms-1">*</span></b>
                                <hr className="my-2 w-95 ms-3"/>
                                <div className="form-group col-24 col-md-12">
                                    <div className="d-flex flex-row py-5 px-2 form-control mt-2 w-100">
                                        <input type="hidden" className="form-control w-100 mt-2" name="file"/>
                                        <div className="w-100">
                                            <FilePond files={ files } allowMultiple={ true } maxFiles={ 3 } server={{ fetch : null, process : onUpload, load : null, revert : onRevert, restore : null }} name="files" labelIdle='Drag & Drop your image or <span className="filepond--label-action">Browse</span>'/>
                                            { formik.touched.file && formik.errors.file ? (<div className="alert alert-warning" role="alert">{ formik.errors.file }</div>) : null }
                                        </div>
                                        <button className="border-0 bg-transparent align-self-start"><i className="fa-solid fa-plus text-green opacity-95 fs-4"></i></button>
                                    </div>
                                </div>
                                <div className="form-group col-24 col-md-12">
                                    <label className="mb-2 w-100">
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <button className="border-0 bg-transparent"><i className="fa-solid fa-minus text-danger opacity-95 fs-4 me-2 mt-1"></i></button>
                                        </div>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
                            </div>
                            <div className="col-24 mb-7 row">
                                <b>Add Album Picture<span className="text-orange ms-1">*</span></b>
                                <hr className="my-2 ms-3"/>
                                <div className="form-group col-24 col-md-6">
                                    <div className="d-flex flex-row py-5 px-2 form-control mt-2 w-100">
                                        <input type="hidden" className="form-control w-100 mt-2" name="file"/>
                                        <div className="w-100">
                                            <FilePond files={ files } allowMultiple={ true } maxFiles={ 3 } server={{ fetch : null, process : onUpload, load : null, revert : onRevert, restore : null }} name="files" labelIdle='Drag & Drop your image or <span className="filepond--label-action">Browse</span>'/>
                                            { formik.touched.file && formik.errors.file ? (<div className="alert alert-warning" role="alert">{ formik.errors.file }</div>) : null }
                                        </div>
                                        <button className="border-0 bg-transparent align-self-start"><i className="fa-solid fa-plus text-green opacity-95 fs-4"></i></button>
                                    </div>
                                </div>
                                <div className="form-group col-24 col-md-6">
                                    <label className="mb-2 w-100">
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <button className="border-0 bg-transparent"><i className="fa-solid fa-minus text-danger opacity-95 fs-4 me-2 mt-1"></i></button>
                                        </div>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
                                <div className="form-group col-24 col-md-6">
                                    <label className="mb-2 w-100">
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <button className="border-0 bg-transparent"><i className="fa-solid fa-minus text-danger opacity-95 fs-4 me-2 mt-1"></i></button>
                                        </div>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
                                <div className="form-group col-24 col-md-6">
                                    <label className="mb-2 w-100">
                                        <div className="d-flex flex-row p-0 form-control mt-2">
                                            <input id="transportation" className="form-control bg-transparent w-100 p-2 border-0" type="text" name="transportation" onChange={formik.handleChange} onBlur={formik.handleBlur}/>
                                            <button className="border-0 bg-transparent"><i className="fa-solid fa-minus text-danger opacity-95 fs-4 me-2 mt-1"></i></button>
                                        </div>
                                    </label>
                                    {formik.touched.sDate && formik.errors.sDate ? (<div className="alert alert-warning" role="alert">{formik.errors.sDate}</div>
                                    ) : null}
                                </div>
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
