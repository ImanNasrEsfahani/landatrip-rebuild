import React from "react";
import { Autocomplete, Box, Button, Divider, FormControl, Grid, IconButton, InputLabel, MenuItem, Modal, Paper, Select, SelectChangeEvent, Tab, Table, TableBody, TableCell, TableContainer, TableHead, TableRow, Tabs, TextField, Typography } from "@mui/material";
import customTheme from '../../custom';
import CloseIcon from '@mui/icons-material/Close';
import EditIcon from '@mui/icons-material/Edit';
import ErrorOutlineIcon from '@mui/icons-material/ErrorOutline';




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
    borderRadius: "12px",
    minHeight : "90%"
};

const api ={
    Origin : "Imam Khomeini, Tehran",
    Destination : "Lester B. Pearson Intl., Toronto",
    Airline : "Qatar Airways",
    Flight : "Tuesday, December 21 - 12:10",
    Total : "1 day and 6 hours and 6 minutes",
    Stop : "(9 hours 27 minutes) John F Kennedy Intl",
    FlightClass : "Economy",
    Special : "--------",
    Allowable : "2 packages (each package 23 kg), 2 packages (each package 23 kg), 1 package (each package 10 kg)",
}

function createData(
    ageRange: string,
    fullName: string,
    gender: string,
    passportNumber: string,
    birthdayDate: string,
    nationality: string,
  ) {
    return { ageRange, fullName, gender, passportNumber, birthdayDate , nationality };
  }

  const rows = [
    createData('Adult', "ArianaShafie", "Female", "n223322333", "12/02/2000", "Iran"),
  ];



const ModalTicketInformation = ({openModalInformation , handleCloseModalInformation , handleEdit , data ,info}) => {
    const ticketInfo = JSON.parse(window.localStorage.getItem("ticketInfo"))
    const table1 = [
        {lable : "Origin" , text: data?.duration[0]?.segments[0]?.departure.city},
        {lable : "Destination" , text: data?.duration[0]?.segments.length > 1 ? data?.duration[0]?.segments[data?.duration[0]?.segments.length - 1].arrival.city :
         data?.duration[0]?.segments[0]?.arrival.city},
        {lable : "Airline company" , text: data?.duration[0]?.airline.company_name},
        {lable : "Flight date and time" , text: data?.duration[0]?.segments[0]?.departure.at},
        {lable : "Total flight time" , text: "About " + data?.duration[0]?.duration},
        {lable : "Stop" , text: api.Stop},
        {lable : "Flight class" , text: info?.travelerPricings[0]?.fareDetailsBySegment[0]?.cabin},
        {lable : "Special services" , text: api.Special},
        {lable : "Allowable amount of load" , text: info?.travelerPricings[0]?.fareDetailsBySegment[0]?.includedCheckedBags.quantity+" packages (each package 23 kg)"},
    ]
    const table2 = [
        {lable : "Origin" , text: data?.duration[1]?.segments[0]?.departure.city},
        {lable : "Destination" , text: data?.duration[1]?.segments.length > 1 ? data?.duration[1]?.segments[data?.duration[0]?.segments.length - 1].arrival.city :
         data?.duration[1]?.segments[0]?.arrival.city},
        {lable : "Airline company" , text: data?.duration[1]?.airline.company_name},
        {lable : "Flight date and time" , text: data?.duration[1]?.segments[0]?.departure.at},
        {lable : "Total flight time" , text: "About " + data?.duration[1]?.duration},
        {lable : "Stop" , text: api.Stop},
        {lable : "Flight class" , text: info?.travelerPricings[0]?.fareDetailsBySegment[0]?.cabin},
        {lable : "Special services" , text: api.Special},
        {lable : "Allowable amount of load" , text: info?.travelerPricings[0]?.fareDetailsBySegment[0]?.includedCheckedBags.quantity+" packages (each package 23 kg)"},
    ]

    const handleItems = () =>{
        window.localStorage.setItem("transportaion",JSON.stringify(info?.price?.total.replace(/\B(?=(\d{3})+(?!\d))/g, ",").split('.')[0]))
        window.dispatchEvent(new Event('transport'))
        handleCloseModalInformation()
    }
    console.log(ticketInfo)
    return(
        <>
            <Modal
                open={openModalInformation}
                aria-labelledby="modal-modal-title"
                aria-describedby="modal-modal-description"
            >
                <Box sx={style}>
                    <Box sx={{display : "flex" , justifyContent : "end" , alignItems : "center"}}>
                        <IconButton
                            aria-label="close"
                            onClick={handleCloseModalInformation}
                            sx={{
                                color: "red",
                            }}
                        >
                            <CloseIcon />
                        </IconButton>
                    </Box>
                    <Box sx={{mb : 3}}>
                        <Typography component="p" variant="h4Bold" sx={{color : theme.secondary.main}} >Ticket information</Typography>
                    </Box>
                    <Box className = "scrollbarInputs" sx={{display : "flex" , flexDirection : "column" , gap : 3 , px : 1 ,maxHeight : "33rem" , overflow : "auto" }}>
                        <Grid container spacing={3}>
                                    {data?.duration?.length === 1 ?
                                        <Grid item lg={6} >
                                            <Typography variant="H6Semibold" component="p" sx={{mb : 2}}>Ticket</Typography>
                                            <Box sx={{borderRadius : "12px" , border : "2px solid", borderColor : theme.primary.tint3 , overflow : "hidden"}}>
                                                {table1.map((item,index)=>(
                                            <Box key={index} sx={{display : "flex" , alignItems : "stretch" , borderBottom : "2px solid" , borderColor : theme.primary.tint3}}>
                                                <Box px={{sm:"61px" , xs : "5px"}} sx={{py : "16px" , minWidth : 145 , textAlign : "center" , bgcolor : theme.primary.tint3 , display: "inline-block"}}>
                                                    <Typography variant="Subtitle2Semibold" component="p" >{item.lable}</Typography>
                                                </Box>
                                                <Box sx={{ml : 1}}>
                                                    <Typography variant="subtitle2" component="p" >{item.text}</Typography>
                                                </Box>
                                            </Box>
                                                ))}
                                            </Box>
                                        </Grid>
                                        :
                                       <>
                                           <Grid item lg={6} >
                                               <Typography variant="H6Semibold" component="p" sx={{mb : 2}}>Departure ticket</Typography>
                                               <Box sx={{borderRadius : "12px" , border : "2px solid", borderColor : theme.primary.tint3 , overflow : "hidden"}}>
                                                   {table1.map((item,index)=>(
                                                       <Box key={index} sx={{display : "flex" , alignItems : "stretch" , borderBottom : "2px solid" , borderColor : theme.primary.tint3}}>
                                                           <Box px={{sm:"61px" , xs : "5px"}} sx={{py : "16px" , minWidth : 145 , textAlign : "center" , bgcolor : theme.primary.tint3 , display: "inline-block"}}>
                                                               <Typography variant="Subtitle2Semibold" component="p" >{item.lable}</Typography>
                                                           </Box>
                                                           <Box sx={{ml : 1}}>
                                                               <Typography variant="subtitle2" component="p" >{item.text}</Typography>
                                                           </Box>
                                                       </Box>))}
                                               </Box>
                                           </Grid>
                                           <Grid item lg={6} >
                                               <Typography variant="H6Semibold" component="p" sx={{mb : 2}}>Arrival ticket</Typography>
                                               <Box sx={{borderRadius : "12px" , border : "2px solid", borderColor : theme.primary.tint3 , overflow : "hidden"}}>
                                                   {table2.map((item,index)=>(
                                                       <Box key={index} sx={{display : "flex" , alignItems : "stretch" , borderBottom : "2px solid" , borderColor : theme.primary.tint3}}>
                                                           <Box px={{sm:"61px" , xs : "5px"}} sx={{py : "16px" , minWidth : 145 , textAlign : "center" , bgcolor : theme.primary.tint3 , display: "inline-block"}}>
                                                               <Typography variant="Subtitle2Semibold" component="p" >{item.lable}</Typography>
                                                           </Box>
                                                           <Box sx={{ml : 1}}>
                                                               <Typography variant="subtitle2" component="p" >{item.text}</Typography>
                                                           </Box>
                                                       </Box>))}
                                               </Box>
                                           </Grid>
                                       </>
                                    }

                            {/*<Grid item lg={6} >*/}
                            {/*    <Typography variant="H6Semibold" component="p" sx={{mb : 2}}>Arrival ticket</Typography>*/}
                            {/*    <Box sx={{borderRadius : "12px" , border : "2px solid", borderColor : theme.primary.tint3 , overflow : "hidden"}}>*/}
                            {/*        {table.map((item,index)=>(*/}
                            {/*            <Box key={index} sx={{display : "flex" , alignItems : "stretch" , borderBottom : "2px solid" , borderColor : theme.primary.tint3}}>*/}
                            {/*                <Box px={{sm:"61px" , xs : "5px"}} sx={{py : "16px" , minWidth : 145 , textAlign : "center" , bgcolor : theme.primary.tint3 , display: "inline-block"}}>*/}
                            {/*                    <Typography variant="Subtitle2Semibold" component="p" >{item.lable}</Typography>*/}
                            {/*                </Box>*/}
                            {/*                <Box sx={{ml : 1}}>*/}
                            {/*                    <Typography variant="subtitle2" component="p" >{item.text}</Typography>*/}
                            {/*                </Box>*/}
                            {/*            </Box>*/}
                            {/*        ))}*/}
                            {/*    </Box>*/}
                            {/*</Grid>*/}
                        </Grid>
                        <Box>
                            <Box sx={{display : "flex" , justifyContent : "space-between" , alignItems : "center" , mb:2}}>
                                <Typography variant="H6Semibold" component="p" sx={{color : theme.primary.main}} >Passenger information</Typography>
                                <Button onClick={handleEdit} endIcon={<EditIcon fontSize="small" />} sx={{px : 2 , py : 1 , textTransform : "none" , borderRadius : "12px"}} variant="outlined">Edit</Button>
                            </Box>
                            <Box>
                                <TableContainer component={Paper} sx={{borderRadius : "12px" , overflow : "hidden", boxShadow :"none" , overflowX : "auto" , border : "2px solid", borderColor : theme.primary.tint3}}>
                                    <Table aria-label="simple table">
                                        <TableHead>
                                        <TableRow>
                                            <TableCell sx={{bgcolor : theme.primary.tint3}} align="center">Age range</TableCell>
                                            <TableCell sx={{bgcolor : theme.primary.tint3}} align="center">First Name</TableCell>
                                            <TableCell sx={{bgcolor : theme.primary.tint3}} align="center">Last Name</TableCell>
                                            <TableCell sx={{bgcolor : theme.primary.tint3}} align="center">Passport number</TableCell>
                                            <TableCell sx={{bgcolor : theme.primary.tint3}} align="center">Birthday Date</TableCell>
                                            <TableCell sx={{bgcolor : theme.primary.tint3}} align="center">Nationality</TableCell>
                                        </TableRow>
                                        </TableHead>
                                        <TableBody>
                                        {ticketInfo?.ticket?.map((row , index) => (
                                            <TableRow
                                                key={index}
                                                sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
                                                >
                                                <TableCell align="center"> {row.age}</TableCell>
                                                <TableCell align="center">{row.first_name}</TableCell>
                                                <TableCell align="center">{row.last_name}</TableCell>
                                                <TableCell align="center">{row.number}</TableCell>
                                                <TableCell align="center">{row.dateOfBirth}</TableCell>
                                                <TableCell align="center">{row.nationality}</TableCell>
                                            </TableRow>
                                        ))}
                                        </TableBody>
                                    </Table>
                                </TableContainer>
                            </Box>
                        </Box>
                        <Box>
                            <Typography variant="H6Semibold" component="p" sx={{color : theme.primary.main , mb:2}} >Payment</Typography>
                            <Box sx={{border : "1px solid " , borderColor : theme.primary.tint1 , px:4 , py:2 , borderRadius : "8px" , display : "flex" , justifyContent : "space-between", alignItems : "center"}}>
                                    <Typography variant="H6Semibold" component="p" sx={{color : theme.gray.tone2}} >Total amount payable</Typography>
                                    <Typography variant="H5Semibold" component="p" ><Typography variant="H5Semibold" sx={{color : theme.secondary.main ,  textWrap: "nowrap"}} component="span" >$ </Typography>{info?.price?.total.replace(/\B(?=(\d{3})+(?!\d))/g, ",").split('.')[0]}</Typography>
                            </Box>
                            <Box sx={{display : "flex" , alignItems : "center" , width : "100%" , mt : 1}}>
                                <ErrorOutlineIcon fontSize="small" sx={{color : theme.secondary.main,mr:1}} />
                                <Typography sx={{color : theme.gray.tone2 }} component="p">To confirm and continue the purchase process, you have agreed to <Typography component="span" sx={{color : theme.secondary.main}} >Landa Trip's payment rules.</Typography></Typography>
                            </Box>
                        </Box>
                        <Box sx={{width : "100%" , display : "flex" , justifyContent : "end" , mb:1}}>
                            <Button onClick={handleItems} variant="contained" sx={{borderRadius : "12px" ,px:3 , py:1}}  >
                                <Typography variant="Subtitle2Semibold" sx={{color : "white" }}>Continue</Typography>
                            </Button>
                        </Box>
                    </Box>
                </Box>
            </Modal>

        </>
    )
}



export default ModalTicketInformation;
