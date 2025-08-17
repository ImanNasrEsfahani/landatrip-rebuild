import React, {forwardRef, useState} from 'react';
import {useNavigate, useParams} from 'react-router-dom';
import {useMutation, useQuery, useQueryClient} from "react-query";
import axios from '../../../axiosConfig';
import {route} from "../../helpers";
import Picker from '@emoji-mart/react';
import {asUploadButton} from "@rpldy/upload-button";
import Uploads, {useAbortItem} from "@rpldy/tus-uploady";
import Error from "../../../Error";
import {useFormik} from "formik";
import * as yup from "yup";
import {toast} from "react-toastify";


export default function TicketDetails() {

    const navigate = useNavigate();
    const toastId = React.useRef(null);

    const custom = [
        {
            searchPosition: 'none',
            previewPosition: 'none',
            showSearch: false,
        }
    ];
    let initialValue = {
        message: ""
    }
    let initialValue2 = {
        rating:""
    }

    const formik = useFormik({
        initialValues: initialValue, validationSchema: yup.object().shape({
            message: yup.string().required().max(450)
        }), onSubmit: values => {
            postTicketRecord.mutate({
                message: formik.values.message
            });
            window.setTimeout(() => {
                ticketsRecords.refetch()
            }, 300);
            formik.resetForm();
        }, onError: () => {
            toast.update(toastId.current, {
                render: "It has a problem to send message",
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

    const formik2 = useFormik({
        initialValues: initialValue2, validationSchema: yup.object().shape({
            // rating: yup.string().required("").max()
        }), onSubmit: values => {
            postCloseTicket.mutate();
            window.setTimeout(() => {
                ticketsHeader.refetch()
            }, 300);
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
        }, onSettle: () => {
        }
    });

    const postTicketRecord = useMutation(async (data) => {
        const response = await axios.post(route("api.web.v1.admin-panel.record.store", {"ticket": params.id}), data);
        return response.data;
    });

    const postCloseTicket = useMutation(async () => {
        toastId.current = toast.loading("Posting...", {
            closeButton : true, theme : "colored", type : toast.TYPE.INFO
        });
        const response = await axios.post(route("api.web.v1.admin-panel.ticket.closing.update", {"ticket": params.id}));
        return response.data;
    },{
        onSuccess : data => {
            toast.update(toastId.current, {
                render : "Ticket closed",
                theme : "colored",
                type : toast.TYPE.SUCCESS,
                autoClose : 6000,
                closeButton : true,
                isLoading : false,
                draggable : true,
                draggablePercent : 60
            });
            ticketsHeader.refetch();
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

    const DivUploadButton = asUploadButton(forwardRef(
        (props, ref) =>
            <div {...props} style={{border: 'none'}}>
                <button className="border-0 bg-transparent"><i
                    className="fa-solid fa-paperclip fs-4 border-0 px-2 text-orange"></i>
                </button>
            </div>
    ));
    const addEmoji = (e) => {
        let sym = e.unified.split("-");
        let codesArray = [];
        sym.forEach((el) => codesArray.push("0x" + el));
        let emoji = String.fromCodePoint(...codesArray);
        formik.setFieldValue("message", formik.values.message + emoji + " ");
    };

    const params = useParams();
    const queryClient = useQueryClient();

    const ticketsHeader = useQuery('Tickets', async () => {
        const {data} = await axios.get(route("api.web.v1.admin-panel.tickets.show", {"ticket": params.id}));
        ticketsHeader.data = data.data;
        console.log(ticketsHeader.data);
        return ticketsHeader;
    });


    // window.scroll({
    //     top: document.body.scrollHeight,
    //     behavior: 'smooth'
    // });


    const ticketsRecords = useQuery('TicketsRecords', async () => {
        const {data} = await axios.get(route("api.web.v1.admin-panel.record.index", {"ticket": params.id}));
        ticketsRecords.data = data.data;
        console.log("ticketsRecords.data");
        console.log(ticketsRecords.data);
        return ticketsRecords;
    });

    if (ticketsRecords.isLoading || ticketsHeader.isLoading) {
        return <h2>Loading...</h2>;
    }

    if (ticketsRecords.isError) {
        return <Error message={ticketsRecords.error.message}/>;
    }

    const handleMessage = (value) => {
        if (value !== formik.values.message) {
            formik.setFieldValue("message", value);
        }
    }
    console.log( ticketsHeader.data.data.status);
    return (
        <>
            <div className="w-100 bg-white rounded-4 px-lg-6 px-3 py-4 mb-6">
                <div className="row justify-content-between px-3">
                    <a onClick={() => navigate(-1)} className="col-3 col-md-2"><i
                        className="fa-solid fa-arrow-left fs-8 text-secondary col-3"></i></a>
                    <h4 className="col-21 col-md-18 col-lg-19 d-block text-center"><i
                        className="fa-solid fa-comments me-3 text-orange"></i>{ticketsHeader.data.data.title}</h4>
                    {ticketsHeader.data.data.status === "Closed" || ticketsHeader.data.data.status === "Rating"|| ticketsHeader.data.data.status === "New" ? <div className="col-md-4 col-lg-3"></div>
                        :<button className="col-24 col-md-4 col-lg-3 bg-danger text-white rounded-3 border-0 mb-2 py-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Close
                        Ticket
                    </button>}

                    <hr/>
                </div>

                <div className="w-100 bg-light p-sm-4 p-2 rounded-4 d-flex flex-column">
                    {ticketsRecords.data.data.map((value, key) => (
                        <div
                            className={`w-100 w-lg-75  my-2 p-md-5 d-flex ${value.role_user === "Admin" ? "flex-row-reverse align-self-end" : "flex-row"}`}
                            key={key}>
                            <div className="chat-avatar d-inline-block mx-3">
                                <img className="max-h-3rem rounded-circle "
                                     src={import.meta.env.VITE_ASSET_URL + `/public/users/profile/${value.profile}`}
                                     alt={value.alt}/>
                                <div>{value.seen}</div>
                            </div>
                            <div className="chat-body bg-white rounded-4 shadow-sm p-3 d-inline-flex">
                                {value.role_user === "Admin" ? <div className="chat-content text-end">
                                        <p className="d-inline ms-2 text-green fs-3 w-100">{value.name}<span
                                            className="fs-1 ms-2 text-orange">{value.role_user}</span></p>
                                        <p className="text-muted mt-2 text-break">{value.message}</p>
                                        <span className="text-secondary">{value.seen ?
                                            <i className="fa-solid fa-check text-green"></i> :
                                            <i className="fa-solid fa-check text-green fs-1 mx-2"></i>}{value.created_at}</span>
                                    </div> :
                                    <div className="chat-content">
                                        <p className="d-inline ms-2 text-green fs-3 w-100">{value.name}<span
                                            className="fs-1 ms-2 text-orange">{value.role_user}</span></p>
                                        <p className="text-muted mt-2 text-break">{value.message}</p>
                                        <span className="text-secondary">{value.created_at}{value.seen ?
                                            <i className="fa-solid fa-check text-green"></i> :
                                            <i className="fa-solid fa-check text-green fs-1 mx-2"></i>}</span>
                                    </div>}
                            </div>
                        </div>
                    ))}

                    {
                        ticketsHeader.data.data.status === "Closed" || ticketsHeader.data.data.status === "Rating" ? <p className="text-center fs-5 text-secondary"><i className="fa-solid fa-hexagon-xmark me-2 text-danger"></i>This ticket is closed</p> :
                            <div className="w-100">
                                <hr/>
                                <form className="w-100 d-flex align-items-center" onSubmit={formik.handleSubmit}>
                                    <Uploads destination={{url: "https://webhook.site/fd989888-ff93-4071-be17-f8d66a38336c"}}>
                                        <DivUploadButton/>
                                    </Uploads>
                                    <button className="border-0 p-0 bg-transparent dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        <i className="fa-solid fa-face-awesome ms-md-3 fs-5 text-orange"></i></button>
                                    <div className="position-relative w-n-0rem h-4rem">
                                        <div className="dropdown-menu p-0">
                                            {<Picker onEmojiSelect={addEmoji} custom={custom}/>}
                                        </div>
                                    </div>

                                    <div className="d-flex flex-row p-0 form-control w-100 rounded-pill">

                                        <input type="text"
                                               name="message"
                                               className="form-control ps-4 pe-1 flex-grow-1 lh-lg w-100 p-2 border-0 rounded-pill"
                                               placeholder="Type a message"
                                               value={formik.values.message}
                                               onChange={(e) => handleMessage(e.target.value)}/>

                                        <button className="border-0 bg-transparent pe-2"
                                                disabled={!(formik.isValid && formik.dirty)}><i
                                            className={`fa-solid fa-paper-plane-top  opacity-95 fs-5 me-1 ${formik.isValid && formik.dirty ? "text-orange" : "text-secondary"}`}></i>
                                        </button>

                                    </div>
                                </form>
                            </div>}

                </div>
                <div className="modal fade" id="exampleModal" tabIndex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                        <div className="modal-dialog modal-dialog-centered">
                            <div className="modal-content p-4 text-center">
                                <p className="fs-6 fw-bolder">Are you certain about closing this ticket!</p>
                                <div className="">
                                    <div className="modal-footer justify-content-evenly">
                                        <button type="button" className="btn btn-danger w-30" data-bs-dismiss="modal">Close</button>
                                        <button className="btn btn-green w-30" onClick={()=> postCloseTicket.mutate()} data-bs-dismiss="modal">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </>
    );
}


