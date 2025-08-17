import React from 'react';

import "./TopNavbar.scss";
import Logo from "./assets/LandaTrip-white.svg";
import Language from "./Language";

console.log("TopNavbar jsx ");

export default function TopNavbar(props){
    const lang = props.lang;
    const currentLang = props.currentLang;


    return(
        <div className="top-navbar bg-gray-light w-100 position-relative">
            <nav className="navbar navbar-dark navbar-expand-md">
                <div className="container-fluid img-fluid">
                    <a className="navbar-brand ms-4" href={import.meta.env.VITE_APP_URL}>
                        <img className="position-relative max-h-15drem" src={ Logo } alt="Landa Trip Logo"/>
                    </a>

                    {/* <button className="d-inline-block d-lg-none ml-auto more-button" type="button"
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span className="material-icons">more_vert</span>
                    </button> */}

                    <div className="collapse navbar-collapse flex-row justify-content-end" id="navbarSupportedContent">
                        <ul className="nav navbar-nav">
                            <li className="dropdown nav-item active">
                                <a href="#" className="nav-link mx-2" data-toggle="dropdown, tooltip" title ="Notification">
                                    <i className="fa-solid fa-bell fs-3 text-white"></i>
                                    <span className="position-absolute top-3 start-0 translate-middle badge rounded-pill bg-warningg">
                                     99+
                                    <span className="visually-hidden">unread messages</span>
                                    </span>
                                </a>
                                <ul className="dropdown-menu">
                                    <li>
                                        <a href="#">You have 5 new messages</a>
                                    </li>
                                    <li>
                                        <a href="#">You're now friend with Mike</a>
                                    </li>
                                    <li>
                                        <a href="#">Wish Mary on her birthday!</a>
                                    </li>
                                    <li>
                                        <a href="#">5 warnings in Server Console</a>
                                    </li>

                                </ul>
                            </li>
                            <li className="nav-item">
                                <a className="nav-link  mx-2"data-toggle = "tooltip"
                                   title ="Apps" href="#">
                                    <i className="fa-solid fa-grid-3 fs-3 text-white"></i>
                                </a>
                            </li>
                            <li className="nav-item mx-2">
                                <a className="nav-link"data-toggle = "tooltip"
                                   title ="User" href="#">
                                    <i className="fa-solid fa-user fs-3 text-white"></i>
                                </a>
                            </li>
                            <li className="nav-item mx-2">
                                <a className="nav-link"data-toggle = "tooltip"
                                   title ="Settings" href="#">
                                    <i className="fa-solid fa-gear fs-3 text-white"></i>
                                </a>
                            </li>
                        </ul>
                        <Language lang={lang} currentLang={currentLang}/>
                    </div>

                    <button className="navbar-toggler more-button" type="button"
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation" id="humburger">
                        <span className="navbar-toggler-icon"></span>
                    </button>
                    {/*Language*/}

                </div>
            </nav>
        </div>
    );
}
