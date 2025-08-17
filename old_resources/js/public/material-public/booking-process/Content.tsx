import * as React from 'react';
import { Box, Container, Grid } from "@mui/material";
import Stepper from "./components/Stepper";
import Sidebar from "./components/Sidebar";
import {useQuery} from "react-query";
import axios from "axios";
import { route } from "../helpers.js";
import Context from './Context.js';
import Step1 from './components/Step1.js';

declare module '@mui/material/Typography' {
    interface TypographyPropsVariantOverrides {
        h2Semibold: true;
        h2Bold: true;
        h3Semibold: true;
        h3Bold: true;
        h4Semibold: true;
        h4Bold: true;
        h5Semibold: true;
        h5Bold: true;
        h6Semibold: true;
        h6Bold: true;
        body1Semibold: true;
        body1Bold: true;
        subtitle1Semibold: true;
        subtitle1Bold: true;
        subtitle2Semibold: true;
        subtitle2Bold: true;
    }
}

const Content = (props) => {

    const groupBookingData = useQuery('groupBookingData',async ()=> {
        const {data} = await axios.get(route("api.public.group.show", {'tour': props.slugs.tour_slug, 'group': props.slugs.group_slug }));
        groupBookingData.data = data.data;
        return groupBookingData
    })

    // if (groupBookingData.isLoading){
    //     return <p>loading</p>
    // }

    // if (groupBookingData.isError){
    //     return <p>error</p>
    // }
    
    return (

        <Box sx={{mt:6 , maxWidth : "1440px"  }} mx={{xs:0, sm:8, md:12 , lg: "auto"}}>
            <Grid container spacing={2}>
                <Context.Provider value={{groupBookingData}}>
                    <Grid item xs={12} md={12} lg={9}>
                        <Stepper/>
                    </Grid>
                    <Grid item display={{xs : "none" , lg : "unset"}} xs={12} md={12} lg={3}>
                        <Sidebar />
                    </Grid>
                </Context.Provider>
            </Grid>
        </Box>
    )
}

export default Content;
