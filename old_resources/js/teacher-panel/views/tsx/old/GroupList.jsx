import React from "react";
import axios from '../../../../axiosConfig';
import "../scss/GroupList.scss";
import { useMutation, useQuery, useQueryClient } from "react-query";
import {route} from '../../../helpers'
import {useTranslation} from "react-i18next";
import {SkeletonTableGroupList} from "../../../../SkeletonFramework";
import Error from "../../../../Error";

export default function GroupList()
{
    // Access the client
    const queryClient = useQueryClient();

    //Translation
    const {t} = useTranslation();

    // Queries to get all records
    const groupListRecords = useQuery('groupListRecords', async () =>
    {
        const {data} = await axios.get(route('api.web.v1.teacher-panel.groups.index'));
        groupListRecords.data = data.data;
        return groupListRecords;
    });

    const renderStatus = (param) => {
        switch (param) {
            case 'Upcoming':
                return <span className="w-95 fs-2 mb-0 badge bg-primary rounded-pill py-2 px-3 fw-normal">{t("Upcoming")}</span>;
            case 'Canceled':
                return <span className="w-95 fs-2 mb-0 badge bg-danger rounded-pill px-3 py-2 fw-normal">{t("Canceled")}</span>;
            case 'No Time':
                return <span className="w-95 fs-2 mb-0 badge bg-orange rounded-pill px-3 py-2 fw-normal">{t("No Time")}</span>;
            case 'Sold Out':
                return <span className="w-95 fs-2 mb-0 badge bg-secondary rounded-pill px-3 py-2 fw-normal">{t("Sold Out")}</span>;
            default:
                return <span className="w-95 fs-2 mb-0 badge bg-green rounded-pill px-3 py-2 fw-normal">{t("Complete")}</span>;
        }
    };

    // Show Error message in query of all record on mounting
    if (groupListRecords.isError)
    {
        return <Error message={groupListRecords.error.message} />;
    }


    return (<>
        <div className="bg-white w-100 h-auto p-3 rounded-4">
            <div className="row d-flex flex-row justify-content-around">
                <div className="row">
                    <h5>
                        <b>{t("Group List")}</b>
                    </h5>
                    <hr/>
                    <div className="overflow-auto">
                        <table className="table table-striped table-hover text-center">
                            <thead>
                            <tr>
                                <th>{t("Group Name")}</th>
                                <th>{t("Capacity")}</th>
                                <th>{t("Last Message")}</th>
                                <th>{t("Status")}</th>
                            </tr>
                            </thead>
                            <tbody>
                            {
                                groupListRecords.isLoading ?(
                                    <SkeletonTableGroupList/>
                                    ) : (
                                groupListRecords.data.data.length > 0 ? (
                                groupListRecords.data.data.map((value, key) => (
                                <tr key={ key }>
                                    <td className="text-start w-20">
                                        <img src={`http://landatrip.test/storage/groups/thumbnails/${value.thumbnail}`} width="35px" height="35px" className="rounded-pill me-2"/>
                                        {value.title.length < 21 ? value.title : value.title.slice(0, 20)+" ..."}
                                    </td>
                                    <td className="align-middle text-secondary w-10">{value.booked}/{value.capacity}</td>
                                    <td className="align-middle">{ value.lastMessage}</td>
                                    <td className="align-middle w-15">{ renderStatus(value.status) }</td>
                                </tr>
                            ))) :(
                                <tr>
                                <td colSpan="4" className="text-danger">{t("No Group")}</td>
                                </tr>
                                ))
                            }
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </>);
};
