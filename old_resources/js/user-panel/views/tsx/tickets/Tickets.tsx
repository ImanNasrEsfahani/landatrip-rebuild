import * as React from "react";
import {styled} from "@mui/material/styles";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import {useRef, useState} from 'react';
import {
    Container,
    TableHead,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableRow,
    tableCellClasses, Button,
} from "@mui/material";
import axios from "../../../../axiosConfig";
import {route} from "../../../helpers";
import {useInfiniteQuery} from "react-query";
import TableSkeleton from "../../../components/TableSkeleton";
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

export default function Tickets() {
    const [paddingRight, setPaddingRight] = useState("");
    const divRef = useRef(null);
    const [loading, setLoading] = useState(false);


//api
    const ticketsRecords = async (pageIndex, pageSize) => {
        const response = await axios.get(route("api.web.v1.user-panel.ticket.index", {}, pageIndex, pageSize));
        return response.data;
    };
    const {
        data,
        fetchNextPage,
        hasNextPage,
        isError,
        error,
        isLoading
    } = useInfiniteQuery('ticketsRecords', ({pageParam = 1}) => ticketsRecords(pageParam, 15), {
        getNextPageParam: (lastPage) => {
            const {meta} = lastPage;
            if (meta.current_page < meta.last_page) {
                return meta.current_page + 1;
            }
            return null;
        }
    });

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

    const backgroundColors = (Status) => {
        let backgroundColor = "";
        if (Status === "1") backgroundColor = "primary.30";
        else if (Status === "0") backgroundColor = "primary.20";
        else backgroundColor = "orange.30";
        return backgroundColor;
    };

    const textColors = (Status) => {
        let color = "";
        if (Status === "1") color = "primary.50";
        else if (Status === "2") color = "white";
        else color = "black";
        return color;
    };

    const renderSwitchStatus = (Status) => {
        switch (Status) {
            case "0":
                return "new";
            case "1":
                return "pending";
            case "2":
                return "answered";
            case "3":
                return "rating";
            default:
                return "closed";
        }
    };

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
                    <Box sx={{display: "flex", justifyContent: "space-between"}}>
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
                            Tickets
                        </Typography>
                        <Button
                            sx={{
                                mt:6,
                                borderColor: "orange.main",
                                backgroundColor: "orange.main",
                                px: 5,
                                width: "fit-content",
                            }}
                            variant="contained"
                            component={LinkReact}
                            to="new-tickets"
                        >
                            New Tickets
                        </Button>
                    </Box>
                    <Box 
                          sx={{
                            marginTop : "15px",
                            backgroundColor: "#6C757D",
                            borderRadius: "15px",
                            overflow: "hidden",
                            paddingLeft: "9px",
                            paddingRight : paddingRight
                            // paddingRight : divRef.current?.clientHeight <= 423 ? "9px" : "0px"
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
                               
                            >
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
                                                Department
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
                                                Subject
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
                                                Time
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
                                    {/*{console.log(data)}*/}
                                    {isLoading ? (
                                        <TableSkeleton cel={4}/>
                                    ) : data?.pages[0].data.length > 0 ?
                                        data?.pages.map((page, pageIndex) => (
                                            <React.Fragment key={pageIndex}>
                                                {page.data.map((value, key) => (
                                                    <StyledTableRow
                                                        component={LinkReact}
                                                        sx={{textDecoration: "none"}}
                                                        to={`../tickets/${value.id}`}
                                                        key={key}
                                                    >
                                                        <StyledTableCell
                                                            align="center"
                                                        >
                                                            {value.title}
                                                        </StyledTableCell>
                                                        <StyledTableCell

                                                            align="center"
                                                        >
                                                            {value.priority}
                                                        </StyledTableCell>
                                                        <StyledTableCell
                                                            align="center"
                                                        >
                                                            {value.feedback}
                                                        </StyledTableCell>
                                                        <StyledTableCell align="center" sx={{width: "15%"}}>
                                                            <Box>
                                                                <Typography
                                                                    sx={{
                                                                        backgroundColor:
                                                                            backgroundColors(
                                                                                value.status
                                                                            ),
                                                                        color: textColors(
                                                                            value.status
                                                                        ),
                                                                        margin: "auto",
                                                                        borderRadius: 10,
                                                                    }}
                                                                    align="center"
                                                                >
                                                                    {renderSwitchStatus(
                                                                        value.status
                                                                    )}
                                                                </Typography>
                                                            </Box>
                                                        </StyledTableCell>


                                                    </StyledTableRow>
                                                ))}
                                            </React.Fragment>
                                        )) :
                                        (<StyledTableRow
                                                sx={{py: 5, textAlign: "center"}}
                                            >
                                                <StyledTableCell
                                                    colSpan={4}
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
