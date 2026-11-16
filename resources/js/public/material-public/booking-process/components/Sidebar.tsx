import * as React from 'react';
import { Box, Grid, Typography, Skeleton } from '@mui/material';
import customTheme from '../../custom';
import { useContext } from 'react';
import Context from '../Context';

const Sidebar = () => {
    const { groupBookingData }: any = useContext(Context);
    const group = groupBookingData?.data?.data;
    const theme: any = customTheme.palette;

    return <Grid container spacing={3}>
        <Grid item xs={12}>
            <Box sx={{ boxShadow: '3px 3px 10px 1px rgba(0, 0, 0, 0.15)', p: 2, borderRadius: '16px' }}>
                <Typography variant="h6" sx={{ color: theme.primary.main }}>Booking summary</Typography>
                {groupBookingData.isLoading ? <Skeleton /> : <>
                    <Typography>{group?.tour_title} · {group?.group_title}</Typography>
                    <Typography>{group?.destination}</Typography>
                    <Typography>{group?.start_date_tour} – {group?.end_date_tour}</Typography>
                    <Typography>{group?.capacity} spaces available</Typography>
                </>}
            </Box>
        </Grid>
        <Grid item xs={12}>
            <Box sx={{ boxShadow: '3px 3px 10px 1px rgba(0, 0, 0, 0.15)', p: 2, borderRadius: '16px' }}>
                <Typography variant="h6" sx={{ color: theme.primary.main }}>Stored price items</Typography>
                {group?.price_items?.length ? group.price_items.map(item =>
                    <Box key={item.id} sx={{ display: 'flex', justifyContent: 'space-between', gap: 1 }}>
                        <Typography>{item.title}</Typography>
                        <Typography>{item.amount} {item.symbol || item.currency}</Typography>
                    </Box>
                ) : <Typography>No price items configured for this group.</Typography>}
                <Typography sx={{ mt: 2 }}>A payable total is unavailable until the booking price rules are confirmed.</Typography>
            </Box>
        </Grid>
    </Grid>;
};

export default Sidebar;
