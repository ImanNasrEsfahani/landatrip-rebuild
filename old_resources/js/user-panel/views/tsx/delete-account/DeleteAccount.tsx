import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import * as React from "react";
import {Button, Container} from "@mui/material";
import {Link as LinkReact} from "react-router-dom";

export default function DeleteAccount() {
    return (
        <Container>
            <Box>
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
                <Typography variant="h6" my={2} >
                    If you want to delete your account on Landa Trip platform, click on the bottom to continue.
                </Typography>
                <Typography variant="h6" color="orange.main">
                    Please Attention: all of your data include certification will be deleted permanently.
                </Typography>
                <Button
                    sx={{
                        mt: 5,
                        borderColor: "orange.main",
                        backgroundColor: "orange.main",
                        px: 8,
                        display:"block",
                        mx:"auto",
                        width:"fit-content",
                    }}
                    variant="contained"
                    component={LinkReact}
                    to="confirm"
                >
                    Continue
                </Button>
            </Box>
        </Container>
    )
}