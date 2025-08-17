import React, { useState } from "react";
import { Box, Button, Grid, IconButton, Modal, Typography } from "@mui/material";
import ArrowForwardIosIcon from '@mui/icons-material/ArrowForwardIos';
import ArrowBackIosNewIcon from '@mui/icons-material/ArrowBackIosNew';

const style = {
    position: 'absolute',
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)',
    width: 1000,
    bgcolor: 'background.paper',
    borderRadius : 4,
    boxShadow: 24,
    p: 3,
  };


const Slider = ({open , handleClose , image}) => {
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
          prevIndex === image.length - 1 ? 0 : prevIndex + 1
        );
        handleClick()
  
      };
    
      const handlePrevImage = () => {
        setCurrentImageIndex((prevIndex) =>
          prevIndex === 0 ? image.length - 1 : prevIndex - 1
        );
        handleClickBack()
      };


    return(
        <>
            <Modal
                open={open}
                onClose={handleClose}
                aria-labelledby="modal-modal-title"
                aria-describedby="modal-modal-description"
            >
                <Box sx={style}>
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
                        src={image[currentImageIndex].src}
                        alt="s"
                        />
                        </Box>
                    </Grid>
                    <Grid item xs={12} md={4}>
                        <Grid container spacing={1} height={"100%"} alignItems="stretch" display={{xs : "none" , sm : "flex"}}>
                        {[0, 1, 2, 3].map(index => {
                            const slide = image[currentImageIndex + index];
                            return (
                            <Grid item xs={3} md={6} key={index}>
                                <img
                                    className={`animate__animated ${(isClickedBack || isClicked) && "animate__zoomIn"}`}
                                    style={{ width: "100%", height: "100%" , borderRadius : "8px" , objectFit : "cover" }}
                                    src={slide ? slide.src : "https://perspectives.agf.com/wp-content/plugins/accelerated-mobile-pages/images/SD-default-image.png"}
                                    alt={slide ? slide.src : 'placeholder'}
                                />
                              
                            </Grid>
                            );
                        })}
                        </Grid>
                    </Grid>
                    </Grid>
                </Box>
            </Modal>
        </>
    )
}

export default Slider;