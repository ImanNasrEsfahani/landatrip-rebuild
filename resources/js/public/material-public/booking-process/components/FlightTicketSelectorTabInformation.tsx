import React from "react";
import { Box, Divider, Typography } from "@mui/material";
import Brightness1Icon from "@mui/icons-material/Brightness1";
import customTheme from "../../custom";

const theme: any = customTheme.palette;


const api = [
    {
        img:"https://media.istockphoto.com/id/1388223807/vector/canadian-maple-leaf-icon.jpg?s=612x612&w=0&k=20&c=whjVoxkB48aeMp25XxP8dBATby7tyVzIb4SiXi0OK_A=",
        start : {
            hourse1 : "05:00 PM",
            date : "Mon,Jane 22",
            step : "Billy Bishop Toronto City Airport (YTZ)",
        },
        end : {
            hourse1 : "08:00 PM",
            date : "Mon,Jane 85",
            step : "jafar Billy Bishop Toronto City Airport (YTZ)",
        },
        air : "Air Canada",
        hourse : "1 hr 15 min",
        imgT:"https://media.istockphoto.com/id/1388223807/vector/canadian-maple-leaf-icon.jpg?s=612x612&w=0&k=20&c=whjVoxkB48aeMp25XxP8dBATby7tyVzIb4SiXi0OK_A=",
        airT : "Air Canada",
        hourseT : "1 hr 15 min",
        hourse1T : "05:00 PM",
        dateT : "Mon,Jane 22",
        stepT : "Billy Bishop Toronto City Airport (YTZ)",
        porter : "Porter AirlinesEconomyDe Havilland-Bombardier Dash-8PD 2483",
        jafar : "2 hr 5 min layoverMontreal (YUL)"

    },
    {
        img:"https://media.istockphoto.com/id/1388223807/vector/canadian-maple-leaf-icon.jpg?s=612x612&w=0&k=20&c=whjVoxkB48aeMp25XxP8dBATby7tyVzIb4SiXi0OK_A=",
        start : {
            hourse1 : "05:00 PM",
            date : "Mon,Jane 22",
            step : "Billy Bishop Toronto City Airport (YTZ)",
        },
        end : {
            hourse1 : "08:00 PM",
            date : "Mon,Jane 85",
            step : "jafar Billy Bishop Toronto City Airport (YTZ)",
        },
        air : "Air Canada",
        hourse : "1 hr 15 min",
        imgT:"https://media.istockphoto.com/id/1388223807/vector/canadian-maple-leaf-icon.jpg?s=612x612&w=0&k=20&c=whjVoxkB48aeMp25XxP8dBATby7tyVzIb4SiXi0OK_A=",
        airT : "Air Canada",
        hourseT : "1 hr 15 min",
        hourse1T : "05:00 PM",
        dateT : "Mon,Jane 22",
        stepT : "Billy Bishop Toronto City Airport (YTZ)",
        porter : "Porter AirlinesEconomyDe Havilland-Bombardier Dash-8PD 2483",
        jafar : "2 hr 5 min layoverMontreal (YUL)"

    },
    {
        img:"https://media.istockphoto.com/id/1388223807/vector/canadian-maple-leaf-icon.jpg?s=612x612&w=0&k=20&c=whjVoxkB48aeMp25XxP8dBATby7tyVzIb4SiXi0OK_A=",
        start : {
            hourse1 : "05:00 PM",
            date : "Mon,Jane 22",
            step : "Billy Bishop Toronto City Airport (YTZ)",
        },
        end : {
            hourse1 : "08:00 PM",
            date : "Mon,Jane 85",
            step : "jafar Billy Bishop Toronto City Airport (YTZ)",
        },
        air : "Air Canada",
        hourse : "1 hr 15 min",
        imgT:"https://media.istockphoto.com/id/1388223807/vector/canadian-maple-leaf-icon.jpg?s=612x612&w=0&k=20&c=whjVoxkB48aeMp25XxP8dBATby7tyVzIb4SiXi0OK_A=",
        airT : "Air Canada",
        hourseT : "1 hr 15 min",
        hourse1T : "05:00 PM",
        dateT : "Mon,Jane 22",
        stepT : "Billy Bishop Toronto City Airport (YTZ)",
        porter : "Porter AirlinesEconomyDe Havilland-Bombardier Dash-8PD 2483",
        jafar : "2 hr 5 min layoverMontreal (YUL)"

    }
]


const FlightTicketSelectorTabInformation = ({info,duration}) => {
    return(
        <Box className="scrollbarInputs" sx={{height : "80vh" , overflow : "auto"}}>
            {info?.map((item, index)=>(
                <Box key={index} mb={3}>
                    <Box sx={{display : "flex"  , columnGap : 2 , alignItems : "center" , mb : 3}}>
                        <img style={{width : "48px" , height : "48px",borderRadius:"50%",objectFit:"cover"}} src={item.image} alt="img" />
                        <Typography variant="H5Semibold">{item.airline.company_name}</Typography>
                        {index === 0 ? <Typography variant="h5">{duration[0]?.duration}</Typography>:
                            <Typography variant="h5">{duration[1]?.duration}</Typography>
                        }

                    </Box>
                    <Box sx={{ml:3}} display="flex">
                        <Box sx={{display : "flex" , justifyContent : "center" , alignItems : "center" , flexDirection : "column" , position: "relative"}}>
                            <Divider orientation="vertical" sx={{height : "95%"}}/>
                            <Box sx={{display : "flex" , justifyContent : "space-between", flexDirection : "column" , height : "100%" , alignItems : "center" , position : "absolute"}}>
                            {Array.from({ length: item.segments.length+1 }).map((_, index) => (
                                <Brightness1Icon key={index} fontSize="small" sx={{ color: theme.gray.main }} />
                            ))}
                            </Box>
                        </Box>
                        <Box sx={{display : "flex" , flexDirection : "column" , justifyContent : "space-between" , rowGap : 3 , ml:3}}>
                            {item.segments.map((i,index)=>
                                item.segments.length === 1 ?    <Box>
                                        <Box sx={{display : "flex" , alignItems : "center" , mb:1}}>
                                            <Typography variant="H6Semibold">{i.duration}</Typography>
                                            <Typography variant="Subtitle1Semibold" sx={{ml : 1 , color : theme.gray.tone2}}>{i.departure.at}</Typography>
                                        </Box>
                                        <Typography variant="subtitle1" sx={{color : theme.gray.tone3}}>{i.departure.city}</Typography>
                                        <Box sx={{display : "flex" , alignItems : "center" , mb:1 , mt:3}}>
                                            <Typography variant="H6Semibold">{i.duration}</Typography>
                                            <Typography variant="Subtitle1Semibold" sx={{ml : 1 , color : theme.gray.tone2}}>{i.arrival.at}</Typography>
                                        </Box>
                                        <Typography variant="subtitle1" sx={{color : theme.gray.tone3}}>{i.arrival.city}</Typography>
                                    </Box>
                                    :
                                index === 0 ?
                                    <Box>
                                        <Box sx={{display : "flex" , alignItems : "center" , mb:1}}>
                                            <Typography variant="H6Semibold">{i.duration}</Typography>
                                            <Typography variant="Subtitle1Semibold" sx={{ml : 1 , color : theme.gray.tone2}}>{i.departure.at}</Typography>
                                        </Box>
                                        <Typography variant="subtitle1" sx={{color : theme.gray.tone3}}>{i.departure.city}</Typography>
                                    </Box>
                                    :
                                    <Box>
                                        <Box sx={{display : "flex" , alignItems : "center" , mb:1 , mt:3}}>
                                            <Typography variant="H6Semibold">{i.duration}</Typography>
                                            <Typography variant="Subtitle1Semibold" sx={{ml : 1 , color : theme.gray.tone2}}>{i.departure.at}</Typography>
                                        </Box>
                                        <Typography variant="subtitle1" sx={{color : theme.gray.tone3}}>{i.departure.city}</Typography>
                                    <Box sx={{display : "flex" , alignItems : "center" , mb:1,mt:"42px"}}>
                                        <Typography variant="H6Semibold">{i.duration}</Typography>
                                        <Typography variant="Subtitle1Semibold" sx={{ml : 1 , color : theme.gray.tone2}}>{i.arrival.at}</Typography>
                                    </Box>
                                <Typography variant="subtitle1" sx={{color : theme.gray.tone3}}>{i.arrival.city}</Typography>
                                    </Box>
                            )}
                        </Box>
                    </Box>
                    {/*<Typography sx={{mt : 5 ,  my:2 , ml:3}} variant="Subtitle1Semibold" component="p">p</Typography>*/}
                    {/*<Box sx={{py : 1 , px:2 , bgcolor : theme.secondary.tint3 , borderRadius : "10px",ml:3}}>*/}
                    {/*    <Typography sx={{color : theme.secondary.main}} variant="Subtitle1Semibold">l</Typography>*/}
                    {/*</Box>*/}
                </Box>
            ))}
        </Box>
    )
}

export default FlightTicketSelectorTabInformation;
