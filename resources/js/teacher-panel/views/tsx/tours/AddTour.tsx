import {
    Accordion,
    AccordionDetails,
    AccordionSummary,
    Autocomplete,
    Box,
    Button,
    Chip,
    Container,
    Dialog,
    DialogActions,
    DialogContent,
    DialogContentText,
    DialogTitle,
    Divider,
    FormControl,
    FormControlLabel,
    FormLabel,
    Grid,
    IconButton,
    ImageList,
    ImageListItem,
    InputLabel,
    List,
    ListItem,
    MenuItem,
    Radio,
    Slider,
    RadioGroup,
    Select,
    SelectChangeEvent,
    Slide,
    TextField,
    Typography,
    colors,
    FormGroup,
    Checkbox,
    ToggleButton,
    ToggleButtonGroup,
} from "@mui/material";
import React, { useState, useRef } from "react";
import AccountCircleIcon from "@mui/icons-material/AccountCircle";
import RoomIcon from "@mui/icons-material/Room";
import customTheme from "./../../../custom.js";
import CloseIcon from "@mui/icons-material/Close";
import AddCircleIcon from "@mui/icons-material/AddCircle";
import RemoveCircleIcon from "@mui/icons-material/RemoveCircle";
import AddBoxOutlinedIcon from "@mui/icons-material/AddBoxOutlined";
import KeyboardArrowDownIcon from "@mui/icons-material/KeyboardArrowDown";
import EventNoteIcon from "@mui/icons-material/EventNote";
import AddIcon from "@mui/icons-material/Add";
import RemoveIcon from "@mui/icons-material/Remove";
import { SubmitHandler, useForm, useFieldArray } from "react-hook-form";
import { useMutation, useQuery } from "react-query";
import axios from "./../../../../axiosConfig";
import { route } from "../../../helpers";
import { CheckBox, Label } from "@mui/icons-material";
import "react-dropzone-uploader/dist/styles.css";
import Dropzone from "react-dropzone-uploader";
// import "../../../App.css"
import DeleteForeverOutlinedIcon from "@mui/icons-material/DeleteForeverOutlined";


type tourItem = {
    title: string;
    subtitle: string;
    short_summary: string;
    tour_overview: string;
    skills: object;
    city: string;
    age: [];
    location_id: string;
    transport: string;
    highlights: { item: string }[];
    includes: { item: string }[];
    excludes: { item: string }[];
    itineraries: {
        id: number;
        title: string;
        description: string;
        start: number;
        end: number;
    }[];
    evaluation_type:
        | "noEvaluation"
        | "finalInterview"
        | "project"
        | "paperBased";
    min_score: string;
};
const AddTour = () => {
    const { register, control, handleSubmit, setValue } = useForm<tourItem>();

    const onSubmit: SubmitHandler<tourItem> = (data: object) => {
        postTour.mutate(data);
    };
    const postTour = useMutation(async (data: object) => {
        const response = await axios.post(
            route("api.web.v1.teacher-panel.tours.store"),
            data
        );
        return response.data;
    });

    const countryRecords = useQuery("countryRecords", async () => {
        const { data } = await axios.get(
            route("api.web.v1.teacher-panel.country.index")
        );
        countryRecords.data = data.data;
        return countryRecords;
    });

    const citiesRecords = useMutation("citiesRecords", async (slug: string) => {
        const { data } = await axios.get(
            route("api.web.v1.teacher-panel.find.cities", { country: slug })
        );
        citiesRecords.data = data.data;
        return citiesRecords;
    });
    const handleCountry = (e, values) => {
        citiesRecords.mutate(values.slug);
    };

    const [valueRange, setValueRange] = React.useState<number[]>([20, 37]);
    const handleChangeRange = (event: Event, newValue: number | number[]) => {
        setValueRange(newValue as number[]);
        setValue("age", valueRange);
    };
    function valuetextRange(value: number) {
        return `${value}`;
    }

    //Start Highlights Function
    const [highlights, setHighlights] = useState("");
    const [highlightsList, setHighlightsList] = useState([]);
    const handleHighlights = (id) => {
        let highlightDataList = highlightsList;
        if (highlights.trim() !== "") {
            const updatedHighlights = [
                ...highlightDataList,
                {
                    title: highlights,
                },
            ];
            highlightDataList = updatedHighlights;
            setHighlightsList(highlightDataList);
            setHighlights("");
        }
        setValue("highlights", highlightDataList);
    };
    const handleCloseHighlightsList = (value) => {
        const updatedHighlightsList = highlightsList.filter(
            (item) => item.title !== value
        );

        setHighlightsList(updatedHighlightsList);
        setValue("highlights", updatedHighlightsList);
    };
    //End Highlights Function

    //Start Includes Function
    const [includes, setIncludes] = useState("");
    const [includesList, setIncludesList] = useState([]);
    const handleIncludes = (id) => {
        let includesDataList = includesList;
        if (includes.trim() !== "") {
            const updatedIncludes = [
                ...includesDataList,
                {
                    title: includes,
                },
            ];
            includesDataList = updatedIncludes;
            setIncludesList(includesDataList);
            setIncludes("");
        }
        setValue("includes", includesDataList);
    };
    const handleCloseIncludesList = (value) => {
        const updatedIncludesList = includesList.filter(
            (item) => item.title !== value
        );

        setIncludesList(updatedIncludesList);
        setValue("includes", updatedIncludesList);
    };
    //End Includes Function

    //Start Excludes Function
    const [excludes, setExcludes] = useState("");
    const [excludesList, setExcludesList] = useState([]);
    const handleExcludes = (id) => {
        let excludeDataList = excludesList;
        if (excludes.trim() !== "") {
            const updatedExcludes = [
                ...excludeDataList,
                {
                    title: excludes,
                },
            ];
            excludeDataList = updatedExcludes;
            setExcludesList(excludeDataList);
            setExcludes("");
        }
        setValue("excludes", excludeDataList);
    };
    const handleCloseExcludesList = (value) => {
        const updatedExcludesList = excludesList.filter(
            (item) => item.title !== value
        );

        setExcludesList(updatedExcludesList);
        setValue("excludes", updatedExcludesList);
    };
    //End Excludes Function

    //Start Itineraries Function
    const [itIneraries, setItIneraries] = useState([
        {
            id: 1,
            start: 1,
            end: 1,
            title_day: "Day 1",
            title: "",
            description: "",
            unicId: "single",
        },
    ]);
    const [counter, setCounter] = useState(1);
    const [counterId, setCounterId] = useState(1);

    const handleAddItIneraries = () => {
        let counterLocal = counter;
        if (counterLocal <= 50) {
            if (numberPopUp === 1) {
                const newItIneraries = {
                    id: counterId + 1,
                    title_day: `Day ${counterLocal + 1}`,
                    title: "",
                    description: "",
                    start: counterLocal + 1,
                    end: counterLocal + 1,
                    unicId: "single",
                };
                counterLocal += 1;
                if (counterLocal <= 50) {
                    setCounter(counterLocal);
                }
                setCounterId(counterId + 1);

                const newInputValues = {
                    id: counterId + 1,
                    title: "",
                    description: "",
                };

                if (counterLocal <= 50) {
                    setItIneraries([...itIneraries, newItIneraries]);
                    setInputValuesArray([...inputValuesArray, newInputValues]);
                }
            } else {
                const newItIneraries = {
                    id: counterId + 1,
                    title_day: `Day ${counterLocal + 1}th To Day ${
                        counterLocal + numberPopUp
                    }th`,
                    title: "",
                    description: "",
                    start: counterLocal + 1,
                    end: counterLocal + numberPopUp,
                    numberPopUp: numberPopUp,
                };

                const newInputValues = {
                    id: counterId + 1,
                    title: "",
                    description: "",
                };

                counterLocal += numberPopUp;
                if (counterLocal <= 50) {
                    setCounter(counterLocal);
                }
                setCounterId(counterId + 1);

                if (counterLocal <= 50) {
                    setItIneraries([...itIneraries, newItIneraries]);
                    setInputValuesArray([...inputValuesArray, newInputValues]);
                }
            }
        }
        handleClose();
    };

    const [counterRemoveItIneraries, setCounterRemoveItIneraries] = useState(0);

    const handleRemoveItIneraries = (id) => {
        const updatedItIneraries = itIneraries.filter((item) => item.id !== id);
        const updatedinputValuesArray = inputValuesArray.filter(
            (item) => item.id !== id
        );
        setInputValuesArray(updatedinputValuesArray);

        let counterLocal = counterRemoveItIneraries;
        const newItIneraries = updatedItIneraries.map((item: any) => {
            if (item.unicId === "single") {
                const newTitle1 = `Day ${counterLocal + 1}`;
                counterLocal += 1;
                return {
                    ...item,
                    title: newTitle1,
                };
            } else {
                const newTitle = `Day ${counterLocal + 1}th To Day ${
                    counterLocal + item.numberPopUp
                }th`;
                counterLocal += item.numberPopUp;
                return {
                    ...item,
                    title: newTitle,
                };
            }
        });

        setCounterRemoveItIneraries(0);
        setCounter(counterLocal);
        setItIneraries(newItIneraries);
    };

    const [inputValuesArray, setInputValuesArray] = useState([
        {
            id: 1,
            title: "",
            description: "",
        },
    ]);

    const handleInputChange = (e, id) => {
        const { name, value } = e.target;
        const updatedInputValuesArray = inputValuesArray.map((inputValues) => {
            if (inputValues.id === id) {
                return {
                    ...inputValues,
                    [name]: value,
                };
            }
            return inputValues;
        });

        setInputValuesArray(updatedInputValuesArray);
        const updatedPhases = itIneraries.map((item) => {
            if (item.id === id) {
                return {
                    ...item,
                    [name]: value,
                };
            }
            return item;
        });

        setItIneraries(updatedPhases);
        setValue("itineraries", itIneraries);
    };
    //End Itineraries Function

  

    const [isTextFieldDisabled, setIsTextFieldDisabled] = useState(true);
    const [isTextFieldDisabled1, setIsTextFieldDisabled1] = useState(true);
    const [backgroundColorButton, setbackgroundColorButton] = useState("noEvaluation");

    const handleRadioChange = (event) => {
        const value = event.target.value;
        if (value === "finalInterview") {
            setIsTextFieldDisabled(false);
        } else {
            setIsTextFieldDisabled(true);
        }
        if (value === "paperBased") {
            setIsTextFieldDisabled1(false);
        } else {
            setIsTextFieldDisabled1(true);
        }
        setValue("evaluation_type", value);

        switch (value) {
            case "noEvaluation":
                setbackgroundColorButton("noEvaluation");
                setValue("min_score", null);
                break;
            case "finalInterview":
                setbackgroundColorButton("finalInterview");
                break;
            case "paperBased":
                setbackgroundColorButton("paperBased");
                break;
            case "project":
                setbackgroundColorButton("project");
                setValue("min_score", null);
                break;
        }

        // if (value === 'noEvaluation'){
        //     setbackgroundColorButton(true);
        // }
        // else if (value === 'finalInterview') {
        //     setbackgroundColorButton(true);
        // }
        // else if (value === 'paperBased') {
        //     setbackgroundColorButton(true);
        // }
        // else if (value === 'paperBased') {
        //     setbackgroundColorButton(true);
        // }
        // else {
        //     setbackgroundColorButton(true);
        // }
    };

    // Tour lable
    const [selected, setSelected] = useState({
        programming: false,
        language: false,
        sport: false,
        nature: false,
        historical: false,
        label1: false,
        label2: false,
        label3: false,
        label4: false,
        label5: false,
        label6: false,
        label7: false,
    });

    const handleSelected = (e) => {
        switch (e.target.value) {
            case "programming":
                setSelected({
                    ...selected,
                    programming: !selected.programming,
                });
                break;
            case "language":
                setSelected({ ...selected, language: !selected.language });
                break;
            case "sport":
                setSelected({ ...selected, sport: !selected.sport });
                break;
            case "nature":
                setSelected({ ...selected, nature: !selected.nature });
                break;
            case "historical":
                setSelected({ ...selected, historical: !selected.historical });
                break;
            case "label1":
                setSelected({ ...selected, label1: !selected.label1 });
                break;
            case "label2":
                setSelected({ ...selected, label2: !selected.label2 });
                break;
            case "label3":
                setSelected({ ...selected, label3: !selected.label3 });
                break;
            case "label4":
                setSelected({ ...selected, label4: !selected.label4 });
                break;
            case "label5":
                setSelected({ ...selected, label5: !selected.label5 });
                break;
            case "label6":
                setSelected({ ...selected, label6: !selected.label6 });
                break;
            case "label7":
                setSelected({ ...selected, label7: !selected.label7 });
                break;
        }
    };

    // upload image

    const [dropzoneKey, setDropzoneKey] = React.useState(Date.now());
    const [uploadImage, setUploadImage] = React.useState([]);

    const Preview = ({ meta }) => {
        const { name, percent, status } = meta;
        return (
            <AddIcon
                sx={{
                    width: "50px",
                    height: "50px",
                    color: "#5B5B5B",
                }}
            />
        );
    };

    const handleChangeStatus = ({ xhr }, status, files) => {
        if (status === "done") {
            setUploadImage([...uploadImage, files[0]]);
            setDropzoneKey(Date.now());
        }
    };

    const handleDeleteImageGallery = (id) =>{
        const update = uploadImage.filter(item => item.meta.id !== id)
        setUploadImage(update)
    }

    

    // End of upload image

    // upload image

    const [dropzoneKeyCertifications, setDropzoneKeyCertifications] =
        React.useState(Date.now());
    const [uploadImageCertifications, setUploadImageCertifications] =
        React.useState([]);

    const PreviewCertifications = ({ meta }) => {
        const { name, percent, status } = meta;
        return (
            <AddIcon
                sx={{
                    width: "50px",
                    height: "50px",
                    color: "#5B5B5B",
                }}
            />
        );
    };

    const handleChangeStatusCertifications = ({ xhr }, status, files) => {
        if (status === "done") {
            console.log("2", files);
            setUploadImageCertifications([
                ...uploadImageCertifications,
                files[0],
            ]);
            setDropzoneKeyCertifications(Date.now());
        }
    };

    const handleDeleteImageCertifications = (id) =>{
        const update = uploadImageCertifications.filter(item => item.meta.id !== id)
        setUploadImageCertifications(update)
    }

    // End of upload image


               // upload image background

               const [dropzoneKeyBackground, setDropzoneKeyBackground] = React.useState(Date.now());
               const [uploadImageBackground, setUploadImageBackground] = React.useState(null);
               const [uploadImageBackgroundError, setUploadImageBackgroundError] = React.useState("");
       
           
               const PreviewBackground = ({ meta }) => {
                   const { name, percent, status } = meta;
                   return (
                       <Button variant="contained"  sx={{textWrap : "nowrap"}}>
                           Upload Image
                       </Button>
                   );
               };
           
               const handleChangeStatusBackground = ({ xhr }, status, file) => {
                   
                   if (status === "done" && file[0].meta.width > 920 && file[0].meta.height < 400) {
                       
                       setUploadImageBackground(file);
                   }
                   setDropzoneKeyBackground(Date.now());
               };
           
               const handleDeleteUploadBackground = () => {
                   setUploadImageBackground(null);
                   setDropzoneKeyBackground(Date.now());
               };
           
               // End of upload image background

    const [open, setOpen] = React.useState(false);

    const handleClickOpen = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    const [numberPopUp, setNumberPopUp] = useState(1);

    const addDay = (e) => {
        e.preventDefault();
        setNumberPopUp(numberPopUp + 1);
    };
    const removeDay = (e) => {
        e.preventDefault();
        if (numberPopUp !== 1) {
            setNumberPopUp(numberPopUp - 1);
        }
    };
    if (countryRecords.isError) {
        return <p>Error Dari</p>;
    }

    if (countryRecords.isLoading) {
        return <p>Loading Dari</p>;
    }

    // const handleDevices = (
    //     event: React.MouseEvent<HTMLElement>,
    //     newDevices: string[],
    //   ) => {
    //     if (newDevices.length) {
    //       setDevices(newDevices);
    //     }
    //   };

    // end of Tour lable

    return (
        <Container>
            {/* ----------------------------------------------------dialog---------------------------------------------------------- */}

            <Box>
                <Dialog
                    open={open}
                    keepMounted
                    onClose={handleClose}
                    aria-describedby="alert-dialog-slide-description"
                >
                    <DialogTitle>
                        {
                            <Typography
                                color={customTheme.palette.primary.main}
                            >
                                Add Day/s
                            </Typography>
                        }
                    </DialogTitle>
                    <DialogContent sx={{ pb: 0 }}>
                        <DialogContentText id="alert-dialog-slide-description">
                            <Box
                                display="flex"
                                justifyContent="center"
                                alignItems="center"
                                mx="50px"
                            >
                                <Button
                                    disabled={numberPopUp === 1 ? true : false}
                                    onClick={removeDay}
                                    sx={{
                                        width: "50px",
                                        height: "46px",
                                        p: "10px",
                                        bgcolor: customTheme.palette.inputs,
                                        borderRadius: "5px 0px 0px 5px",
                                        minWidth: 0,
                                    }}
                                >
                                    <RemoveIcon sx={{ fontSize: "19px" }} />
                                </Button>
                                <Typography
                                    sx={{
                                        width: "50px",
                                        height: "46px",
                                        p: "10px",
                                        color: "black",
                                        textAlign: "center",
                                    }}
                                >
                                    {numberPopUp}
                                </Typography>
                                <Button
                                    onClick={addDay}
                                    sx={{
                                        width: "50px",
                                        height: "46px",
                                        p: "10px",
                                        bgcolor: customTheme.palette.inputs,
                                        borderRadius: "0px 5px 5px 0px",
                                        minWidth: 0,
                                    }}
                                >
                                    <AddIcon />
                                </Button>
                            </Box>
                        </DialogContentText>
                    </DialogContent>
                    <DialogActions sx={{ mx: "19px", my: "19px" }}>
                        <Button
                            sx={{
                                p: "14px 67px",
                                width: "117px",
                                height: "26px",
                                borderRadius: "25px",
                                color: customTheme.palette.grey[40],
                                borderColor: customTheme.palette.grey[40],
                            }}
                            variant="outlined"
                            onClick={handleClose}
                        >
                            <Typography>Cancel</Typography>
                        </Button>
                        <Button
                            variant="contained"
                            sx={{
                                ml: "16px",
                                p: "14px 67px",
                                width: "117px",
                                height: "26px",
                                borderRadius: "25px",
                                color: customTheme.palette.white,
                                borderColor: customTheme.palette.primary.main,
                            }}
                            onClick={handleAddItIneraries}
                        >
                            <Typography>Add</Typography>
                        </Button>
                    </DialogActions>
                </Dialog>
            </Box>

            {/* ----------------------------------------------------end dialog------------------------------------------------------- */}
            <form onSubmit={handleSubmit(onSubmit)}>
                <Box>
                    <Typography
                        sx={{
                            borderLeft: "3px solid black",
                            pl: "12px",
                            my: "24px",
                            color: customTheme.palette.primary.main,
                            borderColor: customTheme.palette.primary.main,
                        }}
                    >
                        Insert New Tour
                    </Typography>
                    <Box pl="10px">
                    <Box
                borderRadius="12px"
                bgcolor={customTheme.palette.inputs}
                textAlign="center"
                width="100%"       
                mb="34px"
                pt="85px"
                pb="20px"
                sx={{
                    backgroundImage: uploadImageBackground ? `url(${uploadImageBackground[0].meta.previewUrl})` : "none",
                    backgroundSize: "cover",
                    bgcolor : uploadImageBackground ? "none" | ""  : customTheme.palette.inputs
                }}
                
                
            >
               
                <Typography sx={{ color: customTheme.palette.gray.main }}>
                    Image Must Be 256*256px-Max2MB
                </Typography>
                
                <Box
                            display="flex"
                            justifyContent="center"
                            alignItems="center"
                            
                            
                        >
                            <Button variant="contained"  sx={{textWrap : "nowrap"}}>
                                Upload Image
                                <Dropzone
                                    key={dropzoneKeyBackground}
                                    /// getUploadParams={
                                    //     getUploadParams
                                    // }
                                    styles={{ dropzone: { overflow : "hidden" , border : "none" , position : "absolute", width : "140px" , height : "38px" , minHeight : 0 } }}
                                    onChangeStatus={handleChangeStatusBackground}
                                    // PreviewComponent={PreviewBackground}
                                    canRemove={false}
                                    inputContent={
                                        <>
                                        
                                        </>
                                    }
                                    multiple={false}
                                    maxFiles={1}
                                    accept="image/*,audio/*,video/*"
                                    
                                />
                                
                            </Button>
                            {/* <Button
                                variant="contained"
                                sx={{ borderRadius: 10 }}
                            >
                                Upload Image
                            </Button> */}
                            
                                <Button
                                    sx={{
                                        borderColor: "orange.main",
                                        color: "orange.main",
                                        
                                    }}
                                    onClick={handleDeleteUploadBackground}
                                    variant="outlined"
                                >
                                    Delete Image
                                </Button>
                            
                        </Box>
            </Box>
                    </Box>
                    <Box pl="10px">
                    <Grid container mt="40px" spacing="20px">
                        <Grid item xs={12}>
                            <TextField
                                label="Tour Name"
                                variant="outlined"
                                sx={{ width: "85%" }}
                                {...register("title")}
                            />
                        </Grid>
                        <Grid item xs={12}>
                            <TextField
                                label="Subtitle"
                                variant="outlined"
                                sx={{ width: "100%" }}
                                {...register("subtitle")}
                            />
                        </Grid>
                        <Grid item xs={12}>
                            <TextField
                                multiline
                                rows={3}
                                label="Tour Overview"
                                variant="outlined"
                                sx={{ width: "100%" }}
                                {...register("tour_overview")}
                            />
                        </Grid>
                        
                    </Grid>
                    </Box>
                    <Typography
                        sx={{
                            borderLeft: "3px solid black",
                            pl: "12px",
                            mt: "40px",
                            color: customTheme.palette.primary.main,
                            borderColor:
                                customTheme.palette.primary.main,
                        }}
                    >
                        Tour Details
                    </Typography>
                    <Box pl="10px">
                    <Grid container spacing="20px">
                        <Grid item mt="24px" xs={12} sm={6}>
                            <FormControl fullWidth>
                                <Autocomplete
                                    size="small"
                                    id="country"
                                    fullWidth
                                    onChange={(event, values) =>
                                        handleCountry(event, values)
                                    }
                                    options={countryRecords.data.data}
                                    getOptionLabel={(option: any) =>
                                        option.name
                                    }
                                    renderOption={(props, option) => (
                                        <Box
                                            component="li"
                                            sx={{
                                                "& > img": {
                                                    mr: 2,
                                                    flexShrink: 0,
                                                },
                                            }}
                                            {...props}
                                        >
                                            <img
                                                loading="lazy"
                                                width="20"
                                                src={`https://flagcdn.com/w20/${option.code.toLowerCase()}.png`}
                                                srcSet={`https://flagcdn.com/w40/${option.code.toLowerCase()}.png 2x`}
                                                alt=""
                                            />
                                            {option.name} ({option.code})
                                        </Box>
                                    )}
                                    renderInput={(params) => (
                                        <TextField
                                            {...params}
                                            label="Country"
                                            inputProps={{
                                                ...params.inputProps,
                                                autoComplete: "new-password",
                                            }}
                                        />
                                    )}
                                />
                            </FormControl>
                        </Grid>
                        <Grid item mt="24px" xs={12} sm={6}>
                            <FormControl fullWidth>
                                {citiesRecords.data ? (
                                    <Autocomplete
                                        disablePortal
                                        id="location_id"
                                        options={citiesRecords.data.data}
                                        size="small"
                                        fullWidth
                                        getOptionLabel={(option: any) =>
                                            option.name
                                        }
                                        onChange={(event, values) =>
                                            setValue("location_id", values.id)
                                        }
                                        renderInput={(params) => (
                                            <TextField
                                                {...params}
                                                label="City"
                                            />
                                        )}
                                    />
                                ) : (
                                    <Autocomplete
                                        disabled={true}
                                        disablePortal
                                        id="city"
                                        options={[]}
                                        size="small"
                                        fullWidth
                                        renderInput={(params) => (
                                            <TextField
                                                {...params}
                                                label="City"
                                                {...register("city")}
                                            />
                                        )}
                                    />
                                )}
                            </FormControl>
                        </Grid>
                        {/* <Grid item xs={12} sm={6}>
                    <FormControl fullWidth>
                        <InputLabel
                            sx={{
                                display: "flex",
                                alignItems: "center",
                                mr: "10px",
                            }}
                            id="transportationLabel"
                        >
                            <RoomIcon />
                            Transportation *
                        </InputLabel>
                        <Select
                            onChange={(event)=> setValue("transport", event.target.value)}
                            defaultValue={""}
                            labelId="transportationLabel"
                            id="transport"
                            label="Transportation"
                        >
                            <MenuItem value={"bus"}>By Bus</MenuItem>
                            <MenuItem value={"train"}>By Train</MenuItem>
                            <MenuItem value={"plane"}>By Plane</MenuItem>
                            <MenuItem value={"car"}>By Car</MenuItem>
                            <MenuItem value={"ship"}>By Ship</MenuItem>
                        </Select>
                    </FormControl>
                </Grid> */}
                        <Grid item xs={12}>
                            <Typography
                                sx={{
                                    color: customTheme.palette.gray.main,
                                }}
                            >
                                Age limit
                            </Typography>
                        </Grid>
                        <Grid item xs={12}>
                            <Slider
                                sx={{
                                    "& .MuiSlider-thumb": {
                                        color: customTheme.palette.orange[60],
                                    },
                                    "& .MuiSlider-track": {
                                        color: customTheme.palette.orange.main,
                                    },
                                    "& .MuiSlider-rail": {
                                        color: "#acc4e4",
                                    },
                                    "& .MuiSlider-active": {
                                        color: "green",
                                    },
                                }}
                                getAriaLabel={() => "Age range"}
                                value={valueRange}
                                onChange={handleChangeRange}
                                valueLabelDisplay="auto"
                                getAriaValueText={valuetextRange}
                                max={99}
                                min={1}
                            />
                        </Grid>
                        <Grid item xs={12}>
                            <TextField
                                multiline
                                rows={3}
                                label="Describe Your Tour"
                                variant="outlined"
                                sx={{ width: "100%" }}
                                {...register("short_summary")}
                            />
                        </Grid>
                        <Grid item xs={12}>
                            <Autocomplete
                                sx={{
                                    "& .MuiInputLabel-asterisk": {
                                        display: "none",
                                    },
                                    "& .MuiTextField-root": {
                                        borderRadius: "5px",
                                    },
                                }}
                                freeSolo
                                multiple
                                id="skills"
                                options={[]}
                                onChange={(event, value) =>
                                    setValue("skills", value)
                                }
                                renderTags={(value, getTagProps) =>
                                    value.map(
                                        (option: string, index: number) => (
                                            <Chip
                                                deleteIcon={<CloseIcon />}
                                                sx={{
                                                    "& .MuiChip-deleteIcon": {
                                                        color: "#292D32",
                                                        mr: 0,
                                                        ml: "3px",
                                                    },
                                                    "&:hover .MuiChip-deleteIcon":
                                                        {
                                                            color: "#292D32",
                                                        },
                                                }}
                                                variant="outlined"
                                                label={`# ${option}`}
                                                {...getTagProps({ index })}
                                            />
                                        )
                                    )
                                }
                                renderInput={(params) => (
                                    <TextField
                                        {...params}
                                        sx={{
                                            "& .MuiAutocomplete-tag": {
                                                borderRadius: "16px",

                                                marginLeft: "10px",
                                                borderStyle: "none",
                                                padding: "10px",
                                                fontSize: "14px",
                                                border: "1px solid #545B62",
                                            },
                                        }}
                                        label="Skills"
                                    />
                                )}
                            />
                            {/* <Autocomplete
                    sx={{
                        "& .MuiInputLabel-asterisk": {
                            display: "none",
                        },
                        "& .MuiTextField-root": {
                            borderRadius: "5px",
                        },
                    }}
                        freeSolo
                        multiple
                        id="skills"
                        options={[]}
                        value={tags}
                        onChange={(event, newValue) => {
                            setTags(newValue);
                        }}
                        renderTags={(value, getTagProps) =>
                            value.map((option, index) => (

                                <Chip
                                    deleteIcon={<CloseIcon />}
                                    key={index}
                                    label={`# ${option}`}
                                    sx={{
                                        "& .MuiChip-deleteIcon": {
                                            color: "#292D32",

                                            mx: "5px",
                                        },
                                        "&:hover .MuiChip-deleteIcon": {
                                            color: "#292D32",
                                        },
                                        mr : 1
                                    }}
                                    onDelete={() => {
                                        const updatedTags = tags.filter(
                                            (_, i) => i !== index
                                        );
                                        setTags(updatedTags);
                                    }}
                                />
                            ))
                        }
                        renderInput={(params) => (
                            <TextField
                                {...params}
                                label="Skills"
                                required
                                value={inputValue}
                                onBlur={handleAddTag}
                                onChange={(event) =>
                                    setInputValue(event.target.value)
                                }
                                // onKeyDown={(event) => {
                                //     if (event.key === "Enter") {
                                //         handleAddTag();
                                //     }
                                // }}
                            />
                        )}
                    /> */}
                        </Grid>
                    </Grid>
                    </Box>
                    <Typography
                            sx={{
                                borderLeft: "3px solid black",
                                pl: "12px",
                                mt: "40px",
                                color: customTheme.palette.primary.main,
                                borderColor: customTheme.palette.primary.main,
                            }}
                        >
                            Tour Label
                    </Typography>
                    <Grid
                            container
                            justifyContent="center"
                            width="100%"
                            sx={{ mt: "16px", rowGap: 3, textAlign: "center" }}
                        >
                            <Grid item xs={4} sm={2}>
                                <ToggleButton
                                    value="programming"
                                    selected={selected.programming}
                                    onChange={handleSelected}
                                    sx={{
                                        width: "120px",
                                        height: "32px",
                                        "&.Mui-selected": {
                                            color: customTheme.palette.orange
                                                .main,
                                            bgcolor:
                                                customTheme.palette.orange[10],
                                            borderColor:
                                                customTheme.palette.orange.main,
                                        },
                                    }}
                                >
                                    Programming
                                </ToggleButton>
                            </Grid>
                            <Grid item xs={4} sm={2}>
                                <ToggleButton
                                    value="language"
                                    selected={selected.language}
                                    onChange={handleSelected}
                                    sx={{
                                        width: "120px",
                                        height: "32px",
                                        "&.Mui-selected": {
                                            color: customTheme.palette.orange
                                                .main,
                                            bgcolor:
                                                customTheme.palette.orange[10],
                                            borderColor:
                                                customTheme.palette.orange.main,
                                        },
                                    }}
                                >
                                    Language
                                </ToggleButton>
                            </Grid>
                            <Grid item xs={4} sm={2}>
                                <ToggleButton
                                    value="sport"
                                    selected={selected.sport}
                                    onChange={handleSelected}
                                    sx={{
                                        width: "120px",
                                        height: "32px",
                                        "&.Mui-selected": {
                                            color: customTheme.palette.orange
                                                .main,
                                            bgcolor:
                                                customTheme.palette.orange[10],
                                            borderColor:
                                                customTheme.palette.orange.main,
                                        },
                                    }}
                                >
                                    Sport
                                </ToggleButton>
                            </Grid>
                            <Grid item xs={4} sm={2}>
                                <ToggleButton
                                    value="nature"
                                    selected={selected.nature}
                                    onChange={handleSelected}
                                    sx={{
                                        width: "120px",
                                        height: "32px",
                                        "&.Mui-selected": {
                                            color: customTheme.palette.orange
                                                .main,
                                            bgcolor:
                                                customTheme.palette.orange[10],
                                            borderColor:
                                                customTheme.palette.orange.main,
                                        },
                                    }}
                                >
                                    Nature
                                </ToggleButton>
                            </Grid>
                            <Grid item xs={4} sm={2}>
                                <ToggleButton
                                    value="historical"
                                    selected={selected.historical}
                                    onChange={handleSelected}
                                    sx={{
                                        width: "120px",
                                        height: "32px",
                                        "&.Mui-selected": {
                                            color: customTheme.palette.orange
                                                .main,
                                            bgcolor:
                                                customTheme.palette.orange[10],
                                            borderColor:
                                                customTheme.palette.orange.main,
                                        },
                                    }}
                                >
                                    Historical
                                </ToggleButton>
                            </Grid>
                            <Grid item xs={4} sm={2}>
                                <ToggleButton
                                    value="label1"
                                    selected={selected.label1}
                                    onChange={handleSelected}
                                    sx={{
                                        width: "120px",
                                        height: "32px",
                                        "&.Mui-selected": {
                                            color: customTheme.palette.orange
                                                .main,
                                            bgcolor:
                                                customTheme.palette.orange[10],
                                            borderColor:
                                                customTheme.palette.orange.main,
                                        },
                                    }}
                                >
                                    label1
                                </ToggleButton>
                            </Grid>
                            <Grid item xs={4} sm={2}>
                                <ToggleButton
                                    value="label2"
                                    selected={selected.label2}
                                    onChange={handleSelected}
                                    sx={{
                                        width: "120px",
                                        height: "32px",
                                        "&.Mui-selected": {
                                            color: customTheme.palette.orange
                                                .main,
                                            bgcolor:
                                                customTheme.palette.orange[10],
                                            borderColor:
                                                customTheme.palette.orange.main,
                                        },
                                    }}
                                >
                                    label2
                                </ToggleButton>
                            </Grid>
                            <Grid item xs={4} sm={2}>
                                <ToggleButton
                                    value="label3"
                                    selected={selected.label3}
                                    onChange={handleSelected}
                                    sx={{
                                        width: "120px",
                                        height: "32px",
                                        "&.Mui-selected": {
                                            color: customTheme.palette.orange
                                                .main,
                                            bgcolor:
                                                customTheme.palette.orange[10],
                                            borderColor:
                                                customTheme.palette.orange.main,
                                        },
                                    }}
                                >
                                    label3
                                </ToggleButton>
                            </Grid>
                            <Grid item xs={4} sm={2}>
                                <ToggleButton
                                    value="label4"
                                    selected={selected.label4}
                                    onChange={handleSelected}
                                    sx={{
                                        width: "120px",
                                        height: "32px",
                                        "&.Mui-selected": {
                                            color: customTheme.palette.orange
                                                .main,
                                            bgcolor:
                                                customTheme.palette.orange[10],
                                            borderColor:
                                                customTheme.palette.orange.main,
                                        },
                                    }}
                                >
                                    label4
                                </ToggleButton>
                            </Grid>
                            <Grid item xs={4} sm={2}>
                                <ToggleButton
                                    value="label5"
                                    selected={selected.label5}
                                    onChange={handleSelected}
                                    sx={{
                                        width: "120px",
                                        height: "32px",
                                        "&.Mui-selected": {
                                            color: customTheme.palette.orange
                                                .main,
                                            bgcolor:
                                                customTheme.palette.orange[10],
                                            borderColor:
                                                customTheme.palette.orange.main,
                                        },
                                    }}
                                >
                                    label5
                                </ToggleButton>
                            </Grid>
                            <Grid item xs={4} sm={2}>
                                <ToggleButton
                                    value="label6"
                                    selected={selected.label6}
                                    onChange={handleSelected}
                                    sx={{
                                        width: "120px",
                                        height: "32px",
                                        "&.Mui-selected": {
                                            color: customTheme.palette.orange
                                                .main,
                                            bgcolor:
                                                customTheme.palette.orange[10],
                                            borderColor:
                                                customTheme.palette.orange.main,
                                        },
                                    }}
                                >
                                    label6
                                </ToggleButton>
                            </Grid>
                            <Grid item xs={4} sm={2}>
                                <ToggleButton
                                    value="label7"
                                    selected={selected.label7}
                                    onChange={handleSelected}
                                    sx={{
                                        width: "120px",
                                        height: "32px",
                                        "&.Mui-selected": {
                                            color: customTheme.palette.orange
                                                .main,
                                            bgcolor:
                                                customTheme.palette.orange[10],
                                            borderColor:
                                                customTheme.palette.orange.main,
                                        },
                                    }}
                                >
                                    label7
                                </ToggleButton>
                            </Grid>
                    </Grid>
                    <Typography
                        sx={{
                            borderLeft: "3px solid black",
                            pl: "12px",
                            mt: "40px",
                            color: customTheme.palette.primary.main,
                            borderColor: customTheme.palette.primary.main,
                        }}
                    >
                        Highlights
                    </Typography>
                    <Box
                        pl="10px"
                        mt="20px"
                        mb="48px"
                        sx={{
                            maxHeight: "300px",
                            overflow: "auto",
                        }}
                    >
                        <TextField
                            placeholder="Enter prerequisite"
                            sx={{
                                width: "100%",
                                "& .MuiOutlinedInput-root": {
                                    "& fieldset": {
                                        border: "none",
                                    },
                                    color: "black",
                                },
                                ".MuiInputBase-adornedEnd": {
                                    padding: 0,
                                },
                                borderRadius: "12px",
                            }}
                            variant="outlined"
                            onChange={(e) => setHighlights(e.target.value)}
                            value={highlights}
                            InputProps={{
                                endAdornment: (
                                    <Button
                                        onClick={handleHighlights}
                                        sx={{ marginRight: 0 }}
                                    >
                                        <AddCircleIcon
                                            sx={{
                                                color: customTheme.palette
                                                    .primary.main,
                                            }}
                                        />
                                    </Button>
                                ),
                            }}
                        />

                        <List sx={{ p: 0 }}>
                            {highlightsList.map((items, index) => {
                                return (
                                    <>
                                        <Box display="flex">
                                            <ListItem
                                                key={index}
                                                sx={{
                                                    mt: "15px",
                                                    py: "10px",
                                                    pl: "10px",
                                                    pr: 0,
                                                    bgcolor:
                                                        customTheme.palette
                                                            .primary[40],
                                                    display: "flex",
                                                    justifyContent:
                                                        "space-between",
                                                    alignItems: "center",
                                                    flexDirection: "row",
                                                    borderRadius: "12px",
                                                    color: customTheme.palette
                                                        .white,
                                                }}
                                            >
                                                {items.title}
                                            </ListItem>
                                            <Button
                                                onClick={() =>
                                                    handleCloseHighlightsList(
                                                        items.title
                                                    )
                                                }
                                                sx={{
                                                    mt: "15px",
                                                    p: 0,
                                                }}
                                            >
                                                <RemoveCircleIcon
                                                    sx={{
                                                        color: customTheme
                                                            .palette.orange
                                                            .main,
                                                    }}
                                                />
                                            </Button>
                                        </Box>
                                    </>
                                );
                            })}
                        </List>
                    </Box>
                    <Grid spacing={{ xs: 5, sm: 15 }} container>
                        <Grid item xs={12} sm={6}>
                            <Typography
                                sx={{
                                    borderLeft: "3px solid black",
                                    pl: "12px",
                                    mb: "20px",
                                    color: customTheme.palette.primary.main,
                                    borderColor:
                                        customTheme.palette.primary.main,
                                }}
                            >
                                Includes
                            </Typography>
                            <Box
                                sx={{
                                    maxHeight: "300px",
                                    overflow: "auto",
                                    pl:"10px"
                                }}
                            >
                                <TextField
                                    placeholder="Enter prerequisite"
                                    sx={{
                                        width: "100%",
                                        "& .MuiOutlinedInput-root": {
                                            "& fieldset": {
                                                border: "none",
                                            },
                                            color: "black",
                                        },
                                        ".MuiInputBase-adornedEnd": {
                                            padding: 0,
                                        },
                                    }}
                                    variant="outlined"
                                    onChange={(e) =>
                                        setIncludes(e.target.value)
                                    }
                                    value={includes}
                                    InputProps={{
                                        endAdornment: (
                                            <Button
                                                onClick={handleIncludes}
                                                sx={{ marginRight: 0 }}
                                            >
                                                <AddCircleIcon
                                                    sx={{
                                                        color: customTheme
                                                            .palette.primary
                                                            .main,
                                                    }}
                                                />
                                            </Button>
                                        ),
                                    }}
                                />

                                <List sx={{ p: 0 }}>
                                    {includesList.map((items, index) => {
                                        return (
                                            <>
                                                <Box display="flex">
                                                    <ListItem
                                                        key={index}
                                                        sx={{
                                                            mt: "15px",
                                                            py: "10px",
                                                            pl: "10px",
                                                            pr: 0,
                                                            bgcolor:
                                                                customTheme
                                                                    .palette
                                                                    .primary[40],
                                                            display: "flex",
                                                            justifyContent:
                                                                "space-between",
                                                            alignItems:
                                                                "center",
                                                            flexDirection:
                                                                "row",
                                                            borderRadius:
                                                                "12px",
                                                            color: customTheme
                                                                .palette.white,
                                                        }}
                                                    >
                                                        {items.title}
                                                    </ListItem>
                                                    <Button
                                                        onClick={() =>
                                                            handleCloseIncludesList(
                                                                items.title
                                                            )
                                                        }
                                                        sx={{
                                                            mt: "15px",
                                                            p: 0,
                                                        }}
                                                    >
                                                        <RemoveCircleIcon
                                                            sx={{
                                                                color: customTheme
                                                                    .palette
                                                                    .orange
                                                                    .main,
                                                            }}
                                                        />
                                                    </Button>
                                                </Box>
                                            </>
                                        );
                                    })}
                                </List>
                            </Box>
                        </Grid>
                        <Grid item xs={12} sm={6}>
                            <Typography
                                sx={{
                                    borderLeft: "3px solid black",
                                    pl: "12px",
                                    mb: "20px",
                                    color: customTheme.palette.primary.main,
                                    borderColor:
                                        customTheme.palette.primary.main,
                                }}
                            >
                                Excludes
                            </Typography>
                            <Box
                                mt="20px"
                                sx={{
                                    maxHeight: "300px",
                                    overflow: "auto",
                                    pl:"10px"
                                }}
                            >
                                <TextField
                                    placeholder="Enter prerequisite"
                                    sx={{
                                        width: "100%",
                                        "& .MuiOutlinedInput-root": {
                                            "& fieldset": {
                                                border: "none",
                                            },
                                            color: "black",
                                        },
                                        ".MuiInputBase-adornedEnd": {
                                            padding: 0,
                                        },
                                    }}
                                    variant="outlined"
                                    onChange={(e) =>
                                        setExcludes(e.target.value)
                                    }
                                    value={excludes}
                                    InputProps={{
                                        endAdornment: (
                                            <Button
                                                onClick={handleExcludes}
                                                sx={{ marginRight: 0 }}
                                            >
                                                <AddCircleIcon
                                                    sx={{
                                                        color: customTheme
                                                            .palette.primary
                                                            .main,
                                                    }}
                                                />
                                            </Button>
                                        ),
                                    }}
                                />

                                <List sx={{ p: 0 }}>
                                    {excludesList.map((items, index) => {
                                        return (
                                            <>
                                                <Box display="flex">
                                                    <ListItem
                                                        key={index}
                                                        sx={{
                                                            mt: "15px",
                                                            py: "10px",
                                                            pl: "10px",
                                                            pr: 0,
                                                            bgcolor:
                                                                customTheme
                                                                    .palette
                                                                    .primary[40],
                                                            display: "flex",
                                                            justifyContent:
                                                                "space-between",
                                                            alignItems:
                                                                "center",
                                                            flexDirection:
                                                                "row",
                                                            borderRadius:
                                                                "12px",
                                                            color: customTheme
                                                                .palette.white,
                                                        }}
                                                    >
                                                        {items.title}
                                                    </ListItem>
                                                    <Button
                                                        onClick={() =>
                                                            handleCloseExcludesList(
                                                                items.title
                                                            )
                                                        }
                                                        sx={{
                                                            mt: "15px",
                                                            p: 0,
                                                        }}
                                                    >
                                                        <RemoveCircleIcon
                                                            sx={{
                                                                color: customTheme
                                                                    .palette
                                                                    .orange
                                                                    .main,
                                                            }}
                                                        />
                                                    </Button>
                                                </Box>
                                            </>
                                        );
                                    })}
                                </List>
                            </Box>
                        </Grid>
                    </Grid>
                    <Box
                        display="flex"
                        justifyContent="space-between"
                        alignItems="center"
                        mt={6}
                        mb={3}
                    >
                        <Typography
                            sx={{
                                borderLeft: "3px solid black",
                                pl: "12px",

                                color: customTheme.palette.primary.main,
                                borderColor: customTheme.palette.primary.main,
                            }}
                        >
                            Itineraries
                        </Typography>
                        <Button
                            size="small"
                            onClick={handleClickOpen}
                            // onClick={handleAddItIneraries}
                            variant="contained"
                            sx={{
                                bgcolor: customTheme.palette.orange.main,
                                color: customTheme.palette.white,
                            }}
                        >
                            <AddBoxOutlinedIcon sx={{ mr: 1 }} />
                            <Typography>Add</Typography>
                        </Button>
                    </Box>
                    {itIneraries.map((item) => {
                        const totalID = item.id;
                        return (
                            <Box
                                display="flex"
                                justifyContent="center"
                                alignItems="start"
                                pl="10px"
                            >
                                <Accordion
                                    key={totalID}
                                    sx={{
                                        mb: "30px",
                                        boxShadow: 0,
                                        position: "unset",
                                        width: "100%",
                                    }}
                                >
                                    <AccordionSummary
                                        expandIcon={
                                            <KeyboardArrowDownIcon
                                                sx={{ color: "black" }}
                                            />
                                        }
                                        aria-controls={`bh-content${item.id}`}
                                        sx={{
                                            bgcolor:
                                                customTheme.palette.primary[20],
                                            ".MuiAccordionSummary-contentGutters":
                                                {
                                                    margin: 0,
                                                    display: "flex",
                                                    alignItems: "center",
                                                },
                                            borderRadius: 1,
                                        }}
                                    >
                                        <EventNoteIcon
                                            sx={{
                                                ml: "14px",
                                                mr: "10px",
                                                color: customTheme.palette
                                                    .primary.main,
                                            }}
                                        />
                                        <Typography
                                            sx={{
                                                color: customTheme.palette
                                                    .primary.main,
                                            }}
                                        >
                                            {item.title_day}
                                        </Typography>
                                    </AccordionSummary>

                                    <AccordionDetails sx={{ mt: "20px" }}>
                                        <Grid container spacing={3}>
                                            <Grid item xs={10}>
                                                <TextField
                                                    size="small"
                                                    label="Day Title"
                                                    variant="outlined"
                                                    sx={{ width: "100%" }}
                                                    name="title"
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            totalID
                                                        )
                                                    }
                                                    value={item.title}
                                                />
                                            </Grid>
                                            <Grid item xs={12}>
                                                <TextField
                                                    label="Describe Day2"
                                                    variant="outlined"
                                                    sx={{ width: "100%" }}
                                                    name="description"
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            totalID
                                                        )
                                                    }
                                                    value={item.description}
                                                />
                                            </Grid>
                                        </Grid>
                                    </AccordionDetails>
                                </Accordion>
                                <Button
                                    onClick={() =>
                                        handleRemoveItIneraries(totalID)
                                    }
                                    sx={{
                                        mt: "12px",
                                        p: 0,
                                    }}
                                >
                                    <RemoveCircleIcon
                                        sx={{
                                            color: customTheme.palette.orange
                                                .main,
                                        }}
                                    />
                                </Button>
                            </Box>
                        );
                    })}
                    <Typography
                        sx={{
                            borderLeft: "3px solid black",
                            pl: "12px",
                            mt: "40px",
                            mb: "24px",
                            color: customTheme.palette.primary.main,
                            borderColor: customTheme.palette.primary.main,
                        }}
                    >
                        Gallery
                    </Typography>
                    <Box pl="10px">
                        <ImageList
                            sx={{ width: "100%", px: "15px", overflowX: "auto" }}
                            cols={uploadImage.length + 6}
                        >
                            <ImageListItem>
                                <Button
                                    sx={{
                                        height: "200px",
                                        width: "200px",
                                        bgcolor: customTheme.palette.inputs,
                                        borderRadius: "16px",
                                        display: "flex",
                                        justifyContent: "center",
                                        alignItems: "center",
                                    }}
                                >
                                    <Dropzone
                                        key={dropzoneKey}
                                        /// getUploadParams={
                                        //     getUploadParams
                                        // }
                                        onChangeStatus={handleChangeStatus}
                                        canRemove={false}
                                        inputContent={
                                            <AddIcon
                                                sx={{
                                                    width: "50px",
                                                    height: "50px",
                                                    color: "#5B5B5B",
                                                }}
                                            />
                                        }
                                        PreviewComponent={Preview}
                                        styles={{
                                            dropzone: {
                                                overflow: "hidden",
                                                border: "0px",
                                                height: "100%",
                                            },
                                        }}
                                        accept="image/*,audio/*,video/*"
                                    />

                                    {/* <TextField type="file" id="file-input" style={{ display: "none" }} />
                                    <AddIcon
                                        sx={{
                                            width: "50px",
                                            height: "50px",
                                            color: "#5B5B5B",
                                            
                                        }}
                                    /> */}
                                </Button>

                                {/* <Button
                        sx={{
                            height: "200px",
                            width: "200px",
                            bgcolor: customTheme.palette.inputs,
                            borderRadius: "16px",
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center",
                        }}
                        >
                        <input type="file" id="file-input" style={{ display: "none" }} onChange={(e) => {
                            // Get the selected file
                            const file = e.target.files[0];

                            // Do something with the selected file
                        }} />
                        <label htmlFor="file-input">
                            <AddIcon
                            sx={{
                                width: "50px",
                                height: "50px",
                                color: "#5B5B5B",
                            }}
                            />
                        </label>
                    </Button> */}
                            </ImageListItem>
                            {uploadImage.map((item, index) => (
                                <ImageListItem
                                sx={{
                                    ":hover":
                                        {
                                            "& .button":
                                                {
                                                    visibility:
                                                        "visible",
                                                    "& .icon":
                                                        {
                                                            visibility:
                                                                "visible",
                                                        },
                                                },
                                        },
                                }}
                                key={index}
                            >
                                <img
                                    src={
                                        item
                                            .meta
                                            .previewUrl
                                    }
                                    style={{
                                        height: "200px",
                                        width: "200px",
                                        borderRadius:
                                            "16px",
                                        position:
                                            "relative",
                                    }}
                                    loading="lazy"
                                />
                                <Button
                                    onClick={()=>handleDeleteImageGallery(item.meta.id)}
                                    className="button"
                                    sx={{
                                        position:
                                            "absolute",
                                        visibility:
                                            "hidden",
                                        margin: 0,
                                        left: 0,
                                        bottom: 0,
                                        bgcolor:
                                            "rgba(0, 0, 0, 0.50)",
                                        borderBottomRightRadius:
                                            "16px",
                                        borderBottomLeftRadius:
                                            "16px",
                                        borderTopLeftRadius: 0,
                                        borderTopRightRadius: 0,
                                        width: "200px",
                                        ":hover":
                                            {
                                                bgcolor:
                                                    "rgba(0, 0, 0, 0.50)",
                                            },
                                    }}
                                >
                                    <DeleteForeverOutlinedIcon
                                        className="icon"
                                        sx={{
                                            color: "white",
                                            visibility:
                                                "hidden",
                                        }}
                                    />
                                </Button>
                            </ImageListItem>
                            ))}
                        </ImageList>
                    </Box>

                    <Typography
                        sx={{
                            borderLeft: "3px solid black",
                            pl: "12px",
                            mt: "48px",
                            mb: "16px",
                            color: customTheme.palette.primary.main,
                            borderColor: customTheme.palette.primary.main,
                        }}
                    >
                        Evaluation
                    </Typography>
                    <Box pl="10px" pt="15px">
                        <RadioGroup
                            aria-labelledby="demo-radio-buttons-group-label"
                            name="radio-buttons-group"
                            onChange={handleRadioChange}
                            defaultValue="noEvaluation"
                        >
                            <Box
                                display="flex"
                                textAlign="center"
                                alignItems="center"
                                mt="10px"
                                pl="10px"
                                bgcolor={
                                    backgroundColorButton === "noEvaluation"
                                        ? customTheme.palette.primary[20]
                                        : undefined
                                }
                                borderRadius={1}
                                width={
                                    window.screen.width < 720 ? "100%" : "50%"
                                }
                                sx={{ transition: "all 1s" }}
                            >
                                <FormControlLabel
                                    sx={{
                                        borderRadius: 1,
                                        py: 1,
                                        width: "50%",
                                    }}
                                    value="noEvaluation"
                                    control={<Radio />}
                                    label="No evaluation"
                                />
                            </Box>
                            <Box
                                display="flex"
                                textAlign="center"
                                alignItems="center"
                                
                                pl="10px"
                                bgcolor={
                                    backgroundColorButton === "finalInterview"
                                        ? customTheme.palette.primary[20]
                                        : undefined
                                }
                                borderRadius={1}
                                width={
                                    window.screen.width < 720 ? "100%" : "50%"
                                }
                                sx={{ transition: "all 1s" }}
                            >
                                <FormControlLabel
                                    sx={{
                                        borderRadius: 1,
                                        py: 1,
                                    }}
                                    value="finalInterview"
                                    control={<Radio />}
                                    label="Final interview"
                                />
                                {isTextFieldDisabled === false ? (
                                    <Box
                                        display="flex"
                                        textAlign="center"
                                        alignItems="center"
                                    >
                                        <Typography
                                            sx={{
                                                color: customTheme.palette.gray
                                                    .main,
                                                ml: "39px",
                                            }}
                                        >
                                            Min Score:
                                        </Typography>
                                        <TextField
                                            disabled={isTextFieldDisabled}
                                            {...register("min_score")}
                                            size="small"
                                            sx={{
                                                ml: "20px",
                                                width: "117px",
                                                marginRight: "10px",
                                            }}
                                        />
                                    </Box>
                                ) : undefined}
                            </Box>
                            <Box
                                bgcolor={
                                    backgroundColorButton === "paperBased"
                                        ? customTheme.palette.primary[20]
                                        : undefined
                                }
                                display="flex"
                                textAlign="center"
                                alignItems="center"
                                
                                pl="10px"
                                borderRadius={1}
                                width={
                                    window.screen.width < 720 ? "100%" : "50%"
                                }
                                sx={{ transition: "all 1s" }}
                            >
                                <FormControlLabel
                                    sx={{
                                        borderRadius: 1,
                                        py: 1,
                                    }}
                                    value="paperBased"
                                    control={<Radio />}
                                    label="Paper Based"
                                />
                                {isTextFieldDisabled1 === false ? (
                                    <Box
                                        display="flex"
                                        textAlign="center"
                                        alignItems="center"
                                    >
                                        <Typography
                                            sx={{
                                                color: customTheme.palette.gray
                                                    .main,
                                                ml: "39px",
                                            }}
                                        >
                                            Min Score:
                                        </Typography>
                                        <TextField
                                            disabled={isTextFieldDisabled1}
                                            {...register("min_score")}
                                            size="small"
                                            sx={{
                                                ml: "20px",
                                                width: "117px",
                                                mr: "10px",
                                            }}
                                        />
                                    </Box>
                                ) : undefined}
                            </Box>
                            <Box
                                bgcolor={
                                    backgroundColorButton === "project"
                                        ? customTheme.palette.primary[20]
                                        : undefined
                                }
                                display="flex"
                                textAlign="center"
                                alignItems="center"
                                
                                pl="10px"
                                borderRadius={1}
                                width={
                                    window.screen.width < 720 ? "100%" : "50%"
                                }
                                sx={{ transition: "all 1s" }}
                            >
                                <FormControlLabel
                                    sx={{
                                        

                                        py: 1,

                                        borderRadius: 1,
                                        width: "50%",
                                    }}
                                    value="project"
                                    control={<Radio />}
                                    label="Project"
                                />
                            </Box>
                        </RadioGroup>
                    </Box>

                    <Typography
                        sx={{
                            borderLeft: "3px solid black",
                            pl: "12px",
                            mt: "48px",
                            mb: "16px",
                            color: customTheme.palette.primary.main,
                            borderColor: customTheme.palette.primary.main,
                        }}
                    >
                        Certifications
                    </Typography>
                    <Box pl="10px">
                    <ImageList
                        sx={{ width: "100%", px: "15px", mb: 12 }}
                        cols={uploadImageCertifications.length + 6}
                    >
                        <ImageListItem>
                            <Button
                                sx={{
                                    height: "200px",
                                    width: "200px",
                                    bgcolor: customTheme.palette.inputs,
                                    borderRadius: "16px",
                                    display: "flex",
                                    justifyContent: "center",
                                    alignItems: "center",
                                }}
                            >
                                <Dropzone
                                    key={dropzoneKeyCertifications}
                                    /// getUploadParams={
                                    //     getUploadParams
                                    // }
                                    onChangeStatus={
                                        handleChangeStatusCertifications
                                    }
                                    canRemove={false}
                                    inputContent={
                                        <AddIcon
                                            sx={{
                                                width: "50px",
                                                height: "50px",
                                                color: "#5B5B5B",
                                            }}
                                        />
                                    }
                                    PreviewComponent={PreviewCertifications}
                                    styles={{
                                        dropzone: {
                                            overflow: "hidden",
                                            border: "0px",
                                            height: "100%",
                                        },
                                    }}
                                    accept="image/*,audio/*,video/*"
                                />
                            </Button>
                        </ImageListItem>
                        {uploadImageCertifications.map((item, index) => (
                             <ImageListItem
                             sx={{
                                 ":hover":
                                     {
                                         "& .button":
                                             {
                                                 visibility:
                                                     "visible",
                                                 "& .icon":
                                                     {
                                                         visibility:
                                                             "visible",
                                                     },
                                             },
                                     },
                             }}
                             key={index}
                         >
                             <img
                                 src={
                                     item
                                         .meta
                                         .previewUrl
                                 }
                                 style={{
                                     height: "200px",
                                     width: "200px",
                                     borderRadius:
                                         "16px",
                                     position:
                                         "relative",
                                 }}
                                 loading="lazy"
                             />
                             <Button
                                 onClick={()=>handleDeleteImageCertifications(item.meta.id)}
                                 className="button"
                                 sx={{
                                     position:
                                         "absolute",
                                     visibility:
                                         "hidden",
                                     margin: 0,
                                     left: 0,
                                     bottom: 0,
                                     bgcolor:
                                         "rgba(0, 0, 0, 0.50)",
                                     borderBottomRightRadius:
                                         "16px",
                                     borderBottomLeftRadius:
                                         "16px",
                                     borderTopLeftRadius: 0,
                                     borderTopRightRadius: 0,
                                     width: "200px",
                                     ":hover":
                                         {
                                             bgcolor:
                                                 "rgba(0, 0, 0, 0.50)",
                                         },
                                 }}
                             >
                                 <DeleteForeverOutlinedIcon
                                     className="icon"
                                     sx={{
                                         color: "white",
                                         visibility:
                                             "hidden",
                                     }}
                                 />
                             </Button>
                         </ImageListItem>
                        ))}
                    </ImageList>
                    </Box>
                    <Divider
                        sx={{
                            mb: 6,
                            width: "90%",
                            mx: "auto",
                            borderBottomWidth: "3px",
                            borderColor: customTheme.palette.primary.main,
                        }}
                    />
                    {/* <Box width="100%" textAlign="center">
                <Button
                    sx={{
                        borderRadius: "25px",
                        color: "customTheme.palette.white",
                        bgcolor: customTheme.palette.orange.main,
                        padding: "5px 24px",
                        width: "150px",
                        height: "36px",
                    }}
                    variant="contained"
                >
                    <Typography>Submit</Typography>
                </Button>
                <Button
                    sx={{
                        borderRadius: "25px",
                        color: customTheme.palette.white,
                        bgcolor: customTheme.palette.primary.main,
                        padding: "5px 24px",
                        width: "150px",
                        height: "36px",
                    }}
                    variant="contained"
                >
                    <Typography>Submit</Typography>
                </Button>
            </Box> */}
                    <Box></Box>
                    <Grid
                        spacing={4}
                        container
                        sx={{
                            mb: "56px",
                            display: "flex",
                            justifyContent: "center",
                            alignContent: "center",
                        }}
                    >
                        <Grid item>
                            <Button
                                type={"submit"}
                                sx={{
                                    width: "188px",
                                    height: "36px",
                                    borderRadius: "25px",
                                    color: customTheme.palette.orange.main,
                                    borderColor:
                                        customTheme.palette.orange.main,
                                }}
                                variant="outlined"
                            >
                                <Typography>Add First Group</Typography>
                            </Button>
                        </Grid>
                        <Grid item>
                            <Button
                                sx={{
                                    width: "188px",
                                    height: "36px",
                                    borderRadius: "25px",
                                    color: "customTheme.palette.white",
                                    bgcolor: customTheme.palette.primary.main,
                                }}
                                variant="contained"
                            >
                                <Typography>Save Draft</Typography>
                            </Button>
                        </Grid>
                    </Grid>
                </Box>
            </form>
        </Container>
    );
};

export default AddTour;
