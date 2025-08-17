import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import * as React from "react";
import {Button, Container, TextField} from "@mui/material";
import {Link as LinkReact} from "react-router-dom";

export default function ConfirmDeleteAccount() {
    return (
        <Container>
            <Box width="70%">
                <Box
                    sx={{
                        borderLeft: 3,
                        borderColor: "primary.main",
                        my: 5,
                    }}
                >
                    <Typography
                        sx={{ml: 1}}
                        fontWeight="bold"
                        color="primary.main"
                        variant="h3"
                    >
                        Delete Account
                    </Typography>
                </Box>
                <Typography variant="h6" my={2}>
                    verification code was just sent to marshian@gmail.com
                </Typography>
                <Typography variant="h6">
                    If you delete your account, all of your messages and contacts will be deleted beyond retrieval. All
                    groups and channels that you've created will be orphaned and left without a creator (but admins will
                    retain their rights). Warning! Please only delete your account if you no longer want to use Diaco
                    Platform. If you delete your account now, it may not be possible to sign up again for several days.
                </Typography>
                <Box
                    component="form"
                    sx={{
                        '& > :not(style)': {my: 2},
                        display: "flex",
                        flexDirection: "column",
                        my: 5
                    }}
                    noValidate
                    autoComplete="off"
                >
                    <TextField sx={{width: "50%"}} size="small" id="outlined-basic" label="confirmation code"
                               placeholder="Enter reason"
                               variant="outlined"/>
                    <TextField sx={{width: "50%"}} size="small" id="outlined-basic" label="why are you leaving us "
                               placeholder="Enter code "
                               variant="outlined"/>
                </Box>
                <Button
                    sx={{
                        mt: 5,
                        borderColor: "orange.main",
                        backgroundColor: "orange.main",
                        px: 8,
                        display: "block",
                        width: "fit-content",

                    }}
                    variant="contained"
                    component={LinkReact}
                    to="confirm"
                >
                    Delete Permenentaly
                </Button>
            </Box>
        </Container>
    )
}
