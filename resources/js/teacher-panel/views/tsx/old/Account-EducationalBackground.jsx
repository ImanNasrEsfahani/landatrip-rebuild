import React, {useRef} from "react";
import "../scss/Account-EducationalBackground.scss";
import axios from '../../../../axiosConfig';
import {toast} from 'react-toastify';
import * as yup from 'yup';
import {useMutation, useQuery, useQueryClient} from 'react-query';
import {useFormik} from "formik";
import {route} from "../../../helpers";
import {useTranslation} from "react-i18next";
import {SkeletonFramework, SkeletonTableAccountEducationalBackground} from "../../../../SkeletonFramework";
import Error from "../../../../Error";

export default function AccountEducationalBackground() {
    const queryClient = useQueryClient();

    const {t} = useTranslation();

    const educationalRecords = useQuery('Educational', async () => {
        const {data} = await axios.get(route('api.web.v1.teacher-panel.account-info.educational-background.index'));
        educationalRecords.data = data.data;
        return educationalRecords;
    });


    let initialValue = {
        id: "", title: "", university: "", level: "", from: "", to: ""
    };

    const formik = useFormik({
        initialValues: initialValue, validationSchema: yup.object().shape({
            title: yup.string().required().min(3).max(150),
            university: yup.string().required("University name is a required field").min(3).max(150),
            level: yup.string().required("Degree is a required field").min(3).max(150),
            from: yup.number().required("Start Year is a required field").min(1900).max(2023),
            to: yup.number().max(2023).nullable(true).min(yup.ref('from'), "end date can't be before start date")
        }), onSubmit: values => {
            if (formik.values.id) {
                postEducationalRecords.mutate({
                    id: formik.values.id,
                    title: formik.values.title,
                    university: formik.values.university,
                    level: formik.values.level,
                    from: formik.values.from,
                    to: formik.values.to
                });
            } else {
                postEducationalRecords.mutate({
                    id: formik.values.id,
                    title: formik.values.title,
                    university: formik.values.university,
                    level: formik.values.level,
                    from: formik.values.from,
                    to: formik.values.to
                });
            }
        }
    });

    const postEducationalRecords = useMutation(async (data) => {
        toastId.current = toast.loading("Posting...", {
            closeButton: true, theme: "colored", type: toast.TYPE.INFO
        });

        if (data.id) {
            return await axios.put(route("api.web.v1.teacher-panel.account-info.educational-background.update", {"educational_background": data.id}), data).data;
        }
        return await axios.post(route("api.web.v1.teacher-panel.account-info.educational-background.store"), data).data;
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
            window.setTimeout(() => {
                educationalRecords.refetch()
            }, 1200);
            formik.resetForm();
        }, onError: () => {
            console.log(error);
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
        }, onSettle: () => {
        }
    });


    function editEducationalRecords(id) {
        let row = educationalRecords.data.data.find(row => row.id === id);
        formik.setValues({
            id: row.id,
            title: row.title,
            university: row.university,
            level: row.level,
            from: row.from,
            to: row.to ? row.to : ""
        });
    }

    const toastId = useRef(null);
    const deleteEducationalRecords = useMutation((id) => {
        toastId.current = toast.loading("Deleting...", {
            // autoClose: 5000,
            // progress: 100,
            closeButton: true,
            theme: "colored",
            type: toast.TYPE.WARNING
        });
        return axios.delete(route("api.web.v1.teacher-panel.account-info.educational-background.destroy", {"educational_background": id}));
    }, {
        onSuccess: data => {
            toast.update(toastId.current, {
                render: "It has been deleted",
                theme: "colored",
                type: toast.TYPE.SUCCESS,
                autoClose: 6000,
                closeButton: true,
                isLoading: false,
                draggable: true,
                draggablePercent: 60
            });
            window.setTimeout(() => {
                educationalRecords.refetch()
            }, 1200);
            formik.resetForm();
        }, onError: () => {
            toast.update(toastId.current, {
                render: "It has a problem on deleting",
                theme: "colored",
                type: toast.TYPE.ERROR,
                autoClose: 6000,
                closeButton: true,
                isLoading: false,
                draggable: true,
                draggablePercent: 60
            });
        }, onSettle: () => {
        }
    });

    const renderStatus = (param) => {
        console.log("status " + param);
        switch (param) {
            case 'Student':
                return <span className="badge bg-orange rounded-pill w-100 py-2 fw-normal">Student</span>;
                break;
            case 'Canceled':
                return <span className="badge bg-danger rounded-pill w-100 py-2 fw-normal">Canceled</span>;
                break;
            default:
                return <span className="badge bg-green rounded-pill w-100 py-2 fw-normal">Completed</span>;
        }
    };

    // Show Error message in query of all record on mounting
    if (educationalRecords.isError) {
        return <Error message={educationalRecords.error.message} />;
    }

    return (

        <>
            <div className="bg-white w-100 h-auto p-5 rounded-4">
                <div className="row d-flex flex-row justify-content-around">
                    <div className="row">
                        <h5>
                            <b>Educational Background</b>
                        </h5>
                        <hr/>
                        <div className="overflow-auto">
                            <table className="table table-striped table-hover text-center">
                                <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>University/college</th>
                                    <th>Degree</th>
                                    <th>Start Year</th>
                                    <th>End Year</th>
                                    <th>STATUS</th>
                                    <th>Edit/Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                {
                                    educationalRecords.isLoading ? (
                                        <SkeletonTableAccountEducationalBackground/>
                                    ) : (
                                        (educationalRecords.data.data.length > 0 ?
                                                educationalRecords.data.data.map((value, key) => (
                                                    <tr key={key}>
                                                        <td className="align-middle">{value.title}</td>
                                                        <td className="align-middle">{value.university}</td>
                                                        <td className="align-middle">{value.level}</td>
                                                        <td className="align-middle">{value.from}</td>
                                                        <td className="align-middle">{value.to ? value.to : 'Until Now'}</td>
                                                        <td className="align-middle">{renderStatus(value.status)}</td>
                                                        <td className="align-middle">
                                                            <button className="border-0 bg-transparent"
                                                                    onClick={() => editEducationalRecords(
                                                                        value.id)}><i
                                                                className="fs-3 text-orange fa-solid fa-pen-to-square"></i>
                                                            </button>
                                                            <button className="border-0 bg-transparent"
                                                                    onClick={() => deleteEducationalRecords.mutate(
                                                                        value.id)}><i
                                                                className="fs-3 ms-3 text-danger fa-solid fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                )) :
                                                <tr>
                                                    <td colSpan="7" className="text-danger">{t("No Data")}</td>
                                                </tr>
                                        ))
                                }
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div className="mt-5">
                        {formik.values.id ? <div className="w-95 mx-auto d-flex flex-row justify-content-between mb-0">
                                <h5 className="align-self-center mb-0">Edit record</h5>
                                <button className="btn bg-transparent border-0" onClick={e => {
                                    formik.resetForm();
                                }}><i className="text-danger fs-5 fa-solid fa-xmark"></i></button>
                            </div> :
                            <h5 className="w-95 mx-auto d-flex flex-row justify-content-between mb-0">Insert New</h5>}
                        <hr className="mt-2"/>
                        <form className="m-0 p-0 w-100" onSubmit={formik.handleSubmit}>
                            <input type="hidden" name="id" onChange={formik.handleChange} onBlur={formik.handleBlur}
                                   value={formik.values.id}/>
                            <div className="row m-0 p-0 w-95 mx-auto">
                                <div className="col-24 col-md-12 col-lg-8 col-xxl-6 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("Field")}<span className="text-orange ms-1">*</span></b>
                                        <input className="form-control w-100 mt-2" type="text" name="title"
                                               onChange={formik.handleChange} onBlur={formik.handleBlur}
                                               value={formik.values.title} placeholder={t("Enter your Field")}/>
                                    </label>
                                    {formik.touched.title && formik.errors.title ? (
                                        <div className="alert alert-warning" role="alert">{formik.errors.title}</div>
                                    ) : null}
                                </div>
                                <div className="col-24 col-md-12 col-lg-8 col-xxl-6 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("University")}<span className="text-orange ms-1">*</span></b>
                                        <input className="form-control w-100 mt-2" type="text" name="university"
                                               onChange={formik.handleChange} onBlur={formik.handleBlur}
                                               value={formik.values.university} placeholder={t("University")}/>
                                    </label>
                                    {formik.touched.university && formik.errors.university ? (
                                        <div className="alert alert-warning"
                                             role="alert">{formik.errors.university}</div>
                                    ) : null}
                                </div>
                                <div className="col-24 col-md-12 col-lg-8 col-xxl-6 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("Degree")}<span className="text-orange ms-1">*</span></b>
                                        <input className="form-control w-100 mt-2" type="text" name="level"
                                               onChange={formik.handleChange} onBlur={formik.handleBlur}
                                               value={formik.values.level} placeholder={t("Select your degree")}/>
                                    </label>
                                    {formik.touched.level && formik.errors.level ? (
                                        <div className="alert alert-warning" role="alert">{formik.errors.level}</div>
                                    ) : null}
                                </div>
                                <div className="col-24 col-md-12 col-lg-8 col-xxl-6 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("Start Year")}<span className="text-orange ms-1">*</span></b>

                                        <input className="form-control w-100 mt-2" type="text" name="from"
                                               onChange={formik.handleChange} onBlur={formik.handleBlur}
                                               value={formik.values.from} placeholder={t("Start Year")}/>
                                    </label>
                                    {formik.touched.from && formik.errors.from ? (
                                        <div className="alert alert-warning" role="alert">{formik.errors.from}</div>
                                    ) : null}
                                </div>
                                <div className="col-24 col-md-12 col-lg-8 col-xxl-6 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("End Year")}</b>
                                        <input className="form-control w-100 mt-2" type="text" name="to"
                                               onChange={formik.handleChange} onBlur={formik.handleBlur}
                                               value={formik.values.to} placeholder={t("End Year")}/>
                                    </label>
                                    {formik.touched.to && formik.errors.to ? (
                                        <div className="alert alert-warning" role="alert">{formik.errors.to}</div>
                                    ) : null}
                                </div>

                                <div className="d-flex flex-row justify-content-end">
                                    {
                                        educationalRecords.isLoading ? (
                                            <SkeletonFramework height={40} width={250}
                                                               className={"btn text-white bg-orange p-2 mt-5 mb-3 rounded-pill col-md-6 col-24"}/>
                                        ) : (
                                            <input value={formik.isValid ? t("Submit") : t("Fill information")}
                                                   type="submit"
                                                   className="btn btn-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24"
                                                   disabled={!(
                                                       formik.isValid && formik.dirty
                                                   )}/>
                                        )
                                    }
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </>
    );
}

