import React, { useEffect, useState } from "react";
import {
    useForm,
    Controller,
    FormProvider,
    useFormContext,
} from "react-hook-form";
import {
    Box,
    Container,
    MenuItem,
    Select,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow,
    Typography,
    FormControl,
    InputLabel,
    tableCellClasses,
    styled,
    Alert,
    Snackbar,
    SelectChangeEvent,
} from "@mui/material";
import FormatAlignLeftIcon from "@mui/icons-material/FormatAlignLeft";
import FormatListBulletedIcon from "@mui/icons-material/FormatListBulleted";
import { useMutation, useQuery } from "react-query";
import axios from "../../../../axiosConfig";
import { route } from "../../../helpers";
import TableSkeleton from "../../../components/TableSkeleton";

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

function PrivacySelect({ id, name, defaultValue, handleChange }) {
    const { control } = useFormContext();
    const [ privacy , setPrivacy] = useState(defaultValue)

    const jafarfun = (event: SelectChangeEvent) => {
        handleChange(id, event.target.value);
        setPrivacy(event.target.value as string)
    };

    return (
        <FormControl size="small" sx={{ m: 0, width: "50%" }}>
            <Controller
                name={name}
                control={control}
                defaultValue={defaultValue}
                render={({ field }) => (
                    <Select {...field} value={privacy} onChange={jafarfun}>
                        <MenuItem value={0}>Public</MenuItem>
                        <MenuItem value={1}>
                            Followers Only
                        </MenuItem>
                        <MenuItem value={2}>Private</MenuItem>
                    </Select>
                )}
            />
        </FormControl>
    );
}

export default function Privacy() {
    const [open, setOpen] = React.useState(false);
    const [status, setStatus] = React.useState("success");
    const [message, setMessage] = React.useState("This is a success message!");
    const formMethods = useForm();

    const PrivacyDetail = useQuery("detail", async () => {
        const { data } = await axios.get(
            route("api.web.v1.user-panel.account-info.user-privacy.index")
        );
        PrivacyDetail.data = data.data;
        return PrivacyDetail;
    },{refetchInterval : 3000});

const [value,setValue]=useState("")


    const editPrivacyDetail = useMutation(
        async (data) => {
            return (await axios.put(route("api.web.v1.user-panel.account-info.update", {edit_Privacy_Detail: data,}),data))
        },
        {
            onSuccess: (data) => {
                setOpen(true);
                setStatus("success");
                setMessage("Send successfully");
                setTimeout(()=>{
                    setOpen(false)
                },3000)
            },
            onError: () => {
                setOpen(true);
                setStatus("error");
                setMessage("Error! Please try later");
            },
        }
    );

    const handleChange = (id, newvalue) => {
        editPrivacyDetail.mutate({
            privacy_policy_id : id,
            status : newvalue
        })
    };

    const onSubmit = (data) => {
        console.log(data);
    };

    useEffect(() => {
        formMethods.handleSubmit(onSubmit)();
    }, [formMethods.watch()]);

    function createData(title: string) {
        return { title };
    }

    return (
        <FormProvider {...formMethods}>
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
            <Box sx={{ py: 5, px: { xs: 2, lg: 5 } }}>
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
                        variant="h3"
                    >
                        Privacy
                    </Typography>
                </Box>
                <Container>
                    <TableContainer sx={{ overflow: "hidden", px: { lg: 10 } }}>
                        <Table
                            sx={{
                                minWidth: 700,
                                mt: 3,
                                borderRadius: 5,
                                overflow: "hidden",
                            }}
                            aria-label="simple table"
                        >
                            <TableHead>
                                <TableRow sx={{ backgroundColor: "gray.main" }}>
                                    <StyledTableCell sx={{ py: 1 }}>
                                        <Box
                                            sx={{
                                                display: "flex",
                                                alignItems: "center",
                                                justifyContent: "center",
                                                py: 0,
                                            }}
                                        >
                                            <FormatAlignLeftIcon
                                                sx={{
                                                    mr: "5px",
                                                    color: "white",
                                                }}
                                            />
                                            <Typography
                                                color="white"
                                                variant="h5"
                                            >
                                                Title
                                            </Typography>
                                        </Box>
                                    </StyledTableCell>
                                    <StyledTableCell
                                        sx={{ py: 1 }}
                                        align="right"
                                    >
                                        <Box
                                            sx={{
                                                display: "flex",
                                                alignItems: "center",
                                                justifyContent: "center",
                                                py: 0,
                                            }}
                                        >
                                            <FormatListBulletedIcon
                                                sx={{
                                                    mr: "5px",
                                                    color: "white",
                                                }}
                                            />
                                            <Typography
                                                color="white"
                                                variant="h5"
                                            >
                                                Status
                                            </Typography>
                                        </Box>
                                    </StyledTableCell>
                                </TableRow>
                            </TableHead>
                            <TableBody>
                                {PrivacyDetail.isLoading ? (
                                    <TableSkeleton cel={2} />
                                ) : (
                                    PrivacyDetail.data.data.map((row) => (
                                        <StyledTableRow
                                            key={row.title}
                                            sx={{
                                                "&:last-child td, &:last-child th":
                                                    {
                                                        border: 0,
                                                    },
                                                p: 0,
                                            }}
                                        >
                                            <StyledTableCell
                                                colSpan={1}
                                                align="center"
                                                sx={{ width: "50%" }}
                                            >
                                                <Box sx={{ ml: 0, p: 0 }}>
                                                    <Typography>
                                                        {row.title}
                                                    </Typography>
                                                </Box>
                                            </StyledTableCell>
                                            <StyledTableCell
                                                colSpan={1}
                                                align="center"
                                                sx={{ p: 0, width: "50%" }}
                                            >
                                                <PrivacySelect
                                                    id={row.id}
                                                    name={row.title}
                                                    defaultValue={row.active}
                                                    handleChange={handleChange}
                                                />
                                            </StyledTableCell>
                                        </StyledTableRow>
                                    ))
                                )}
                            </TableBody>
                        </Table>
                    </TableContainer>
                </Container>
            </Box>
        </FormProvider>
    );
}
