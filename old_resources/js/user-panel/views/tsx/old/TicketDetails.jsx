import React, {forwardRef, useState} from 'react';
import {useParams,useNavigate} from 'react-router-dom';
import {useQuery, useQueryClient} from "react-query";
import axios from '../../../../axiosConfig';
import {route} from "../../../helpers";
import Picker from '@emoji-mart/react';
import {asUploadButton} from "@rpldy/upload-button";
import Uploads, {useAbortItem} from "@rpldy/tus-uploady";
import Error from "../../../../Error";


export default function TicketDetails() {

    const [input, setInput] = useState("");
    const [showEmojis, setShowEmojis] = useState(false);

    const navigate = useNavigate();

    const custom = [
        {
            searchPosition: 'none',
            previewPosition: 'none',
            showSearch: false,
        }
    ];

    const DivUploadButton = asUploadButton(forwardRef(
        (props, ref) =>
            <div {...props} style={{border: 'none'}}>
                <button className="border-0 bg-transparent"><i className="fa-solid fa-paperclip fs-4 border-0"></i>
                </button>
            </div>
    ));
    const addEmoji = (e) => {
        let sym = e.unified.split("-");
        let codesArray = [];
        sym.forEach((el) => codesArray.push("0x" + el));
        let emoji = String.fromCodePoint(...codesArray);
        setInput(input + emoji);
    };

    const params = useParams();
    const queryClient = useQueryClient();

    const ticketsHeader = useQuery('Tickets', async () => {
        const {data} = await axios.get(route("api.web.v1.teacher-panel.ticket.show", {"ticket": params.id}));
        ticketsHeader.data = data.data;
        console.log(ticketsHeader.data);
        return ticketsHeader;
    });

    const ticketsRecords = useQuery('TicketsRecords', async () => {
        const {data} = await axios.get(route("api.web.v1.teacher-panel.ticket.record.index", {"ticket": params.id}));
        ticketsRecords.data = data.data;
        console.log("ticketsRecords.data");
        console.log(ticketsRecords.data);
        return ticketsRecords;
    });

    if (ticketsRecords.isLoading || ticketsHeader.isLoading) {
        return <h2>Loading...</h2>;
    }

    const handleFormSubmit = (event) => {
        event.preventDefault();
    };    // Show Error message in query of all record on mounting
    if (ticketsRecords.isError) {
        return <Error message={ticketsRecords.error.message}/>;
    }

    return (
        <>
            <div className="w-100 bg-white rounded-4 px-lg-6 px-3 py-4 mb-6">
                <div className="row justify-content-between px-3">
                    <a onClick={() => navigate(-1)} className="col-3 col-md-2"><i
                        className="fa-solid fa-arrow-left fs-8 text-secondary col-3"></i></a>
                    <h4 className="col-21 col-md-18 col-lg-19 d-block text-center"><i
                        className="fa-solid fa-comments me-3"></i>{ticketsHeader.data.data.title}</h4>
                    <button className="col-24 col-md-4 col-lg-3 bg-danger text-white rounded-3 border-0 mb-2 py-2">Close
                        Ticket
                    </button>
                    <hr/>
                </div>

                <div className="w-100 bg-light p-4 rounded-4 d-flex flex-column">
                    {ticketsRecords.data.data.map((value, key) => (
                        <div
                            className={`w-100 w-lg-75  my-2 p-md-5 d-flex ${value.role_user === "User" ? "flex-row-reverse align-self-end" : "flex-row"}`}
                            key={key}>
                            <div className="chat-avatar d-inline-block mx-3">
                                <img className="max-h-3rem rounded-circle "
                                     src={import.meta.env.VITE_APP_URL + `/storage/user/profile/${value.profile}`}
                                     alt={value.alt}/>
                                <div>{value.seen}</div>
                            </div>
                            <div className="chat-body bg-white rounded-4 shadow-sm p-3 d-inline-flex">
                                {value.role_user === "User" ? <div className="chat-content text-end">
                                        <p className="d-inline ms-2 text-green fs-3 w-100">{value.name}<span
                                            className="fs-1 ms-2 text-orange">{value.role_user}</span></p>
                                        <p className="text-muted mt-2">{value.message}</p>
                                        <span className="text-secondary">{value.seen ?
                                            <i className="fa-solid fa-check text-green"></i> :
                                            <i className="fa-solid fa-check text-green fs-1 mx-2"></i>}{value.created_at}</span>
                                    </div> :
                                    <div className="chat-content">
                                        <p className="d-inline ms-2 text-green fs-3 w-100">{value.name}<span
                                            className="fs-1 ms-2 text-orange">{value.role_user}</span></p>
                                        <p className="text-muted mt-2">{value.message}</p>
                                        <span className="text-secondary">{value.created_at}{value.seen ?
                                            <i className="fa-solid fa-check text-green"></i> :
                                            <i className="fa-solid fa-check text-green fs-1 mx-2"></i>}</span>
                                    </div>}
                            </div>
                        </div>
                    ))}
                    <hr/>
                    <div className="w-100 mb-3 ">
                        <form className="w-100 d-flex align-items-center" onSubmit={handleFormSubmit}>
                            <Uploads destination={{url: "https://webhook.site/fd989888-ff93-4071-be17-f8d66a38336c"}}>
                                <DivUploadButton/>
                            </Uploads>

                            <button className="border-0 p-0 bg-transparent" onClick={() => setShowEmojis(!showEmojis)}>
                                <i className="fa-solid fa-face-awesome mx-3 fs-4"></i></button>
                            <div className="position-relative w-n-0rem h-4rem">
                                <div className="position-absolute bottom-100 start-300 start-lg-0">
                                    {showEmojis && (<Picker onEmojiSelect={addEmoji} custom={custom}/>)}
                                </div>
                            </div>

                            <div className="d-flex flex-row p-0 form-control mt-2 w-100 rounded-pill">

                                <input type="text"
                                       className="form-control flex-grow-1 lh-lg w-100 p-2 border-0 rounded-pill"
                                       placeholder="Type a message" value={input}
                                       onChange={(e) => setInput(e.target.value)}/>
                                <i className="fa-solid fa-paper-plane-top text-secondary opacity-95 fs-4 me-3 mt-3 ms-2"></i>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </>
    );
}


