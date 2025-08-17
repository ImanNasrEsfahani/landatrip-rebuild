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
    InputBase,
    ListItemAvatar,
    Stack,
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

// import USA from "../assets/usa.png";
// import IRAN from "../assets/iran.png";
// import FRANCE from "../assets/france.png";
// import LOGO from "../assets/LogoSVG.svg";
import avatarPic from "../../../components/assets/avatarC.png";
import {useMutation, useQuery} from "react-query";
import axios from "axios";
import {route} from './../../../helpers'

interface TabPanelProps {
    children?: React.ReactNode;
    dir?: string;
    index: number;
    value: number;
}

export default function ConversationList() {

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
        setValue(newValue);
    };

    const StyledBadge = styled(Badge)<BadgeProps>(({ theme }) => ({
        "& .MuiBadge-badge": {
            left: "100%",
            top: "50%",
        },
    }));


    const [chat, setChat] = React.useState({});

    const conversation = useQuery('conversation',async ()=>{
        const {data} = await axios.get(route('api.web.v1.user-panel.conversation.index'))
        conversation.data = data.data
        return conversation
    })

    const CommunicationMessage = useMutation(async (data) => {
        setId(data);
            const response = await axios.get(route("api.web.v1.user-panel.conversation.show", {communication: data,}));
            return response.data;
        },
        {
            onSuccess: (data) => {
                setChat(data);
            },
            onError: () => {},
            onSettled: () => {},
        }
    );

    if (conversation.isLoading){
        return <p>loading....</p>
    }
    return (
        <>
            <Box
                sx={{
                    backgroundColor: "primary.40",
                    p: 0,
                    m: 0,
                }}
            >
                <Box
                    sx={{
                        flexGrow: 1,
                        display: "flex",
                        flexDirection: "column",
                        backgroundColor: "primary.40",
                        p: 0,
                        m: 0,
                        height:"92vh"
                    }}
                >
                    <Box>
                        <Box
                            sx={{
                                maxWidth: { xs: 320, sm: 480 },
                                bgcolor: "primary.40",
                            }}
                        >
                            <Tabs
                                value={value}
                                onChange={handleChange}
                                variant="scrollable"
                                scrollButtons="auto"
                                aria-label="scrollable auto tabs example"
                            >
                                <Tab
                                    label={
                                        <StyledBadge
                                            badgeContent={4}
                                            color="orange"
                                        >
                                            <Typography
                                                variant="body2"
                                                sx={{ml:32,
                                                    textTransform: "capitalize",
                                                    color: "white",
                                                }}
                                            >
                                                All
                                            </Typography>
                                        </StyledBadge>
                                    }
                                    sx={{ color: "white", paddingX: 10 }}
                                />
                                <Tab
                                    label={
                                        <StyledBadge
                                            badgeContent={4}
                                            color="orange"
                                        >
                                            <Typography
                                                variant="body2"
                                                sx={{
                                                    textTransform: "capitalize",
                                                    color: "white",
                                                }}
                                            >
                                                Student
                                            </Typography>
                                        </StyledBadge>
                                    }
                                    sx={{ color: "white", paddingX: 5 }}
                                />
                                <Tab
                                    label={
                                        <StyledBadge
                                            badgeContent={4}
                                            color="orange"
                                        >
                                            <Typography
                                                variant="body2"
                                                sx={{
                                                    textTransform: "capitalize",
                                                    color: "white",
                                                }}
                                            >
                                                Agent
                                            </Typography>
                                        </StyledBadge>
                                    }
                                    sx={{ color: "white", paddingX: 5 }}
                                />
                                <Tab
                                    label={
                                        <StyledBadge
                                            badgeContent={4}
                                            color="orange"
                                        >
                                            <Typography
                                                variant="body2"
                                                sx={{
                                                    textTransform: "capitalize",
                                                    color: "white",
                                                }}
                                            >
                                                Admin
                                            </Typography>
                                        </StyledBadge>
                                    }
                                    sx={{ color: "white", paddingX: 5 }}
                                />
                                <Tab
                                    label={
                                        <StyledBadge
                                            badgeContent={4}
                                            color="orange"
                                        >
                                            <Typography
                                                variant="body2"
                                                sx={{
                                                    textTransform: "capitalize",
                                                    color: "white",
                                                }}
                                            >
                                                Archived
                                            </Typography>
                                        </StyledBadge>
                                    }
                                    sx={{ color: "white", paddingX: 5 }}
                                />
                            </Tabs>
                        </Box>

                        {/* <TabPanel value={value} index={0}>
                            All
                        </TabPanel>
                        <TabPanel value={value} index={1}>
                            Student
                        </TabPanel>
                        <TabPanel value={value} index={2}>
                            Agent
                        </TabPanel>
                        <TabPanel value={value} index={3}>
                            Admin
                        </TabPanel>
                        <TabPanel value={value} index={4}>
                            Archived
                        </TabPanel> */}
                    </Box>
                    <Box
                        sx={{
                            backgroundColor: "inputs",
                            borderRadius: 10,
                            mx: 2,
                            my: 2,
                        }}
                    >
                        <Stack direction="row" sx={{ mx: 2 }}>
                            <InputBase
                                fullWidth
                                sx={{}}
                                placeholder="Search"
                                inputProps={{ "aria-label": "search" }}
                            />
                            <IconButton type="button" aria-label="search">
                                <SearchIcon />
                            </IconButton>
                        </Stack>
                    </Box>
                    <List
                        className="scrollbar"
                        sx={{
                            flex: "1 1 auto",
                            overflowY: "scroll",
                            px: 2,
                        }}
                    >
                        {conversation.data.data.map((item) => (
                            <ListItem
                                sx={{
                                    my: 1,
                                    py: 1,
                                    pr: 2.5,
                                    bgcolor: "primary.main",
                                    borderRadius: 4,
                                }}
                                key={item.communication_id}
                                onClick={()=>{
                                    console.log(item.communication_id)}}
                            >
                                <ListItemButton sx={{ m: 0, p: 0 }}>
                                    <ListItemAvatar>
                                        <Avatar
                                            src={item.assign_profile_picture}
                                            sx={{
                                                borderRadius: 0,
                                                width: "50px",
                                                height: "50px",
                                            }}
                                        ></Avatar>
                                    </ListItemAvatar>
                                    <ListItemText
                                        sx={{ color: "#ffffff" }}
                                        primary={item.assign_name}
                                        primaryTypographyProps={{
                                            variant: "body1",
                                        }}
                                        secondary={item.role || "Role"}
                                        secondaryTypographyProps={{
                                            color: "#cccccc",
                                            variant: "body2",
                                        }}
                                    />
                                    <ListItemText
                                        sx={{
                                            textAlign: "center",
                                            color: "#ffffff",
                                        }}
                                        primary={item.time || "Time"}
                                        primaryTypographyProps={{
                                            variant: "body2",
                                        }}
                                    />
                                    {item.isUnseen && (
                                        <StyledBadge
                                            variant="dot"
                                            color="orange"
                                        />
                                    )}
                                </ListItemButton>
                            </ListItem>
                        ))}
                    </List>
                    <Box sx={{ backgroundColor: "#339180", flexGrow: 0 }}>
                        <Box
                            sx={{
                                display: "flex",
                                justifyContent: "space-between",
                                mx: 2,
                            }}
                        >
                            <IconButton>
                                <SettingsIcon
                                    sx={{ color: "white", fontSize: 25 }}
                                />
                            </IconButton>
                            <IconButton>
                                <ArrowCircleLeftOutlinedIcon
                                    sx={{ color: "white", fontSize: 25 }}
                                />
                            </IconButton>
                        </Box>
                    </Box>
                </Box>
            </Box>
        </>
    );
}
