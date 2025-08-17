import React from 'react';
import {NavLink, Link} from "react-router-dom";
import logo from './assets/landabiglogo.svg'

// import "./SidebarHeader.scss";

console.log("SidebarHeader jsx ");

export default function SidebarHeader(){
    return(
        <div id="sidebar-header" className="sidebar-header bg-green text-white border-0 overflow-hidden text-center mt-2 mb-2">
            <img src={logo}/>
        </div>
    );
}
