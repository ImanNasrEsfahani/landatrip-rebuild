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
    tableCellClasses, Snackbar, Alert,
} from "@mui/material";
import {SubmitHandler, useForm} from "react-hook-form";
import {useMutation, useQuery} from "react-query";
import axios from "./../../../../axiosConfig";
import {route} from "../../../helpers";
import EditOutlinedIcon from "@mui/icons-material/EditOutlined";
import DeleteOutlineOutlinedIcon from "@mui/icons-material/DeleteOutlineOutlined";

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


type experience = { id: number, company_name: string, position: string, from: string, to: string, status: string }

const backgroundColors = (status) => {
    let backgroundColor = "";
    if (status === "Completed") backgroundColor = "primary.30";
    else
        if (status === "Working") backgroundColor = "orange.30";
        else backgroundColor = "orange.30";
    return backgroundColor;
};

export default function AccountInfoWorkExperience() {
    const [open, setOpen] = React.useState(false);
    const [status, setStatus] = React.useState("success");
    const [message, setMessage] = React.useState("This is a success message!");
    const [paddingRight, setPaddingRight] = React.useState("");
    const divRef = React.useRef(null);

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
    const {
        register,
        handleSubmit,
        setValue,
        reset,
        formState: {errors, isDirty},
    } = useForm<experience>();

    const experienceRecords = useQuery("experienceRecords", async () => {
        const {data} = await axios.get(route("api.web.v1.teacher-panel.account-info.work-experience.index"));
        experienceRecords.data = data.data;
        return experienceRecords;
    });

    const postExperienceRecords = useMutation(async (data) => {
        if (data.id) {
            return await axios.put(route("api.web.v1.teacher-panel.account-info.work-experience.update", {"work_experience": data.id}), data).data;
        }
        return await axios.post(route("api.web.v1.teacher-panel.account-info.work-experience.store"), data).data;
    }, {
        onSuccess: data => {
            setOpen(true);
            setStatus("success");
            setMessage("Send successfully");
            window.setTimeout(() => {
                experienceRecords.refetch();
            }, 1200);
            reset();
        }, onError: () => {
            setOpen(true);
            setStatus("error");
            setMessage("Error! Please try later");
        }
    });

    function editExperienceRecords(id) {
        let row = experienceRecords.data.data.find(row => row.id === id);
        setValue("id", row.id);
        setValue("company_name", row.company_name);
        setValue("position", row.position);
        setValue("from", row.from);
        setValue("to", row.to);
    }

    const deleteExperienceRecords = useMutation("deleteExperienceRecords", async (id) => {
            return await axios.delete(route("api.web.v1.teacher-panel.account-info.work-experience.destroy", {"work_experience": id}));

        }, {
            onSuccess: data => {
                setOpen(true);
                setStatus("success");
                setMessage("Delete successfully");
                window.setTimeout(() => {
                    experienceRecords.refetch();
                }, 1200);
            }, onError: () => {
                setOpen(true);
                setStatus("error");
                setMessage("Error! Please try later");
            }
        }
    );

    const onSubmit: SubmitHandler<experience> = (data) => {
        postExperienceRecords.mutate(data);
    };

    if (experienceRecords.isError) {
        return <p>Asghar Error</p>;
    }

    if (experienceRecords.isLoading) {
        return <p>Asghar Loading</p>;
    }

    return (
        <>
            <Container>
                <Snackbar open={open} autoHideDuration={6000} onClose={() => {
                    setOpen(false);
                }} anchorOrigin={{vertical: "top", horizontal: "right"}}>
                    <Alert onClose={() => {
                        setOpen(false);
                    }} severity={status} sx={{width: "100%"}}>
                        {message}
                    </Alert>
                </Snackbar>
                <Box sx={{mx: 7.5}}>
                    <Box sx={{
                        borderRadius: 1,
                        mt: 5,
                        py: 2.5,
                    }}>
                        <Box sx={{
                            borderLeft: 3,
                            borderColor: "primary.main",
                            ml: 1,
                        }}>
                            <Typography sx={{ml: 1}} fontWeight="bold" color="primary.main" variant="h6">
                                Insert New
                            </Typography>
                        </Box>
                        <form onSubmit={handleSubmit(onSubmit)}>
                            <Box sx={{mt: 5}}>
                                <Grid container spacing={4}>
                                    <Grid item xs={12} md={4} lg={3}>
                                        <TextField id="company_name" label="Company Name" variant="outlined" size="small" {...register("company_name")}
                                            fullWidth/>
                                    </Grid>
                                    <Grid item xs={12} md={4} lg={3}>
                                        <TextField id="position" label="Position" variant="outlined" size="small" {...register("position")}
                                            fullWidth/>
                                    </Grid>
                                    <Grid item xs={12} md={4} lg={3}>
                                        <TextField id="from" label="Start Year" variant="outlined" size="small" {...register("from")}
                                            fullWidth/>
                                    </Grid>
                                    <Grid item xs={12} md={4} lg={3}>
                                        <TextField id="to" label="End Year" variant="outlined" size="small" {...register("to")}
                                            fullWidth/>
                                    </Grid>
                                </Grid>
                                <Box textAlign="center">
                                    <Button
                                        disabled={!isDirty}
                                        type={"submit"}
                                        sx={{
                                        borderColor: "orange.main",
                                        backgroundColor: "orange.main",
                                        px: 7.5,
                                        my: 5,
                                    }} variant="contained">
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
                        }}
                    >
                        <TableContainer 
                             className="scrollbarInputs"
                             ref={divRef}                          
                             sx={{
                                 
                                 overflowY: "auto",
                                 maxHeight: "60vh",
                             }}
                        >
                            <Table 
                                stickyHeader
                                aria-label="customized table">
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
                                                CompanyName
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
                                                Document Name
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
                                            <Typography color="white" sx={{
                                                display: "flex",
                                                flexDirection: "row",
                                                justifyContent: "center",
                                                alignItems: "center",
                                            }}>
                                                Status
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
                                                Update/Remove
                                            </Typography>
                                        </StyledTableCell>
                                    </TableRow>
                                </TableHead>
                                <TableBody>
                                    {experienceRecords.data.data.map((row) => (
                                        <StyledTableRow sx={{
                                            borderColor: "primary.main",
                                        }} key={row.id}>
                                            <StyledTableCell sx={{
                                                borderColor: "primary.main",
                                            }} align="left">
                                                {row.company_name}
                                            </StyledTableCell>
                                            <StyledTableCell sx={{
                                                borderColor: "primary.main",
                                            }} align="center">
                                                {row.position}
                                            </StyledTableCell>
                                            <StyledTableCell sx={{
                                                borderColor: "primary.main",
                                            }} align="center">
                                                {row.from} / {row.to}
                                            </StyledTableCell>
                                            <StyledTableCell sx={{
                                                borderColor: "primary.main",
                                            }} align="center">
                                                <Box>
                                                    <Typography sx={{
                                                        backgroundColor:
                                                            backgroundColors(
                                                                row.status
                                                            ),
                                                        padding: 0.3,
                                                        width: "75%",
                                                        margin: "auto",
                                                        borderRadius: 10,
                                                    }} align="center">
                                                        {row.status}
                                                    </Typography>
                                                </Box>
                                            </StyledTableCell>
                                            <StyledTableCell sx={{
                                                borderColor: "primary.main",
                                            }} align="center">
                                                <IconButton>
                                                    <EditOutlinedIcon onClick={() => editExperienceRecords(row.id)}/>
                                                </IconButton>
                                                <IconButton>
                                                    <DeleteOutlineOutlinedIcon color={"error"}
                                                        onClick={() => deleteExperienceRecords.mutate(row.id)}/>
                                                </IconButton>
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
