import React from "react";
import { createRoot } from "react-dom/client";
import customTheme from "./custom";
import { ThemeProvider } from "@mui/material";
import {BrowserRouter} from "react-router-dom";
import { QueryClient, QueryClientProvider } from "react-query";
import { ReactQueryDevtools } from "react-query/devtools";
import { Provider } from "react-redux";
import store from "./redux";
import Panel from "./components/Panel";

import "./App.css";
console.log("App jsx root");

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
                cacheTime: 1000 * 60 * 60 * 24, // 24 hours
            },
        },
    });

    return (
        <>
            {/*<React.StrictMode>*/}
            <ThemeProvider theme={customTheme}>
                <QueryClientProvider client={queryClient}>
                    <BrowserRouter>
                        <Panel />
                    </BrowserRouter>
                    <ReactQueryDevtools initialIsOpen={false} />
                </QueryClientProvider>
            </ThemeProvider>
            {/*</React.StrictMode>*/}
        </>
    );
}

if (document.getElementById("app")) {
    const lang = document.getElementById("app").getAttribute("lang");
    const currentLang = document
        .getElementById("app")
        .getAttribute("current-lang");
    createRoot(document.getElementById("app")).render(
        <Provider store={store}>
            <App lang={lang} currentLang={currentLang} />
        </Provider>
    );
}
