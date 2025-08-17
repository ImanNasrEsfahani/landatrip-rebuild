import * as React from "react";
import {styled} from "@mui/material/styles";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import IconButton from "@mui/material/IconButton";
import {
    Button,
    TextField,
    Container,
    Grid,
    TableHead,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableRow,
    tableCellClasses,
    Snackbar,
    Alert,
    Paper,
} from "@mui/material";
import {SubmitHandler, useForm} from "react-hook-form";
import {useInfiniteQuery, useMutation, useQuery} from "react-query";
import axios from "./../../../../axiosConfig";
import {route} from "../../../helpers";
import EditOutlinedIcon from "@mui/icons-material/EditOutlined";
import DeleteOutlineOutlinedIcon from "@mui/icons-material/DeleteOutlineOutlined";
import TableSkeleton from "../../../components/TableSkeleton";
import {ChangeEvent, useRef, useState} from "react";
import SnackbarAlert from "../../../components/SnackbarAlert";
import TextSnippetOutlinedIcon from "@mui/icons-material/TextSnippetOutlined";
import customTheme from "../../../custom";
import { TablePagination } from "@mui/base";

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

type experience = {
    id: number;
    company_name: string;
    position: string;
    from: string;
    to: string;
    status: string;
};

const backgroundColors = (status) => {
    let backgroundColor = "";
    switch (status) {
        case "Completed":
            backgroundColor = customTheme.palette.primary.main
            break;
        case "Working":
            backgroundColor = customTheme.palette.orange.main
            break;
    }
    return backgroundColor;
    // if (status === "Completed") backgroundColor = "primary.30";
    // else if (status === "Working") backgroundColor = "orange.30";
    // else backgroundColor = "orange.30";
    
};




const columns = [
    { id: 'name', label: 'Name', minWidth: 170 },
    { id: 'code', label: 'ISO\u00a0Code', minWidth: 100 },
    {
      id: 'population',
      label: 'Population',
      minWidth: 170,
      align: 'right',
      format: (value) => value.toLocaleString('en-US'),
    },
    {
      id: 'size',
      label: 'Size\u00a0(km\u00b2)',
      minWidth: 170,
      align: 'right',
      format: (value) => value.toLocaleString('en-US'),
    },
    {
      id: 'density',
      label: 'Density',
      minWidth: 170,
      align: 'right',
      format: (value) => value.toFixed(2),
    },
  ];
  
  function createData(name, code, population, size) {
    const density = population / size;
    return { name, code, population, size, density };
  }
  
  const rows = [
    createData('India', 'IN', 1324171354, 3287263),
    createData('China', 'CN', 1403500365, 9596961),
    createData('Italy', 'IT', 60483973, 301340),
    createData('United States', 'US', 327167434, 9833520),
    createData('Canada', 'CA', 37602103, 9984670),
    createData('Australia', 'AU', 25475400, 7692024),
    createData('Germany', 'DE', 83019200, 357578),
    createData('Ireland', 'IE', 4857000, 70273),
    createData('Mexico', 'MX', 126577691, 1972550),
    createData('Japan', 'JP', 126317000, 377973),
    createData('France', 'FR', 67022000, 640679),
    createData('United Kingdom', 'GB', 67545757, 242495),
    createData('Russia', 'RU', 146793744, 17098246),
    createData('Nigeria', 'NG', 200962417, 923768),
    createData('Brazil', 'BR', 210147125, 8515767),
  ];

export default function AccountInfoWorkExperience() {
    const year = new Date().getFullYear();
    const [inputText, setInputText] = useState("");
    const [open, setOpen] = React.useState(false);
    const [status, setStatus] = React.useState<"success" | "info" | "warning" | "error">("success");
    const [message, setMessage] = React.useState("This is a success message!");
    const [value, setDefaultValue] = useState([]);
    const [shrink, setShrink] = useState()
    const [paddingRight, setPaddingRight] = useState("");
    const divRef = useRef(null);
    const inputRef = useRef(null);
    const inputRefTwo = useRef(null);
    const {
        register,
        handleSubmit,
        setValue,
        reset,
        formState: {isDirty, errors, isValid},
    } = useForm<experience>({mode: "onBlur"});

    const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
        setInputText(e.target.value);
    };

    const experienceRecords = async (pageIndex, pageSize) => {
        const responsive = await axios.get(route("api.web.v1.user-panel.account-info.work-experience.index"))
        return responsive.data
    }
    const {
        data,
        refetch,
        fetchNextPage,
        hasNextPage,
        isLoading,
    } = useInfiniteQuery("experienceRecords",
        ({pageParam = 1}) => experienceRecords(pageParam, 15), {
            getNextPageParam: (lastPage) => {
                const {meta} = lastPage;
                if (meta.current_page < meta.last_page) {
                    return meta.current_page + 1;
                }
                return null;
            }
        }
    )
    const postExperienceRecords = useMutation(
        async (data: experience) => {
            if (data.id) {
                return await axios.put(
                    route(
                        "api.web.v1.user-panel.account-info.work-experience.update",
                        {work_experience: data.id}
                    ),
                    data
                );
            }
            return await axios.post(
                route(
                    "api.web.v1.user-panel.account-info.work-experience.store"
                ),
                data
            );
        },
        {
            onSuccess: () => {
                setOpen(true);
                setStatus("success");
                setMessage("Send successfully");
                refetch().then((r) => "");
                reset();
            },
            onError: () => {
                setOpen(true);
                setStatus("error");
                setMessage("Error! Please try later");
            },
        }
    );
    let row = {};

    function editExperienceRecords(id) {
        data.pages.map((value, item) => {
            if (value.data.find(row => row.id === id)) {
                return row = value.data.find(row => row.id === id)
            }
        });
        setShrink(true)
        setValue("id", row.id);
        setValue("company_name", row.company_name);
        setValue("position", row.position);
        setValue("from", row.from);
        if (row.to == 'Until Now') {
            setValue("to", "")
        } else {
            setValue("to", row.to);
        }
    }

    const deleteExperienceRecords = useMutation(
        "deleteExperienceRecords",
        async (id) => {
            return await axios.delete(
                route(
                    "api.web.v1.user-panel.account-info.work-experience.destroy",
                    {work_experience: id}
                )
            );
        },
        {
            onSuccess: (data) => {
                setOpen(true);
                setStatus("success");
                setMessage("Delete successfully");
                refetch().then((r) => "");
            },
            onError: () => {
                setOpen(true);
                setStatus("error");
                setMessage("Error! Please try later");
            },
        }
    );

    const handlerOpen = () => {
        setOpen(false)
    }
    const onSubmit: SubmitHandler<experience> = (data) => {
        postExperienceRecords.mutate(data);
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

    const [loading, setLoading] = useState(false);

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

// --------------------------------------
    const [page, setPage] = React.useState(0);
    const [rowsPerPage, setRowsPerPage] = React.useState(10);
  
    const handleChangePage = (event, newPage) => {
      setPage(newPage);
    };
  
    const handleChangeRowsPerPage = (event) => {
      setRowsPerPage(+event.target.value);
      setPage(0);
    };

    console.log(divRef)


    return (
        <>
            <Container>
                <SnackbarAlert open={open} handlerOpen={handlerOpen} status={status} message={message}/>
                <Box sx={{mx: 7.5}}>
                    <Box
                        sx={{
                            borderRadius: 1,
                            mt: 5,
                            py: 2.5,
                        }}
                    >
                        <Box
                            sx={{
                                borderLeft: 3,
                                borderColor: "primary.main",
                                ml: 1,
                            }}
                        >
                            <Typography
                                sx={{ml: 1}}
                                fontWeight="bold"
                                color="primary.main"
                                variant="h6"
                            >
                                Insert New
                            </Typography>
                        </Box>
                        <form onSubmit={handleSubmit(onSubmit)}>
                            <Box sx={{mt: 5}}>
                                <Grid container spacing={4}>
                                    <Grid item xs={12} md={4} lg={3}>
                                        <TextField
                                            id="company_name"
                                            label="Company Name"
                                            variant="outlined"
                                            size="small"
                                            InputLabelProps={{shrink: shrink}}
                                            {...register("company_name", {required: true})}
                                            fullWidth
                                        />
                                        {errors.company_name?.type === "required" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Company Name is required
                                            </Typography>
                                        )}
                                    </Grid>
                                    <Grid item xs={12} md={4} lg={3}>
                                        <TextField
                                            id="position"
                                            label="Position"
                                            variant="outlined"
                                            size="small"
                                            InputLabelProps={{shrink: shrink}}
                                            {...register("position", {required: true})}
                                            fullWidth
                                        />
                                        {errors.position?.type === "required" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Position is required
                                            </Typography>
                                        )}
                                    </Grid>
                                    <Grid item xs={12} md={4} lg={3}>
                                        <TextField
                                            id="from"
                                            label="Start Year"
                                            variant="outlined"
                                            size="small"
                                            InputLabelProps={{shrink: shrink}}
                                            {...register("from", {
                                                onChange: handleChange,
                                                required: true,
                                                max: year,
                                                minLength: 4,
                                                pattern: /^(19\d\d|20\d\d|21\d\d)$/,
                                            })}
                                            fullWidth
                                        />
                                        {errors.from?.type === "max" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Start Year can't be more than {year}
                                            </Typography>
                                        )}
                                        {errors.from?.type === "required" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Start Year is required
                                            </Typography>
                                        )}
                                        {errors.from?.type === "pattern" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Please enter a valid year
                                            </Typography>
                                        )}
                                        {errors.from?.type === "minLength" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Please enter a 4 digit year
                                            </Typography>
                                        )}
                                    </Grid>
                                    <Grid item xs={12} md={4} lg={3}>
                                        <TextField
                                            id="to"
                                            label="End Year"
                                            variant="outlined"
                                            size="small"
                                            InputLabelProps={{
                                                shrink: shrink
                                            }}
                                            {...register("to", {
                                                onChange: handleChange,
                                                max: year,
                                                maxLength: 4,
                                                min: inputText,
                                                pattern: /^(19\d\d|20\d\d|21\d\d)$/,
                                            })}
                                            fullWidth
                                        />
                                        {errors.to?.type === "max" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                End Year can't be more than {year}
                                            </Typography>
                                        )}
                                        {errors.to?.type === "min" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                EndYear must be Equal or More than{" "}
                                                {inputText}
                                            </Typography>
                                        )}
                                        {errors.to?.type === "pattern" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Please enter a valid year
                                            </Typography>
                                        )}
                                        {errors.to?.type === "maxLength" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Please enter a 4 digit year
                                            </Typography>
                                        )}
                                    </Grid>
                                </Grid>
                                <Box textAlign="center">
                                    <Button
                                        disabled={!isValid}
                                        type={"submit"}
                                        sx={{
                                            borderColor: "orange.main",
                                            backgroundColor: "orange.main",
                                            px: 7.5,
                                            my: 5,
                                        }}
                                        variant="contained"
                                    >
                                        Save
                                    </Button>
                                </Box>
                            </Box>
                        </form>
                    </Box>
                    <Box
                           

                      sx={{
                            backgroundColor: "#6C757D",
                            borderRadius: "15px",
                            overflow: "hidden",
                            paddingLeft: "9px",
                            paddingRight : paddingRight
                    }}>

                      
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
                                    
                                >
                                    <TableRow>
                                       
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
                                                    justifyContent: "left",
                                                    alignItems: "left",
                                                }}
                                            >
                                                Company Name
                                            </Typography>
                                        </StyledTableCell>
                                        <StyledTableCell
                                            sx={{
                                                borderColor: "primary.main",
                                                width: "20%",
                                                textAlign: "center",
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
                                                Position
                                            </Typography>
                                        </StyledTableCell>
                                        <StyledTableCell
                                            sx={{
                                                borderColor: "primary.main",
                                                width: "20%",
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
                                                width: "20%",
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
                                        <StyledTableCell
                                            sx={{
                                                borderColor: "primary.main",
                                                width: "15%",
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
                                                Update/Remove
                                            </Typography>
                                        </StyledTableCell>
                                    </TableRow>
                                </TableHead>
                                <TableBody   
                                           
                                           onScroll={handleScroll}
                                           sx={{
                                               borderRadius: 5,
                                               overflowY: "auto",
                                               
                                               
                                           }}>
                                    {console.log(data)}
                                    {isLoading ? (
                                        <TableSkeleton cel={5}/>
                                    ) : data?.pages[0].data.length > 0 ? (
                                            data?.pages.map((page, pageIndex) => (
                                                <React.Fragment key={pageIndex}>
                                                    {page.data.map((value, key) => (
                                                        <StyledTableRow
                                                            sx={{
                                                                borderColor: "primary.main",
                                                            }}
                                                            key={value.id}
                                                        >
                                                            <StyledTableCell
                                                                sx={{
                                                                    borderColor: "primary.main",
                                                                }}
                                                                align="left"
                                                            >
                                                                {value.company_name}
                                                            </StyledTableCell>
                                                            <StyledTableCell
                                                                sx={{
                                                                    borderColor: "primary.main",
                                                                }}
                                                                align="center"
                                                            >
                                                                {value.position}
                                                            </StyledTableCell>
                                                            <StyledTableCell
                                                                sx={{
                                                                    borderColor: "primary.main",
                                                                }}
                                                                align="center"
                                                            >
                                                                {value.from} / {value.to
                                                                ? value.to
                                                                : "Until Now"}
                                                            </StyledTableCell>
                                                            <StyledTableCell
                                                                sx={{
                                                                    borderColor: "primary.main",
                                                                }}
                                                                align="center"
                                                            >
                                                                <Box>
                                                                    <Typography
                                                                        sx={{
                                                                            backgroundColor:
                                                                                backgroundColors(
                                                                                    value.status
                                                                                ),
                                                                            padding: 0.3,
                                                                            width: "75%",
                                                                            margin: "auto",
                                                                            borderRadius: 10,
                                                                        }}
                                                                        align="center"
                                                                    >
                                                                        {value.status}
                                                                    </Typography>
                                                                </Box>
                                                            </StyledTableCell>
                                                            <StyledTableCell
                                                                sx={{
                                                                    borderColor: "primary.main",
                                                                }}
                                                                align="center"
                                                            >
                                                                <IconButton>
                                                                    <TextSnippetOutlinedIcon onClick={() =>
                                                                        editExperienceRecords(
                                                                            value.id
                                                                        )
                                                                    }/>
                                                                </IconButton>
                                                                <IconButton>
                                                                    <DeleteOutlineOutlinedIcon
                                                                        color={"error"}
                                                                        onClick={() =>
                                                                            deleteExperienceRecords.mutate(
                                                                                value.id
                                                                            )
                                                                        }
                                                                    />
                                                                </IconButton>
                                                            </StyledTableCell>
                                                        </StyledTableRow>
                                                    ))}
                                                </React.Fragment>
                                            ))) :
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
