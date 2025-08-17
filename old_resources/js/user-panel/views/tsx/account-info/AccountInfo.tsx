import * as React from "react";
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
import AccountInfoProfile from "./AccountInfoProfile";
import AccountInfoDocuments from "./AccountInfoDocuments";
import AccountInfoEducationalBackground from "./AccountInfoEducationalBackground";
import AccountInfoWorkExperience from "./AccountInfoWorkExperience";
import AccountInfoContactDetail from "./AccountInfoContactDetail";

// import USA from "../assets/usa.png";
// import IRAN from "../assets/iran.png";
// import FRANCE from "../assets/france.png";
// import LOGO from "../assets/LogoSVG.svg";
// import ProfilePic from "../assets/profilePic.png";

interface TabPanelProps {
    children?: React.ReactNode;
    dir?: string;
    index: number;
    value: number;
}

function TabPanel(props: TabPanelProps) {
    const { children, value, index, ...other } = props;

    return (
        <Box
            role="tabpanel"
            hidden={value !== index}
            id={`full-width-tabpanel-${index}`}
            aria-labelledby={`full-width-tab-${index}`}
            {...other}
        >
            {value === index && (
                <Box sx={{ p: 3 }}>
                    <Typography>{children}</Typography>
                </Box>
            )}
        </Box>
    );
}

function a11yProps(index: number) {
    return {
        id: `full-width-tab-${index}`,
        "aria-controls": `full-width-tabpanel-${index}`,
    };
}
export default function AccountInfo() {
    const [value, setValue] = React.useState(0);

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
        setValue(newValue);
    };

    const handleChangeIndex = (index: number) => {
        setValue(index);
    };

    return (
        <>
            <Box sx={{mt:1}}>
                <Tabs
                    value={value}
                    onChange={handleChange}
                    variant="scrollable"
                    scrollButtons="auto"
                    aria-label="scrollable auto tabs example"
                >
                    <Tab label="Profile" sx={{ paddingX: 5 }} />
                    <Tab label="Documents" sx={{ paddingX: 5 }} />
                    <Tab label="Educational Background" sx={{ paddingX: 5 }} />
                    <Tab label="Work Experience" sx={{ paddingX: 5 }} />
                    <Tab label="Contact Detail" sx={{ paddingX: 5 }} />
                </Tabs>
            </Box>
            <Divider sx={{ borderColor: "gray.30", borderWidth: 0.25 }} />
            <TabPanel value={value} index={0}>
                <AccountInfoProfile />
            </TabPanel>
            <TabPanel value={value} index={1}>
                <AccountInfoDocuments />
            </TabPanel>
            <TabPanel value={value} index={2}>
                <AccountInfoEducationalBackground/>
            </TabPanel>
            <TabPanel value={value} index={3}>
                <AccountInfoWorkExperience/>
            </TabPanel>
            <TabPanel value={value} index={4}>
                <AccountInfoContactDetail/>
            </TabPanel>
        </>
    );
}
