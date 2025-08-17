import React from 'react';
import {createRoot} from 'react-dom/client';
import {BrowserRouter} from 'react-router-dom';
import {QueryClient, QueryClientProvider} from 'react-query';
import {ReactQueryDevtools} from 'react-query/devtools';
import {ToastContainer} from 'react-toastify';
import Sidebar from './components/Sidebar'

import './App.css';
import TopNavbar from "./components/TopNavbar";
import Content from "./components/Content";
import {Provider} from "react-redux";
import store from "./redux/index";

export default function App(props) {
    const lang = props.lang;
    const currentLang = props.currentLang;

    // Create a client
    const queryClient = new QueryClient({
        defaultOptions: {
            queries: {
                refetchOnWindowFocus: false,
                retry: 5,
                retryDelay: 3000,
                refetchInterval: 60000,
                cacheTime: 1000 * 60 * 60 * 24 // 24 hours
            }
        }
    });

    return (
        <>
            {/*<React.StrictMode>*/}
            <ToastContainer autoClose={6000}/>
            <QueryClientProvider client={queryClient}>
                <BrowserRouter>
                    <div className="container-fluid position-relative vh-100 w-100 p-0 overflow-auto d-flex flex-row-reverse">
                        <div className="body-overlay"></div>
                        <Sidebar id="main-sidebar"/>
                        <div id="content" className="w-100">
                            <TopNavbar lang={lang} currentLang={currentLang}/>
                            <Content/>
                        </div>
                    </div>
                </BrowserRouter>
                <ReactQueryDevtools initialIsOpen={false}/>
            </QueryClientProvider>
            {/*</React.StrictMode>*/}
        </>);
}

if (document.getElementById('app')) {
    const lang = document.getElementById('app').getAttribute("lang");
    const currentLang = document.getElementById('app').getAttribute("current-lang");
    createRoot(document.getElementById('app')).render(<Provider store={store}><App lang={lang} currentLang={currentLang}/></Provider>);
}
