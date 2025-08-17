import React, {useState, useEffect} from 'react';
import {Link} from 'react-router-dom';
import {useDispatch, useSelector} from "react-redux";
import axios from "../../axiosConfig";
import {route} from "../helpers";
import {useMutation, useQueryClient} from "react-query";
import {toast} from "react-toastify";
import {getInfo} from "../redux/info";
import './userlogo.css'

export default function UserLogo() {
    const dispatch = useDispatch();
    const data = useSelector(state => state.information);
    const loading = useSelector(state => state.loading);
    const error = useSelector(state => state.error);

    const toastId = React.useRef(null);

    // Access the client
    const queryClient = useQueryClient();

    React.useEffect(() => {
        let Info = dispatch(getInfo());
        console.log("dispatch");
        console.log(Info);
    }, [dispatch]);
    console.log(data);

    // Sending Logout Request
    const logout = useMutation(async () => {
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
        logout.mutate();
    }

    if (loading) {
        return <div>Loading...</div>;
    }

    if (error) {
        return <div>{error}</div>;
    }

    if (!data) {
        return null;
    }

    return (
        <div>
            <div className="d-flex flex-row">
                <div className="dropdown">
                    <a className="btn bg-transparent border-0 dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img className="rounded-pill max-w-2rem"
                             src={`${import.meta.env.VITE_APP_URL}/storage/user/profile/${data.profile_picture}`}
                             alt={data.profile_alt}/>
                        <span className="text-white mx-1">{data.firstName} {data.lastName}</span>
                    </a>

                    <ul className="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li className="d-flex justify-content-center">
                            <a href={ route("profile.show", {user: data.slug})} className="text-decoration-none">Profile page</a>
                        </li>
                        <li className="d-flex justify-content-center"><i className="fa-solid fa-wallet text-green me-2 fs-4"></i>
                            <p className="">Wallet</p>
                        </li>
                        <li className="border-bottom border-1 text-center">{data.USD > 0 ? <div className="text-green">{data.USD} <span className="text-dark">USD</span></div> : <></>}</li>
                        <li className="border-bottom border-1 text-center py-1">{data.EUR > 0 ? <div className="text-green">{data.EUR} <span className="text-dark">EUR</span></div> : <></>}</li>
                        <li className="border-bottom border-1 text-center py-1">{data.CAD > 0 ? <div className="text-green">{data.CAD} <span className="text-dark">CAD</span></div> : <></>}</li>
                        <li className="border-bottom border-1 text-center py-1">{data.Rial > 0 ? <div className="text-green">{data.Rial} <span className="text-dark">Rial</span></div> : <></>}</li>
                        <li className="text-center mt-1"><a href="#" className="fs-1 text-decoration-none text-green fs-2 mb-1 mx-auto" onClick={(e) => handleLogout(e)}> <i className="fa-solid fa-arrow-right-from-bracket text-green fs-4 me-1 pe-auto"></i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    );
}
