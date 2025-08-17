import React from "react";
import {useMutation, useQuery, useQueryClient} from "react-query";
import axios from '../../../axiosConfig';
import {route} from "../../helpers";
import {Link, useParams} from "react-router-dom";
import {useTranslation} from "react-i18next";
import {useFormik} from "formik";
import * as yup from "yup";
import {toast} from "react-toastify";

export default function UnassignedTickets() {

    const { t } = useTranslation();
    const queryClient = useQueryClient();

    const unassignedTicketsRecords = useQuery('UnassignedTickets', async () => {
        const {data} = await axios.get(route("api.web.v1.admin-panel.ticket.unassigned"));
        unassignedTicketsRecords.data = data.data;
        console.log(unassignedTicketsRecords.data);
        return unassignedTicketsRecords;
    });

    const postAssign = useMutation(async (id)=>{
        toastId.current = toast.loading("Posting...", {
            closeButton : true, theme : "colored", type : toast.TYPE.INFO
        });
        const response = await axios.post(route('api.web.v1.admin-panel.ticket.assignMe', id));
        return response.data;
    },{
        onSuccess : data => {
            toast.update(toastId.current, {
                render : "Assigned",
                theme : "colored",
                type : toast.TYPE.SUCCESS,
                autoClose : 6000,
                closeButton : true,
                isLoading : false,
                draggable : true,
                draggablePercent : 60
            });
            unassignedTicketsRecords.refetch();
        },
        onError: () => {
            toast.update(toastId.current, {
                render: "It has a problem",
                theme: "colored",
                type: toast.TYPE.ERROR,
                autoClose: 6000,
                closeButton: true,
                isLoading: false,
                draggable: true,
                draggablePercent: 60
                  })
        }, onSettled : () =>
    {
    }
    });

    const toastId = React.useRef(null);


    function handleSubmit(e, value) {
        e.preventDefault();
        postAssign.mutate({
            ticket: value
        });
        return undefined;
    }

    if (unassignedTicketsRecords.isLoading) {
        return <h2>Loading...</h2>;
    }

    // Show Error message in query of all record on mounting
    if (unassignedTicketsRecords.isError) {
        return <h2 className="text-danger">Error! {unassignedTicketsRecords.error.message}</h2>;
    }



    return (
        <>

            <div className="bg-white w-100 h-auto p-3 rounded-4">
                <div className="row d-flex flex-row justify-content-around">
                    <div className="row">
                        <h5><b>{t("Unassigned messages")}</b></h5>
                        <hr/>
                        <div className="overflow-auto">
                            <table className="table table-responsive table-striped table-hover text-center">
                                <thead>
                                <tr>
                                    <th>{t("User ID")}</th>
                                    <th>{t("Subject")}</th>
                                    <th>{t("Priority")}</th>
                                    <th>{t("Time")}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                {unassignedTicketsRecords.data.data.length > 0 ?
                                    (unassignedTicketsRecords.data.data.map((value, key) => (
                                    <tr key={key}>
                                        <td className="align-middle"><Link className="text-decoration-none text-dark" to={`../ticket/${value.id}`}>
                                            <img className="max-h-2rem rounded-circle me-4 "
                                                 src={import.meta.env.VITE_ASSET_URL + `/public/users/profile/${value.profile}`}/>
                                            {value.user_name}</Link></td>
                                        <td className="align-middle"><Link className="text-decoration-none text-dark" to={`../ticket/${value.id}`}>{value.subject}<i className="fa-solid fa-arrow-up-right-from-square ms-2 text-orange"></i></Link></td>
                                        <td className="align-middle">{value.priority}</td>
                                        <td className="align-middle">{value.created_at}</td>
                                        <td className="align-middle">
                                                <button className="btn btn-orange text-white border-0 rounded-pill px-5" onClick={(e) => handleSubmit(e, value.id)}><i className="fa-solid fa-plus me-2"></i>Assign me</button>
                                        </td>
                                    </tr>))):(
                                    <tr>
                                        <td colSpan="5" className="text-danger">{t("No Ticket Record")}</td>
                                    </tr>)

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
