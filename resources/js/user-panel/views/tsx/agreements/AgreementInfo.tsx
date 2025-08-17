import {
    Box,
    Button,
    Checkbox,
    FormControlLabel,
    FormGroup,
    Grid,
    Skeleton,
    Typography,
} from "@mui/material";
import { useState , useRef, useEffect } from "react";
import * as React from "react";
import { useParams } from "react-router-dom";
import { useMutation, useQuery } from "react-query";
import axios from "./../../../../axiosConfig";
import { route } from "../../../helpers";
import { SubmitHandler, useForm } from "react-hook-form";
import SnackbarAlert from "../../../../teacher-panel/components/SnackbarAlert";

type agreement = {
    acceptance: false;
};
export default function AgreementInfo() {
    const params = useParams();
    const [htmlData, setHtmlData] = useState<string>();

    const [open, setOpen] = React.useState(false);
    const [status, setStatus] = React.useState<"success" | "info" | "warning" | "error">("success");
    const [message, setMessage] = React.useState<string>("This is a success message!");
    const divRef = useRef<HTMLDivElement>(null); 
    const [disabled, setDisabled] = useState<boolean>(true);

  
    

    const {
        register,
        handleSubmit,
        formState: { errors, isValid },
    } = useForm<agreement>();

    const agreementsRecords = useQuery("agreementsRecords", async () => {
        const { data } = await axios.get(
            route("api.web.v1.user-panel.account-info.agreements.show", {
                agreement: params.id,
            })
        );
        agreementsRecords.data = data.data;
        setHtmlData(agreementsRecords.data.text);
        return agreementsRecords;
    });

    const acceptAgreement = useMutation(
        "acceptAgreement",
        async (data: agreement) => {
            return await axios.put(
                route("api.web.v1.user-panel.account-info.agreements.update", {
                    agreement: params.id,
                }),
                data
            );
        },
        {
            onSuccess: (data) => {
                setOpen(true);
                setStatus("success");
                setMessage("Agrrement Confirmed successfully");
                window.setTimeout(() => {
                    agreementsRecords.refetch();
                }, 1200);
            },
            onError: () => {
                setOpen(true);
                setStatus("error");
                setMessage("Error! Please try later");
            },
        }
    );

    const handlerOpen = () => {
        setOpen(false);
    };

    const onSubmit: SubmitHandler<agreement> = (data) => {
        acceptAgreement.mutate(data);
    };

// Button activation after scrolling
   


    useEffect(() => {
    const handleScroll = () => {
        if (
            (divRef.current?.scrollTop ?? 100) + (divRef.current?.clientHeight ?? 0) >=
            (divRef.current?.scrollHeight ?? 0)
          ) {
            setDisabled(false);
          }
    };
    
    divRef.current?.addEventListener('scroll', handleScroll as EventListener);
    
    return () => {
        divRef.current?.removeEventListener('scroll', handleScroll as EventListener);
    };
    }, []);
     
      
     


// End of Button activation after scrolling

    return (
        <>
            <SnackbarAlert
                open={open}
                handlerOpen={handlerOpen}
                status={status}
                massage={message}
            />
            <Box
                component={"form"}
                onSubmit={handleSubmit(onSubmit)}
                sx={{ py: 5, px: { xs: 2, lg: 5 } }}
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
                        variant="h3"
                    >
                        Agreement
                    </Typography>
                </Box>
                <Box marginTop={3}>
                    <Box
                        width={{ xs: "100%", lg: "65%" }}
                        marginX="auto"
                        height={{ xs: "100vh", lg: "65vh" }}
                        bgcolor="inputs"
                        paddingTop={3}
                        paddingLeft={3}
                        paddingRight={3}
                        paddingBottom={5}
                        borderRadius={5}
                        
                    >
                        <Box
                            className="scrollbarInputs"
                            marginX="auto"
                            height="100%"
                            sx={{ overflowY: "auto" }}
                            id="jafar"
                            ref={divRef}
                        >
                            {agreementsRecords.isLoading ? (
                                <>
                                    <Skeleton
                                        variant="text"
                                        sx={{ width: "100%" }}
                                    />
                                    <Skeleton
                                        variant="text"
                                        sx={{ width: "75%" }}
                                    />
                                    <Skeleton
                                        variant="text"
                                        sx={{ width: "80%" }}
                                    />
                                    <Skeleton
                                        variant="text"
                                        sx={{ width: "60%" }}
                                    />
                                    <Skeleton
                                        variant="text"
                                        sx={{ width: "100%" }}
                                    />
                                    <Skeleton
                                        variant="text"
                                        sx={{ width: "30%" }}
                                    />
                                    <Skeleton
                                        variant="text"
                                        sx={{ width: "60%" }}
                                    />
                                    <Skeleton
                                        variant="text"
                                        sx={{ width: "100%" }}
                                    />
                                    <Skeleton
                                        variant="text"
                                        sx={{ width: "100%" }}
                                    />
                                    <Skeleton
                                        variant="text"
                                        sx={{ width: "50%" }}
                                    />
                                    <Skeleton
                                        variant="text"
                                        sx={{ width: "100%" }}
                                    />
                                    <Skeleton
                                        variant="text"
                                        sx={{ width: "95%" }}
                                    />
                                </>
                            ) : (
                                <Typography
                                    textAlign="justify"
                                    paddingRight={2}
                                    height="100%"
                                    variant="body1"
                                    sx={{ pb: 1 }}
                                >
                                    <div
                                        dangerouslySetInnerHTML={{
                                            __html: htmlData,
                                        }}
                                    ></div>
                                </Typography>
                            )}
                        </Box>
                        {agreementsRecords.data?.data.acceptance === 0 && (
                            <FormGroup>
                                <FormControlLabel
                                    control={<Checkbox size="small"
                                    disabled={disabled}/>}
                                    {...register("acceptance", {
                                        required: true,
                                    })}
                                    label="I have read and agree to the Terms"
                                />
                            </FormGroup>
                        )}
                    </Box>
                    {agreementsRecords.data?.data.acceptance === 0 && (
                        <Box textAlign="center" marginTop={5}>
                            <Grid
                                container
                                spacing={1}
                                sx={{ width: { xs: "50%", md: "25% " } }}
                                marginX="auto"
                            >
                                <Grid item xs={12}>
                                    <Button
                                        type={"submit"}
                                        disabled={!isValid}
                                        sx={{ textTransform: "capitalize" }}
                                        fullWidth
                                        variant="contained"
                                    >
                                        Accept
                                    </Button>
                                </Grid>
                            </Grid>
                        </Box>
                    )}                    
                </Box>
            </Box>
        </>
    );
}
