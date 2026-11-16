import * as React from 'react';
import { Box, Typography } from '@mui/material';
import customTheme from '../../custom';

export default function Step6() {
    const theme: any = customTheme.palette;
    return <Box sx={{ mt: 5, p: 4, borderRadius: '12px', boxShadow: '3px 3px 10px 1px rgba(0, 0, 0, 0.15)' }}>
        <Typography variant="h5" sx={{ color: theme.primary.main }}>Payment</Typography>
        <Typography>Payment is unavailable until an invoice with a verified total exists.</Typography>
    </Box>;
}
