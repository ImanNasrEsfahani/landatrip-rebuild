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
    Grid,
    TableHead,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableRow,
    tableCellClasses,
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
import PersonOutlineOutlinedIcon from "@mui/icons-material/PersonOutlineOutlined";
import FormatAlignLeftOutlinedIcon from "@mui/icons-material/FormatAlignLeftOutlined";
import FormatListBulletedOutlinedIcon from "@mui/icons-material/FormatListBulletedOutlined";
import CalendarTodayOutlinedIcon from "@mui/icons-material/CalendarTodayOutlined";
import EditOutlinedIcon from "@mui/icons-material/EditOutlined";
import DeleteOutlineOutlinedIcon from "@mui/icons-material/DeleteOutlineOutlined";
import TextSnippetOutlinedIcon from '@mui/icons-material/TextSnippetOutlined';

// import USA from "../assets/usa.png";
// import IRAN from "../assets/iran.png";
// import FRANCE from "../assets/france.png";
// import LOGO from "../assets/LogoSVG.svg";
// import ProfilePic from "../assets/profilePic.png";
import PDF from "../../../components/assets/pdf.svg"
import JPEG from "../../../components/assets/jpeg.svg"
import PNG from "../../../components/assets/png.svg"

    const StyledTableCell = styled(TableCell)(({ theme }) => ({
        [`&.${tableCellClasses.head}`]: {
            backgroundColor: "primary.main",
            color: "primary.main",
        },
        [`&.${tableCellClasses.body}`]: {
            fontSize: 14,
        },
    }));

    const StyledTableRow = styled(TableRow)(({ theme }) => ({
      '&:nth-of-type(odd)': {
        backgroundColor: "#fafafa",
      },
      '&:nth-of-type(even)': {
        backgroundColor: "#EAEEF3",
      },
      '&:last-child td, &:last-child th': {
        border: 0,
      },
    }));

    function createData(
        Type: any,
        Title: string,
        date: string,
        Status: string,
        Update: React.ReactNode,
        Remove: React.ReactNode
    ) {
        return { date, Title, Type, Status, Update, Remove };
    }

    const backgroundColors = (status) => {
        let backgroundColor = "";
        if (status === "Verified") backgroundColor = "primary.30";
        else if (status === "In Progress") backgroundColor = "primary.20";
        else backgroundColor = "orange.30";
        return backgroundColor;
    };

    const removeIconDisable = (status) => {
        if (status !== "In Progress") return true;
    };

    const rows = [
        createData(
            <img src={PDF}/>,
            "Landa1",
            "2023/oct",
            "Verified",
            <TextSnippetOutlinedIcon />,
            <DeleteOutlineOutlinedIcon />
        ),
        createData(
            <img src={JPEG}/>,
            "Landa2",
            "2023/oct",
            "In Progress",
            <TextSnippetOutlinedIcon />,
            <DeleteOutlineOutlinedIcon />
        ),
        createData(
            <img src={PNG}/>,
            "Landa3",
            "2023/oct",
            "Rejected",
            <TextSnippetOutlinedIcon />,
            <DeleteOutlineOutlinedIcon />
        ),
        createData(
            <img src={PNG}/>,
            "Landa4",
            "2023/oct",
            "Verified",
            <TextSnippetOutlinedIcon />,
            <DeleteOutlineOutlinedIcon />
        ),
        createData(
            <img src={PDF}/>,
            "Landa5",
            "2023/oct",
            "Rejected",
            <TextSnippetOutlinedIcon />,
            <DeleteOutlineOutlinedIcon />
        ),
    ];




    export default function AccountInfoDocuments() {
        const divRef = React.useRef(null);
        const [paddingRight, setPaddingRight] = React.useState("");


        // -----------scroll bar ------------
        React.useEffect(() => {
            if (divRef.current) {
                const clientHeight = divRef.current.clientHeight;
                if (clientHeight <= 423) {
                    setPaddingRight("9px");
                } else {
                    setPaddingRight("0px");
                }
            }
        });
        // -----------end scroll bar ------------

    return (
        <>
            <Container>
                <Box sx={{ mx: 7.5 }}>
                    <Box
                        sx={{
                            borderRadius: 1,
                            mt: 5,
                            py: 2.5,
                        }}
                    >
                        <Box
                            sx={{
                                borderLeft: 3,
                                borderColor: "primary.main",
                                ml: 1,
                            }}
                        >
                            <Typography
                                sx={{ ml: 1 }}
                                fontWeight="bold"
                                color="primary.main"
                                variant="h6"
                            >
                                Insert New
                            </Typography>
                        </Box>
                        <Box component={"form"} sx={{ mt: 5 }}>
                            <Grid container columnSpacing={10} rowSpacing={4}>
                                <Grid item xs={12} md={6}>
                                    <TextField
                                        id="documentName"
                                        label="Document Name"
                                        variant="outlined"
                                        size="small"
                                        fullWidth
                                    />
                                </Grid>
                                <Grid item xs={12} md={6}>
                                    <Box>
                                        <TextField
                                            id="uploadFile"
                                            label="Upload File"
                                            variant="outlined"
                                            size="small"
                                            fullWidth
                                        />
                                        {/* <Box textAlign="center">
                                        <Button
                                            sx={{
                                                borderColor: "orange.main",
                                                backgroundColor: "orange.main",
                                                px: 7.5,
                                                mb: 5,
                                            }}
                                            variant="contained"
                                        >
                                            Save
                                        </Button>
                                    </Box> */}
                                    </Box>
                                </Grid>
                            </Grid>
                            <Box textAlign="center">
                                <Button
                                    sx={{
                                        borderColor: "orange.main",
                                        backgroundColor: "orange.main",
                                        px: 7.5,
                                        my: 5,
                                    }}
                                    variant="contained"
                                >
                                    Upload
                                </Button>
                            </Box>
                        </Box>
                    </Box>
                    <Box
                        sx={{
                            backgroundColor: "#6C757D",
                            borderRadius: "15px",
                            overflow: "hidden",
                            paddingLeft: "9px",
                            paddingRight : paddingRight
                        }}
                    >
                        <TableContainer 
                             className="scrollbarInputs"
                             ref={divRef}
                            
                             sx={{
                                 
                                 overflowY: "auto",
                                 maxHeight: "60vh",
                             }}
                        >
                            <Table
                                stickyHeader
                                // sx={{ minWidth: 700, mt: 3 ,borderRadius:5, overflow:'hidden' }}
                                aria-label="customized table"
                            >
                                <TableHead
                                    // sx={{ backgroundColor: "gray.main",}}
                                >
                                    <TableRow >
                                        <StyledTableCell
                                              sx={{
                                                borderColor: "primary.main",
                                                width: "auto",
                                                bgcolor : "gray.main"
                                            }}
                                            align="center"
                                        >
                                            <Typography
                                                color="white"
                                                sx={{
                                                    display: "flex",
                                                    flexDirection: "row",
                                                    justifyContent: "center",
                                                    alignItems: "center",
                                                }}
                                            >
                                                Type
                                            </Typography>
                                        </StyledTableCell>
                                        <StyledTableCell
                                               sx={{
                                                borderColor: "primary.main",
                                                width: "auto",
                                                bgcolor : "gray.main"
                                            }}
                                        >
                                            <Typography
                                                color="white"
                                                sx={{
                                                    display: "flex",
                                                    flexDirection: "row",
                                                    justifyContent: "left",
                                                    alignItems: "left",
                                                }}
                                            >
                                                Document Name
                                            </Typography>
                                        </StyledTableCell>
                                        <StyledTableCell
                                              sx={{
                                                borderColor: "primary.main",
                                                width: "auto",
                                                bgcolor : "gray.main"
                                            }}
                                            align="center"
                                        >
                                            <Typography
                                                color="white"
                                                sx={{
                                                    display: "flex",
                                                    flexDirection: "row",
                                                    justifyContent: "center",
                                                    alignItems: "center",
                                                }}
                                            >
                                                Date
                                            </Typography>
                                        </StyledTableCell>
                                        <StyledTableCell
                                           sx={{
                                            borderColor: "primary.main",
                                            width: "auto",
                                            bgcolor : "gray.main"
                                        }}
                                            align="center"
                                        >
                                            <Typography
                                                color="white"
                                                sx={{
                                                    display: "flex",
                                                    flexDirection: "row",
                                                    justifyContent: "center",
                                                    alignItems: "center",
                                                }}
                                            >
                                                Status
                                            </Typography>
                                        </StyledTableCell>
                                        <StyledTableCell
                                             sx={{
                                                borderColor: "primary.main",
                                                width: "auto",
                                                bgcolor : "gray.main"
                                            }}
                                            align="center"
                                        >
                                            <Typography
                                                color="white"
                                                sx={{
                                                    display: "flex",
                                                    flexDirection: "row",
                                                    justifyContent: "center",
                                                    alignItems: "center",
                                                }}
                                            >
                                                Update/Remove
                                            </Typography>
                                        </StyledTableCell>
                                    </TableRow>
                                </TableHead>
                                <TableBody>
                                    {rows.map((row) => (
                                        <StyledTableRow
                                            sx={{
                                                borderColor: "primary.main",
                                            }}
                                            key={row.date}
                                        >
                                            <StyledTableCell
                                                sx={{
                                                    borderColor: "primary.main",
                                                }}
                                                align="center"
                                            >
                                                {row.Type}
                                            </StyledTableCell>
                                            <StyledTableCell
                                                sx={{
                                                    borderColor: "primary.main",
                                                }}
                                                align="left"
                                            >
                                                {row.Title}
                                            </StyledTableCell>
                                            <StyledTableCell
                                                sx={{
                                                    borderColor: "primary.main",
                                                }}
                                                align="center"
                                            >
                                                {row.date}
                                            </StyledTableCell>
                                            <StyledTableCell
                                                sx={{
                                                    borderColor: "primary.main",
                                                }}
                                                align="center"
                                            >
                                                <Box>
                                                    <Typography
                                                        sx={{
                                                            backgroundColor:
                                                                backgroundColors(
                                                                    row.Status
                                                                ),
                                                            padding: 0.3,
                                                            width: "75%",
                                                            margin: "auto",
                                                            borderRadius: 10,
                                                        }}
                                                        align="center"
                                                    >
                                                        {row.Status}
                                                    </Typography>
                                                </Box>
                                            </StyledTableCell>
                                            <StyledTableCell
                                                sx={{
                                                    borderColor: "primary.main",
                                                }}
                                                align="center"
                                            >
                                                <IconButton
                                                    sx={{
                                                        color: "primary.main",
                                                    }}
                                                >
                                                    {row.Update}
                                                </IconButton>
                                                {removeIconDisable(
                                                    row.Status
                                                ) ? (
                                                    <IconButton
                                                        disabled
                                                    >
                                                        {row.Remove}
                                                    </IconButton>
                                                ) : (
                                                    <IconButton
                                                        sx={{
                                                            color: "orange.main",
                                                        }}
                                                    >
                                                        {row.Remove}
                                                    </IconButton>
                                                )}
                                            </StyledTableCell>
                                        </StyledTableRow>
                                    ))}
                                </TableBody>
                            </Table>
                        </TableContainer>
                    </Box>
                </Box>
            </Container>
        </>
    );
}
