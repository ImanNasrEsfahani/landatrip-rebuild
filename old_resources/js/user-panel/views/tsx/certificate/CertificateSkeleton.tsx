import {
    Card,
    CardContent,
    Typography,
    CardActions,
    IconButton,
    Button,
    Skeleton,
} from "@mui/material";
import React from "react";

import EmojiEventsIcon from "@mui/icons-material/EmojiEvents";
import MoreVertIcon from "@mui/icons-material/MoreVert";
import CheckCircleIcon from "@mui/icons-material/CheckCircle";

export default function CertificateSkeleton() {
    return (
        <>
            <Card
                sx={{
                    display: "flex",
                    flexDirection: { xs: "column", md: "row" },
                    justifyContent: "space-between",
                    p: 1,
                    my: 5,
                    boxShadow: 3,
                }}
            >
                <CardContent sx={{ width:"75%" }}>
                    <Typography variant="h6">
                        <Skeleton
                            animation="wave"
                            variant="text"
                            height={25}
                            width="75%"
                            sx={{ mx: 2 }}
                        />
                    </Typography>

                    <Typography variant="h4" color="primary.main" marginY={2}>
                        <Skeleton
                            animation="wave"
                            variant="text"
                            height={30}
                            width="75%"
                            sx={{ mx: 2 }}
                        />
                    </Typography>
                    <Typography variant="h6">
                        <Skeleton
                            animation="wave"
                            variant="text"
                            height={20}
                            width="75%"
                            sx={{ mx: 2 }}
                        />
                    </Typography>
                </CardContent>
                <CardActions
                    sx={{
                        display: "flex",
                        flexDirection: "column",
                        justifyContent: "space-between",
                    }}
                >
                    <IconButton sx={{ placeSelf: "end" }} disabled>
                        <MoreVertIcon />
                    </IconButton>
                    <Button variant="contained" size="large" disabled>
                        View Certificate
                    </Button>
                </CardActions>
            </Card>
            <Card
                sx={{
                    display: "flex",
                    flexDirection: { xs: "column", md: "row" },
                    justifyContent: "space-between",
                    p: 1,
                    my: 5,
                    boxShadow: 3,
                }}
            >
                <CardContent sx={{ width:"75%" }}>
                    <Typography variant="h6">
                        <Skeleton
                            animation="wave"
                            variant="text"
                            height={25}
                            width="75%"
                            sx={{ mx: 2 }}
                        />
                    </Typography>

                    <Typography variant="h4" color="primary.main" marginY={2}>
                        <Skeleton
                            animation="wave"
                            variant="text"
                            height={30}
                            width="75%"
                            sx={{ mx: 2 }}
                        />
                    </Typography>
                    <Typography variant="h6">
                        <Skeleton
                            animation="wave"
                            variant="text"
                            height={20}
                            width="75%"
                            sx={{ mx: 2 }}
                        />
                    </Typography>
                </CardContent>
                <CardActions
                    sx={{
                        display: "flex",
                        flexDirection: "column",
                        justifyContent: "space-between",
                    }}
                >
                    <IconButton sx={{ placeSelf: "end" }} disabled>
                        <MoreVertIcon />
                    </IconButton>
                    <Button variant="contained" size="large" disabled>
                        View Certificate
                    </Button>
                </CardActions>
            </Card>
            <Card
                sx={{
                    display: "flex",
                    flexDirection: { xs: "column", md: "row" },
                    justifyContent: "space-between",
                    p: 1,
                    my: 5,
                    boxShadow: 3,
                }}
            >
                <CardContent sx={{ width:"75%" }}>
                    <Typography variant="h6">
                        <Skeleton
                            animation="wave"
                            variant="text"
                            height={25}
                            width="75%"
                            sx={{ mx: 2 }}
                        />
                    </Typography>

                    <Typography variant="h4" color="primary.main" marginY={2}>
                        <Skeleton
                            animation="wave"
                            variant="text"
                            height={30}
                            width="75%"
                            sx={{ mx: 2 }}
                        />
                    </Typography>
                    <Typography variant="h6">
                        <Skeleton
                            animation="wave"
                            variant="text"
                            height={20}
                            width="75%"
                            sx={{ mx: 2 }}
                        />
                    </Typography>
                </CardContent>
                <CardActions
                    sx={{
                        display: "flex",
                        flexDirection: "column",
                        justifyContent: "space-between",
                    }}
                >
                    <IconButton sx={{ placeSelf: "end" }} disabled>
                        <MoreVertIcon />
                    </IconButton>
                    <Button variant="contained" size="large" disabled>
                        View Certificate
                    </Button>
                </CardActions>
            </Card>
        </>
    );
}
