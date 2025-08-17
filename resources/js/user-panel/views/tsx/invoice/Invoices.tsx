import * as React from "react";
import {styled} from "@mui/material/styles";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import customTheme from "./../../../custom";
import {useRef, useState} from 'react';
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

import {route} from "../../../helpers";
import axios from "../../../../axiosConfig"
import {useInfiniteQuery} from "react-query";
import {logger} from "react-query/types/react/logger";
import TableSkeleton from "../../../components/TableSkeleton";

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

export default function Invoices() {
    const divRef = useRef(null);
    const [loading, setLoading] = useState(false);
    const [paddingRight, setPaddingRight] = useState("");

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

    const invoiceRecords = async (pageSize, pageIndex) => {
        const response = await axios.get(route("api.web.v1.user-panel.invoices.index", {}, pageIndex, pageSize));
        return response.data
    }
    const {
            data,
            isLoading,
            isError,
            fetchNextPage,
            hasNextPage,
            ...result
        } = useInfiniteQuery(
            "invoiceRecords",
            ({pageParam = 1}) => invoiceRecords(pageParam, 15),
            {
                getNextPageParam: (lastPage) => {
                    const {meta} = lastPage;
                    if (meta.current_page < meta.last_page) {
                        return meta.current_page + 1;
                    }
                    return null;
                }
            }
        )
    ;

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

    function handleScroll() {
        if (data) {
            const {scrollTop, scrollHeight, clientHeight} = divRef.current;
            const scrollEndPosition = scrollHeight - clientHeight;
            if (scrollEndPosition - scrollTop < 1 && hasNextPage) {
                setLoading(true)
                fetchNextPage().then(r =>
                    setLoading(false)
                );
            }
        }
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
                            onScroll={handleScroll}
                            sx={{
                                
                                overflowY: "auto",
                                maxHeight: "60vh",
                            }}
                        >
                            <Table
                                stickyHeader
                                // sx={{minWidth: 700, mt: 3, borderRadius: 5, overflow: 'hidden'}}
                                aria-label="customized caption table">
                                <TableHead
                                    >
                                    <TableRow >
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
                                                IP
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
                                                Created Date
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
                                                Expire Date
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
                                                Total
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
                                    </TableRow>
                                </TableHead>
                                <TableBody>
                                    {/*{console.log(isLoading)}*/}
                                    {isLoading ? (
                                        <TableSkeleton cel={5}/>
                                    ) : data?.pages[0].data.length > 0 ? (
                                            data?.pages.map((page, pageIndex) => (
                                                <React.Fragment key={pageIndex}>
                                                    {page.data.map((value, key) => (
                                                        <StyledTableRow
                                                            key={key}
                                                            sx={{textDecoration: "none"}}
                                                        >
                                                            <StyledTableCell
                                                                align="center"
                                                            >
                                                                {value.IP}
                                                            </StyledTableCell>
                                                            <StyledTableCell

                                                                align="center"
                                                            >
                                                                {value.CreatedDate}
                                                            </StyledTableCell>
                                                            <StyledTableCell
                                                                align="center"
                                                            >
                                                                {value.ExpireDate}
                                                            </StyledTableCell>
                                                            <StyledTableCell
                                                                align="center"
                                                            >
                                                                {value.Total}
                                                            </StyledTableCell>
                                                            <StyledTableCell
                                                                align="center"
                                                            >
                                                                <Typography
                                                                    sx={{
                                                                        backgroundColor:
                                                                            backgroundColors(
                                                                                value.Status
                                                                            ),
                                                                        color: textColors(
                                                                            value.Status
                                                                        ),
                                                                        width: "75%",
                                                                        margin: "auto",
                                                                        borderRadius: 10,
                                                                    }}
                                                                    align="center"
                                                                >
                                                                    {value.Status}
                                                                </Typography>
                                                            </StyledTableCell>
                                                        </StyledTableRow>
                                                    ))}
                                                </React.Fragment>
                                            ))) :
                                        (<StyledTableRow
                                                sx={{py: 5, textAlign: "center"}}
                                            >
                                                <StyledTableCell
                                                    colSpan={5}
                                                    align="center"
                                                >
                                                    No Data
                                                </StyledTableCell>

                                            </StyledTableRow>
                                        )
                                    }
                                </TableBody>
                            </Table>
                        </TableContainer>
                    </Box>
                </Box>
            </Container>
        </>
    );
}
