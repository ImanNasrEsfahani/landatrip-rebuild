import React from "react";
import "../scss/Account-Agreement.scss";
import {useQuery, useQueryClient} from "react-query";
import axios from '../../../../axiosConfig';
import {Link, NavLink} from "react-router-dom";
import {SkeletonTableAccountAgreement} from "../../../../SkeletonFramework";
import {route} from "../../../helpers";
import Error from "../../../../Error";

export default function AccountAgreement() {

    const queryClient = useQueryClient();

    const accountAgreementRecords = useQuery('Agreements', async () => {
        const {data} = await axios.get(route('api.web.v1.teacher-panel.account-info.agreements.index'));
        accountAgreementRecords.data = data.data;
        return accountAgreementRecords;
    });

    const renderStatus = (param) => {
        switch (param) {
            case 'Canceled':
                return <h6 className="w-95 fs-2 mb-0 badge bg-danger rounded-pill py-2 fw-normal">Canceled</h6>;
            case 'Confirmed':
                return <h6 className="w-95 fs-2 mb-0 badge bg-green rounded-pill py-2 fw-normal">Confirmed</h6>;
            default:
                return <h6 className="w-95 fs-2 mb-0 badge bg-info rounded-pill py-2 fw-normal">Pending</h6>;
        }
    };

    // Show Error message in query of all record on mounting
    if (accountAgreementRecords.isError) {
        return <Error message={accountAgreementRecords.error.message} />;
    }


    return (
        <>
            <div className="bg-white w-100 h-auto p-3 rounded-4">
                <div className="row d-flex flex-row justify-content-around">
                    <div className="row">
                        <h4>Agreements</h4>
                        <hr/>
                        <div className="overflow-auto">
                            <table className="table table-striped table-hover text-center">
                                <thead>
                                <tr>
                                    <th className="fs-2">Agreement Name</th>
                                    <th className="fs-2 w-20">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                {
                                    accountAgreementRecords.isLoading ? (
                                        <SkeletonTableAccountAgreement/>
                                    ) : (
                                        (accountAgreementRecords.data.data.length > 0 ?
                                                accountAgreementRecords.data.data.map((value, key) => (
                                                    <tr key={key}>
                                                        <td className="align-middle"><Link
                                                            className="text-dark text-decoration-none"
                                                            to={`/panel/account-info/agreement/${value.id}`}>{value.title}</Link>
                                                        </td>
                                                        <td className="align-middle"><NavLink ageement-id={value.id}
                                                                                              to={`/panel/account-info/agreement/${value.id}`}>{renderStatus(value.status)}</NavLink>
                                                        </td>
                                                    </tr>
                                                ))
                                                :
                                                <tr>
                                                    <td colSpan="4" className="text-danger">{t("No Data")}</td>
                                                </tr>
                                        ))
                                }
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
