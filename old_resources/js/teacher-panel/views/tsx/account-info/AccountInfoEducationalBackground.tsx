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
} from "@mui/material";
import EditOutlinedIcon from "@mui/icons-material/EditOutlined";
import DeleteOutlineOutlinedIcon from "@mui/icons-material/DeleteOutlineOutlined";
import axios from "./../../../../axiosConfig";
import {route} from "../../../helpers";
import {useForm, SubmitHandler} from "react-hook-form";
import {useInfiniteQuery, useMutation, useQuery} from "react-query";
import SnackbarAlert from "../../../components/SnackbarAlert";


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

type educationForm = {title: string, university: string, level: string, from: string, to: string, id?: number  }

const backgroundColors = (status) => {
    let backgroundColor = "";
    if (status === "Completed") backgroundColor = "primary.30";
    else
        if (status === "Student") backgroundColor = "orange.30";
        else backgroundColor = "orange.30";
    return backgroundColor;
};

export default function AccountInfoEducationalBackground() {
    const [open, setOpen] = React.useState(false);
    const [status, setStatus] = React.useState<"success" | "info" | "warning" | "error">("success");
    const [message, setMessage] = React.useState("This is a success message!");
    const divRef = React.useRef(null);
    const [paddingRight, setPaddingRight] = React.useState("");


    const {
        register,
        handleSubmit,
        setValue,
        reset,
        formState: {errors, isDirty},
    } = useForm<educationForm>({mode:"onChange"});

    const educationalRecords = useQuery("Educational", async () => {
        const {data} = await axios.get(route("api.web.v1.teacher-panel.account-info.educational-background.index"));
        educationalRecords.data = data.data;
        return educationalRecords;
    });

    const postEducationalRecords = useMutation(async ( data:{id:number}) => {
        if (data.id) {
            return await axios.put(route("api.web.v1.teacher-panel.account-info.educational-background.update", {"educational_background": data.id}), data).data;
        }
        return await axios.post(route("api.web.v1.teacher-panel.account-info.educational-background.store"), data).data;
    }, {
        onSuccess: data => {
            setOpen(true);
            setStatus("success");
            setMessage("Send successfully");
            window.setTimeout(() => {
                educationalRecords.refetch();
            }, 1200);
            reset();
        }, onError: () => {
            setOpen(true);
            setStatus("error");
            setMessage("Error! Please try later");
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

    // const educationalRecords2 = async (pageIndex, pageSize) => {
    //     const response = await axios.get(route("api.web.v1.teacher-panel.account-info.educational-background.index", {}, pageIndex, pageSize))
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
    // } = useInfiniteQuery('educationalRecords2', ({pageParam = 1}) => educationalRecords2(pageParam, 3), {
    //     getNextPageParam: (lastPage) => {
    //         const {meta} = lastPage;
    //         if (meta.current_page < meta.last_page) {
    //             return meta.current_page + 1;
    //         }
    //         return null;
    //     }
    // });
    // console.log(data);


    function editEducationalRecords(id) {
        let row = educationalRecords.data.data.find(row => row.id === id);
        setValue("id", row.id)
        setValue("title", row.title)
        setValue("university", row.university)
        setValue("level", row.level)
        setValue("from", row.from)
        setValue("to", row.to)
    }
    const deleteWorkExperienceRecord = useMutation("deleteWorkExperienceRecord", async (id:number) => {
            return await axios.delete(route("api.web.v1.teacher-panel.account-info.educational-background.destroy", {"educational_background": id}));

        }, {
            onSuccess: data => {
                setOpen(true);
                setStatus("success");
                setMessage("Delete successfully");
                window.setTimeout(() => {
                    educationalRecords.refetch();
                }, 1200);
            }, onError: () => {
                setOpen(true);
                setStatus("error");
                setMessage("Error! Please try later");
            }
        }
    );

    const onSubmit: SubmitHandler<educationForm> = (data) => {
        postEducationalRecords.mutate(data);
    }

    if (educationalRecords.isError) {
        return <p>Asghar Error</p>;
    }

    if (educationalRecords.isLoading) {
        return <p>Asghar Loading</p>;
    }
    const handlerOpen = () => {
        setOpen(false)
    }




    return (
        <>
            <Container>
                <SnackbarAlert open={open} handlerOpen={handlerOpen} status={status} massage={message}/>
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
                                    <TextField id="title" label="Field" variant="outlined" size="small" {...register("title")} fullWidth/>
                                </Grid>
                                <Grid item xs={12} md={4} lg={3}>
                                    <TextField id="university" label="University/College" variant="outlined" size="small" {...register("university")} fullWidth/>
                                </Grid>
                                <Grid item xs={12} md={4} lg={3}>
                                    <TextField id="level" label="Degree" variant="outlined" size="small" {...register("level")} fullWidth/>
                                </Grid>
                                <Grid item xs={12} md={4} lg={3}>
                                    <TextField id="from" label="Start Year" variant="outlined" size="small" {...register("from")} fullWidth/>
                                </Grid>
                                <Grid item xs={12} md={4} lg={3}>
                                    <TextField id="to" label="End Year" variant="outlined" size="small" {...register("to")} fullWidth/>
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
                                                Field
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
                                                University/College
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
                                                Degree
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
                                                Start to End Year
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
                                    {educationalRecords.data.data.map((row) => (
                                        <StyledTableRow sx={{
                                            borderColor: "primary.main",
                                        }} key={row.id}>
                                            <StyledTableCell sx={{
                                                borderColor: "primary.main",
                                            }} align="left">
                                                {row.title}
                                            </StyledTableCell>
                                            <StyledTableCell sx={{
                                                borderColor: "primary.main",
                                            }} align="center">
                                                {row.university}
                                            </StyledTableCell>
                                            <StyledTableCell sx={{
                                                borderColor: "primary.main",
                                            }} align="center">
                                                {row.level}
                                            </StyledTableCell>
                                            <StyledTableCell sx={{
                                                borderColor: "primary.main",
                                            }} align="center">
                                                {row.from} / {row.to}
                                            </StyledTableCell>
                                            <StyledTableCell
                                                sx={{
                                                    borderColor: "primary.main",
                                                }} 
                                                align="center"
                                            >
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
                                            <StyledTableCell
                                                sx={{
                                                    borderColor: "primary.main",
                                                }} 
                                                align="center"
                                            >
                                                <IconButton >
                                                    <EditOutlinedIcon
                                                    onClick={() => editEducationalRecords(row.id)}/>
                                                </IconButton>
                                                <IconButton
                                                    onClick={() => deleteWorkExperienceRecord.mutate(row.id)}
                                                >
                                                    <DeleteOutlineOutlinedIcon color={"error"}
                                                    />
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
