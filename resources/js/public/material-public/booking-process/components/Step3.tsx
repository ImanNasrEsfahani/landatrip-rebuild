import * as React from 'react';
import { Box, Tab, Tabs, Typography } from '@mui/material';
import customTheme from '../../custom';
import HotelIcon from '@mui/icons-material/Hotel';
import BedroomParentIcon from '@mui/icons-material/BedroomParent';
import HouseIcon from '@mui/icons-material/House';
import ApartmentIcon from '@mui/icons-material/Apartment';
import AccommodationHotel from './AccommodationHotel';
import AccommodationMotel from './AccommodationMotel';
import AccommodationEcolodge from './AccommodationEcolodge';
import AccommodationHostel from './AccommodationHostel';
import DialogBook from './DialogBook';
import { DialogProps } from '@mui/material/Dialog';



interface TabPanelProps {
    children?: React.ReactNode;
    index: number;
    value: number;
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
            <Typography component={"div"}>{children}</Typography>
          </Box>
        )}
      </div>
    );
  }


const Step3 = () =>{

  const [value, setValue] = React.useState(0);
  const [openBook, setOpenBook] = React.useState<boolean>(false);
  const [info ,setInfo] = React.useState([])
    const theme : any = customTheme.palette;

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
      setValue(newValue);
    };

    const handleClickOpenBook = (e) => {
        setInfo(e)
      setOpenBook(true);
    };

    const handleCloseBook = () => {
        setInfo([])
        setOpenBook(false);
    };

    return (
        <>
        <Typography component={"h2"} variant="h2" mt={5}>
            Accommodation
        </Typography>
        <Box mt={3} mx={2}>
            <Box sx={{display : "flex" , justifyContent : "center" , mt:3 ,}}>
                <Tabs value={value} onChange={handleChange} aria-label="icon label tabs example"
                sx={{'& .MuiTabs-flexContainer': {flexWrap: 'wrap', flexGrow : 1},'& .MuiTabs-indicator': {backgroundColor : "transparent"} , "& .MuiTabs-fixed" : {p:1}}}
            >
                    <Tab sx={{flexGrow : 1 , '&.Mui-selected': { boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)", color: 'black', borderRadius : "12px"}}} icon={<HotelIcon fontSize="large" sx={{color : theme.sidebarTitle}}/>} iconPosition="start" label="Hotel" />
                    <Tab sx={{flexGrow : 1 , '&.Mui-selected': { boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)", color: 'black', borderRadius : "12px"}}} icon={<BedroomParentIcon fontSize="large" sx={{color : theme.sidebarTitle}}/>} iconPosition="start" label="Motel" />
                    <Tab sx={{flexGrow : 1 , '&.Mui-selected': { boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)", color: 'black', borderRadius : "12px"}}} icon={<ApartmentIcon fontSize="large" sx={{color : theme.sidebarTitle}}/>} iconPosition="start" label="Ecolodge" />
                    <Tab sx={{flexGrow : 1 , '&.Mui-selected': { boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)", color: 'black', borderRadius : "12px"}}} icon={<HouseIcon fontSize="large" sx={{color : theme.sidebarTitle}}/>} iconPosition="start" label="Hostel" />
                </Tabs>
            </Box>
            <CustomTabPanel value={value} index={0}>
                <AccommodationHotel handleClickOpenBook={handleClickOpenBook}  />
            </CustomTabPanel>
            <CustomTabPanel value={value} index={1}>
                <AccommodationMotel handleClickOpenBook={handleClickOpenBook}  />
            </CustomTabPanel>
            <CustomTabPanel value={value} index={2}>
                <AccommodationEcolodge handleClickOpenBook={handleClickOpenBook}  />
            </CustomTabPanel>
            <CustomTabPanel value={value} index={3}>
                <AccommodationHostel handleClickOpenBook={handleClickOpenBook}  />
            </CustomTabPanel>
        </Box>
        <DialogBook  handleCloseBook={handleCloseBook} openBook={openBook} info={info}/>
        </>
    )
}

export default Step3;
