import * as React from "react";
import {styled} from "@mui/material/styles";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import customTheme from "./../../../custom";
import {useState, useRef} from "react";
import {
    Container,
    TableHead,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableRow,
    LinearProgress,
    tableCellClasses, Button
} from "@mui/material";

import Chip from "@mui/material/Chip";
import Stack from "@mui/material/Stack";
import {Link, Link as LinkReact} from "react-router-dom";
import {useInfiniteQuery} from "react-query";
import axios from "./../../../../axiosConfig";
import {route} from "../../../helpers";
import Paper from "@mui/material/Paper";
import TourTest from "./TourTest";


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

const backgroundColors = (status) => {
    let backgroundColor = "";
    switch (status){
        case 'Draft':
            return backgroundColor = "primary.30"
        break
        case 'Pending':
            return backgroundColor = "primary.20"
        break
        case 'Approved':
            return backgroundColor = "orange.30"
        break
        case 'Rejected':
            return backgroundColor = "primary.30"
        break
        case 'Suspended':
            return backgroundColor = "primary.40"
    }

};


export default function Tour() {
    const divRef = useRef();
    const [paddingRight, setPaddingRight] = React.useState("");
    const [loading, setloading] = useState(false);

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

    //chips
    const [chips, setChips] = useState([
        {
            name: "All",
            select: false
        },
        {
            name: "Completed",
            select: false
        },
        {
            name: "Pending",
            select: false
        },
        {
            name: "Rejected",
            select: false
        },
    ]);


    const tourRecords = async (pageIndex, pageSize) => {
        const response = await axios.get(route("api.web.v1.teacher-panel.tours.index", {}, pageIndex, pageSize));
        return response.data;
    };

    const {
        data,
        fetchNextPage,
        hasNextPage,
        isError,
        refetch,
        error,
        isLoading
    } = useInfiniteQuery("tourRecords", ({pageParam = 1}) => tourRecords(pageParam, 10), {
        getNextPageParam: (lastPage) => {
            const {meta} = lastPage;
            if (meta.current_page < meta.last_page) {
                return meta.current_page + 1;
            }
            return null;
        }
    });



    function handleScroll() {
        if (data) {
            const { scrollTop, scrollHeight, clientHeight }:any  = divRef.current;
            const scrollEndPosition = scrollHeight - clientHeight;
            if (scrollEndPosition - scrollTop < 1 && hasNextPage) {
                setloading(true)
                fetchNextPage().then(r =>
                    setloading(false)
                );
            }
        }

    }
    const handleClickChips = (index: number) => {
        let newChip = chips;
        newChip[index].select = !newChip[index].select;
        setChips(newChip);
        console.log(chips);
    };

    const handleColor = (chip): ("default" | "primary") => {
        if (chip.select == true) {
            return "primary";
        } else return "default";
    };

    const handleVariant = (chip): ("filled" | "outlined") => {
        if (chip.select) {
            return "filled";
        } else return "outlined";
    };

    if (isLoading) {
        return <p>Loading</p>;
    }

    if (isError) {
        return <p>Error</p>;
    }
    return (
        <>
            <Container>
                <Box sx={{mx: 7.5}}>
                    <Box sx={{display: "flex", justifyContent: "space-between", my: 5}}>
                        <Box sx={{
                            borderRadius: 1,
                            // py: 2.5,
                        }}>
                            <Box sx={{
                                borderLeft: 3,
                                borderColor: "primary.main",
                                ml: 1,
                            }}>
                                <Typography sx={{ml: 1}} fontWeight="bold" color="primary.main" variant="h6">
                                    Tours
                                </Typography>
                            </Box>
                        </Box>
                        <Box textAlign="center">
                            <Button sx={{
                                borderColor: "orange.main",
                                backgroundColor: "orange.main",
                                px: 7.5,
                            }} variant="contained" component={LinkReact} to="add-tour">
                                Add New Tour
                            </Button>
                        </Box>
                    </Box>
                    <Box>
                        <Stack direction="row" sx={{
                            display: "flex",
                            justifyContent: "center"
                        }} spacing={2}>
                            {chips.map((chip, i) => (
                                    <Chip sx={{px: 1}} key={i} label={chip.name} color={handleColor(chip)}
                                        variant={handleVariant(chip)} onClick={() => handleClickChips(i)}/>
                                )
                            )}
                            <Chip sx={{px: 1}} color="default" variant="outlined"></Chip>
                                {/*// icon={<SearchIcon />} label="search icon"/>*/}
                        </Stack>

                    </Box>

                    <Box 
                          sx={{
                            backgroundColor: "#6C757D",
                            borderRadius: "15px",
                            overflow: "hidden",
                            paddingLeft: "9px",
                            paddingRight : paddingRight,
                            mt:2
                        }}
                    >
                        
                        <TableContainer
                            className="scrollbarInputs"
                            ref={divRef}                          
                            sx={{
                                
                                overflowY: "auto",
                                maxHeight: "60vh",
                            }}
                            onScroll={handleScroll}
                        >
                            <Table  
                                stickyHeader
                                aria-label="sticky table">
                                <TableHead >
                                    <TableRow >
                                        <StyledTableCell 
                                             sx={{
                                                borderColor: "primary.main",
                                                width: "auto",
                                                bgcolor : "gray.main"
                                            }}
                                            align="center"
                                        >
                                            <Typography color="white" sx={{
                                                display: "flex",
                                                flexDirection: "row",
                                                justifyContent: "left",
                                                alignItems: "left",
                                            }}>
                                                Tour Name
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
                                            <Typography color="white" sx={{
                                                display: "flex",
                                                flexDirection: "row",
                                                justifyContent: "center",
                                                alignItems: "center",
                                            }}>
                                                Tour Location
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
                                            <Typography color="white" sx={{
                                                display: "flex",
                                                flexDirection: "row",
                                                justifyContent: "center",
                                                alignItems: "center",
                                            }}>
                                                Confirmed/Total Group
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
                                            <Typography color="white" sx={{
                                                display: "flex",
                                                flexDirection: "row",
                                                justifyContent: "center",
                                                alignItems: "center",
                                            }}>
                                                Status
                                            </Typography>
                                        </StyledTableCell>
                                    </TableRow>
                                </TableHead>
                                <TableBody>
                                    { loading &&
                                        <TableRow>
                                            <TableCell colSpan={4} sx={{p:0}} >
                                                <LinearProgress />
                                            </TableCell>
                                        </TableRow>
                                    }
                                    {
                                        data?.pages[0].data.length > 0 ? (
                                            data?.pages.map((page, pageIndex) => (
                                                <React.Fragment key={pageIndex}>
                                                    {page.data.map((value, key) => (
                                                        <StyledTableRow sx={{
                                                            borderColor: "primary.main",
                                                        }} key={key}
                                                            component={LinkReact} to={`../tours/${value.id}`}>
                                                            <StyledTableCell sx={{
                                                                borderColor: "primary.main",
                                                            }} align="left">
                                                                {value.title}

                                                            </StyledTableCell>
                                                            <StyledTableCell sx={{
                                                                borderColor: "primary.main",
                                                            }} align="center">
                                                                {value.location}
                                                            </StyledTableCell>
                                                            <StyledTableCell sx={{
                                                                borderColor: "primary.main",
                                                            }} align="center">
                                                                {value.confirmed_group} / {value.total_group}
                                                            </StyledTableCell>
                                                            <StyledTableCell sx={{
                                                                borderColor: "primary.main",
                                                            }} align="center">
                                                                <Box>
                                                                    <Typography sx={{
                                                                        backgroundColor:
                                                                            backgroundColors(
                                                                                value.status
                                                                            ),
                                                                        padding: 0.3,
                                                                        width: "75%",
                                                                        margin: "auto",
                                                                        borderRadius: 10,
                                                                    }} align="center">
                                                                        {value.status}
                                                                    </Typography>
                                                                </Box>
                                                            </StyledTableCell>
                                                        </StyledTableRow>
                                                    ))}
                                                </React.Fragment>
                                            ))) :
                                        (<TableRow>
                                            <TableCell colSpan={4} sx={{p:0}} >
                                                <Typography>
                                                    No Data
                                                </Typography>
                                            </TableCell>
                                        </TableRow>)
                                    }
                                </TableBody>
                            </Table>
                        </TableContainer>
                        
                    </Box>
                </Box>
            </Container>
        </>
    )
        ;
}
