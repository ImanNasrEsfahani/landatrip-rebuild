import React from 'react';
import {NavLink, Link} from "react-router-dom";
import "./SidebarHeader.scss";
import {useDispatch, useSelector} from "react-redux";
import {getInfo} from "../../teacher-panel/redux/info";

console.log("SidebarHeader jsx ");

export default function SidebarHeader() {

    const dispatch = useDispatch();
    const data = useSelector(state => state.information);

    React.useEffect(() => {
        let Info = dispatch(getInfo());
        console.log("dispatch");
        console.log(Info);
    }, [dispatch]);

    return (
        <div id="sidebar-header"
             className="sidebar-header bg-gray-light text-white border-0 overflow-hidden text-center mb-2">
            <div className="w-90 mx-auto border border-1 border-orange m-4 p-3 rounded-4 profile">
                <div>
                    <img className="rounded-4" height="90px" width="90px" src={`${import.meta.env.VITE_ASSET_URL + "/public/user/profile/${data.profile_picture"}`} alt={data.profile_alt}/>
                </div>
                <div className="fs-1 text-center mt-2">
                    <p className="m-1">{data.title}</p>
                    <p className="m-1 overflow-hidden">{data.email}</p>
                    <p className="m-1">{data.location}</p>
                </div>
            </div>
            <div className="menu-bottun d-flex flex-column-reverse flex-md-row justify-content-between px-3 mb-2">
                <Link to="/teacher-panel" className="text-white text-decoration-none align-self-center">
                    <i className="text-white opacity-90 fs-3 fa-solid fa-house"/>
                    <span className='text fs-2 ms-3'>Dashboard</span>
                </Link>
                <button type="button" id="sidebarCollapse"
                        className="d-xl-block d-lg-block d-none bg-transparent border-0 p-0">
                    <i className="fa-solid fa-arrow-left text-white opacity-95 fs-4"></i>
                </button>
            </div>
        </div>
    );
}
