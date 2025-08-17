import * as React from "react";
import {styled, useTheme, Theme, CSSObject} from "@mui/material/styles";
import Box from "@mui/material/Box";
import MuiDrawer from "@mui/material/Drawer";
import MuiAppBar, {AppBarProps as MuiAppBarProps} from "@mui/material/AppBar";
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
} from "@mui/material";
import {Link as LinkReact} from "react-router-dom";
import customTheme from "./../../custom";

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

import USA from "./assets/usa.png";
import IRAN from "./assets/iran.png";
import FRANCE from "./assets/france.png";
import LOGO from "./assets/Logo.png";
import Contents from "./Contents";
import {getInfo} from "../redux/info"
import axios from "./../../axiosConfig.js";
import {route} from "./../helpers.js";
import {useQuery} from "react-query";
import {useDispatch, useSelector} from "react-redux";


const drawerItems = [
    {id: 1, name: "Dashboard", route: "teacher-panel", icon: <HomeIcon/>},
    {id: 2, name: "Account Info", route: "teacher-panel/account-info", icon: <AccountCircleRoundedIcon/>, hasChildren: false},
    {id: 3, name: "Tours", route: "teacher-panel/tours", icon: <LocationOnRoundedIcon/>, hasChildren: false},
    {id: 4, name: "Affiliation", route: "teacher-panel/affiliation", icon: <Diversity3RoundedIcon/>, hasChildren: false},
    {id: 5, name: "Applications", route: "teacher-panel/applications", icon: <PsychologyRoundedIcon/>, hasChildren: false},
    {id: 6, name: "Conversation", route: "teacher-panel/conversation", icon: <ForumRoundedIcon/>, hasChildren: false},
    {id: 7, name: "Agreements", route: "teacher-panel/agreements", icon: <HandshakeRoundedIcon/>, hasChildren: false},
    {id: 8, name: "Calender", route: "teacher-panel/calender", icon: <CalendarMonthRoundedIcon/>, hasChildren: false},
    {id: 9, name: "Wallet", route: "teacher-panel/wallet", icon: <WalletRoundedIcon/>, hasChildren: false},
];

const drawerWidth = 240;

const openedMixin = (theme: Theme): CSSObject => ({
    width: drawerWidth,
    transition: theme.transitions.create("width", {
        easing: theme.transitions.easing.sharp,
        duration: theme.transitions.duration.enteringScreen,
    }),
    overflowX: "hidden",
});

const closedMixin = (theme: Theme): CSSObject => ({
    transition: theme.transitions.create("width", {
        easing: theme.transitions.easing.sharp,
        duration: theme.transitions.duration.leavingScreen,
    }),
    overflowX: "hidden",
    width: `calc(${theme.spacing(7)} + 1px)`,
    [theme.breakpoints.up("sm")]: {
        width: `calc(${theme.spacing(8)} + 1px)`,
    },
});



const DrawerHeader = styled("div")(({theme}) => ({
    display: "flex",
    alignItems: "center",
    justifyContent: "flex-end",
    padding: theme.spacing(0, 1),
    // necessary for content to be below app bar
    ...theme.mixins.toolbar,
}));

interface AppBarProps extends MuiAppBarProps {
    open?: boolean;
}

const AppBar = styled(MuiAppBar, {
    shouldForwardProp: (prop) => prop !== "open",
})<AppBarProps>(({theme, open}) => ({
    zIndex: theme.zIndex.drawer + 1,
    transition: theme.transitions.create(["width", "margin"], {
        easing: theme.transitions.easing.sharp,
        duration: theme.transitions.duration.leavingScreen,
    }),
    ...(open && {
        marginLeft: drawerWidth,
        width: `calc(100% - ${drawerWidth}px)`,
        transition: theme.transitions.create(["width", "margin"], {
            easing: theme.transitions.easing.sharp,
            duration: theme.transitions.duration.enteringScreen,
        }),
    }),
}));

const Drawer = styled(MuiDrawer, {
    shouldForwardProp: (prop) => prop !== "open",
})(({theme, open}) => ({
    width: drawerWidth,
    flexShrink: 0,
    whiteSpace: "nowrap",
    boxSizing: "border-box",
    ...(open && {
        ...openedMixin(theme),
        "& .MuiDrawer-paper": openedMixin(theme),
    }),
    ...(!open && {
        ...closedMixin(theme),
        "& .MuiDrawer-paper": closedMixin(theme),
    }),
}));

export default function PanelTest() {
    const theme = useTheme();
    const [open, setOpen] = React.useState(false);

    //Redux Config
    const dispatch = useDispatch();
    const Data = useSelector(state => state.information);

    //Get general user info
    const GeneralInfo = useQuery('GeneralInfo', async () => {
        const {data} = await axios.get(route("api.web.v1.teacher-panel.user-general-info"));
        GeneralInfo.data = data.data;
        dispatch(getInfo(GeneralInfo.data));
        return GeneralInfo;
    },{refetchInterval:5000});


    const handleDrawerOpen = () => {
        setOpen(true);
    };

    const handleDrawerClose = () => {
        setOpen(false);
    };

    const [anchorEl, setAnchorEl] = React.useState<null | HTMLElement>(null);
    const [mobileMoreAnchorEl, setMobileMoreAnchorEl] =
        React.useState<null | HTMLElement>(null);

    const isMenuOpen = Boolean(anchorEl);
    const isMobileMenuOpen = Boolean(mobileMoreAnchorEl);

    const handleProfileMenuOpen = (event: React.MouseEvent<HTMLElement>) => {
        setAnchorEl(event.currentTarget);
    };

    const handleMobileMenuClose = () => {
        setMobileMoreAnchorEl(null);
    };

    const handleMenuClose = () => {
        setAnchorEl(null);
        handleMobileMenuClose();
    };

    const handleMobileMenuOpen = (event: React.MouseEvent<HTMLElement>) => {
        setMobileMoreAnchorEl(event.currentTarget);
    };

    const menuId = "primary-search-account-menu";

    const mobileMenuId = "primary-search-account-menu-mobile";
    const renderMobileMenu = (
        <Menu anchorEl={mobileMoreAnchorEl} anchorOrigin={{
            vertical: "top",
            horizontal: "right",
        }} id={mobileMenuId} keepMounted transformOrigin={{
            vertical: "top",
            horizontal: "right",
        }} open={isMobileMenuOpen} onClose={handleMobileMenuClose}>
            <MenuItem>
                <IconButton size="large" aria-label="show 4 new mails" color="inherit">
                    <Badge badgeContent={4} color="error">
                        <MailIcon/>
                    </Badge>
                </IconButton>
                <p>Messages</p>
            </MenuItem>
            <MenuItem>
                <IconButton size="large" aria-label="show 17 new notifications" color="inherit">
                    <Badge badgeContent={17} color="error">
                        <NotificationsIcon/>
                    </Badge>
                </IconButton>
                <p>Notifications</p>
            </MenuItem>
            <MenuItem onClick={handleProfileMenuOpen}>
                <IconButton size="large" aria-label="account of current user"
                    aria-controls="primary-search-account-menu" aria-haspopup="true" color="inherit">
                    <AccountCircle/>
                </IconButton>
                <p>Profile</p>
            </MenuItem>
        </Menu>
    );

    const [anchorEl2, setAnchorEl2] = React.useState<null | HTMLElement>(null);
    const open2 = Boolean(anchorEl2);
    const handleClick2 = (event: React.MouseEvent<HTMLElement>) => {
        setAnchorEl2(event.currentTarget);
    };
    const handleClose2 = () => {
        setAnchorEl2(null);
    };

    return (
        <Box sx={{display: "flex", flexGrow: 0, height: "100vh"}}>
            <CssBaseline/>
            <AppBar sx={{bgcolor: "blue-green"}} position="fixed" open={open}>
                <Toolbar>
                    <IconButton size="large" edge="start" onClick={handleDrawerOpen} color="inherit"
                        aria-label="open drawer" sx={{
                        marginRight: 0,
                        ...(open && {display: "none"}),
                    }}>
                        <MenuIcon/>
                    </IconButton>
                    <Link sx={{
                        ...(open && {display: "none"}),
                    }} href="www.landatrip.com">
                        <img
                            // width={"235px"}
                            // height={"55px"}
                            src={LOGO} alt="Logo"/>
                    </Link>
                    <Box sx={{flexGrow: 1}}/>
                    <Box sx={{display: {xs: "none", md: "flex"}}}>
                        <Tooltip title="Notifications">
                            <Button size="large" aria-label="show 17 new notifications" color="inherit">
                                <Badge badgeContent={17} color="error">
                                    <NotificationsIcon/>
                                </Badge>
                            </Button>
                        </Tooltip>
                        <Tooltip title="Account settings">
                            <Button onClick={handleClick2} size="large" aria-label="show 17 new notifications"
                                color="inherit" aria-controls={
                                open2 ? "account-menu" : undefined
                            } aria-haspopup="true" aria-expanded={open2 ? "true" : undefined}>
                                <Avatar sx={{width: 32, height: 32, mr: 1}}>
                                    M
                                </Avatar>
                                <Typography sx={{textTransform: "capitalize"}}>
                                    Username
                                </Typography>
                                <ArrowDropDownIcon/>
                            </Button>
                        </Tooltip>
                        <Menu anchorEl={anchorEl2} id="account-menu" open={open2} onClose={handleClose2}
                            onClick={handleClose2} PaperProps={{
                            elevation: 0,
                            sx: {
                                overflow: "visible",
                                filter: "drop-shadow(0px 2px 8px rgba(0,0,0,0.32))",
                                mt: 1.5,
                                "& .MuiAvatar-root": {
                                    width: 32,
                                    height: 32,
                                    ml: -0.5,
                                    mr: 1,
                                },
                                "&:before": {
                                    content: "\"\"",
                                    display: "block",
                                    position: "absolute",
                                    top: 0,
                                    right: 27.5,
                                    width: 10,
                                    height: 10,
                                    bgcolor: "background.paper",
                                    transform:
                                        "translateY(-50%) rotate(45deg)",
                                    zIndex: 0,
                                },
                            },
                        }} transformOrigin={{
                            horizontal: "right",
                            vertical: "top",
                        }} anchorOrigin={{
                            horizontal: "right",
                            vertical: "bottom",
                        }}>
                            <MenuItem onClick={handleClose2}>
                                <Avatar/> Profile
                            </MenuItem>
                            <Divider/>
                            <MenuItem onClick={handleClose2}>
                                <ListItemIcon>
                                    <Settings fontSize="small"/>
                                </ListItemIcon>
                                Settings
                            </MenuItem>
                            <MenuItem onClick={handleClose2}>
                                <ListItemIcon>
                                    <Logout fontSize="small"/>
                                </ListItemIcon>
                                Logout
                            </MenuItem>
                        </Menu>
                        <FormControl sx={{
                            backgroundColor: "transparent",
                            border: 0,
                            p: 0,
                            borderColor: "",

                            "& span span": {
                                display: "none",
                            },
                        }} size="small">
                            <Select sx={{
                                border: 0,
                                p: 0,
                                textAlign: "center",
                                boxShadow: "none",
                                ".MuiOutlinedInput-notchedOutline": {
                                    border: 0,
                                },
                                "& .MuiSvgIcon-root": {color: "#fff"},
                            }} defaultValue={"EN"} inputProps={{
                                "aria-label": "Without label",
                            }}>
                                <MenuItem sx={{placeContent: "center"}} value="EN">
                                    <Tooltip title="EN" placement="left">
                                        <img src={USA} alt="EN"/>
                                        <Typography component="span" variant="body2" sx={{ml: 1}}>
                                            EN
                                        </Typography>
                                    </Tooltip>
                                </MenuItem>
                                <MenuItem sx={{placeContent: "center"}} value="FR">
                                    <Tooltip title="FR" placement="left">
                                        <img src={FRANCE} alt="FR"/>
                                        <Typography component="span" variant="body2" sx={{ml: 1}}>
                                            FR
                                        </Typography>
                                    </Tooltip>
                                </MenuItem>
                                <MenuItem sx={{placeContent: "center"}} value="IR">
                                    <Tooltip title="IR" placement="left">
                                        <img src={IRAN} alt="IR"/>
                                        <Typography component="span" variant="body2" sx={{ml: 1}}>
                                            IR
                                        </Typography>
                                    </Tooltip>
                                </MenuItem>
                            </Select>
                        </FormControl>
                    </Box>
                    <Box sx={{
                        display: {xs: "flex", md: "none"},
                        bgcolor: "blue-green",
                    }}>
                        <IconButton size="large" aria-label="show more" aria-controls={mobileMenuId}
                            aria-haspopup="true" onClick={handleMobileMenuOpen} color="inherit">
                            <MoreIcon/>
                        </IconButton>
                    </Box>
                </Toolbar>
            </AppBar>
            <Drawer variant="permanent" open={open}>
                <DrawerHeader sx={{display: "flex", backgroundColor: "#00696e"}}>
                    <Box>
                        <Link href="www.landatrip.com">
                            <img width="170px" src={LOGO} alt="Logo"/>
                        </Link>
                    </Box>
                    <IconButton sx={{color: "#ffffff"}} onClick={handleDrawerClose}>
                        {theme.direction === "rtl" ? (
                            <ChevronRightIcon/>
                        ) : (
                            <ChevronLeftIcon/>
                        )}
                    </IconButton>
                </DrawerHeader>
                <List className="scrollbar" sx={{
                    backgroundColor: "#00696e",
                    height: "#100%",
                    flexGrow: 1,
                    overflowX: "hidden",
                }}>
                    {drawerItems.map((item) => (
                        <Tooltip key={item.id} title={item.name} placement="right">
                            <ListItem disablePadding sx={{display: "block"}}>
                                <ListItemButton component={LinkReact} to={item.route} sx={{
                                    minHeight: 48,
                                    justifyContent: open
                                        ? "initial"
                                        : "center",
                                    px: 2.5,
                                    color: "#ffffff",
                                }}>
                                    <ListItemIcon sx={{
                                        minWidth: 0,
                                        mr: open ? 3 : "auto",
                                        justifyContent: "center",
                                        color: "#ffffff",
                                    }}>
                                        {item.icon}
                                    </ListItemIcon>
                                    <ListItemText primary={item.name} sx={{opacity: open ? 1 : 0}}/>
                                </ListItemButton>
                            </ListItem>
                        </Tooltip>
                    ))}
                </List>
            </Drawer>
            <Box component="main" sx={{flexGrow: 1, p: 3}}>
                <DrawerHeader/>
                <Contents/>
                {/* <Content/> */}
                {/* <TextField
                    sx={{
                        // some styles
                        "input:focus": {
                            backgroundColor: "#dd00dd",
                            border:0,
                            borderColor:"#0000ff"
                        },
                        ":focus-within": {
                            backgroundColor: "#ffff00",
                            border:0,
                            borderColor:"#0000ff"
                        },
                        ":focus-visible": {
                            backgroundColor: "#00ff00",
                        },
                        ":hover": {
                            backgroundColor: "#00dd",
                        },
                        ":active": {
                            backgroundColor: "#77aadd",
                        },
                        ":visited": {
                            backgroundColor: "#00ff00",
                        },
                        ":target": {
                            backgroundColor: "#11ffff",
                        },
                    }}
                    label="Outlined"
                    variant="outlined"
                /> */}
            </Box>
        </Box>
    );
}
