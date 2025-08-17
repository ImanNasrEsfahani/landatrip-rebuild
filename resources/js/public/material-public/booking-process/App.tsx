import { ThemeProvider } from "@mui/material";
import { QueryClient, QueryClientProvider } from "react-query";
import { ReactQueryDevtools } from "react-query/devtools";
import customTheme from "../custom";
import * as React from 'react';
import Content from "./Content";


export default function App(props) {

    console.log(props.group_slug);

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
            <ThemeProvider theme={customTheme}>
                <QueryClientProvider client={queryClient}>
                        <Content slugs={props}/>
                    <ReactQueryDevtools initialIsOpen={false} />
                </QueryClientProvider>
            </ThemeProvider>
        </>
    )
}



