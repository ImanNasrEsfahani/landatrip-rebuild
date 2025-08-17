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
} from "@mui/material";
import { Link as LinkReact } from "react-router-dom";
import customTheme from "../../custom";

import MenuIcon from "@mui/icons-material/Menu";
import ChevronLeftIcon from "@mui/icons-material/ChevronLeft";
import ChevronRightIcon from "@mui/icons-material/ChevronRight";
import NotificationsIcon from "@mui/icons-material/Notifications";
import MoreIcon from "@mui/icons-material/MoreVert";
import MailIcon from "@mui/icons-material/Mail";
import Logout from "@mui/icons-material/Logout";
import Settings from "@mui/icons-material/Settings";
import AccountCircleRoundedIcon from "@mui/icons-material/AccountCircleRounded";
import ForumRoundedIcon from "@mui/icons-material/ForumRounded";
import HandshakeRoundedIcon from "@mui/icons-material/HandshakeRounded";
import ArrowDropDownIcon from "@mui/icons-material/ArrowDropDown";
import VerifiedIcon from "@mui/icons-material/Verified";
import ShieldIcon from "@mui/icons-material/Shield";
import BadgeIcon from "@mui/icons-material/Badge";
import ReceiptIcon from "@mui/icons-material/Receipt";
import TimelineIcon from "@mui/icons-material/Timeline";
import RecentActorsIcon from "@mui/icons-material/RecentActors";
import DeleteIcon from "@mui/icons-material/Delete";
import MediationIcon from "@mui/icons-material/Mediation";
import HomeIcon from '@mui/icons-material/Home';
import { route } from "./../helpers.js";
import axios from "./../../axiosConfig.js";
import ConfirmationNumberIcon from '@mui/icons-material/ConfirmationNumber';

import USA from "./assets/usa.png";
import IRAN from "./assets/iran.png";
import FRANCE from "./assets/france.png";
import LOGO from "./assets/Logo.png";
import Contents from "./Contents";
import {useSelector} from "react-redux";

const drawerItems = [
    {
        id: 2,
        name: "Dashboard",
        route: "user-panel/",
        icon: <HomeIcon />,
        hasChildren: false,
    },
    {
        id: 2,
        name: "Account Info",
        route: "user-panel/account-info",
        icon: <AccountCircleRoundedIcon />,
        hasChildren: false,
    },
    {
        id: 6,
        name: "Conversation",
        route: "user-panel/conversation",
        icon: <ForumRoundedIcon />,
        hasChildren: false,
    },
    {
        id: 7,
        name: "Agreements",
        route: "user-panel/agreements",
        icon: <HandshakeRoundedIcon />,
        hasChildren: false,
    },
    // {
    //     id: 8,
    //     name: "Calender",
    //     route: "user-panel/calender",
    //     icon: <CalendarMonthRoundedIcon />,
    //     hasChildren: false,
    // },
    // {
    //     id: 9,
    //     name: "Wallet",
    //     route: "user-panel/wallet",
    //     icon: <WalletRoundedIcon />,
    //     hasChildren: false,
    // },
    {
        id: 10,
        name: "Badge",
        route: "user-panel/badge",
        icon: <VerifiedIcon />,
        hasChildren: false,
    },
    {
        id: 11,
        name: "Privacy",
        route: "user-panel/privacy",
        icon: <ShieldIcon />,
        hasChildren: false,
    },
    {
        id: 12,
        name: "Certificate",
        route: "user-panel/certificate",
        icon: <BadgeIcon />,
        hasChildren: false,
    },
    {
        id: 13,
        name: "Invoice",
        route: "user-panel/invoice",
        icon: <ReceiptIcon />,
        hasChildren: false,
    },
    {
        id: 14,
        name: "Activities",
        route: "user-panel/activities",
        icon: <TimelineIcon />,
        hasChildren: false,
    },
    {
        id: 15,
        name: "Coupons List",
        route: "user-panel/coupons-list",
        icon: <RecentActorsIcon />,
        hasChildren: false,
    },
    {
        id: 16,
        name: "Student Invite",
        route: "user-panel/student-invite",
        icon: <MediationIcon />,
        hasChildren: false,
    },
    {
        id: 17,
        name: "Delete Account",
        route: "user-panel/delete-account",
        icon: <DeleteIcon />,
        hasChildren: false,
    },
    {
        id: 18,
        name: "Tickets",
        route: "user-panel/tickets",
        icon: <ConfirmationNumberIcon />,
        hasChildren: false,
    },
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

const DrawerHeader = styled("div")(({ theme }) => ({
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
})<AppBarProps>(({ theme, open }) => ({
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
})(({ theme, open }) => ({
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

interface Props {
    /**
     * Injected by the documentation to work in an iframe.
     * You won't need it on your project.
     */
    window?: () => Window;
}

export default function Panel(props: Props) {
    const theme = useTheme();
    const [open, setOpen] = React.useState(false);

    const data = useSelector(state => state.information);

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

    const handleLogout = async () => {
        const response = await axios.post(route("logout"));
        // @ts-ignore
        document.location.href = import.meta.env.VITE_APP_URL;
    }
    const handleMobileMenuOpen = (event: React.MouseEvent<HTMLElement>) => {
        setMobileMoreAnchorEl(event.currentTarget);
    };

    const menuId = "primary-search-account-menu";

    const mobileMenuId = "primary-search-account-menu-mobile";

    const [anchorEl2, setAnchorEl2] = React.useState<null | HTMLElement>(null);
    const open2 = Boolean(anchorEl2);
    const handleClick2 = (event: React.MouseEvent<HTMLElement>) => {
        setAnchorEl2(event.currentTarget);
    };
    const handleClose2 = async () => {
        setAnchorEl2(null);
    };

    const { window } = props;
    const [mobileOpen, setMobileOpen] = React.useState(false);

    const handleDrawerToggle = () => {
        setMobileOpen(!mobileOpen);
    };

    const drawer = (
        <div>
            <Toolbar />
            <Divider />
            <List>
                {["Inbox", "Starred", "Send email", "Drafts"].map(
                    (text, index) => (
                        <ListItem key={text} disablePadding>
                            <ListItemButton>
                                <ListItemIcon>
                                    {index % 2 === 0 ? (
                                        <InboxIcon />
                                    ) : (
                                        <MailIcon />
                                    )}
                                </ListItemIcon>
                                <ListItemText primary={text} />
                            </ListItemButton>
                        </ListItem>
                    )
                )}
            </List>
            <Divider />
            <List>
                {["All mail", "Trash", "Spam"].map((text, index) => (
                    <ListItem key={text} disablePadding>
                        <ListItemButton>
                            <ListItemIcon>
                                {index % 2 === 0 ? <InboxIcon /> : <MailIcon />}
                            </ListItemIcon>
                            <ListItemText primary={text} />
                        </ListItemButton>
                    </ListItem>
                ))}
            </List>
        </div>
    );

    const container =
        window !== undefined ? () => window().document.body : undefined;

    return (
        <Box
            className="scrollbar"
            sx={{
                display: "flex",
                flexDirection: "column",
                maxHeight: "100vh",
                height: "100vh",
                overflow: "auto",
            }}
        >
            <CssBaseline />
            <AppBar
                sx={{
                    bgcolor: "primary.main",
                    display: "flex",
                    flexGrow: 0,
                    height: "55px",
                    overflow: "hidden",
                }}
                position="sticky"
                open={open}
            >
                <Toolbar>
                    <IconButton
                        size="large"
                        edge="start"
                        onClick={handleDrawerOpen}
                        color="inherit"
                        aria-label="open drawer"
                        sx={{
                            marginRight: 0,
                            ...(open && { display: "none" }),
                        }}
                    >
                        <MenuIcon />
                    </IconButton>
                    <Link
                        sx={{...(open && { display: "none" }), ml: 1, mt: 0.75,}} href={import.meta.env.VITE_APP_URL}>
                        <img width={"65%"} height={"auto"} src={LOGO} alt="Logo"/>
                    </Link>
                    <Box sx={{ flexGrow: 1 }} />
                    <Box sx={{ display: { xs: "none", md: "flex" } }}>
                        <Tooltip title="Notifications">
                            <Button
                                size="large"
                                aria-label="show 17 new notifications"
                                color="inherit"
                            >
                                <Badge badgeContent={17} color="error">
                                    <NotificationsIcon />
                                </Badge>
                            </Button>
                        </Tooltip>
                        <Tooltip title="Account settings">
                            <Button
                                onClick={handleClick2}
                                size="large"
                                aria-label="show 17 new notifications"
                                color="inherit"
                                aria-controls={
                                    open2 ? "account-menu" : undefined
                                }
                                aria-haspopup="true"
                                aria-expanded={open2 ? "true" : undefined}
                            >
                                <Avatar sx={{ width: 32, height: 32, mr: 1 }} src={import.meta.env.VITE_APP_URL + `/storage/users/profile/${data.profile_picture}`}>
                                </Avatar>
                                <Typography sx={{ textTransform: "capitalize" }}>
                                    {data.firstName} {data.lastName}
                                </Typography>
                                <ArrowDropDownIcon />
                            </Button>
                        </Tooltip>
                        <Menu
                            anchorEl={anchorEl2}
                            id="account-menu"
                            open={open2}
                            onClose={handleClose2}
                            onClick={handleClose2}
                            PaperProps={{
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
                                        content: '""',
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
                            }}
                            transformOrigin={{
                                horizontal: "right",
                                vertical: "top",
                            }}
                            anchorOrigin={{
                                horizontal: "right",
                                vertical: "bottom",
                            }}
                        >
                            <Link href={route("profile", {user: data.slug})}>
                            <MenuItem onClick={handleClose2}>
                                <Avatar src={import.meta.env.VITE_APP_URL + `/storage/users/profile/${data.profile_picture}`}/> Profile
                            </MenuItem>
                            </Link>
                            <Divider />
                            <MenuItem onClick={handleClose2}>
                                <ListItemIcon>
                                    <Settings fontSize="small" />
                                </ListItemIcon>
                                Settings
                            </MenuItem>
                            <MenuItem onClick={handleClose2} onMouseDown={handleLogout}>
                                <ListItemIcon>
                                    <Logout fontSize="small" />
                                </ListItemIcon>
                                Logout
                            </MenuItem>
                        </Menu>
                        <FormControl
                            sx={{
                                backgroundColor: "transparent",
                                border: 0,
                                p: 0,
                                borderColor: "",

                                "& span span": {
                                    display: "none",
                                },
                            }}
                            size="small"
                        >
                            <Select
                                sx={{
                                    border: 0,
                                    p: 0,
                                    textAlign: "center",
                                    boxShadow: "none",
                                    ".MuiOutlinedInput-notchedOutline": {
                                        border: 0,
                                    },
                                    "& .MuiSvgIcon-root": { color: "#fff" },
                                }}
                                defaultValue={"EN"}
                                inputProps={{
                                    "aria-label": "Without label",
                                }}
                            >
                                <MenuItem
                                    sx={{ placeContent: "center" }}
                                    value="EN"
                                >
                                    <Tooltip title="EN" placement="left">

                                        <img src={USA} alt="EN" />
                                        <Typography
                                            component="span"
                                            variant="body2"
                                            sx={{ ml: 1 }}
                                        >
                                            EN
                                        </Typography>
                                    </Tooltip>
                                </MenuItem>
                                <MenuItem
                                    sx={{ placeContent: "center" }}
                                    value="FR"
                                >
                                    <Tooltip title="FR" placement="left">
                                        <img src={FRANCE} alt="FR" />
                                        <Typography
                                            component="span"
                                            variant="body2"
                                            sx={{ ml: 1 }}
                                        >
                                            FR
                                        </Typography>
                                    </Tooltip>
                                </MenuItem>
                                <MenuItem
                                    sx={{ placeContent: "center" }}
                                    value="IR"
                                >
                                    <Tooltip title="IR" placement="left">
                                        <img src={IRAN} alt="IR" />
                                        <Typography
                                            component="span"
                                            variant="body2"
                                            sx={{ ml: 1 }}
                                        >
                                            IR
                                        </Typography>
                                    </Tooltip>
                                </MenuItem>
                            </Select>
                        </FormControl>
                    </Box>
                    <Box
                        sx={{
                            display: { xs: "flex", md: "none" },
                            bgcolor: "blue-green",
                        }}
                    >
                        <IconButton
                            size="large"
                            aria-label="show more"
                            aria-controls={mobileMenuId}
                            aria-haspopup="true"
                            onClick={handleMobileMenuOpen}
                            color="inherit"
                        >
                            <MoreIcon />
                        </IconButton>
                    </Box>
                </Toolbar>
            </AppBar>
            <Box
                className="scrollbar"
                sx={{
                    display: "flex",
                    flexDirection: "row",
                    flexGrow: 1,
                    height: "auto",
                    overflow: "auto",
                }}
            >
                <Drawer
                    container={container}
                    variant="temporary"
                    open={mobileOpen}
                    onClose={handleDrawerToggle}
                    ModalProps={{
                        keepMounted: true, // Better open performance on mobile.
                    }}
                    sx={{
                        display: { xs: "block", sm: "none" },
                        "& .MuiDrawer-paper": {
                            boxSizing: "border-box",
                            width: drawerWidth,
                        },
                    }}
                >
                    {drawer}
                </Drawer>
                <Drawer variant="permanent" open={open} sx={{}}>
                    <DrawerHeader
                        sx={{
                            display: "flex",
                            backgroundColor: "primary.main",
                        }}
                    >
                        <Box>
                            <Link href="www.landatrip.com">
                                <img width="170px" src={LOGO} alt="Logo" />
                            </Link>
                        </Box>
                        <IconButton
                            sx={{ color: "#ffffff" }}
                            onClick={handleDrawerClose}
                        >
                            {theme.direction === "rtl" ? (
                                <ChevronRightIcon />
                            ) : (
                                <ChevronLeftIcon />
                            )}
                        </IconButton>
                    </DrawerHeader>
                    <List
                        className="scrollbar"
                        sx={{
                            backgroundColor: "primary.main",
                            height: "#100%",
                            flexGrow: 1,
                            overflowX: "hidden",
                        }}
                    >
                        {drawerItems.map((item) => (
                            <Tooltip
                                key={item.id}
                                title={item.name}
                                placement="right"
                            >
                                <ListItem
                                    disablePadding
                                    sx={{ display: "block" }}
                                >
                                    <ListItemButton
                                        component={LinkReact}
                                        to={item.route}
                                        sx={{
                                            minHeight: 48,
                                            justifyContent: open
                                                ? "initial"
                                                : "center",
                                            px: 2.5,
                                            color: "#ffffff",
                                        }}
                                    >
                                        <ListItemIcon
                                            sx={{
                                                minWidth: 0,
                                                mr: open ? 3 : "auto",
                                                justifyContent: "center",
                                                color: "#ffffff",
                                            }}
                                        >
                                            {item.icon}
                                        </ListItemIcon>
                                        <ListItemText
                                            primary={item.name}
                                            sx={{ opacity: open ? 1 : 0 }}
                                        />
                                    </ListItemButton>
                                </ListItem>
                            </Tooltip>
                        ))}
                    </List>
                </Drawer>
                <Box
                    component="main"
                    sx={{
                        display: "flex",
                        flexGrow: 1,
                        flexDirection: "column",
                        p: 0,
                    }}
                >
                    <Contents />
                </Box>
            </Box>
        </Box>
    );
}
