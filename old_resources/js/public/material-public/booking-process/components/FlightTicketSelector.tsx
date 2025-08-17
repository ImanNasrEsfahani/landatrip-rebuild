import React, { useEffect, useState } from "react";
import 'animate.css';

import { Box, Button, Dialog, DialogContent, Divider, Grid, IconButton, Modal, Tab, Tabs, Typography } from "@mui/material";
import CloseIcon from '@mui/icons-material/Close';
import AirplanemodeActiveIcon from '@mui/icons-material/AirplanemodeActive';
import Brightness1Icon from '@mui/icons-material/Brightness1';
import CheckCircleOutlineIcon from '@mui/icons-material/CheckCircleOutline';
import ArrowForwardIosIcon from '@mui/icons-material/ArrowForwardIos';
import ArrowBackIosNewIcon from '@mui/icons-material/ArrowBackIosNew';


import customTheme from '../../custom';
import FlightTicketSelectorTabInformation from './FlightTicketSelectorTabInformation';
import FlightTicketSelectorTabCancelation from './FlightTicketSelectorTabCancelation';
import FlightTicketSelectorTabTerms from './FlightTicketSelectorTabTerms';
import FlightTicketSelectorTabLuggage from './FlightTicketSelectorTabLuggage';
import ModalPassengerInformation from './ModalPassengerInformation';




const theme : any = customTheme.palette;

// declare module '@mui/material/Typography' {
//     interface TypographyPropsVariantOverrides {
//         H2Bold: true;
//         Subtitle1Bold: true;
//         H6Semibold: true;
//         Subtitle1Semibold: true;
//         h5Semibold: true;
//         Subtitle2Semibold: true;
//         H4Semibold:true;
//         H5Bold : true;
//         h4Bold : true;
//     }
// }

const style = {
    position: 'absolute' as 'absolute',
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)',
    width: "80vw",
    bgcolor: 'background.paper',
    boxShadow: 24,
    p: 2,
    borderRadius: "12px"
};


interface TabPanelProps {
    children?: React.ReactNode;
    index: number;
    value: number;
  }

  function CustomTabPanel(props: TabPanelProps) {
    const { children, value, index, ...other } = props;

    return (
      <div
        role="tabpanel"
        hidden={value !== index}
        id={`simple-tabpanel-${index}`}
        aria-labelledby={`simple-tab-${index}`}
        {...other}
      >
        {value === index && (
          <Box sx={{ p: 3 }}>
            <Typography>{children}</Typography>
          </Box>
        )}
      </div>
    );
  }

  function a11yProps(index: number) {
    return {
      id: `simple-tab-${index}`,
      'aria-controls': `simple-tabpanel-${index}`,
    };
  }




const FlightTicketSelector = ({open , handleClose ,flightOffers ,data}) => {

    const [value, setValue] = React.useState(0);
    const [openModalPassenger, setOpenModalPassenger] = React.useState(false);

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
      setValue(newValue);
    }


    const handleOpenModalPassenger = () => {
        setOpenModalPassenger(true)
        handleClose()
    };
    const handleEdit = ()=>{
        setOpenModalPassenger(true)
    }

    const handleCloseModalPassenger = () => {
        setOpenModalPassenger(false)
        // window.localStorage.removeItem("ticketInfo")
    };

    const adults = flightOffers?.travelerPricings?.filter((item)=>item.travelerType === "ADULT")
    const children = flightOffers?.travelerPricings?.filter((item)=>item.travelerType === "CHILD")

    return (
        <div>
            <Modal
                open={open}
                aria-labelledby="modal-modal-title"
                aria-describedby="modal-modal-description"
            >
                <Box sx={style}>
                    <Grid container sx={{display : "flex" }}>
                        <Grid item lg={9}>
                        <Box sx={{ width: '100%' }}>
                            <Box sx={{ borderBottom: 1, borderColor: 'divider' }}>
                                <Tabs value={value} onChange={handleChange} aria-label="basic tabs example">
                                <Tab sx={{fontSize : "16px" , fontStyle: "normal", fontWeight: "600", lineHeight: "24px" , textTransform : "none"}} label="Information" {...a11yProps(0)} />
                                <Tab sx={{fontSize : "16px" , fontStyle: "normal", fontWeight: "600", lineHeight: "24px" , textTransform : "none"}} label="Cancelation" {...a11yProps(1)} />
                                <Tab sx={{fontSize : "16px" , fontStyle: "normal", fontWeight: "600", lineHeight: "24px" , textTransform : "none"}} label="Terms & Condition" {...a11yProps(2)} />
                                <Tab sx={{fontSize : "16px" , fontStyle: "normal", fontWeight: "600", lineHeight: "24px" , textTransform : "none"}} label="Luggage" {...a11yProps(3)} />
                                </Tabs>
                            </Box>
                                <CustomTabPanel value={value} index={0}>
                                    <FlightTicketSelectorTabInformation info={flightOffers?.itineraries} duration={data?.duration}/>
                                </CustomTabPanel>
                                <CustomTabPanel value={value} index={1}>
                                    <FlightTicketSelectorTabCancelation/>
                                </CustomTabPanel>
                                <CustomTabPanel value={value} index={2}>
                                    <FlightTicketSelectorTabTerms/>
                                </CustomTabPanel>
                                <CustomTabPanel value={value} index={3}>
                                    <FlightTicketSelectorTabLuggage/>
                                </CustomTabPanel>
                            </Box>
                            </Grid>
                         <Grid item lg={3} sx={{borderLeft : "2px solid" , borderColor : "#0000001f" , pl : 2 , display :"flex" , flexDirection : "column" , justifyContent : "space-between"}}>
                            <Box>
                                <Box sx={{display : "flex" , justifyContent : "space-between" , alignItems : "center"}}>
                                    <Typography component="p" variant="subtitle2" sx={{color : theme.gray.tone2}}>{data?.numberOfBookableSeats} Seats Available</Typography>
                                    <IconButton
                                        aria-label="close"
                                        onClick={handleClose}
                                        sx={{
                                            color: "red",
                                        }}
                                    >
                                        <CloseIcon />
                                    </IconButton>
                                </Box>
                                <Box sx={{display : "flex" , justifyContent : "space-between" , alignItems : "center" , mt : 3}}>
                                    <Typography variant="h6">Adult ({adults?.length})</Typography>
                                    <Typography variant="H5Semibold">{adults && adults?.length !== 0 ? parseInt(adults[0]?.price?.total) : 0}</Typography>
                                </Box>
                                <Box sx={{display : "flex" , justifyContent : "space-between" , alignItems : "center" , my:2}}>
                                    <Typography variant="h6">Under 15 ({children?.length})</Typography>
                                    <Typography variant="H5Semibold">{children && children?.length !== 0 ? parseInt(children[0]?.price?.total) : 0}</Typography>
                                </Box>
                                {/*<Box sx={{display : "flex" , justifyContent : "space-between" , alignItems : "center"}}>*/}
                                {/*    <Typography variant="h6">Infant</Typography>*/}
                                {/*    <Typography variant="H5Semibold">$100</Typography>*/}
                                {/*</Box>*/}
                                <Divider sx={{width : "100%" , color : theme.gray.main , my:3}}/>
                                <Box sx={{display : "flex" , justifyContent : "space-between" , alignItems : "center"}}>
                                    <Typography variant="h6">Total</Typography>
                                    <Typography sx={{color : theme.primary.main}} variant="H5Semibold">{flightOffers ? parseInt(flightOffers.price.total) : ""}</Typography>
                                </Box>
                            </Box>
                            <Button onClick={handleOpenModalPassenger} variant="contained" sx={{width : "100%" , textTransform : "none" , mt : "auto", borderRadius : "12px" }}>
                                <Typography component="p" variant="Subtitle2Semibold">Select Flight</Typography>
                            </Button>
                        </Grid>
                    </Grid>
                </Box>
            </Modal>
            <ModalPassengerInformation handleEdit={handleEdit} openModalPassenger={openModalPassenger} handleCloseModalPassenger={handleCloseModalPassenger} info={flightOffers} data={data}
            adults={adults ? adults[0]?.price?.total : ""} children={children ? children[0]?.price?.total : ""}/>
        </div>
    )
}

export default FlightTicketSelector;
