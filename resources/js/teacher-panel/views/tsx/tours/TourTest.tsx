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

import { TableVirtuoso, TableComponents } from 'react-virtuoso';

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

interface Data {
    title: string;
    location: string;
    group: string;
    id: number;
    status: string;
}

interface ColumnData {
    dataKey: keyof Data;
    label: string;
    numeric?: boolean;
    width: number;
}

function createData(
    id: number,
    title: string,
    location: string,
    group: string,
    status: string,
): Data {
    return { id, title, location, group, status };
}



const columns: ColumnData[] = [
    {
        width: 200,
        label: 'title',
        dataKey: 'title',
    },
    {
        width: 120,
        label: 'location',
        dataKey: 'location',
    },
    {
        width: 120,
        label: 'Confirmed/Total Group',
        dataKey: 'group',
    },
    {
        width: 120,
        label: 'status',
        dataKey: 'status',
    },
];

export default function TourTest() {

    const [Loading, setLoading] = useState(false);
    const [PageNum, setPageNum] = useState<number>(0)
    const [PageNum1, setPageNum1] = useState<number>(5)
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



    const rows: Data[] = Array.from( data.pages[PageNum].data.length, (_, index) => {
        return createData( data.pages[PageNum].data[index].id,  data.pages[PageNum].data[index].title, data.pages[PageNum].data[index].location,  data.pages[PageNum].data[index].confirmed_group.toString() + "/" + data.pages[PageNum].data[index].total_group.toString(),  data.pages[PageNum].data[index].status);
    });

        // const rows: Data[] =
        //     data.pages.map(page => {
        //     return page.data.map(item => {
        //         return createData(
        //             item.id,
        //             item.title,
        //             item.location,
        //             `${item.confirmed_group}/${item.total_group}`,
        //             item.status
        //         );
        //     });
        // }).flat();
        // console.log(rows1, "ashgar");
    // const rows1 = Array.from(data.pages, page => {
    //     return (page.data, item => {
    //         return createData(
    //             item.id,
    //             item.title,
    //             item.location,
    //             `${item.confirmed_group}/${item.total_group}`,
    //             item.status
    //         );
    //     });
    // }).flat();

    // console.log(rows1);
    const VirtuosoTableComponents: TableComponents<Data> = {
        Scroller: React.forwardRef<HTMLDivElement>((props, ref) => (
            <TableContainer component={Paper} {...props} ref={ref} />
        )),
        Table: (props) => (
            <Table {...props} sx={{ borderCollapse: 'separate', tableLayout: 'fixed' }} />
        ),
        TableHead,
        TableRow: ({ item: _item, ...props }) => <TableRow {...props} />,
        TableBody: React.forwardRef<HTMLTableSectionElement>((props, ref) => (
            <TableBody {...props} ref={ref} />
        )),
    };

    function fixedHeaderContent() {
        return (
            <TableRow>
                {columns.map((column) => (
                    <TableCell
                        key={column.dataKey}
                        variant="head"
                        align={column.numeric || false ? 'right' : 'center'}
                        style={{ width: column.width }}
                        sx={{
                            backgroundColor: 'primary.30',
                        }}
                    >
                        {column.label}
                    </TableCell>
                ))}
                {
                    Loading &&
                    <TableCell colSpan={4} sx={{p:0}} >
                        <LinearProgress />
                    </TableCell>
                }
            </TableRow>
        );
    }

    function rowContent(_index: number, row: Data) {
        return (
            <React.Fragment>

                {columns.map((column) => (

                    <StyledTableCell
                        key={column.dataKey}
                        align={column.numeric || false ? 'right' : 'center'}
                    >
                        {row[column.dataKey]}
                    </StyledTableCell>
                ))}

            </React.Fragment>
        );
    }


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


    // const tourRecords = async (pageIndex, pageSize) => {
    //     const response = await axios.get(route("api.web.v1.teacher-panel.tours.index", {}, pageIndex, pageSize));
    //     return response.data;
    // };
    //
    // const {
    //     data,
    //     fetchNextPage,
    //     hasNextPage,
    //     isError,
    //     refetch,
    //     error,
    //     isLoading
    // } = useInfiniteQuery("tourRecords", ({pageParam = 1}) => tourRecords(pageParam, 10), {
    //     getNextPageParam: (lastPage) => {
    //         const {meta} = lastPage;
    //         if (meta.current_page < meta.last_page) {
    //             return meta.current_page + 1;
    //         }
    //         return null;
    //     }
    // });



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

    const handelNextPage = () => {
        if (hasNextPage) {
            setLoading(true)
            fetchNextPage().then(r => {
                setPageNum(PageNum + 1)
                setLoading(false);
            })

        }

    }
    const handleVariant = (chip): ("filled" | "outlined") => {
        if (chip.select) {
            return "filled";
        } else return "outlined";
    };


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
                    <Box>
                        <Paper style={{ height: 400, width: '100%' }}>
                            <TableVirtuoso
                                endReached={handelNextPage}
                                data={rows}
                                components={VirtuosoTableComponents}
                                fixedHeaderContent={fixedHeaderContent}
                                itemContent={rowContent}
                            />
                        </Paper>
                    </Box>
                </Box>
            </Container>
        </>
    )
        ;
}
