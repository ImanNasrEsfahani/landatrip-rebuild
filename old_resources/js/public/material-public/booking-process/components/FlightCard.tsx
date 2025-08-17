import * as React from "react"
import {Box, Button, Divider, Grid, Typography} from "@mui/material";
import AirplanemodeActiveIcon from "@mui/icons-material/AirplanemodeActive";
import Brightness1Icon from "@mui/icons-material/Brightness1";
import customTheme from "../../custom";

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

export default function FlightCard(props) {
    const theme: any = customTheme.palette;
    return (
        //forth
        <>
            <Grid item order={{xs: 1, md: "unset"}} xs={12} md={8.5} sx={{
                display: "flex",
                justifyContent: "center",
                alignItems: "center",
                flexDirection: 'column',
                height: "100%"
            }}>
                <Grid container sx={{display: "flex", justifyContent: "center", alignItems: "center", height: "100%"}} spacing={2}>
                    {
                        props.flights.slice(0,1).map((item , index)=>(
                            <Grid item
                                xs={6}
                                sm={2}
                                sx={{
                                display: "flex",
                                justifyContent: "center",
                                flexDirection: 'column',
                                height: "100%",
                                alignItems : "center",
                                textAlign : "center"
                                }}

                            >
                                <Typography component="p" variant='Subtitle1Bold'>{item.departure.at}</Typography>
                                <Typography component="p" variant='subtitle1'>{item.departure.city}</Typography>
                            </Grid>
                        ))
                    }
                    <Grid item  xs={12} sm={8}
                     sx={{
                        display: "flex",
                        justifyContent: "center",
                        alignItems: "center",
                        flexDirection: "column",
                        height: "100%"
                    }}
                    >
                        <Box sx={{width : "100%" , display : "flex" , justifyContent : "space-between" }}>
                            <div><AirplanemodeActiveIcon sx={{fontSize: "36px", transform: "rotate(90deg)", color: theme.sidebarTitle , visibility : "hidden"}}/></div>
                            <Typography variant="subtitle1Semibold"> {props.duration}</Typography>
                            <div><Brightness1Icon sx={{fontSize: "10px" , visibility : "hidden"}}/></div>
                        </Box>
                        <Box sx={{
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center",
                            width: "100%",
                            position: "relative",
                            mb: 1
                        }}>
                            <Divider sx={{width: "98%"}}/>
                            <Box sx={{
                                position: 'absolute',
                                width: "100%",
                                display: "flex",
                                justifyContent: "space-between",
                                alignItems: "center"
                            }}>
                                <AirplanemodeActiveIcon
                                    sx={{fontSize: "36px", transform: "rotate(90deg)", color: theme.primary.main}}/>
                                {props.flights ? props.flights.slice(1).map((i) => 
                                <Box sx={{display : "flex" , flexDirection : "column" , justifyContent : "center" ,alignItems : "center" , textAlign : "center" , width : "6rem"}}>
                                    <Brightness1Icon sx={{fontSize: "10px"}}/>
                                </Box>) : ""}
                                <Brightness1Icon sx={{fontSize: "10px" , color : theme.primary.main}}/>
                            </Box>
                        </Box>
                        <Box sx={{width : "100%" , display : "flex" , justifyContent : "space-between"}}>
                            <div><AirplanemodeActiveIcon
                                    sx={{fontSize: "36px", transform: "rotate(90deg)", color: theme.sidebarTitle , visibility : "hidden"}}/></div>
                            {props.flights ? props.flights.slice(1).map((i) => 
                                <Box sx={{display : "flex" , flexDirection : "column" , justifyContent : "center" ,alignItems : "center" , textAlign : "center" , width : "6rem"}}>
                                    <Typography mt={1} component="p" variant="body1">{i.departure.at}</Typography>
                                    <Typography component="p" variant="body1">{i.departure.city}</Typography>
                                </Box>
                                ) : ""
                            }
                            <div><Brightness1Icon sx={{fontSize: "10px", color: theme.stoppingPoint , visibility : "hidden"}}/></div>
                        </Box>
                    </Grid>
                    {props.flights.slice(-1).map((item, index) =>
                        // <>
                        //     {index === 0 ?
                        //         <>
                        //             <Grid item  xs={6} sm={2} sx={{
                        //                 display: "flex",
                        //                 justifyContent: "center",
                        //                 flexDirection: 'column',
                        //                 height: "100%"
                        //             }} alignItems={{xs: "center", sm: "end"}}>
                        //                 <Typography component="h5" variant='h5'>{item.departure.at}</Typography>
                        //                 <Typography component="h6" variant='h6'>{item.departure.city}</Typography>
                        //             </Grid>
                        //             <Grid item  xs={6} sm={2} sx={{
                        //                 display: "flex",
                        //                 justifyContent: "center",
                        //                 alignItems: "center",
                        //                 flexDirection: 'column',
                        //                 height: "100%"
                        //             }}>
                        //                 <Typography component="h5" variant='h5'>{item.arrival.at}</Typography>
                        //                 <Typography component="h6" variant='h6'>{item.arrival.city}</Typography>
                        //             </Grid>
                        //         </>
                        //         :
                        //         <Grid item xs={6} sm={2} sx={{
                        //             display: "flex",
                        //             justifyContent: "center",
                        //             alignItems: "center",
                        //             flexDirection: 'column',
                        //             height: "100%"
                        //         }}>
                        //             <Typography component="h5" variant='h5'>{item.arrival.at}</Typography>
                        //             <Typography component="h6" variant='h6'>{item.arrival.city}</Typography>
                        //         </Grid>
                        //     }
                        // </>
                        <Grid item xs={6} sm={2} sx={{
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center",
                            flexDirection: 'column',
                            height: "100%",
                            textAlign : "center"
                        }}>
                            <Typography component="p" variant='Subtitle1Bold'>{item.arrival.at}</Typography>
                            <Typography component="p" variant='subtitle1'>{item.arrival.city}</Typography>
                        </Grid>
                    )}
                    {/* <Grid item sm={8}>
                        {props.flights ? props.flights.slice(1).map((i) => (
                            <>
                                <Typography mt={1} component="p" variant="body1">{i.departure.at}</Typography>
                                <Typography component="p" variant="body1">{i.departure.city}</Typography>
                            </>
                        )) : null}
                    </Grid>  */}
                </Grid>
            </Grid>
            <Grid item order={{xs: 3, md: "unset"}} xs={6} md={2}
                  sx={{display: "flex", justifyContent: "center", alignItems: "center", flexDirection: 'column'}}>
                <Typography component="h4" variant='h6Bold' sx={{color: theme.primary.main, mb:1}}>{props.price.total} {props.price.currency === "EUR" ? "€" :""}</Typography>
                <Typography variant="subtitle2" color={theme.gray.tone2}>{props.numberOfBookableSeats} Seats Available</Typography>
                <Button variant="contained" sx={{mt: "12px" , textTransform : "none" , color: theme.white,padding: " 10px 40px", borderRadius: "12px",}} onClick={()=>props.handleOpen(props.airlineFlights)}>
                    <Typography component="h6" variant='subtitle2Semibold'>More detail</Typography>
                </Button>
            </Grid>
        </>
    )
}
