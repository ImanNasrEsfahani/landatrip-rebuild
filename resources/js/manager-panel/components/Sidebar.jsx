import React from 'react';

import "./sidebar.scss";
import {SidebarContent} from "./SidebarContent";
import SidebarHeader from "./SidebarHeader";
import Main from "./Main";

// import {NavLink} from "react-router-dom";

console.log("Sidebar jsx ");

export default function Sidebar({children}) {

    return(
            <div id="sidebar">
                <div className="header"><SidebarHeader/></div>

                <ul className='sidebarlist'>
                    {SidebarContent.map((val,key)=>{
                        return (
                            <li className="row " key={key}>
                                <div className='icon-container'>{val.icon}</div>
                                <div className='name font'>{val.name}</div>
                            </li>
                        )
                    })}
                    {/*{SidebarContent.map((val,key)=>{*/}
                    {/*    return(*/}
                    {/*        <>*/}
                    {/*            <div>{val.children}</div>*/}
                    {/*        </>*/}
                    {/*    )*/}
                    {/*})}*/}
                </ul>
            </div>

    );
}
