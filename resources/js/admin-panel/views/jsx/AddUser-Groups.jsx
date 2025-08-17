import React from "react";
import {useQuery, useQueryClient} from "react-query";
import axios from '../../../axiosConfig';
import {route} from "../../helpers";
import {Link} from "react-router-dom";
import {useTranslation} from "react-i18next";
import imgv from "../images/nava.webp";
import iman from "./addUser.module.scss";
export default function AddUserGroups() {

    // const { t } = useTranslation();
    // const queryClient = useQueryClient();

    // const archivedRecords = useQuery('AddUserGroups', async () => {
    //     const {data} = await axios.get(route("api.ticket.archived"));
    //     archivedRecords.data = data.data;
    //     console.log(archivedRecords.data);
    //     return archivedRecords;
    // });

    // const renderStatus = (param) => {
    //     switch (param) {
    //         case 'Pending':
    //             return <span className="w-95 fs-2 badge bg-orange rounded-pill px-3 py-2 fw-normal">{t(param)}</span>;
    //         case 'Paid':
    //             return <span className="w-95 fs-2 badge bg-green rounded-pill px-3 py-2 fw-normal">{t(param)}</span>;
    //         case 'Canceled':
    //             return <span className="w-95 fs-2 badge bg-light-gray rounded-pill px-3 py-2 fw-normal">{t(param)}</span>;
    //         case 'Expired':
    //             return <span className="w-95 fs-2 badge bg-dark-gray rounded-pill px-3 py-2 fw-normal">{t(param)}</span>;
    //     }
    // };

    // if (archivedRecords.isLoading) {
    //     return <h2>Loading...</h2>;
    // }
    //
    // // Show Error message in query of all record on mounting
    // if (archivedRecords.isError) {
    //     return <h2 className="text-danger">Error! {archivedRecords.error.message}</h2>;
    // }
    return (
        <>

            <div className={`bg-white w-100 h-auto p-3 rounded-4 ${iman}`}>
                <div className="container">
                    <div className="row my-2">
                        <div className="col-8 fw-bold">Add User Group</div>
                        <hr className="mt-1"/>
                    </div>
                    <div className="form-control d-flex justify-content-center w-75 mx-auto p-0 my-2 bg-secondary-subtle">
                        <span className="m-0 input-group-text border-0" id="basic-addon1"><i
                            className="bi bi-search"></i></span>
                        <input type="text" className=" flex-grow-1 border-0 bg-secondary-subtle" placeholder="Search"
                               aria-label="Search" aria-describedby="basic-addon1"/>
                            <span className="m-0 input-group-text border-0" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal" id="basic-addon1"><i className="bi bi-filter"></i></span>
                    </div>
                    <div className="row text-center w-75 mx-auto table-responsive">
                        <table className="table table-striped table align-middle">
                            <tbody>
                            <tr>
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td className="text-start"><img style="width: 50px; height: 50px;"
                                                                className="rounded rounded-pill"
                                                                src={imgv} alt="Profile Pic"/></td>
                                <td className="text-start px-0"><span className="fw-bold">Varzaneh Desert</span></td>
                                <td className="text-start px-0"><span className="text-muted">Provider : Peter Becker</span>
                                </td>
                            </tr>
                            <tr style="background-color: #D4D4D4;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td className="text-start"><img style="width: 50px; height: 50px;"
                                                                className="rounded rounded-pill"
                                                                src={imgv} alt="Profile Pic"/></td>
                                <td className="text-start px-0"><span className="fw-bold">Varzaneh Desert</span></td>
                                <td className="text-start px-0"><span className="text-muted">Provider : Peter Becker</span>
                                </td>
                            </tr>
                            <tr style="background-color: #ECECEC;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td className="text-start"><img style="width: 50px; height: 50px;"
                                                                className="rounded rounded-pill"
                                                                src={imgv} alt="Profile Pic"/></td>
                                <td className="text-start px-0"><span className="fw-bold">Varzaneh Desert</span></td>
                                <td className="text-start px-0"><span className="text-muted">Provider : Peter Becker</span>
                                </td>
                            </tr>
                            <tr style="background-color: #D4D4D4;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td className="text-start"><img style="width: 50px; height: 50px;"
                                                                className="rounded rounded-pill"
                                                                src={imgv} alt="Profile Pic"/></td>
                                <td className="text-start px-0"><span className="fw-bold">Varzaneh Desert</span></td>
                                <td className="text-start px-0"><span className="text-muted">Provider : Peter Becker</span>
                                </td>
                            </tr>
                            <tr style="background-color: #ECECEC;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td className="text-start"><img style="width: 50px; height: 50px;"
                                                                className="rounded rounded-pill"
                                                                src={imgv} alt="Profile Pic"/></td>
                                <td className="text-start px-0"><span className="fw-bold">Varzaneh Desert</span></td>
                                <td className="text-start px-0"><span className="text-muted">Provider : Peter Becker</span>
                                </td>
                            </tr>
                            <tr style="background-color: #D4D4D4;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td className="text-start"><img style="width: 50px; height: 50px;"
                                                                className="rounded rounded-pill"
                                                                src={imgv} alt="Profile Pic"/></td>
                                <td className="text-start px-0"><span className="fw-bold">Varzaneh Desert</span></td>
                                <td className="text-start px-0"><span className="text-muted">Provider : Peter Becker</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div className="row my-2">
                        <div className="col-8 fw-bold">Tour Groups</div>
                    </div>
                    <div className="row text-center w-75 mx-auto table-responsive">
                        <table className="table table-striped table align-middle">
                            <tbody>
                            <tr style="background-color: #ECECEC;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td><img style="width: 50px; height: 50px;" className="rounded rounded-pill"
                                         src={imgv} alt="Profile Pic"/></td>
                                <td><span className="fw-bold">Group 1</span></td>
                                <td><span className="text-muted">Sunday 02/02/2023</span></td>
                                <td className="px-5"><span style="background-color: #007560;"
                                                           className="d-block rounded-pill py-1 small">Completed</span></td>
                                <td className="align-top p-0">
                                    <div className="bg-white rounded-bs">
                                        <span>14/15</span>
                                        <i className="bi bi-people-fill"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr style="background-color: #ECECEC;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td><img style="width: 50px; height: 50px;" className="rounded rounded-pill"
                                         src={imgv} alt="Profile Pic"/></td>
                                <td><span className="fw-bold">Group 1</span></td>
                                <td><span className="text-muted">Sunday 02/02/2023</span></td>
                                <td className="px-5"><span style="background-color: #FF8C00;"
                                                           className="d-block rounded-pill py-1 small">Sold out</span></td>
                                <td className="align-top p-0">
                                    <div className="bg-white rounded-bs">
                                        <span>14/15</span>
                                        <i className="bi bi-people-fill"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr style="background-color: #ECECEC;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td><img style="width: 50px; height: 50px;" className="rounded rounded-pill"
                                         src={imgv} alt="Profile Pic"/></td>
                                <td><span className="fw-bold">Group 1</span></td>
                                <td><span className="text-muted">Sunday 02/02/2023</span></td>
                                <td className="px-5"><span style="background-color: #297191;"
                                                           className="d-block rounded-pill py-1 small">Booking...</span>
                                </td>
                                <td className="align-top p-0">
                                    <div className="bg-white rounded-bs">
                                        <span>14/15</span>
                                        <i className="bi bi-people-fill"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr style="background-color: #ECECEC;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td><img style="width: 50px; height: 50px;" className="rounded rounded-pill"
                                         src={imgv} alt="Profile Pic"/></td>
                                <td><span className="fw-bold">Group 1</span></td>
                                <td><span className="text-muted">Sunday 02/02/2023</span></td>
                                <td className="px-5"><span style="background-color: #C8102E;"
                                                           className="d-block rounded-pill py-1 small">No Time</span></td>
                                <td className="align-top p-0">
                                    <div className="bg-white rounded-bs">
                                        <span>14/15</span>
                                        <i className="bi bi-people-fill"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr style="background-color: #ECECEC;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td><img style="width: 50px; height: 50px;" className="rounded rounded-pill"
                                         src={imgv} alt="Profile Pic"/></td>
                                <td><span className="fw-bold">Group 1</span></td>
                                <td><span className="text-muted">Sunday 02/02/2023</span></td>
                                <td className="px-5"><span style="background-color: #666666;"
                                                           className="d-block rounded-pill py-1 small">Canceled</span></td>
                                <td className="align-top p-0">
                                    <div className="bg-white rounded-bs">
                                        <span>14/15</span>
                                        <i className="bi bi-people-fill"></i>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div className="row my-2">
                        <div className="col-8 fw-bold">User Full Name</div>
                    </div>
                    <div className="form-control d-flex justify-content-center w-75 mx-auto p-0 my-2 bg-secondary-subtle">
                        <span className="m-0 input-group-text border-0" id="basic-addon1"><i
                            className="bi bi-search"></i></span>
                        <input type="text" className=" flex-grow-1 border-0 bg-secondary-subtle" placeholder="Search"
                               aria-label="Search" aria-describedby="basic-addon1"/>
                    </div>
                    <div className="row text-center w-75 mx-auto table-responsive">
                        <table className="table table-striped table align-middle">
                            <tbody>
                            <tr style="background-color: #ECECEC;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td className="text-start"><img style="width: 50px; height: 50px;"
                                                                className="rounded rounded-pill"
                                                                src={imgv} alt="Profile Pic"/></td>
                                <td className="text-start px-0"><span className="fw-bold">Dem wilson</span></td>
                                <td className="text-start px-0"><span className="text-muted">Invoice ID : 565255325</span>
                                </td>
                            </tr>
                            <tr style="background-color: #D4D4D4;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td className="text-start"><img style="width: 50px; height: 50px;"
                                                                className="rounded rounded-pill"
                                                                src={imgv} alt="Profile Pic"/></td>
                                <td className="text-start px-0"><span className="fw-bold">Dem wilson</span></td>
                                <td className="text-start px-0"><span className="text-muted">Invoice ID : 565255325</span>
                                </td>
                            </tr>
                            <tr style="background-color: #ECECEC;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td className="text-start"><img style="width: 50px; height: 50px;"
                                                                className="rounded rounded-pill"
                                                                src={imgv} alt="Profile Pic"/></td>
                                <td className="text-start px-0"><span className="fw-bold">Dem wilson</span></td>
                                <td className="text-start px-0"><span className="text-muted">Invoice ID : 565255325</span>
                                </td>
                            </tr>
                            <tr style="background-color: #D4D4D4;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td className="text-start"><img style="width: 50px; height: 50px;"
                                                                className="rounded rounded-pill"
                                                                src={imgv} alt="Profile Pic"/></td>
                                <td className="text-start px-0"><span className="fw-bold">Dem wilson</span></td>
                                <td className="text-start px-0"><span className="text-muted">Invoice ID : 565255325</span>
                                </td>
                            </tr>
                            <tr style="background-color: #ECECEC;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td className="text-start"><img style="width: 50px; height: 50px;"
                                                                className="rounded rounded-pill"
                                                                src={imgv} alt="Profile Pic"/></td>
                                <td className="text-start px-0"><span className="fw-bold">Dem wilson</span></td>
                                <td className="text-start px-0"><span className="text-muted">Invoice ID : 565255325</span>
                                </td>
                            </tr>
                            <tr style="background-color: #D4D4D4;">
                                <td>
                                    <input className="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1"/>
                                </td>
                                <td className="text-start"><img style="width: 50px; height: 50px;"
                                                                className="rounded rounded-pill"
                                                                src={imgv} alt="Profile Pic"/></td>
                                <td className="text-start px-0"><span className="fw-bold">Dem wilson</span></td>
                                <td className="text-start px-0"><span className="text-muted">Invoice ID : 565255325</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div className="row my-2 text-center align-items-center">
                        <div className="">
                            <button className="col-12 col-lg-3 btn btn-danger btn-sm rounded rounded-pill m-2"
                                    type="button">Cancel
                            </button>
                            <button className="col-12 col-lg-3 btn btn-success btn-sm rounded rounded-pill m-2"
                                    type="button">Add Users
                            </button>
                        </div>
                    </div>
                    <div className="modal fade modal-sm" id="exampleModal" tabIndex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div className="modal-dialog">
                            <div className="modal-content ">
                                <div className="modal-body">
                                    <div className="row">
                                        <label className="form-label small">Tour Title
                                            <input type="text" className="form-control my-1"
                                                   placeholder="Tour Title ..." aria-label="Search"
                                                   aria-describedby="basic-addon1"/>
                                        </label>
                                        <label className="form-label small">Provider Name
                                            <input type="text" className="form-control my-1"
                                                   placeholder="Provider Name ..." aria-label="Search"
                                                   aria-describedby="basic-addon1"/>
                                        </label>
                                        <label className="form-label dropdown-center small">Category
                                            <button
                                                className="form-control btn btn-outline-dark border dropdown-toggle text-start my-1"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Dropdown
                                            </button>
                                            <ul className="dropdown-menu">
                                                <li><a className="dropdown-item" href="#">Action</a></li>
                                                <li><a className="dropdown-item" href="#">Action two</a></li>
                                                <li><a className="dropdown-item" href="#">Action three</a></li>
                                            </ul>
                                        </label>
                                    </div>
                                </div>
                                <div className="modal-footer justify-content-center">
                                    <button className="col-12 col-lg-3 btn btn-danger btn-sm rounded rounded-pill m-2"
                                            data-bs-dismiss="modal" type="button">Cancel
                                    </button>
                                    <button className="col-12 col-lg-3 btn btn-success btn-sm rounded rounded-pill m-2"
                                            data-bs-dismiss="modal" type="button">Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
