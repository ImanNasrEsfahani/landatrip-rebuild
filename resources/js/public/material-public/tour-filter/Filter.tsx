import React from "react";
import { Box, ThemeProvider } from "@mui/material";
import customTheme from "../custom";
import Main, { TourListing } from "./Main";

export default function Filter({ listing }: { listing: TourListing }) {
    return <ThemeProvider theme={customTheme}>
        <Box sx={{ mt: 6, maxWidth: '1440px', mx: 'auto', px: { xs: 2, md: 6 } }}>
            <Main listing={listing}/>
        </Box>
    </ThemeProvider>;
}
