import {
    Accordion,
    AccordionDetails,
    AccordionSummary,
    Autocomplete,
    Avatar,
    Box,
    Button,
    Checkbox,
    Chip,
    Container,
    CssBaseline,
    Dialog,
    DialogActions,
    DialogContent,
    DialogContentText,
    DialogTitle,
    Divider,
    FormControl,
    FormControlLabel,
    FormGroup,
    Grid,
    ImageList,
    ImageListItem,
    InputLabel,
    MenuItem,
    Paper,
    Radio,
    RadioGroup,
    Rating,
    Select,
    Slider,
    SwipeableDrawer,
    Switch,
    SwitchProps,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow,
    TextField,
    Typography,
} from "@mui/material";
import React, { useState } from "react";
import AccountCircleIcon from "@mui/icons-material/AccountCircle";
import RoomIcon from "@mui/icons-material/Room";
import customTheme from "./../../../custom.js";
import RemoveCircleIcon from "@mui/icons-material/RemoveCircle";
import AddBoxOutlinedIcon from "@mui/icons-material/AddBoxOutlined";
import KeyboardArrowDownIcon from "@mui/icons-material/KeyboardArrowDown";
import EventNoteIcon from "@mui/icons-material/EventNote";
import AddIcon from "@mui/icons-material/Add";
import RemoveIcon from "@mui/icons-material/Remove";
import FastfoodIcon from "@mui/icons-material/Fastfood";
import DirectionsBusFilledIcon from "@mui/icons-material/DirectionsBusFilled";
import DescriptionIcon from "@mui/icons-material/Description";
import DomainIcon from "@mui/icons-material/Domain";
import HighlightOffIcon from "@mui/icons-material/HighlightOff";
import { styled } from "@mui/material/styles";
import { tableCellClasses } from "@mui/material/TableCell";
import EditIcon from "@mui/icons-material/Edit";
import DeleteForeverIcon from "@mui/icons-material/DeleteForever";
import CloseIcon from "@mui/icons-material/Close";
import profilePng from "../../images/nava.webp";
import SearchIcon from "@mui/icons-material/Search";
import AttachMoneyIcon from "@mui/icons-material/AttachMoney";
import LocationOnIcon from "@mui/icons-material/LocationOn";
import CalendarTodayIcon from "@mui/icons-material/CalendarToday";
import AddCircleOutlineIcon from "@mui/icons-material/AddCircleOutline";
import { Global } from "@emotion/react";
import IconRightArrow from "./IconRightArrow.js";
import ExpandMoreIcon from "@mui/icons-material/ExpandMore";
import IconTopArrow from "./IconTopArrow.js";
import QuizIcon from "@mui/icons-material/Quiz";
import "react-dropzone-uploader/dist/styles.css";
import Dropzone from "react-dropzone-uploader";
import DeleteForeverOutlinedIcon from "@mui/icons-material/DeleteForeverOutlined";
import avatar from "../../images/nava.webp";

// ios switch
const IOSSwitch = styled((props) => <Switch {...props} />)(({ theme }) => ({
    width: 42,
    height: 26,
    padding: 0,
    "& .MuiSwitch-switchBase": {
        padding: 0,
        margin: 2,
        transitionDuration: "300ms",
        "&.Mui-checked": {
            transform: "translateX(16px)",
            color: "#fff",
            "& + .MuiSwitch-track": {
                backgroundColor:
                    theme.palette.mode === "dark"
                        ? "#2ECA45"
                        : customTheme.palette.orange.main,
                opacity: 1,
                border: 0,
            },
            "&.Mui-disabled + .MuiSwitch-track": {
                opacity: 0.5,
            },
        },
        "&.Mui-focusVisible .MuiSwitch-thumb": {
            color: "#33cf4d",
            border: "6px solid #fff",
        },
        "&.Mui-disabled .MuiSwitch-thumb": {
            color:
                theme.palette.mode === "light"
                    ? theme.palette.grey[100]
                    : theme.palette.grey[600],
        },
        "&.Mui-disabled + .MuiSwitch-track": {
            opacity: theme.palette.mode === "light" ? 0.7 : 0.3,
        },
    },
    "& .MuiSwitch-thumb": {
        boxSizing: "border-box",
        width: 22,
        height: 22,
    },
    "& .MuiSwitch-track": {
        borderRadius: 26 / 2,
        backgroundColor: theme.palette.mode === "light" ? "#E9E9EA" : "#39393D",
        opacity: 1,
        transition: theme.transitions.create(["background-color"], {
            duration: 500,
        }),
    },
}));

// end of ios switch

const AddNewGroup = () => {
    const [inputValuesArray, setInputValuesArray] = useState([
        {
            id: 1,
            form: "",
            to: "",
            by: "",
            documentName: "",
            breakfast: false,
            lunch: false,
            dinner: false,
            snack: false,
        },
    ]);

    const handleInputChange = (e, id) => {
        console.log("inputValuesArray", inputValuesArray);
        const { name, value, checked } = e.target;
        const updatedInputValuesArray = inputValuesArray.map((inputValues) => {
            if (inputValues.id === id) {
                return {
                    ...inputValues,
                    [name]: checked || value,
                };
            }
            return inputValues;
        });

        setInputValuesArray(updatedInputValuesArray);

        const updatedPhases = itIneraries.map((item) => {
            if (item.id === id) {
                return {
                    ...item,
                    [name]: checked || value,
                };
            }
            return item;
        });

        setItIneraries(updatedPhases);
    };
    
    const [itIneraries, setItIneraries] = useState([
        {
            id: 1,
            title: "Day 1",
            unicId: "single",
            form: "",
            to: "",
            by: "",
            documentName: "",
            breakfast: false,
            lunch: false,
            dinner: false,
            snack: false,
            accommodation: [],
            educational: [],
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
                    title: `Day ${counterLocal + 1}`,
                    form: "",
                    to: "",
                    by: "",
                    documentName: "",

                    unicId: "single",
                    breakfast: false,
                    lunch: false,
                    dinner: false,
                    snack: false,
                    accommodation: [],
                    educational: [],
                };
                counterLocal += 1;
                if (counterLocal <= 50) {
                    setCounter(counterLocal);
                }
                setCounterId(counterId + 1);

                const newInputValues = {
                    id: counterId + 1,
                    form: "",
                    to: "",
                    by: "",
                    documentName: "",

                    breakfast: false,
                    lunch: false,
                    dinner: false,
                    snack: false,
                    accommodation: [],
                    educational: [],
                };

                if (counterLocal <= 50) {
                    setItIneraries([...itIneraries, newItIneraries]);
                    setInputValuesArray([...inputValuesArray, newInputValues]);
                }
            } else {
                const newItIneraries = {
                    id: counterId + 1,
                    title: `Day ${counterLocal + 1}th To Day ${
                        counterLocal + numberPopUp
                    }th`,
                    form: "",
                    to: "",
                    by: "",
                    documentName: "",

                    breakfast: false,
                    lunch: false,
                    dinner: false,
                    snack: false,
                    accommodation: [],
                    educational: [],
                    numberPopUp: numberPopUp,
                };

                const newInputValues = {
                    id: counterId + 1,
                    form: "",
                    to: "",
                    by: "",
                    documentName: "",

                    breakfast: false,
                    lunch: false,
                    dinner: false,
                    snack: false,
                    accommodation: [],
                    educational: [],
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
        console.log(itIneraries);
    };

    const [counterRemoveItIneraries, setCounterRemoveItIneraries] = useState(0);

    const handleRemoveItIneraries = (id) => {
        const updatedItIneraries = itIneraries.filter((item) => item.id !== id);
        const updatedinputValuesArray = inputValuesArray.filter(
            (item) => item.id !== id
        );
        setInputValuesArray(updatedinputValuesArray);

        let counterLocal = counterRemoveItIneraries;
        const newItIneraries = updatedItIneraries.map((item) => {
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
        console.log(newItIneraries);
        setCounterRemoveItIneraries(0);
        setCounter(counterLocal);
        setItIneraries(newItIneraries);
    };

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

    const [value, setValue] = React.useState<number | null>(2);

    // const city = [
    //     { label: "Tehran" },
    //     { label: "Isfahan" },
    //     { label: "Arak" },
    //     { label: "Yazd" },
    // ];

    function createData(hotelgrade: string, distance: string, remove: string) {
        return { hotelgrade, distance, remove };
    }

    const rows = [
        createData("Hotel Grade", "mohsen", "mohsen"),
        createData("Distance", "mohsen", "mohsen"),
        createData("Edit / Remove", "mohsen", "mohsen"),
    ];

    // const [age, setAge] = React.useState("");

    // const handleChange = (event: SelectChangeEvent) => {
    //     setAge(event.target.value as string);
    // };
    const [autoCompleteInAccommodation, setAutoCompleteInAccommodation] =
        useState("");

    const handleAutocomplete = (event, newValue) => {
        setAutoCompleteInAccommodation(newValue.label);

        // const updatedAccommodation = accommodation.map((inputValues) => {
        //     if (inputValues.id === id) {
        //         return {
        //             ...inputValues,
        //             city: newValue.label,
        //         };
        //     }
        //     return inputValues;
        // });

        // setAccommodation(updatedAccommodation);

        // const updatedPhases = itIneraries.map((item) => {
        //     if (item.id === id) {
        //         return {
        //             ...item,
        //             city: newValue.label,
        //         };
        //     }
        //     return item;
        // });

        // setItIneraries(updatedPhases);
    };

    const [hotelGradeInAccommodation, setHotelGradeInAccommodation] =
        useState("");

    const handleHotelGradeInAccommodation = (e) => {
        setHotelGradeInAccommodation(e.target.value);
    };

    const [accommodationId, setAccommodationId] = useState(1);

    const handleAccommodation = (id) => {
        console.log(itIneraries);
        if (hotelGradeInAccommodation !== "") {
            const newAccommodation = {
                hotelGrade: hotelGradeInAccommodation,
                // city: autoCompleteInAccommodation,
                id: accommodationId,
            };

            const updateItIneraries = itIneraries.map((item) => {
                if (item.id === id) {
                    return {
                        ...item,
                        accommodation: [
                            ...item.accommodation,
                            newAccommodation,
                        ],
                    };
                }
                return item;
            });

            setItIneraries(updateItIneraries);
            setHotelGradeInAccommodation("");
            setAccommodationId(accommodationId + 1);
        }
    };

    const handleDeleteAccommodation = (id, idAccommodation) => {
        console.log("deleteAccommodation", idAccommodation);
        const update = itIneraries.map((item) => {
            if (item.id === id) {
                item.accommodation = item.accommodation.filter((item) => {
                    return item.id !== idAccommodation;
                });
            }
            return item;
        });

        setItIneraries(update);
    };

    const [selectedValue, setSelectedValue] = useState("noEvaluation");
    const [isTextFieldDisabled, setIsTextFieldDisabled] = useState(true);
    const [isTextFieldDisabled1, setIsTextFieldDisabled1] = useState(true);
    const [isTextFieldDisabled2, setIsTextFieldDisabled2] = useState(true);
    const [backgroundColorButton, setbackgroundColorButton] =
        useState("noEvaluation");

    const handleRadioChange = (event) => {
        const value = event.target.value;
        setSelectedValue(value);

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
        if (value === "project") {
            setIsTextFieldDisabled2(false);
        } else {
            setIsTextFieldDisabled2(true);
        }

        switch (value) {
            case "noEvaluation":
                setbackgroundColorButton("noEvaluation");
                break;
            case "finalInterview":
                setbackgroundColorButton("finalInterview");
                break;
            case "paperBased":
                setbackgroundColorButton("paperBased");
                break;
            case "project":
                setbackgroundColorButton("project");
                break;
        }
    };

    const agent = [
        { title: "Mohsen", img: profilePng },
        { title: "Akbar", img: profilePng },
        { title: "Asghar", img: profilePng },
        { title: "Ali", img: profilePng },
        { title: "Mamad", img: profilePng },
    ];

    const [age, setAge] = useState("");

    const handleChange = (event) => {
        setAge(event.target.value as string);
    };

    const [startPointsArray, setStartPointsArray] = useState({
        start: "",
        from: "",
        by: "",
    });

    const handleStartPointsArray = (e) => {
        const { name, value } = e.target;
        const item = {
            ...startPointsArray,
            [name]: value,
        };
        setStartPointsArray(item);
    };

    const [startPoints, setStartPoints] = useState([]);
    const [startPointsId, setStartPointsId] = useState(1);

    const handleStartPoints = () => {
        if (
            startPointsArray.start !== "" &&
            startPointsArray.from !== "" &&
            startPointsArray.by !== ""
        ) {
            const newStartPoints = {
                start: startPointsArray.start,
                from: startPointsArray.from,
                by: startPointsArray.by,
                id: startPointsId,
            };
            setStartPointsArray({ start: "", from: "", by: "" });
            setStartPointsId(startPointsId + 1);
            setStartPoints((prevStartPoints) => [
                ...prevStartPoints,
                newStartPoints,
            ]);
        }
    };

    const handleRemoveStartPoints = (id) => {
        const updatedStartPoints = startPoints.filter((item) => item.id !== id);
        setStartPoints(updatedStartPoints);
    };

    const [documentName, setDocumentName] = useState("");

    const handleDocumentName = (e) => {
        setDocumentName(e.target.value);
    };

    const [fileEducational, setFileEducational] = useState(null);

    const handleFileEducational = (e) => {
        const temp = e.target.files[0];
        setFileEducational(temp);
    };

    const handleRemoveFile = () => {
        setFileEducational(null);
    };

    const [educationalId, setEducationalId] = useState(1);

    const handleEducational = (id) => {
        if (fileEducational !== "" && documentName !== "") {
            const newEducational = {
                documentname: documentName,
                file: fileEducational,
                id: educationalId,
            };

            const updateItIneraries = itIneraries.map((item) => {
                if (item.id === id) {
                    return {
                        ...item,
                        educational: [...item.educational, newEducational],
                    };
                }
                return item;
            });

            setItIneraries(updateItIneraries);
            setDocumentName("");
            setFileEducational(null);
            setEducationalId(educationalId + 1);
        }
    };

    const handleDeleteEducational = (id, idEducational) => {
        console.log("deleteAccommodation", idEducational);
        const update = itIneraries.map((item) => {
            if (item.id === id) {
                item.educational = item.educational.filter((item) => {
                    return item.id !== idEducational;
                });
            }
            return item;
        });

        setItIneraries(update);
    };

    const [selectedValueAudition, setSelectedValueAudition] =
        useState("noAudition");
    const [isTextFieldDisabledAudition, setIsTextFieldDisabledAudition] =
        useState(true);
    const [isTextFieldDisabledAudition1, setIsTextFieldDisabledAudition1] =
        useState(true);
    const [backgroundColorButtonAudition, setbackgroundColorButtonAudition] =
        useState("noAudition");

    const handleRadioChangeAudition = (event) => {
        const value = event.target.value;
        setSelectedValueAudition(value);

        if (value === "examination") {
            setIsTextFieldDisabledAudition(false);
        } else {
            setIsTextFieldDisabledAudition(true);
        }
        if (value === "uploadLicense") {
            setIsTextFieldDisabledAudition1(false);
        } else {
            setIsTextFieldDisabledAudition1(true);
        }

        switch (value) {
            case "noAudition":
                setbackgroundColorButtonAudition("noAudition");
                break;
            case "examination":
                setbackgroundColorButtonAudition("examination");
                break;
            case "uploadLicense":
                setbackgroundColorButtonAudition("uploadLicense");
                break;
        }
    };

    const [AuditionButton, setAuditionButton] = useState("");

    const handleChange1 = (event) => {
        setAuditionButton(event.target.value as string);
    };

    const [expanded, setExpanded] = useState(true);
    const handleChangeAco = () => {
        setExpanded(!expanded);
    };
    const handleCloseAco = () => {
        setExpanded(!expanded);
    };

    const [displayAco, setDisplayAco] = useState(false);

    const handleDisplayAco = () => {
        setDisplayAco(true);
        setExpanded(!expanded);
    };

    // --------------------------------------------------------------------------------------------------------
    const [inputValuesArrayAco, setInputValuesArrayAco] = useState([
        {
            id: 1,
            questionType: "test",
            question: "",
            answer1: "",
            answer2: "",
            answer3: "",
            answer4: "",
            correctAnswer: "",
        },
    ]);

    const handleInputChangeAco = (e, id) => {
        const { name, value } = e.target;
        const updatedInputValuesArray = inputValuesArrayAco.map(
            (inputValues) => {
                if (inputValues.id === id) {
                    return {
                        ...inputValues,
                        [name]: value,
                    };
                }
                return inputValues;
            }
        );

        setInputValuesArrayAco(updatedInputValuesArray);

        const updatedPhases = itInerariesAco.map((item) => {
            if (item.id === id) {
                return {
                    ...item,
                    [name]: value,
                };
            }
            return item;
        });

        setItInerariesAco(updatedPhases);
        console.log(inputValuesArrayAco);
    };

    const [itInerariesAco, setItInerariesAco] = useState([
        {
            id: 1,
            title: "Question 1",

            questionType: "test",
            question: "",
            answer1: "",
            answer2: "",
            answer3: "",
            answer4: "",
            correctAnswer: "",
        },
    ]);
    const [counterAco, setCounterAco] = useState(1);
    const [counterIdAco, setCounterIdAco] = useState(1);

    const handleAddItInerariesAco = () => {
        if (counterIdAco <= 50) {
            if (numberPopUp === 1) {
                const newItIneraries = {
                    id: counterIdAco + 1,
                    title: `Question ${counterIdAco + 1}`,
                    questionType: "test",
                    question: "",
                    answer1: "",
                    answer2: "",
                    answer3: "",
                    answer4: "",
                    correctAnswer: "",
                };

                if (counterIdAco <= 50) {
                    setCounterAco(counterIdAco);
                }
                setCounterIdAco(counterIdAco + 1);

                const newInputValues = {
                    id: counterIdAco + 1,
                    questionType: "test",
                    question: "",
                    answer1: "",
                    answer2: "",
                    answer3: "",
                    answer4: "",
                    correctAnswer: "",
                };

                if (counterIdAco <= 50) {
                    setItInerariesAco([...itInerariesAco, newItIneraries]);
                    setInputValuesArrayAco([
                        ...inputValuesArrayAco,
                        newInputValues,
                    ]);
                }
            }
        }
    };

    const [counterRemoveItInerariesAco, setCounterRemoveItInerariesAco] =
        useState(0);

    const handleRemoveItInerariesAco = (id) => {
        const updatedItIneraries = itInerariesAco.filter(
            (item) => item.id !== id
        );
        const updatedinputValuesArray = inputValuesArrayAco.filter(
            (item) => item.id !== id
        );
        setInputValuesArrayAco(updatedinputValuesArray);

        let counterLocal = counterRemoveItInerariesAco;
        const newItIneraries = updatedItIneraries.map((item) => {
            const newTitle1 = `Question ${counterLocal + 1}`;
            counterLocal += 1;
            return {
                ...item,
                title: newTitle1,
            };
        });

        setCounterRemoveItInerariesAco(0);
        setCounterAco(counterLocal);
        setItInerariesAco(newItIneraries);
    };

    // --------------------------------------------------------------------------------------------------------

    // const [answerAco, setAnswerAco] = useState("");

    const handleChangeAnswer = (event, id) => {
        // setAnswerAco(event.target.value)

        const newItemAco = itInerariesAco.map((item) => {
            if (item.id === id) {
                return {
                    ...item,
                    correctAnswer: event.target.value,
                };
            }
            return item;
        });
        console.log(newItemAco);
        setItInerariesAco(newItemAco);
    };

    const [examTitle, setExamTitle] = useState("");

    const handleExamTitle = (e) => {
        setExamTitle(e.target.value);
    };

    const [AuditionList, setAuditionList] = useState([]);

    const handleAuditionList = () => {
        // const temp = AuditionList.map(item=>{
        //     return [...item , ]
        // })

        const temp = { itInerariesAco, examTitle };

        setAuditionList([...AuditionList, temp]);
        setItInerariesAco([
            {
                id: 1,
                title: "Question 1",

                questionType: "test",
                question: "",
                answer1: "",
                answer2: "",
                answer3: "",
                answer4: "",
                correctAnswer: "",
            },
        ]);
        setExamTitle("");
        handleCloseeAco();
        setCounterIdAco(1);
        console.log(itInerariesAco);
    };

    const [dialog, setDialog] = React.useState(false);

    const handleClickOpenDialog = () => {
        setDialog(true);
    };

    const handleCloseDialog = () => {
        setDialog(false);
    };

    const [uploadLicense, setUploadLicense] = useState([]);
    const [uploadLicensePop, setUploadLicensePop] = useState({
        title: "",
        description: "",
    });
    const [uploadLicensePopId, setUploadLicensePopId] = useState(1);
    const handleChangeLicense = (e) => {
        const { name, value } = e.target;

        setUploadLicensePop((prevData) => ({
            ...prevData,
            [name]: value,
            id: uploadLicensePopId,
        }));
    };

    const handleUploadLicense = () => {
        if (uploadLicensePop.description && uploadLicensePop.title) {
            setUploadLicense([...uploadLicense, uploadLicensePop]);
            setUploadLicensePopId(uploadLicensePopId + 1);
            handleCloseDialog();
            setUploadLicensePop({
                title: "",
                description: "",
            });
        }
    };

    const handleDeleteUploadLicense = (id) => {
        const update = uploadLicense.filter((item) => item.id !== id);
        console.log(update);
        setUploadLicense(update);
    };

    const [openAco, setOpenAco] = React.useState(false);

    const handleClickOpenAco = () => {
        setOpenAco(true);
    };

    const handleCloseeAco = () => {
        setOpenAco(false);
        setItInerariesAco([
            {
                id: 1,
                title: "Question 1",

                questionType: "test",
                question: "",
                answer1: "",
                answer2: "",
                answer3: "",
                answer4: "",
                correctAnswer: "",
            },
        ]);
        setExamTitle("");
        setCounterIdAco(1);
    };

    const [valueRange, setValueRange] = React.useState<number[]>([20, 37]);
    const handleChangeRange = (event: Event, newValue: number | number[]) => {
        setValueRange(newValue as number[]);
        setValue("age", valueRange);
    };
    function valuetextRange(value: number) {
        return `${value}`;
    }

    const [switchTravelAgency, setSwitchTravelAgency] = useState(true);
    const handleSwitchTravelAgency = () => {
        setSwitchTravelAgency(!switchTravelAgency);
    };
    const [switchRecommendationOptions, setSwitchRecommendationOptions] =
        useState(true);
    const handleSwitchRecommendationOptions = () => {
        setSwitchRecommendationOptions(!switchRecommendationOptions);
    };



    const marksCapacity = [
        {
            value: 10,
            label: "10",
        },
        {
            value: 15,
        },
        {
            value: 20,
        },
        {
            value: 25,
        },
        {
            value: 30,
        },
        {
            value: 35,
        },
        {
            value: 40,
        },
        {
            value: 45,
        },
        {
            value: 50,
        },
        {
            value: 55,
        },
        {
            value: 60,
        },
        {
            value: 65,
        },
        {
            value: 70,
        },
        {
            value: 75,
        },
        {
            value: 80,
        },
        {
            value: 85,
        },
        {
            value: 90,
        },
        {
            value: 95,
        },

        {
            value: 100,
            label: "100",
        },
    ];
    const marksBookFeePercentage = [
        {
            value: 0,
            label: "0%",
        },
        {
            value: 10,
        },
        {
            value: 20,
        },

        {
            value: 30,
        },
        {
            value: 40,
        },

        {
            value: 50,
        },

        {
            value: 60,
        },

        {
            value: 70,
        },

        {
            value: 80,
        },

        {
            value: 90,
        },

        {
            value: 100,
            label: "100%",
        },
    ];

    //    dropzone

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
            console.log(uploadImage)
            setUploadImage([...uploadImage, files[0]]);
            setDropzoneKey(Date.now());
        }
    };

    const handleDeleteImageGallery = (id) =>{
        const update = uploadImage.filter(item => item.meta.id !== id)
        setUploadImage(update)
    }

    //   end of  dropzone

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

            {/* ------------------------------------------------------------------------------------------------ */}

            <Dialog
                open={dialog}
                onClose={handleCloseDialog}
                aria-describedby="alert-dialog-description1"
            >
                <DialogContent sx={{ p: 3 }}>
                    <DialogContentText id="alert-dialog-description1">
                        <Typography
                            sx={{ color: customTheme.palette.primary.main }}
                        >
                            Upload Required License
                        </Typography>
                        <TextField
                            sx={{
                                width: screen.width >= 768 ? "50%" : "100%",
                                my: 2,
                            }}
                            size="small"
                            label="License Title"
                            onChange={handleChangeLicense}
                            name="title"
                            value={uploadLicensePop.title}
                        />
                        <TextField
                            multiline
                            rows={3}
                            label="Description"
                            variant="outlined"
                            sx={{ width: "100%" }}
                            onChange={handleChangeLicense}
                            name="description"
                            value={uploadLicensePop.description}
                        />
                    </DialogContentText>
                    <Grid
                        textAlign="center"
                        spacing={4}
                        container
                        sx={{
                            my: 1,
                            display: "flex",
                            justifyContent: "center",
                            alignContent: "center",
                        }}
                    >
                        <Grid item xs={12} sm={6}>
                            <Button
                                onClick={handleCloseDialog}
                                sx={{
                                    width: "117px",
                                    height: "26px",

                                    color: customTheme.palette.orange.main,
                                    borderColor:
                                        customTheme.palette.orange.main,
                                }}
                                variant="outlined"
                            >
                                <Typography>Cancel</Typography>
                            </Button>
                        </Grid>
                        <Grid item xs={12} sm={6}>
                            <Button
                                onClick={handleUploadLicense}
                                sx={{
                                    width: "117px",
                                    height: "26px",

                                    color: "customTheme.palette.white",
                                    bgcolor: customTheme.palette.primary.main,
                                }}
                                variant="contained"
                            >
                                <Typography>Add</Typography>
                            </Button>
                        </Grid>
                    </Grid>
                </DialogContent>
            </Dialog>

            {/* ---------------------------------------------------------------------------------------------- */}

            {/* ----------------------------------------------------end dialog------------------------------------------------------- */}
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
            
            <Grid container spacing="34px">
                <Grid item xs={12} sm={10}>
                    <TextField
                        size="small"
                        required
                        label="Group Name "
                        variant="outlined"
                        sx={{ width: "100%" }}
                    />
                </Grid>
                <Grid item xs={12}>
                    <TextField
                        multiline
                        rows={3}
                        label="Group Overview"
                        variant="outlined"
                        sx={{ width: "100%" }}
                    />
                </Grid>
                <Grid item xs={6} sm={4}>
                    <TextField
                        label="Start Registration"
                        size="small"
                        type="date"
                        variant="outlined"
                        sx={{ width: "100%" }}
                        InputLabelProps={{ shrink: true }}
                        defaultValue="2023-05-24"
                    />
                </Grid>
                <Grid item xs={6} sm={4}>
                    <TextField
                        label="End Registration"
                        size="small"
                        type="date"
                        variant="outlined"
                        sx={{ width: "100%" }}
                        InputLabelProps={{ shrink: true }}
                        defaultValue="2023-05-24"
                    />
                </Grid>
                <Grid item xs={6} sm={4}>
                    <TextField
                        label="Start of the journey"
                        size="small"
                        type="date"
                        variant="outlined"
                        sx={{ width: "100%" }}
                        InputLabelProps={{ shrink: true }}
                        defaultValue="2023-05-24"
                    />
                </Grid>

                <Grid item xs={6} sm={4}>
                    <TextField
                        label="Price"
                        size="small"
                        variant="outlined"
                        sx={{ width: "100%" }}
                        InputProps={{
                            endAdornment: <AttachMoneyIcon />,
                        }}
                    />
                </Grid>
                <Grid item xs={12} sm={8}>
                    <Typography
                        sx={{
                            mb: "10px",
                            color: customTheme.palette.gray.main,
                        }}
                    >
                        Book fee percentage
                    </Typography>
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
                        step={10}
                        marks={marksBookFeePercentage}
                        track={false}
                        defaultValue={50}
                        aria-label="Default"
                        valueLabelDisplay="auto"
                    />
                </Grid>
                <Grid item xs={12}>
                    <Typography
                        sx={{
                            mb: "10px",
                            color: customTheme.palette.gray.main,
                        }}
                    >
                        Capacity
                    </Typography>
                    <Slider
                        step={5}
                        marks={marksCapacity}
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
                        max={100}
                        min={10}
                    />
                </Grid>
            </Grid>

            <Typography
                sx={{
                    borderLeft: "3px solid black",
                    pl: "12px",
                    mt: "34px",
                    mb: "20px",
                    color: customTheme.palette.primary.main,
                    borderColor: customTheme.palette.primary.main,
                }}
            >
                Group Type
            </Typography>

            <Grid container>
                <Grid item xs={12}>
                    <RadioGroup
                        aria-labelledby="demo-radio-buttons-group-label"
                        row
                        sx={{ ml: "36px", pt: 0 }}
                    >
                        <FormControlLabel
                            value="public"
                            control={<Radio />}
                            label="Public"
                        />
                        <FormControlLabel
                            value="private "
                            control={<Radio />}
                            label="Private "
                            sx={{ ml: "10px" }}
                        />
                    </RadioGroup>
                </Grid>
            </Grid>
            <Typography
                sx={{
                    borderLeft: "3px solid black",
                    pl: "12px",
                    mt: "34px",
                    mb: "20px",
                    color: customTheme.palette.primary.main,
                    borderColor: customTheme.palette.primary.main,
                }}
            >
                Travel Agency
            </Typography>
            <Box display="flex" ml="36px" alignItems="center">
                <Typography sx={{ mr: 3 }}>Travel Agency Required</Typography>

                <FormControlLabel
                    control={
                        <IOSSwitch
                            sx={{ m: 1 }}
                            defaultChecked
                            checked={switchTravelAgency}
                            onChange={handleSwitchTravelAgency}
                        />
                    }
                />

                {/* <IOSSwitch onChange={handleIOSSwitch}/> */}
            </Box>
            {switchTravelAgency && (
                <Box ml="36px" mt="36px">
                    <Typography sx={{ mb: "16px" }}>
                        If you have a suggested Agent, enter the ID Address to
                        send it to them:
                        <Typography
                            color={customTheme.palette.gray[30]}
                            component="span"
                        >
                            (Optional)
                        </Typography>
                    </Typography>
                    <Autocomplete
                        popupIcon={<SearchIcon />}
                        sx={{
                            "& .MuiInputLabel-asterisk": {
                                display: "none",
                            },
                            "& .MuiTextField-root": {
                                borderRadius: "5px",
                            },
                            mb: "29px",
                            width: screen.width >= 768 ? "75%" : "100%",
                        }}
                        size="small"
                        multiple
                        id="tags-outlined"
                        options={agent}
                        getOptionLabel={(option) => option.title}
                        filterSelectedOptions
                        renderOption={(props, option) => (
                            <li {...props}>
                                <img
                                    src={option.img}
                                    alt={option.title}
                                    style={{
                                        width: "20px",
                                        height: "20px",
                                        marginRight: "5px",
                                        borderRadius: "50%",
                                    }}
                                />
                                {option.title}
                            </li>
                        )}
                        renderTags={(value, getTagProps) =>
                            value.map((option, index) => (
                                <Chip
                                    deleteIcon={<CloseIcon />}
                                    sx={{
                                        "& .MuiChip-deleteIcon": {
                                            color: customTheme.palette.gray
                                                .main,
                                            mr: "5px",
                                            ml: "3px",
                                        },
                                        "&:hover .MuiChip-deleteIcon": {
                                            color: "#292D32",
                                        },
                                        color: customTheme.palette.gray.main,
                                    }}
                                    variant="outlined"
                                    label={
                                        <div
                                            style={{
                                                display: "flex",
                                                alignItems: "center",
                                            }}
                                        >
                                            <img
                                                src={option.img}
                                                alt={option.title}
                                                style={{
                                                    width: "20px",
                                                    height: "20px",
                                                    marginRight: "5px",
                                                    borderRadius: "50%",
                                                }}
                                            />
                                            {option.title}
                                        </div>
                                    }
                                    {...getTagProps({ index })}
                                />
                            ))
                        }
                        renderInput={(params) => <TextField {...params} />}
                    />
                </Box>
            )}

            {/* <Typography
                sx={{
                    borderLeft: "3px solid black",
                    pl: "12px",
                    mt: "34px",
                    mb: "20px",
                    color: customTheme.palette.primary.main,
                    borderColor: customTheme.palette.primary.main,
                }}
            >
                Start Points
            </Typography>
            <Grid container spacing="34px">
                <Grid item xs={3.3}>
                    <TextField
                        name="start"
                        value={startPointsArray.start}
                        onChange={handleStartPointsArray}
                        label="Start"
                        size="small"
                        type="date"
                        variant="outlined"
                        sx={{ width: "100%" }}
                        InputLabelProps={{ shrink: true }}
                        defaultValue="2023-05-24"
                    />
                </Grid>
                <Grid item xs={3.3}>
                    <TextField
                        name="from"
                        value={startPointsArray.from}
                        onChange={handleStartPointsArray}
                        sx={{ width: "100%" }}
                        size="small"
                        label={
                            <Box display="flex" justifyContent="center">
                                <LocationOnIcon />
                                <Typography sx={{ ml: "16px" }}>
                                    From
                                </Typography>
                            </Box>
                        }
                    />
                </Grid>
                <Grid item xs={3.3}>
                    <TextField
                        name="by"
                        value={startPointsArray.by}
                        onChange={handleStartPointsArray}
                        sx={{ width: "100%" }}
                        size="small"
                        label={
                            <Box display="flex" justifyContent="center">
                                <DirectionsBusFilledIcon />
                                <Typography sx={{ ml: "16px" }}>By</Typography>
                            </Box>
                        }
                    />
                </Grid>
                <Grid item xs={2}>
                    <Button
                        onClick={handleStartPoints}
                        size="small"
                        variant="contained"
                        sx={{
                            bgcolor: customTheme.palette.orange.main,
                            color: customTheme.palette.white,
                            width: "119px",
                            height: "36px",
                            p: "5px 24px",
                        }}
                    >
                        <Typography>Add</Typography>
                    </Button>
                </Grid>
            </Grid> */}
            {/* <Box
                sx={{
                    width: "100%",
                    display: "flex",
                    justifyContent: "center",
                }}
            >
                <TableContainer
                    component={Paper}
                    sx={{
                        mt: "28px",
                        width: "700px",
                        borderRadius: "16px",
                    }}
                >
                    <Table aria-label="customized table">
                        <TableHead
                            sx={{
                                bgcolor: customTheme.palette.gray[40],
                            }}
                        >
                            <TableRow>
                                <TableCell
                                    align="left"
                                    sx={{
                                        color: customTheme.palette.white,
                                    }}
                                >
                                    <Typography>Start</Typography>
                                </TableCell>
                                <TableCell
                                    align="center"
                                    sx={{
                                        color: customTheme.palette.white,
                                    }}
                                >
                                    <Typography>From</Typography>
                                </TableCell>
                                <TableCell
                                    align="center"
                                    sx={{
                                        color: customTheme.palette.white,
                                    }}
                                >
                                    <Typography>By</Typography>
                                </TableCell>
                                <TableCell
                                    align="right"
                                    sx={{
                                        color: customTheme.palette.white,
                                    }}
                                >
                                    <Typography>Remove</Typography>
                                </TableCell>
                            </TableRow>
                        </TableHead>
                        <TableBody>
                            {startPoints.map((item) => (
                                <TableRow
                                    key={item.id}
                                    sx={{
                                        "&:nth-of-type(odd)": {
                                            backgroundColor:
                                                customTheme.palette.input,
                                        },
                                        "&:nth-of-type(even)": {
                                            backgroundColor:
                                                customTheme.palette.chat,
                                        },
                                    }}
                                >
                                    <TableCell
                                        align="left"
                                        component="th"
                                        scope="row"
                                    >
                                        <Typography>{item.start}</Typography>
                                    </TableCell>
                                    <TableCell align="center">
                                        <Typography
                                            sx={{
                                                color: customTheme.palette.gray
                                                    .main,
                                            }}
                                        >
                                            {item.from}
                                        </Typography>
                                    </TableCell>
                                    <TableCell align="center">
                                        <Typography
                                            sx={{
                                                color: customTheme.palette.gray
                                                    .main,
                                            }}
                                        >
                                            {item.by}
                                        </Typography>
                                    </TableCell>
                                    <TableCell align="right">
                                        <Box
                                            display="flex"
                                            justifyContent="end"
                                        >
                                           
                                            <Button
                                                onClick={() =>
                                                    handleRemoveStartPoints(
                                                        item.id
                                                    )
                                                }
                                                sx={{
                                                    p: 0,
                                                    minWidth: "30px",
                                                    ml: 2,
                                                    mr: 2,
                                                }}
                                            >
                                                <DeleteForeverIcon
                                                    sx={{
                                                        color: customTheme
                                                            .palette.orange
                                                            .main,
                                                    }}
                                                />
                                            </Button>
                                        </Box>
                                    </TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </TableContainer>
            </Box> */}

            <Typography
                sx={{
                    borderLeft: "3px solid black",
                    pl: "12px",
                    mt: "34px",
                    mb: "20px",
                    color: customTheme.palette.primary.main,
                    borderColor: customTheme.palette.primary.main,
                }}
            >
                Extra Items
            </Typography>
            <TextField
                multiline
                rows={3}
                label="Extra Items"
                variant="outlined"
                sx={{ width: "100%" }}
            />

            <Typography
                sx={{
                    borderLeft: "3px solid black",
                    pl: "12px",
                    mt: "34px",
                    mb: "20px",
                    color: customTheme.palette.primary.main,
                    borderColor: customTheme.palette.primary.main,
                }}
            >
                Audition
            </Typography>
            <Box pl="10px" pt="15px">
                <RadioGroup
                    aria-labelledby="demo-radio-buttons-group-label"
                    name="radio-buttons-group"
                    value={selectedValueAudition}
                    onChange={handleRadioChangeAudition}
                >
                    <Box
                        display="flex"
                        justifyContent="space-between"
                        alignItems="center"
                        mt="10px"
                        pl="10px"
                        bgcolor={
                            backgroundColorButtonAudition === "noAudition"
                                ? customTheme.palette.primary[20]
                                : undefined
                        }
                        borderRadius={1}
                        width={window.screen.width < 720 ? "100%" : "50%"}
                        sx={{ transition: "all 1s" }}
                    >
                        <FormControlLabel
                            sx={{
                                borderRadius: 1,
                                py: 1,
                                width: "50%",
                            }}
                            value="noAudition"
                            control={<Radio />}
                            label="No Audition"
                        />
                    </Box>
                    <Box
                        display="flex"
                        justifyContent="space-between"
                        alignItems="center"
                        pl="10px"
                        bgcolor={
                            backgroundColorButtonAudition === "examination"
                                ? customTheme.palette.primary[20]
                                : undefined
                        }
                        borderRadius={1}
                        width={window.screen.width < 720 ? "100%" : "50%"}
                        sx={{ transition: "all 1s" }}
                    >
                        <FormControlLabel
                            sx={{
                                borderRadius: 1,
                                py: 1,
                            }}
                            value="examination"
                            control={<Radio />}
                            label="Examination"
                        />
                        {isTextFieldDisabledAudition === false ? (
                            <Box sx={{ minWidth: 200, mr: 1 }}>
                                <FormControl fullWidth size="small">
                                    <InputLabel id="demo-simple-select-label">
                                        Exams
                                    </InputLabel>
                                    <Select
                                        labelId="demo-simple-select-label"
                                        id="demo-simple-select"
                                        value={AuditionButton}
                                        label="Exams"
                                        onChange={handleChange1}
                                    >
                                        {AuditionList.map((item) => {
                                            return (
                                                <MenuItem
                                                    value={item.examTitle}
                                                >
                                                    {item.examTitle}
                                                </MenuItem>
                                            );
                                        })}
                                        <MenuItem onClick={handleClickOpenAco}>
                                            <em>
                                                <Button
                                                    disableRipple
                                                    sx={{
                                                        p: 0,
                                                        color: "gray",
                                                        mx: "25px",
                                                    }}
                                                    variant="text"
                                                >
                                                    <AddCircleOutlineIcon
                                                        sx={{
                                                            mr: 1,
                                                            color: "gray",
                                                        }}
                                                    />
                                                    Add New
                                                </Button>
                                            </em>
                                        </MenuItem>
                                    </Select>
                                </FormControl>
                            </Box>
                        ) : undefined}
                    </Box>
                    <Box
                        bgcolor={
                            backgroundColorButtonAudition === "uploadLicense"
                                ? customTheme.palette.primary[20]
                                : undefined
                        }
                        display="flex"
                        justifyContent="space-between"
                        alignItems="center"
                        pl="10px"
                        borderRadius={1}
                        width={window.screen.width < 720 ? "100%" : "50%"}
                        sx={{ transition: "all 1s" }}
                    >
                        <FormControlLabel
                            sx={{
                                borderRadius: 1,
                                py: 1,
                            }}
                            value="uploadLicense"
                            control={<Radio />}
                            label="Upload License"
                        />
                        {isTextFieldDisabledAudition1 === false ? (
                            <Button
                                onClick={handleClickOpenDialog}
                                size="small"
                                variant="contained"
                                sx={{
                                    bgcolor: customTheme.palette.orange.main,
                                    color: customTheme.palette.white,
                                    mr: 1,
                                }}
                            >
                                <AddBoxOutlinedIcon sx={{ mr: 1 }} />
                                <Typography>Add</Typography>
                            </Button>
                        ) : undefined}
                    </Box>
                </RadioGroup>
            </Box>
            {isTextFieldDisabledAudition1 === false ? (
                <Box
                    sx={{
                        width: "100%",
                        display: "flex",
                        justifyContent: "center",
                    }}
                >
                    <TableContainer
                        component={Paper}
                        sx={{
                            mt: "28px",
                            width: "864px",
                            borderRadius: "16px",
                        }}
                    >
                        <Table aria-label="customized table">
                            <TableHead
                                sx={{
                                    bgcolor: customTheme.palette.gray[40],
                                }}
                            >
                                <TableRow>
                                    <TableCell
                                        align="left"
                                        sx={{
                                            color: customTheme.palette.white,
                                        }}
                                    >
                                        <Typography>License Title</Typography>
                                    </TableCell>
                                    <TableCell
                                        align="left"
                                        sx={{
                                            color: customTheme.palette.white,
                                        }}
                                    >
                                        <Typography>Description</Typography>
                                    </TableCell>
                                    <TableCell
                                        align="right"
                                        sx={{
                                            color: customTheme.palette.white,
                                        }}
                                    >
                                        <Typography>Remove</Typography>
                                    </TableCell>
                                </TableRow>
                            </TableHead>
                            <TableBody>
                                {uploadLicense.map((item) => (
                                    <TableRow
                                        key={item.title}
                                        sx={{
                                            "&:nth-of-type(odd)": {
                                                backgroundColor:
                                                    customTheme.palette.input,
                                            },
                                            "&:nth-of-type(even)": {
                                                backgroundColor:
                                                    customTheme.palette.chat,
                                            },
                                        }}
                                    >
                                        <TableCell
                                            align="left"
                                            component="th"
                                            scope="row"
                                        >
                                            <Typography>
                                                {item.title}
                                            </Typography>
                                        </TableCell>
                                        <TableCell align="left">
                                            <Typography
                                                sx={{
                                                    color: customTheme.palette
                                                        .gray.main,
                                                }}
                                            >
                                                {item.description}
                                            </Typography>
                                        </TableCell>
                                        <TableCell align="right">
                                            <Box
                                                display="flex"
                                                justifyContent="end"
                                            >
                                                {/* <Button
                    sx={{
                        p: 0,
                        minWidth: "30px",
                    }}
                >
                    <EditIcon
                        sx={{
                            color: customTheme.palette.primary.main,
                        }}
                    />
                </Button> */}
                                                <Button
                                                    onClick={() =>
                                                        handleDeleteUploadLicense(
                                                            item.id
                                                        )
                                                    }
                                                    sx={{
                                                        p: 0,
                                                        minWidth: "30px",
                                                        ml: 2,
                                                        mr: 2,
                                                    }}
                                                >
                                                    <DeleteForeverIcon
                                                        sx={{
                                                            color: customTheme
                                                                .palette.orange
                                                                .main,
                                                        }}
                                                    />
                                                </Button>
                                            </Box>
                                        </TableCell>
                                    </TableRow>
                                ))}
                            </TableBody>
                        </Table>
                    </TableContainer>
                </Box>
            ) : undefined}

            <Box
                display="flex"
                justifyContent="space-between"
                alignItems="center"
                mt="24px"
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
                    <Grid container>
                        <Grid item xs={10.5} sm={11}>
                            <Accordion
                                key={totalID}
                                sx={{
                                    mb: "34px",
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
                                        ".MuiAccordionSummary-contentGutters": {
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
                                            color: customTheme.palette.primary
                                                .main,
                                        }}
                                    />
                                    <Typography
                                        sx={{
                                            color: customTheme.palette.primary
                                                .main,
                                        }}
                                    >
                                        {item.title}
                                    </Typography>
                                </AccordionSummary>

                                <AccordionDetails sx={{ mt: "20px" }}>
                                    <Box
                                        borderRadius="12px"
                                        p="15px"
                                        border="1px solid "
                                        borderColor={
                                            customTheme.palette.primary[20]
                                        }
                                    >
                                        <Box
                                            mb="28px"
                                            borderRadius="12px"
                                            p="10px 16px"
                                            display="flex"
                                            alignItems="center"
                                            bgcolor={
                                                customTheme.palette.orange[10]
                                            }
                                        >
                                            <FastfoodIcon
                                                sx={{
                                                    ml: "20px",
                                                    color: customTheme.palette
                                                        .orange.main,
                                                }}
                                            />
                                            <Typography
                                                sx={{
                                                    ml: "35px",
                                                    color: customTheme.palette
                                                        .primary.main,
                                                }}
                                            >
                                                Meals Options:
                                            </Typography>
                                        </Box>

                                        <FormGroup
                                            row
                                            sx={{
                                                display: "flex",
                                                justifyContent: "center",
                                                px: "30px",
                                                mb: "28px",
                                            }}
                                        >
                                            <Grid
                                                container
                                                spacing="30px"
                                                sx={{
                                                    ".MuiFormControlLabel-root":
                                                        {
                                                            m: 0,
                                                        },
                                                }}
                                            >
                                                <Grid
                                                    item
                                                    md={3}
                                                    sm={4}
                                                    xs={12}
                                                >
                                                    <Box
                                                        pl={2}
                                                        borderRadius="12px"
                                                        bgcolor={
                                                            customTheme.palette
                                                                .inputs
                                                        }
                                                    >
                                                        <FormControlLabel
                                                            sx={{
                                                                width: "100%",
                                                                color: customTheme
                                                                    .palette
                                                                    .gray.main,
                                                            }}
                                                            labelPlacement="start"
                                                            control={
                                                                <Checkbox
                                                                    sx={{
                                                                        ml: "auto",
                                                                    }}
                                                                    name="breakfast"
                                                                    onChange={(
                                                                        e
                                                                    ) =>
                                                                        handleInputChange(
                                                                            e,
                                                                            totalID
                                                                        )
                                                                    }
                                                                />
                                                            }
                                                            label={
                                                                <Box
                                                                    display="flex"
                                                                    alignItems="center"
                                                                >
                                                                    <FastfoodIcon
                                                                        sx={{
                                                                            mr: 1,
                                                                        }}
                                                                        fontSize="small"
                                                                    />
                                                                    <Typography>
                                                                        Breakfast
                                                                    </Typography>
                                                                </Box>
                                                            }
                                                        />
                                                    </Box>
                                                </Grid>
                                                <Grid
                                                    item
                                                    md={3}
                                                    sm={4}
                                                    xs={12}
                                                >
                                                    <Box
                                                        pl={2}
                                                        borderRadius="12px"
                                                        bgcolor={
                                                            customTheme.palette
                                                                .inputs
                                                        }
                                                    >
                                                        <FormControlLabel
                                                            sx={{
                                                                width: "100%",
                                                                color: customTheme
                                                                    .palette
                                                                    .gray.main,
                                                            }}
                                                            labelPlacement="start"
                                                            control={
                                                                <Checkbox
                                                                    sx={{
                                                                        ml: "auto",
                                                                    }}
                                                                    name="lunch"
                                                                    onChange={(
                                                                        e
                                                                    ) =>
                                                                        handleInputChange(
                                                                            e,
                                                                            totalID
                                                                        )
                                                                    }
                                                                />
                                                            }
                                                            label={
                                                                <Box
                                                                    display="flex"
                                                                    alignItems="center"
                                                                >
                                                                    <FastfoodIcon
                                                                        sx={{
                                                                            mr: 1,
                                                                        }}
                                                                        fontSize="small"
                                                                    />
                                                                    <Typography>
                                                                        Lunch
                                                                    </Typography>
                                                                </Box>
                                                            }
                                                        />
                                                    </Box>
                                                </Grid>
                                                <Grid
                                                    item
                                                    md={3}
                                                    sm={4}
                                                    xs={12}
                                                >
                                                    <Box
                                                        pl={2}
                                                        borderRadius="12px"
                                                        bgcolor={
                                                            customTheme.palette
                                                                .inputs
                                                        }
                                                    >
                                                        <FormControlLabel
                                                            sx={{
                                                                width: "100%",
                                                                color: customTheme
                                                                    .palette
                                                                    .gray.main,
                                                            }}
                                                            labelPlacement="start"
                                                            control={
                                                                <Checkbox
                                                                    sx={{
                                                                        ml: "auto",
                                                                    }}
                                                                    name="dinner"
                                                                    onChange={(
                                                                        e
                                                                    ) =>
                                                                        handleInputChange(
                                                                            e,
                                                                            totalID
                                                                        )
                                                                    }
                                                                />
                                                            }
                                                            label={
                                                                <Box
                                                                    display="flex"
                                                                    alignItems="center"
                                                                >
                                                                    <FastfoodIcon
                                                                        sx={{
                                                                            mr: 1,
                                                                        }}
                                                                        fontSize="small"
                                                                    />
                                                                    <Typography>
                                                                        Snack
                                                                    </Typography>
                                                                </Box>
                                                            }
                                                        />
                                                    </Box>
                                                </Grid>
                                                <Grid
                                                    item
                                                    md={3}
                                                    sm={4}
                                                    xs={12}
                                                >
                                                    <Box
                                                        pl={2}
                                                        borderRadius="12px"
                                                        bgcolor={
                                                            customTheme.palette
                                                                .inputs
                                                        }
                                                    >
                                                        <FormControlLabel
                                                            sx={{
                                                                width: "100%",
                                                                color: customTheme
                                                                    .palette
                                                                    .gray.main,
                                                            }}
                                                            labelPlacement="start"
                                                            control={
                                                                <Checkbox
                                                                    sx={{
                                                                        ml: "auto",
                                                                    }}
                                                                    name="snack"
                                                                    onChange={(
                                                                        e
                                                                    ) =>
                                                                        handleInputChange(
                                                                            e,
                                                                            totalID
                                                                        )
                                                                    }
                                                                />
                                                            }
                                                            label={
                                                                <Box
                                                                    display="flex"
                                                                    alignItems="center"
                                                                >
                                                                    <FastfoodIcon
                                                                        sx={{
                                                                            mr: 1,
                                                                        }}
                                                                        fontSize="small"
                                                                    />
                                                                    <Typography>
                                                                        Dinner
                                                                    </Typography>
                                                                </Box>
                                                            }
                                                        />
                                                    </Box>
                                                </Grid>
                                            </Grid>
                                        </FormGroup>
                                    </Box>
                                    <Box
                                        borderRadius="12px"
                                        mt="24px"
                                        p="15px"
                                        border="1px solid "
                                        borderColor={
                                            customTheme.palette.primary[20]
                                        }
                                    >
                                        <Box
                                            borderRadius="12px"
                                            p="10px 16px"
                                            display="flex"
                                            alignItems="center"
                                            bgcolor={
                                                customTheme.palette.orange[10]
                                            }
                                        >
                                            <DomainIcon
                                                sx={{
                                                    ml: "20px",
                                                    color: customTheme.palette
                                                        .orange.main,
                                                }}
                                            />
                                            <Typography
                                                sx={{
                                                    ml: "35px",
                                                    color: customTheme.palette
                                                        .primary.main,
                                                }}
                                            >
                                                Recommendation Options:
                                            </Typography>
                                        </Box>
                                        {/* <Grid
                                        container
                                        spacing="24px"
                                        px="30px"
                                        sx={{
                                            display: "flex",
                                            justifyContent: "center",
                                            alignItems: "center",
                                            
                                        }}
                                    >
                                        <Grid item md={4} sm={12}>
                                            <FormControl fullWidth>
                                                <InputLabel
                                                    size="small"
                                                    id="demo-simple-select-label"
                                                >
                                                    Hotel Grade
                                                </InputLabel>
                                                <Select
                                                    required
                                                    size="small"
                                                    labelId="demo-simple-select-label"
                                                    id="demo-simple-select"
                                                    name="hotelGrade"
                                                    label="Hotel Grade"
                                                    value={
                                                        hotelGradeInAccommodation
                                                    }
                                                    onChange={
                                                        handleHotelGradeInAccommodation
                                                    }
                                                    inputProps={{
                                                        MenuProps: {
                                                            MenuListProps: {
                                                                sx: {
                                                                    backgroundColor:
                                                                        customTheme
                                                                            .palette
                                                                            .inputs,
                                                                },
                                                            },
                                                        },
                                                    }}
                                                    // style={{backgroundColor : "red"}}
                                                >
                                                    <MenuItem
                                                        value={5}
                                                        sx={{
                                                            borderBottom:
                                                                "1px solid",
                                                            borderColor:
                                                                customTheme
                                                                    .palette
                                                                    .primary
                                                                    .main,
                                                        }}
                                                    >
                                                        <Rating
                                                            name="read-only"
                                                            value={5}
                                                            readOnly
                                                        />
                                                    </MenuItem>
                                                    <MenuItem
                                                        value={4}
                                                        sx={{
                                                            borderBottom:
                                                                "1px solid",
                                                            borderColor:
                                                                customTheme
                                                                    .palette
                                                                    .primary
                                                                    .main,
                                                        }}
                                                    >
                                                        <Rating
                                                            name="read-only"
                                                            value={4}
                                                            readOnly
                                                        />
                                                    </MenuItem>
                                                    <MenuItem
                                                        value={3}
                                                        sx={{
                                                            borderBottom:
                                                                "1px solid",
                                                            borderColor:
                                                                customTheme
                                                                    .palette
                                                                    .primary
                                                                    .main,
                                                        }}
                                                    >
                                                        <Rating
                                                            name="read-only"
                                                            value={3}
                                                            readOnly
                                                        />
                                                    </MenuItem>
                                                    <MenuItem
                                                        value={2}
                                                        sx={{
                                                            borderBottom:
                                                                "1px solid",
                                                            borderColor:
                                                                customTheme
                                                                    .palette
                                                                    .primary
                                                                    .main,
                                                        }}
                                                    >
                                                        <Rating
                                                            name="read-only"
                                                            value={2}
                                                            readOnly
                                                        />
                                                    </MenuItem>
                                                    <MenuItem
                                                        value={1}
                                                        sx={{
                                                            borderBottom:
                                                                "1px solid",
                                                            borderColor:
                                                                customTheme
                                                                    .palette
                                                                    .primary
                                                                    .main,
                                                        }}
                                                    >
                                                        <Rating
                                                            name="read-only"
                                                            value={1}
                                                            readOnly
                                                        />
                                                    </MenuItem>
                                                    <MenuItem
                                                        value="ecolodge"
                                                        sx={{
                                                            borderBottom:
                                                                "1px solid",
                                                            borderColor:
                                                                customTheme
                                                                    .palette
                                                                    .primary
                                                                    .main,
                                                        }}
                                                    >
                                                        <Typography>
                                                            Ecolodge
                                                        </Typography>
                                                    </MenuItem>
                                                    <MenuItem
                                                        value="motel"
                                                        sx={{
                                                            bgcolor:
                                                                customTheme
                                                                    .palette
                                                                    .inputs,
                                                        }}
                                                    >
                                                        <Typography>
                                                            Motel
                                                        </Typography>
                                                    </MenuItem>
                                                </Select>
                                            </FormControl>
                                        </Grid>
                                        <Grid item md={4} sm={12}>
                                            <Autocomplete
                                                size="small"
                                                disablePortal
                                                options={city}
                                                sx={{ width: "100%" }}
                                                onChange={(event, newValue) =>
                                                    handleAutocomplete(
                                                        event,
                                                        newValue
                                                    )
                                                }
                                                renderInput={(params) => (
                                                    <TextField
                                                        required
                                                        {...params}
                                                        label="City"
                                                    />
                                                )}
                                                // renderOption={(props, option) => {
                                                //     const { label } = option;

                                                //     return (
                                                //       <span
                                                //         {...props}
                                                //         style={{ backgroundColor: customTheme.palette.inputs }}
                                                //       >
                                                //         {label}
                                                //       </span>
                                                //     );
                                                //   }}
                                            />
                                        </Grid>
                                        <Grid item md={4} sm={12} sx={{textAlign : "center"}}>
                                            <Button
                                                size="small"
                                                variant="contained"
                                                onClick={() =>
                                                    handleAccommodation(totalID)
                                                }
                                                sx={{
                                                    bgcolor:
                                                        customTheme.palette
                                                            .orange.main,
                                                    color: customTheme.palette
                                                        .white,

                                                    width: "119px",
                                                    height: "36px",
                                                    p: "5px 24px",
                                                }}
                                            >
                                                <Typography>Add</Typography>
                                            </Button>
                                        </Grid>
                                    </Grid> */}
                                        <Box
                                            display="flex"
                                            my="28px"
                                            mx="36px"
                                            alignItems="center"
                                        >
                                            <Typography sx={{ mr: 3 }}>
                                                Shared accommodation provided
                                            </Typography>

                                            <FormControlLabel
                                                control={
                                                    <IOSSwitch
                                                        sx={{ m: 1 }}
                                                        defaultChecked
                                                        checked={
                                                            switchRecommendationOptions
                                                        }
                                                        onChange={
                                                            handleSwitchRecommendationOptions
                                                        }
                                                    />
                                                }
                                            />
                                        </Box>
                                        {switchRecommendationOptions ? (
                                            <>
                                                <Box>
                                                    <Typography
                                                        sx={{ ml: "36px" }}
                                                    >
                                                        Gallery
                                                    </Typography>
                                                    <ImageList
                                                        sx={{
                                                            width: "100%",
                                                            px: "15px",
                                                            overflowX: "auto",
                                                        }}
                                                        cols={
                                                            uploadImage.length +
                                                            6
                                                        }
                                                    >
                                                        <ImageListItem>
                                                            <Button
                                                                sx={{
                                                                    height: "200px",
                                                                    width: "200px",
                                                                    bgcolor:
                                                                        customTheme
                                                                            .palette
                                                                            .inputs,
                                                                    borderRadius:
                                                                        "16px",
                                                                    display:
                                                                        "flex",
                                                                    justifyContent:
                                                                        "center",
                                                                    alignItems:
                                                                        "center",
                                                                }}
                                                            >
                                                                <Dropzone
                                                                    key={
                                                                        dropzoneKey
                                                                    }
                                                                    /// getUploadParams={
                                                                    //     getUploadParams
                                                                    // }
                                                                    onChangeStatus={
                                                                        handleChangeStatus
                                                                    }
                                                                    canRemove={
                                                                        false
                                                                    }
                                                                    inputContent={
                                                                        <AddIcon
                                                                            sx={{
                                                                                width: "50px",
                                                                                height: "50px",
                                                                                color: "#5B5B5B",
                                                                            }}
                                                                        />
                                                                    }
                                                                    PreviewComponent={
                                                                        Preview
                                                                    }
                                                                    styles={{
                                                                        dropzone:
                                                                            {
                                                                                overflow:
                                                                                    "hidden",
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
                                                        {uploadImage.map(
                                                            (item, index) => (
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
                                                            )
                                                        )}
                                                    </ImageList>
                                                </Box>
                                                <Box
                                                    textAlign="center"
                                                    my="28px"
                                                >
                                                    <TextField
                                                        multiline
                                                        rows={3}
                                                        label="Extra Items"
                                                        variant="outlined"
                                                        sx={{ width: "100%" }}
                                                    />
                                                </Box>
                                            </>
                                        ) : (
                                            <>
                                                <Box width="80%" mx="auto">
                                                    <Grid
                                                        container
                                                        spacing={3}
                                                        textAlign="center"
                                                    >
                                                        <Grid
                                                            item
                                                            xs={12}
                                                            sm={9}
                                                        >
                                                            <TextField
                                                                sx={{
                                                                    width: "100%",
                                                                }}
                                                                size="small"
                                                                label="Hotel Name"
                                                                name="hotelGrade"
                                                                value={
                                                                    hotelGradeInAccommodation
                                                                }
                                                                onChange={
                                                                    handleHotelGradeInAccommodation
                                                                }
                                                            />
                                                        </Grid>
                                                        <Grid
                                                            item
                                                            xs={12}
                                                            sm={3}
                                                        >
                                                            <Button
                                                                size="small"
                                                                variant="contained"
                                                                // onClick={() =>
                                                                //     handleEducational(
                                                                //         totalID
                                                                //     )
                                                                // }
                                                                sx={{
                                                                    bgcolor:
                                                                        customTheme
                                                                            .palette
                                                                            .orange
                                                                            .main,
                                                                    color: customTheme
                                                                        .palette
                                                                        .white,
                                                                    width: "119px",
                                                                    height: "36px",
                                                                    p: "5px 24px",
                                                                }}
                                                                onClick={() =>
                                                                    handleAccommodation(
                                                                        totalID
                                                                    )
                                                                }
                                                            >
                                                                <Typography>
                                                                    Add
                                                                </Typography>
                                                            </Button>
                                                        </Grid>
                                                    </Grid>
                                                </Box>
                                                <Box
                                                    sx={{
                                                        width: "100%",
                                                        display: "flex",
                                                        justifyContent:
                                                            "center",
                                                    }}
                                                >
                                                    <TableContainer
                                                        component={Paper}
                                                        sx={{
                                                            mt: "28px",
                                                            width: "500px",
                                                            borderRadius:
                                                                "16px",
                                                        }}
                                                    >
                                                        <Table aria-label="customized table">
                                                            <TableHead
                                                                sx={{
                                                                    bgcolor:
                                                                        customTheme
                                                                            .palette
                                                                            .gray[40],
                                                                }}
                                                            >
                                                                <TableRow>
                                                                    <TableCell
                                                                        align="left"
                                                                        sx={{
                                                                            color: customTheme
                                                                                .palette
                                                                                .white,
                                                                        }}
                                                                    >
                                                                        <Typography>
                                                                            Hotel
                                                                        </Typography>
                                                                    </TableCell>

                                                                    <TableCell
                                                                        align="right"
                                                                        sx={{
                                                                            color: customTheme
                                                                                .palette
                                                                                .white,
                                                                        }}
                                                                    >
                                                                        <Typography>
                                                                            Remove
                                                                        </Typography>
                                                                    </TableCell>
                                                                </TableRow>
                                                            </TableHead>
                                                            <TableBody>
                                                                {itIneraries.map(
                                                                    (item) =>
                                                                        item.id ===
                                                                        totalID
                                                                            ? item.accommodation.map(
                                                                                  (
                                                                                      row
                                                                                  ) => (
                                                                                      <TableRow
                                                                                          key={
                                                                                              row.totalId
                                                                                          }
                                                                                          sx={{
                                                                                              "&:nth-of-type(odd)":
                                                                                                  {
                                                                                                      backgroundColor:
                                                                                                          customTheme
                                                                                                              .palette
                                                                                                              .input,
                                                                                                  },
                                                                                              "&:nth-of-type(even)":
                                                                                                  {
                                                                                                      backgroundColor:
                                                                                                          customTheme
                                                                                                              .palette
                                                                                                              .chat,
                                                                                                  },
                                                                                          }}
                                                                                      >
                                                                                          <TableCell
                                                                                              align="left"
                                                                                              component="th"
                                                                                              scope="row"
                                                                                          >
                                                                                              <Typography>
                                                                                                  {
                                                                                                      row.hotelGrade
                                                                                                  }
                                                                                              </Typography>
                                                                                          </TableCell>
                                                                                          {/* <TableCell align="center">
                                                                             <Typography
                                                                                 sx={{
                                                                                     color: customTheme
                                                                                         .palette
                                                                                         .gray
                                                                                         .main,
                                                                                 }}
                                                                             >
                                                                                 {
                                                                                     row.city
                                                                                 }
                                                                             </Typography>
                                                                         </TableCell> */}
                                                                                          <TableCell align="right">
                                                                                              <Box
                                                                                                  display="flex"
                                                                                                  justifyContent="end"
                                                                                              >
                                                                                                  <Button
                                                                                                      onClick={() =>
                                                                                                          handleDeleteAccommodation(
                                                                                                              totalID,
                                                                                                              row.id
                                                                                                          )
                                                                                                      }
                                                                                                      sx={{
                                                                                                          p: 0,
                                                                                                          minWidth:
                                                                                                              "30px",
                                                                                                          ml: 2,
                                                                                                          mr: 2,
                                                                                                      }}
                                                                                                  >
                                                                                                      <DeleteForeverIcon
                                                                                                          sx={{
                                                                                                              color: customTheme
                                                                                                                  .palette
                                                                                                                  .orange
                                                                                                                  .main,
                                                                                                          }}
                                                                                                      />
                                                                                                  </Button>
                                                                                              </Box>
                                                                                          </TableCell>
                                                                                      </TableRow>
                                                                                  )
                                                                              )
                                                                            : null
                                                                )}
                                                            </TableBody>
                                                        </Table>
                                                    </TableContainer>
                                                </Box>
                                            </>
                                        )}
                                    </Box>
                                    <Box
                                        borderRadius="12px"
                                        mt="24px"
                                        p="15px"
                                        border="1px solid "
                                        borderColor={
                                            customTheme.palette.primary[20]
                                        }
                                    >
                                        <Box
                                            mb="28px"
                                            borderRadius="12px"
                                            p="10px 16px"
                                            display="flex"
                                            alignItems="center"
                                            bgcolor={
                                                customTheme.palette.orange[10]
                                            }
                                        >
                                            <RoomIcon
                                                sx={{
                                                    ml: "20px",
                                                    color: customTheme.palette
                                                        .orange.main,
                                                }}
                                            />
                                            <Typography
                                                sx={{
                                                    ml: "35px",
                                                    color: customTheme.palette
                                                        .primary.main,
                                                }}
                                            >
                                                Transportation
                                            </Typography>
                                        </Box>

                                        <FormGroup
                                            row
                                            sx={{
                                                display: "flex",
                                                justifyContent: "center",
                                                px: "30px",
                                                mb: "28px",
                                            }}
                                        >
                                            <Grid
                                                container
                                                spacing="30px"
                                                textAlign="center"
                                            >
                                                <Grid
                                                    item
                                                    xs={12}
                                                    md={4}
                                                    sm={12}
                                                >
                                                    <TextField
                                                        name="form"
                                                        value={item.form}
                                                        onChange={(e) =>
                                                            handleInputChange(
                                                                e,
                                                                totalID
                                                            )
                                                        }
                                                        sx={{ width: "100%" }}
                                                        size="small"
                                                        label={
                                                            <Box
                                                                display="flex"
                                                                justifyContent="center"
                                                            >
                                                                <RoomIcon />
                                                                <Typography>
                                                                    Form
                                                                </Typography>
                                                            </Box>
                                                        }
                                                    />
                                                </Grid>
                                                <Grid
                                                    item
                                                    xs={12}
                                                    md={4}
                                                    sm={12}
                                                >
                                                    <TextField
                                                        name="to"
                                                        value={item.to}
                                                        onChange={(e) =>
                                                            handleInputChange(
                                                                e,
                                                                totalID
                                                            )
                                                        }
                                                        sx={{ width: "100%" }}
                                                        size="small"
                                                        label={
                                                            <Box
                                                                display="flex"
                                                                justifyContent="center"
                                                            >
                                                                <RoomIcon />
                                                                <Typography>
                                                                    To
                                                                </Typography>
                                                            </Box>
                                                        }
                                                    />
                                                </Grid>
                                                <Grid
                                                    item
                                                    xs={12}
                                                    md={4}
                                                    sm={12}
                                                >
                                                    <TextField
                                                        name="by"
                                                        value={item.by}
                                                        onChange={(e) =>
                                                            handleInputChange(
                                                                e,
                                                                totalID
                                                            )
                                                        }
                                                        sx={{ width: "100%" }}
                                                        size="small"
                                                        label={
                                                            <Box
                                                                display="flex"
                                                                justifyContent="center"
                                                            >
                                                                <DirectionsBusFilledIcon />
                                                                <Typography>
                                                                    By
                                                                </Typography>
                                                            </Box>
                                                        }
                                                    />
                                                </Grid>
                                            </Grid>
                                        </FormGroup>
                                    </Box>
                                    <Box
                                        borderRadius="12px"
                                        mt="24px"
                                        p="15px"
                                        border="1px solid "
                                        borderColor={
                                            customTheme.palette.primary[20]
                                        }
                                    >
                                        <Box
                                            mb="28px"
                                            borderRadius="12px"
                                            p="10px 16px"
                                            display="flex"
                                            alignItems="center"
                                            bgcolor={
                                                customTheme.palette.orange[10]
                                            }
                                        >
                                            <RoomIcon
                                                sx={{
                                                    ml: "20px",
                                                    color: customTheme.palette
                                                        .orange.main,
                                                }}
                                            />
                                            <Typography
                                                sx={{
                                                    ml: "35px",
                                                    color: customTheme.palette
                                                        .primary.main,
                                                }}
                                            >
                                                Educational References
                                            </Typography>
                                        </Box>

                                        <FormGroup
                                            row
                                            sx={{
                                                display: "flex",
                                                justifyContent: "center",
                                                px: "30px",
                                                mb: "28px",
                                            }}
                                        >
                                            <Grid
                                                container
                                                spacing="30px"
                                                textAlign="center"
                                            >
                                                <Grid
                                                    item
                                                    xs={12}
                                                    lg={5}
                                                    md={5}
                                                    sm={12}
                                                >
                                                    <TextField
                                                        name="documentName"
                                                        value={documentName}
                                                        onChange={
                                                            handleDocumentName
                                                        }
                                                        sx={{ width: "100%" }}
                                                        size="small"
                                                        label="Document Name"
                                                    />
                                                </Grid>
                                                <Grid
                                                    item
                                                    xs={12}
                                                    lg={5}
                                                    md={5}
                                                    sm={12}
                                                >
                                                    <Button
                                                        size="small"
                                                        variant="contained"
                                                        component="label"
                                                        sx={{
                                                            bgcolor: "#EAEEF3",
                                                            boxShadow: "none",
                                                            borderRadius:
                                                                "12px",
                                                            width: "100%",
                                                            m: 0,
                                                            display: "flex",
                                                            justifyContent:
                                                                "space-between",
                                                            "&.MuiButtonBase-root:hover":
                                                                {
                                                                    bgcolor:
                                                                        "#EAEEF3",
                                                                    boxShadow:
                                                                        "none",
                                                                },
                                                        }}
                                                    >
                                                        <Box
                                                            display="flex"
                                                            justifyContent="center"
                                                        >
                                                            <DescriptionIcon
                                                                sx={{
                                                                    color: "#8D949B",
                                                                }}
                                                            />
                                                            <Box>
                                                                <Typography
                                                                    sx={{
                                                                        color: "#8D949B",
                                                                        overflow:
                                                                            "hidden",
                                                                        whiteSpace:
                                                                            "nowrap",
                                                                        maxWidth:
                                                                            screen.width <=
                                                                            425
                                                                                ? "150px"
                                                                                : "250px",
                                                                    }}
                                                                >
                                                                    {fileEducational
                                                                        ? fileEducational.name
                                                                        : ""}
                                                                </Typography>
                                                            </Box>
                                                        </Box>
                                                        <input
                                                            name="file"
                                                            onChange={
                                                                handleFileEducational
                                                            }
                                                            required
                                                            type="file"
                                                            hidden
                                                        />
                                                        <Button
                                                            onClick={
                                                                handleRemoveFile
                                                            }
                                                            sx={{
                                                                m: 0,
                                                                mr: "1px",
                                                                px: 0,
                                                            }}
                                                        >
                                                            <HighlightOffIcon
                                                                sx={{
                                                                    color: customTheme
                                                                        .palette
                                                                        .orange
                                                                        .main,
                                                                }}
                                                            />
                                                        </Button>
                                                    </Button>
                                                    {/* <TextField
                                                    required
                                                    
                                                    type="file"
                                                    
                                                    size="small"
                                                    label={
                                                        <Box
                                                            display="flex"
                                                            justifyContent="center"
                                                        >
                                                            <DescriptionIcon />
                                                            <Typography>
                                                                Upload File
                                                            </Typography>
                                                        </Box>
                                                    }
                                                /> */}
                                                </Grid>
                                                <Grid
                                                    item
                                                    xs={12}
                                                    lg={2}
                                                    md={2}
                                                    sm={12}
                                                >
                                                    <Button
                                                        size="small"
                                                        variant="contained"
                                                        onClick={() =>
                                                            handleEducational(
                                                                totalID
                                                            )
                                                        }
                                                        sx={{
                                                            bgcolor:
                                                                customTheme
                                                                    .palette
                                                                    .orange
                                                                    .main,
                                                            color: customTheme
                                                                .palette.white,
                                                            width: "119px",
                                                            height: "36px",
                                                            p: "5px 24px",
                                                        }}
                                                    >
                                                        <Typography>
                                                            Add
                                                        </Typography>
                                                    </Button>
                                                </Grid>
                                                <Grid item xs={12}>
                                                    <Box
                                                        sx={{
                                                            width: "100%",
                                                            display: "flex",
                                                            justifyContent:
                                                                "center",
                                                        }}
                                                    >
                                                        <TableContainer
                                                            component={Paper}
                                                            sx={{
                                                                mt: "28px",
                                                                width: "500px",
                                                                borderRadius:
                                                                    "16px",
                                                            }}
                                                        >
                                                            <Table aria-label="customized table">
                                                                <TableHead
                                                                    sx={{
                                                                        bgcolor:
                                                                            customTheme
                                                                                .palette
                                                                                .gray[40],
                                                                    }}
                                                                >
                                                                    <TableRow>
                                                                        <TableCell
                                                                            align="left"
                                                                            sx={{
                                                                                color: customTheme
                                                                                    .palette
                                                                                    .white,
                                                                            }}
                                                                        >
                                                                            <Typography>
                                                                                Type
                                                                            </Typography>
                                                                        </TableCell>
                                                                        <TableCell
                                                                            align="center"
                                                                            sx={{
                                                                                color: customTheme
                                                                                    .palette
                                                                                    .white,
                                                                            }}
                                                                        >
                                                                            <Typography>
                                                                                Document
                                                                                Name
                                                                            </Typography>
                                                                        </TableCell>
                                                                        <TableCell
                                                                            align="right"
                                                                            sx={{
                                                                                color: customTheme
                                                                                    .palette
                                                                                    .white,
                                                                            }}
                                                                        >
                                                                            <Typography>
                                                                                Remove
                                                                            </Typography>
                                                                        </TableCell>
                                                                    </TableRow>
                                                                </TableHead>
                                                                <TableBody>
                                                                    {itIneraries.map(
                                                                        (
                                                                            item
                                                                        ) =>
                                                                            item.id ===
                                                                            totalID
                                                                                ? item.educational.map(
                                                                                      (
                                                                                          row
                                                                                      ) => (
                                                                                          <TableRow
                                                                                              key={
                                                                                                  row.id
                                                                                              }
                                                                                              sx={{
                                                                                                  "&:nth-of-type(odd)":
                                                                                                      {
                                                                                                          backgroundColor:
                                                                                                              customTheme
                                                                                                                  .palette
                                                                                                                  .input,
                                                                                                      },
                                                                                                  "&:nth-of-type(even)":
                                                                                                      {
                                                                                                          backgroundColor:
                                                                                                              customTheme
                                                                                                                  .palette
                                                                                                                  .chat,
                                                                                                      },
                                                                                              }}
                                                                                          >
                                                                                              <TableCell
                                                                                                  align="left"
                                                                                                  component="th"
                                                                                                  scope="row"
                                                                                              >
                                                                                                  <Typography>
                                                                                                      Pdf
                                                                                                  </Typography>
                                                                                              </TableCell>
                                                                                              <TableCell align="center">
                                                                                                  <Typography
                                                                                                      sx={{
                                                                                                          color: customTheme
                                                                                                              .palette
                                                                                                              .gray
                                                                                                              .main,
                                                                                                      }}
                                                                                                  >
                                                                                                      {
                                                                                                          row.documentname
                                                                                                      }
                                                                                                  </Typography>
                                                                                              </TableCell>
                                                                                              <TableCell align="right">
                                                                                                  <Box
                                                                                                      display="flex"
                                                                                                      justifyContent="end"
                                                                                                  >
                                                                                                      <Button
                                                                                                          onClick={() =>
                                                                                                              handleDeleteEducational(
                                                                                                                  totalID,
                                                                                                                  row.id
                                                                                                              )
                                                                                                          }
                                                                                                          sx={{
                                                                                                              p: 0,
                                                                                                              minWidth:
                                                                                                                  "30px",
                                                                                                              ml: 2,
                                                                                                              mr: 2,
                                                                                                          }}
                                                                                                      >
                                                                                                          <DeleteForeverIcon
                                                                                                              sx={{
                                                                                                                  color: customTheme
                                                                                                                      .palette
                                                                                                                      .orange
                                                                                                                      .main,
                                                                                                              }}
                                                                                                          />
                                                                                                      </Button>
                                                                                                  </Box>
                                                                                              </TableCell>
                                                                                          </TableRow>
                                                                                      )
                                                                                  )
                                                                                : null
                                                                    )}
                                                                </TableBody>
                                                            </Table>
                                                        </TableContainer>
                                                    </Box>
                                                </Grid>
                                            </Grid>
                                        </FormGroup>
                                    </Box>
                                </AccordionDetails>
                            </Accordion>
                        </Grid>
                        <Grid item xs={1.5} sm={1}>
                            <Button
                                onClick={() => handleRemoveItIneraries(totalID)}
                                sx={{
                                    mt: "12px",
                                    p: 0,
                                }}
                            >
                                <RemoveCircleIcon
                                    sx={{
                                        color: customTheme.palette.orange.main,
                                    }}
                                />
                            </Button>
                        </Grid>
                    </Grid>
                );
            })}
            <Typography
                sx={{
                    borderLeft: "3px solid black",
                    pl: "12px",

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
                    value={selectedValue}
                    onChange={handleRadioChange}
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
                        width={window.screen.width < 720 ? "100%" : "50%"}
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
                        width={window.screen.width < 720 ? "100%" : "50%"}
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
                                        color: customTheme.palette.gray.main,
                                        ml: "39px",
                                    }}
                                >
                                    Min Score:
                                </Typography>
                                <TextField
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
                        width={window.screen.width < 720 ? "100%" : "50%"}
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
                                        color: customTheme.palette.gray.main,
                                        ml: "39px",
                                    }}
                                >
                                    Min Score:
                                </Typography>
                                <TextField
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
                        mb="29px"
                        pl="10px"
                        borderRadius={1}
                        width={window.screen.width < 720 ? "100%" : "50%"}
                        sx={{ transition: "all 1s" }}
                    >
                        <FormControlLabel
                            sx={{
                                borderRadius: 1,
                                py: 1,
                            }}
                            value="project"
                            control={<Radio />}
                            label="Project"
                        />
                        {isTextFieldDisabled2 === false ? (
                            <Box
                                display="flex"
                                textAlign="center"
                                alignItems="center"
                            >
                                <Typography
                                    sx={{
                                        color: customTheme.palette.gray.main,
                                        ml: "39px",
                                    }}
                                >
                                    Min Score:
                                </Typography>
                                <TextField
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
                </RadioGroup>
            </Box>

            <Box display="flex" justifyContent="center">
                <Divider
                    sx={{
                        mb: "48px",
                        borderBottom: 4,
                        width: "85%",
                        color: customTheme.palette.primary.main,
                    }}
                />
            </Box>
            <Grid
                spacing={4}
                container
                sx={{
                    mb: "100px",
                    display: "flex",
                    justifyContent: "center",
                    alignContent: "center",
                }}
            >
                <Grid item>
                    <Button
                        sx={{
                            width: "188px",
                            height: "36px",
                            borderRadius: "25px",
                            color: customTheme.palette.orange.main,
                            borderColor: customTheme.palette.orange.main,
                        }}
                        variant="outlined"
                    >
                        <Typography>Save Draft</Typography>
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
                        <Typography>Save</Typography>
                    </Button>
                </Grid>
            </Grid>

            <Dialog
                open={openAco}
                onClose={handleCloseeAco}
                fullWidth
                maxWidth="lg"
            >
                <DialogContent>
                    <Container>
                        <Box
                            display="flex"
                            justifyContent="space-between"
                            alignItems="center"
                            mt="24px"
                            mb={3}
                        >
                            <Typography
                                sx={{
                                    borderLeft: "3px solid black",
                                    pl: "12px",

                                    color: customTheme.palette.primary.main,
                                    borderColor:
                                        customTheme.palette.primary.main,
                                }}
                            >
                                New Exam
                            </Typography>
                            <Button
                                size="small"
                                onClick={handleAddItInerariesAco}
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
                        <TextField
                            name="answer1"
                            value={examTitle}
                            onChange={handleExamTitle}
                            sx={{
                                width:
                                    window.screen.width <= 425 ? "100%" : "50%",
                                mb: "24px",
                            }}
                            size="small"
                            label="Exam Title"
                        />
                        {itInerariesAco.map((item) => {
                            return (
                                <Grid container>
                                    <Grid item xs={10.5} sm={11}>
                                        <Accordion
                                            // key={index}
                                            sx={{
                                                borderRadius: "8px",
                                                mb: "30px",
                                                boxShadow: 0,
                                                position: "unset",
                                                ".MuiAccordionSummary-root": {
                                                    borderRadius: "8px",
                                                },
                                                width: "100%",
                                            }}
                                        >
                                            <AccordionSummary
                                                expandIcon={<ExpandMoreIcon />}
                                                // aria-controls={`Mohsen${item.id}`}
                                                // id={item.id}
                                                sx={{
                                                    bgcolor:
                                                        customTheme.palette
                                                            .primary[20],
                                                    ".MuiAccordionSummary-contentGutters":
                                                        {
                                                            margin: 0,
                                                        },
                                                }}
                                            >
                                                <Box
                                                    display="flex"
                                                    alignItems="center"
                                                >
                                                    <QuizIcon
                                                        sx={{
                                                            mr: 1,
                                                            color: customTheme
                                                                .palette.primary
                                                                .main,
                                                        }}
                                                    />
                                                    <Typography
                                                        sx={{
                                                            color: customTheme
                                                                .palette.primary
                                                                .main,
                                                        }}
                                                    >
                                                        {item.title}
                                                    </Typography>
                                                </Box>
                                            </AccordionSummary>
                                            <AccordionDetails
                                                sx={{ mt: "20px" }}
                                            >
                                                <Grid container spacing="24px">
                                                    <Grid item xs={12}>
                                                        <Box
                                                            display={
                                                                screen.width <=
                                                                425
                                                                    ? "block"
                                                                    : "flex"
                                                            }
                                                            alignItems="center"
                                                        >
                                                            <Typography>
                                                                Question Type:
                                                            </Typography>
                                                            <RadioGroup
                                                                name="questionType"
                                                                onChange={(e) =>
                                                                    handleInputChangeAco(
                                                                        e,
                                                                        item.id
                                                                    )
                                                                }
                                                                defaultValue="test"
                                                                row
                                                                sx={{
                                                                    ml: "20px",
                                                                    pt: 0,
                                                                }}
                                                            >
                                                                <FormControlLabel
                                                                    value="test"
                                                                    control={
                                                                        <Radio />
                                                                    }
                                                                    label="Test"
                                                                    labelPlacement="start"
                                                                />
                                                                <FormControlLabel
                                                                    value="explanation "
                                                                    control={
                                                                        <Radio />
                                                                    }
                                                                    label="Explanation "
                                                                    labelPlacement="start"
                                                                    sx={{
                                                                        ml: "20px",
                                                                    }}
                                                                />
                                                            </RadioGroup>
                                                        </Box>
                                                    </Grid>
                                                    <Grid item xs={12}>
                                                        <TextField
                                                            name="question"
                                                            onChange={(e) =>
                                                                handleInputChangeAco(
                                                                    e,
                                                                    item.id
                                                                )
                                                            }
                                                            multiline
                                                            rows={3}
                                                            label="Question"
                                                            variant="outlined"
                                                            sx={{
                                                                width: "100%",
                                                            }}
                                                        />
                                                    </Grid>
                                                    {item.questionType ===
                                                    "test" ? (
                                                        <>
                                                            <Grid item xs={12}>
                                                                <Grid
                                                                    container
                                                                    spacing={2}
                                                                >
                                                                    <Grid
                                                                        item
                                                                        xs={12}
                                                                        sm={3}
                                                                    >
                                                                        <TextField
                                                                            name="answer1"
                                                                            onChange={(
                                                                                e
                                                                            ) =>
                                                                                handleInputChangeAco(
                                                                                    e,
                                                                                    item.id
                                                                                )
                                                                            }
                                                                            sx={{
                                                                                width: "100%",
                                                                            }}
                                                                            size="small"
                                                                            label="1 answer"
                                                                        />
                                                                    </Grid>
                                                                    <Grid
                                                                        item
                                                                        xs={12}
                                                                        sm={3}
                                                                    >
                                                                        <TextField
                                                                            name="answer2"
                                                                            onChange={(
                                                                                e
                                                                            ) =>
                                                                                handleInputChangeAco(
                                                                                    e,
                                                                                    item.id
                                                                                )
                                                                            }
                                                                            sx={{
                                                                                width: "100%",
                                                                            }}
                                                                            size="small"
                                                                            label="2 answer"
                                                                        />
                                                                    </Grid>
                                                                    <Grid
                                                                        item
                                                                        xs={12}
                                                                        sm={3}
                                                                    >
                                                                        <TextField
                                                                            name="answer3"
                                                                            onChange={(
                                                                                e
                                                                            ) =>
                                                                                handleInputChangeAco(
                                                                                    e,
                                                                                    item.id
                                                                                )
                                                                            }
                                                                            sx={{
                                                                                width: "100%",
                                                                            }}
                                                                            size="small"
                                                                            label="3 answer"
                                                                        />
                                                                    </Grid>
                                                                    <Grid
                                                                        item
                                                                        xs={12}
                                                                        sm={3}
                                                                    >
                                                                        <TextField
                                                                            name="answer4"
                                                                            onChange={(
                                                                                e
                                                                            ) =>
                                                                                handleInputChangeAco(
                                                                                    e,
                                                                                    item.id
                                                                                )
                                                                            }
                                                                            sx={{
                                                                                width: "100%",
                                                                            }}
                                                                            size="small"
                                                                            label="4 answer"
                                                                        />
                                                                    </Grid>
                                                                </Grid>
                                                            </Grid>
                                                            <Grid item xs={12}>
                                                                <Grid
                                                                    container
                                                                    alignItems="center"
                                                                >
                                                                    <Grid
                                                                        item
                                                                        xs={12}
                                                                        md={2}
                                                                    >
                                                                        <Typography>
                                                                            Correct
                                                                            Answer:
                                                                        </Typography>
                                                                    </Grid>
                                                                    <Grid
                                                                        item
                                                                        xs={12}
                                                                        md={3}
                                                                    >
                                                                        <FormControl
                                                                            size="small"
                                                                            sx={{
                                                                                width: "100%",
                                                                            }}
                                                                        >
                                                                            <InputLabel id="answer">
                                                                                Answer
                                                                            </InputLabel>
                                                                            <Select
                                                                                labelId="answer"
                                                                                id="demo-simple-select"
                                                                                value={
                                                                                    item.correctAnswer
                                                                                }
                                                                                label="Answer"
                                                                                onChange={(
                                                                                    e
                                                                                ) =>
                                                                                    handleChangeAnswer(
                                                                                        e,
                                                                                        item.id
                                                                                    )
                                                                                }
                                                                            >
                                                                                <MenuItem
                                                                                    value={
                                                                                        1
                                                                                    }
                                                                                >
                                                                                    1
                                                                                </MenuItem>
                                                                                <MenuItem
                                                                                    value={
                                                                                        2
                                                                                    }
                                                                                >
                                                                                    2
                                                                                </MenuItem>
                                                                                <MenuItem
                                                                                    value={
                                                                                        3
                                                                                    }
                                                                                >
                                                                                    3
                                                                                </MenuItem>
                                                                                <MenuItem
                                                                                    value={
                                                                                        4
                                                                                    }
                                                                                >
                                                                                    4
                                                                                </MenuItem>
                                                                            </Select>
                                                                        </FormControl>
                                                                    </Grid>
                                                                </Grid>
                                                            </Grid>
                                                        </>
                                                    ) : null}
                                                </Grid>
                                            </AccordionDetails>
                                        </Accordion>
                                    </Grid>
                                    <Grid item xs={1.5} sm={1}>
                                        <Button
                                            onClick={() =>
                                                handleRemoveItInerariesAco(
                                                    item.id
                                                )
                                            }
                                            sx={{
                                                mt: "12px",
                                                p: 0,
                                            }}
                                        >
                                            <RemoveCircleIcon
                                                sx={{
                                                    color: customTheme.palette
                                                        .orange.main,
                                                }}
                                            />
                                        </Button>
                                    </Grid>
                                </Grid>
                            );
                        })}
                    </Container>
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
                                onClick={handleCloseeAco}
                                sx={{
                                    width: "150px",
                                    height: "36px",

                                    color: customTheme.palette.orange.main,
                                    borderColor:
                                        customTheme.palette.orange.main,
                                }}
                                variant="outlined"
                            >
                                <Typography>Cancel</Typography>
                            </Button>
                        </Grid>
                        <Grid item>
                            <Button
                                onClick={handleAuditionList}
                                sx={{
                                    width: "150px",
                                    height: "36px",

                                    color: "customTheme.palette.white",
                                    bgcolor: customTheme.palette.primary.main,
                                }}
                                variant="contained"
                            >
                                <Typography>confirm</Typography>
                            </Button>
                        </Grid>
                    </Grid>
                </DialogContent>
            </Dialog>
        </Container>
    );
};

export default AddNewGroup;
