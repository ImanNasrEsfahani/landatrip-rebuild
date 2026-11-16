import React from 'react';
import {useDispatch, useSelector} from "react-redux";
import axios from "../../axiosConfig";
import {route} from "../helpers";
import {useMutation, useQuery} from "react-query";
import {toast} from "react-toastify";
import {getInfo} from "./../redux/info";

export default function AgentLogo() {
    //Redux Utility
    const dispatch = useDispatch();
    const data = useSelector(state => state.information);
    //Toast
    const toastId = React.useRef(null);

    const AgentLogo = useQuery('AgentLogo', async () => {
        const {data} = await axios.get(route("api.web.v1.agent-panel.agent-info"));
        AgentLogo.data = data.data;
        dispatch(getInfo(AgentLogo.data));
        return AgentLogo;
    },{refetchInterval:10000});

    // Sending Logout Request
    const Logout = useMutation(async () => {
        toastId.current = toast.loading("Logging out...", {
            closeButton: true, theme: "colored", type: toast.TYPE.INFO
        });
        const response = await axios.post(route("logout"));
        return response.data;
    }, {
        onSuccess: data => {
            toast.update(toastId.current, {
                render: "Logged out",
                theme: "colored",
                type: toast.TYPE.SUCCESS,
                autoClose: 6000,
                closeButton: true,
                isLoading: false,
                draggable: true,
                draggablePercent: 60
            });
            setTimeout(function () {
                window.location.href = import.meta.env.VITE_APP_URL;
            }, 1000);
        }, onError: () => {
            toast.update(toastId.current, {
                render: "It has a problem on editing",
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

    const handleLogout = function (e) {
        e.preventDefault();
        Logout.mutate();
    }

    if (data.loading) {
        return <div>Loading...</div>;
    }
    return (
        <div>
            <div className="d-flex flex-row">
                    { data.data ?
                        <div className="dropdown">
                        <a className="btn bg-transparent border-0 dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img className="rounded-pill max-w-2rem"
                             src={`/storage/users/profile/${data.data.profile_picture}`}
                             alt={data.data.profile_alt} />
                        <span className="text-white mx-1">{data.data.firstName} {data.data.lastName}</span>
                    </a>
                        <ul className="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li className="d-flex justify-content-center">
                                <a href={ route("profile", {user: data.data.slug})} className="mb-3 text-decoration-none text-orange"><i className="fa-solid fa-id-card text-green me-2 fs-4"></i>Profile page</a>
                            </li>
                            <li className="d-flex justify-content-center"><a href={("wallet")} className="text-decoration-none row"><i className="fa-solid fa-wallet text-green me-2 fs-4 col p-0"></i><p className="text-orange col p-0">Wallet</p></a></li>
                            <li className="border-bottom border-1 text-center">{data.data.USD > 0 ? <div className="text-green">{data.data.USD} <span className="text-dark">USD</span></div> : <></>}</li>
                            <li className="border-bottom border-1 text-center py-1">{data.data.EUR > 0 ? <div className="text-green">{data.data.EUR} <span className="text-dark">EUR</span></div> : <></>}</li>
                            <li className="border-bottom border-1 text-center py-1">{data.data.CAD > 0 ? <div className="text-green">{data.data.CAD} <span className="text-dark">CAD</span></div> : <></>}</li>
                            <li className="border-bottom border-1 text-center py-1">{data.data.Rial > 0 ? <div className="text-green">{data.data.Rial} <span className="text-dark">Rial</span></div> : <></>}</li>
                            <li className="text-center mt-1"><a href="#" className="fs-1 text-decoration-none text-green fs-2 mb-1 mx-auto" onClick={(e) => handleLogout(e)}> <i className="fa-solid fa-arrow-right-from-bracket text-green fs-4 me-1 pe-auto"></i>Sign Out</a></li>
                        </ul>
                        </div>
                        : ""}
            </div>
        </div>
    );
}
