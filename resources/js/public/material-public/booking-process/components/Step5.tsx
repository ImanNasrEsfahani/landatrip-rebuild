import * as React from 'react';
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableContainer from '@mui/material/TableContainer';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import Paper from '@mui/material/Paper';
import Typography from "@mui/material/Typography";
import Box from "@mui/material/Box";
import {Button, Grid, InputAdornment, TextField} from "@mui/material";
import {styled} from '@mui/material/styles';
import Dialog from '@mui/material/Dialog';
import DialogTitle from '@mui/material/DialogTitle';
import DialogContent from '@mui/material/DialogContent';
import DialogActions from '@mui/material/DialogActions';
import IconButton from '@mui/material/IconButton';
import CloseIcon from '@mui/icons-material/Close';
import Card from '@mui/material/Card';
import CardActions from '@mui/material/CardActions';
import CardContent from '@mui/material/CardContent';
import customTheme from '../../custom';
import discount1 from "./assets/discount.svg";

// const discount1 = require("./assets/discount.svg") as string;


const rows = [
    {
        title : 'Tour Package',
        title1 : 2 ,
        title0 : "Description" ,
        title2: "$ 100.00" ,
        title3: "$ 200.00"
    },
    {
        title : 'Airplane Ticket',
        title1 : 2 ,
        title0 : "Description" ,
        title2: "$ 100.00",
        title3: "$ 200.00"
    },
    {
        title : 'Accommodation ',
        title1 : 2 ,
        title0 : "Description" ,
        title2: "$ 100.00" ,
        title3: "$ 200.00"
    },
    {
        title : 'Additional Services',
        title1 : 2 ,
        title0 : "Description" ,
        title2: "$ 100.00" ,
        title3: "$ 200.00"
    },
];

const discount = [
    {
        id : 1,
        expire : 10,
        occasion : "Toursim Day",
        status : 1,
        discount : "%50 up to $80",
    },
    {
        id : 2,
        expire : 10,
        occasion : "Toursim Day",
        status : 1,
        discount : "%50 up to $80",
    },
    {
        id : 3,
        expire : 10,
        occasion : "Toursim Day",
        status : 1,
        discount : "%50 up to $80",
    },
    {
        id : 4,
        expire : 10,
        occasion : "Toursim Day",
        status : 1,
        discount : "%50 up to $80",
    },
]

declare module '@mui/material/Typography' {
    interface TypographyPropsVariantOverrides {
        h2Semibold: true;
        h2Bold: true;
        h3Semibold: true;
        h3Bold: true;
        h4Semibold: true;
        h4Bold: true;
        h5Semibold: true;
        h5Bold: true;
        h6Semibold: true;
        h6Bold: true;
        body1Semibold: true;
        body1Bold: true;
        subtitle1Semibold: true;
        subtitle1Bold: true;
        subtitle2Semibold: true;
        subtitle2Bold: true;
    }
}


export default function Step5() {
    const [open, setOpen] = React.useState(false);
    const [selectDiscount, setSelectDiscount] = React.useState<number | null>();
    const theme : any = customTheme.palette;
    const handlePaymentSelect = (text) => {
        setSelectDiscount(text);
    };

    const handleClickOpen = () => {
        setOpen(true);
    };
    const handleClose = () => {
        setOpen(false);
        setSelectDiscount(null)
    };
    const handleApply = () => {
        setOpen(false);
    }

    return (
        <Box width="100%">
            <Box sx={{
                display: "flex",
                alignItems: "center",
                justifyContent: "space-between",
                gap: 4,
                borderBottom: "2px solid gray",
                paddingY: 2,
                mt : 5
            }}>
                <Box sx={{
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "center",
                    gap: 1,
                }}>
                <Typography component={"p"} variant="subtitle2Bold"  sx={{fontWeight: "600" , color : theme.gray.tone3}}>Date <Typography variant="subtitle2Bold" component="span" sx={{fontWeight: "600" , color : theme.gray.tone2}}>01 Aug, 2023</Typography></Typography>
                    
                </Box>
                <Box sx={{
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "center",
                    gap: 1
                }}>
                <Typography component={"p"} variant="subtitle2Bold" sx={{fontWeight: "600" , color : theme.gray.tone3}}>Invoice <Typography variant="subtitle2Bold" component="span" sx={{fontWeight: "600" , color: theme.gray.tone2}}>#INV-23012</Typography></Typography>

                </Box>
            </Box>
            <TableContainer component={Paper} sx={{boxShadow: "none"}}>
                <Table sx={{minWidth: 650}} size="small" aria-label="a dense table">
                    <TableHead sx={{borderBottom: "2px solid gray"}}>
                        <TableRow>
                            <TableCell><Typography variant='body1Bold' sx={{color : theme.gray.tone3}}>Service</Typography></TableCell>
                            <TableCell align="center"><Typography variant='body1Bold' sx={{color : theme.gray.tone3}}>Qty</Typography></TableCell>
                            <TableCell align="center"><Typography variant='body1Bold' sx={{color : theme.gray.tone3}}>Unit Price</Typography></TableCell>
                            <TableCell align="right"><Typography variant='body1Bold' sx={{color : theme.gray.tone3}}>Line Total</Typography></TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {rows.map((row) => (
                            <TableRow
                                key={row.title}
                                sx={{'&:last-child td, &:last-child th': {border: 0}}}
                            >
                                <TableCell component="th" scope="row">
                                    <Box>
                                        <Typography variant='body1Bold' component="p" sx={{color : theme.primary.main}} >{row.title}</Typography>
                                        <Typography variant='body1Bold' component="p"  sx={{color : theme.gray.tone3 , mt : 1}}>{row.title0}</Typography>
                                    </Box>
                                </TableCell>
                                <TableCell align="center"><Typography component={"p"} sx={{color : theme.gray.tone3 }} variant='body1Bold'>{row.title1}</Typography></TableCell>
                                <TableCell align="center"><Typography component={"p"} sx={{color : theme.gray.tone3 }} variant='body1Bold'>{row.title2}</Typography></TableCell>
                                <TableCell align="right"><Typography component={"p"} sx={{color : theme.gray.tone3 }} variant='body1Bold'>{row.title3}</Typography></TableCell>
                            </TableRow>
                        ))}
                        <TableRow>
                            <TableCell sx={{color : theme.primary.main }} align="left"><Typography component={"p"} variant='body1Bold'>Subtotal</Typography></TableCell>
                            <TableCell/>
                            <TableCell/>
                            <TableCell align="right"><Typography component={"p"} variant='body1Bold' sx={{ color : theme.gray.tone3}}>$ 600.00</Typography></TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </TableContainer>
            <Box mt={5}>
                <Box sx={{display: "flex", justifyContent: "space-between", marginTop: "50px"}}>
                    <Typography sx={{color : theme.gray.tone3}} component={"h4"} variant="h4Bold">Discount</Typography>
                </Box>
                <Box sx={{display : "flex" , alignItems : "center" , mt: 3}}>
                    <TextField sx={{ fontSize: "20px" , width : "16rem" , bgcolor : theme.gray.tint3 , borderRadius : "16px" }}
                        InputProps={{
                            sx: {borderRadius: "16px" },
                            endAdornment: (
                                <InputAdornment position="end">
                                    <Button
                                    variant='contained'
                                        sx={{
                                            borderRadius: "12px",
                                            bgcolor : theme.tertiary.main,
                                            textTransform : "none",
                                            color: "white",
                                            padding: "8px 32px",
                                            borderColor : "black"
                                        }}
                                    >
                                        <Typography variant='subtitle2Semibold' >Apply</Typography>
                                    </Button>
                                </InputAdornment>
                            ),
                        }}  
                        placeholder='Enter your code'
                    />
                    <Button
                        onClick={handleClickOpen}
                        variant='outlined'
                        sx={{
                            ml:2,
                            borderRadius: "12px",
                            borderColor : theme.black,
                            bgcolor : "transparent",
                            textTransform : "none",
                            color: theme.tertiary.main,
                            padding: "8px 32px",
                        }} 
                    >
                        <Typography variant='subtitle2Semibold' component="p">Coupons</Typography>
                    </Button>
                </Box>
                <Dialog
                    onClose={handleClose}
                    aria-labelledby="customized-dialog-title"
                    open={open}
                    maxWidth="lg"
                >
                <DialogTitle sx={{m: 0}} id="customized-dialog-title">
                    <Typography variant='h6Semibold' component="h6">Coupons</Typography>
                </DialogTitle>
                <IconButton
                    aria-label="close"
                    onClick={handleClose}
                    sx={{
                        position: 'absolute',
                        right: 8,
                        top: 8,
                        color: "red",
                    }}
                >
                    <CloseIcon/>
                </IconButton>
                <DialogContent sx={{width : "51rem"}}>       
                    <Grid container rowSpacing={3} columnSpacing={{xs: 1, sm: 2, md: 3}}>
                        {discount.map((item, index) => {
                            return (
                                <Grid key={index} item xs={12} sm={6}>
                                    <Box 
                                        sx={{
                                            backgroundColor: theme.gray.tint3,
                                            boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)",
                                            padding : 1,
                                            borderRadius : "8px",
                                            border: selectDiscount === item.id ? `2px solid ${theme.button}` : "2px solid transparent",
                                        }}
                                        onClick={() => handlePaymentSelect(item.id)}
                                    >
                                    <Box sx={{display: "flex", justifyContent: "space-between"}}>
                                        <Box sx={{display: "flex", flexDirection: "column", gap: 2 , justifyContent : "center" , alignItems : "center"}}>
                                            <Typography component={"p"} variant="body1" sx={{
                                                color: theme.gray.tone2
                                            }}>Expire</Typography>
                                            <Typography component={"p"} variant="subtitle2Semibold">{item.expire} Days</Typography>
                                        </Box>
                                        <Box sx={{display: "flex", flexDirection: "column", gap: 2 , justifyContent : "center" , alignItems : "center"}}>
                                            <Typography component={"p"} variant="body1" sx={{
                                                color: theme.gray.tone2
                                            }}>occasion</Typography>
                                            <Typography component={"p"} variant="subtitle2Semibold">{item.occasion}</Typography>
                                        </Box>
                                        <Box sx={{display: "flex", flexDirection: "column", gap: 2 , justifyContent : "center" , alignItems : "center"}}>
                                            <Typography component={"p"} variant="body1" sx={{
                                                color: theme.gray.tone2
                                            }}>Status</Typography>
                                            <Typography component={"p"} variant="subtitle2Semibold">{item.status}</Typography>
                                        </Box>
                                    </Box>
                                    <Box sx={{
                                        backgroundColor: theme.primary.tint2,
                                        borderRadius: "8px",mt : 1
                                    }}>
                                        <Typography component={"p"} variant="body1Bold" sx={{paddingY: "4px", textAlign: "center" , color : theme.discount}}>{item.discount}</Typography>
                                    </Box>
                                </Box>
                                </Grid>
                            )
                        })}
                        
                    </Grid>
                    <Box sx={{display : "flex" , justifyContent : "end" , w : "100%"}}>
                        <Button 
                            variant='contained'
                            onClick={handleApply} 
                            sx={{
                                borderRadius: "10px",
                                backgroundColor: "black",
                                color: "white",
                                padding: "8px 32px",
                                width: "fit-content",
                                mt : 2,
                                textAlign : "end",
                                textTransform : "none"
                            }}>
                                <Typography variant='subtitle2Semibold'>Apply</Typography>
                        </Button>
                    </Box>
                </DialogContent>
                </Dialog>
            </Box>
        </Box>
    );
}
