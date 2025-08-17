import { Box, Button, Grid, Typography } from "@mui/material";
import React from "react";

import CertificatePicture from "./../../../assets/certificate.png";

export default function CertificatePic() {
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
                <Box textAlign="center" marginY={5}>
                    <Box sx={{ width:{xs:"100%",sm:"75%" , md:"40%"} }} marginX="auto" >
                    <img width="100%" src={CertificatePicture} alt="CertificatePicture" />
                    </Box>
                    <Grid container spacing={1}  sx={{ width:{xs:"80%",md:"50%"} }} marginX="auto">
                        <Grid item xs={12} sm={6} >
                        <Button  fullWidth variant="contained" size="large">
                            Download
                        </Button>
                        </Grid>
                        <Grid item xs={12} sm={6} >
                        <Button  fullWidth variant="contained" size="large">
                            Share
                        </Button>
                        </Grid>
                    </Grid>
                </Box>
            </Box>
        </>
    );
}
