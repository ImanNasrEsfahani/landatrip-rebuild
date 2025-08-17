import React, {useState} from "react"
import {Checkbox, FormControlLabel, FormGroup, IconButton, Typography} from "@mui/material";
import customTheme from '../../custom';
import Box from "@mui/material/Box";
import AddCircleIcon from "@mui/icons-material/AddCircle";
import RemoveCircleIcon from '@mui/icons-material/RemoveCircle';


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


export default function Step4() {
    const theme : any = customTheme.palette;
    const [countAdult, setCountAdult] = useState([
        {
            id: 0,
            title: "Service 1",
            description: "Lorem ipsum dolor sit amet consectetur. Et nisl facilisi massa enim integer et. Et at purus nunc id integer elit. Commodo tristique risus lectus proin. Faucibus sem ut proin porttitor turpis cras tempor ullamcorper tincidunt.",
            price: "12.0 $",
            value: 0,
            checked: true,
        },
        {
            id: 1,
            title: "Service 2",
            description: "Lorem ipsum dolor sit amet consectetur. Et nisl facilisi massa enim integer et. Et at purus nunc id integer elit. Commodo tristique risus lectus proin. Faucibus sem ut proin porttitor turpis cras tempor ullamcorper tincidunt.",
            price: "12.0 $",
            value: 0,
            checked: true,
        },
        {
            id: 2,
            title: "Service 3",
            description: "Lorem ipsum dolor sit amet consectetur. Et nisl facilisi massa enim integer et. Et at purus nunc id integer elit. Commodo tristique risus lectus proin. Faucibus sem ut proin porttitor turpis cras tempor ullamcorper tincidunt.",
            price: "12.0 $",
            value: 0,
            checked: true,
        }
    ]);


    // ------handleCountService-------
    const handleCountService = (id,change) => {

        let countAdultCopy = [...countAdult]
        const filteredArr = countAdult.filter((item) => {
            return item.id == id;
        });

        if (change === "increment") {
            filteredArr[0].value++;
        } else if (change === "decrement" && filteredArr[0].value > 0) {
            filteredArr[0].value--;
        }

        countAdultCopy.splice(countAdultCopy.findIndex((element) => element.id == id),1, filteredArr[0]);

        setCountAdult(countAdultCopy);

    };
    // ------end of handleCountService-------

    const handleChangeCheckbox = (e, id, index) => {
        let countAdultCopy2 = structuredClone(countAdult);
        const filteredArr2 = countAdult.filter((item, index) => {
            return item.id == id;
        });
        filteredArr2[0].checked = !filteredArr2[0].checked

        console.log(countAdultCopy2.findIndex((element) => element.id == id), "indexChange");

        countAdultCopy2.splice(countAdultCopy2.findIndex((element) => element.id == id), 1, filteredArr2[0]);

        setCountAdult(countAdultCopy2);
        console.log(countAdult, "countAdult");
    }

    return (
        <Box>
            <Box sx={{display: "flex", margin: "50px 0 20px", alignItems: "flex-end"}}>
                <Typography sx={{color : theme.gray.tone3}} component="p" variant="h4Bold">Additional Services <Typography component="span" variant="h6" sx={{fontSize: "24px",fontStyle: "normal",fontWeight: "500",lineHeight: "140%",}} color={theme.gray.tone2}>(Optional)</Typography></Typography>
                
            </Box>
            <Box>
                <FormGroup sx={{gap: 3}}>
                    {countAdult.map((item, index) => {
                        return (
                            <Box 
                                sx={{
                                    display: "flex",
                                    boxShadow: "5px 5px 40px 2px rgba(0, 0, 0, 0.10)",
                                    padding: 2,
                                    alignItems: "center",
                                    borderRadius : "12px"
                                }}
                                key={index}
                                flexWrap={{xs : "wrap" , sm : "unset"}}
                                gap={{xs:2 , sm : 10}}
                            >
                                <Box>
                                    <FormControlLabel control={<Checkbox sx={{color : theme.primary.main}} checked={item.checked} onChange={(e, index) => handleChangeCheckbox(e,item.id, index)}/>} label={<Typography sx={{fontWeight : 700, color : theme.gray.tone3}} variant="h5Bold">{item.title}</Typography>}/>
                                    <Typography sx={{mt : 2 , textAlign:"justify" , color : theme.gray.tone3}} variant="subtitle1" >
                                        {item.description}
                                    </Typography>
                                </Box>
                                <Box 
                                    sx={{
                                        display: "flex",
                                        justifyContent : "center",
                                        flexDirection: "column",
                                        alignItems: "center",
                                    }}
                                    width={{xs : "100%" , sm : "unset"}}
                                >
                                    <Typography variant="h5Bold">{item.price}</Typography>
                                    <Box sx={{
                                        display: "flex",
                                        justifyContent: "space-between",
                                        alignItems: "center",
                                        margin: "10px 0"
                                    }}>
                                        <IconButton onClick={(e) => handleCountService(item.id, "decrement")}
                                                    sx={{padding: 0, color: "black"}}>
                                            <RemoveCircleIcon sx={{color : theme.primary.main}}/>
                                        </IconButton>
                                        <Typography sx={{mx: 2}} variant="h6Semibold">{item.value}</Typography>
                                        <IconButton onClick={(e) => handleCountService(item.id, "increment")}
                                                    sx={{padding: 0, color: "black"}}>
                                            <AddCircleIcon sx={{color : theme.primary.main}} />
                                        </IconButton>
                                    </Box>
                                </Box>
                            </Box>
                        )
                    })}
                </FormGroup>
            </Box>
        </Box>
    )
}
;

