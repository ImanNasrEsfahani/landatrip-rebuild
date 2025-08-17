import * as React from 'react';
import { Box, Grid, Typography , Skeleton } from '@mui/material';
import customTheme from "../../custom";
import {useContext, useEffect, useState} from 'react';
import Context from '../Context';

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

const Sidebar = () =>{
    const {groupBookingData} : any = useContext(Context)
    const groupBookingDataTemp = groupBookingData?.data?.data
    const theme : any = customTheme.palette;
    const [ guests , setGuests]  = useState()
    const [ participants , setParticipants]  = useState({})
    const [ transport , setTransport] = useState()


    window.addEventListener("dataUpdated",(e)=>{
        setParticipants(JSON.parse(localStorage.getItem("finalResults")))
        // setGuests(parseInt(localStorage.getItem("countChildren")) + parseInt(localStorage.getItem("countAdult")))
    })

    window.addEventListener("transport",(e)=>{
        setTransport(JSON.parse(localStorage.getItem("transportaion")))
    })

    return (
        <>
            <Grid container spacing={3}>
                <Grid item xs={12} lg={12} md={6} sm={6} display="flex">
                    <Box sx={{boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)" , p:2 , borderRadius : "16px", flexGrow:1 , rowGap :2 , display : "flex" , flexDirection : "column" }}>
                        <Box>
                            <Typography variant='body1Bold' sx={{color : theme.primary.main}}>Group name</Typography>
                            {groupBookingData.isLoading ?
                                <Skeleton variant="text" width="80%" height={30} sx={{ml : 2}} /> :
                                <Typography variant='subtitle1' sx={{color : theme.gray.tone3}}>{groupBookingDataTemp?.group_title}</Typography>
                            }
                        </Box>
                        <Box>
                            <Typography variant='body1Bold' sx={{color : theme.primary.main , mt:2}}>Location</Typography>
                            {groupBookingData.isLoading ?
                                <Skeleton variant="text" width="80%" height={30} sx={{ml : 2}} /> :
                                <Typography variant='subtitle1' sx={{color : theme.gray.tone3}}>{groupBookingDataTemp?.destination}</Typography>
                            }
                        </Box>
                        <Box>
                            <Typography variant='body1Bold' sx={{color : theme.primary.main, mt:2}}>Start in</Typography>
                            {groupBookingData.isLoading ?
                                <Skeleton variant="text" width="80%" height={30} sx={{ml : 2}} /> :
                                <Typography variant='subtitle1'sx={{color : theme.gray.tone3}} >{groupBookingDataTemp?.start_date_tour}</Typography>
                            }
                        </Box>
                        <Box>
                            <Typography variant='body1Bold' sx={{color : theme.primary.main , mt:2}}>End in</Typography>
                            {groupBookingData.isLoading ?
                                <Skeleton variant="text" width="80%" height={30} sx={{ml : 2}} /> :
                                <Typography variant='subtitle1' sx={{color : theme.gray.tone3}}>{groupBookingDataTemp?.end_date_tour}</Typography>
                            }
                        </Box>
                        <Box>
                            <Typography variant='body1Bold' sx={{color : theme.primary.main , mt:2}}>Operated in</Typography>
                            <Typography variant='subtitle1' sx={{color : theme.gray.tone3}}>English</Typography>
                        </Box>
                        <Box>
                            <Typography variant='body1Bold' sx={{color : theme.primary.main , mt:2}}>Included</Typography>
                            <Typography variant='subtitle1'  sx={{color : theme.gray.tone3}}>Meals</Typography>
                        </Box>
                    </Box>
                </Grid>
                <Grid item xs={12} lg={12} md={6} sm={6} display="flex">
                    <Box sx={{boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)" , p:2 , borderRadius : "16px" ,  flexGrow:1}}>
                        <Box sx={{display:"flex" , justifyContent : "center" , borderRadius : "12px" , border : "1px solid " , borderColor : theme.gray.tone2 , p : 1}}>
                            <Typography variant='subtitle2Semibold' sx={{color : theme.gray.tone3}} component="p">{guests} Guests - {participants?.length} Participants</Typography>
                        </Box>
                        <Box sx={{display : "flex" , flexDirection : "column" , px:2 , mt:1}}>
                            <Box sx={{display : "flex" , justifyContent:"space-between" , alignItems : "center"}}>
                                <Typography variant='body1Semibold' component="p" sx={{color : theme.gray.tone3}} >Course price</Typography>
                                <Typography variant='subtitle2Semibold' component="p" sx={{color : theme.gray.tone3}}>{participants?.length + 1} × $ 330</Typography>
                            </Box>
                            <Box sx={{display : "flex" , justifyContent:"space-between" , alignItems : "center", mt:2}}>
                                <Typography variant='body1Semibold' component="p" sx={{color : theme.gray.tone3}} >Transportation</Typography>
                                <Typography variant='subtitle2Semibold' component="p" sx={{color : theme.gray.tone3}}>$ {transport}</Typography>
                            </Box>
                            <Box sx={{display : "flex" , justifyContent:"space-between" , alignItems : "center", mt:2}}>
                                <Typography variant='body1Semibold' component="p" sx={{color : theme.gray.tone3}} >Accommodation</Typography>
                                <Typography variant='subtitle2Semibold' component="p" sx={{color : theme.gray.tone3}}>-</Typography>
                            </Box>
                            <Box sx={{display : "flex" , justifyContent:"space-between" , alignItems : "center", mt:2}}>
                                <Typography variant='body1Semibold' component="p" sx={{color : theme.gray.tone3}} >Services </Typography>
                                <Typography variant='subtitle2Semibold' component="p" sx={{color : theme.gray.tone3}}>-</Typography>
                            </Box>
                        </Box>
                        <Box sx={{display : "flex" , flexDirection : "column" , px:2 , py:1 , borderTop : "1px solid " , borderBottom : "1px solid ", borderColor : theme.gray.main , my:1}}>
                            <Box sx={{display : "flex" , justifyContent:"space-between" , alignItems : "center"}}>
                                <Typography  variant='body1Semibold' component="p" sx={{color : theme.gray.tone3}}>Sum</Typography>
                                <Typography variant='subtitle2Semibold' component="p" sx={{color : theme.gray.tone3}}>$ {(participants?.length + 1 )* 330}</Typography>
                            </Box>
                            <Box sx={{display : "flex" , justifyContent:"space-between" , alignItems : "center" , mt:2}}>
                                <Typography  variant='body1Semibold' component="p" sx={{color : theme.gray.tone3}}>Tax 9%</Typography>
                                <Typography variant='subtitle2Semibold' component="p" sx={{color : theme.gray.tone3}}>$ 30</Typography>
                            </Box>
                        </Box>
                        <Box sx={{display : "flex" , justifyContent:"space-between" , alignItems : "center",px:2}}>
                            <Typography  variant='body1Semibold' component="p" sx={{color : theme.gray.tone3}}>Total</Typography>
                            <Typography variant='subtitle2Semibold' component="p" sx={{color : theme.gray.tone3}}>$ 360</Typography>
                        </Box>
                    </Box>
                </Grid>
            </Grid>
        </>
    )
}

export default Sidebar;
