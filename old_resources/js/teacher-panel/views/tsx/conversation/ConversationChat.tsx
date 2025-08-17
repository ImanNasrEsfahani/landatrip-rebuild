import * as React from "react";
// import SwipeableViews from "react-swipeable-views";
import { styled, useTheme, Theme, CSSObject } from "@mui/material/styles";
import Box from "@mui/material/Box";
import MuiDrawer from "@mui/material/Drawer";
import MuiAppBar, { AppBarProps as MuiAppBarProps } from "@mui/material/AppBar";
import Toolbar from "@mui/material/Toolbar";
import List from "@mui/material/List";
import CssBaseline from "@mui/material/CssBaseline";
import Typography from "@mui/material/Typography";
import Divider from "@mui/material/Divider";
import IconButton from "@mui/material/IconButton";
import ListItem from "@mui/material/ListItem";
import ListItemButton from "@mui/material/ListItemButton";
import ListItemIcon from "@mui/material/ListItemIcon";
import ListItemText from "@mui/material/ListItemText";
import InboxIcon from "@mui/icons-material/MoveToInbox";
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
    Paper,
} from "@mui/material";
import { Link as LinkReact } from "react-router-dom";
import customTheme from "./../../../custom";

import MenuIcon from "@mui/icons-material/Menu";
import ChevronLeftIcon from "@mui/icons-material/ChevronLeft";
import ChevronRightIcon from "@mui/icons-material/ChevronRight";
import NotificationsIcon from "@mui/icons-material/Notifications";
import MoreIcon from "@mui/icons-material/MoreVert";
import MailIcon from "@mui/icons-material/Mail";
import Logout from "@mui/icons-material/Logout";
import PersonAdd from "@mui/icons-material/PersonAdd";
import Settings from "@mui/icons-material/Settings";
import AccountCircle from "@mui/icons-material/AccountCircle";
import ExpandMoreIcon from "@mui/icons-material/ExpandMore";
import DashboardIcon from "@mui/icons-material/Dashboard";
import PersonIcon from "@mui/icons-material/Person";
import ContentPasteIcon from "@mui/icons-material/ContentPaste";
import QuestionAnswerRoundedIcon from "@mui/icons-material/QuestionAnswerRounded";
import SupportAgentRoundedIcon from "@mui/icons-material/SupportAgentRounded";
import ExitToAppRoundedIcon from "@mui/icons-material/ExitToAppRounded";
import MinimizeIcon from "@mui/icons-material/Minimize";
import ArrowForwardIosSharpIcon from "@mui/icons-material/ArrowForwardIosSharp";
import ExploreIcon from "@mui/icons-material/Explore";
import HandshakeIcon from "@mui/icons-material/Handshake";
import AccountCircleRoundedIcon from "@mui/icons-material/AccountCircleRounded";
import HomeIcon from "@mui/icons-material/Home";
import LocationOnRoundedIcon from "@mui/icons-material/LocationOnRounded";
import Diversity3RoundedIcon from "@mui/icons-material/Diversity3Rounded";
import PsychologyRoundedIcon from "@mui/icons-material/PsychologyRounded";
import ForumRoundedIcon from "@mui/icons-material/ForumRounded";
import HandshakeRoundedIcon from "@mui/icons-material/HandshakeRounded";
import CalendarMonthRoundedIcon from "@mui/icons-material/CalendarMonthRounded";
import WalletRoundedIcon from "@mui/icons-material/WalletRounded";
import ArrowDropDownIcon from "@mui/icons-material/ArrowDropDown";
import RestoreIcon from "@mui/icons-material/Restore";
import FavoriteIcon from "@mui/icons-material/Favorite";
import LocationOnIcon from "@mui/icons-material/LocationOn";
import SearchIcon from "@mui/icons-material/Search";
import SettingsIcon from "@mui/icons-material/Settings";
import ArrowCircleLeftOutlinedIcon from "@mui/icons-material/ArrowCircleLeftOutlined";
import MoreVertOutlinedIcon from "@mui/icons-material/MoreVertOutlined";
import SendIcon from "@mui/icons-material/Send";
import AttachFileIcon from "@mui/icons-material/AttachFile";
import SentimentSatisfiedOutlinedIcon from "@mui/icons-material/SentimentSatisfiedOutlined";
import CheckOutlinedIcon from "@mui/icons-material/CheckOutlined";
import DoneAllOutlinedIcon from "@mui/icons-material/DoneAllOutlined";

// import USA from "../assets/usa.png";
// import IRAN from "../assets/iran.png";
// import FRANCE from "../assets/france.png";
// import LOGO from "../assets/LogoSVG.svg";
import avatarPic from "../../../components/assets/avatarCC.png";

export default function ConversationChat() {
    const StyledBadge = styled(Badge)<BadgeProps>(({ theme }) => ({
        "& .MuiBadge-badge": {
            left: "100%",
            top: "50%",
        },
    }));

    const messages = [
        {
            id: 1,
            message: "abcd",
            time: "20.48",
            isSender: true,
            isSend: true,
            isSeen: true,
        },
        {
            id: 2,
            message: "efgh",
            time: "20.48",
            isSender: false,
            isSend: true,
            isSeen: false,
        },
        {
            id: 3,
            message: "efgaaaaaaaaaaaaaaaaaaaaaaaaaaaaah",
            time: "20.48",
            isSender: false,
            isSend: true,
            isSeen: false,
        },
        {
            id: 4,
            message: "ijkl",
            time: "20.48",
            isSender: true,
            isSend: true,
            isSeen: false,
        },
        {
            id: 5,
            message: "ijkssssssssssssssssssssssssssssssssssssssssssssssl",
            time: "20.48",
            isSender: true,
            isSend: true,
            isSeen: true,
        },
        {
            id: 6,
            message: "mnopqrstxyzljdsfnlndf",
            time: "20.48",
            isSender: false,
            isSend: true,
            isSeen: true,
        },
        {
            id: 7,
            message:
                "mnsssssssssssssjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjsssssssssssssssssssssssssssssssop",
            time: "20.48",
            isSender: false,
            isSend: false,
            isSeen: true,
        },
        {
            id: 8,
            message:
                "mnsssssssssssssjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjssssssssssssssssop",
            time: "20.48",
            isSender: true,
            isSend: false,
            isSeen: false,
        },
    ];

    return (
        <>
            <Box sx={{ display: "flex", flexDirection: "column", height:"91vh" }}>
                <Box
                    sx={{
                        backgroundColor: "primary.20",
                        borderBottom: 1,
                        borderColor: "primary.main",
                        flexGrow: 0,
                        maxHeight: "5rem"
                    }}
                >
                    <ListItem>
                        <ListItemAvatar>
                            <Avatar
                                src={avatarPic}
                                sx={{
                                    borderRadius: 0,
                                    width: "70px",
                                    height: "70px",
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
                        <ListItemText
                            sx={{ color: "primary.main", ml: 2 }}
                            primary={"Username"}
                            primaryTypographyProps={{
                                variant: "body1",
                            }}
                            secondary={"Role"}
                            secondaryTypographyProps={{
                                color: "#ffffff",
                                variant: "body2",
                            }}
                        />
                        <Box
                            sx={{
                                display: "flex",
                                justifyContent: "space-between",
                                mx: 2,
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
                    sx={{
                        display: "flex",
                        flexDirection: "column",
                        overflowY: "scroll",
                        flexGrow: 1,
                        mx: 1,
                        px: 3,
                    }}
                >
                    {messages.map((message) => (
                        <Grid
                            key={message.id}
                            container
                            justifyContent={
                                message.isSender ? "flex-end" : "flex-start"
                            }
                            alignItems="center"
                        >
                            <Grid item order="3" sx={{ maxWidth: "50%" }}>
                                <Paper
                                    elevation={0}
                                    sx={{
                                        my: 1,
                                        p: 1,
                                        borderRadius: 3,
                                        backgroundColor: message.isSender
                                            ? "primary.main"
                                            : "gray.10",
                                    }}
                                >
                                    <Box sx={{}}>
                                        <Typography
                                            sx={{
                                                overflowWrap: "anywhere",
                                                display: "flex",
                                                flexDirection: "row",
                                                justifyContent: "space-between",
                                                color: message.isSender
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
                            </Grid>
                            <Grid item order={message.isSender ? "2" : "4"}>
                                <Box sx={{ mx: 1 }}>
                                    <Typography
                                        color="gray.main"
                                        variant="caption"
                                    >
                                        {message.time}
                                    </Typography>
                                </Box>
                            </Grid>
                            {message.isSender && (
                                <Grid item order="1">
                                    <Box>
                                        {" "}
                                        {message.isSend ? (
                                            <DoneAllOutlinedIcon
                                                sx={{
                                                    color: message.isSeen
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
                        sx={{ px: 3 }}
                        flexGrow="0"
                    >
                        <IconButton sx={{ backgroundColor: "inputs" }}>
                            <AttachFileIcon />
                        </IconButton>
                        <IconButton sx={{ backgroundColor: "inputs", mx: 1 }}>
                            <SentimentSatisfiedOutlinedIcon />
                        </IconButton>
                        <InputBase
                            fullWidth
                            sx={{
                                backgroundColor: "inputs",
                                pl: 2,
                                py: 0.4,
                                borderTopLeftRadius: 50,
                                borderBottomLeftRadius: 50,
                            }}
                            placeholder="Type a message"
                            inputProps={{ "aria-label": "message" }}
                        />
                        <IconButton
                            sx={{
                                backgroundColor: "inputs",
                                borderRadius: 0,
                                borderTopRightRadius: 50,
                                borderBottomRightRadius: 50,
                            }}
                            type="button"
                            aria-label="message"
                        >
                            <SendIcon sx={{ color: "primary.main" }} />
                        </IconButton>
                    </Stack>
                </Box>
            </Box>
        </>
    );
}
