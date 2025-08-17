import React from 'react';
import { createRoot } from 'react-dom/client'

// import Sidebar from "./components/Sidebar";
import TopNavbar from "./components/TopNavbar";
// import Content from "./components/Content";
import {BrowserRouter, BrowserRouter as Router, Route, Routes} from 'react-router-dom';


import './App.css';
import Sidebar from "./components/Sidebar";
import Main from "./components/Main";

console.log("App jsx root");

export default function App(props){
	const lang = props.lang;
    const currentLang = props.currentLang;

    return(
        <React.StrictMode>
            <BrowserRouter>
                <div className="container-fluid position-relative vh-100 w-100 p-0 overflow-auto">
                    <div className="body-overlay"></div>
                    <Sidebar/>
                    <div id="content" className='w-100'>
                        <h1>Manager Panel</h1>
                        {/*<TopNavbar lang={lang} currentLang={currentLang}/>*/}
                        {/*<Content/>*/}
                    </div>
                    <Main/>
                    <TopNavbar/>
                </div>
            </BrowserRouter>
        </React.StrictMode>
    );
}

if(document.getElementById('app')){
    const lang = document.getElementById('app').getAttribute("lang");
    const currentLang = document.getElementById('app').getAttribute("current-lang");
    createRoot(document.getElementById('app')).render(<App lang={lang} currentLang={currentLang}/>)
}
