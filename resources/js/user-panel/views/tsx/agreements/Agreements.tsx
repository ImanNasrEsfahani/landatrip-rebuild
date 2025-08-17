import * as React from "react";
import {styled} from "@mui/material/styles";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
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
} from "@mui/material";
import {Link as LinkReact} from "react-router-dom";
import {route} from "../../../helpers";
import {useRef, useState} from "react";
import {useInfiniteQuery} from "react-query";
import axios from "../../../../axiosConfig";
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

const removeIconDisable = (status) => {
    if (status !== "In Progress") return true;
};

export default function Agreements() {
   
    const [loading, setLoading] = useState(false);
    const [paddingRight, setPaddingRight] = useState("");
    const divRef = useRef(null);

    const agreementRecords = async (pageIndex, pageSize) => {
        const response = await axios.get(
            route(
                "api.web.v1.user-panel.account-info.agreements.index",
                {},
                pageIndex,
                pageSize
            )
        );
        return response.data;
    };

    const {data, fetchNextPage, hasNextPage, isError, error, isLoading} =
        useInfiniteQuery(
            "agreementRecords",
            ({pageParam = 1}) => agreementRecords(pageParam, 15),
            {
                getNextPageParam: (lastPage) => {
                    const {meta} = lastPage;
                    if (meta.current_page < meta.last_page) {
                        return meta.current_page + 1;
                    }
                    return null;
                },
            }
        );

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

    const backgroundColors = (Status) => {
        let backgroundColor = "";
        if (Status === "Confirmed") backgroundColor = "primary.30";
        else if (Status === "Pending") backgroundColor = "orange.30";
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
            case "Pending":
                return "Pending";
            case "Confirmed":
                return "Confirmed";
            default:
                return "Canceled";
        }
    };

    function handleScroll() {
        if (data) {
            const {scrollTop, scrollHeight, clientHeight} = divRef.current;
            const scrollEndPosition = scrollHeight - clientHeight;
            if (scrollEndPosition - scrollTop < 1 && hasNextPage) {
                setLoading(true);
                fetchNextPage().then((r) => setLoading(false));
            }
        }
    }



    return (
        <>
            <Container>
                <Box>
                    <Typography
                        sx={{
                            ml: 1,
                            borderLeft: 3,
                            borderColor: "primary.main",
                            mt: 5,
                            pl: 1,
                        }}
                        fontWeight="bold"
                        color="primary.main"
                        variant="h3"
                    >
                        Agreements
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
                                // sx={{
                                //     minWidth: 700,
                                //     mt: 3,
                                //     borderRadius: 5,
                                //     overflow: "hidden",
                                // }}
                                aria-label="customized table"
                            >
                                <TableHead
                                    // sx={{backgroundColor: "gray.main"}}
                                >
                                    <TableRow
                                        // sx={{borderRadius: 5, width: "auto"}}
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
                                                Title
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
                                        align="center">
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
                                    {console.log(data)}
                                    {isLoading ? (
                                        <TableSkeleton cel={3}/>
                                    ) : data?.pages[0].data.length > 0 ? (
                                        data?.pages.map((page, pageIndex) => (
                                            <React.Fragment key={pageIndex}>
                                                {page.data.map((value, key) => (
                                                    <StyledTableRow
                                                        key={key}
                                                        component={LinkReact}
                                                        sx={{textDecoration:"none"}}
                                                        to={`../agreements/${value.id}`}
                                                    >
                                                        <StyledTableCell align="center" sx={{width: "60%"}}>
                                                            {value.title}
                                                        </StyledTableCell>
                                                        <StyledTableCell align="center"sx={{width: "25%"}} >
                                                            {value.created_at}
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
                                        ))
                                    ) : (
                                        <StyledTableRow
                                            sx={{py: 5, textAlign: "center"}}
                                        >
                                            <StyledTableCell
                                                colSpan={4}
                                                align="center"
                                            >
                                                No Data
                                            </StyledTableCell>
                                        </StyledTableRow>
                                    )}
                                </TableBody>
                            </Table>
                        </TableContainer>
                    </Box>
                </Box>
            </Container>
        </>
    );
}
