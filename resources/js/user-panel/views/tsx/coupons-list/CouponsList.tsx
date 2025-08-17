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
    tableCellClasses
} from "@mui/material";
import TableSkeleton from "../../../components/TableSkeleton";
import {useInfiniteQuery} from "react-query";
import axios from "../../../../axiosConfig";
import {route} from "../../../helpers";

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

export default function CouponsList() {
    const [loading, setLoading] = useState(false);
    const divRef = useRef(null);
    const [paddingRight, setPaddingRight] = useState("");



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

    //api
    const couponRecords = async (pageIndex, pageSize) => {
        const response = await axios.get(route("api.web.v1.user-panel.coupons.index", {}, pageIndex, pageSize));
        return response.data;
    };
    const {
        data,
        fetchNextPage,
        hasNextPage,
        isError,
        error,
        isLoading
    } = useInfiniteQuery('couponRecords', ({pageParam = 1}) => couponRecords(pageParam, 15), {
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
        // console.log(Status)
        let backgroundColor = "";
        if (Status === "Active") backgroundColor = "primary.20";
        else if (Status === "Used") backgroundColor = "gray.main";
        else backgroundColor = "orange.30";
        return backgroundColor;
    };

    const textColors = (Status) => {
        let color = "";
        if (Status === "Active") color = "primary.50";
        else if (Status === "Used") color = "white";
        else color = "black";
        return color;
    };

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
                                                Title
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
                                                Code
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
                                                        key={key}
                                                        sx={{textDecoration: "none"}}
                                                    >
                                                        <StyledTableCell
                                                            align="center"
                                                        >
                                                            {value.description}
                                                        </StyledTableCell>
                                                        <StyledTableCell
                                                            align="center"
                                                        >
                                                            {value.code}
                                                        </StyledTableCell>
                                                        <StyledTableCell
                                                            align="center"
                                                        >
                                                            {value.expire}
                                                        </StyledTableCell>
                                                        <StyledTableCell
                                                            align="center"
                                                        >
                                                            <Typography
                                                                variant="h6"
                                                                sx={{
                                                                    backgroundColor:
                                                                        backgroundColors(
                                                                            value.status
                                                                        ),
                                                                    color: textColors(
                                                                        value.status
                                                                    ),
                                                                    width: "75%",
                                                                    margin: "auto",
                                                                    borderRadius: 10,
                                                                }}
                                                                align="center"
                                                            >
                                                                {value.status}
                                                            </Typography>

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
