import * as React from "react";
import {styled} from "@mui/material/styles";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import customTheme from "./../../../custom";
import {useState} from "react";
import {
    Container,
    TableHead,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableRow,
    tableCellClasses,
    Button,
    Skeleton,
} from "@mui/material";
import AssignmentIcon from "@mui/icons-material/Assignment";
import DeleteIcon from "@mui/icons-material/Delete";
import {Link as LinkReact} from "react-router-dom";
import CreateIcon from "@mui/icons-material/Create";

const StyledTableCell = styled(TableCell)(({theme}) => ({
    [`&.${tableCellClasses.head}`]: {
        backgroundColor: "primary.main",
        color: "primary.main",
    },
    [`&.${tableCellClasses.body}`]: {
        fontSize: 14,
    },
}));

const StyledTableRow = styled(TableRow)(({theme}) => ({
    "&:nth-of-type(odd)": {
        backgroundColor: "#fafafa",
    },
    "&:nth-of-type(even)": {
        backgroundColor: "#EAEEF3",
    },
    "&:last-child td, &:last-child th": {
        border: 0,
    },
}));

function createData(
    Link: string,
    Date: string,
    Status: string,
    EditDelete: string
) {
    return {Link, Date, Status, EditDelete};
}

const backgroundColors = (status) => {
    let backgroundColor = "";
    if (status === "Used") backgroundColor = "primary.20";
    else backgroundColor = "orange.30";
    return backgroundColor;
};

const textColors = (Status) => {
    let color = "";
    if (Status === "Used") color = "primary.50";
    else color = "orange.70";
    return color;
};
const removeIconDisable = (status) => {
    if (status !== "") return true;
};

const rows = [
    createData("link", "5 days ago", "Used", ""),
    createData("link", "5 days ago", "Used", ""),
    createData("link", "5 days ago", "Used", ""),
    createData("link", "5 days ago", "not Used", ""),
    createData("link", "5 days ago", "Used", ""),
];

export default function StudentInvite() {
    const [paddingRight, setPaddingRight] = useState("");
    const divRef = React.useRef(null);
    const [skeleton, setSkeleton] = useState(true);
    const handleColor = (chip): "default" | "primary" => {
        if (chip.select == true) {
            return "primary";
        } else return "default";
    };

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

    const handleVariant = (chip): "filled" | "outlined" => {
        if (chip.select) {
            return "filled";
        } else return "outlined";
    };

    return (
        <>
            <Container>
                <Box mb={10}>
                    <Typography
                        sx={{
                            ml: 1,
                            borderLeft: 3,
                            borderColor: "primary.main",
                            my: 5,
                            pl: 1,
                        }}
                        fontWeight="bold"
                        color="primary.main"
                        variant="h3"
                    >
                        Student Invite
                    </Typography>
                    <Typography variant="h4" my={2}>
                        Invite your friends
                    </Typography>
                    <Typography variant="h6">
                        Invite your friends to
                        <Typography
                            variant="h6"
                            component={"span"}
                            mx={1}
                            color="orange.main"
                        >
                            Landa Trip
                        </Typography>{" "}
                        and get bonnes per each invitation . we have a great
                        time together.
                    </Typography>
                    <Button
                        sx={{
                            mt: 5,
                            borderColor: "orange.main",
                            backgroundColor: "orange.main",
                            px: 8,
                            display: "block",
                            mx: "auto",
                            width: "fit-content",
                        }}
                        variant="contained"
                    >
                        Generate link
                    </Button>
                    <Box
                        sx={{
                            display: "flex",
                            justifyContent: "center",
                            mt: 5,
                            gap: 5,
                        }}
                    >
                        <Box
                            sx={{
                                display: "flex",
                                alignItems: "center",
                                justifyContent: "center",
                                gap: 5,
                            }}
                        >
                            <Typography variant="h6">invited :</Typography>
                            <Typography
                                variant="h6"
                                color="white"
                                sx={{
                                    backgroundColor: "primary.main",
                                    borderRadius: 4,
                                    px: 3,
                                }}
                            >
                                300
                            </Typography>
                        </Box>
                        <Box
                            sx={{
                                display: "flex",
                                alignItems: "center",
                                justifyContent: "center",
                                gap: 5,
                            }}
                        >
                            <Typography variant="h6">
                                bonus received :
                            </Typography>
                            <Typography
                                variant="h6"
                                color="white"
                                sx={{
                                    backgroundColor: "primary.main",
                                    borderRadius: 4,
                                    px: 3,
                                }}
                            >
                                300
                            </Typography>
                        </Box>
                    </Box>

                    <Box
                        sx={{
                        marginTop : "15px",
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
                                // sx={{
                                //     minWidth: 700,
                                //     mt: 3,
                                //     borderRadius: 5,
                                //     overflow: "hidden",
                                // }}
                                aria-label="customized table"
                            >
                                <TableHead >
                                    <TableRow
                                        
                                    >
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
                                                    justifyContent: "center",
                                                    alignItems: "center",
                                                }}
                                            >
                                                Link
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
                                                Edit / Delete
                                            </Typography>
                                        </StyledTableCell>
                                    </TableRow>
                                </TableHead>
                                <TableBody>
                                    {rows.map((row) => (
                                        <StyledTableRow
                                            key={row.Link}
                                            sx={{textDecoration: "none"}}
                                        >
                                            <StyledTableCell sx={{textAlign: "center"}}>
                                                {skeleton ? (
                                                    row.Link
                                                ) : (
                                                    <Skeleton
                                                        variant="rectangular"
                                                        animation="wave"
                                                        width="70%"
                                                        height="35px"
                                                        sx={{
                                                            margin: "auto",
                                                            borderRadius:
                                                                "25px",
                                                        }}
                                                    />
                                                )}
                                            </StyledTableCell>
                                            <StyledTableCell sx={{textAlign: "center"}}>
                                                {skeleton ? (
                                                    row.Date
                                                ) : (
                                                    <Skeleton
                                                        variant="rectangular"
                                                        animation="wave"
                                                        width="70%"
                                                        height="35px"
                                                        sx={{
                                                            margin: "auto",
                                                            borderRadius:
                                                                "25px",
                                                        }}
                                                    />
                                                )}
                                            </StyledTableCell>
                                            <StyledTableCell sx={{textAlign: "center"}}>
                                                <Box>
                                                    {skeleton ? (
                                                        <Typography
                                                            sx={{
                                                                backgroundColor:
                                                                    backgroundColors(
                                                                        row.Status
                                                                    ),
                                                                color: textColors(
                                                                    row.Status
                                                                ),
                                                                width: "60%",
                                                                margin: "auto",
                                                                borderRadius: 10,
                                                            }}

                                                        >
                                                            {row.Status}
                                                        </Typography>
                                                    ) : (
                                                        <Skeleton
                                                            variant="rectangular"
                                                            animation="wave"
                                                            width="70%"
                                                            height="35px"
                                                            sx={{
                                                                margin: "auto",
                                                                borderRadius:
                                                                    "25px",
                                                            }}
                                                        />
                                                    )}
                                                </Box>
                                            </StyledTableCell>
                                            <StyledTableCell
                                                sx={{
                                                    display: "flex",
                                                    justifyContent: "center",
                                                    gap: 5,
                                                }}

                                            >
                                                {skeleton ? (
                                                    <CreateIcon
                                                        sx={{color: "black"}}
                                                    />
                                                ) : (
                                                    <Skeleton
                                                        variant="rectangular"
                                                        animation="wave"
                                                        width="45px"
                                                        height="35px"
                                                        sx={{
                                                            borderRadius:
                                                                "25px",
                                                        }}
                                                    />
                                                )}
                                                {skeleton ? (
                                                    <DeleteIcon
                                                        sx={{
                                                            color: "orange.main",
                                                        }}
                                                    />
                                                ) : (
                                                    <Skeleton
                                                        variant="rectangular"
                                                        animation="wave"
                                                        width="45px"
                                                        height="35px"
                                                        sx={{
                                                            borderRadius:
                                                                "25px",
                                                        }}
                                                    />
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
