/**
 * This file contains the code for the AccountInfoEducationalBackground component.
 * It displays a form to insert new educational records and a table to view and manage existing records.
 * The component uses React hooks, React Query, and Material-UI for the UI components.
 * It makes API calls to fetch, add, update, and delete educational records.
 */

import * as React from "react";
import { styled } from "@mui/material/styles";
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
    Alert,
    Snackbar,
    LinearProgress,
} from "@mui/material";
import DeleteOutlineOutlinedIcon from "@mui/icons-material/DeleteOutlineOutlined";
import TextSnippetOutlinedIcon from "@mui/icons-material/TextSnippetOutlined";

import axios from "../../../../axiosConfig";
import { route } from "../../../helpers";
import { useInfiniteQuery, useMutation } from "react-query";
import { SubmitHandler, useForm } from "react-hook-form";
import { ChangeEvent, useRef, useState } from "react";
import TableSkeleton from "../../../components/TableSkeleton";
import SnackbarAlert from "../../../components/SnackbarAlert";

// StyledTableCell component for custom styling of table cells
const StyledTableCell = styled(TableCell)(({ theme }) => ({
    [`&.${tableCellClasses.head}`]: {
        backgroundColor: "primary.main",
        color: "primary.main",
    },
    [`&.${tableCellClasses.body}`]: {
        fontSize: 14,
    },
}));

// StyledTableRow component for custom styling of table rows
const StyledTableRow = styled(TableRow)(({ theme }) => ({
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

// Type definition for education object
type education = {
    id: number;
    title: string;
    level: string;
    university: string;
    from: string;
    to: string;
    status: string;
};

// Function to determine the background color based on status
const backgroundColors = (status: string) => {
    let backgroundColor = "";
    if (status === "Completed") backgroundColor = "primary.30";
    else if (status === "In Progress") backgroundColor = "primary.20";
    else backgroundColor = "orange.30";
    return backgroundColor;
};

// AccountInfoEducationalBackground component
export default function AccountInfoEducationalBackground() {
    // State variables
    const [open, setOpen] = React.useState(false);
    const [status, setStatus] = React.useState<"success" | "info" | "warning" | "error">("success");
    const [message, setMessage] = React.useState<string>("This is a success message!");
    const [shrink, setShrink] = React.useState<any>();
    const [disableBtn, setDisableBtn] = React.useState(false);
    const [paddingRight, setPaddingRight] = useState("");
    const divRef = useRef(null);

    const [degree, setDegree] = React.useState("");

    const {
        register,
        handleSubmit,
        setValue,
        reset,
        formState: { errors, isValid },
    } = useForm<education>({ mode: "onBlur" });

    // Function to fetch educational records
    const educationalRecords = async (pageIndex, pageSize) => {
        const response = await axios.get(
            route(
                "api.web.v1.user-panel.account-info.educational-background.index",
                {},
                pageIndex,
                pageSize
            )
        );
        return response.data;
    };

    // React Query hook for fetching educational records
    const {
        data,
        fetchNextPage,
        hasNextPage,
        refetch,
        isLoading,
    } = useInfiniteQuery(
        "educationalRecords",
        ({ pageParam = 1 }) => educationalRecords(pageParam, 3),
        {
            getNextPageParam: (lastPage) => {
                const { meta } = lastPage;
                if (meta.current_page < meta.last_page) {
                    return meta.current_page + 1;
                }
                return null;
            },
        }
    );

    // React Query hook for deleting educational records
    const deleteEducationalRecords = useMutation(
        "deleteEducationalRecords",
        async (id) => {
            setDisableBtn(true);
            return await axios.delete(
                route(
                    "api.web.v1.user-panel.account-info.educational-background.destroy",
                    { educational_background: id }
                )
            );
        },
        {
            onSuccess: (data) => {
                setDisableBtn(false);
                setOpen(true);
                setStatus("success");
                setMessage("Delete successfully");
                window.setTimeout(() => {
                    refetch().then((r) => "");
                }, 1000);
            },
            onError: () => {
                setDisableBtn(false);
                setOpen(true);
                setStatus("error");
                setMessage("Error! Please try later");
            },
        }
    );

    // React Query hook for adding/updating educational records
    const postEducationalRecords = useMutation(
        "editEducationalRecords",
        async (data: education) => {
            if (data.id) {
                return await axios.put(
                    route(
                        "api.web.v1.user-panel.account-info.educational-background.update",
                        { educational_background: data.id }
                    ),
                    data
                );
            } else {
                return await axios.post(
                    route(
                        "api.web.v1.user-panel.account-info.educational-background.store"
                    ),
                    data
                );
            }
        },
        {
            onSuccess: (data) => {
                setOpen(true);
                setStatus("success");
                setMessage("Send successfully");
                window.setTimeout(() => {
                    refetch().then((r) => "");
                }, 1000);
                reset();
                setShrink(null)
            },
            onError: () => {
                setOpen(true);
                setStatus("error");
                setMessage("Error! Please try later");
            },
        }
    );

    // Function to edit educational records
    function editEducationalRecords(id) {
        let row = [];
        data.pages.map((value, item) => {
            if (value.data.find((row) => row.id === id)) {
                return (row = value.data.find((row) => row.id === id));
            }
        });
        setShrink(true)
        setValue("id", row.id);
        setValue("title", row.title);
        setValue("university", row.university);
        setValue("level", row.level);
        setValue("from", row.from);
        setValue("to", row.to);
    }

    // Submit handler for the form
    const onSubmit: SubmitHandler<education> = (data) => {
        postEducationalRecords.mutate(data);
    };

    // if (educationalRecords.isError) {
    //     return <p>Error</p>;
    // }
    //
    // if (educationalRecords.isLoading) {
    //     return <p>Loading</p>;
    // }


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
    const [loading, setLoading] = useState(false);

    // Function to handle scroll event for infinite scrolling
    function handleScroll() {
        if (data) {
            const { scrollTop, scrollHeight, clientHeight } = divRef.current;
            const scrollEndPosition = scrollHeight - clientHeight;
            if (scrollEndPosition - scrollTop < 1 && hasNextPage) {
                setLoading(true);
                fetchNextPage().then((r) => setLoading(false));
            }
        }
    }

    // Current year
    const year = new Date().getFullYear();

    // State for input text
    const [inputText, setInputText] = useState("");

    // Handler for opening snackbar
    const handlerOpen = () => {
        setOpen(false)
    }

    // Change event handler for input text
    const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
        setInputText(e.target.value);
    };

    // JSX code for the component
    return (
        <>
            <Container>
                <SnackbarAlert open={open} handlerOpen={handlerOpen} status={status} message={message}/>
                <Box sx={{ mx: 7.5 }}>
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
                                sx={{ ml: 1 }}
                                fontWeight="bold"
                                color="primary.main"
                                variant="h6"
                            >
                                Insert New
                            </Typography>
                        </Box>
                        <Box
                            component={"form"}
                            onSubmit={handleSubmit(onSubmit)}
                            sx={{ mt: 5 }}
                        >
                            <Grid container spacing={4}>
                                <Grid item xs={12} md={4} lg={3}>
                                    <TextField
                                        id="field"
                                        label="Field"
                                        variant="outlined"
                                        size="small"
                                        fullWidth
                                        InputLabelProps={{ shrink: shrink }}
                                        {...register("title", {
                                            required: true,
                                        })}
                                    />
                                    {errors.title?.type === "required" && (
                                        <Typography
                                            variant="caption"
                                            color="error"
                                            role="alert"
                                        >
                                            Field is required
                                        </Typography>
                                    )}
                                </Grid>
                                <Grid item xs={12} md={4} lg={3}>
                                    <TextField
                                        id="universityOrCollege"
                                        label="University/College"
                                        variant="outlined"
                                        size="small"
                                        fullWidth
                                        InputLabelProps={{ shrink: shrink }}
                                        {...register("university", {
                                            required: true,
                                        })}
                                    />
                                    {errors.university?.type === "required" && (
                                        <Typography
                                            variant="caption"
                                            color="error"
                                            role="alert"
                                        >
                                            University is required
                                        </Typography>
                                    )}
                                </Grid>
                                <Grid item xs={12} md={4} lg={3}>
                                    <TextField
                                        id="degree"
                                        label="Degree"
                                        variant="outlined"
                                        size="small"
                                        fullWidth
                                        InputLabelProps={{ shrink: shrink }}
                                        {...register("level", {
                                            required: true,
                                        })}
                                    />
                                    {errors.level?.type === "required" && (
                                        <Typography
                                            variant="caption"
                                            color="error"
                                            role="alert"
                                        >
                                            Degree is required
                                        </Typography>
                                    )}
                                </Grid>
                                <Grid item xs={12} md={4} lg={3}>
                                    <TextField
                                        id="startYear"
                                        label="Start Year"
                                        variant="outlined"
                                        size="small"
                                        fullWidth
                                        InputLabelProps={{ shrink: shrink }}
                                        {...register("from", {
                                            onChange: handleChange,
                                            // validate: validateStartYear,
                                            required: true,
                                            max: year,
                                            minLength: 4,
                                            pattern: /^(19\d\d|20\d\d|21\d\d)$/,
                                        })}
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
                                        id="endYear"
                                        label="End Year"
                                        variant="outlined"
                                        size="small"
                                        fullWidth
                                        InputLabelProps={{ shrink: shrink }}
                                        {...register("to", {
                                            // validate: validateEndYear,
                                            max: year,
                                            maxLength: 4,
                                            min: inputText,
                                            pattern: /^(19\d\d|20\d\d|21\d\d)$/,
                                        })}
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
                    </Box>
                    <Box sx={{
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
                                //     // height: "100%",
                                // }}
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
                                                Field
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
                                                University/College
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
                                                Degree
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
                                                Start to End Year
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
                                                Status
                                            </Typography>
                                        </StyledTableCell>
                                        <StyledTableCell
                                          sx={{
                                            borderColor: "primary.main",
                                            width: "10%",
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
                                <TableBody>
                                    {loading && (
                                        <TableRow>
                                            <TableCell
                                                colSpan={6}
                                                sx={{ p: 0 }}
                                            >
                                                <LinearProgress />
                                            </TableCell>
                                        </TableRow>
                                    )}
                                    {isLoading ? (
                                        <TableSkeleton cel={6} />
                                    ) : data?.pages[0].data.length > 0 ? (
                                        data?.pages.map((page, pageIndex) => (
                                            <React.Fragment key={pageIndex}>
                                                {page.data.map((value, key) => (
                                                    <StyledTableRow
                                                        key={key}
                                                        sx={{
                                                            borderColor:
                                                                "primary.main",
                                                        }}
                                                    >
                                                        <StyledTableCell
                                                            sx={{
                                                                borderColor:
                                                                    "primary.main",
                                                            }}
                                                            align="left"
                                                        >
                                                            {value.title}
                                                        </StyledTableCell>
                                                        <StyledTableCell
                                                            sx={{
                                                                borderColor:
                                                                    "primary.main",
                                                            }}
                                                            align="center"
                                                        >
                                                            {value.university}
                                                        </StyledTableCell>
                                                        <StyledTableCell
                                                            sx={{
                                                                borderColor:
                                                                    "primary.main",
                                                            }}
                                                            align="center"
                                                        >
                                                            {value.level}
                                                        </StyledTableCell>
                                                        <StyledTableCell
                                                            sx={{
                                                                borderColor:
                                                                    "primary.main",
                                                            }}
                                                            align="center"
                                                        >
                                                            {value.from}/
                                                            {value.to
                                                                ? value.to
                                                                : "Until Now"}
                                                        </StyledTableCell>
                                                        <StyledTableCell
                                                            sx={{
                                                                borderColor:
                                                                    "primary.main",
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
                                                                    {
                                                                        value.status
                                                                    }
                                                                </Typography>
                                                            </Box>
                                                        </StyledTableCell>
                                                        <StyledTableCell
                                                            sx={{
                                                                borderColor:
                                                                    "primary.main",
                                                            }}
                                                            align="center"
                                                        >
                                                            <IconButton
                                                                onClick={() =>
                                                                    editEducationalRecords(
                                                                        value.id
                                                                    )
                                                                }
                                                                sx={{
                                                                    color: "primary.main",
                                                                }}
                                                            >
                                                                <TextSnippetOutlinedIcon />
                                                            </IconButton>
                                                            <IconButton
                                                                disabled={
                                                                    disableBtn
                                                                }
                                                                onClick={() =>
                                                                    deleteEducationalRecords.mutate(
                                                                        value.id
                                                                    )
                                                                }
                                                                sx={{
                                                                    color: "orange.main",
                                                                }}
                                                            >
                                                                <DeleteOutlineOutlinedIcon />
                                                            </IconButton>
                                                        </StyledTableCell>
                                                    </StyledTableRow>
                                                ))}
                                            </React.Fragment>
                                        ))
                                    ) : (
                                        <StyledTableRow
                                            sx={{ py: 5, textAlign: "center" }}
                                        >
                                            <StyledTableCell
                                                colSpan={6}
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
