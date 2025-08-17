import { Box, Button, Card, CardActionArea, CardContent, CardMedia, Checkbox, InputLabel, SelectChangeEvent, TextField, Typography , FormControl, MenuItem, Select, Grid, InputAdornment  } from '@mui/material';
import * as React from 'react';
import BookmarkBorderIcon from '@mui/icons-material/BookmarkBorder';
import BookmarkIcon from '@mui/icons-material/Bookmark';
import customTheme from '../../custom';
import SearchIcon from '@mui/icons-material/Search';




const card = [
    {
        img:"https://toohotel.com/wp-content/uploads/2022/09/TOO_Hotel_Suite_Bathroom_Panoramique.jpg",
        hotel : "Ground Hotel",
        class : "Distance  from Class 0.8 Km ",
        option1 : "Free cancelation",
        option2 : "Pay at the property",
        option3 : "Breakfast included",
        price : "Single from  $722",
        travelers : "2 travelers",
        total : "$1605 total",
        point : "(7.4 point)",
        id : "19"
    },
    {
        img:"https://toohotel.com/wp-content/uploads/2022/09/TOO_Hotel_Suite_Bathroom_Panoramique.jpg",
        hotel : "Ground Hotel",
        class : "Distance  from Class 0.8 Km ",
        option1 : "Free cancelation",
        option2 : "Pay at the property",
        option3 : "Breakfast included",
        price : "Single from  $722",
        travelers : "2 travelers",
        total : "$1605 total",
        point : "(7.4 point)",
        id : "29"
    },
    {
        img:"https://toohotel.com/wp-content/uploads/2022/09/TOO_Hotel_Suite_Bathroom_Panoramique.jpg",
        hotel : "Ground Hotel",
        class : "Distance  from Class 0.8 Km ",
        option1 : "Free cancelation",
        option2 : "Pay at the property",
        option3 : "Breakfast included",
        price : "Single from  $722",
        travelers : "2 travelers",
        total : "$1605 total",
        point : "(7.4 point)",
        id : "39"
    },
    {
        img:"https://toohotel.com/wp-content/uploads/2022/09/TOO_Hotel_Suite_Bathroom_Panoramique.jpg",
        hotel : "Ground Hotel",
        class : "Distance  from Class 0.8 Km ",
        option1 : "Free cancelation",
        option2 : "Pay at the property",
        option3 : "Breakfast included",
        price : "Single from  $722",
        travelers : "2 travelers",
        total : "$1605 total",
        point : "(7.4 point)",
        id : "49"
    },
    {
        img:"https://toohotel.com/wp-content/uploads/2022/09/TOO_Hotel_Suite_Bathroom_Panoramique.jpg",
        hotel : "Ground Hotel",
        class : "Distance  from Class 0.8 Km ",
        option1 : "Free cancelation",
        option2 : "Pay at the property",
        option3 : "Breakfast included",
        price : "Single from  $722",
        travelers : "2 travelers",
        total : "$1605 total",
        point : "(7.4 point)",
        id : "59"
    },
    
]

const AccommodationHotel = ({handleClickOpenBook}) =>{

    const [age, setAge] = React.useState('');
    const [checkedIds, setCheckedIds] = React.useState<string[]>([]);
    const theme : any = customTheme.palette;

    const handleChange = (event: SelectChangeEvent) => {
      setAge(event.target.value as string);
    };
    React.useEffect(() => {
        const checkedIds = localStorage.getItem('Bookmark');
        if (checkedIds) {
  
          setCheckedIds(JSON.parse(checkedIds));
        }
      }, []);
    
    
      const handleCheckboxClick = (id) => {
        let tempCheckedIds = checkedIds
        if (tempCheckedIds.includes(id)) {
            tempCheckedIds = tempCheckedIds.filter((checkedId) => checkedId !== id)
            setCheckedIds(tempCheckedIds);
        } else {
            tempCheckedIds = [...tempCheckedIds , id]
            setCheckedIds(tempCheckedIds);
        }
    
       
        localStorage.setItem('Bookmark', JSON.stringify(tempCheckedIds));
      };

    
    return (
        <>
            <Typography component={"h4"} variant='h4' mt={5}>
                Recommend by the trainer
            </Typography>
            <Box className="scrollbarInputs" mt={2} sx={{display : "flex" , p : 2}}>
                {card.map((item , index) => {
                    const isLastItem = index === card.length - 1;
                    return(
                        <Box key={index} sx={{position : "relative" ,boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)", borderRadius : "12px" , p:2 , minWidth:"18rem" , mr: isLastItem ? 0 : 2}}>
                            <Box>
                            <img style={{width: "100%" , height : "16rem" , borderRadius : "12px" }} src={item.img} alt="image" />
                            <Checkbox onClick={() => handleCheckboxClick(item.id)} checked={checkedIds.includes(item.id)}
                                sx={{position : "absolute" , top : "1rem" , right : "1rem"}}
                                icon={<BookmarkBorderIcon sx={{fontSize : "30px" , color : "red"}} />}
                                checkedIcon={<BookmarkIcon sx={{fontSize : "30px" , color : "red"}} />}
                            />
                            </Box>
                            <Box sx={{display : "flex" , justifyContent : "space-between" , alignItems : "center" ,mt:3 }}>
                                <Typography variant='h5'>
                                    {item.hotel}
                                </Typography>
                                <Typography variant='body2'>
                                    {item.point}
                                </Typography>
                            </Box>
                            <Typography variant='body1'>
                                {item.class} 
                            </Typography>
                            <Box  mt = {3} sx={{display : "flex" , justifyContent : "space-between"}}>
                                <Box sx={{pl : 2 }}>
                                    <ul style={{listStyleType : "disc" , paddingLeft:"1rem"}}>
                                        <li><Typography variant='body2'>{item.option1}</Typography></li>
                                        <li><Typography variant='body2'>{item.option2}</Typography></li>
                                        <li><Typography variant='body2'>{item.option3}</Typography></li>
                                    </ul>
                                </Box>
                                <Box sx={{textAlign : "end"}}>
                                    <Typography variant='h6'>{item.price}</Typography>
                                    <Typography sx={{color : "#919191"}} variant='body2'>{item.travelers}</Typography>
                                    <Typography sx={{color : "#919191"}} variant='body2'>{item.total}</Typography>
                                </Box>
                            </Box>
                            <Button onClick={handleClickOpenBook} sx={{mt:3}} style={{width : "100%" , borderRadius : "48px" , backgroundColor : theme.button , color : "white"}}>
                                <Typography variant='h6'>Book</Typography>
                            </Button>
                        </Box>
                    )
                })}
            </Box>
            <Box sx={{boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)", borderRadius : "12px" , width : "100%" , height : "291px" , mt:5}}>
                <img src="https://miro.medium.com/v2/resize:fit:1400/1*qYUvh-EtES8dtgKiBRiLsA.png" alt="" style={{width : "100%" , height : "291px"}}/>
            </Box>
            <Box sx={{boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)", borderRadius : "12px" , p:1 , mt:5 , display : "flex" , justifyContent : "space-between" , gap : 3 }} flexWrap={{xs : "wrap", sm : "unset"}}>
                <FormControl fullWidth>
                    <InputLabel id="demo-simple-select-label">Age</InputLabel>
                    <Select
                    labelId="demo-simple-select-label"
                    id="demo-simple-select"
                    value={age}
                    label="Age"
                    onChange={handleChange}
                    style={{borderRadius : "16px"}}
                    >
                    <MenuItem value={10}>Ten</MenuItem>
                    <MenuItem value={20}>Twenty</MenuItem>
                    <MenuItem value={30}>Thirty</MenuItem>
                    </Select>
                </FormControl>
                <TextField  InputProps={{ style: {  borderRadius: "16px", } }}  fullWidth  type='date'/>
                <TextField  InputProps={{ style: {  borderRadius: "16px", } }} sx={{borderRadius : "16px"}} fullWidth  type='date'/>
                <Button endIcon={<SearchIcon/>} style={{ borderRadius : "16px" , backgroundColor : "black" , color : "white" , padding : "12px" , width : "23rem" }} >
                    Search
                </Button> 
            </Box>
            <TextField sx={{mt : 3 }} InputProps={{ style: {  borderRadius: "16px" ,boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)"  , } , endAdornment: ( <InputAdornment position="end"> <SearchIcon /> </InputAdornment> ) }}  fullWidth type='search' placeholder='Search' /> 
            <Box className="scrollbarInputs" mt={2} sx={{display : "flex" , p : 2}}>
                {card.map((item , index) => {
                    const isLastItem = index === card.length - 1;
                    return(
                        <Box key={index} sx={{position : "relative" ,boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)", borderRadius : "12px" , p:2 , minWidth:"18rem" , mr: isLastItem ? 0 : 2}}>
                            <Box>
                            <img style={{width: "100%" , height : "16rem" , borderRadius : "12px" }} src={item.img} alt="image" />
                            <Checkbox
                                onClick={() => handleCheckboxClick(item.id)}
                                sx={{position : "absolute" , top : "1rem" , right : "1rem"}}
                                icon={<BookmarkBorderIcon sx={{fontSize : "30px" , color : "red"}} />}
                                checkedIcon={<BookmarkIcon sx={{fontSize : "30px" , color : "red"}} />}
                            />
                            </Box>
                            <Box sx={{display : "flex" , justifyContent : "space-between" , alignItems : "center" ,mt:3 }}>
                                <Typography variant='h5'>
                                    {item.hotel}
                                </Typography>
                                <Typography variant='body2'>
                                    {item.point}
                                </Typography>
                            </Box>
                            <Typography variant='body1'>
                                {item.class} 
                            </Typography>
                            <Box  mt = {3} sx={{display : "flex" , justifyContent : "space-between"}}>
                                <Box sx={{pl : 2 }}>
                                    <ul style={{listStyleType : "disc" , paddingLeft:"1rem"}}>
                                        <li><Typography variant='body2'>{item.option1}</Typography></li>
                                        <li><Typography variant='body2'>{item.option2}</Typography></li>
                                        <li><Typography variant='body2'>{item.option3}</Typography></li>
                                    </ul>
                                </Box>
                                <Box sx={{textAlign : "end"}}>
                                    <Typography variant='h6'>{item.price}</Typography>
                                    <Typography sx={{color : "#919191"}} variant='body2'>{item.travelers}</Typography>
                                    <Typography sx={{color : "#919191"}} variant='body2'>{item.total}</Typography>
                                </Box>
                            </Box>
                            <Button onClick={handleClickOpenBook} sx={{mt:3}} style={{width : "100%" , borderRadius : "48px" , backgroundColor : theme.button , color : "white"}}>
                                <Typography variant='h6'>Book</Typography>
                            </Button>
                        </Box>
                    )
                })}
            </Box>
        </>
    )
}
export default AccommodationHotel;