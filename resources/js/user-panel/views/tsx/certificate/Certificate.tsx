import {
    Box,
    Button,
    Card,
    CardActions,
    CardContent,
    Grid,
    IconButton,
    Skeleton,
    Typography,
} from "@mui/material";
import React from "react";
import { Link } from "react-router-dom";
import axios from "axios";
import { route } from "../../../helpers";
import { useQuery } from "react-query";

import CertificatePic from "./../../../assets/certificate.png";

import EmojiEventsIcon from "@mui/icons-material/EmojiEvents";
import MoreVertIcon from "@mui/icons-material/MoreVert";
import CheckCircleIcon from "@mui/icons-material/CheckCircle";
import CertificateSkeleton from "./CertificateSkeleton";
export default function Certificate() {
    const certificates = [
        {
            id: 1,
            topic: "Guided Project | Landa Trip Network",
            title: "Get Started with English",
            score: "Great work! You have passed all requirement with total score 90/100.",
            certificate: CertificatePic,
        },
        {
            id: 2,
            topic: "Guided Project | Landa Trip Network",
            title: "Get Started with English",
            score: "Great work! You have passed all requirement with total score 90/100.",
            certificate: CertificatePic,
        },
        {
            id: 3,
            topic: "Guided Project | Landa Trip Network",
            title: "Get Started with English",
            score: "Great work! You have passed all requirement with total score 90/100.",
            certificate: CertificatePic,
        },
    ];


    const certificateRecords = useQuery("certificateRecord", async () => {
        const { data } = await axios.get(
            route("api.web.v1.user-panel.certificate.index")
        );
        certificateRecords.data = data.data;
        return certificateRecords;
    });

    const skeletonVar = true;

    if (certificateRecords.isLoading){
        return <p>loading...</p>
    }
    const pending = certificateRecords.data.data.filter((item)=>item.status===0).length
    const completed = certificateRecords.data.data.filter((item)=>item.status===1).length
    const all = certificateRecords.data.data.filter((item)=>item.status).length
    return (
        <>
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
                        Certificate
                    </Typography>
                </Box>
                <Box sx={{ my: 3, mx: { lg: 15 } }}>
                    <Grid container spacing={2}>
                        <Grid
                            item
                            md={4}
                            xs={12}
                            alignItems="center"
                            justifyItems="center"
                        >
                            <Card sx={{ boxShadow: 4, borderRadius: 3 }}>
                                <CardContent
                                    sx={{
                                        display: "flex",
                                        justifyContent: "center",
                                    }}
                                >
                                    <Box alignSelf="center">
                                        <EmojiEventsIcon
                                            sx={{
                                                width: "50px",
                                                height: "50px",
                                            }}
                                        />
                                    </Box>
                                    <Box marginLeft={2}>
                                        <Typography
                                            textAlign="center"
                                            variant="h4"
                                        >
                                            {skeletonVar ? (
                                                all
                                            ) : (
                                                <Skeleton
                                                    sx={{
                                                        display: "inline-block",
                                                        verticalAlign:
                                                            "text-center",
                                                    }}
                                                    animation="wave"
                                                    variant="rounded"
                                                    width={30}
                                                    height={20}
                                                />
                                            )}
                                        </Typography>
                                        <Typography
                                            textAlign="center"
                                            variant="h6"
                                            color="gray.main"
                                        >
                                            Total Certificates
                                        </Typography>
                                    </Box>
                                </CardContent>
                            </Card>
                        </Grid>
                        <Grid
                            item
                            md={4}
                            xs={12}
                            alignItems="center"
                            justifyItems="center"
                        >
                            <Card sx={{ boxShadow: 4, borderRadius: 3 }}>
                                <CardContent
                                    sx={{
                                        display: "flex",
                                        justifyContent: "center",
                                    }}
                                >
                                    <Box alignSelf="center">
                                        <EmojiEventsIcon
                                            sx={{
                                                width: "50px",
                                                height: "50px",
                                            }}
                                        />
                                    </Box>
                                    <Box marginLeft={2}>
                                        <Typography
                                            textAlign="center"
                                            variant="h4"
                                        >
                                            {skeletonVar ? (
                                                pending
                                            ) : (
                                                <Skeleton
                                                    sx={{
                                                        display: "inline-block",
                                                        verticalAlign:
                                                            "text-center",
                                                    }}
                                                    animation="wave"
                                                    variant="rounded"
                                                    width={30}
                                                    height={20}
                                                />
                                            )}
                                        </Typography>
                                        <Typography
                                            textAlign="center"
                                            variant="h6"
                                            color="gray.main"
                                        >
                                            Pending ...
                                        </Typography>
                                    </Box>
                                </CardContent>
                            </Card>
                        </Grid>
                        <Grid
                            item
                            md={4}
                            xs={12}
                            alignItems="center"
                            justifyItems="center"
                        >
                            <Card sx={{ boxShadow: 4, borderRadius: 3 }}>
                                <CardContent
                                    sx={{
                                        display: "flex",
                                        justifyContent: "center",
                                    }}
                                >
                                    <Box alignSelf="center">
                                        <EmojiEventsIcon
                                            sx={{
                                                width: "50px",
                                                height: "50px",
                                            }}
                                        />
                                    </Box>
                                    <Box marginLeft={2}>
                                        <Typography
                                            textAlign="center"
                                            variant="h4"
                                        >
                                            {skeletonVar ? (
                                                completed
                                            ) : (
                                                <Skeleton
                                                    sx={{
                                                        display: "inline-block",
                                                        verticalAlign:
                                                            "text-center",
                                                    }}
                                                    animation="wave"
                                                    variant="rounded"
                                                    width={30}
                                                    height={20}
                                                />
                                            )}
                                        </Typography>
                                        <Typography
                                            textAlign="center"
                                            variant="h6"
                                            color="gray.main"
                                        >
                                            Certificate Issued
                                        </Typography>
                                    </Box>
                                </CardContent>
                            </Card>
                        </Grid>
                    </Grid>
                </Box>
                <Box>
                    {skeletonVar ?
                    certificates.map((certificate) => (
                        <Card
                            key={certificate.id}
                            sx={{
                                display: "flex",
                                flexDirection: { xs: "column", md: "row" },
                                justifyContent: "space-between",
                                p: 1,
                                my: 5,
                                boxShadow: 3,
                            }}
                        >
                            <CardContent>
                                <Typography variant="h6">
                                    {certificate.topic}
                                </Typography>
                                <Typography
                                    variant="h4"
                                    color="primary.main"
                                    marginY={2}
                                >
                                    {certificate.title}
                                </Typography>
                                <Typography variant="h6">
                                    <CheckCircleIcon
                                        sx={{
                                            color: "primary.main",
                                            width: "16px",
                                            height: "16px",
                                            verticalAlign:"text-bottom",mr:0.25
                                        }}
                                    />
                                    {certificate.score}
                                </Typography>
                            </CardContent>
                            <CardActions
                                sx={{
                                    display: "flex",
                                    flexDirection: "column",
                                    justifyContent: "space-between",
                                }}
                            >
                                <IconButton sx={{ placeSelf: "end" }}>
                                    <MoreVertIcon />
                                </IconButton>
                                <Link to={"certificatePic"}>
                                    <Button variant="contained" size="large">
                                        View Certificate
                                    </Button>
                                </Link>
                            </CardActions>
                        </Card>
                    ))
                    :
                        <CertificateSkeleton/>
                    }
                </Box>
            </Box>
        </>
    );
}
