import * as React from "react";
import {styled} from "@mui/material/styles";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import customTheme from "./../../../custom";
import {useState} from 'react';
import {
    Container,
    TableHead,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableRow,
    tableCellClasses, Button, Skeleton
} from "@mui/material";
import AssignmentIcon from '@mui/icons-material/Assignment';
import DeleteIcon from '@mui/icons-material/Delete';
import {Link as LinkReact} from "react-router-dom";

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
    IP: string,
    CreatedDate: string,
    ExpireDate: string,
    Total: string,
    Status: string,
) {
    return {IP, CreatedDate, ExpireDate, Total, Status};
}

const backgroundColors = (Status) => {
    let backgroundColor = "";
    if (Status === "Paid") backgroundColor = "primary.20";
    else if (Status === "Unpaid") backgroundColor = "gray.main";
    else backgroundColor = "orange.30";
    return backgroundColor;
};

const textColors = (Status) => {
    let color = "";
    if (Status === "Paid") color = "primary.50";
    else if (Status === "Unpaid") color = "white";
    else color = "black";
    return color;
};

const removeIconDisable = (status) => {
    if (status !== "$870") return true;
};

const rows = [
    createData(
        "Invoice #2125",
        "2022/10/15",
        "5 days ago",
        "$870",
        "Paid"
    ),
    createData(
        "Invoice #2125",
        "2022/10/15",
        "5 days ago",
        "$870",
        "Paid"
    ),
    createData(
        "Invoice #2125",
        "2022/10/15",
        "5 days ago",
        "$870",
        "Expired"
    ),
    createData(
        "Invoice #2125",
        "2022/10/15",
        "5 days ago",
        "$870",
        "Unpaid"
    ),
    createData(
        "Invoice #2125",
        "2022/10/15",
        "5 days ago",
        "$870",
        "Unpaid"
    ),
];


export default function Invoices() {
    const [skeleton, setSkeleton] = useState(true);
    const handleColor = (chip): ("default" | "primary") => {
        if (chip.select == true) {
            return "primary"
        } else return "default"
    }

    const handleVariant = (chip): ("filled" | "outlined") => {
        if (chip.select) {
            return "filled"
        } else return "outlined"
    }

    return (
        <>
            <Container>
                <Box>
                    <Typography
                        sx={{
                            ml: 1, borderLeft: 3,
                            borderColor: "primary.main",
                            mt: 5,
                            pl: 1
                        }}
                        fontWeight="bold"
                        color="primary.main"
                        variant="h3"
                    >
                        Invoice
                    </Typography>
                    <Box>
                        <TableContainer sx={{borderRadius: 5, overflow: 'hidden', mt: 3}}>
                            <Table
                                sx={{minWidth: 700, mt: 3, borderRadius: 5, overflow: 'hidden'}}
                                aria-label="customized table"
                            >
                                <TableHead
                                    sx={{backgroundColor: "gray.main",}}
                                >
                                    <TableRow sx={{borderRadius: 5, width: "auto",}}>
                                        <StyledTableCell
                                            sx={{
                                                width: "auto",
                                                textAlign: "center"
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
                                                IP
                                            </Typography>
                                        </StyledTableCell>
                                        <StyledTableCell
                                            sx={{
                                                width: "auto",
                                                textAlign: "center"
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
                                                Created Date
                                            </Typography>
                                        </StyledTableCell>
                                        <StyledTableCell
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
                                                Expire Date
                                            </Typography>
                                        </StyledTableCell>
                                        <StyledTableCell
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
                                                Total
                                            </Typography>
                                        </StyledTableCell>
                                        <StyledTableCell
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
                                    </TableRow>
                                </TableHead>
                                <TableBody>
                                    {rows.map((row) => (
                                        <StyledTableRow
                                            key={row.IP}
                                            sx={{textDecoration: "none"}}
                                        >
                                            <StyledTableCell
                                                align="center"
                                            >
                                                {skeleton ? row.IP : (
                                                    <Skeleton variant="rectangular" animation="wave" width="70%"
                                                              height="35px" sx={{
                                                        margin: "auto",
                                                        borderRadius: "25px"
                                                    }}/>
                                                )}
                                            </StyledTableCell>
                                            <StyledTableCell

                                                align="center"
                                            >
                                                {skeleton ? row.CreatedDate : (
                                                    <Skeleton variant="rectangular" animation="wave" width="70%"
                                                              height="35px" sx={{
                                                        margin: "auto",
                                                        borderRadius: "25px"
                                                    }}/>
                                                )}
                                            </StyledTableCell>
                                            <StyledTableCell
                                                align="center"
                                            >
                                                {skeleton ? row.ExpireDate : (
                                                    <Skeleton variant="rectangular" animation="wave" width="70%"
                                                              height="35px" sx={{
                                                        margin: "auto",
                                                        borderRadius: "25px"
                                                    }}/>
                                                )}
                                            </StyledTableCell>
                                            <StyledTableCell
                                                align="center"
                                            >
                                                {skeleton ? row.Total : (
                                                    <Skeleton variant="rectangular" animation="wave" width="70%"
                                                              height="35px" sx={{
                                                        margin: "auto",
                                                        borderRadius: "25px"
                                                    }}/>
                                                )}
                                            </StyledTableCell>
                                            <StyledTableCell
                                                align="center"
                                            >
                                                {skeleton ? (<Typography
                                                    sx={{
                                                        backgroundColor:
                                                            backgroundColors(
                                                                row.Status
                                                            ),
                                                        color: textColors(
                                                            row.Status
                                                        ),
                                                        width: "75%",
                                                        margin: "auto",
                                                        borderRadius: 10,
                                                    }}
                                                    align="center"
                                                >
                                                    {row.Status}
                                                </Typography>) : (
                                                    <Skeleton variant="rectangular" animation="wave" width="70%"
                                                              height="35px" sx={{
                                                        margin: "auto",
                                                        borderRadius: "25px"
                                                    }}/>
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
