import React from "react";
import { Accordion, AccordionDetails, AccordionSummary, Autocomplete, Box, Button, Checkbox, FormControl, FormControlLabel, FormGroup, FormLabel, InputAdornment, Radio, RadioGroup, Rating, Slider, TextField, ToggleButton, ToggleButtonGroup, Typography } from "@mui/material";
import customTheme from "../custom";
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import LocationOnIcon from '@mui/icons-material/LocationOn';
import TuneIcon from '@mui/icons-material/Tune';


declare module '@mui/material/Typography' {
    interface TypographyPropsVariantOverrides {
      H6Semibold: true;
      Subtitle1Semibold : true;
    }
  }

  const theme : any = customTheme.palette


  function valuetext(value) {
    return `$ ${value}`;
  }


  const check = [
    {
        label : "Fall 2023"
    },
    {
        label : "Winter 2024"
    },
    {
        label : "Winter 2024"
    },
    {
        label : "Spring 2024"
    },
    {
        label : "Summer 2024"
    },
    {
        label : "Fall 2024"
    },
    {
        label : "Winter 2025"
    },
    {
        label : "Spring 2025"
    },
    {
        label : "Summer 2025"
    },
]

const toggle = [
    {text : "Programming"},
    {text : "Laguage"},
    {text : "Sport"},
    {text : "Nature"},
    {text : "Dance"},
    {text : "Music"},
    {text : "Art"},
    {text : "Science"},
    {text : "Computer"},
    {text : "Historical"},
    {text : "AI"},
]

const radio = [
    {text : "Economy" , value : "economy"},
    {text : "Business" , value : "business"},
    {text : "Premium" , value : "premium"},
]

const type = [
    {text : "Private" , value : "private"},
    {text : "Public" , value : "public"},
    {text : "All" , value : "all"},
]

const tourDestinationCountry = [
    {label : "iran"},
    {label : "usa"},
    {label : "germany"},
    {label : "italy"},
]

const tourDestinationCity = [
    {label : "isfahan"},
    {label : "tehran"},
    {label : "zanjan"},
    {label : "yazd"},
]

const meals = [
    {label : "Breakfast"},
    {label : "Launch"},
    {label : "Dinner"},
]

const Sidebar = () => {

    const [value, setValue] = React.useState([150, 1000]);
    const [age, setAge] = React.useState([20, 80]);
    const [tourSize, setTourSize] = React.useState(400);
    const [location, setLocation] = React.useState(60000);
    const [showAllCheckboxes, setShowAllCheckboxes] = React.useState(false);
    const [selectedCheckboxes, setSelectedCheckboxes] = React.useState<string[]>([]);
    const [selectedCheckboxesMeals, setSelectedCheckboxesMeals] = React.useState<string[]>([]);
    const [formats, setFormats] = React.useState<string[]>([]);
    const [rating, setRating] = React.useState(5);


    const handleChange = (event, newValue) => {
      setValue(newValue);
    };

    const handleChangeAge = (event, newValue) => {
      setAge(newValue);
    };

    const handleChangeTourSize = (event, newValue) => {
        setTourSize(newValue);
    };

    const handleChangeLocation = (event, newValue) => {
        setLocation(newValue);
    };


    const handleCheckboxChange = (lable) => {
        const updatedCheckboxes = [...selectedCheckboxes];
    
        if (updatedCheckboxes.includes(lable)) {
          
            updatedCheckboxes.splice(updatedCheckboxes.indexOf(lable), 1);
        } else {
            updatedCheckboxes.push(lable);
        }
    
        setSelectedCheckboxes(updatedCheckboxes);
    };


    const handleCheckboxMeals = (lable) => {
        const updatedCheckboxes = [...selectedCheckboxesMeals];
    
        if (updatedCheckboxes.includes(lable)) {
          
            updatedCheckboxes.splice(updatedCheckboxes.indexOf(lable), 1);
        } else {
            updatedCheckboxes.push(lable);
        }
    
        setSelectedCheckboxesMeals(updatedCheckboxes);
    };

      const handleFormat = (event: React.MouseEvent<HTMLElement>, newFormats: string[]) => {
        setFormats(newFormats);
      };


    return (
        <Box p={2} borderRadius="14px" bgcolor={theme.gray.tint3}>
            <Box sx={{display : "flex" , justifyContent : "space-between" , alignItems : "center"}}>
                <Box sx={{display : "flex" , alignItems : "center"}}>
                    <TuneIcon/>
                    <Typography ml={1} variant="H6Semibold">Filters</Typography>
                </Box>
                <Button sx={{":hover":{bgcolor : "transparent"} , textTransform : "none" , color : "red" }} disableRipple variant="text">Rest Filters</Button>
            </Box>

            <Box mt={4}>
                <Accordion sx={{boxShadow : "none" }} >
                    <AccordionSummary
                      
                    sx={{backgroundColor : theme.gray.tint3, p : 0}}
                    
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                    >
                    <Typography variant="Subtitle1Semibold">Price</Typography>
                    </AccordionSummary>
                    <AccordionDetails sx={{backgroundColor : theme.gray.tint3}}>
                        <Slider
                            getAriaLabel={() => 'Temperature range'}
                            value={value}
                            onChange={handleChange}
                            valueLabelDisplay="auto"
                            getAriaValueText={valuetext}
                            min={2}
                            max={2000}
                            sx={{color : theme.primary.main}}
                            
                        />
                        <Box display="flex" justifyContent="space-between" alignItems="center" >
                            <Typography variant="body1">From $2</Typography>
                            <Typography variant="body1">To $2000</Typography>
                        </Box>
                    </AccordionDetails>
                </Accordion>
                <Accordion sx={{boxShadow : "none" }} >
                    <AccordionSummary
                      
                    sx={{backgroundColor : theme.gray.tint3, p : 0}}
                    
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                    >
                        <Typography variant="Subtitle1Semibold">Tour Season</Typography>
                    </AccordionSummary>
                    <AccordionDetails sx={{backgroundColor : theme.gray.tint3}}>
                        <FormGroup>
                            {check.slice(0,3).map((item , index)=>
                                <Box key={index} sx={{display : "flex" , alignItems : "center"}}>
                                    <Checkbox onChange={() => handleCheckboxChange(item.label)} sx={{color : theme.primary.main,'&.Mui-checked': {color: theme.primary.main}}} />
                                    <Typography variant="subtitle1">{item.label}</Typography>
                                </Box>
                            )}
                            {showAllCheckboxes && check.slice(3,check.length).map((item , index)=>
                                <Box key={index} sx={{display : "flex" , alignItems : "center"}}>
                                    <Checkbox onChange={() => handleCheckboxChange(item.label)} sx={{color : theme.primary.main,'&.Mui-checked': {color: theme.primary.main}}} />
                                    <Typography variant="subtitle1">{item.label}</Typography>
                                </Box>
                            )}
                        </FormGroup>
                        <Box textAlign="center" mt={1}>
                            <Button variant="outlined" sx={{textTransform : "unset" , mx : "auto" , color : theme.primary.main , borderColor : theme.primary.main ,borderRadius : "12px" , ":hover" : {borderColor : theme.primary.main }}} onClick={() => setShowAllCheckboxes(!showAllCheckboxes)}>
                                {showAllCheckboxes ? 'Show Less' : 'Show More'}
                            </Button>
                        </Box>
                    </AccordionDetails>
                </Accordion>
                <Accordion sx={{boxShadow : "none" }} >
                    <AccordionSummary
                      
                    sx={{backgroundColor : theme.gray.tint3, p : 0}}
                    
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                    >
                        <Typography variant="Subtitle1Semibold">Subject</Typography>
                    </AccordionSummary>
                    <AccordionDetails sx={{backgroundColor : theme.gray.tint3}}>
                        <Box>
                            <ToggleButtonGroup
                                value={formats}
                                onChange={handleFormat}
                                aria-label="text formatting"
                                sx={{display : "flex" , flexWrap : "wrap" , rowGap : 1}}
                                >
                                    {toggle.map((item, index) => {
                                        return (
                                            <ToggleButton key={index} sx={{flexGrow : 1}} value={item.text} aria-label={item.text} style={{textTransform : "unset", borderRadius : "8px" , border : "0px" , marginRight : "5px" , backgroundColor : formats.includes(item.text) ? theme.primary.main : theme.gray.tint1}}>
                                                <Typography color={ formats.includes(item.text) ? "white" : "black" }  component="p" variant='Subtitle2Semibold'>
                                                    {item.text}
                                                </Typography>
                                            </ToggleButton>
                                        )
                                    })}
                            </ToggleButtonGroup>
                        </Box>
                    </AccordionDetails>
                </Accordion>
                <Accordion sx={{boxShadow : "none" }} >
                    <AccordionSummary
                      
                    sx={{backgroundColor : theme.gray.tint3, p : 0}}
                    
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                    >
                        <Typography variant="Subtitle1Semibold">Tour Size</Typography>
                    </AccordionSummary>
                    <AccordionDetails sx={{backgroundColor : theme.gray.tint3}}>
                        <Slider
                        aria-label="Volume"
                        value={tourSize}
                        onChange={handleChangeTourSize}
                        valueLabelDisplay="auto"
                        min={0}
                        max={1000}
                        sx={{color : theme.primary.main}} 
                        />
                        <Box display="flex" justifyContent="space-between" alignItems="center" >
                            <Typography variant="body1">5 People</Typography>
                            <Typography variant="body1">1000 People</Typography>
                        </Box>
                    </AccordionDetails>
                </Accordion>
                <Accordion sx={{boxShadow : "none" }} >
                    <AccordionSummary
                      
                    sx={{backgroundColor : theme.gray.tint3, p : 0}}
                    
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                    >
                        <Typography variant="Subtitle1Semibold">Age Limit</Typography>
                    </AccordionSummary>
                    <AccordionDetails sx={{backgroundColor : theme.gray.tint3}}>
                        <Slider
                            value={age}
                            onChange={handleChangeAge}
                            valueLabelDisplay="auto"
                            min={0}
                            max={100}
                            sx={{color : theme.primary.main}}  
                        />
                        <Box display="flex" justifyContent="space-between" alignItems="center" >
                            <Typography variant="body1">New Born</Typography>
                            <Typography variant="body1">100</Typography>
                        </Box>
                    </AccordionDetails>
                </Accordion>
                <Accordion sx={{boxShadow : "none" }} >
                    <AccordionSummary
                      
                    sx={{backgroundColor : theme.gray.tint3, p : 0}}
                    
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                    >
                        <Typography variant="Subtitle1Semibold">Level</Typography>
                    </AccordionSummary>
                    <AccordionDetails sx={{backgroundColor : theme.gray.tint3}}>
                        <FormControl>
                            <RadioGroup
                                aria-labelledby="demo-radio-buttons-group-label"
                                defaultValue="economy"
                                name="radio-buttons-group"
                            >
                                {radio.map((item,index)=>
                                    <FormControlLabel key={index} value={item.value} control={<Radio sx={{color: theme.primary.main , '&.Mui-checked': {  color: theme.primary.main},}} />} label={item.text} />
                                )}
                            </RadioGroup>
                        </FormControl>
                    </AccordionDetails>
                </Accordion>
                <Accordion sx={{boxShadow : "none" }} >
                    <AccordionSummary
                      
                    sx={{backgroundColor : theme.gray.tint3, p : 0}}
                    
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                    >
                        <Typography variant="Subtitle1Semibold">Type</Typography>
                    </AccordionSummary>
                    <AccordionDetails sx={{backgroundColor : theme.gray.tint3}}>
                        <FormControl>
                            <RadioGroup
                                aria-labelledby="demo-radio-buttons-group-label"
                                defaultValue="public"
                                name="radio-buttons-group"
                            >
                                {type.map((item,index)=>
                                    <FormControlLabel key={index} value={item.value} control={<Radio sx={{color: theme.primary.main , '&.Mui-checked': {  color: theme.primary.main},}} />} label={item.text} />
                                )}
                            </RadioGroup>
                        </FormControl>
                    </AccordionDetails>
                </Accordion>
                <Accordion sx={{boxShadow : "none" }} >
                    <AccordionSummary
                      
                    sx={{backgroundColor : theme.gray.tint3, p : 0}}
                    
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                    >
                        <Typography variant="Subtitle1Semibold">Rating</Typography>
                    </AccordionSummary>
                    <AccordionDetails sx={{backgroundColor : theme.gray.tint3}}>
                        <Rating
                            name="simple-controlled"
                            value={rating}
                            size="large"
                            onChange={(event, newValue : any) => {
                                setRating(newValue);
                            }}
                        />
                    </AccordionDetails>
                </Accordion>
                <Accordion sx={{boxShadow : "none" }} >
                    <AccordionSummary
                      
                    sx={{backgroundColor : theme.gray.tint3, p : 0}}
                    
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                    >
                        <Typography variant="Subtitle1Semibold">Tour Destination</Typography>
                    </AccordionSummary>
                    <AccordionDetails sx={{backgroundColor : theme.gray.tint3}}>
                    <Autocomplete
                        disablePortal
                        id="combo-box-demo"
                        options={tourDestinationCountry}
                        renderInput={(params) =>
                            <TextField 
                                {...params} 
                                sx={{
                                    "& .MuiOutlinedInput-root": {
                                        borderRadius: "14px",
                                    }
                                }}
                                InputProps={{
                                    ...params.InputProps,
                                    startAdornment: (
                                    <InputAdornment position="start">
                                        <LocationOnIcon />
                                    </InputAdornment>
                                    ),
                                }}
                                label="Country" 
                            />
                        }
                    />
                    <Autocomplete
                        sx={{mt : 2}}
                        disablePortal
                        id="combo-box-demo"
                        options={tourDestinationCity}
                        renderInput={(params) =>
                            <TextField 
                                {...params} 
                                sx={{
                                    "& .MuiOutlinedInput-root": {
                                        borderRadius: "14px",
                                    }
                                }}
                                InputProps={{
                                    ...params.InputProps,
                                    startAdornment: (
                                    <InputAdornment position="start">
                                        <LocationOnIcon />
                                    </InputAdornment>
                                    ),
                                }}
                                label="City" 
                            />
                        }
                    />
                    </AccordionDetails>
                </Accordion>
                <Accordion sx={{boxShadow : "none" }} >
                    <AccordionSummary
                      
                    sx={{backgroundColor : theme.gray.tint3, p : 0}}
                    
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                    >
                        <Typography variant="Subtitle1Semibold">Distance from Your Location</Typography>
                    </AccordionSummary>
                    <AccordionDetails sx={{backgroundColor : theme.gray.tint3}}>
                        <Slider
                        value={location}
                        onChange={handleChangeLocation}
                        valueLabelDisplay="auto"
                        min={0}
                        max={100000}
                        sx={{color : theme.primary.main}} 
                        />
                        <Box display="flex" justifyContent="space-between" alignItems="center" >
                            <Typography variant="body1">0</Typography>
                            <Typography variant="body1">100,000 KM</Typography>
                        </Box>
                    </AccordionDetails>
                </Accordion>
                <Accordion sx={{boxShadow : "none" }} >
                    <AccordionSummary
                      
                    sx={{backgroundColor : theme.gray.tint3, p : 0}}
                    
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                    >
                        <Typography variant="Subtitle1Semibold">Tour Season</Typography>
                    </AccordionSummary>
                    <AccordionDetails sx={{backgroundColor : theme.gray.tint3}}>
                        <FormGroup>
                            {meals.map((item , index)=>
                                <Box key={index} sx={{display : "flex" , alignItems : "center"}}>
                                    <Checkbox onChange={() => handleCheckboxMeals(item.label)} sx={{color : theme.primary.main,'&.Mui-checked': {color: theme.primary.main}}} />
                                    <Typography variant="subtitle1">{item.label}</Typography>
                                </Box>
                            )}
                        </FormGroup>
                    </AccordionDetails>
                </Accordion>
            </Box>

        </Box>
    )
}

export default Sidebar;