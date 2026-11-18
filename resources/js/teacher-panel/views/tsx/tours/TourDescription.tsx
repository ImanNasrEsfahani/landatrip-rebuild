import TourEditDialog from "./TourEditDialog";
import { Alert } from "@mui/material";
import React from "react";
import {Button, Box, CardActionArea} from "@mui/material";
import {Link as LinkReact, useParams} from "react-router-dom";
import Typography from "@mui/material/Typography";
import {styled} from '@mui/material/styles';
import Grid from '@mui/material/Grid';
import Paper from '@mui/material/Paper';
import Card from '@mui/material/Card';
import CardActions from '@mui/material/CardActions';
import Avatar from '@mui/material/Avatar';
import AvatarGroup from '@mui/material/AvatarGroup';
import CardContent from '@mui/material/CardContent';
import CardMedia from '@mui/material/CardMedia';
import tourImg1 from "../../../components/assets/usa.png";
import tourImg2 from "../../../components/assets/tour-card2.png";
import tourImg3 from "../../../components/assets/tour-card3.png";
import tourImg4 from "../../../components/assets/tour-card4.png";
import tourHeader from "../../../components/assets/tour-header.png";
import avatartour from "../../../components/assets/avatartour.png";
import avatartour2 from "../../../components/assets/avatartour2.png";
import avatartour3 from "../../../components/assets/avatartour3.png";
import HorizontalStackedBarChart from "./HorizontalStackedBarChart"
import GroupIcon from '@mui/icons-material/Group';
import { useQuery} from "react-query";
import axios from "./../../../../axiosConfig";
import {route} from "../../../helpers";

export default function TourDescription() {
    const params = useParams();
    const [editOpen, setEditOpen] = React.useState(false);
    const [saved, setSaved] = React.useState(false);
    const editData = useQuery(['tour-edit', params.id], async () => {
        const response = await axios.get(route('api.web.v1.teacher-panel.tours.edit-data', { tour: params.id }));
        return response.data.data;
    });

    const groupsRecords = useQuery("groupsRecords", async () => {
        const {data} = await axios.get(route("api.web.v1.teacher-panel.tours.show", {"tour": params.id}));
        groupsRecords.data = data.data;
        return groupsRecords;
    });



    if (groupsRecords.isLoading) {
        return <p>Loading...</p>
    }
    return (
        <Box className="container" p={5}>
            {saved && <Alert severity="success">Tour updated.</Alert>}
            {editData.isError && <Alert severity="error">Unable to load this tour for editing.</Alert>}
            {editData.data && <TourEditDialog open={editOpen} data={editData.data} onClose={() => setEditOpen(false)}
                onSaved={() => { setEditOpen(false); setSaved(true); editData.refetch(); groupsRecords.refetch(); }}/>}
            <Box sx={{position: "relative"}}>
                <img src={tourHeader} width="100%"/>
                <Box sx={{position: "absolute", top: "35%", left: "10%"}}>
                    <Typography variant="h4" color="white">
                        {editData.data?.title ?? 'Tour'}
                    </Typography>
                    <Typography marginBottom="5" color="white" marginTop={1}>
                        {editData.data?.location ?? ''}
                    </Typography>
                    {/*icon*/}
                    <Button onClick={() => { setSaved(false); setEditOpen(true); }} disabled={!editData.data}
                        sx={{
                            mx: 0,
                            mt: 2,
                            borderColor: "orange.main",
                            backgroundColor: "orange.main",
                            px: 6,
                        }}
                        variant="contained"
                    >
                        Edit
                    </Button>
                </Box>
            </Box>
            <Box sx={{display: "flex", justifyContent: "space-between", my: 5}}>
                <Box
                    sx={{
                        borderRadius: 1,
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
                            sx={{ml: 1}}
                            fontWeight="bold"
                            color="primary.main"
                            variant="h6"
                        >
                            Groups
                        </Typography>
                    </Box>
                </Box>
                <Box textAlign="center">
                    <Button
                        sx={{
                            borderColor: "primary.main",
                            backgroundColor: "primary.main",
                            px: 3,
                        }}
                        variant="contained"
                        component={LinkReact}
                        to="add-new-group"
                    >
                        Add now Group
                    </Button>
                </Box>
            </Box>
            <Box sx={{width: '100%'}}>
                <Grid container rowSpacing={3} columnSpacing={3}>
                    <Grid item xs={12} sm={6}>
                        <Card sx={{
                            borderRadius: "15px",
                            height: "100%",
                            backgroundColor: "inputs",
                            display: "flex", flexDirection: "column", justifyContent: "space-between"
                        }}>
                            <Box>
                                <CardMedia
                                    image={tourImg1}
                                    title="green iguana"
                                    sx={{height: "250px", position: "relative"}}
                                >
                                    <Typography sx={{
                                        backgroundColor: "white",
                                        opacity: "80%",
                                        borderRadius: "15px",
                                        position: "absolute",
                                        bottom: 10,
                                        right: 10,
                                        px: 3,
                                        border: "1px solid white",
                                        color: "primary.main"
                                    }}>public</Typography>
                                </CardMedia>
                                <CardContent>
                                    <Box sx={{
                                        display: {xs: "block", md: "flex"},
                                        justifyContent: "space-between",
                                        alignItems: "center",
                                    }}>
                                        <Typography gutterBottom
                                                    variant="h6"
                                                    component="div">
                                            Desert Exploration in Two Days
                                        </Typography>
                                        <Typography variant="body1" color="orange.main">150/800/000 T
                                        </Typography>
                                    </Box>
                                    {/*icon*/}
                                    <Typography variant="body1" my={2} sx={{fontWeight: "bold"}}>End
                                        Registration:02/05/2024</Typography>
                                    <Box sx={{display: "flex", justifyContent: "space-between", alignItems: "center"}}>
                                        <GroupIcon sx={{color: "orange.main"}}/>
                                        <HorizontalStackedBarChart/>
                                        <Typography variant="body1" >8/12</Typography>
                                    </Box>
                                    <AvatarGroup total={10} sx={{justifyContent: "flex-end", mt: 2}}>
                                        <Avatar alt="Remy Sharp" src={avatartour}/>
                                        <Avatar alt="Travis Howard" src={avatartour2}/>
                                        <Avatar alt="Agnes Walker" src={avatartour3}/>
                                    </AvatarGroup>
                                </CardContent>
                            </Box>
                            <CardActions sx={{justifyContent: "center", }}>
                                <Box textAlign="center">
                                    <Button
                                        sx={{
                                            borderColor: "orange.main",
                                            backgroundColor: "orange.main",
                                            px: 7.5,
                                        }}
                                        variant="contained"
                                        component={LinkReact}
                                        to="add-tour"
                                    >
                                        More
                                    </Button>
                                </Box>
                            </CardActions>
                        </Card>
                    </Grid>
                    <Grid item xs={12} sm={6}>
                        <Card sx={{
                            borderRadius: "15px",
                            height: "100%",
                            backgroundColor: "inputs",
                            display: "flex", flexDirection: "column", justifyContent: "space-between"
                        }}>
                            <Box>
                                <CardMedia
                                    image={tourImg2}
                                    title="green iguana"
                                    sx={{height: "250px", position: "relative"}}
                                >
                                    <Typography sx={{
                                        backgroundColor: "white",
                                        opacity: "80%",
                                        borderRadius: "15px",
                                        position: "absolute",
                                        bottom: 10,
                                        right: 10,
                                        px: 3,
                                        border: "1px solid white",
                                        color: "primary.main"
                                    }}>private</Typography>
                                </CardMedia>
                                <CardContent>
                                    <Box sx={{
                                        display: {xs: "block", md: "flex"}
                                        , justifyContent: "space-between", alignItems: "center"
                                    }}>
                                        <Typography gutterBottom
                                                    width={"60%"}
                                                    variant="h6"
                                                    component="div">
                                            Desert Tour in winter
                                        </Typography>
                                        <Typography variant="body1" color="orange.main">200/800/000 T
                                        </Typography>
                                    </Box>
                                    {/*icon*/}
                                    <Typography variant="body1" my={2} sx={{fontWeight: "bold",my:1}}>
                                        Start: 02/05/2024</Typography>
                                    <Box>
                                        {/*icon*/}
                                        <Typography variant="body1" my={2}>0/30</Typography>
                                    </Box>
                                    <AvatarGroup total={10} sx={{justifyContent: "flex-end", mt: 2}}>
                                        <Avatar alt="Remy Sharp" src={avatartour}/>
                                        <Avatar alt="Travis Howard" src={avatartour2}/>
                                        <Avatar alt="Agnes Walker" src={avatartour3}/>
                                    </AvatarGroup>
                                </CardContent>
                            </Box>
                            <CardActions sx={{justifyContent: "center", }}>
                                <Box textAlign="center">
                                    <Button
                                        sx={{
                                            borderColor: "orange.main",
                                            backgroundColor: "orange.main",
                                            px: 7.5,
                                        }}
                                        variant="contained"
                                        component={LinkReact}
                                        to="add-tour"
                                    >
                                        More
                                    </Button>
                                </Box>
                            </CardActions>
                        </Card>
                    </Grid>
                    <Grid item xs={12} sm={6}>
                        <Card sx={{
                            borderRadius: "15px",
                            height: "100%",
                            backgroundColor: "inputs",
                            display: "flex", flexDirection: "column", justifyContent: "space-between"
                        }}>
                            <CardActionArea>
                                <CardMedia
                                    image={tourImg3}
                                    title="green iguana"
                                    sx={{height: "250px", position: "relative"}}
                                >
                                    <Typography sx={{
                                        backgroundColor: "white",
                                        opacity: "80%",
                                        borderRadius: "15px",
                                        position: "absolute",
                                        bottom: 10,
                                        right: 10,
                                        px: 3,
                                        border: "1px solid white",
                                        color: "primary.main"
                                    }}>public</Typography>
                                </CardMedia>
                                <CardContent>
                                    <Box sx={{
                                        display: {xs: "block", md: "flex"},
                                        justifyContent: "space-between", alignItems: "center"
                                    }}>
                                        <Typography gutterBottom
                                                    width={"60%"}
                                                    variant="h6"
                                                    component="div">
                                            Desert Tour in winter
                                        </Typography>
                                        <Typography variant="body1" color="orange.main">150/800/000 T
                                        </Typography>
                                    </Box>
                                    {/*icon*/}
                                    <Typography variant="body1" color="gray.main" my={2} sx={{fontWeight: "bold"}}>
                                        Start Registration:02/05/2024</Typography>
                                    <Box>
                                        {/*icon*/}
                                        <Typography variant="body1" color="gray.main" my={2}>0/30</Typography>
                                    </Box>
                                </CardContent>
                            </CardActionArea>
                            <CardActions sx={{justifyContent: "center", }}>
                                <Box textAlign="center">
                                    <Button
                                        sx={{
                                            borderColor: "orange.main",
                                            backgroundColor: "orange.main",
                                            px: 7.5,
                                        }}
                                        variant="contained"
                                        component={LinkReact}
                                        to="add-tour"
                                    >
                                        More
                                    </Button>
                                </Box>
                            </CardActions>
                        </Card>
                    </Grid>
                    <Grid item xs={12} sm={6}>
                        <Card sx={{
                            borderRadius: "15px",
                            height: "100%",
                            backgroundColor: "inputs",
                            display: "flex", flexDirection: "column", justifyContent: "space-between"
                        }}>
                            <CardActionArea>
                                <CardMedia
                                    image={tourImg4}
                                    title="green iguana"
                                    sx={{height: "250px", position: "relative"}}
                                >
                                    <Typography sx={{
                                        backgroundColor: "white",
                                        opacity: "80%",
                                        borderRadius: "15px",
                                        position: "absolute",
                                        bottom: 10,
                                        right: 10,
                                        px: 3,
                                        border: "1px solid white",
                                        color: "primary.main"
                                    }}>public</Typography>
                                </CardMedia>
                                <CardContent>
                                    <Box sx={{
                                        display: {xs: "block", md: "flex"},
                                        justifyContent: "space-between", alignItems: "center"
                                    }}>
                                        <Typography gutterBottom
                                                    width={"60%"}
                                                    variant="h6"
                                                    component="div">
                                            Desert Tour in winter
                                        </Typography>
                                        <Typography variant="body1" color="orange.main">200/800/000 T
                                        </Typography>
                                    </Box>
                                    {/*icon*/}
                                    <Typography variant="body1" my={2} sx={{fontWeight: "bold"}}>
                                        Return:02/05/2024</Typography>
                                    <Box>
                                        {/*icon*/}
                                        <Typography variant="body1" my={2}>8/12</Typography>
                                    </Box>
                                    <AvatarGroup total={10} sx={{justifyContent: "flex-end", mt: 2}}>
                                        <Avatar alt="Remy Sharp" src={avatartour}/>
                                        <Avatar alt="Travis Howard" src={avatartour2}/>
                                        <Avatar alt="Agnes Walker" src={avatartour3}/>
                                    </AvatarGroup>
                                </CardContent>
                            </CardActionArea>
                            <CardActions sx={{justifyContent: "center", }}>
                                <Box textAlign="center">
                                    <Button
                                        sx={{
                                            borderColor: "orange.main",
                                            backgroundColor: "orange.main",
                                            px: 7.5,
                                        }}
                                        variant="contained"
                                        component={LinkReact}
                                        to="add-tour"
                                    >
                                        More
                                    </Button>
                                </Box>
                            </CardActions>
                        </Card>
                    </Grid>
                </Grid>
            </Box>
        </Box>
    )
}
