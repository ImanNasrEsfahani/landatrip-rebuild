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


const theme : any = customTheme.palette;

declare module '@mui/material/Typography' {
    interface TypographyPropsVariantOverrides {
        H2Bold: true;
        Subtitle1Bold: true;
        H6Semibold: true;
        Subtitle1Semibold: true;
        H5Semibold: true;
        Subtitle2Semibold: true;
        H4Semibold:true;
        H5Bold : true;
    }
}

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


const classA = [
    {
        id: "economy",
        class: "Economy",
        price: "$500",
    },
    {
        id: "business",
        class: "Business",
        price: "$2000",
    },
    {
        id: "first",
        class: "First",
        price: "$4000",
    },
];

const economy = [
    {
        id : 1,
        businessKey : "Business Comfort",
        time : "4 Seats Left",
        price : 500,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 2,
        businessKey : "Business Comfort",
        time : "4 Seats Left",
        price : 600,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 31,
        businessKey : "Business Comfort",
        time : "4 Seats Left",
        price : 700,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 33,
        businessKey : "Business Comfort",
        time : "4 Seats Left",
        price : 800,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 34,
        businessKey : "Business Comfort",
        time : "4 Seats Left",
        price : 900,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 3,
        businessKey : "Business Comfort",
        time : "4 Seats Left",
        price : 10000,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    }
]

const business = [
    {
        id : 4,
        businessKey : "Business Comfort",
        time : "6 Seats Left",
        price : 1,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 5,
        businessKey : "Business Comfort",
        time : "6 Seats Left",
        price : 2,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 6,
        businessKey : "Business Comfort",
        time : "6 Seats Left",
        price : 3,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 66,
        businessKey : "Business Comfort",
        time : "6 Seats Left",
        price : 4,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
            {option : "HLounge access included"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 66,
        businessKey : "Business Comfort",
        time : "6 Seats Left",
        price : 5,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 85,
        businessKey : "Business Comfort",
        time : "6 Seats Left",
        price : 6,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 85,
        businessKey : "Business Comfort",
        time : "6 Seats Left",
        price : 7,
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
]

const first = [
    {
        id : 7,
        businessKey : "Business Comfort",
        price : 4066,
        time : "7 Seats Left",
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 8,
        businessKey : "Business Comfort",
        price : 4088,
        time : "7 Seats Left",
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    },
    {
        id : 9,
        businessKey : "Business Comfort",
        price : 4012,
        time : "7 Seats Left",
        option : [
            {option : "Flexibility to make 2 changes"},
            {option : "Cancellation within 24hrs of booking without fees"},
            {option : "Checked baggage: 40 kg"},
            {option : "Hand baggage: 2 pieces, 15 kg total"},
            {option : "HLounge access included"},
        ]
    }
]


function RenderBoxes(items , isClicked) {
    return (
        items.map((item, index) => (
            <Box className={`animate__animated ${isClicked && "animate__backInUp"}`} key={index} sx={{ p: 2, maxWidth: "21.6rem", borderRadius: "16px", bgcolor: theme.gray.tint3 }}>
                <Typography sx={{ color: theme.gray.tone2 }} variant="subtitle2" component={"p"}>
                    {item.time}
                </Typography>
                <Box sx={{ mt: 1, display: "flex", justifyContent: "space-between", alignItems: "center" }}>
                    <Typography variant="h6" component="h6">{item.businessKey}</Typography>
                    <Typography sx={{ color: theme.primary.main }} variant="H4Semibold" component="h4">{`$ ${item.price}`}</Typography>
                </Box>
                <Button variant="outlined" sx={{ my: 2, textTransform: "none", width: "100%", py: 2, borderRadius: "12px" }}>
                    <Typography sx={{ color: theme.primary.main }} component="p" variant="Subtitle1Semibold">Select Fare</Typography>
                </Button>
                <Typography sx={{ color: theme.gray.tone3 }} component="p" variant="subtitle2">
                    Benefits and fees per passenger
                </Typography>
                <Box ml={1} mt={2}>
                    {item.option.map((optionItem, optionIndex) => (
                        <Box key={optionIndex} display="flex" alignItems="center">
                            <CheckCircleOutlineIcon fontSize="small" sx={{ color: theme.primary.main }} />
                            <Typography ml={1} variant="subtitle1" component="p">{optionItem.option}</Typography>
                        </Box>
                    ))}
                </Box>
            </Box>
        ))
    )
}

const FlightTicketSelector = ({open , handleClose ,flightOffers}) => {
    console.log(flightOffers)
    const [selectedBox, setSelectedBox] = useState(0);
    const [currentCardIndex, setCurrentCardIndex] = useState(0);
    const [currentCardBusiness, setCurrentCardBusiness] = useState(0);
    const [currentCardFirst, setCurrentCardFirst] = useState(0);
    const [isClicked, setIsClicked] = useState(false);


    // ----------------------animation-----------------------------
    const handleClick = () => {
        setIsClicked(true);
        setTimeout(() => setIsClicked(false), 1000);
    };
    // ---------------------- end animation-----------------------------


    const handleBoxClick = (index) => {
        setSelectedBox(index);
    };



    // ------------------slider for Economy ----------------------------
    useEffect(()=>{
        if (currentCardIndex > economy.length - 1) {
            setCurrentCardIndex(0);
        }
    },[currentCardIndex])

    const handleNextEconomy = () => {
        if (currentCardIndex <= economy.length - 1) {
            setCurrentCardIndex(window.screen.width <= 768 && window.screen.width > 425 ? currentCardIndex+2 : window.screen.width <= 425 ? currentCardIndex+1 : currentCardIndex+3);
            handleClick()
        }
    };
    const handleBackEconomy = () => {
        const newCurrentCardEconomy = window.screen.width <= 768 && window.screen.width > 425 ? currentCardIndex-2 : window.screen.width <= 425 ? currentCardIndex-1 : currentCardIndex-3;
        if (newCurrentCardEconomy >= 0){
            setCurrentCardIndex(newCurrentCardEconomy)
            handleClick();
        }else{
            setCurrentCardIndex(0)
        }
    };
    // ------------------end slider for Economy ------------------------


    // ------------------slider for business ----------------------------
    useEffect(()=>{
        if (currentCardBusiness > business.length - 1) {
            setCurrentCardBusiness(0);
        }
    },[currentCardBusiness])

    const handleNextBusiness = () => {
        if (currentCardBusiness <= business.length - 1) {
            setCurrentCardBusiness(window.screen.width <= 768 && window.screen.width > 425 ? currentCardBusiness+2 : window.screen.width <= 425 ? currentCardBusiness+1 : currentCardBusiness+3);
            handleClick()
        }
    };
    const handleBackBusiness = () => {
        const newCurrentCardBusiness = window.screen.width <= 768 && window.screen.width > 425 ? currentCardBusiness-2 : window.screen.width <= 425 ? currentCardBusiness-1 : currentCardBusiness-3;
        if (newCurrentCardBusiness >= 0){
            setCurrentCardBusiness(newCurrentCardBusiness)
            handleClick();
        }else{
            setCurrentCardBusiness(0)
        }
    };
    // ------------------end slider for business ------------------------

    // ------------------slider for first ----------------------------
    useEffect(()=>{
        if (currentCardFirst > first.length - 1) {
            setCurrentCardFirst(0);
        }
    },[currentCardFirst])

    const handleNextFirst = () => {
        if (currentCardFirst <= first.length - 1) {
            setCurrentCardFirst(window.screen.width <= 768 && window.screen.width > 425 ? currentCardFirst+2 : window.screen.width <= 425 ? currentCardFirst+1 : currentCardFirst+3);
            handleClick()
        }
    };

    const handleBackFirst = () => {
        const newCurrentCardFirst = window.screen.width <= 768 && window.screen.width > 425 ? currentCardFirst-2 : window.screen.width <= 425 ? currentCardFirst-1 : currentCardFirst-3;
        if (newCurrentCardFirst >= 0){
            setCurrentCardFirst(newCurrentCardFirst)
            handleClick();
        }else{
            setCurrentCardFirst(0)
        }
    };
    // ------------------end slider for first ------------------------

    return (
        <div>
            <Modal
                open={open}
                aria-labelledby="modal-modal-title"
                aria-describedby="modal-modal-description"
            >
                <Box sx={style}>
                    <Box display={"flex"} justifyContent={"end"}>
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
                    <Box className = "scrollbarInputs" sx={{overflow : "auto" , maxHeight : "85vh" , pr:1}}>
                        <Grid container spacing={3}>
                            <Grid item xs={12} md={6}>
                                <Grid container sx={{display : "flex",justifyContent : "center" , alignItems : "center", height : "100%"}} spacing={2}>
                                    <Grid item order={{xs: 2, sm : "unset"}} xs={6} sm={2} sx={{display : "flex",justifyContent : "center"  , flexDirection : 'column' , height : "100%" , alignItems : "center"}} >
                                        <Typography component="p" variant='Subtitle1Bold'>05:10</Typography>
                                        <Typography component="p" variant='subtitle1'>Tehran</Typography>
                                    </Grid>
                                    <Grid item order={{xs: 1, sm : "unset"}} xs={12} sm={8} sx={{display : "flex" , justifyContent : "center", alignItems : "center" , flexDirection : "column",  height : "100%"}}>
                                        <Typography component="p" variant='subtitle1'>3:45</Typography>
                                        <Box sx={{display : "flex" , justifyContent : "center" , alignItems : "center", width : "100%"  , position : "relative" , mt:3 , mb:4}}>
                                            <Divider sx={{width : "95%"}}/>
                                            <Box  sx={{position : 'absolute' , width:"100%" , display : "flex" , justifyContent:"space-between" , alignItems : "center"}}>
                                                <AirplanemodeActiveIcon  sx={{fontSize : "36px",transform: "rotate(90deg)" ,  color : theme.primary.main}}/>
                                                <Box sx={{textAlign : "center" , mt : 2}}>
                                                    <Brightness1Icon  sx={{fontSize : "10px" ,  color : theme.stoppingPoint}}/>
                                                    <Typography component="p" variant="body1">DOH</Typography>
                                                </Box>
                                                <Box sx={{textAlign : "center" , mt : 2}}>
                                                    <Brightness1Icon  sx={{fontSize : "10px" ,  color : theme.stoppingPoint}}/>
                                                    <Typography component="p" variant="body1">DOH</Typography>
                                                </Box>

                                                <Brightness1Icon  sx={{fontSize : "10px" , color : theme.primary.main }}/>
                                            </Box>
                                        </Box>
                                    </Grid>
                                    <Grid item order={{xs: 3, sm : "unset"}} xs={6} sm={2} sx={{display : "flex",justifyContent : "center" , alignItems : "center" , flexDirection : 'column' , height : "100%"}}>
                                        <Typography component="p" variant='Subtitle1Bold'>05:10</Typography>
                                        <Typography component="p" variant='subtitle1'>Asgarabad</Typography>
                                    </Grid>
                                </Grid>
                                <Typography sx={{ml:2 , color : theme.gray.tone2}} component="p" variant="subtitle2">17 Seats Available</Typography>
                            </Grid>
                            <Grid item xs={12} md={6}  sx={{display : "flex" , justifyContent : "space-between" , columnGap : 1 , flexWrap : "wrap" , rowGap : 1}} >
                                {classA.map((item, index) => (
                                    <Box
                                        key={index}
                                        sx={{
                                            p: '16px 32px',
                                            bgcolor: selectedBox === index ? theme.gray.tint2 : theme.gray.tint3,
                                            borderRadius: '14px',
                                            flexGrow : 1,
                                            cursor: 'pointer',
                                            border: selectedBox === index ? `2px solid ${theme.primary.main}` : '2px solid transparent',
                                        }}
                                        onClick={() => handleBoxClick(index)}
                                    >
                                        <Typography variant="h5">{item.class}</Typography>
                                        <Typography variant="H5Bold" sx={{color : selectedBox === index ? theme.primary.main : "unset"}}>{item.price}</Typography>
                                    </Box>
                                ))}
                            </Grid>
                        </Grid>
                        <Divider sx={{mt : 6 , mb : 3}} />
                        {selectedBox === 0 &&
                            <Box  display="flex" alignItems="stretch" columnGap={2} position="relative" px={4}>
                                <IconButton
                                    onClick={handleBackEconomy}
                                    sx={{
                                        bgcolor: theme.primary.main,
                                        borderRadius: "12px",
                                        color: "white",
                                        position: "absolute",
                                        top: "50%",
                                        left: 0,
                                        ":hover": { bgcolor: theme.primary.main }
                                    }}>
                                    <ArrowBackIosNewIcon />
                                </IconButton>
                                <IconButton
                                    onClick={handleNextEconomy}
                                    sx={{
                                        bgcolor: theme.primary.main,
                                        borderRadius: "12px",
                                        color: "white",
                                        position: "absolute",
                                        top: "50%",
                                        right: 0,
                                        ":hover": { bgcolor: theme.primary.main }
                                    }}>
                                    <ArrowForwardIosIcon />
                                </IconButton>
                                {RenderBoxes(economy.slice(currentCardIndex , currentCardIndex +  (window.screen.width <= 768 && window.screen.width > 425 ? 2 : window.screen.width <= 425 ? 1 : 3)),isClicked)}
                            </Box>
                        }
                        {selectedBox === 1 &&
                            <Box display="flex" alignItems="stretch" columnGap={2} position="relative" px={4}>
                                <IconButton
                                    onClick={handleBackBusiness}
                                    sx={{
                                        bgcolor: theme.primary.main,
                                        borderRadius: "12px",
                                        color: "white",
                                        position: "absolute",
                                        top: "50%",
                                        left: 0,
                                        ":hover": { bgcolor: theme.primary.main }
                                    }}>
                                    <ArrowBackIosNewIcon />
                                </IconButton>
                                <IconButton
                                    onClick={handleNextBusiness}
                                    sx={{
                                        bgcolor: theme.primary.main,
                                        borderRadius: "12px",
                                        color: "white",
                                        position: "absolute",
                                        top: "50%",
                                        right: 0,
                                        ":hover": { bgcolor: theme.primary.main }
                                    }}>
                                    <ArrowForwardIosIcon />
                                </IconButton>
                                {RenderBoxes(business.slice(currentCardBusiness, currentCardBusiness +  (window.screen.width <= 768 && window.screen.width > 425 ? 2 : window.screen.width <= 425 ? 1 : 3)),isClicked)}
                            </Box>
                        }
                        {selectedBox === 2 &&
                            <Box display="flex" alignItems="stretch" columnGap={2} position="relative" px={4}>
                                <IconButton
                                    onClick={handleBackFirst}
                                    sx={{
                                        bgcolor: theme.primary.main,
                                        borderRadius: "12px",
                                        color: "white",
                                        position: "absolute",
                                        top: "50%",
                                        left: 0,
                                        ":hover": { bgcolor: theme.primary.main }
                                    }}>
                                    <ArrowBackIosNewIcon />
                                </IconButton>
                                <IconButton
                                    onClick={handleNextFirst}
                                    sx={{
                                        bgcolor: theme.primary.main,
                                        borderRadius: "12px",
                                        color: "white",
                                        position: "absolute",
                                        top: "50%",
                                        right: 0,
                                        ":hover": { bgcolor: theme.primary.main }
                                    }}>
                                    <ArrowForwardIosIcon />
                                </IconButton>
                                {RenderBoxes(first.slice(currentCardFirst, currentCardFirst +  (window.screen.width <= 768 && window.screen.width > 425 ? 2 : window.screen.width <= 425 ? 1 : 3)),isClicked)}
                            </Box>
                        }
                    </Box>
                </Box>
            </Modal>
        </div>
    )
}

export default FlightTicketSelector;
