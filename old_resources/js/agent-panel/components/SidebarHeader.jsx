import React from 'react';
import {Link} from "react-router-dom";
import profile from'./assets/profile.svg'
import {useSelector} from "react-redux";
import {useQuery} from "react-query";
import axios from "@/axiosConfig";
import {route} from "@/agent-panel/helpers";
export default function SidebarHeader(){

    const data = useSelector(state => state.information);

    const SidebarHeaderInfo = useQuery('SidebarHeaderInfo', async () => {
        const {data} = await axios.get(route("api.web.v1.agent-panel.agent-info-header"));
        SidebarHeaderInfo.data = data.data;
        return SidebarHeaderInfo;
    },{refetchInterval:10000});

    return(
        <>
            {SidebarHeaderInfo.data ?
                <div id="sidebar-header" className="sidebar-header bg-deep-sea-green text-white border-0 overflow-hidden mt-2 mb-2">
                    <div className="w-90 mx-auto border border-orange rounded-3 mb-4 row">
                        <div className="col-12 mt-2">
                            <img src={import.meta.env.VITE_ASSET_URL + `/public/users/profile/${SidebarHeaderInfo.data.data.profileImage.url}`} className="w-100 rounded-3"/>
                        </div>
                        <div className="col-12 p-0">
                            <p className="fs-3 fw-bold mt-2">Travel Agency</p>
                            <p className="fs-1 mt-2 mb-0 col-24 text-truncate">{SidebarHeaderInfo.data.data.fname}{SidebarHeaderInfo.data.data.lname}</p>
                            <p className="fs-1">{SidebarHeaderInfo.data.data.location}</p>
                        </div>
                    </div>
                    <div className="menu-bottun d-flex flex-column-reverse flex-md-row justify-content-between px-3 mb-2 mt-5">
                        <Link to="/agent-panel" className="text-white text-decoration-none align-self-center">
                            <i className="text-white opacity-90 fs-3 fa-solid fa-house" />
                            <span className='text fs-2 ms-3'>Dashboard</span>
                        </Link>
                        <button type="button" id="sidebarCollapse" className="d-xl-block d-lg-block d-none bg-transparent border-0 p-0">
                            <i className="fa-solid fa-arrow-left text-white opacity-95 fs-4"></i>
                        </button>
                    </div>
                </div>
                :
                ""
            }

        </>
    );
}
