import React from "react";
import { Box, Button, Grid, Paper, Stack, TextField, Typography } from "@mui/material";

export type TourListing = {
    items: { id: string; title: string; summary: string; groups: number; url: string | null }[];
    q: string; page: number; total: number; previous: string | null; next: string | null;
};

export default function Main({ listing }: { listing: TourListing }) {
    return <Box component="section" aria-label="Tour listing" sx={{ pb: 6 }}>
        <Typography variant="h4" component="h1" sx={{ mb: 3 }}>Explore tours</Typography>
        <Stack component="form" method="get" action="/tour" direction={{ xs: 'column', sm: 'row' }} spacing={2} sx={{ mb: 3 }}>
            <TextField name="q" label="Search tours" defaultValue={listing.q} inputProps={{ maxLength: 100 }} size="small"/>
            <Button type="submit" variant="contained">Search</Button>
        </Stack>
        <Typography sx={{ mb: 2 }}>{listing.total} tours found</Typography>
        {listing.items.length === 0 && <Typography role="status">No tours found. Try another search.</Typography>}
        <Grid container spacing={3}>
            {listing.items.map(tour => <Grid item xs={12} sm={6} lg={4} key={tour.id}>
                <Paper component="article" elevation={1} sx={{ p: 3, borderRadius: 3, height: '100%' }}>
                    <Typography variant="h6" component="h2" sx={{ mb: 2 }}>{tour.title}</Typography>
                    <Typography sx={{ mb: 2 }}>{tour.summary}</Typography>
                    <Typography variant="body2" sx={{ mb: 2 }}>{tour.groups ? `${tour.groups} published groups` : 'No published groups'}</Typography>
                    {tour.url && <Button component="a" href={tour.url} variant="outlined">View tour</Button>}
                </Paper>
            </Grid>)}
        </Grid>
        <Stack component="nav" aria-label="Tour pages" direction="row" spacing={2} sx={{ mt: 4, alignItems: 'center' }}>
            {listing.previous && <Button component="a" href={listing.previous}>Previous page</Button>}
            <Typography>Page {listing.page}</Typography>
            {listing.next && <Button component="a" href={listing.next}>Next page</Button>}
        </Stack>
    </Box>;
}
