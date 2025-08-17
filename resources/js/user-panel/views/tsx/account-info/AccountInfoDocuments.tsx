import * as React from "react";
import { styled, useTheme, Theme, CSSObject } from "@mui/material/styles";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import IconButton from "@mui/material/IconButton";
import {
    Tooltip,
    Button,
    Badge,
    Avatar,
    Menu,
    MenuItem,
    FormControl,
    Select,
    Link,
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
} from "@mui/material";
import FileUploadIcon from "@mui/icons-material/FileUpload";
import DeleteOutlineIcon from '@mui/icons-material/DeleteOutline';
import PDF from "../../../components/assets/pdf.svg";
import JPEG from "../../../components/assets/jpeg.svg";
import PNG from "../../../components/assets/png.svg";
import { route } from "./../../../helpers";
import {useEffect, useState} from "react";
import "react-dropzone-uploader/dist/styles.css";
import Dropzone from "react-dropzone-uploader";
import { SubmitHandler, useForm } from "react-hook-form";
import { useInfiniteQuery, useMutation, useQuery } from "react-query";
import axios from "./../../../../axiosConfig";
import CancelIcon from '@mui/icons-material/Cancel';
import CustomTheme from "../../../custom"
import { log } from "console";

const StyledTableCell = styled(TableCell)(({ theme }) => ({
    [`&.${tableCellClasses.head}`]: {
        backgroundColor: "primary.main",
        color: "primary.main",
    },
    [`&.${tableCellClasses.body}`]: {
        fontSize: 14,
    },
}));

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

function createData(
    Type: any,
    Title: string,
    date: string,
    Status: string,
    Update: React.ReactNode,
    Remove: React.ReactNode
) {
    return { date, Title, Type, Status, Update, Remove };
}

const backgroundColors = (status) => {
    console.log(status)
    let backgroundColor = "";
    switch (status) {
        case "Pending":
            backgroundColor = CustomTheme.palette.gray.main
            break;
        case "Verified":
            backgroundColor = CustomTheme.palette.primary.main
            break;
        case "Rejected":
            backgroundColor = CustomTheme.palette.orange.main
            break;
    }
    return backgroundColor;
};



const removeIconDisable = (status) => {
    if (status !== "In Progress") return true;
};



interface FormData {
    title: string;
    document?: any;
}

export default function AccountInfoDocuments() {
    const [open, setOpen] = React.useState(false);
    const [status, setStatus] = React.useState("success");
    const [message, setMessage] = React.useState("This is a success message!");
    const [files, setFiles] = useState([]);
    const divRef = React.useRef(null);
    const [paddingRight, setPaddingRight] = useState("");

    const accountInfoDocuments = useQuery("accountInfoDocuments", async () => {
        const { data } = await axios.get(
            route("api.web.v1.user-panel.account-info.documents.index")
        );
        accountInfoDocuments.data = data.data;
        return accountInfoDocuments;
    },{refetchInterval:3000});

    const getDocumentInfo = async (pageIndex, pageSize) => {
        const response = await axios.get(
            route(
                "api.web.v1.user-panel.account-info.documents.index",
                {},
                pageIndex,
                pageSize
            )
        )

        return response.data;
    }


    const {
        data,
        fetchNextPage,
        hasNextPage,
        isError,
        refetch,
        error,
        isLoading,
    } = useInfiniteQuery(
        "getDocumentInfo",
        ({ pageParam = 1 }) => getDocumentInfo(pageParam, 3),
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




    const { register, handleSubmit, control, setValue, getValues, formState: {errors, isDirty} } = useForm<FormData>();

    const onSubmit: SubmitHandler = (data) => documentStore.mutate(data);

    const headers = {
        "X-CSRF-TOKEN": document.head
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
    };

    const Preview = ({ meta }) => {
        const { name, percent, status } = meta;
        return (
            //  <Box display="flex" height="100%">
            //    <Typography
            //     marginRight={0.5}
            //     color="gray.60"
            // >
            //     Select File
            // </Typography>
            // <FileUploadIcon
            //     color="orange"
            //     size="large"
            // />
            //  </Box>
            <>
            </>
        );
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
    


    const getUploadParams = ({ meta, response }) => {
        return { url: route("api.public.temporary-file.store"), headers };
    };
    const handleChangeStatus = ({ xhr }, status, file) => {
        if (status === "done") {
            setFiles(file)
        }
    };

    const documentStore = useMutation(
        async (data) => {
            const response = await axios.post(route("api.web.v1.user-panel.account-info.documents.store"), data);
            return response.data;
        },
        {
            onSuccess: (data) => {
                setOpen(true);
                setStatus("success");
                setMessage("Your Data Saved successfully");
                window.setTimeout(() => {
                    refetch().then(() => console.log('Refetcheing is done'));
                }, 1200);
            },
            onError: () => {
                setOpen(true);
                setStatus("error");
                setMessage("Error! Please try later");
            },
            onSettled: () => {},
        }
    );

    useEffect(()=>{
        setValue("file", files[0]?.xhr?.response);
    },[files])

    if (accountInfoDocuments.isLoading) {
        return <p>loading...</p>;
    }
    return (
        <>
            <Container>
                <Snackbar
                    open={open}
                    autoHideDuration={6000}
                    onClose={() => {
                        setOpen(false);
                    }}
                    anchorOrigin={{ vertical: "top", horizontal: "right" }}
                >
                    <Alert
                        onClose={() => {
                            setOpen(false);
                        }}
                        severity={status}
                        sx={{ width: "100%" }}
                    >
                        {message}
                    </Alert>
                </Snackbar>
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
                        <Box component={"form"} sx={{ mt: 5 }}>

                            <form onSubmit={handleSubmit(onSubmit)}>
                                <Grid
                                    container
                                    columnSpacing={18}
                                    rowSpacing={4}
                                >
                                    <Grid item xs={12} md={6}>
                                        <TextField
                                            id="documentName"
                                            label="Document Name"
                                            variant="outlined"
                                            size="small"
                                            fullWidth
                                            {...register("title", { required: true })}
                                        />
                                    </Grid>
                                    <Grid item xs={12} md={6}>
                                        <Box
                                            bgcolor="inputs"
                                            border={1}
                                            borderColor="gray.30"
                                            borderRadius={1}
                                        >
                                           {files[0] ? (
                                               <Box px="5px" display="flex" justifyContent="space-between" alignItems="center">
                                                <Typography sx={{    textWrap: "nowrap", overflow: "hidden"}}>
                                                    {files[0].meta.name}
                                                </Typography>
                                                    <IconButton onClick={()=>{setFiles([])}}>
                                                    <CancelIcon sx={{color : CustomTheme.palette.orange.main}}/>
                                                </IconButton>
                                               </Box>
                                           ) : (
                                            <Dropzone
                                            canCancel={true}
                                            getUploadParams={
                                                getUploadParams
                                            }
                                            onChangeStatus={handleChangeStatus}
                                            PreviewComponent={Preview}
                                            inputContent={
                                                <>
                                                    <Typography
                                                        marginRight={0.5}
                                                        color="gray.60"
                                                    >
                                                        Select File
                                                    </Typography>
                                                    <FileUploadIcon
                                                        color="orange"
                                                        size="large"
                                                    />
                                                </>
                                            }
                                            multiple={false}
                                            maxFiles={1}
                                            accept="image/*,audio/*,video/*"
                                        />
                                           )}
                                        </Box>
                                    </Grid>
                                </Grid>
                                <Box textAlign="center">
                                    <Button
                                        type="submit"
                                        isLoading={true}
                                        onClick={(e) => {
                                            e.preventDefault();
                                            handleSubmit(onSubmit)(e);
                                        }}
                                        sx={{
                                            borderColor: "orange.main",
                                            backgroundColor: "orange.main",
                                            px: 7.5,
                                            my: 5,
                                        }}
                                        variant="contained"
                                        disabled={ !isDirty }
                                    >
                                        Submit
                                    </Button>
                                </Box>
                            </form>

                        </Box>
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
                                // sx={{
                                //     minWidth: 700,
                                //     mt: 3,
                                //     borderRadius: 5,
                                //     overflow: "hidden",
                                // }}
                                aria-label="customized table"
                            >
                                <TableHead
                                    sx={{ backgroundColor: "gray.main" }}
                                >
                                    <TableRow sx={{ borderRadius: 5 }}>
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
                                                Type
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
                                                    justifyContent: "left",
                                                    alignItems: "left",
                                                }}
                                            >
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
                                                Remove
                                            </Typography>
                                        </StyledTableCell>
                                    </TableRow>
                                </TableHead>
                                <TableBody>
                                    {accountInfoDocuments.data.data.map(
                                        (row) => (
                                            <StyledTableRow
                                                sx={{
                                                    borderColor: "primary.main",
                                                }}
                                                key={row.created_at}
                                            >
                                                <StyledTableCell
                                                    sx={{
                                                        borderColor:
                                                            "primary.main",
                                                    }}
                                                    align="center"
                                                >
                                                    {row.type}
                                                </StyledTableCell>
                                                <StyledTableCell
                                                    sx={{
                                                        borderColor:
                                                            "primary.main",
                                                    }}
                                                    align="left"
                                                >
                                                    {row.title}
                                                </StyledTableCell>
                                                <StyledTableCell
                                                    sx={{
                                                        borderColor:
                                                            "primary.main",
                                                    }}
                                                    align="center"
                                                >
                                                    {row.created_at}
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
                                                                        row.status
                                                                    ),
                                                                padding: 0.3,
                                                                width: "75%",
                                                                margin: "auto",
                                                                borderRadius: 10,
                                                            }}
                                                            align="center"
                                                        >
                                                            {row.status}
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
                                                    {removeIconDisable(
                                                        row.Status
                                                    ) ? (
                                                        <IconButton disabled>
                                                            <DeleteOutlineIcon
                                                            style={{
                                                                color: '#ff8c009c'
                                                            }}
                                                            />
                                                        </IconButton>
                                                    ) : (
                                                        <IconButton
                                                            sx={{
                                                                color: "orange.main",
                                                            }}
                                                        >
                                                            <DeleteOutlineIcon
                                                                style={{
                                                                    color: '#FF8C00 '
                                                                }}
                                                            />
                                                        </IconButton>
                                                    )}
                                                </StyledTableCell>
                                            </StyledTableRow>
                                        )
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
