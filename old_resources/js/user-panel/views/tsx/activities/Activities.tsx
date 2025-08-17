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
    tableCellClasses,
} from "@mui/material";
import axios from "../../../../axiosConfig";
import {route} from "../../../helpers";
import {useInfiniteQuery} from "react-query";
import  TableSkeleton from "../../../components/TableSkeleton";


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

export default function Activities() {
    
    const [loading, setLoading] = useState(false);
    const divRef = useRef(null);
    const [paddingRight, setPaddingRight] = useState("");


//api
    const activitiesRecords = async (pageIndex, pageSize) => {
        const response = await axios.get(route("api.web.v1.user-panel.activities.index", {}, pageIndex, pageSize));
        return response.data;
    };
    const {
        data,
        fetchNextPage,
        hasNextPage,
        isError,
        error,
        isLoading
    } = useInfiniteQuery('activitiesRecords', ({pageParam = 1}) => activitiesRecords(pageParam, 15), {
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
        }),[paddingRight];
        
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
                        Activities
                    </Typography>
                    <Box 
                           sx={{
                            marginTop : "20px",
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
                                aria-label="customized table"
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
                                                Country
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
                                                Date/Time
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
                                                System/OS
                                            </Typography>
                                        </StyledTableCell>
                                    </TableRow>
                                </TableHead>
                                <TableBody>
                                    {/*{console.log(data)}*/}
                                    {isLoading ? (
                                        <TableSkeleton cel={4} />
                                    ) : data?.pages[0].data.length > 0 ?
                                            data?.pages.map((page, pageIndex) => (
                                                <React.Fragment key={pageIndex}>
                                                    {page.data.map((value, key) => (
                                                        <StyledTableRow
                                                            key={key}
                                                        >
                                                            <StyledTableCell
                                                                align="center"
                                                            >
                                                                {value.ip}
                                                            </StyledTableCell>
                                                            <StyledTableCell

                                                                align="center"
                                                            >
                                                                {value.country}
                                                            </StyledTableCell>
                                                            <StyledTableCell
                                                                align="center"
                                                            >
                                                                {value.created_at}
                                                            </StyledTableCell>
                                                            <StyledTableCell
                                                                align="center"
                                                            >
                                                                {value.os}
                                                            </StyledTableCell>
                                                        </StyledTableRow>
                                                    ))}
                                                </React.Fragment>
                                            )):
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
// data?.pages[0].data.length > 0 ?
// data.pages.map((page, pageIndex) => {
//         page.data.map((value, key) => {
//             (
//                 <StyledTableRow
//                     key={key}
//                 >
//                     <StyledTableCell
//                         align="center"
//                     >
//                         {value.ip}
//                     </StyledTableCell>
//                     <StyledTableCell
//
//                         align="center"
//                     >
//                         {value.country}
//                     </StyledTableCell>
//                     <StyledTableCell
//                         align="center"
//                     >
//                         {value.created_at}
//                     </StyledTableCell>
//                     <StyledTableCell
//                         align="center"
//                     >
//                         {value.os}
//                     </StyledTableCell>
//                 </StyledTableRow>
//             )
//         })
//     }) : (<StyledTableRow
//             sx={{py: 5, textAlign: "center"}}
//         >
//             no data
//         </StyledTableRow>
//     )