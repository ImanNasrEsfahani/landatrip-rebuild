import React from "react";
import {useQuery, useQueryClient} from "react-query";
import axios from '../../../axiosConfig';
import {route} from "../../helpers";
import {Link} from "react-router-dom";
import {useTranslation} from "react-i18next";

export default function OpenTickets() {

    const { t } = useTranslation();
    const queryClient = useQueryClient();

    const openTicketsRecords = useQuery('OpenTickets', async () => {
        const {data} = await axios.get(route("api.web.v1.admin-panel.ticket.open"));
        openTicketsRecords.data = data.data;
        console.log(openTicketsRecords.data);
        return openTicketsRecords;
    });

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
                    className="w-95 fs-2 mb-0 badge bg-green rounded-pill px-3 py-2 fw-normal">{t(param)}</span>;
            case 'Rating':
                return <span
                    className="w-95 fs-2 mb-0 badge bg-warning rounded-pill px-3 py-2 fw-normal">{t(param)}</span>;
            default:
                return <span
                    className="w-95 fs-2 mb-0 badge bg-green rounded-pill px-3 py-2 fw-normal">{t(param)}</span>;
        }
    };

    if (openTicketsRecords.isLoading) {
        return <h2>Loading...</h2>;
    }

    // Show Error message in query of all record on mounting
    if (openTicketsRecords.isError) {
        return <h2 className="text-danger">Error! {openTicketsRecords.error.message}</h2>;
    }
    return (
        <>

            <div className="bg-white w-100 h-auto p-3 rounded-4">
                <div className="row d-flex flex-row justify-content-around">
                    <div className="row">
                        <h5><b>{t("Open Tickets")}</b></h5>
                        <hr/>
                        <div className="overflow-auto">
                            <table className="table table-striped table-hover text-center">
                                <thead>
                                <tr>
                                    <th className="text-start ms-4">{t("User ID")}</th>
                                    <th>{t("Subject")}</th>
                                    <th>{t("Status")}</th>
                                    <th>{t("Priority")}</th>
                                </tr>
                                </thead>
                                <tbody>
                                {openTicketsRecords.data.data.length > 0 ?(
                                    openTicketsRecords.data.data.map((value, key) => (
                                    <tr key={key}>
                                        <td className="text-start ms-4"><Link className="text-decoration-none text-dark" to={`../ticket/${value.id}`}>
                                            <img className="max-h-2rem rounded-circle me-4 "
                                                 src={import.meta.env.VITE_ASSET_URL + `/public/users/profile/${value.profile}`}/>
                                            {value.user_name}</Link></td>
                                        <td className="align-middle"><Link className="text-decoration-none text-dark" to={`../ticket/${value.id}`}>{value.subject}<i className="fa-solid fa-arrow-up-right-from-square ms-2 text-orange"></i></Link></td>
                                        <td className="align-middle">{renderStatus(value.status)}</td>
                                        <td className="align-middle">{value.priority}</td>
                                    </tr>
                                ))): (
                                        <tr>
                                            <td colSpan="5" className="text-danger">{t("No Ticket Record")}</td>
                                        </tr>)}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </>
    );
}
