import React from "react";
import {
    Autocomplete,
    Box,
    Button,
    Divider,
    FormControl,
    Grid,
    IconButton,
    InputLabel,
    MenuItem,
    Modal,
    Select,
    SelectChangeEvent,
    Tab,
    Tabs,
    TextField,
    Typography
} from "@mui/material";
import customTheme from '../../custom';
import CloseIcon from '@mui/icons-material/Close';
import AirplanemodeActiveIcon from "@mui/icons-material/AirplanemodeActive";
import Brightness1Icon from "@mui/icons-material/Brightness1";
import ModalTicketInformation from "./ModalTicketInformation"
import {SubmitHandler, useForm} from "react-hook-form";


const theme: any = customTheme.palette;

declare module '@mui/material/Typography' {
    interface TypographyPropsVariantOverrides {
        H2Bold: true;
        Subtitle1Bold: true;
        H6Semibold: true;
        Subtitle1Semibold: true;
        H5Semibold: true;
        Subtitle2Semibold: true;
        H4Semibold: true;
        H5Bold: true;
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


interface TabPanelProps {
    children?: React.ReactNode;
    index: number;
    value: number;
}

const api = [
    {
        text: "System "
    },
    {
        text: "economy "
    },
    {
        text: "Multiple stopover visas "
    },
]


const ModalPassengerInformation = ({handleEdit, handleCloseModalPassenger, openModalPassenger, data, info ,adults ,children}) => {
    const [gender, setGender] = React.useState('');
    const [openModalInformation, setOpenModalInformation] = React.useState(false);
    const [phone , setPhone] = React.useState()

    const handleOpenModalInformation = () => {
        setOpenModalInformation(true)
        handleCloseModalPassenger(false)
    };
    const handleEditinfo = () => {
        setOpenModalInformation(false)
        handleEdit()
    };


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
        window.localStorage.setItem("ticketInfo",JSON.stringify(data))
        handleOpenModalInformation()
    };

   const handleChange = (e) => {
       if(parseInt(e.target.value)) {
           if(parseInt(e.target.value) > 10000000000000) return 0;
           if (typeof (parseInt(e.target.value)) === "number"){
               setPhone(parseInt(e.target.value))
               return 0;
           }
       }
       setPhone("");
    }

    const handleCloseModalInformation = () => {
        setOpenModalInformation(false)
        // window.localStorage.removeItem("ticketInfo")
    };


    return (
        <>
            <Modal
                open={openModalPassenger}
                aria-labelledby="modal-modal-title"
                aria-describedby="modal-modal-description"
            >
                <Box sx={style}>
                    <Box sx={{display: "flex", justifyContent: "end", alignItems: "center"}}>
                        <IconButton
                            aria-label="close"
                            onClick={handleCloseModalPassenger}
                            sx={{
                                color: "red",
                            }}
                        >
                            <CloseIcon/>
                        </IconButton>
                    </Box>
                    <Box sx={{display: "flex", flexDirection: "column", rowGap: 3}}>
                        <Box sx={{display: "flex", justifyContent: "space-between", alignItems: "center", px: 1}}>
                            <Typography variant="h4Bold" sx={{color: theme.secondary.main}} component="p">Passenger
                                information</Typography>
                            <Typography variant="h6" component="p">
                                remaining time :
                                <Typography variant="H5Bold" sx={{color: theme.secondary.main}}
                                            component="span"> 15:10</Typography>
                            </Typography>
                        </Box>
                        <Box className="scrollbarInputs" sx={{
                            overflow: "auto",
                            maxHeight: "75vh",
                            p: 1,
                            display: "flex",
                            flexDirection: "column",
                            rowGap: 3
                        }}>
                            <Box sx={{
                                display: "flex",
                                justifyContent: "space-between",
                                alignItems: "center",
                                px: 2,
                                py: 3,
                                boxShadow: "0px 3px 10px 1px rgba(0, 0, 0, 0.08)",
                                borderRadius: 1
                            }}>
                                <Box>
                                    <Box sx={{display: "flex", gap: 1, mb: 4}}>
                                        {api.map((item, index) => (
                                            <Typography variant="Subtitle2Semibold" sx={{
                                                px: "12px",
                                                py: 1,
                                                bgcolor: theme.primary.main,
                                                borderRadius: "100px",
                                                color: "white"
                                            }} key={index}>{item.text}</Typography>
                                        ))}
                                    </Box>
                                    {info?.itineraries?.map((item, index) =>
                                        <Box sx={{display: "flex", minWidth: "35rem"}}>
                                            <Box sx={{
                                                display: "flex",
                                                flexDirection: "column",
                                                rowGap: 1,
                                                justifyContent: "center",
                                                alignItems: "center"
                                            }}>
                                                <img style={{width: "28px", height: "28px"}} src={item.image} alt="img"/>
                                                <Typography sx={{textAlign: "center"}} variant="body1">{item?.airline?.company_name}</Typography>
                                            </Box>
                                            <Box sx={{width: "100%", display: "flex", ml: 3, columnGap: 1 , textAlign : "center" , alignItems : "center"}}>
                                                <Box sx={{
                                                    display: "flex",
                                                    justifyContent: "center",
                                                    alignItems: "center",
                                                    flexDirection: "column"
                                                }}>
                                                    {index === 0 ?
                                                    <>
                                                        <Typography variant="Subtitle1Bold" component="p">{info.itineraries[0].segments[0]?.departure.at}</Typography>
                                                        <Typography variant="subtitle1" component="p">{info.itineraries[0].segments[0]?.departure.city}</Typography>
                                                    </>
                                                        :
                                                       <>
                                                           <Typography variant="Subtitle1Bold" component="p">{info.itineraries[1].segments[0]?.departure.at}</Typography>
                                                           <Typography variant="subtitle1" component="p">{info.itineraries[1].segments[0]?.departure.city}</Typography>
                                                       </>
                                                    }
                                                </Box>



                                                <Box sx={{display : "flex" , flexDirection : "column" , width : "100%"}} >
                                                    <Box sx={{
                                                        display: "flex",
                                                        justifyContent: "center",
                                                        alignItems: "center",
                                                        width: "100%",
                                                        position: "relative",
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
                                                                sx={{
                                                                    fontSize: "36px",
                                                                    transform: "rotate(90deg)",
                                                                    color: theme.sidebarTitle
                                                                }}/>
                                                            {/* {props.flights ? props.flights.slice(1).map((i) =>  */}
                                                            <Box sx={{
                                                                display: "flex",
                                                                flexDirection: "column",
                                                                justifyContent: "center",
                                                                alignItems: "center",
                                                                textAlign: "center",
                                                                width: "6rem"
                                                            }}>
                                                                {Array.from({length: item.segments.length-1}, (item, index) => (
                                                                    <Brightness1Icon
                                                                        sx={{fontSize: "10px", color: theme.stoppingPoint}}
                                                                    />
                                                                ))}
                                                            </Box>
                                                            {/* ) : ""} */}
                                                            <Brightness1Icon sx={{fontSize: "10px"}}/>
                                                        </Box>
                                                    </Box>


                                                    <Box sx={{width : "100%" , display : "flex" , justifyContent : "space-between"}}>
                                                        <div><AirplanemodeActiveIcon sx={{fontSize: "36px", transform: "rotate(90deg)", color: theme.sidebarTitle , visibility : "hidden"}}/></div>
                                                        {item.segments ? item.segments.slice(1).map((i) =>
                                                            <Box sx={{display : "flex" , flexDirection : "column" , justifyContent : "center" ,alignItems : "center" , textAlign : "center" , width : "6rem"}}>
                                                                <Typography mt={1} component="p" variant="body1">{i.departure.at}</Typography>
                                                                <Typography component="p" variant="body1">{i.departure.city}</Typography>
                                                            </Box>
                                                        ) : ""
                                                        }
                                                        <div><Brightness1Icon sx={{fontSize: "10px", color: theme.stoppingPoint , visibility : "hidden"}}/></div>
                                                    </Box>
                                                </Box>



                                                <Box sx={{
                                                    display: "flex",
                                                    justifyContent: "center",
                                                    alignItems: "center",
                                                    flexDirection: "column"
                                                }}>
                                                    {index === 0 ?
                                                        <>
                                                            <Typography variant="Subtitle1Bold" component="p">{info.itineraries[0].segments[1]?.arrival.at}</Typography>
                                                            <Typography variant="subtitle1" component="p">{info.itineraries[0].segments[1]?.arrival.city}</Typography>
                                                        </>
                                                        :
                                                        <>
                                                            <Typography variant="Subtitle1Bold" component="p">{info.itineraries[1].segments[1]?.arrival.at}</Typography>
                                                            <Typography variant="subtitle1" component="p">{info.itineraries[1].segments[1]?.arrival.city}</Typography>
                                                        </>
                                                    }
                                                </Box>
                                            </Box>
                                        </Box>
                                    )}
                                </Box>

                                <Box>
                                    <Button onClick={handleCloseModalPassenger} variant="outlined" sx={{py: 1, px: 2, borderRadius: "12px", mb: 2}}>
                                        <Typography variant="Subtitle2Semibold">Change ticket</Typography>
                                    </Button>
                                    <Box sx={{
                                        display: "flex",
                                        justifyContent: "space-between",
                                        alignItems: "center",
                                        mb: 1
                                    }}>
                                        <Typography sx={{color: theme.gray.tone1}} variant="Subtitle2Semibold"
                                                    component="p">Adult</Typography>
                                        <Typography sx={{color: theme.gray.tone1}} variant="Subtitle2Semibold"
                                                    component="p">${adults && adults?.length !== 0 ? adults?.replace(/\B(?=(\d{3})+(?!\d))/g, ",").split('.')[0] : 0}</Typography>
                                    </Box>
                                    <Box sx={{display: "flex", justifyContent: "space-between", alignItems: "center"}}>
                                        <Typography sx={{color: theme.gray.tone1}} variant="Subtitle2Semibold"
                                                    component="p">Children</Typography>
                                        <Typography sx={{color: theme.gray.tone1}} variant="Subtitle2Semibold"
                                                    component="p">${children && children?.length !== 0 ? children?.replace(/\B(?=(\d{3})+(?!\d))/g, ",").split('.')[0] : 0}</Typography>
                                    </Box>
                                    <Divider sx={{width: "100%", mb: 2, mt: 3}}/>
                                    <Typography sx={{textAlign: "center", color: theme.primary.main}} variant="H5Bold"
                                                component="p">${info?.price?.total.replace(/\B(?=(\d{3})+(?!\d))/g, ",").split('.')[0]}</Typography>
                                </Box>
                            </Box>
                            <form onSubmit={handleSubmit(onSubmit)}>
                                {Array.from({length: info?.travelerPricings?.length}, (item, index)=>(
                                    <>
                                        <Box sx={{px: 2, py: 3, boxShadow: "0px 3px 10px 1px rgba(0, 0, 0, 0.08)", borderRadius: 1}}>
                                            <Box sx={{width: "100%", mb: 3}}>
                                                <Typography variant="H5Semibold" component="p" sx={{color: theme.gray.tone1}}>{info?.travelerPricings[index].travelerType}</Typography>
                                            </Box>
                                            <Grid container spacing={2} sx={{px: 4}}>
                                                <Grid item lg={3}>
                                                    <TextField
                                                        required
                                                        {...register(`ticket[${index}[first_name]]`)}
                                                        label="Name"
                                                        sx={{
                                                            width: "100%"
                                                        }}
                                                        InputProps={{
                                                            style: {
                                                                borderRadius: "14px",
                                                            }
                                                        }}
                                                    />
                                                </Grid>
                                                <Grid item lg={3}>
                                                    <TextField
                                                        required
                                                        {...register(`ticket[${index}[last_name]]`)}
                                                        label="Last name"
                                                        sx={{width: "100%"}}
                                                        InputProps={{
                                                            style: {
                                                                borderRadius: "14px",
                                                            }
                                                        }}
                                                    />
                                                </Grid>
                                                <Grid item lg={3}>
                                                    <Autocomplete
                                                        disablePortal
                                                        options={top100Films}
                                                        sx={{
                                                            width: "100%",
                                                            "& .MuiOutlinedInput-root": {
                                                                borderRadius: "14px",
                                                            },
                                                        }}
                                                        renderInput={(params) => <TextField {...params} {...register(`ticket[${index}[age]]`)} label="Age"/>}
                                                    />
                                                </Grid>
                                                <Grid item lg={3}>
                                                    <TextField
                                                        required
                                                        sx={{width: "100%"}}
                                                        type="date"
                                                        {...register(`ticket[${index}[dateOfBirth]]`)}
                                                        label="Date Of Birth"
                                                        InputLabelProps={{
                                                            shrink: true,
                                                        }}
                                                        InputProps={{
                                                            style: {
                                                                borderRadius: "14px",
                                                            }
                                                        }}
                                                    />
                                                </Grid>
                                                <Grid item lg={3}>
                                                    <Autocomplete
                                                        disablePortal
                                                        options={top100Films}
                                                        sx={{
                                                            width: "100%",
                                                            "& .MuiOutlinedInput-root": {
                                                                borderRadius: "14px",
                                                            },
                                                        }}
                                                        renderInput={(params) => <TextField {...params} {...register(`ticket[${index}[birthPlace]]`)} label="Birth Place"/>}
                                                    />
                                                </Grid>
                                                <Grid item lg={3}>
                                                    <Autocomplete
                                                        disablePortal
                                                        options={top100Films}
                                                        sx={{
                                                            width: "100%",
                                                            "& .MuiOutlinedInput-root": {
                                                                borderRadius: "14px",
                                                            },
                                                        }}
                                                        renderInput={(params) => <TextField {...params} {...register(`ticket[${index}[nationality]]`)} label="nationality"/>}
                                                    />
                                                </Grid>
                                                <Grid item lg={3}>
                                                    <TextField
                                                        required
                                                        label="Passport number"
                                                        {...register(`ticket[${index}[number]]`)}
                                                        sx={{width: "100%"}}
                                                        InputProps={{
                                                            style: {
                                                                borderRadius: "14px",
                                                            }
                                                        }}
                                                    />
                                                </Grid>
                                                <Grid item lg={3}>
                                                    <TextField
                                                        required
                                                        sx={{width: "100%"}}
                                                        type="date"
                                                        label="Issuance Date"
                                                        {...register(`ticket[${index}[issuanceDate]]`)}
                                                        InputLabelProps={{
                                                            shrink: true,
                                                        }}
                                                        InputProps={{
                                                            style: {
                                                                borderRadius: "14px",
                                                            }
                                                        }}
                                                    />
                                                </Grid>
                                                <Grid item lg={3}>
                                                    <Autocomplete
                                                        disablePortal
                                                        options={top100Films}
                                                        sx={{
                                                            width: "100%",
                                                            "& .MuiOutlinedInput-root": {
                                                                borderRadius: "14px",
                                                            },
                                                        }}
                                                        renderInput={(params) => <TextField {...params} {...register(`ticket[${index}[issuanceLocation]]`)} label="Issuance Location"/>}
                                                    />
                                                </Grid>
                                                <Grid item lg={3}>
                                                    <Autocomplete
                                                        disablePortal
                                                        options={top100Films}
                                                        sx={{
                                                            width: "100%",
                                                            "& .MuiOutlinedInput-root": {
                                                                borderRadius: "14px",
                                                            },
                                                        }}
                                                        renderInput={(params) => <TextField {...params} {...register(`ticket[${index}[issuanceCountry]]`)} label="Issuance Country"/>}
                                                    />
                                                </Grid>
                                                <Grid item lg={3}>
                                                    <Autocomplete
                                                        disablePortal
                                                        options={top100Films}
                                                        sx={{
                                                            width: "100%",
                                                            "& .MuiOutlinedInput-root": {
                                                                borderRadius: "14px",
                                                            },
                                                        }}
                                                        renderInput={(params) => <TextField {...params} {...register(`ticket[${index}[validityCountry]]`)} label="Validity Country"/>}
                                                    />
                                                </Grid>
                                                <Grid item lg={3}>
                                                    <TextField
                                                        required
                                                        sx={{width: "100%"}}
                                                        type="date"
                                                        label="Expiry Date"
                                                        {...register(`ticket[${index}[expiryDate]]`)}
                                                        InputLabelProps={{
                                                            shrink: true,
                                                        }}
                                                        InputProps={{
                                                            style: {
                                                                borderRadius: "14px",
                                                            }
                                                        }}
                                                    />
                                                </Grid>
                                            </Grid>
                                        </Box>
                                    </>
                                ))}
                                <Box
                                    sx={{px: 2, py: 3, boxShadow: "0px 3px 10px 1px rgba(0, 0, 0, 0.08)", borderRadius: 1}}>
                                    <Typography component="p" variant="H5Semibold" sx={{mb: 3, color: theme.gray.tone2}}>contact
                                        information</Typography>
                                    <Grid container spacing={2}>
                                        <Grid item lg={3} sx={{display: "flex"}}>
                                            <Autocomplete
                                                disablePortal
                                                disableClearable
                                                defaultValue={numberCountry[1]}
                                                options={numberCountry}
                                                sx={{
                                                    width: "25%",
                                                    "& .MuiOutlinedInput-root": {
                                                        borderRadius: "14px 0px 0px 14px",
                                                    },
                                                }}
                                                renderInput={(params) => <TextField {...register("countryCallingCode")} {...params} />}
                                            />
                                            <TextField
                                                required
                                                onChangeCapture={(e)=>handleChange(e)}
                                                value={phone}
                                                label="Phone Number"
                                                {...register("phNumber")}
                                                sx={{
                                                    width: "100%"
                                                }}
                                                InputProps={{
                                                    style: {
                                                        borderRadius: "0px 14px 14px 0px",
                                                    },
                                                }}
                                            />
                                        </Grid>
                                        <Grid item lg={4}>
                                            <TextField
                                                type="email"
                                                required
                                                label="Email Address"
                                                {...register("emailAddress")}
                                                sx={{
                                                    width: "100%"
                                                }}
                                                InputProps={{
                                                    style: {
                                                        borderRadius: "14px"
                                                    }
                                                }}
                                            />
                                        </Grid>
                                    </Grid>
                                </Box>
                                <Box sx={{width: "100%", display: "flex", justifyContent: "end", mb: 1}}>
                                    <Button type="submit" variant="contained" sx={{borderRadius: "12px", px: 3, py: 1}}>
                                        <Typography variant="Subtitle2Semibold" sx={{color: "white"}}>Continue</Typography>
                                    </Button>
                                </Box>
                            </form>
                        </Box>
                    </Box>
                </Box>
            </Modal>
            <ModalTicketInformation openModalInformation={openModalInformation} info={info}
              data={data} handleCloseModalInformation={handleCloseModalInformation} handleEdit={handleEditinfo}/>
        </>
    )
}


const top100Films = [
    {label: 'The Shawshank Redemption', year: 1994},
    {label: 'The Godfather', year: 1972},
    {label: 'The Godfather: Part II', year: 1974},
    {label: 'The Dark Knight', year: 2008},
    {label: '12 Angry Men', year: 1957},
    {label: "Schindler's List", year: 1993},
    {label: 'Pulp Fiction', year: 1994},
    {
        label: 'The Lord of the Rings: The Return of the King',
        year: 2003,
    },
    {label: 'The Good, the Bad and the Ugly', year: 1966},
    {label: 'Fight Club', year: 1999},
    {
        label: 'The Lord of the Rings: The Fellowship of the Ring',
        year: 2001,
    },
    {
        label: 'Star Wars: Episode V - The Empire Strikes Back',
        year: 1980,
    },
    {label: 'Forrest Gump', year: 1994},
    {label: 'Inception', year: 2010},
    {
        label: 'The Lord of the Rings: The Two Towers',
        year: 2002,
    },
    {label: "One Flew Over the Cuckoo's Nest", year: 1975},
    {label: 'Goodfellas', year: 1990},
    {label: 'The Matrix', year: 1999},
    {label: 'Seven Samurai', year: 1954},
    {
        label: 'Star Wars: Episode IV - A New Hope',
        year: 1977,
    },
    {label: 'City of God', year: 2002},
    {label: 'Se7en', year: 1995},
    {label: 'The Silence of the Lambs', year: 1991},
    {label: "It's a Wonderful Life", year: 1946},
    {label: 'Life Is Beautiful', year: 1997},
    {label: 'The Usual Suspects', year: 1995},
    {label: 'Léon: The Professional', year: 1994},
    {label: 'Spirited Away', year: 2001},
    {label: 'Saving Private Ryan', year: 1998},
    {label: 'Once Upon a Time in the West', year: 1968},
    {label: 'American History X', year: 1998},
    {label: 'Interstellar', year: 2014},
    {label: 'Casablanca', year: 1942},
    {label: 'City Lights', year: 1931},
    {label: 'Psycho', year: 1960},
    {label: 'The Green Mile', year: 1999},
    {label: 'The Intouchables', year: 2011},
    {label: 'Modern Times', year: 1936},
    {label: 'Raiders of the Lost Ark', year: 1981},
    {label: 'Rear Window', year: 1954},
    {label: 'The Pianist', year: 2002},
    {label: 'The Departed', year: 2006},
    {label: 'Terminator 2: Judgment Day', year: 1991},
    {label: 'Back to the Future', year: 1985},
    {label: 'Whiplash', year: 2014},
    {label: 'Gladiator', year: 2000},
    {label: 'Memento', year: 2000},
    {label: 'The Prestige', year: 2006},
    {label: 'The Lion King', year: 1994},
    {label: 'Apocalypse Now', year: 1979},
    {label: 'Alien', year: 1979},
    {label: 'Sunset Boulevard', year: 1950},
    {
        label: 'Dr. Strangelove or: How I Learned to Stop Worrying and Love the Bomb',
        year: 1964,
    },
    {label: 'The Great Dictator', year: 1940},
    {label: 'Cinema Paradiso', year: 1988},
    {label: 'The Lives of Others', year: 2006},
    {label: 'Grave of the Fireflies', year: 1988},
    {label: 'Paths of Glory', year: 1957},
    {label: 'Django Unchained', year: 2012},
    {label: 'The Shining', year: 1980},
    {label: 'WALL·E', year: 2008},
    {label: 'American Beauty', year: 1999},
    {label: 'The Dark Knight Rises', year: 2012},
    {label: 'Princess Mononoke', year: 1997},
    {label: 'Aliens', year: 1986},
    {label: 'Oldboy', year: 2003},
    {label: 'Once Upon a Time in America', year: 1984},
    {label: 'Witness for the Prosecution', year: 1957},
    {label: 'Das Boot', year: 1981},
    {label: 'Citizen Kane', year: 1941},
    {label: 'North by Northwest', year: 1959},
    {label: 'Vertigo', year: 1958},
    {
        label: 'Star Wars: Episode VI - Return of the Jedi',
        year: 1983,
    },
    {label: 'Reservoir Dogs', year: 1992},
    {label: 'Braveheart', year: 1995},
    {label: 'M', year: 1931},
    {label: 'Requiem for a Dream', year: 2000},
    {label: 'Amélie', year: 2001},
    {label: 'A Clockwork Orange', year: 1971},
    {label: 'Like Stars on Earth', year: 2007},
    {label: 'Taxi Driver', year: 1976},
    {label: 'Lawrence of Arabia', year: 1962},
    {label: 'Double Indemnity', year: 1944},
    {
        label: 'Eternal Sunshine of the Spotless Mind',
        year: 2004,
    },
    {label: 'Amadeus', year: 1984},
    {label: 'To Kill a Mockingbird', year: 1962},
    {label: 'Toy Story 3', year: 2010},
    {label: 'Logan', year: 2017},
    {label: 'Full Metal Jacket', year: 1987},
    {label: 'Dangal', year: 2016},
    {label: 'The Sting', year: 1973},
    {label: '2001: A Space Odyssey', year: 1968},
    {label: "Singin' in the Rain", year: 1952},
    {label: 'Toy Story', year: 1995},
    {label: 'Bicycle Thieves', year: 1948},
    {label: 'The Kid', year: 1921},
    {label: 'Inglourious Basterds', year: 2009},
    {label: 'Snatch', year: 2000},
    {label: '3 Idiots', year: 2009},
    {label: 'Monty Python and the Holy Grail', year: 1975},
];

const numberCountry = [
    {label: "+98"},
    {label: "+85"},
    {label: "+1"},
]


export default ModalPassengerInformation;
