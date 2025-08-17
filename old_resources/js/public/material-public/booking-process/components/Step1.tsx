import * as React from 'react';
import {Box, Divider, Grid, IconButton, Typography, Skeleton, Button} from '@mui/material';
import AddCircleIcon from '@mui/icons-material/AddCircle';
import customTheme from "../../custom";
import { useState , useContext , useEffect } from 'react';
import DialogSearchUser from "./DialogSearchUser";
import CalendarMonthIcon from '@mui/icons-material/CalendarMonth';
import LocationOnIcon from '@mui/icons-material/LocationOn';
import SchoolIcon from '@mui/icons-material/School';
import GroupsIcon from '@mui/icons-material/Groups';
import RemoveCircleIcon from '@mui/icons-material/RemoveCircle';
import PersonAddAlt1Icon from '@mui/icons-material/PersonAddAlt1';
import LightModeIcon from '@mui/icons-material/LightMode';
import Context from '../Context';

type UserState = {
    fname: string;
    lname: string;
    slug: string;
    picture: string;
}[];


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

 const Step1 = () => {
    const [countChildren, setCountChildren] = useState(parseInt(window.localStorage.getItem("countChildren")?? '[]'));
    const [countAdult, setCountAdult] = useState(parseInt(window.localStorage.getItem("countAdult")?? '[]'));
    const [openDialog, setOpenDialog] = useState(false);
    const [finalResults , setFinalResults] = useState<UserState>(JSON.parse(window.localStorage.getItem("finalResults")?? '[]'))
    const [tempAddUserState , setTempAddUserState] = useState<UserState>([])
    const {groupBookingData} : any = useContext(Context)
    const theme : any = customTheme.palette;


    // ------handleCountChildren-------
    const handleCountChildren = (change) => {
        if (change === "increment") {
            setCountChildren(prev => prev+1);
        } else if (change === "decrement" && countChildren > 0) {
            setCountChildren(prev => prev-1);
        }
      };
    // ------end of handleCountChildren-------

    // ------handleCountAdult-------
    const handleCountAdult = (change) => {
        if (change === "increment") {
            setCountAdult(prev => prev+1);
        } else if (change === "decrement" && countAdult > 0) {
            setCountAdult(prev => prev-1);
        }
        };
    // ------end of handleCountAdult-------

    //  --------dialog-----------
    const handleClickOpen = () => {
        setOpenDialog(true);
    };

    const handleClose = () => {
        setOpenDialog(false);
    };

    const removeUser = (slug : string) =>{
        const newUser = finalResults.filter(item => item.slug !== slug)
        setFinalResults(newUser)
        const newUser1 = tempAddUserState.filter(item => item.slug !== slug)
        setTempAddUserState(newUser1)

    }

    window.localStorage.setItem("countAdult", `${countAdult}`);
    window.localStorage.setItem("countChildren", `${countChildren}`);
     window.localStorage.setItem("finalResults",JSON.stringify(finalResults))
     window.dispatchEvent(new Event('dataUpdated'))

     //  --------end of dialog-----------


    // if(groupBookingData.isLoading){
    //     return <p>asghar</p>
    // }

    return (

            <Box mt={5}>
                <Typography sx={{color : theme.gray.tone3}} variant="h4Bold">
                    Trip info
                </Typography>
                <Box
                    sx={{
                        mx:2,
                        p:4,
                        display:"flex",
                        justifyContent:"center",
                        alignItems:"center",
                        mt:2,
                        borderRadius: "12px",
                        boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)",
                        
                    }}
                >
                    <Grid container spacing={{xs:5 , sm:0}}>
                        <Grid item xs={12} sm={6}>
                            <Box sx={{pr : 2}}>
                                <Box sx={{display: "flex" , alignItems:"center" }}>
                                    {/* <CalendarMonthIcon sx={{color : theme.button}}/> */}
                                    {groupBookingData.isLoading ?
                                        <Skeleton variant="text" width={200} height={30} sx={{ml : 2}} /> :
                                        <Typography variant='h5Semibold'  sx={{ml:2 , color : theme.gray.tone3}}>
                                            {groupBookingData.data.data.tour_title}
                                        </Typography>
                                    }
                                </Box>
                                <Box sx={{display: "flex" , alignItems:"center" , mt : 2 }}>
                                    <LocationOnIcon sx={{color : theme.button}}/>
                                    {groupBookingData.isLoading ?
                                        <Skeleton variant="text" width={200} height={30} sx={{ml : 2}} /> :
                                        <Typography variant='subtitle1' sx={{ml:2 , color : theme.gray.tone3}}>{groupBookingData.data.data.destination}</Typography>
                                    }
                                </Box>
                                <Box sx={{display: "flex" , alignItems:"center",mt : 1}}>
                                    <SchoolIcon sx={{color : theme.button}}/>
                                    {groupBookingData.isLoading ?
                                        <Skeleton variant="text" width={200} height={30} sx={{ml : 2}} /> :
                                        <Typography variant='subtitle1' sx={{ml:2 , color : theme.gray.tone3}}>Management, Business Analysis</Typography>
                                    }
                                </Box>
                                <Box sx={{display: "flex" , alignItems:"center",mt : 1 }}>
                                    <GroupsIcon sx={{color : theme.button}}/>
                                    {groupBookingData.isLoading ?
                                        <Skeleton variant="text" width={200} height={30} sx={{ml : 2}} /> :
                                        <Typography variant='subtitle1' sx={{ml:2 , color : theme.gray.tone3}}>{groupBookingData.data.data.public}</Typography>
                                    }
                                </Box>
                            </Box>
                        </Grid>
                        <Grid item xs={12} sm={6} >
                            <Box borderLeft={{sm:"1px solid black"}} borderTop={{xs :"1px solid black", sm:"none" }} pt={{xs : 4 , sm:0}} pl={{xs:0 , sm :4}} sx={{ paddingLeft : 4 , height:"100%", display:"flex" , justifyContent:"space-between" , flexDirection:"column"}}>
                                <Box sx={{display: "flex" , alignItems:"center" }}>
                                    <CalendarMonthIcon sx={{color : theme.button}}/>
                                    {groupBookingData.isLoading ?
                                        <Skeleton variant="text" width={200} height={30} sx={{ml : 2}} /> :
                                        <Typography variant='subtitle1'  sx={{ml:2 , color : theme.gray.tone3}}>{groupBookingData.data.data.start_date_tour}</Typography>
                                    }
                                </Box>
                                <Box sx={{display: "flex" , alignItems:"center" , mt : 2 }}>
                                    <CalendarMonthIcon sx={{color : theme.button}}/>
                                    {groupBookingData.isLoading ?
                                        <Skeleton variant="text" width={200} height={30} sx={{ml : 2}} /> :
                                        <Typography variant='subtitle1' sx={{ml:2 , color : theme.gray.tone3}}>{groupBookingData.data.data.start_date_tour}</Typography>
                                    }
                                </Box>
                                <Box sx={{display: "flex" , alignItems:"center",mt : 1}}>
                                    <LightModeIcon sx={{color : theme.button}}/>
                                    {groupBookingData.isLoading ?
                                        <Skeleton variant="text" width={200} height={30} sx={{ml : 2}} /> :
                                        <Typography variant='subtitle1' sx={{ml:2 , color : theme.gray.tone3}}>{groupBookingData.data.data.days} days, {groupBookingData.data.data.nights} nights</Typography>
                                    }
                                </Box>
                                <Box sx={{display: "flex" , alignItems:"center",mt : 1 }}>
                                    <GroupsIcon sx={{color : theme.button}}/>
                                    {groupBookingData.isLoading ?
                                        <Skeleton variant="text" width={200} height={30} sx={{ml : 2}} /> :
                                        <Typography variant='subtitle1' sx={{ml:2 , color : theme.gray.tone3}}>Only {groupBookingData.data.data.capacity} spaces left</Typography>
                                    }
                                </Box>
                            </Box>
                        </Grid>
                    </Grid>
                </Box>
                <Box sx={{mt:9}}>
                    <Typography variant="h4Bold" sx={{color : theme.gray.tone3}}>
                        Tour Participants
                    </Typography>
                    <Box className="scrollbarInputs" sx={{mx:2, pb : 2 , mt:2 , display:"flex"  }}>
                                <Box >
                                    <IconButton sx={{p : 0}} onClick={handleClickOpen}>
                                        <Box sx={{height : "100px" , width : "100px" , borderRadius : "50%" , border : "1px solid " , borderColor : theme.primary.main , display : "flex" , justifyContent : "center" , alignItems : "center"}}>
                                            <PersonAddAlt1Icon sx={{color : theme.button}}/>
                                        </Box>
                                    </IconButton>

                                    <Typography sx={{textAlign : "center" , mt : 1 , color : theme.gray.tone3}} variant="h6Semibold" component="p">Add Others</Typography>
                                </Box>
                        {finalResults?.map((item) =>{
                            return (

                                <Box key={item.slug} sx={{width : "100px" , ml : 3}}>
                                    <Box sx={{position : "relative" , height : "100px" , width : "100px"}}>
                                        <img src={item.picture} style={{height : "100%" , width : "100%" , borderRadius : "50px"}} />
                                        <IconButton onClick={()=>removeUser(item.slug)} sx={{position : "absolute" , color : theme.error.main , top:"1px" , right : "1px" , p:0}}>
                                            <RemoveCircleIcon />
                                        </IconButton>
                                    </Box>
                                    <Typography sx={{textAlign : "center" , mt : 1 , color : theme.gray.tone3}} variant="h6Semibold" component="p">{item.fname} {item.lname}</Typography>
                                </Box>

                            )
                        })}
                    </Box>
                </Box>
                {/*<Box sx={{mt:5}}>*/}
                {/*    <Typography variant="h2">*/}
                {/*        Add Guests*/}
                {/*    </Typography>*/}
                {/*    <Typography mx={2} component={"ul"}>*/}
                {/*        <Typography variant='h6' component={"li"}>• nfant - Under 2 years. May travel free sitting on parent's lap.</Typography>*/}
                {/*        <Typography variant='h6' mt={1}  component={"li"}>• Child - Between 2-11 years. Gets discounted tickets and must be accompanied by adult.</Typography>*/}
                {/*    </Typography>*/}
                {/*    <Box sx={{mt:3 , px:4 , py:2 , mx:2 , boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)", borderRadius : "12px"}}>*/}
                {/*        <Typography variant="h4">Number of travelers?</Typography>*/}
                {/*        <Box sx={{display : "flex" , justifyContent : "space-between" , mt:3}}>*/}
                {/*            <Typography>Adult</Typography>*/}
                {/*            <Box sx={{display : "flex" , justifyContent : "space-between" , alignItems : "center"}}>*/}
                {/*                <IconButton onClick={() => handleCountAdult("decrement")} sx={{padding:0 , color: theme.buttonColor }}>*/}
                {/*                    <RemoveCircleIcon/>*/}
                {/*                </IconButton>*/}
                {/*                <Typography sx={{mx : 2}} variant="h5">{countAdult}</Typography>*/}
                {/*                <IconButton onClick={() => handleCountAdult("increment")} sx={{padding:0 ,  color: theme.buttonColor }}>*/}
                {/*                    <AddCircleIcon/>*/}
                {/*                </IconButton>*/}
                {/*            </Box>*/}
                {/*        </Box>*/}
                {/*        <Box sx={{display : "flex" , justifyContent : "space-between" , mt:2}}>*/}
                {/*            <Typography>Children</Typography>*/}
                {/*            <Box sx={{display : "flex" , justifyContent : "space-between" , alignItems : "center"}}>*/}
                {/*                <IconButton onClick={() => handleCountChildren("decrement")} sx={{padding:0 ,  color: theme.buttonColor }}>*/}
                {/*                    <RemoveCircleIcon/>*/}
                {/*                </IconButton>*/}
                {/*                <Typography sx={{mx : 2}} variant="h5">{countChildren}</Typography>*/}
                {/*                <IconButton onClick={() => handleCountChildren("increment")} sx={{padding:0 , color: theme.buttonColor}}>*/}
                {/*                    <AddCircleIcon/>*/}
                {/*                </IconButton>*/}
                {/*            </Box>*/}
                {/*        </Box>*/}
                {/*    </Box>*/}
                {/*</Box>*/}
                {/* --------dialog----------- */}
                <DialogSearchUser handleClose={handleClose} tempAddUserState={tempAddUserState} setTempAddUserState={setTempAddUserState} handleClickOpen={handleClickOpen} setOpenDialog={setOpenDialog} openDialog={openDialog} setFinalResults={setFinalResults}/>
                {/* --------end of dialog----------- */}
            </Box>


    )
 }


 export default Step1;
