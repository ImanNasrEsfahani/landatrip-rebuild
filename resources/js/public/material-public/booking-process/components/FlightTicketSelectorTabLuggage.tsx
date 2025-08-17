import React from "react";  
import { Box, Typography } from "@mui/material";
import customTheme from '../../custom';

const theme : any = customTheme.palette;

const api =[
    {
        text : "Personal item included"
    },
    {
        text : "Hand baggage included"
    },
    {
        text : "2 checked bags included"
    },
    {
        text : "Checked bags can weigh up to 23 kg each"
    }
]

const FlightTicketSelectorTabLuggage = () => {
    return(
        <Box className="scrollbarInputs" sx={{height : "80vh" , overflow : "auto" , pr : 1}}>
            {api.map((item , index)=>(
                <Typography key={index}  component="h6" variant="h6">
                    {item.text}
                </Typography>
            ))}
        </Box>
    )
}

export default FlightTicketSelectorTabLuggage;
