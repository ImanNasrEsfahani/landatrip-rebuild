import React, { useRef } from "react";
import axios from '../../../../axiosConfig';
import { toast } from 'react-toastify';
import * as yup from 'yup';
import { useMutation, useQuery, useQueryClient } from 'react-query';
import { useFormik } from "formik";
import "../scss/Account-WorkExperience.scss";
import 'react-toastify/dist/ReactToastify.css';
import {route} from "../../../helpers";
import {useTranslation} from "react-i18next";
import {SkeletonFramework, SkeletonTableAccountWorkExperience} from "../../../../SkeletonFramework";
import Error from "../../../../Error";

export default function AccountWorkExperience(){

    const { t } = useTranslation();

    // Access the client
    const queryClient = useQueryClient();

    // Queries to get all records
    const workExperienceRecords = useQuery('workExperience', async () =>
    {
        const {data} = await axios.get(route("api.web.v1.teacher-panel.account-info.work-experience.index"));
        workExperienceRecords.data = data.data;
        return workExperienceRecords;
    });

    let initialValue = {
        id : "", company_name : "", position : "", from : "", to : ""
    };

    const formik = useFormik({
        initialValues : initialValue, validationSchema : yup.object().shape({
            company_name : yup.string().required("Company name is a required field").min(3).max(150),
            position : yup.string().required("Position is a required field").min(3).max(150), from : yup.number().required(
                "Start Year is a required field").min(1900).max(2023),
            to : yup.number().max(2023).nullable(true).min(yup.ref('from'), "end date can't be before start date")
        }), onSubmit : values =>
        {
            if (formik.values.id)
            {
                postWorkExperienceRecord.mutate({
                    id : formik.values.id,
                    company_name : formik.values.company_name,
                    position : formik.values.position,
                    from : formik.values.from,
                    to : formik.values.to
                });
            } else
            {
                postWorkExperienceRecord.mutate({
                    company_name : formik.values.company_name,
                    position : formik.values.position,
                    from : formik.values.from,
                    to : formik.values.to
                });
            }
        }
    });


    // Create a new record
    const postWorkExperienceRecord = useMutation(async (data) =>
    {
        toastId.current = toast.loading("Posting...", {
            closeButton : true, theme : "colored", type : toast.TYPE.INFO
        });
        if (data.id) {
            return await axios.put(route("api.web.v1.teacher-panel.account-info.work-experience.update", {"work_experience": data.id}) , data).data;
        }
        return await axios.post(route("api.web.v1.teacher-panel.account-info.work-experience.store"), data).data;
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
            window.setTimeout(() => {workExperienceRecords.refetch()}, 1200);
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

    // Set updated data from form to send
    function editWorkExperienceRecord(id)
    {
        let row = workExperienceRecords.data.data.find(row => row.id === id);
        formik.setValues({
            id : row.id, company_name : row.company_name, position : row.position, from : row.from, to : row.to ? row.to : ""
        });
    }

    const toastId = useRef(null);

    // Delete a record
    const deleteWorkExperienceRecord = useMutation((id) =>
    {
        toastId.current = toast.loading("Deleting...", {
            // autoClose: 5000,
            // progress: 100,
            closeButton : true,
            theme : "colored",
            type : toast.TYPE.WARNING
        });
        return axios.delete(route("api.web.v1.teacher-panel.account-info.work-experience.destroy", {"work_experience": id}));
    }, {
        onSuccess : data =>
        {
            toast.update(toastId.current, {
                render : "It has been deleted",
                theme : "colored",
                type : toast.TYPE.SUCCESS,
                autoClose : 6000,
                closeButton : true,
                isLoading : false,
                draggable : true,
                draggablePercent : 60
            });
            window.setTimeout(() => {workExperienceRecords.refetch()}, 1200);
            formik.resetForm();
        }, onError : () =>
        {
            toast.update(toastId.current, {
                render : "It has a problem on deleting",
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

    const renderStatus = (param) =>
    {
        switch (param)
        {
            case 'Working':
                return <h6 className="badge bg-orange rounded-pill w-100 py-2 fw-normal">{t(param)}</h6>;
            case 'Completed':
                return <h6 className="badge bg-green rounded-pill w-100 py-2 fw-normal">{t(param)}</h6>;
        }
    };

    // Show Error message in query of all record on mounting
    if (workExperienceRecords.isError)
    {
        return <Error message={workExperienceRecords.error.message} />;
    }

    return (
        <>
            <div className="bg-white w-100 h-auto p-3 rounded-4">
                <div className="row d-flex flex-row justify-content-around">
                    <div className="row">
                        <h5>
                            <b>{t("Work Experience")}</b>
                        </h5>
                        <hr/>
                        <div className="overflow-auto">
                            <table className="table table-striped table-hover text-center">
                                <thead>
                                <tr>
                                    <th>{t("Company Name")}</th>
                                    <th>{t("Position")}</th>
                                    <th>{t("Start Year")}</th>
                                    <th>{t("End Year")}</th>
                                    <th>{t("STATUS")}</th>
                                    <th>{t("Edit / Remove")}</th>
                                </tr>
                                </thead>
                                <tbody>
                                {
                                    workExperienceRecords.isLoading ? (
                                        <SkeletonTableAccountWorkExperience/>
                                    ):(
                                        (workExperienceRecords.data.data.length > 0 ?
                                                workExperienceRecords.data.data.map((value, key) => (
                                                    <tr key={ key }>
                                                        <td className="align-middle">{ value.company_name }</td>
                                                        <td className="align-middle">{ value.position }</td>
                                                        <td className="align-middle">{ value.from }</td>
                                                        <td className="align-middle">{ value.to }</td>
                                                        <td className="align-middle">{ renderStatus(value.status) }</td>
                                                        <td className="align-middle">
                                                            <button className="border-0 bg-transparent" onClick={ () => editWorkExperienceRecord(
                                                                value.id) }><i className="fs-3 text-orange fa-solid fa-pen-to-square"></i></button>
                                                            <button className="border-0 bg-transparent" onClick={ () => deleteWorkExperienceRecord.mutate(
                                                                value.id) }><i className="fs-3 ms-3 text-danger fa-solid fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                )):
                                                <tr>
                                                    <td colSpan="6" className="text-danger">{t("No Data")}</td>
                                                </tr>
                                        ))
                                }
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {/*Form*/ }
                    <div className="mt-5">
                        { formik.values.id ? <div className="w-95 mx-auto d-flex flex-row justify-content-between mb-0">
                                <h5 className="align-self-center mb-0">Edit record</h5>
                                <button className="btn bg-transparent border-0" onClick={ e =>
                                {
                                    formik.resetForm();
                                } }><i className="text-danger fs-5 fa-solid fa-xmark"></i></button>
                            </div> :
                            <h5 className="w-95 mx-auto d-flex flex-row justify-content-between mb-0">{t("Insert New")}</h5> }
                        <hr className="mt-2"/>
                        {/*<form className="m-0 p-0 w-100" onSubmit={handleSubmit(onSubmit)}>*/ }
                        <form className="m-0 p-0 w-100" onSubmit={ formik.handleSubmit }>
                            {/*<input type="hidden" {...register("id")} value={formId} onChange={event => setFormId(event.target.value)}/>*/ }
                            <input type="hidden" name="id" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.id }/>
                            <div className="row m-0 p-0 w-95 mx-auto">
                                <div className="col-24 col-md-12 col-xl-8 col-xxl-6 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("Company Name")}<span className="text-orange ms-1">*</span></b>
                                        {/*<input className="form-control w-100 mt-2" type="text" {...register("company_name")} value={formCompanyName} onChange={event => setFormCompanyName(event.target.value)} placeholder="Company Name"/>*/ }
                                        <input className="form-control w-100 mt-2" type="text" name="company_name" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.company_name } placeholder={t("Company Name")}/>
                                    </label>
                                    { formik.touched.company_name && formik.errors.company_name ? (
                                        <div className="alert alert-warning" role="alert">{ formik.errors.company_name }</div>
                                    ) : null }
                                </div>

                                <div className="col-24 col-md-12 col-xl-8 col-xxl-6 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("Position")}<span className="text-orange ms-1">*</span></b>
                                        {/*<input className="form-control w-100 mt-2" type="text" {...register("position")} value={formPosition} onChange={event => setFormPosition(event.target.value)} placeholder="Position"/>*/ }
                                        <input className="form-control w-100 mt-2" type="text" name="position" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.position } placeholder={t("Position")}/>
                                    </label>
                                    { formik.touched.position && formik.errors.position ? (
                                        <div className="alert alert-warning" role="alert">{ formik.errors.position }</div>
                                    ) : null }
                                </div>

                                <div className="col-24 col-md-12 col-xl-8 col-xxl-6 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("Start Year")}<span className="text-orange ms-1">*</span></b>
                                        {/*<input className="form-control w-100 mt-2" type="text" {...register("from")} value={formFrom} onChange={event => setFormFrom(event.target.value)} placeholder="Start date"/>*/ }
                                        <input className="form-control w-100 mt-2" type="text" name="from" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.from } placeholder={t("Start Year")}/>
                                    </label>
                                    { formik.touched.from && formik.errors.from ? (
                                        <div className="alert alert-warning" role="alert">{ formik.errors.from }</div>
                                    ) : null }
                                </div>

                                <div className="col-24 col-md-12 col-xl-8 col-xxl-6 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("End Year")}</b>
                                        {/*<input className="form-control w-100 mt-2" type="text" {...register("to")} value={formTo} onChange={event => setFormTo(event.target.value)} placeholder="End date"/>*/ }
                                        <input className="form-control w-100 mt-2" type="text" name="to" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.to } placeholder={t("End Year")}/>
                                    </label>
                                    { formik.touched.to && formik.errors.to ? (
                                        <div className="alert alert-warning" role="alert">{ formik.errors.to }</div>
                                    ) : null }
                                </div>
                            </div>
                            <div className="d-flex flex-row justify-content-end">
                                {
                                    workExperienceRecords.isLoading ? (
                                        <SkeletonFramework height={40} width={250} className="btn bg-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24 "/>
                                    ): (
                                        <input value={ formik.isValid ? t("Submit") : t("Fill information") } type="submit" className="btn btn-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24" disabled={ !(
                                            formik.isValid && formik.dirty
                                        ) }/>
                                    )
                                }
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </>
    );
}
