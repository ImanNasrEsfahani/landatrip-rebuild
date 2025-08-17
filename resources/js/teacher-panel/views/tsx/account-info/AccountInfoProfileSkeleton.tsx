import { Grid, Skeleton } from "@mui/material";
import React from "react";

const AccountInfoProfileSkeleton = () => {
    return (
        <>
            <Grid container columnSpacing={10} rowSpacing={4}>
                <Grid item xs={12} md={6} lg={4}>
                    <Skeleton
                        animation="wave"
                        variant="rounded"
                        // width={200}
                        height={40}
                    />
                </Grid>
                <Grid item xs={12} md={6} lg={4}>
                    <Skeleton
                        animation="wave"
                        variant="rounded"
                        // width={200}
                        height={40}
                    />
                </Grid>
                <Grid item xs={12} md={6} lg={4}>
                    <Skeleton
                        animation="wave"
                        variant="rounded"
                        // width={200}
                        height={40}
                    />
                </Grid>
                <Grid item xs={12} md={6} lg={4}>
                    <Skeleton
                        animation="wave"
                        variant="rounded"
                        // width={200}
                        height={40}
                    />
                </Grid>
                <Grid item xs={12} md={6} lg={4}>
                    <Skeleton
                        animation="wave"
                        variant="rounded"
                        // width={200}
                        height={40}
                    />
                </Grid>
                <Grid item xs={12} md={6} lg={4}>
                    <Skeleton
                        animation="wave"
                        variant="rounded"
                        // width={200}
                        height={40}
                    />
                </Grid>
                <Grid item xs={12} md={6} lg={4}>
                    <Skeleton
                        animation="wave"
                        variant="rounded"
                        // width={200}
                        height={40}
                    />
                </Grid>
                <Grid item xs={12} md={6} lg={4}>
                    <Skeleton
                        animation="wave"
                        variant="rounded"
                        // width={200}
                        height={40}
                    />
                </Grid>
                <Grid item xs={12} md={6} lg={4}>
                    <Skeleton
                        animation="wave"
                        variant="rounded"
                        // width={200}
                        height={40}
                    />
                </Grid>
                <Grid item xs={12} sx={{ mb: 5 }}>
                    <Skeleton
                        animation="wave"
                        variant="rounded"
                        // width={200}
                        height={100}
                    />
                </Grid>
            </Grid>
        </>
    );
};

export default AccountInfoProfileSkeleton;
