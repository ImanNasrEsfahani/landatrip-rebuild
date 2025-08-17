import React, {useEffect, useState } from 'react';

import { Box, Button, Dialog, DialogContent, DialogContentText, DialogTitle, Grid, IconButton, Rating, Typography } from "@mui/material";
import CloseIcon from '@mui/icons-material/Close';
import ArrowForwardIosIcon from '@mui/icons-material/ArrowForwardIos';
import ArrowBackIosNewIcon from '@mui/icons-material/ArrowBackIosNew';
import StarIcon from '@mui/icons-material/Star';
import RouteIcon from '@mui/icons-material/Route';
import PlaceIcon from '@mui/icons-material/Place';
import CoffeeIcon from '@mui/icons-material/Coffee';
import HotTubIcon from '@mui/icons-material/HotTub';
import PoolIcon from '@mui/icons-material/Pool';
import LocalParkingIcon from '@mui/icons-material/LocalParking';
import RestaurantIcon from '@mui/icons-material/Restaurant';
import WifiIcon from '@mui/icons-material/Wifi';
import AddCircleIcon from "@mui/icons-material/AddCircle";
import RemoveCircleIcon from '@mui/icons-material/RemoveCircle';

import customTheme from "../../custom";

// declare module '@mui/material/Typography' {
//   interface TypographyPropsVariantOverrides {
//     H2Bold: true;
//     Subtitle1Bold: true;
//     H6Semibold: true;
//     Subtitle1Semibold: true;
//     h5Semibold: true;
//     Subtitle2Semibold: true;
//   }
// }

const theme : any = customTheme.palette

const DialogBook = ({handleCloseBook, openBook ,info }) =>{
    console.log(info[0]?.hotel)
    const [optionHotel , setOptionHotel] = useState({
  image : [
    {
        src : "https://source.unsplash.com/random/800x450?sig=1",
        id : 1
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=2",
        id : 2
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=3",
        id : 3
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=4",
        id : 4
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=5",
        id : 5
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=6",
        id : 6
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=7",
        id : 7
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=8",
        id : 8
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=9",
        id : 9
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=10",
        id : 10
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=11",
        id : 11
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=12",
        id : 12
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=13",
        id : 13
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=14",
        id : 14
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=15",
        id : 15
    },
    {
        src : "https://source.unsplash.com/random/800x450?sig=16",
        id : 16
    },
  ],
  option : [
    {
      icon : <CoffeeIcon fontSize='small' />,
      text : "Breakfast available"
    },
    {
      icon : <HotTubIcon fontSize='small' />,
      text : "Hot Tub"
    },
    {
      icon : <PoolIcon fontSize='small' />,
      text : "Pool"
    },
    {
      icon : <LocalParkingIcon fontSize='small' />,
      text : "Parking available"
    },
    {
      icon : <RestaurantIcon fontSize='small' />,
      text : "Restaurant"
    },
    {
      icon : <WifiIcon fontSize='small' />,
      text : "Free WiFi"
    },
  ],
  food : [
    {
      food : "Daily continental breakfast available for a fee: USD 25–35 per person",
    },
    {
      food : "4 restaurants",
    },
    {
      food: "A bar/lounge",
    },
    {
      food: "A coffee shop/cafe",
    },
    {
      food: "A poolside bar",
    },
    {
      food: "Couples/private dining",
    }
  ],
  internet : [
    {
      int : "Available in all rooms: WiFi (USD 14.95 per night)",
    },
    {
      int : "Available in some public areas: Free WiFi",
    },
  ],
  room : [
    {
      including : [
        {
          item : "TV"
        },
        {
          item : "Television"
        },
        {
          item : "Lundry"
        },
      ],
      excluding : [
        {
          item : "Breakfast"
        },
        {
          item : "Wi-Fi"
        },

      ],
      img : "https://source.unsplash.com/random/800x450?sig=26",
      value : 0,
      discount:20,
      previousPrice:370,
      price:270,
      title : "Twin room",
      capacity : "2 persons",
      id:1
    },
    {
      including : [
        {
          item : "TV"
        },
        {
          item : "Television"
        },
        {
          item : "Lundry"
        },
      ],
      excluding : [
        {
          item : "Breakfast"
        },
        {
          item : "Wi-Fi"
        },

      ],
      img : "https://source.unsplash.com/random/800x450?sig=20",
      value : 0,
      discount:20,
      previousPrice:370,
      price:270,
      title : "Twin room",
      capacity : "2 persons",
      id:2
    },
    {
      including : [
        {
          item : "TV"
        },
        {
          item : "Television"
        },
        {
          item : "Lundry"
        },
      ],
      excluding : [
        {
          item : "Breakfast"
        },
        {
          item : "Wi-Fi"
        },

      ],
      img : "https://source.unsplash.com/random/800x450?sig=21",
      value : 0,
      discount:20,
      previousPrice:370,
      price:270,
      title : "Twin room",
      capacity : "2 persons",
      id:3
    },
    {
      including : [
        {
          item : "TV"
        },
        {
          item : "Television"
        },
        {
          item : "Lundry"
        },
      ],
      excluding : [
        {
          item : "Breakfast"
        },
        {
          item : "Wi-Fi"
        },

      ],
      img : "https://source.unsplash.com/random/800x450?sig=22",
      value : 0,
      discount:20,
      previousPrice:370,
      price:270,
      title : "Twin room",
      capacity : "2 persons",
      id:4
    },
  ]})
    const [currentImageIndex, setCurrentImageIndex] = useState(0);
    const [isClicked, setIsClicked] = useState(false);
    const [isClickedBack, setIsClickedBack] = useState(false);


    // ----------------------animation-----------------------------
      const handleClick = () => {
        setIsClicked(true);
        setTimeout(() => setIsClicked(false), 1000);
    };
      const handleClickBack = () => {
        setIsClickedBack(true);
        setTimeout(() => setIsClickedBack(false), 1000);
    };
    // ---------------------- end animation-----------------------------


    const handleNextImage = () => {
      setCurrentImageIndex((prevIndex) =>
        prevIndex === optionHotel.image.length - 1 ? 0 : prevIndex + 1
      );
      handleClick()

    };

    const handlePrevImage = () => {
      setCurrentImageIndex((prevIndex) =>
        prevIndex === 0 ? optionHotel.image.length - 1 : prevIndex - 1
      );
      handleClickBack()
    };

    const handleImageClick = (id) => {
        const index = optionHotel.image.findIndex(item => item.id === id);
        setCurrentImageIndex(index);
        handleClick()
    };

    const descriptionElementRef = React.useRef<HTMLElement>(null);
    React.useEffect(() => {
      if (openBook) {
        const { current: descriptionElement } = descriptionElementRef;
        if (descriptionElement !== null) {
          descriptionElement.focus();
        }
      }
    }, [openBook]);


    const handleCountService = (id,change) => {
      let countAdultCopy = [...optionHotel.room]
      const filteredArr = optionHotel.room.filter((item) => {
          return item.id == id;
      });

      if (change === "increment") {
          filteredArr[0].value++;
      } else if (change === "decrement" && filteredArr[0].value > 0) {
          filteredArr[0].value--;
      }

      countAdultCopy.splice(countAdultCopy.findIndex((element) => element.id == id),1,filteredArr[0]);
      setOptionHotel({ ...optionHotel, room: countAdultCopy });

      // setOptionHotel(countAdultCopy);

  };


  optionHotel.image.slice(currentImageIndex,currentImageIndex+4).map(item => {console.log("item", item)})

    return(
        <Dialog
        open={openBook}
        maxWidth="xl"
        aria-labelledby="scroll-dialog-title"
        aria-describedby="scroll-dialog-description"
      >
        <Box p={2}>
            <Box display={"flex"} justifyContent={"end"}>
              <IconButton
                aria-label="close"
                onClick={handleCloseBook}
                sx={{
                  color: "red",
                }}
              >
                <CloseIcon />
              </IconButton>
            </Box>

          <DialogContent sx={{ overflow: 'auto' }} >
              <Box className="scrollbarInputs" sx={{pr:1}} style={{ maxHeight: "70vh", overflow: 'auto' }}>


                <Grid container display="flex" alignItems="stretch" spacing={1}>
                  <Grid item xs={12} md={8}>
                    <Box position={"relative"}>
                      <IconButton sx={{position : "absolute" , left : 5 , top:"50%" , bgcolor : "white" , color:"black" , ":hover":{bgcolor : "white"}}} onClick={handlePrevImage}>
                        <ArrowBackIosNewIcon />
                      </IconButton>
                      <IconButton sx={{position : "absolute" , right : 5 , top:"50%" , bgcolor : "white" , color:"black" , ":hover":{bgcolor : "white"} }} onClick={handleNextImage}>
                        <ArrowForwardIosIcon />
                      </IconButton>
                      <img
                      className={`animate__animated ${isClicked && "animate__fadeInRight" } ${isClickedBack && "animate__fadeInLeft"}`}
                      style={{ width: "100%", height: "100%" , borderRadius : "8px" }}
                      src={optionHotel.image[currentImageIndex].src}
                      alt="s"
                      />
                    </Box>
                  </Grid>
                  <Grid item xs={12} md={4}>
                    <Grid container spacing={1} height={"100%"} alignItems="stretch" display={{xs : "none" , sm : "flex"}}>
                      {[0, 1, 2, 3].map(index => {
                        const slide = optionHotel.image[currentImageIndex + index];

                        return (
                          <Grid item xs={3} md={6} key={index}>
                            <Button sx={{height:"100%", padding: 0 , borderRadius : "8px"}} onClick={() => slide && handleImageClick(slide.id)}>
                              <img
                                className={`animate__animated ${(isClickedBack || isClicked) && "animate__zoomIn"}`}
                                style={{ width: "100%", height: "100%" , borderRadius : "8px" , objectFit : "cover" }}
                                src={slide ? slide.src : "https://perspectives.agf.com/wp-content/plugins/accelerated-mobile-pages/images/SD-default-image.png"}
                                alt={slide ? slide.src : 'placeholder'}
                              />
                            </Button>
                          </Grid>
                        );
                      })}
                    </Grid>
                  </Grid>
                </Grid>

                <Box p={1} sx={{boxShadow: "0px 2px 10px 0px rgba(0, 0, 0, 0.10)" , borderRadius : "8px" , mt:2}}>
                  <Box mt={2} display={"flrex"} alignItems={"center"} justifyContent={"space-between"} flexWrap={"wrap"}>
                      <Typography variant='H2Bold' component="h2">{info[0]?.hotel?.hotel?.name}</Typography>
                      <Box bgcolor={theme.bgRating} display={"flex"} alignItems={"center"} px={2} py={1} borderRadius={2}>
                          <StarIcon sx={{color :  theme.star}}/>
                          <Typography variant='H6Semibold' component={"p"} >7.4</Typography>
                      </Box>
                  </Box>
                  <Box pl={1} mt={{xs : 2 , sm : 0}}>
                    <Rating name="star" value={6} sx={{color : theme.star}} readOnly size='small' />
                    <Box display={"flex"} alignItems={"center"} mt={1}>
                      <RouteIcon fontSize='small' sx={{color : theme.star}}/>
                      <Typography ml={1} variant='subtitle1' component={"p"}>Distance  from class area <Typography variant='H6Semibold' component={"span"}>0.8 Km</Typography></Typography>
                    </Box>
                    <Box display={"flex"} alignItems={"center"} >
                      <PlaceIcon fontSize='small' sx={{color : theme.star}}/>
                      <Typography ml={1} variant='Subtitle1Semibold' component={"p"}>Chamran street, Tehran</Typography>
                    </Box>
                    <Grid container spacing={1}>
                      <Grid item xs={12} md={6} lg={5}>
                        <Typography sx={{color : theme.primary.main}} variant='h1Medium' component={"h5"} mt={2}>
                          Property amenities 
                        </Typography>
                        <Grid container mt={1} ml={1}>
                            {optionHotel.option.map((item , index)=>(
                              <Grid key={index} item xs={12} sm={6} display={"flex"} alignItems={"center"}>
                                  {item.icon}
                                  <Typography ml={1} variant='subtitle2' component="p" >{item.text}</Typography>
                              </Grid>
                            ))}
                        </Grid>
                        <Typography mb={1} mt={2} variant="Subtitle1Bold" component={'p'}>Food and drink</Typography>
                            <ul style={{margin : 0 , paddingLeft:"25px"}}>
                              {optionHotel.food.map((item,index)=>(
                                  <li><Typography key={index} component="p" variant='subtitle2'>{item.food}</Typography></li>
                              ))}
                            </ul>
                        <Typography mb={1} mt={2} variant='Subtitle1Bold' component={'p'}>Internet</Typography>
                          <ul style={{margin : 0 , paddingLeft:"25px"}}>
                            {optionHotel.internet.map((item,index)=>(
                                <li><Typography key={index} component="p" variant='subtitle2'>{item.int}</Typography></li>
                            ))}
                          </ul>
                          <Button sx={{mt:2 , bgcolor : "unset" , textTransform : "unset"}} endIcon={<ArrowForwardIosIcon fontSize='small'  sx={{color : theme.secondary.main }}/>}>
                              <Typography variant='subtitle2' sx={{color : theme.secondary.main}}>See All</Typography>
                          </Button>
                      </Grid>
                      <Grid item xs={12} md={6} lg={7} sx={{position : "relative" }}>
                        <img src="https://miro.medium.com/v2/resize:fit:1400/1*qYUvh-EtES8dtgKiBRiLsA.png" alt="" style={{width : "100%" , height : "100%" , borderRadius : "12px"}}/>
                      </Grid>
                    </Grid>
                  </Box>
                </Box>
                  {optionHotel.room.map((item , index)=>(
                    <Box key={index}  mt={6} display={"flex"} flexWrap={{xs : "wrap" , sm : "unset"}} justifyContent={{xs : "center" , sm : "unset"}} sx={{boxShadow: "0px 2px 10px 0px rgba(0, 0, 0, 0.10)" , borderRadius : "8px"}}>
                        <Box sx={{position : "relative" }}>
                          <Box borderRadius={{xs : "8px 8px 0px 0px" , sm : "8px 0px 0px 0px"}} sx={{bgcolor : theme.secondary.main , opacity : "0.7" , position :"absolute", width:"100%" , textAlign : "center"}}>
                            <Typography variant='subtitle2' component={"p"} sx={{color : "white"}} >20 %</Typography>
                          </Box>
                          <Box width={{xs : "100%" , sm : "12.3rem"}} borderRadius={{xs : "8px" , sm : "8px 0px 0px 8px"}} sx={{ height : "100%" , overflow : "hidden"}}>
                            <img  src={item.img} alt="jafar" style={{width : "100%" , height : "100%" , objectFit: "cover"}}/>
                          </Box>
                        </Box>
                        <Box width={"100%"} ml={2}>
                          <Box display="flex" justifyContent="space-between" alignItems="center" borderBottom={{xs : "unset" , sm : "1px solid"}} borderColor={theme.gray.main} pr={1} pt={1}>
                            <Box>
                              <Typography variant='H6Semibold' component={"p"}>{item.title}</Typography>
                              <Typography ml={1} mb={1} variant='body1' component={"p"}>{item.capacity}</Typography>
                            </Box>
                            <Box>
                              <Box sx={{
                                  display: "flex",
                                  justifyContent: "space-between",
                                  alignItems: "center",
                                  margin: "10px 0"
                              }}>
                                <IconButton sx={{padding: 0, color: "black"}} onClick={(e) => handleCountService(item.id, "decrement")}>
                                    <RemoveCircleIcon sx={{color : theme.primary.main}}/>
                                </IconButton>
                                <Typography sx={{mx: 1}} variant="Subtitle1Semibold">{item.value}</Typography>
                                <IconButton sx={{padding: 0, color: "black"}} onClick={(e) => handleCountService(item.id, "increment")}>
                                    <AddCircleIcon sx={{color : theme.primary.main}}/>
                                </IconButton>
                              </Box>
                            </Box>
                          </Box>
                          <Grid container mt={1}>
                              <Grid item xs={6}>
                                <Typography mb={1} variant='Subtitle2Semibold' component={"p"}>Including</Typography>
                                <ul style={{margin : 0 , paddingLeft:"25px"}}>
                                  {item.including.map((item , index)=>(
                                    <li key={index}><Typography variant='body1'>{item.item}</Typography></li>
                                  ))}
                                </ul>
                              </Grid>
                              <Grid item xs={6}>
                                <Typography  mb={1} variant='Subtitle2Semibold' component={"p"}>Excluding</Typography>
                                <ul style={{margin : 0 , paddingLeft:"25px"}}>
                                  {item.excluding.map((item , index)=>(
                                    <li key={index}><Typography variant='body1'>{item.item}</Typography></li>
                                  ))}
                                </ul>
                              </Grid>
                          </Grid>
                        </Box>
                        <Box display={"flex"} flexDirection={"column"} alignItems="center" justifyContent="center" p={1} borderLeft={{xs : "unset" , sm : "1px solid"}} borderColor={theme.gray.main}>
                          <Typography className='Typography-container' variant='Subtitle1Semibold' component={"p"}>{`$ ${item.previousPrice}`}</Typography>
                          <Typography variant='H6Semibold' component={"p"} sx={{color : theme.secondary.main}} >{`$ ${item.price}`}</Typography>
                          <Typography variant='subtitle2' component={"p"} >Price for 1 night</Typography>
                          <Button variant='contained' sx={{bgcolor: theme.primary.main , textTransform : "unset" , borderRadius : "12px" , color : "white" , mt:2}} endIcon={<ArrowForwardIosIcon fontSize='small' sx={{color : "white"}}/>} >
                              <Typography sx={{textWrap: "nowrap"}} variant='body1'>Check Availability </Typography>
                          </Button>
                        </Box>
                    </Box>
                  ))}
              <Box display={"flex"} justifyContent={"center"} alignItems={"center"} mt={4} mb={1}>
                <Button variant='contained'  sx={{bgcolor : theme.primary.main , color : "white" , textTransform : "none" , padding : "12px 48px" , borderRadius : "24px" }}>
                  <Typography variant='Subtitle2Semibold' >Continue</Typography>
                </Button>
              </Box>
              </Box>
          </DialogContent>
        </Box>
        </Dialog>
    )
}

export default DialogBook;
