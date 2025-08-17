import { Box, Button, Divider, Grid, Tab, Tabs, Typography } from '@mui/material';
import * as React from 'react';
import customTheme from '../../custom';
import TripTransferringAirplane from './TripTransferringAirplane'
import AirplanemodeActiveIcon from '@mui/icons-material/AirplanemodeActive';
import TrainIcon from '@mui/icons-material/Train';
import DirectionsBusIcon from '@mui/icons-material/DirectionsBus';
import SailingIcon from '@mui/icons-material/Sailing';
import DeleteForeverIcon from '@mui/icons-material/DeleteForever';
import Brightness1Icon from '@mui/icons-material/Brightness1';


interface TabPanelProps {
    children?: React.ReactNode;
    index: number;
    value: number;
}

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

function CustomTabPanel(props: TabPanelProps) {
    const { children, value, index, ...other } = props;

    return (
      <div
        role="tabpanel"
        hidden={value !== index}
        id={`simple-tabpanel-${index}`}
        aria-labelledby={`simple-tab-${index}`}
        {...other}
      >
        {value === index && (
          <Box sx={{ p: 0 }}>
            <Typography component="div">{children}</Typography>
          </Box>
        )}
      </div>
    );
  }

const Step2 = () => {


    const [value, setValue] = React.useState(0);
    const theme : any = customTheme.palette;

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
      setValue(newValue);
    };

    return (
        <Box mt={5}>
            <Typography component="h2" variant="h4Bold" sx={{color : theme.gray.tone3}}>
              Ticket Basket
            </Typography>
            <Box className = "scrollbarInputs" sx={{my : 3 , mx:2 , overflow : "auto" , maxHeight : "34rem" , p :1 , display : "flex" , flexDirection : "column" , rowGap : 2}}>
              <Box sx={{boxShadow: "0px 4px 8px 0px rgba(160, 163, 162, 0.20)" , borderRadius : 2 , p : 2 }}>
                <Grid container>
                  <Grid item xs={6} sx={{display : "flex" , alignItems : "center"}}>
                    <AirplanemodeActiveIcon fontSize='large' sx={{color : theme.primary.main , bgcolor : theme.primary.tint3 , p : 1 , borderRadius : "10px" }}/>
                    <Box sx={{ml : 2}}>
                      <Typography variant='subtitle1Semibold' component="p" sx={{color : theme.gray.tone3}}>Qatar Airways</Typography>
                      <Typography variant='subtitle2' component="p" sx={{color : theme.gray.tone2}}>7 Seats Available | 1 hr 15 min</Typography>
                    </Box>
                  </Grid>
                  <Grid item xs={6} sx={{display : "flex" , flexDirection : "column" , alignItems : "center" , justifyContent : "center"}}>
                    <Box sx={{width: '90%'}}>
                      <Box sx={{display : "flex" , justifyContent : "center" , alignItems : "center" , flexDirection : "column" , position: "relative"}}>
                          <Divider sx={{width : "100%"}}/>
                          <Box sx={{display : "flex" , justifyContent : "space-between" , width : "100%" , alignItems : "center" , position : "absolute"}}>
                          {Array.from({ length: 4 }).map((_, index) => (
                              <Brightness1Icon key={index}  sx={{ color: theme.gray.tone2 , width : "8px" , height :"8px" }} />
                          ))}
                          </Box>
                      </Box>
                    </Box>
                    <Box sx={{width: '96%'}}>
                        <Box sx={{display : "flex" , justifyContent : "center" , alignItems : "center" , flexDirection : "column" , position: "relative" , mt: 3}}>
                            <Box sx={{display : "flex" , justifyContent : "space-between" , width : "100%" , alignItems : "center" , position : "absolute"}}>
                            {Array.from({ length: 4 }).map((_, index) => (
                                <Typography>mohsen</Typography>
                            ))}
                            </Box>
                        </Box>
                    </Box>
                  </Grid>
                  <Box sx={{display : "flex" , justifyContent : "space-between" , alignItems : "center" , mt : 3 , width : "100%"}}>
                    <Typography variant='subtitle2Semibold' component="p" sx={{borderRadius : 1 , bgcolor : theme.warning.bg , px:2 , py : 1 , color : theme.warning.main}}>2 Seats Reserved</Typography>
                    <Button startIcon={<DeleteForeverIcon/>} sx={{color : theme.error.main}}><Typography variant='subtitle2Semibold' >Remove Reserved</Typography></Button>
                  </Box>
                </Grid>
              </Box>
            </Box>
            <Typography component="h2" variant="h4Bold" sx={{color : theme.gray.tone3}}>
                Trip Transferring from Your City
            </Typography>
            <Box sx={{mx:2}}>      
              <Box sx={{display : "flex" , justifyContent : "center" , mt:3 , width : "100%" }}>
                  <Tabs value={value} onChange={handleChange} aria-label="icon label tabs example" sx={{p : 0,'& .MuiTabs-flexContainer': {flexWrap: 'wrap', bgcolor : theme.primary.tint3 , borderRadius : "12px 12px 0px 0px" , borderBottom : "2px solid " , borderColor : theme.primary.main},'& .MuiTabs-indicator': {backgroundColor : "transparent"} , "& .MuiTabs-fixed" : {p:0} , width : "100%"}}>
                      <Tab sx={{flexGrow : 1 , fontSize :"23px" , '&.Mui-selected': {'& .MuiSvgIcon-root': {color : theme.white} , color : theme.white  ,bgcolor : theme.primary.main  , borderRadius : "12px 0px 0px 0px"}}} icon={<AirplanemodeActiveIcon  sx={{color : theme.black}}/>} iconPosition="start" label="Airplane" />
                      <Tab disabled={true} sx={{flexGrow : 1 , fontSize :"23px" , '&.Mui-selected': {'& .MuiSvgIcon-root': {color : theme.white} , color : theme.white  ,bgcolor : theme.primary.main  , borderRadius : "0px"}}} icon={<TrainIcon  sx={{color : theme.black}}/>} iconPosition="start" label="Train" />
                      <Tab disabled={true} sx={{flexGrow : 1 , fontSize :"23px" , '&.Mui-selected': {'& .MuiSvgIcon-root': {color : theme.white} , color : theme.white  ,bgcolor : theme.primary.main  , borderRadius : "0px"}}} icon={<SailingIcon sx={{color : theme.black}}/>} iconPosition="start" label="Ship" />
                      <Tab disabled={true} sx={{flexGrow : 1 , fontSize :"23px" , '&.Mui-selected': {'& .MuiSvgIcon-root': {color : theme.white} , color : theme.white  ,bgcolor : theme.primary.main  , borderRadius : "0px 12px 0px 0px"}}} icon={<DirectionsBusIcon sx={{color : theme.black}}/>} iconPosition="start" label="Bus" />
                  </Tabs>
              </Box>
              <CustomTabPanel value={value} index={0}>
                  <TripTransferringAirplane/>
              </CustomTabPanel>
              <CustomTabPanel value={value} index={1}>
                  {/* <SailingIcon/> */}
              </CustomTabPanel>
              <CustomTabPanel value={value} index={2}>
                  {/* <SailingIcon/> */}
              </CustomTabPanel>
              <CustomTabPanel value={value} index={3}>
                  {/* <SailingIcon/> */}
              </CustomTabPanel>
            </Box>
        </Box>
    )
}

export default Step2;
