import Avatar from '@mui/material/Avatar';
import Box from "@mui/material/Box";
import MoreVertIcon from '@mui/icons-material/MoreVert';
import IconButton from "@mui/material/IconButton";
import Typography from "@mui/material/Typography";
import avatar from "../../images/avatar.png";
import {InputBase, Menu, MenuItem, Stack} from "@mui/material";
import AttachFileIcon from "@mui/icons-material/AttachFile";
import SentimentSatisfiedOutlinedIcon from "@mui/icons-material/SentimentSatisfiedOutlined";
import SendIcon from "@mui/icons-material/Send";
import * as React from "react";
import {useEffect, useRef, useState} from "react";
import AvatarGroup from '@mui/material/AvatarGroup';
import axios from "../../../../axiosConfig";
import {route} from "../../../helpers"
import {useInfiniteQuery, useMutation, useQuery} from "react-query";
import {useParams} from "react-router-dom";
import {styled} from '@mui/material/styles';
import Badge from '@mui/material/Badge';
import EmojiPicker, {
    EmojiClickData,
} from 'emoji-picker-react';

export default function TicketSupportChat() {
    const boxRef = useRef<HTMLDivElement>(null);
    const params = useParams();
    const [support, setSupport] = useState(true)
    const [showPicker, setShowPicker] = useState(false);
    const [anchorEl, setAnchorEl] = React.useState<null | HTMLElement>(null);
    const open = Boolean(anchorEl);
    const openEmoji = (event: React.MouseEvent<HTMLButtonElement>) => {
        setAnchorEl(event.currentTarget);
    };
    const handleClose = () => {
        setAnchorEl(null);
    };
    const StyledBadge = styled(Badge)(({theme}) => ({
        '& .MuiBadge-badge': {
            backgroundColor: '#44b700',
            color: '#44b700',
            boxShadow: `0 0 0 2px ${theme.palette.background.paper}`,
            '&::after': {
                position: 'absolute',
                top: 0,
                left: 0,
                width: '100%',
                height: '100%',
                borderRadius: '50%',
                animation: 'ripple 1.2s infinite ease-in-out',
                border: '1px solid currentColor',
                content: '""',
            },
        },
        '@keyframes ripple': {
            '0%': {
                transform: 'scale(.8)',
                opacity: 1,
            },
            '100%': {
                transform: 'scale(2.4)',
                opacity: 0,
            },
        },
    }));
    const [message, setMessage] = useState("");

    //api
    //get chat
    const ticketChatRecords = async (pageIndex, pageSize) => {
        const response = await axios.get(route("api.web.v1.user-panel.ticket.record.index", {"ticket": params.id}, pageIndex, pageSize));
        scrollToBottom();
        return response.data
    }

    const ticketsHeader = useQuery('Tickets', async () => {
        const {data} = await axios.get(route("api.web.v1.user-panel.ticket.show", {"ticket": params.id}));
        ticketsHeader.data = data.data;
        return ticketsHeader;
    });

    const {
        data,
        refetch
    } = useInfiniteQuery("ticketChatRecords", () => ticketChatRecords(1, 20), {
        getNextPageParam: (lastPage) => {
            const {meta} = lastPage;
            if (meta.current_page < meta.last_page) {
                return meta.current_page + 1;
            }
            return null;
        },
    })

    const handleChange = event => {
        setMessage(event.target.value);
    };
    // post new message
    const postNewMessage = useMutation(
        async (data) => {
            return await axios.post(
                route(
                    "api.web.v1.user-panel.ticket.record.store", {ticket: params.id}
                ),
                data
            );
        },
        {
            onSuccess: () => {
                refetch().then((r) => "");
                // reset();
            },
        }
    );

    const handleClick = event => {
        event.preventDefault();
        // 👇️ value of input field
        postNewMessage.mutate({"message": message})
        setMessage("")
    };

    //scrolling to bottom
    const scrollToBottom = () => {
        setTimeout(() => {
            const element = document.getElementById('section');

            function scrollBottom(element) {
                element.scroll({top: element.scrollHeight, behavior: "smooth"})
            }

            scrollBottom(element);
        }, 300);
    };

    //emoji
    function onClickShowEmoji(emojiData: EmojiClickData, event: MouseEvent) {
        setMessage(
            (message) =>
                message + (emojiData.isCustom ? emojiData.unified : emojiData.emoji)
        );
    }


    return (
        <Box sx={{display: "flex", height: "100%", flexDirection: "column"}}>
            {support ? (
                <Box sx={{
                    display: "flex",
                    flexGrow: 0,
                    backgroundColor: "primary.20",
                    justifyContent: "space-between",
                    px: 5,
                    py: 1
                }}>
                    <Box sx={{display: "flex", alignItems: "center"}}>
                        <StyledBadge
                            sx={{marginRight: 2}}
                            overlap="circular"
                            anchorOrigin={{vertical: 'bottom', horizontal: 'right'}}
                            variant="dot"
                        >
                            <Avatar sx={{width: "auto", height: "auto"}} alt="Remy Sharp" src={avatar}/>
                        </StyledBadge>
                        <Box>
                            <Typography variant="h5" color="primary">Omid Farzani</Typography>
                            <Typography variant="h6" color="white">Sale And Marketing</Typography>
                        </Box>
                    </Box>
                    <IconButton aria-label="MoreVertIcon" size="large">
                        <MoreVertIcon fontSize="large"/>
                    </IconButton>
                </Box>
            ) : (
                <Box sx={{
                    display: "flex",
                    flexGrow: 0,
                    backgroundColor: "primary.20",
                    justifyContent: "space-between",
                    px: 5,
                    py: 1
                }}>
                    <Box sx={{display: "flex"}}>
                        <AvatarGroup max={4} sx={{marginRight: 2}}>
                            <Avatar alt="Remy Sharp" src={avatar}/>
                            <Avatar alt="Travis Howard" src={avatar}/>
                            <Avatar alt="Cindy Baker" src={avatar}/>
                            <Avatar alt="Agnes Walker" src={avatar}/>
                        </AvatarGroup>
                        <Box>
                            <Typography variant="h5" color="primary">Supports... </Typography>
                            <Typography variant="h6" color="white">Sale And Marketing</Typography>
                        </Box>
                    </Box>
                    <IconButton aria-label="MoreVertIcon" size="large">
                        <MoreVertIcon fontSize="large"/>
                    </IconButton>
                </Box>
            )}
            <Box className="scrollbar"
                 id="section"
                 sx={{
                     px: 10, display: "flex",
                     flexGrow: 1,
                     flexDirection: "column",
                     overflowY: "scroll"
                 }}>
                {data?.pages[0].data.length > 0 ? (
                    data?.pages.map((page, pageIndex) => (
                        <React.Fragment key={pageIndex}>
                            {page.data.map((value, key) =>
                                value.role_user == "User" ?
                                    (
                                        <Box sx={{
                                            display: "flex",
                                            justifyContent: "flex-end",
                                            alignItems: "center",
                                            my: 1
                                        }}>
                                            <Typography variant="caption" color="gray.main">
                                                {value.created_at}
                                            </Typography>
                                            <Typography variant="h6"
                                                        sx={{
                                                            backgroundColor: "primary.main",
                                                            color: "white",
                                                            maxWidth: "30%",
                                                            padding: 2,
                                                            borderRadius: "10px",
                                                            marginLeft: 2
                                                        }}>
                                                {value.message}
                                            </Typography>
                                        </Box>
                                    ) : (
                                        <Box sx={{
                                            display: "flex",
                                            justifyContent: "flex-start",
                                            alignItems: "center",
                                            my: 1
                                        }}>
                                            <Typography variant="h6" sx={{
                                                backgroundColor: "gray.10",
                                                maxWidth: "30%",
                                                padding: 2,
                                                borderRadius: "10px",
                                                marginRight: 2
                                            }}>
                                                {value.message}
                                            </Typography>
                                            <Typography variant="caption" color="gray.main">
                                                {value.created_at}
                                            </Typography>
                                        </Box>
                                    )
                            )}
                        </React.Fragment>
                    ))
                ) : (
                    <Box>
                        <Typography variant="h3" sx={{display: "block", margin: "auto"}}>
                            No Chat
                        </Typography>
                    </Box>
                )}
            </Box>
            {ticketsHeader.data.data.status == "Closed" ? (
                <Typography>closed</Typography>) : ticketsHeader.data.data.status == "Rating" ? (
                <Typography>rating</Typography>) : (
                <Box sx={{
                    display: "flex",
                    flexGrow: 0,
                    marginBottom: 1
                }}>
                    <Stack
                        direction="row"
                        justifyContent="center"
                        alignItems="center"
                        sx={{px: 3, width: "100%"}}
                        flexGrow="0"
                    >
                        <IconButton sx={{backgroundColor: "inputs"}}>
                            <AttachFileIcon/>
                        </IconButton>
                        <Box>
                            <IconButton id="basic-button" sx={{backgroundColor: "inputs", mx: 1}}
                                        aria-controls={open ? 'basic-menu' : undefined}
                                        aria-haspopup="true"
                                        aria-expanded={open ? 'true' : undefined}
                                        onClick={openEmoji}
                            >
                                <SentimentSatisfiedOutlinedIcon/>
                            </IconButton>
                            <Menu
                                sx={{position: "absolute", bottom: 100, padding: 0}}
                                id="basic-menu"
                                anchorEl={anchorEl}
                                open={open}
                                onClose={handleClose}
                                MenuListProps={{
                                    'aria-labelledby': 'basic-button',
                                }}
                            >
                                <MenuItem sx={{padding: 0}}>
                                    <EmojiPicker height={500}
                                                 onEmojiClick={onClickShowEmoji}/>
                                </MenuItem>
                            </Menu>
                        </Box>
                        <InputBase
                            onChange={handleChange}
                            value={message}
                            fullWidth
                            sx={{
                                backgroundColor: "inputs",
                                pl: 2,
                                py: 0.4,
                                borderTopLeftRadius: 50,
                                borderBottomLeftRadius: 50,
                            }}
                            placeholder="Type a message"
                            inputProps={{"aria-label": "message"}}
                        />
                        <IconButton
                            onClick={handleClick}
                            sx={{
                                backgroundColor: "inputs",
                                borderRadius: 0,
                                borderTopRightRadius: 50,
                                borderBottomRightRadius: 50,
                            }}
                            type="button"
                            aria-label="message"
                        >
                            <SendIcon sx={{color: "primary.main"}}/>
                        </IconButton>
                    </Stack>
                </Box>
            )}
        </Box>
    )
}
