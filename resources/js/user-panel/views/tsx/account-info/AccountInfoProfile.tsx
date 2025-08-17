import * as React from "react";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import IconButton from "@mui/material/IconButton";
import {
    Button,
    Avatar,
    MenuItem,
    FormControl,
    Select,
    TextField,
    Container,
    Grid,
    Autocomplete,
    InputLabel,
    Skeleton,
} from "@mui/material";
import CameraAltIcon from "@mui/icons-material/CameraAlt";
import avatar from "../../../components/assets/avatar0.png";
import { useMutation, useQuery } from "react-query";
import axios from "./../../../../axiosConfig";
import { route } from "../../../helpers";
import { useForm, SubmitHandler } from "react-hook-form";
import { toast } from "react-toastify";
import "react-dropzone-uploader/dist/styles.css";
import Dropzone from "react-dropzone-uploader";
import SnackbarAlert from "../../../../user-panel/components/SnackbarAlert";
import AccountInfoProfileSkeleton from "../../../../user-panel/views/tsx/account-info/AccountInfoProfileSkeleton";
import customTheme from "../../../custom";

type accountInfo = {
    fname: string;
    lname: string;
    email: string;
    phone_number: number;
    birthday: string;
    country: string;
    city: string;
    location: string;
    sex: number;
    about_me: string;
    code: number;
    name: string;
    title: string;
    slug: string;
};

export default function AccountInfoProfile() {
    const [open, setOpen] = React.useState(false);
    const [status, setStatus] = React.useState<
        "success" | "info" | "warning" | "error"
    >("success");
    const [message, setMessage] = React.useState<string>(
        "This is a success message!"
    );

    const {
        register,
        handleSubmit,
        setValue,
        formState: { errors, isValid },
    } = useForm<accountInfo>({ mode: "onBlur" });

    const accountInfoRecords = useQuery("accountInfoRecords", async () => {
        const { data } = await axios.get(
            route("api.web.v1.user-panel.account-info.details.index")
        );
        accountInfoRecords.data = data.data;
        countryRecords.mutate();
        return accountInfoRecords;
    });

    const countryRecords = useMutation("countryRecords", async () => {
        const { data } = await axios.get(
            route("api.web.v1.user-panel.country.index")
        );
        countryRecords.data = data.data;
        return countryRecords;
    });

    const citiesRecords = useMutation("citiesRecords", async (slug) => {
        const { data } = await axios.get(
            route("api.web.v1.user-panel.find.cities", { country: slug })
        );
        citiesRecords.data = data.data;

        return citiesRecords;
    });
    const postContactDetails = useMutation(
        async (data: accountInfo) => {
            const response = await axios.put(
                route("api.web.v1.user-panel.account-info.details-update"),
                data
            );
            return response.data;
        },
        {
            onSuccess: (data) => {
                setOpen(true);
                setStatus("success");
                setMessage("Update successfully");
            },
            onError: () => {
                setOpen(true);
                setStatus("error");
                setMessage("Error! Please try later");
            },
            onSettled: () => {},
        }
    );
    const addGender = (e, values) => {
        console.log(values.props.value);
        setValue("sex", values.props.value);
    };

    const handleCountry = (e, values) => {
        citiesRecords.mutate(values.slug);
        setValue("country", values.name);
    };
    const handleCity = (e, values) => {
        setValue("location", values.id);
    };
    const onSubmit: SubmitHandler<accountInfo> = (data: accountInfo) => {
        console.log(data);
        postContactDetails.mutate(data);
    };

    // if (countryRecords.isError || accountInfoRecords.isError) {
    //     return <p>Asghar Error</p>;
    // }

    // if (countryRecords.isLoading ) {
    //     return <p>Asghar Loading222</p>;
    // }

    const handlerOpen = () => {
        setOpen(false);
    };

    const country = countryRecords.isSuccess
        ? countryRecords.data.data.findIndex(
              (item) => item.name === accountInfoRecords.data.data.country
          )
        : null;

    // upload image

    const [dropzoneKey, setDropzoneKey] = React.useState(Date.now());
    const [uploadImage, setUploadImage] = React.useState(null);

    const Preview = ({ meta }) => {
        const { name, percent, status } = meta;
        return (
            <Typography
                sx={{
                    borderRadius: 10,
                    bgcolor: customTheme.palette.primary.main,
                    p: "5px 15px",
                    color: "white",
                }}
            >
                Upload Image
            </Typography>
        );
    };

    const handleChangeStatus = ({ xhr }, status, file) => {
        if (status === "done") {
            setUploadImage(file);
            setDropzoneKey(Date.now());
        }
    };

    const handleDeleteUpload = () => {
        setUploadImage(null);
        setDropzoneKey(Date.now());
    };

    // End of upload image

     // upload image background

     const [dropzoneKeyBackground, setDropzoneKeyBackground] = React.useState(Date.now());
     const [uploadImageBackground, setUploadImageBackground] = React.useState(null);
     const [uploadImageBackgroundError, setUploadImageBackgroundError] = React.useState("");


     const PreviewBackground = ({ meta }) => {
         const { name, percent, status } = meta;
         return (
             <Button variant="contained"  sx={{textWrap : "nowrap"}}>
                 Upload Image
             </Button>
         );
     };

    const headers = {
        "X-CSRF-TOKEN": document.head
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
    const getUploadParams = ({ meta, response }) => {
            return { url: route("api.public.temporary-file.store"), headers };
    };
     const handleChangeStatusBackground = ({ xhr }, status, file) => {

         if (status === "done" && file[0].meta.width > 920 && file[0].meta.height < 400) {

             setUploadImageBackground(file);
         }
         setDropzoneKeyBackground(Date.now());
     };

     const handleDeleteUploadBackground = () => {
         setUploadImageBackground(null);
         setDropzoneKeyBackground(Date.now());
     };

     // End of upload image background

    // @ts-ignore
    return (
        <>
            <Container>
                <SnackbarAlert
                    open={open}
                    handlerOpen={handlerOpen}
                    status={status}
                    message={message}
                />
                <Box sx={{ mx: 7.5 , margin : 0}}>
                <Box
                        sx={{
                            borderRadius: 1,
                            mt: 5,
                            pb: "20px",
                            pt: "69px",
                            position: "relative",
                            backgroundImage: uploadImageBackground ? `url(${uploadImageBackground[0].meta.previewUrl})` : "none",
                            backgroundSize: "cover",
                            bgcolor : uploadImageBackground ? "none" | ""  : customTheme.palette.inputs


                        }}

                    >


                        <Typography
                            sx={{ mt: 1, mb: 2 }}
                            variant="body2"
                            textAlign="center"
                            color="gray.main"
                        >
                            Image Must Be 256*256px-Max2MB
                        </Typography>
                        <Box
                            display="flex"
                            justifyContent="center"
                            alignItems="center"
                            flexWrap="wrap"

                        >
                            <Button variant="contained"  sx={{textWrap : "nowrap"}}>
                                Upload Image
                                <Dropzone
                                    key={dropzoneKeyBackground}
                                    getUploadParams={
                                    getUploadParams
                                    }
                                    // onChangeStatus={
                                    //     handleChangeStatus
                                    // }
                                    styles={{ dropzone: { overflow : "hidden" , border : "none" , position : "absolute", width : "140px" , height : "38px" , minHeight : 0 } }}
                                    onChangeStatus={handleChangeStatusBackground}
                                    // PreviewComponent={PreviewBackground}
                                    canRemove={false}
                                    inputContent={
                                        <>

                                        </>
                                    }
                                    multiple={false}
                                    maxFiles={1}
                                    accept="image/*,audio/*,video/*"

                                />

                            </Button>
                            {/* <Button
                                variant="contained"
                                sx={{ borderRadius: 10 }}
                            >
                                Upload Image
                            </Button> */}

                                <Button
                                    sx={{
                                        borderColor: "orange.main",
                                        color: "orange.main",

                                    }}
                                    onClick={handleDeleteUploadBackground}
                                    variant="outlined"
                                >
                                    Delete Image
                                </Button>

                        </Box>
                        <Box
                            sx={{
                                position: "absolute",
                                top : "10%",
                                left: "7.5%",
                                transform: "translate(0, 50%)",
                            }}
                        >
                                                     {uploadImage ? (
                                <Avatar
                                    sx={{
                                        width: 130,
                                        height: 130,
                                        mx: "auto",
                                        position: "relative",
                                    }}
                                    src={uploadImage[0].meta.previewUrl}
                                />
                            ) : (
                                <Avatar
                                    sx={{
                                        width: 130,
                                        height: 130,
                                        mx: "auto",
                                        position: "relative",
                                        zIndex: 0,
                                    }}
                                    src={avatar}
                                />
                            )}

                            <Box
                                sx={{
                                    width: "35px",
                                    borderRadius: "50%",
                                    position: "relative",
                                    right: "-100px",

                                    bottom: "52px",
                                }}
                            >
                                <Dropzone
                                    key={dropzoneKey}
                                    // getUploadParams={
                                    //     getUploadParams
                                    // }
                                    onChangeStatus={handleChangeStatus}
                                    // PreviewComponent={Preview}
                                    styles={{ dropzone: {border : 0 , overflow : "hidden" , height : "38px" , minHeight : 0 } }}
                                    canRemove={false}
                                    inputContent={
                                        <CameraAltIcon
                                            sx={{
                                                color: "white",
                                                bgcolor:
                                                    customTheme.palette.primary
                                                        .main,
                                                borderRadius: "50%",
                                                fontSize: "35px",
                                                p: "5px",
                                            }}
                                        />
                                    }
                                    multiple={false}
                                    maxFiles={1}
                                    accept="image/*,audio/*,video/*"
                                />
                            </Box>
                        </Box>
                    </Box>
                    <form onSubmit={handleSubmit(onSubmit)}>
                        <Box sx={{ mt: 10 }}>
                            {accountInfoRecords.isLoading ? (
                                <AccountInfoProfileSkeleton />
                            ) : (
                                <Grid
                                    container
                                    columnSpacing={10}
                                    rowSpacing={4}
                                >
                                    <Grid item xs={12} md={6} lg={4}>
                                        <TextField
                                            id="fname"
                                            {...register("fname", {
                                                required: true,
                                            })}
                                            defaultValue={
                                                accountInfoRecords.data.data
                                                    .fname
                                            }
                                            label="First Name"
                                            variant="outlined"
                                            size="small"
                                            fullWidth
                                        />
                                        {errors.fname?.type === "required" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                First Name is required
                                            </Typography>
                                        )}
                                    </Grid>
                                    <Grid item xs={12} md={6} lg={4}>
                                        <TextField
                                            id="lname"
                                            label="Last Name"
                                            variant="outlined"
                                            size="small"
                                            fullWidth
                                            {...register("lname", {
                                                required: true,
                                            })}
                                            defaultValue={
                                                accountInfoRecords.data.data
                                                    .lname
                                            }
                                        />
                                        {errors.lname?.type === "required" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Last Name is required
                                            </Typography>
                                        )}
                                    </Grid>
                                    <Grid item xs={12} md={6} lg={4}>
                                        <TextField
                                            id="title"
                                            label="title"
                                            variant="outlined"
                                            size="small"
                                            fullWidth
                                            {...register("title", {
                                                required: true,
                                            })}
                                            defaultValue={
                                                accountInfoRecords.data.data
                                                    .title
                                            }
                                        />
                                        {errors.title?.type === "required" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Title Name is required
                                            </Typography>
                                        )}
                                    </Grid>
                                    <Grid item xs={12} md={6} lg={4}>
                                        <TextField
                                            id="phone_number"
                                            label="Contact Number"
                                            variant="outlined"
                                            size="small"
                                            fullWidth
                                            {...register("phone_number", {
                                                required: true,
                                                pattern:
                                                    /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/,
                                            })}
                                            defaultValue={
                                                accountInfoRecords.data.data
                                                    .phone_number
                                            }
                                        />
                                        {errors.phone_number?.type ===
                                            "required" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Phone Number is required
                                            </Typography>
                                        )}
                                        {errors.phone_number?.type ===
                                            "pattern" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Please enter a valid Phone
                                                Number
                                            </Typography>
                                        )}
                                    </Grid>

                                    <Grid item xs={12} md={6} lg={4}>
                                        {countryRecords.isSuccess ? (
                                            <Autocomplete
                                                size="small"
                                                id="country"
                                                fullWidth
                                                onChange={(event, values) =>
                                                    handleCountry(event, values)
                                                }
                                                options={
                                                    countryRecords.data.data
                                                }
                                                getOptionLabel={(option) =>
                                                    option.name
                                                }
                                                defaultValue={
                                                    countryRecords.data.data[
                                                        country
                                                    ]
                                                }
                                                renderOption={(
                                                    props,
                                                    option
                                                ) => (
                                                    <Box
                                                        component="li"
                                                        sx={{
                                                            "& > img": {
                                                                mr: 2,
                                                                flexShrink: 0,
                                                            },
                                                        }}
                                                        {...props}
                                                    >
                                                        <img
                                                            loading="lazy"
                                                            width="20"
                                                            src={`https://flagcdn.com/w20/${option.code.toLowerCase()}.png`}
                                                            srcSet={`https://flagcdn.com/w40/${option.code.toLowerCase()}.png 2x`}
                                                            alt=""
                                                        />
                                                        {option.name} (
                                                        {option.code})
                                                    </Box>
                                                )}
                                                renderInput={(params) => (
                                                    <TextField
                                                        {...params}
                                                        label="Location"
                                                        inputProps={{
                                                            ...params.inputProps,
                                                            autoComplete:
                                                                "new-password",
                                                        }}
                                                    />
                                                )}
                                            />
                                        ) : (
                                            <Skeleton
                                                animation="wave"
                                                variant="rounded"
                                                // width={200}
                                                height={40}
                                            />
                                        )}
                                    </Grid>

                                    <Grid item xs={12} md={6} lg={4}>
                                        {citiesRecords.isSuccess ? (
                                            <Autocomplete
                                                disablePortal
                                                id="location"
                                                options={
                                                    citiesRecords.data.data
                                                }
                                                size="small"
                                                fullWidth
                                                getOptionLabel={(option: any) =>
                                                    option.name
                                                        ? option.name
                                                        : "Please Select a City"
                                                }
                                                onChange={(event, values) =>
                                                    handleCity(event, values)
                                                }
                                                renderInput={(params) => (
                                                    <TextField
                                                        {...params}
                                                        label="City"
                                                    />
                                                )}
                                            />
                                        ) : (
                                            <Autocomplete
                                                disabled={true}
                                                disablePortal
                                                id="city"
                                                options={[]}
                                                size="small"
                                                fullWidth
                                                defaultValue={
                                                    accountInfoRecords.data.data
                                                        .city
                                                }
                                                renderInput={(params) => (
                                                    <TextField
                                                        {...params}
                                                        label="City"
                                                        {...register("city")}
                                                    />
                                                )}
                                            />
                                        )}
                                    </Grid>
                                    <Grid item xs={12} md={6} lg={4}>
                                        <FormControl fullWidth size="small">
                                            <InputLabel id="sex">
                                                Gender
                                            </InputLabel>
                                            <Select
                                                defaultValue={
                                                    accountInfoRecords.data.data
                                                        .sex
                                                }
                                                {...register("sex", {
                                                    required: true,
                                                })}
                                                onChange={(event, values) =>
                                                    addGender(event, values)
                                                }
                                                name="sex"
                                                labelId="gender"
                                                id="sex"
                                                label="Gender"
                                            >
                                                <MenuItem value={0}>
                                                    Male
                                                </MenuItem>
                                                <MenuItem value={1}>
                                                    Female
                                                </MenuItem>
                                                <MenuItem value={2}>
                                                    Prefer Not to Say
                                                </MenuItem>
                                            </Select>
                                            {errors.sex?.type ===
                                                "required" && (
                                                <Typography
                                                    variant="caption"
                                                    color="error"
                                                    role="alert"
                                                >
                                                    Gender is required
                                                </Typography>
                                            )}
                                        </FormControl>
                                    </Grid>
                                    <Grid item xs={12} md={6} lg={4}>
                                        <TextField
                                            id="slug"
                                            label="User Slug"
                                            variant="outlined"
                                            size="small"
                                            fullWidth
                                            {...register("slug", {
                                                required: true,
                                            })}
                                            defaultValue={
                                                accountInfoRecords.data.data
                                                    .slug
                                            }
                                        />
                                        {errors.slug?.type === "required" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                User Slug is required
                                            </Typography>
                                        )}
                                    </Grid>
                                    <Grid item xs={12} md={6} lg={4}>
                                        <TextField
                                            type="date"
                                            id="Birthday"
                                            size="small"
                                            defaultValue={
                                                accountInfoRecords.data.data
                                                    .birthday
                                            }
                                            sx={{ width: "100%" }}
                                            label="Birthday"
                                            variant="outlined"
                                            InputLabelProps={{ shrink: true }}
                                            {...register("birthday", {
                                                required: true,
                                                minLength: 1,
                                            })}
                                        />
                                        {errors.birthday?.type ===
                                            "required" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                Birthday is required
                                            </Typography>
                                        )}
                                    </Grid>
                                    <Grid item xs={12} sx={{ mb: 5 }}>
                                        <TextField
                                            fullWidth
                                            id="about_me"
                                            label="About You"
                                            multiline
                                            rows={4}
                                            {...register("about_me", {
                                                required: true,
                                            })}
                                            defaultValue={
                                                accountInfoRecords.data.data
                                                    .about_me
                                            }
                                        />
                                        {errors.about_me?.type ===
                                            "required" && (
                                            <Typography
                                                variant="caption"
                                                color="error"
                                                role="alert"
                                            >
                                                About Me is required
                                            </Typography>
                                        )}
                                    </Grid>
                                </Grid>
                            )}
                            <Box textAlign="center">
                                <Button
                                    disabled={!isValid}
                                    sx={{
                                        borderColor: "orange.main",
                                        backgroundColor: "orange.main",
                                        px: 7.5,
                                        mb: 5,
                                    }}
                                    variant="contained"
                                    type={"submit"}
                                >
                                    Save
                                </Button>
                            </Box>
                        </Box>
                    </form>
                </Box>
            </Container>
        </>
    );
}
