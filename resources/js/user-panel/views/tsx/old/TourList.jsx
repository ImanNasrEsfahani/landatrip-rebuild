import React from "react";
import "../scss/TourList.scss";
import {useQuery, useQueryClient} from "react-query";
import axios from '../../../../axiosConfig';
import img from '../../images/netur.jpg'
import {route} from '../../../helpers'
import {SkeletonTableTourList} from '../../../../SkeletonFramework'
import {useTranslation} from 'react-i18next'
import Error from "../../../../Error";

export default function TourList() {

    const queryClient = useQueryClient();

    const {t} = useTranslation();

    const tourRecords = useQuery('Tour', async () => {
        const {data} = await axios.get(route('api.web.v1.teacher-panel.tours.index'));
        tourRecords.data = data.data;
        return tourRecords;
    });

    const renderStatus = (param) => {
        switch (param) {
            case 'Suspend':
                return <span className="w-95 fs-2 badge bg-orange rounded-pill px-3 py-2 fw-normal">{t("Suspend")}</span>;
            default:
                return <span className="w-95 fs-2 badge bg-green rounded-pill px-3 py-2 fw-normal">{t("Active")}</span>;
        }
    };

    // Show Error message in query of all record on mounting
    if (tourRecords.isError) {
        return <Error message={tourRecords.error.message} />;
    }

    return (
        <>
            <div className="bg-white w-100 h-auto p-3 rounded-4">
                <div className="row d-flex flex-row justify-content-around">
                    <div className="row">
                        <h5>
                            <b>{t("My Tours")}</b>
                        </h5>
                        <hr/>
                        <div className="overflow-auto">
                            <table className="table table-striped table-hover text-center">
                                <thead>
                                <tr>
                                    <th>{t("Title")}</th>
                                    <th>{t("Origin / Destination")}</th>
                                    <th>{t("Day / Night")}</th>
                                    <th style={{width: "15%"}}>{t("STATUS")}</th>
                                </tr>
                                </thead>
                                <tbody>
                                {
                                    tourRecords.isLoading ? (
                                            <SkeletonTableTourList/>
                                        ) :
                                        (
                                            tourRecords.data.data.length > 0 ? (
                                                    tourRecords.data.data.map((value, key) => (
                                                        <tr key={key}>
                                                            <td className="align-middle">{value.title}</td>
                                                            <td className="align-middle">{value.origin}/{value.destination}</td>
                                                            <td className="align-middle">{value.days}/{value.nights}</td>
                                                            <td className="align-middle">{renderStatus(value.status)}</td>
                                                        </tr>)))
                                                :
                                                (<tr>
                                                        <td colSpan="4" className="text-danger">{t("No Tour")}</td>
                                                    </tr>

                                                ))}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div className="p-3">
                        <h5>
                            <b>{t("Upcoming plans")} </b>
                        </h5>
                        <hr/>
                        <div className=" rounded-3 shadow p-0 row justify-content-between m-2 mb-9">
                            <img src={img} height='100px' width='150px'
                                 className='rounded-top rounded-lg-start col-24 col-md-6 col-lg-4 p-0'/>
                            <div className="col-24 col-md-13 col-lg-16 ps-4 pt-3 d-grid">
                                <p className="fs-4 m-0">How to write business plan</p>
                                <div>
                                    <i className="fa-regular fa-location-dot text-orange opacity-95 fs-4"></i>
                                    <span className="fs-1 text-secondary ms-1">Bali, Indonesia</span>
                                </div>
                            </div>
                            <div className="col-24 col-lg-4 col-md-5 text-end">
                                <button type="submit"
                                        className="btn btn-orange text-white p-3 m-3 my-6 ms-0 rounded-pill w-100">{t("View Details")}
                                </button>
                            </div>
                        </div>
                        <div className=" rounded-3 shadow p-0 row justify-content-between m-2 mb-9">
                            <img src={img} height='100px' width='150px'
                                 className='rounded-top rounded-lg-start col-24 col-md-6 col-lg-4 p-0'/>
                            <div className="col-24 col-md-13 col-lg-16 ps-4 pt-3 d-grid">
                                <p className="fs-4 m-0">How to write business plan</p>
                                <div>
                                    <i className="fa-regular fa-location-dot text-orange opacity-95 fs-4"></i>
                                    <span className="fs-1 text-secondary ms-1">Bali, Indonesia</span>
                                </div>
                            </div>
                            <div className="col-24 col-lg-4 col-md-5 text-end">
                                <button type="submit"
                                        className="btn btn-orange text-white p-3 m-3 my-6 ms-0 rounded-pill w-100">View
                                    Details
                                </button>
                            </div>
                        </div>
                        <div className=" rounded-3 shadow p-0 row justify-content-between m-2 mb-9">
                            <img src={img} height='100px' width='150px'
                                 className='rounded-top rounded-lg-start col-24 col-md-6 col-lg-4 p-0'/>
                            <div className="col-24 col-md-13 col-lg-16 ps-4 pt-3 d-grid">
                                <p className="fs-4 m-0">How to write business plan</p>
                                <div>
                                    <i className="fa-regular fa-location-dot text-orange opacity-95 fs-4"></i>
                                    <span className="fs-1 text-secondary ms-1">Bali, Indonesia</span>
                                </div>
                            </div>
                            <div className="col-24 col-lg-4 col-md-5 text-end">
                                <button type="submit"
                                        className="btn btn-orange text-white p-3 m-3 my-6 ms-0 rounded-pill w-100">View
                                    Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

