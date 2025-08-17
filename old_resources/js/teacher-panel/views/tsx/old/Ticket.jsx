import React, {useRef} from "react";
import "../scss/Ticket.scss";
import {useMutation, useQuery, useQueryClient} from "react-query";
import axios from '../../../../axiosConfig';
import {route} from "../../../helpers";
import {useFormik} from "formik";
import * as yup from "yup";
import {toast} from "react-toastify";
import {Link} from "react-router-dom";
import {useTranslation} from "react-i18next";
import {SkeletonTableTicket, SkeletonFramework} from "../../../../SkeletonFramework";
import Error from "../../../../Error";

export default function Ticket() {
    const {t} = useTranslation();
    const queryClient = useQueryClient();

    const ticketsRecords = useQuery('Tickets', async () => {
        const {data} = await axios.get(route("api.web.v1.teacher-panel.ticket.index"));
        ticketsRecords.data = data.data;
        console.log(ticketsRecords.data);
        return ticketsRecords;
    });

    let initialValue = {
        title: "", priority: 0, message: ""
    };

    const formik = useFormik({
        initialValues: initialValue, validationSchema: yup.object().shape({
            title: yup.string().required("Subject is a required").min(3).max(150),
            priority: yup.string(),
            message: yup.string().required("Message is a required").min(20).max(450)
        }), onSubmit: values => {
            postTicket.mutate({
                title: formik.values.title,
                priority: formik.values.priority,
                message: formik.values.message
            });
        }
    });


    // Create a new record
    const postTicket = useMutation(async (data) => {
        toastId.current = toast.loading("Posting...", {
            closeButton: true, theme: "colored", type: toast.TYPE.INFO
        });
        const response = await axios.post(route("api.web.v1.teacher-panel.ticket.store"), data);
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
            ticketsRecords.refetch();
            formik.resetForm();
        }, onError: () => {
            toast.update(toastId.current, {
                render: "It has a problem",
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
    const toastId = useRef(null);
    const renderStatus = (param) => {
        switch (param) {
            case 'New':
                return <span
                    className="w-95 fs-2 mb-0 badge bg-orange rounded-pill py-2 px-3 fw-normal">{t(param)}</span>;
            case 'Pending':
                return <span
                    className="w-95 fs-2 mb-0 badge bg-info rounded-pill px-3 py-2 fw-normal">{t(param)}</span>;
            case 'Closed':
                return <span
                    className="w-95 fs-2 mb-0 badge bg-secondary rounded-pill px-3 py-2 fw-normal">{t(param)}</span>;
            case 'Answered':
                return <span
                    className="w-95 fs-2 mb-0 badge bg-secondary rounded-pill px-3 py-2 fw-normal">{t(param)}</span>;
            default:
                return <span
                    className="w-95 fs-2 mb-0 badge bg-green rounded-pill px-3 py-2 fw-normal">{t(param)}</span>;
        }
    };

    // Show Error message in query of all record on mounting
    if (ticketsRecords.isError) {
        return <Error message={ticketsRecords.error.message}/>;
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
                    <h5>
                        <b>{t("Tickets List")}</b>
                    </h5>
                    <hr/>
                    <div className="table-responsive">
                        <table className="table table-striped table-hover text-center">
                            <thead>
                            <tr>
                                <th>{t("Subject")}</th>
                                <th>{t("Priority")}</th>
                                <th style={{width: "15%"}}>{t("STATUS")}</th>
                            </tr>
                            </thead>
                            <tbody>
                            {
                                ticketsRecords.isLoading ? (
                                    <SkeletonTableTicket/>
                                ) : (
                                    (ticketsRecords.data.data.length > 0 ?
                                            ticketsRecords.data.data.map((value, key) => (<tr key={key}>
                                                <td className="align-middle">
                                                    <Link className="text-decoration-none text-dark"
                                                          to={`../ticket/${value.id}`}>{value.title} <i
                                                        className="fa-solid fa-arrow-up-right-from-square"></i></Link>
                                                </td>
                                                <td className="align-middle">{value.priority}</td>
                                                <td className="align-middle"><Link
                                                    className="text-decoration-none text-dark"
                                                    to={`../ticket/${value.id}`}>{renderStatus(value.status)}</Link>
                                                </td>
                                            </tr>)) :
                                            <tr>
                                                <td colSpan="3" className="text-danger">{t("No Data")}</td>
                                            </tr>
                                    ))
                            }
                            </tbody>
                        </table>
                    </div>
                </div>
                <div className="row">
                    <form onSubmit={formik.handleSubmit}>
                        <div className="row">
                            <h5 className="mt-3">{t("Create a new ticket")}</h5>
                            <hr/>
                            <div className="col-24 col-md-16 col-xl-16 mb-4">
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
                            <div className="col-24 col-md-8 col-xl-8 mb-4">
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
                                              onBlur={formik.handleBlur}
                                              value={formik.values.message}></textarea>
                                </label>
                                {formik.touched.message && formik.errors.message ? (
                                    <div className="alert alert-warning" role="alert">{formik.errors.message}</div>
                                ) : null}
                            </div>
                            <div className="d-flex flex-row justify-content-end">
                                {
                                    ticketsRecords.isLoading ? (
                                        <SkeletonFramework height={35} width={250}
                                                           className={"rounded-pill bg-orange"}/>
                                    ) : (
                                        <input type="submit"
                                               value={formik.isValid ? t("Submit") : t("Fill information")}
                                               className="btn btn-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24"
                                               disabled={!(formik.isValid && formik.dirty)}/>
                                    )
                                }
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </>);
}
