import * as React from "react";
// import SwipeableViews from "react-swipeable-views";
import { styled, useTheme, Theme, CSSObject } from "@mui/material/styles";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import Divider from "@mui/material/Divider";
import IconButton from "@mui/material/IconButton";
import ListItem from "@mui/material/ListItem";
import ListItemText from "@mui/material/ListItemText";
import {
    Tooltip,
    Button,
    Badge,
    Avatar,
    Menu,
    MenuItem,
    FormControl,
    Select,
    Link,
    TextField,
    Container,
    BottomNavigation,
    BottomNavigationAction,
    ThemeProvider,
    Tab,
    Tabs,
    BadgeProps,
    ListItemAvatar,
    InputBase,
    Stack,
    Grid,
    Paper, Snackbar, Alert,
} from "@mui/material";
import SearchIcon from "@mui/icons-material/Search";
import SettingsIcon from "@mui/icons-material/Settings";
import ArrowCircleLeftOutlinedIcon from "@mui/icons-material/ArrowCircleLeftOutlined";
import MoreVertOutlinedIcon from "@mui/icons-material/MoreVertOutlined";
import SendIcon from "@mui/icons-material/Send";
import AttachFileIcon from "@mui/icons-material/AttachFile";
import SentimentSatisfiedOutlinedIcon from "@mui/icons-material/SentimentSatisfiedOutlined";
import CheckOutlinedIcon from "@mui/icons-material/CheckOutlined";
import DoneAllOutlinedIcon from "@mui/icons-material/DoneAllOutlined";

import EmojiPicker, {EmojiClickData} from "emoji-picker-react";
import {useEffect, useState} from "react";
import {useMutation} from "react-query";
import axios from "./../../../../axiosConfig";
import {route} from "./../../../helpers"
import KeyboardBackspaceIcon from '@mui/icons-material/KeyboardBackspace';

export default function ConversationChat(props) {
    const [anchorEl, setAnchorEl] = React.useState<null | HTMLElement>(null);
    const [message, setMessage] = useState("");
    const [open, setOpen] = React.useState(false);
    const [status, setStatus] = React.useState("success");
    const [messageToast, setMessageToast] = React.useState("This is a success message!");
    const [response, setResponse] = React.useState(null);
    const openE = Boolean(anchorEl);
    const myRef = React.useRef(null);

    const handleClose = ({back}) => {
        setAnchorEl(null);
    };
    const handleChange = event => {
        setMessage(event.target.value);
    };
    function onClickShowEmoji(emojiData: EmojiClickData, event: MouseEvent) {
        setMessage(
            (message) =>
                message + (emojiData.isCustom ? emojiData.unified : emojiData.emoji)
        );
    }
    const openEmoji = (event: React.MouseEvent<HTMLButtonElement>) => {
        setAnchorEl(event.currentTarget);
    };
    const handleClick = event => {
        conversationMessage.mutate({"message": message,"assign" :props.id})
        setMessage("")
    };

    const conversationMessage = useMutation(
        async (data) => {
            if(props.communication_id) {
                return await axios.put(route("api.web.v1.user-panel.conversation.update",{conversation:props.communication_id}), data);
            }else {
                return await axios.post(route("api.web.v1.user-panel.conversation.store"), data);
            }
        },
        {onSuccess: (response) => {
                setResponse(response.data)
                setOpen(true);
                setStatus("success");
                const currentDivHeight = myRef.current?.offsetHeight || 0;
                myRef.current?.scroll(0, currentDivHeight + 5000);
                setMessageToast("Message Sent successfully");
                window.setTimeout(() => {

                }, 1200);
                 },
            onError:() =>{
                setOpen(true);
                setStatus("error");
                setMessageToast("Error! Please try later");
            }
        }
    );

    useEffect(() => {
        if (response) {
            props.onIdReady(response)
        }
    }, [response])
    const handleKeydown = e => {
        if(e.keyCode === 13) { // Enter key
            e.preventDefault();
            handleClick(); // Trigger send
        }

    }
    useEffect(() => {
        const currentDivHeight = myRef.current?.offsetHeight || 0;
        myRef.current?.scroll(0, currentDivHeight + 5000);

      }, [props.information]);


    // if (!props?.information){
    //     return <div>loading....</div>
    // }
    return (
        <>
            <Snackbar
                open={open}
                autoHideDuration={6000}
                onClose={() => {
                    setOpen(false);
                }}
                anchorOrigin={{ vertical: "top", horizontal: "right" }}
            >
                <Alert
                    onClose={() => {
                        setOpen(false);
                    }}
                    severity={status}
                    sx={{ width: "100%" }}
                >
                    {messageToast}
                </Alert>
            </Snackbar>
            <Box sx={{ display: "flex", flexDirection: "column", height:"91vh" }}>
                <Box
                    sx={{
                        backgroundColor: "primary.20",
                        borderBottom: 1,
                        borderColor: "primary.main",
                        flexGrow: 0,
                        maxHeight: "4rem"
                    }}
                >
                    <ListItem sx={{paddingTop:"4px"}}>
                        <IconButton sx={{mr:1}}>
                            <KeyboardBackspaceIcon onClick={(e)=>props.back()}/>
                        </IconButton>
                        <ListItemAvatar>
                            <Avatar
                                src={props.image}
                                sx={{
                                    borderRadius: 50,
                                    width: "50px",
                                    height: "50px",
                                }}
                            ></Avatar>
                            {/* <Badge
                                            color="secondary"
                                            overlap="circular"
                                            badgeContent=" "
                                            variant="dot"
                                        >
                                            {circle}
                                        </Badge> */}
                        </ListItemAvatar>
                        <Box ml={2}>
                            <Typography variant="body1" width={{xs : "80%" , sm:"100%"}} sx={{ color: "primary.main" , whiteSpace: "nowrap", overflow: "hidden" , textOverflow: "ellipsis" }}>
                                {props.name || "Username"}
                            </Typography>
                            <Typography sx={{color: "#ffffff"}} variant="body2">
                                {props.role || "Role"}
                            </Typography>
                        </Box>
                        {/* <ListItemText
                            sx={{ color: "primary.main", ml: 2 , whiteSpace: "nowrap", width: "50%" , overflow: "hidden" , textOverflow: "ellipsis" }}
                            primary={props.name || "Username"}
                            primaryTypographyProps={{
                                variant: "body1",
                            }}
                            secondary={props.role || "Role"}
                            secondaryTypographyProps={{
                                color: "#ffffff",
                                variant: "body2",
                            }}
                        /> */}
                        <Box
                            sx={{
                                display: "flex",
                                justifyContent: "space-between",
                                ml:"auto"
                            }}
                        >
                            <IconButton>
                                <SearchIcon
                                    fontSize="large"
                                    sx={{ color: "primary.main" }}
                                />
                            </IconButton>
                            <IconButton>
                                <MoreVertOutlinedIcon
                                    fontSize="large"
                                    sx={{ color: "primary.main" }}
                                />
                            </IconButton>
                        </Box>
                    </ListItem>
                </Box>
                <Box
                    className="scrollbar"
                    ref={myRef}
                    sx={{
                        display: "flex",
                        flexDirection: "column",
                        overflowY: "scroll",
                        flexGrow: 1,
                        mx: 1,
                        px: 3,
                    }}
                >
                    {props.information?.map((message) => (
                        <Grid
                            key={message.id}
                            container
                            justifyContent={
                                message.is_sender ? "flex-end" : "flex-start"
                            }
                            alignItems="center"
                        >
                            <Grid item xs={12} sm={6} order={{sm:3 , xs:1}} >
                            <Box sx={{ml:message.is_sender ?"auto" : "unset" }} maxWidth={{xs:"80%" , sm:"100%"}}>
                                    <Paper
                                            elevation={0}
                                            sx={{
                                                my: 1,
                                                p: 1,
                                                borderRadius: 3,
                                                backgroundColor: message.is_sender
                                                    ? "primary.main"
                                                    : "gray.10",
                                            }}
                                        >
                                            <Box>
                                                <Typography
                                                    sx={{
                                                        overflowWrap: "anywhere",
                                                        display: "flex",
                                                        flexDirection: "row",
                                                        justifyContent: "space-between",
                                                        color: message.is_sender
                                                            ? "white"
                                                            : "black",
                                                    }}
                                                    variant="button"
                                                    component={"span"}
                                                >
                                                    {message.message}
                                                </Typography>
                                            </Box>
                                    </Paper>
                            </Box>
                            </Grid>
                            <Grid item order={{sm:message.is_sender ? "2" : "4" , xs:message.is_sender ? "2" : "4" }}>
                                <Box sx={{ mx: 1 }} >
                                    <Typography
                                        color="gray.main"
                                        variant="caption"
                                    >
                                        {message.date}
                                    </Typography>
                                </Box>
                            </Grid>
                            {message.is_sender && (
                                <Grid item order="1">
                                    <Box>
                                        {" "}
                                        {message.is_sender ? (
                                            <DoneAllOutlinedIcon
                                                sx={{
                                                    color: message.is_read
                                                        ? "primary.main"
                                                        : "gray.main",
                                                }}
                                                fontSize="small"
                                            />
                                        ) : (
                                            <CheckOutlinedIcon
                                                sx={{ color: "gray.main" }}
                                                fontSize="small"
                                            />
                                        )}
                                    </Box>
                                </Grid>
                            )}
                        </Grid>
                    ))}
                </Box>
                <Box>
                    <Stack
                        direction="row"
                        justifyContent="center"
                        alignItems="center"
                        sx={{ px: 3 , backgroundColor : "inputs" , height : "100%" , borderRadius : "12px"}}
                        flexGrow="0"
                    >
                        <Box  height="100%" display="flex" alignItems="end">
                            <IconButton >
                                <AttachFileIcon />
                            </IconButton>
                        </Box>
                        <Box height="100%" display="flex" alignItems="end">
                            <IconButton id="basic-button" sx={{mx: 1}}
                                        aria-controls={openE ? 'basic-menu' : undefined}
                                        aria-haspopup="true"
                                        aria-expanded={openE ? 'true' : undefined}
                                        onClick={openEmoji}
                            >
                                <SentimentSatisfiedOutlinedIcon />
                            </IconButton>
                        </Box>
                        <Menu
                            sx={{position: "absolute", bottom: 100,padding:0}}
                            id="basic-menu"
                            anchorEl={anchorEl}
                            open={openE}
                            onClose={handleClose}
                            MenuListProps={{
                                'aria-labelledby': 'basic-button',
                            }}
                        >
                            <MenuItem sx={{padding:0}}>
                                <EmojiPicker height={500}
                                             onEmojiClick={onClickShowEmoji}/>
                            </MenuItem>
                        </Menu>
                        <InputBase
                            multiline
                            maxRows={4}
                            onChange={handleChange}
                            onKeyDown={handleKeydown}
                            value={message}
                            fullWidth
                            sx={{
                                py: 0.4,
                                borderTopLeftRadius: 50,
                                borderBottomLeftRadius: 50,
                            }}
                            placeholder="Type a message"
                            inputProps={{"aria-label": "message"}}
                        />
                        <Box height="100%" display="flex" alignItems="end">
                            <IconButton
                                onClick={handleClick}
                                sx={{
                                    borderRadius: 0,
                                    alignItems : "end"
                                }}
                                type="button"
                                aria-label="message"
                            >
                                <SendIcon sx={{color: "primary.main"}}/>
                            </IconButton>
                        </Box>
                    </Stack>
                </Box>
            </Box>
        </>
    );
}
