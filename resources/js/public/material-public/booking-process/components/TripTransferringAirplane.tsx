import * as React from 'react'
import CloseIcon from '@mui/icons-material/Close';
import AddIcon from '@mui/icons-material/Add';
import {
    Autocomplete,
    Box,
    Button,
    Checkbox,
    DialogTitle,
    Dialog,
    Divider,
    FormControl,
    Grid,
    InputLabel,
    Menu,
    MenuItem,
    TextField,
    ToggleButton,
    ToggleButtonGroup,
    Typography,
    Badge, Select, Fade
} from '@mui/material';
import styled from '@emotion/styled';
import MuiToggleButton from "@mui/material/ToggleButton";
import customTheme from "../../custom";
import AirplanemodeActiveIcon from '@mui/icons-material/AirplanemodeActive';
import Brightness1Icon from '@mui/icons-material/Brightness1';
import SearchIcon from '@mui/icons-material/Search';
import {useMutation} from "react-query";
import {route} from "../../helpers";
import axios from '../../../../axiosConfig'
import {log} from "console";
import {SubmitHandler, useForm} from "react-hook-form";
import FlightCard from "./FlightCard";
import FlightTicketSelector from './FlightTicketSelector';
import {useEffect} from "react";
import IconButton from "@mui/material/IconButton";
import ControlPointIcon from '@mui/icons-material/ControlPoint';
import RemoveCircleOutlineIcon from '@mui/icons-material/RemoveCircleOutline';

const toggle = [
    {text: "BusinessClass"},
    {text: "Direct"},
    {text: "Cheapest"},
    {text: "Fastest"},
    {text: "Earliest"},
    {text: "Latest"},

]


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

const TripTransferringAirplane = () => {
    const [formats, setFormats] = React.useState<string[]>(() => []);
    const [open, setOpen] = React.useState(false);
    const [travelers, setTravelers] = React.useState(1);
    const [children, setChildren] = React.useState(0);
    const [anchorEl, setAnchorEl] = React.useState(null);
    const [disable, setDisable] = React.useState("false")
    const [data, setData] = React.useState()


    const handleClick = (event) => {
        setAnchorEl(event.currentTarget);
    };

    const handleClosePopUp = () => {
        setAnchorEl(null);
    };

    const Open = Boolean(anchorEl);

    const handleIncreaseTravelers = () => {
        setTravelers(prev => travelers + children < 9 ? prev + 1 : prev);
    };

    const handleDecreaseTravelers = () => {
        setTravelers(prev => prev > 1 ? prev - 1 : prev)
    };
    const handleIncreasechildren = () => {
        setChildren(prev => travelers + children < 9 ? prev + 1 : prev);
    };

    const handleDecreasechildren = () => {
        setChildren(prev => prev > 0 ? prev - 1 : prev)
    };

    const handleOpen = (data) => {
        FlightDetails.mutate(data)
    };
    const handleClose = () => setOpen(false);


    const originSearch = useMutation('originSearch', async (keyWord) => {
        const {data} = await axios.post(route('api.public.origin-search'), keyWord);
        originSearch.data = data.data;
        return originSearch;
    })
    // get destinate cities from amadeus
    const destinationSearch = useMutation('destinationSearch', async (keyWord) => {
        const {data} = await axios.post(route('api.public.destination-search'), keyWord);
        destinationSearch.data = data.data;
        return destinationSearch;
    })
    // post Data for get flight offers
    const FlightOffers = useMutation('FlightOffers', async (value) => {
        const {data} = await axios.post(route('api.public.flight-booking'), {
            ...value,
            adults: travelers,
            children: children
        });
        FlightOffers.data = data.data;
        return FlightOffers;
    },)
    // post Data for get one flight details
    const FlightDetails = useMutation('FlightDetails', async (value) => {
        const response = await axios.post(route('api.public.flight-details'), {value});
        return response.data;
    }, {
        onSuccess: () => {
            setOpen(true)
        }
    })

    //React hook forms config
    const {
        register,
        handleSubmit,
        setValue,
        getValues,
        unregister,
        formState: {errors, isValid},
    } = useForm({mode: "onBlur"});

    const onSubmit: SubmitHandler = (data) => {
        // console.log(data)
        FlightOffers.mutate(data);
    };

    const handleFormat = (
        event: React.MouseEvent<HTMLElement>,
        newFormats: string[],
    ) => {
        setFormats(newFormats);
    };

    const theme: any = customTheme.palette;
    //search for origin city
    const handleOrigin = (e, option) => {
        if (e.target.value.length > 1) {
            originSearch.mutate({keyword: e.target.value});
        }
    }
    //search for destination city

    const handleDestination = (e) => {
        if (e.target.value.length > 1) {
            destinationSearch.mutate({keyword: e.target.value});
        }
    }
    const handleFlight = (e) => {
        if (e.target.value === "true") {
            unregister("returnDate")
            setDisable(true)
        } else {
            setDisable(false)
        }
    }

    const cabin = [
        "ECONOMY",
        "PREMIUM_ECONOMY",
        "BUSINESS",
        "FIRST"
    ]
    const handleData = (e) => {
        setData({
            numberOfBookableSeats: e.bookable,
            duration: e.duration
        })
    }
    return (
        <>
        <Box  mt={5}>
            <Box sx={{boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)", borderRadius : 2 , p:3 }}>
                <form onSubmit={handleSubmit(onSubmit)}>
                    <Grid container spacing={3}>
                        <Grid item  xs={12} sm={6}>
                            <Autocomplete
                                loading={originSearch.isLoading}
                                freeSolo
                                disablePortal
                                id="combo-box-demo"
                                options={originSearch.data ? originSearch.data.data.map((item)=> item) : []}
                                getOptionLabel={(option) => option.name}
                                renderOption={(props,option)=>
                                    <Box component="li" sx={{ '& > img': { mr: 2, flexShrink: 0 } }} {...props}>
                                        {option?.name} ({option.address?.countryName})
                                    </Box>
                                }
                                onChange={(event, value) => {
                                    setValue('originLocationCode', value?.iataCode);
                                }}
                                renderInput={(params) => <TextField sx={{"& .MuiOutlinedInput-root":{borderRadius : "14px"}}} {...params} label="Origin"  variant='outlined' onChange={(e)=>handleOrigin(e)}
                                />}
                            />
                        </Grid>
                        <Grid item xs={12} sm={6}>
                            <Autocomplete
                                loading={destinationSearch.isLoading}
                                disablePortal
                                id="combo-box-demo"
                                options={destinationSearch.data ? destinationSearch.data.data.map((item)=> item) : []}
                                getOptionLabel={(option) => option.name}
                                renderOption={(props,option)=>
                                    <Box component="li" sx={{ '& > img': { mr: 2, flexShrink: 0 } }} {...props}>
                                        {option?.name} ({option.address?.countryName})
                                    </Box>
                                }
                                onChange={(event, value) => {
                                    setValue('destinationLocationCode', value?.iataCode);
                                }}
                                renderInput={(params) => <TextField sx={{"& .MuiOutlinedInput-root":{borderRadius : "14px"}}} {...params} label="Destination " onChange={(e)=>handleDestination(e)} variant='outlined'/>}
                            />
                        </Grid>
                        <Grid item xs={12} sm={6}>
                            <TextField sx={{"& .MuiOutlinedInput-root":{borderRadius : "14px"}}} onClick={handleClick} aria-readonly={true} value={travelers+children + " Traveler"} defaultValue={travelers+children + " Traveler"}
                            variant='outlined' fullWidth label={"Travelers"}/>
                            <Menu
                                id="menu-popup"
                                anchorEl={anchorEl}
                                open={Open}
                                onClose={handleClosePopUp}

                            >
                                <MenuItem disableRipple sx={{display : "flex" , justifyContent : "space-between" , ":hover" : {bgcolor : "transparent" , cursor: "unset"}}}>Adults <IconButton><RemoveCircleOutlineIcon onClick={handleDecreaseTravelers}/></IconButton>{travelers}<IconButton><ControlPointIcon onClick={handleIncreaseTravelers}/></IconButton></MenuItem>
                                <MenuItem disableRipple sx={{display : "flex" , justifyContent : "space-between" , ":hover" : {bgcolor : "transparent" , cursor: "unset"}}}>Children <IconButton><RemoveCircleOutlineIcon onClick={handleDecreasechildren}/></IconButton>{children}<IconButton><ControlPointIcon onClick={handleIncreasechildren}/></IconButton></MenuItem>
                            </Menu>
                        </Grid>
                        <Grid item xs={12} sm={6}>
                            <Autocomplete
                                disablePortal
                                id="combo-box-demo"
                                options={cabin}
                                renderOption={(props,option)=>
                                    <Box component="li" sx={{ '& > img': { mr: 2, flexShrink: 0 } }} {...props}>
                                        {option}
                                    </Box>
                                }
                                renderInput={(params) => <TextField sx={{"& .MuiOutlinedInput-root":{borderRadius : "14px"}}} {...params} label="Cabin " {...register("travelClass")} variant='outlined'/>}
                            />
                        </Grid>
                        <Grid item xs={12} sm={6}>
                            <FormControl variant="outlined" sx={{width:"100%" }}>
                                {/* <InputLabel id="demo-simple-select-filled-label">One Way</InputLabel> */}
                                <Select
                                    labelId="demo-simple-select-filled-label"
                                    id="demo-simple-select-filled"
                                    defaultValue={"true"}
                                    {...register("one_way")}
                                    onChange={(e)=>handleFlight(e)}
                                    sx={{
                                        borderRadius: '16px',
                                        '& .MuiOutlinedInput-notchedOutline': {
                                          borderRadius: '16px'
                                        },
                                        '&.Mui-focused .MuiOutlinedInput-notchedOutline': {
                                          borderRadius: '16px'
                                        }
                                      }}

                                >
                                    <MenuItem value={"true"}>One Way</MenuItem>
                                    <MenuItem value={"false"}>Rounded Trip</MenuItem>
                                </Select>
                            </FormControl>
                        </Grid>
                        <Grid item xs={12} sm={6}>
                            {disable ?
                                <TextField sx={{width:"100%" ,"& .MuiOutlinedInput-root":{borderRadius : "14px"}}} type='date' InputLabelProps={{shrink: true}} label={"Departure Date"} variant='outlined'  {...register("departureDate")} />
                                    :
                                <>
                                    <Box sx={{display:"flex" , gap : 1}}>
                                        <TextField sx={{width:"50%" ,"& .MuiOutlinedInput-root":{borderRadius : "14px"}}} type='date' InputLabelProps={{shrink: true}} label={"Departure Date"} variant='outlined' {...register("departureDate")} />
                                        <TextField sx={{width:"50%" ,"& .MuiOutlinedInput-root":{borderRadius : "14px"}}} type='date' InputLabelProps={{shrink: true}} label={"Return Date"} variant='outlined' {...register("returnDate")}/>
                                    </Box>
                                </>
                            }
                        </Grid>
                        {/*<Grid item xs={12} sm={6}>*/}
                        {/*</Grid>*/}
                        <Grid item xs={12} sx={{display : "flex" , justifyContent : "center"}}>
                            <Button type={"submit"} variant="contained" endIcon={<SearchIcon/>} sx={{p:"10px 40px" , borderRadius : "12px" , bgcolor : theme.tertiary.main}} >
                                <Typography variant='subtitle2Semibold' sx={{textTransform : "none" }} >Search</Typography>
                            </Button>
                        </Grid>
                    </Grid>
                </form>
            </Box>

                {/*<Box mt={5}>*/}
                {/*    <ToggleButtonGroup*/}
                {/*        value={formats}*/}
                {/*        onChange={handleFormat}*/}
                {/*        aria-label="text formatting"*/}
                {/*        sx={{display : "flex" , flexWrap : "wrap" , rowGap : 1}}*/}
                {/*        >*/}
                {/*            {toggle.map((item, index) => {*/}
                {/*                return (*/}
                {/*                    <ToggleButton key={index} sx={{flexGrow : 1}} value={item.text} aria-label={item.text} style={{textTransform : "unset", borderRadius : "16px" , border : "1px solid " , borderColor: formats.includes(item.text) ? theme.button : "grey" , marginRight : "10px"}}>*/}
                {/*                        {formats.includes(item.text) ? <CloseIcon sx={{mr : 1 , color:"red"}}/> : <AddIcon sx={{mr : 1 , color:"green"}}/>}*/}
                {/*                        <Typography component="h6" variant='h6'>*/}
                {/*                            {item.text}*/}
                {/*                        </Typography>*/}
                {/*                    </ToggleButton>*/}
                {/*                )*/}
                {/*            })}*/}
                {/*    </ToggleButtonGroup>*/}
                {/*</Box>*/}
                <Box mt={5} sx={{boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)", borderRadius: 2}}>
			<Box  sx={{height:"100%" , p : 2 , }}>
                    <Box className="scrollbarInputs" sx={{maxHeight : "38rem" , overflow :"auto", pr : 1}}>
                        {FlightOffers.data ? (
                            FlightOffers.data.data.map((item) =>
                                <Grid container spacing={1} rowSpacing={3} sx={{borderBottom: "1px solid black", py: 2}}
                                      onClick={() => handleData({
                                          bookable: item.numberOfBookableSeats,
                                          duration: item.itineraries
                                      })}>
                                    <Grid item order={{xs: 2, md: "unset"}} xs={6} md={1.5} sx={{
                                        textAlign: "center",
                                        display: "flex",
                                        justifyContent: "center",
                                        alignItems: "center",
                                        flexDirection: 'column'
                                    }}>
                                        <img src={item?.itineraries[0]?.image} alt="airplaneLogo" style={{
                                            borderRadius: "50%",
                                            width: "60px",
                                            height: "60px"
                                        }}/>
                                        <Typography component="p" sx={{mt: 2}}
                                                    variant='subtitle1Semibold'>{item?.itineraries[0]?.airline?.company_name}</Typography>
                                    </Grid>
					{/*<Typography color={"gray"}>{item.numberOfBookableSeats} Seats Available</Typography>*/}
					{/*<Box sx={{border:"1px solid black" , borderRadius:"5px" , p:1}}> <Typography>{item.cabin}</Typography></Box>*/}
                                    <FlightCard numberOfBookableSeats={item.numberOfBookableSeats}
                                                duration={item.itineraries[0].duration} handleOpen={handleOpen}
                                                airlineFlights={item.details} flights={item.itineraries[0].segments}
                                                price={item.travelerPricings}/>
                                </Grid>
                            )
                        ) : <Typography>No Data</Typography>}
                    </Box>
                </Box>
            </Box>
	</Box>
            <FlightTicketSelector open={open} data={data} flightOffers={FlightDetails.data?.data?.flightOffers}
                                  handleClose={handleClose}/>
        </>
    )
}

export default TripTransferringAirplane;
