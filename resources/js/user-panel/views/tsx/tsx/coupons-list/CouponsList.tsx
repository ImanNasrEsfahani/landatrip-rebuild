import * as React from "react";
import {styled} from "@mui/material/styles";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import {useState} from 'react';
import {
    Container,
    TableHead,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableRow,
    tableCellClasses, Skeleton
} from "@mui/material";


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
    Title: string,
    Date: string,
    Status: string,
) {
    return {Title, Date, Status};
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
        "Think Strategically and Make",
        "2022/10/15",
        "Paid",
    ),
    createData(
        "IELTS, preparation course",
        "2022/10/15",
        "Expired",
    ),
    createData(
        "SEO, Tips and Tricks",
        "2022/10/15",
        "Expired",
    ),
    createData(
        "Christmas2022",
        "2022/10/15",
        "Unpaid",
    ),
    createData(
        "Christmas2022",
        "2022/10/15",
        "Unpaid",
    ),
];


export default function CouponsList() {
    const [skeleton, setSkeleton] = useState(true);
    const handleColor = (chTitle): ("default" | "primary") => {
        if (chTitle.select == true) {
            return "primary"
        } else return "default"
    }

    const handleVariant = (chTitle): ("filled" | "outlined") => {
        if (chTitle.select) {
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
                        Coupons List
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
                                                Title
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
                                                Date
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
                                            key={row.Title}
                                            sx={{textDecoration: "none"}}
                                        >
                                            <StyledTableCell
                                                align="center"
                                            >
                                                {skeleton ? row.Title : (
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
                                                {skeleton ? row.Date : (
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
                                                            width: "55%",
                                                            margin: "auto",
                                                            borderRadius: 10,
                                                        }}
                                                        align="center"
                                                    >
                                                        {row.Status}
                                                    </Typography>
                                                ) : (
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
