import * as React from "react";
import {useEffect, useState} from "react";
import {styled} from "@mui/material/styles";
import Box from "@mui/material/Box";
import List from "@mui/material/List";
import Typography from "@mui/material/Typography";
import IconButton from "@mui/material/IconButton";
import ListItem from "@mui/material/ListItem";
import ListItemButton from "@mui/material/ListItemButton";
import ListItemText from "@mui/material/ListItemText";
import {Avatar, Badge, BadgeProps, Button, Grid, InputBase, ListItemAvatar, Stack, Tab, Tabs,} from "@mui/material";
import ConversationChat from "./ConversationChat";
import SearchIcon from "@mui/icons-material/Search";
import SettingsIcon from "@mui/icons-material/Settings";
import ArrowCircleLeftOutlinedIcon from "@mui/icons-material/ArrowCircleLeftOutlined";
import {useMutation, useQuery} from "react-query";
import axios from "./../../../../axiosConfig";
import {route} from './../../../helpers'
import EmptyChat from "./EmptyChat";
import './../../../../bootstrap'
import {useSelector} from "react-redux";
import fetchTimeline from "pusher-js/types/src/runtimes/worker/timeline/fetch_timeline";
import customTheme from "../../../custom";


export default function Conversation() {
    const [value, setValue] = React.useState(0);
    const [Id, setId] = React.useState();
    const [lists, setLists] = useState([])
    const [chat, setChat] = React.useState([]);
    const [display, setDisplay] = React.useState([])
    const [id, setID] = useState(null);


    const Data = useSelector(state => state.information);

    useEffect(() => {
        if (!Id) return;

        const channel = `chat.${Id}`;
        window.Echo.private(channel)
            .listen('MessageEvent', (data) => {
                setChat(prev => {
                    return {
                        ...prev,
                        data: prev.data ? prev.data.concat({
                            ...data,
                            is_sender: Data.user_id === data.conversation_id
                        }) : [data]
                    }
                })
            });

        return () => { window.Echo.leave(channel); };
    }, [Id]);

    useEffect(() => {
        if (!Data.user_id) return;

        const channel = `list-channel.${Data.user_id}`;
        window.Echo.private(channel)
            .listen('ListEvent', (data) => {
                const entry = Data.user_id === data.userId ? data.assign : data.user;
                setLists(current => current.filter(item => item.communication_id !== entry.communication_id).concat(entry));
            });

        return () => { window.Echo.leave(channel); };
    }, [Data.user_id]);


    const handleId = (child) => {
        setID(child);
    }
    useEffect(() => {
        if (id) {
            CommunicationMessage.mutate(id);
        }
    }, [id])

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
        setValue(newValue);
    };


    const StyledBadge = styled(Badge)<BadgeProps>(({theme}) => ({
        "& .MuiBadge-badge": {
            left: "100%",
            top: "50%",
        },
    }));

    const conversation = useQuery('conversation', async () => {
        const {data} = await axios.get(route('api.web.v1.user-panel.conversation.index'))
        conversation.data = data.data
        setLists(conversation.data)
        return conversation
    })
    const CommunicationMessage = useMutation(async (data) => {
            setId(data);
            const response = await axios.get(route("api.web.v1.user-panel.conversation.show", {conversation: data}));
            return response.data;
        },
        {
            onSuccess: (data) => {
                setChat(data);
            },
            onError: () => {
            },
            onSettled: () => {
            },
        }
    );
    const check = (finded) => {
        console.warn(lists, " lists");
        console.log(finded.name)
        setChat(finded);
        let clickedChat = lists.find(item => item.assign_name === finded.name) ? lists.find(item => item.assign_name === finded.name) : null;

        console.log(clickedChat, " clickedChat ");
        if (clickedChat) {
            CommunicationMessage.mutate(clickedChat.communication_id);
        }
    }

    const SortedLists = lists.sort((a, b) => {
        const lastChatA = new Date(a.sort);
        const lastChatB = new Date(b.sort);

        return lastChatB - lastChatA;
    });

    const student = SortedLists.filter(item => item.role === "user")
    const agent = SortedLists.filter(item => item.role === "agent")
    const admin = SortedLists.filter(item => item.role === "admin")

    const allContact = (data) => {
        if (data === "student") {
            setDisplay(student)
        }
        if (data === "agent") {
            setDisplay(agent)
        }
        if (data === "admin") {
            setDisplay(admin)
        }
        if (data === "all")
            setDisplay(SortedLists)
    }

    useEffect(() => {
        setDisplay(lists)
    }, [lists])

    const back = () => {
        setChat([])
    }

    if (conversation.isLoading) {
        return <p>loading....</p>
    }
    return (
        <>
            <Box sx={{height: "100%", overflow: "hidden"}}>
                <Grid className="GridNoPadding" container spacing={0}>
                    <Grid item xs={0} md={3} sx={{p: 0, m: 0}}>
                        <Box
                            sx={{
                                backgroundColor: "primary.40",
                                p: 0,
                                m: 0,
                            }}
                            display={{xs: Object.keys(chat).length ? "none" : "block", md: "block"}}
                        >
                            <Box
                                sx={{
                                    flexGrow: 1,
                                    display: "flex",
                                    flexDirection: "column",
                                    backgroundColor: "primary.40",
                                    p: 0,
                                    m: 0,
                                    height: "92vh",
                                }}
                            >
                                <Box>
                                    <Box
                                        sx={{
                                            maxWidth: {xs: 380, sm: 480},
                                            bgcolor: "primary.40",
                                        }}
                                    >
                                        <Tabs
                                            value={value}
                                            onChange={handleChange}
                                            variant="scrollable"
                                            scrollButtons="auto"
                                            aria-label="scrollable auto tabs example"
                                        >
                                            <Tab
                                                label={
                                                    <StyledBadge
                                                        badgeContent={lists.length}
                                                        color="orange"
                                                    >
                                                        <Typography
                                                            variant="body2"
                                                            sx={{
                                                                ml: 32,
                                                                textTransform: "capitalize",
                                                                color: "white",
                                                            }}
                                                            onClick={() => allContact("all")}>
                                                            All
                                                        </Typography>
                                                    </StyledBadge>
                                                }
                                                sx={{color: "white", paddingX: 10}}
                                            />
                                            <Tab
                                                label={
                                                    <StyledBadge
                                                        badgeContent={student.length}
                                                        color="orange"
                                                    >
                                                        <Typography
                                                            variant="body2"
                                                            sx={{
                                                                textTransform: "capitalize",
                                                                color: "white",
                                                            }}
                                                            onClick={() => allContact("student")}
                                                        >
                                                            Student
                                                        </Typography>
                                                    </StyledBadge>
                                                }
                                                sx={{color: "white", paddingX: 5}}
                                            />
                                            <Tab
                                                label={
                                                    <StyledBadge
                                                        badgeContent={agent.length}
                                                        color="orange"
                                                    >
                                                        <Typography
                                                            variant="body2"
                                                            sx={{
                                                                textTransform: "capitalize",
                                                                color: "white",
                                                            }}
                                                            onClick={() => allContact("agent")}
                                                        >
                                                            Agent
                                                        </Typography>
                                                    </StyledBadge>
                                                }
                                                sx={{color: "white", paddingX: 5}}
                                            />
                                            <Tab
                                                label={
                                                    <StyledBadge
                                                        badgeContent={admin.length}
                                                        color="orange"
                                                    >
                                                        <Typography
                                                            variant="body2"
                                                            sx={{
                                                                textTransform: "capitalize",
                                                                color: "white",
                                                            }}
                                                            onClick={() => allContact("admin")}
                                                        >
                                                            Admin
                                                        </Typography>
                                                    </StyledBadge>
                                                }
                                                sx={{color: "white", paddingX: 5}}
                                            />
                                            <Tab
                                                label={
                                                    <StyledBadge
                                                        // badgeContent={4}
                                                        color="orange"
                                                    >
                                                        <Typography
                                                            variant="body2"
                                                            sx={{
                                                                textTransform: "capitalize",
                                                                color: "white",
                                                            }}
                                                        >
                                                            Archived
                                                        </Typography>
                                                    </StyledBadge>
                                                }
                                                sx={{color: "white", paddingX: 5}}
                                            />
                                        </Tabs>
                                    </Box>

                                    {/* <TabPanel value={value} index={0}>
                            All
                        </TabPanel>
                        <TabPanel value={value} index={1}>
                            Student
                        </TabPanel>
                        <TabPanel value={value} index={2}>
                            Agent
                        </TabPanel>
                        <TabPanel value={value} index={3}>
                            Admin
                        </TabPanel>
                        <TabPanel value={value} index={4}>
                            Archived
                        </TabPanel> */}
                                </Box>
                                <Box
                                    sx={{
                                        backgroundColor: "inputs",
                                        borderRadius: 10,
                                        mx: 2,
                                        my: 2,
                                    }}
                                >
                                    <Stack direction="row" sx={{mx: 2}}>
                                        <InputBase
                                            fullWidth
                                            sx={{}}
                                            placeholder="Search"
                                            inputProps={{"aria-label": "search"}}
                                        />
                                        <IconButton type="button" aria-label="search">
                                            <SearchIcon/>
                                        </IconButton>
                                    </Stack>
                                </Box>
                                <List
                                    className="scrollbar"
                                    sx={{
                                        flex: "1 1 auto",
                                        overflowY: "scroll",
                                        px: 2,
                                    }}
                                >
                                    {display.map((item) => (
                                        <Button
                                            sx={{
                                                my: 1,
                                                py: 1,
                                                pr: 2.5,
                                                bgcolor: "primary.main",
                                                borderRadius: 4,
                                                width: "100%",
                                                textTransform: "none",
                                                mx: 0

                                            }}
                                            variant="contained"
                                            disableRipple
                                            key={item.communication_id}
                                            onClick={() => {
                                                CommunicationMessage.mutate(item.communication_id)
                                                conversation.refetch()
                                            }}
                                        >
                                            <Box display="flex" width="100%">

                                                <Avatar src={item.assign_profile_picture} sx={{ borderRadius: "50%",  width: "50px", height: "50px"}}></Avatar>
                                                <Box sx={{textAlign : "start" ,color: "#ffffff", textOverflow: "ellipsis", overflow: "hidden", whiteSpace: "nowrap" , ml:1 }} >
                                                    <Typography  variant="body1" noWrap>
                                                        {
                                                            item.assign_name.length > 16
                                                                ? item.assign_name.split(' ').slice(0, 2).join(' ') + '...'
                                                                : item.assign_name
                                                        }
                                                    </Typography>
                                                    <Typography variant="body1" noWrap sx={{color : customTheme.palette.chatsub}}>
                                                        {item.role || "Role"}
                                                    </Typography>

                                                </Box>
                                                {/* <ListItemText
                                                    sx={{
                                                        color: "#ffffff",
                                                        textOverflow: "ellipsis",
                                                        overflow: "hidden",
                                                        whiteSpace: "nowrap",

                                                    }}
                                                    primary={
                                                        item.assign_name.length > 16
                                                            ? item.assign_name.split(' ').slice(0, 2).join(' ') + '...'
                                                            : item.assign_name
                                                    }
                                                    primaryTypographyProps={{
                                                        variant: "chat",
                                                        noWrap: true
                                                    }}
                                                    secondary={item.role || "Role"}
                                                    secondaryTypographyProps={{
                                                        color: customTheme.palette.chatsub,
                                                        variant: "chat",
                                                    }}
                                                /> */}
                                                <Box sx={{color: "#ffffff", textOverflow: "ellipsis", overflow: "hidden", whiteSpace: "nowrap" , ml:"auto" , display : "flex" , flexDirection : "column" , justifyContent : "space-between"}}>

                                                    {item.has_unread ?
                                                        <div style={{marginLeft : "auto",borderRadius : "50%" , width : "1.2rem" ,backgroundColor : customTheme.palette.orange.main}}>
                                                            <Typography variant="body2">{item.unread_count}</Typography>
                                                        </div>
                                                        :""}
                                                    <Typography sx={{justifySelf : "end"}} variant="body2" noWrap >
                                                        {item.time || "Time"}
                                                    </Typography>
                                                </Box>
                                            </Box>
                                        </Button>
                                    ))}
                                </List>
                                <Box sx={{backgroundColor: "#339180", flexGrow: 0}}>
                                    <Box
                                        sx={{
                                            display: "flex",
                                            justifyContent: "space-between",
                                            mx: 2,
                                        }}
                                    >
                                        <IconButton>
                                            <SettingsIcon
                                                sx={{color: "white", fontSize: 25}}
                                            />
                                        </IconButton>
                                        <IconButton>
                                            <ArrowCircleLeftOutlinedIcon
                                                sx={{color: "white", fontSize: 25}}
                                            />
                                        </IconButton>
                                    </Box>
                                </Box>
                            </Box>
                        </Box>
                    </Grid>
                    <Grid
                        item
                        xs={12}
                        md={9}
                        sx={{
                            display: "flex",
                            flexDirection: "column"
                        }}
                    >
                        {Object.keys(chat).length ?
                            <ConversationChat
                                onIdReady={handleId}
                                back={back}
                                information={chat.data}
                                image={chat.image}
                                role={chat?.role}
                                name={chat.name}
                                id={chat.id}
                                communication_id={chat.communication_id}
                            />
                            :
                            (<EmptyChat check={check}/>)
                        }

                    </Grid>
                </Grid>
            </Box>
        </>
    );
}
