import {Box, Dialog, DialogContent, Grid, IconButton, Typography } from '@mui/material';
import * as React from 'react';
import AddCircleIcon from '@mui/icons-material/AddCircle';
import { useState , useEffect } from 'react';
import ClearIcon from '@mui/icons-material/Clear';
import RemoveCircleIcon from '@mui/icons-material/RemoveCircle';
import {useMutation} from "react-query";
import axios from "axios";
import AsyncSelect from 'react-select/async';
import customTheme from '../../custom';


type UserState = {
    fname: string;
    lname: string;
    slug: string;
    picture: string;
}[];

const theme : any = customTheme.palette;


const DialogSearchUser = (props : any) =>{
    const [searchResults, setSearchResults] = useState<UserState>([]);
    const [addUserState , setAddUserState] = useState<UserState>([])
    const [inputValues , setInputValues] = useState<string>()
    const [timer, setTimer] = useState<any>(null);


    const bookingSearch = useMutation('bookingSearch', async (keyWord) => {
        // @ts-ignore
        const { data } = await axios.get(import.meta.env.VITE_APP_URL + `/api/booking/search?search=${keyWord}`);
        return data.data;
    }, {
        onSuccess: (data) => {
        const storedResultsJSON = window.localStorage.getItem("finalResults");
        const storedResults = storedResultsJSON ? JSON.parse(storedResultsJSON) : [];

        if (props.tempAddUserState?.length > 0) {
            const tempUserSlugs = props.tempAddUserState.map(user => user.slug);

            // Filter out results that have the same slug as tempAddUserState
            const filteredData = data.filter(item => !tempUserSlugs.includes(item.slug));

            // Filter out results that have the same slug as storedResults
            const finalFilteredData = filteredData.filter(item => !storedResults?.some(user => user.slug === item.slug));

            setSearchResults(finalFilteredData);
        } else {
            // Filter out results that have the same slug as storedResults
            const finalFilteredData = data.filter(item => !storedResults?.some(user => user.slug === item.slug));

            setSearchResults(finalFilteredData);
        }
    }
});


    const addUser = (fname:string , lname:string , slug:string , picture:string) =>{
       
        const user : {fname:string , lname:string , slug:string , picture:string} = {
            fname : fname,
            lname : lname,
            slug : slug,
            picture : picture
        }
      
        const newResults = searchResults.filter(item => item.slug !== slug);
        setSearchResults(newResults);
        setAddUserState(prev => [...prev , user])
        console.log(JSON.stringify(user))
        window.localStorage.setItem("finalResults", JSON.stringify(user));
        props.setTempAddUserState(prev => [...prev , user])
    }

    const removeUser = (fname:string , lname:string , slug:string , picture:string) =>{
        const newResults =  addUserState.filter(item => item.slug !== slug)
        setAddUserState(newResults)
        props.setTempAddUserState(newResults)
        const user : {fname:string , lname:string , slug:string , picture:string} = {
            fname : fname,
            lname : lname,
            slug : slug,
            picture : picture
        }
        setSearchResults(prev => [...prev , user])
    }

    const closeDialog = () => {
        props.setOpenDialog(false)
        setAddUserState([])
        setSearchResults([])
        setInputValues("")
        props.setFinalResults(prev => prev?.concat(addUserState))
    }

    const debounceSearch = (inputValue: string) => {
        clearTimeout(timer); 
        setTimer(
            setTimeout(() => {
                // @ts-ignore
                bookingSearch.mutate(inputValue);
            }, 1000) 
        );
    };


    const promiseOptions = (inputValue: string)  => {
        setInputValues(inputValue);
        if(inputValue.trim() !== '') { 
            debounceSearch(inputValue); 
        }
    };


    const closeDialogBlur = () => {
        props.setOpenDialog(false)
        setAddUserState([])
        setSearchResults([])
        setInputValues("")
        props.setFinalResults(prev => prev?.concat(addUserState))
    }



    return (
        <>
            <Dialog
                open={props.openDialog}
                onClose={closeDialogBlur}
                sx={{p : 1}}
                fullWidth
                maxWidth="lg"
            >
                <DialogContent sx={{height : "90vh"}} >
                    <Box sx={{display : "flex", justifyContent : "space-between" , alignItems : "center" , mb:3 }}>
                        <Typography variant="h6Semibold" component="p" sx={{color : theme.gray.tone3}} >Add Tour Participants</Typography>
                        <IconButton onClick={closeDialog}>
                            <ClearIcon sx={{color : theme.error.main}}/>
                        </IconButton>
                    </Box>
                    <Box>
                        <AsyncSelect styles={{control : (baseStyles, state) => ({...baseStyles,borderRadius : "32px" , padding : "10px 15px" })}} isLoading={bookingSearch?.isLoading} inputValue={inputValues} menuIsOpen={false}  onInputChange={promiseOptions} components={{ DropdownIndicator:() => null, IndicatorSeparator:() => null }}/>
                        <Box className = "scrollbarInputs" sx={{mt:3 , pr:1 , width:"100%" , overflow : "auto" , height : "64vh"}}>
                                <Grid container spacing={2}>
                                    {addUserState.map(item => (
                                        <Grid xs={12} sm={4} item key={item.slug}>
                                            <Box sx={{display : "flex" , justifyContent:"space-between" , alignItems:"center" , border : "2px solid" , borderColor : theme.primary.main , backgroundColor : theme.primary.tint3 , borderRadius: "32px" , pr:2}}>
                                                <img src={item.picture} alt="image" style={{height:"60px" , width:"60px" , borderRadius : "50%"}} />
                                                <Box sx={{ml:1 , overflow:"hidden" ,textWrap: "nowrap"}}>
                                                    <Typography variant="subtitle1" component="p">{item.fname} {item.lname}</Typography>
                                                </Box>
                                                <IconButton onClick={()=>removeUser(item.fname,item.lname,item.slug,item.picture)}>
                                                    <RemoveCircleIcon  sx={{color : theme.error.main}}/>
                                                </IconButton>
                                            </Box>
                                    </Grid>
                                    ))}
                                    {bookingSearch.isSuccess && searchResults.map ((result) => (
                                        <Grid  xs={12} sm={4} item key={result.slug}>
                                            <Box sx={{display : "flex" , justifyContent:"space-between" , alignItems:"center" , border : "2px solid " , borderColor : theme.gray.tone1 , borderRadius: "32px" , pr:2}} >
                                                <img src={result.picture} alt="image" style={{height:"60px" , width:"60px" , borderRadius : "50%"}} />
                                                <Box sx={{ml:1 , overflow:"hidden" ,textWrap: "nowrap"}}>
                                                    <Typography variant="subtitle1" component="p" >{result.fname} {result.lname}</Typography>
                                                </Box>
                                                <IconButton onClick={()=>addUser(result.fname,result.lname,result.slug,result.picture)}>
                                                    <AddCircleIcon sx={{color : theme.primary.main}}/>
                                                </IconButton>
                                            </Box>
                                        </Grid>
                                    ))}
                                </Grid>
                        </Box>
                    </Box>
                </DialogContent>
            </Dialog>
        </>

    )
}

export default DialogSearchUser;