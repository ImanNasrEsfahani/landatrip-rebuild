import React from "react";
import axios from '../../../../axiosConfig';
import "../scss/GroupList.scss";
import { useMutation, useQuery, useQueryClient } from "react-query";
import {useTranslation} from "react-i18next";
import {route} from "../../../helpers";
import Error from "../../../../Error";

export default function GroupList()
{
// Access the client
    const queryClient = useQueryClient();

    //Translation
    const {t} = useTranslation();

    // Queries to get all records
    const affiliateLinkListRecords = useQuery('affiliateLinkListRecords', async () =>
    {
        const {data} = await axios.get(route('api.tours.index'));
        affiliateLinkListRecords.data = data.data;
        return affiliateLinkListRecords;
    });

    const affiliatePeopleListRecords = useQuery('affiliatePeopleListRecords', async () =>
    {
        const {data} = await axios.get(route('api.tours.index'));
        affiliatePeopleListRecords.data = data.data;
        return affiliatePeopleListRecords;
    });


    const renderStatus = (param) =>{
        switch (param) {
            case "Pending":
                return <span className="w-95 fs-2 mb-0 badge bg-orange rounded-pill py-2 px-3 fw-normal">{t("Pending")}</span>
            case "Waiting":
                return <span className="w-95 fs-2 mb-0 badge bg-primary rounded-pill py-2 px-3 fw-normal">{t("Waiting")}</span>
            default :
                return <span className="w-95 fs-2 mb-0 badge bg-green rounded-pill py-2 px-3 fw-normal">{t("Verified")}</span>
        }
    }

    if (affiliatePeopleListRecords.error || affiliateLinkListRecords.error) {
            return <h2>Loading...</h2>;
        }

    if (affiliatePeopleListRecords.error || affiliateLinkListRecords.error){
        return <Error message={affiliatePeopleListRecords.error.message || affiliateLinkListRecords.error.message}/>;
    }
    return(
    <>
        <div className="bg-white w-100 h-auto p-5 rounded-4">
            <div className="row d-flex flex-row justify-content-around">
                <div className="row">
                    <h5>{t("People")}</h5>
                    <hr/>
                    <div className="overflow-auto">
                        <table className="table table-striped table-hover text-center">
                            <thead>
                            <tr>
                                <th>{t("Name")}</th>
                                <th>{t("Link")}</th>
                                <th style={ {width : "15%"} }>{t("STATUS")}</th>
                                <th>{t("Time")}</th>
                            </tr>
                            </thead>
                            <tbody>

                            {
                                true > 0 ?(
                                affiliatePeopleListRecords.data.data.map((value, key) => (
                                <tr key={ key }>
                                    <td className="align-middle">{ value.title }</td>
                                    <td className="align-middle">{ value.link }</td>
                                    <td className="align-middle">{ renderStatus(value.status) }</td>
                                        <td className="align-middle">{value.time}</td>
                                </tr>
                                ))) : (
                                    <tr>
                                        <td colSpan="4" className="text-danger">{t("No Data")}</td>
                                    </tr>
                                        )
                            }
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div className="bg-white w-100 h-auto p-5 rounded-4 mt-6">
            <div className="row d-flex flex-row justify-content-around">
                <div className="row">
                    <h5>{t("Links")}</h5>
                    <hr/>
                    <div className="overflow-auto">
                        <table className="table table-striped table-hover text-center">
                            <thead>
                            <tr>
                                <th>{t("Name")}</th>
                                <th>{t("Number")}</th>
                                <th>{t("bonus")}</th>
                                <th>{t("Time")}</th>
                            </tr>
                            </thead>
                            <tbody>
                            { affiliateLinkListRecords.data.data.map((value, key) => (
                                <tr key={ key }>
                                    <td className="align-middle">{ value.title }</td>
                                    <td className="align-middle">{ value.num }</td>
                                    <td className="align-middle">{ value.bonus }</td>
                                        <td className="align-middle">{value.time}</td>
                                </tr>
                            )) }
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </>)
}
