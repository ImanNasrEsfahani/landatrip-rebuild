import React from "react";
import customTheme from "../custom"
import { Grid, ThemeProvider } from "@mui/material";

import Main from "./Main";
import Sidebar from "./Sidebar";

const Filter = () => {
    return (
        <ThemeProvider theme={customTheme}>
            <Grid container spacing={1} sx={{mt:6 , maxWidth : "1440px"  }} mx={{xs:0, sm:8, md:12 , lg: "auto"}}>
                <Grid item xs={3}>
                    <Sidebar/>
                </Grid>
                <Grid item xs={9}>
                    <Main/>
                </Grid>
            </Grid>
        </ThemeProvider>
    )
}

export default Filter;