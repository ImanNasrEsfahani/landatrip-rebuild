import {
    Box,
    Container,
    Grid,
    LinearProgress,
    LinearProgressProps,
    Skeleton,
    Typography,
} from "@mui/material";
import React from "react";

import badge from "./../../../assets/badge.png";
import BadgeSkeleton from "./BadgeSkeleton";
import axios from "axios";
import { route } from "../../../helpers";
import { useQuery } from "react-query";

function LinearProgressWithLabel(
    props: LinearProgressProps & { value: number }
) {
    return (
        <Box sx={{ display: "flex", alignItems: "center" }}>
            <Box sx={{ width: "100%", mr: 1 }}>
                <LinearProgress variant="determinate" {...props} />
            </Box>
            <Box sx={{ minWidth: 35 }}>
                <Typography
                    variant="body2"
                    color="text.secondary"
                >{`${Math.round(props.value)}%`}</Typography>
            </Box>
        </Box>
    );
}

export default function Badge() {
    const Badges = [
        { id: 1, image: badge, title: "New Reviewer", progress: 50 },
        { id: 2, image: badge, title: "New Reviewer", progress: 30 },
        { id: 3, image: badge, title: "New Reviewer", progress: 25 },
        { id: 4, image: badge, title: "New Reviewer", progress: 80 },
    ];

    const badgeRecords = useQuery("badgeRecord", async () => {
        const { data } = await axios.get(
            route("api.web.v1.user-panel.badge.index")
        );
        badgeRecords.data = data.data;
        return badgeRecords;
    });

    const skeletonVar = true;

    return (
        <>
            <Box sx={{ p: 5 }}>
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
                        Badge
                    </Typography>
                </Box>
                <Box sx={{ my: 3, mx: 15 }}>
                    <Box>
                        <Typography
                            component={"span"}
                            sx={{ color: "orange.main" }}
                        >
                            Trip Collective
                            <Typography
                                sx={{ color: "black" }}
                                component={"span"}
                            >
                                 Badge Collection
                            </Typography>
                        </Typography>
                    </Box>
                    <Box>
                        <Typography sx={{ color: "black" }} component={"span"}>
                            You have
                            <Typography
                                component={"span"}
                                sx={{ color: "orange.main", mx: 1 }}
                            >
                                {badgeRecords.isLoading ?
                                (
                                    <Skeleton
                                        sx={{
                                            display: "inline-block",
                                            verticalAlign: "text-bottom",
                                        }}
                                        animation="wave"
                                        variant="rounded"
                                        width={15}
                                        height={20}
                                    />
                                    ) : (
                                    badgeRecords.data.data.length
                                )}
                            </Typography>
                            badges
                        </Typography>
                    </Box>
                </Box>
                <Container sx={{ mx: 5 }}>
                    {badgeRecords.isLoading ? (
                        <BadgeSkeleton />
                    ) : (
                        <Grid container spacing={5}>
                            {badgeRecords.data.data.map((badge, index) => (
                                <Grid
                                    key={index}
                                    item
                                    xs={12}
                                    md={6}
                                    alignItems="center"
                                    display="flex"
                                >
                                    <img
                                        src={
                                            import.meta.env.VITE_APP_URL +
                                            `/storage/badges/${badge.image}`
                                        }
                                        width="40px"
                                        height="40px"
                                        alt={badge.name}
                                    />
                                    <Typography
                                        sx={{ width: "25%" }}
                                        marginX={2}
                                        component={"span"}
                                        variant="body1"
                                        color="primary.main"
                                    >
                                        {badge.name}
                                    </Typography>
                                    <Box sx={{ width: "100%", pr: 5 }}>
                                        <LinearProgressWithLabel
                                            color="orange"
                                            variant="determinate"
                                            value={
                                                (badge.score /
                                                    (badge.max - badge.min)) *
                                                100
                                            }
                                        />
                                    </Box>
                                </Grid>
                            ))}
                        </Grid>
                    )}
                </Container>
            </Box>
        </>
    );
}
