import { Box, Grid, Paper, Table, TableBody, TableCell, TableContainer, TableHead, TableRow, ToggleButton, Typography } from '@mui/material';
import * as React from 'react';
import customTheme from '../../custom';
import applePay from './assets/apple-pay.svg'
import stripe from './assets/stripe.svg'
import payPal from './assets/payPal.svg'
import zarinpal from './assets/zarin.png'
import wallet from './assets/wallet.svg'

// const applePay = require("./assets/apple-pay.svg") as string;
// const stripe = require('./assets/payPal.svg') as string;
// const payPal = require('./assets/payPal.svg') as string;
// const zarinpal = require('./assets/zarin.png') as string;
// const wallet = require('./assets/zarin.png') as string;



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

const payment = [
    {
        img : applePay,
        text : "Apple Pay"
    },
    {
        img : stripe,
        text : "Stripe"
    },
    {
        img : payPal,
        text : "PayPal"
    },
    {
        img : zarinpal,
        text : "Zarinpal"
    },
    {
        img : wallet,
        text : "Wallet"
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

const Step6 = () =>{
    const [selectedPayment, setSelectedPayment] = React.useState<string>("PayPal");
    const theme : any = customTheme.palette;
    const handlePaymentSelect = (text) => {
      setSelectedPayment(text);
    };

    return (
        <>
            <Grid container spacing={2} mt={5} width="100%"  >
                <Grid item xs={12}  sm={12}>
                    <Box sx={{display: "flex" , justifyContent : "space-between" , alignItems : "center" , borderRadius : "12px"  , backgroundColor : theme.gray.tint3 , boxShadow: "0px 1px 0px 0px #FFF inset, 0px 0px 0px 1px #E8EDF5, 0px 1px 2px 0px rgba(0, 0, 0, 0.08)" , py :"12px" , px : "16px" }}>
                        <Typography sx={{color : theme.gray.tone3}} component="p" variant='subtitle2Bold'>Date <Typography variant='subtitle2Bold' component="span" sx={{color : theme.textSpan}}>01 Aug, 2023</Typography></Typography>
                        <Typography sx={{color : theme.gray.tone3}} component="p" variant='subtitle2Bold'>Invoice <Typography variant='subtitle2Bold' component="span" sx={{color : theme.textSpan}}>#INV-23012</Typography></Typography>
                    </Box>
                </Grid>
                <Grid item xs={12} sm={12}>
                <Box sx={{display : "flex" , gap : 2 , width : "100%"}}>
                    <Box  sx={{width:"100%" , borderRadius : "12px"  , backgroundColor : theme.gray.tint3 , boxShadow: "0px 1px 0px 0px #FFF inset, 0px 0px 0px 1px #E8EDF5, 0px 1px 2px 0px rgba(0, 0, 0, 0.08)" , py :"12px" , px : "16px" }}>
                        <Typography component="h6" variant='body1Semibold' sx={{color : theme.gray.tone3}}>To</Typography>
                        <Typography component="h6" sx={{color : theme.gray.tone2 , mt : 1}} variant='body1Semibold'>Company Name</Typography>
                        <Typography component="h6" sx={{color : theme.gray.tone2 ,mt:"5px"}} variant='body1Semibold'>Company address City, Country - 00000</Typography>
                        <Typography component="h6" sx={{color : theme.gray.tone2 }}  variant='body1Semibold'>+0 (000) 123-4567</Typography>
                    </Box>
                    <Box sx={{width:"100%" , borderRadius : "12px"  , backgroundColor : theme.gray.tint3 , boxShadow: "0px 1px 0px 0px #FFF inset, 0px 0px 0px 1px #E8EDF5, 0px 1px 2px 0px rgba(0, 0, 0, 0.08)" , py :"12px" , px : "16px" }}>
                        <Typography component="h6" variant='body1Semibold' sx={{color : theme.gray.tone3}}>From</Typography>
                        <Typography component="h6" sx={{color : theme.gray.tone2 , mt : 1}} variant='body1Semibold'>Landa Trip Inc</Typography>
                        <Typography component="h6" sx={{color : theme.gray.tone2 , mt : 1}} variant='body1Semibold'>C800-136 Market Street, Winnipeg, Manitoba</Typography>
                        <Typography component="h6" sx={{color : theme.gray.tone2 , mt : 1}} variant='body1Semibold'>+98 (913) 119-3442</Typography>
                    </Box>
                </Box>
                </Grid>
                <Grid item xs={12} sm={12}>
                    <Box sx={{display : "flex" , justifyContent : "center" , alignItems : "center",boxshadow: "0px 1px 0px 0px #FFF inset, 0px 0px 0px 1px #F5E8EC, 0px 1px 2px 0px rgba(0, 0, 0, 0.08)" , backgroundColor : theme.gray.tint1 , borderRadius : "12px" ,py :"12px" , px : "16px" }}>
                        <Typography component="p" variant='subtitle2Bold' sx={{color : theme.gray.tone3}}><Typography fontWeight={700} sx={{color : theme.success.main}} variant='subtitle2Bold' component="span">$4,950.00 </Typography>dues on 15 Aug, 2023</Typography>
                    </Box>
                </Grid>
                <Grid item xs={12} sm={12}>
                <TableContainer component={Paper} sx={{backgroundColor : theme.gray.tint3 , boxShadow: "0px 1px 0px 0px #FFF inset, 0px 0px 0px 1px #E8EDF5, 0px 1px 2px 0px rgba(0, 0, 0, 0.08)" }}>
                    <Table sx={{ minWidth: 700 }} aria-label="spanning table">
                        <TableHead>
                            <TableRow>
                                <TableCell><Typography sx={{color : theme.gray.tone3}} component="p" variant='body1Semibold'>Service</Typography></TableCell>
                                <TableCell align="center"><Typography sx={{color : theme.gray.tone3}} component="p" variant='body1Semibold'>Qty</Typography></TableCell>
                                <TableCell align="center"><Typography sx={{color : theme.gray.tone3}} component="p" variant='body1Semibold'>Unit Price</Typography></TableCell>
                                <TableCell align="right"><Typography sx={{color : theme.gray.tone3}} component="p" variant='body1Semibold'>Line Total</Typography></TableCell>
                            </TableRow>
                        </TableHead>
                        <TableBody>
                            {rows.map((row) => (
                                <TableRow key={row.title}>
                                    <TableCell><Box><Typography component="p" variant='body1Bold' sx={{color : theme.gray.tone3}} >{row.title}</Typography><Typography sx={{fontWeight : "400" , mt : 1 , color : theme.gray.tone2}}  component="p" variant='body1'>{row.title0}</Typography></Box></TableCell>
                                    <TableCell align="center"><Typography  component="p" sx={{color : theme.gray.tone2 , }} variant='body1Semibold'>{row.title1}</Typography></TableCell>
                                    <TableCell align="center"><Typography  component="p" sx={{color : theme.gray.tone2 , }} variant='body1Semibold'>{row.title2}</Typography></TableCell>
                                    <TableCell align="right"><Typography  component="p" sx={{color : theme.gray.tone2 , }} variant='body1Semibold'>{row.title3}</Typography></TableCell>
                                </TableRow>
                            ))}
                            <TableRow>
                                <TableCell rowSpan={5} />
                                <TableCell rowSpan={5} />
                                <TableCell colSpan={1} ><Typography  component="p" variant='body1Semibold' sx={{color : theme.gray.tone3}} >Subtotal</Typography></TableCell>
                                <TableCell  align="right"><Typography  component="p" variant='body1Semibold' sx={{ color :  theme.gray.tone2}}>$ 600.00</Typography></TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell colSpan={1}><Typography  component="p" variant='body1Semibold' sx={{color : theme.gray.tone3}}>Tax (0%)</Typography></TableCell>
                                <TableCell align="right"><Typography  component="p" variant='body1Semibold' sx={{ color :  theme.gray.tone2}}>$ 0.00</Typography></TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell colSpan={1}><Typography  component="p" variant='body1Semibold' sx={{color : theme.gray.tone3}}>Total</Typography></TableCell>
                                <TableCell align="right"><Typography component="p" variant='body1Semibold' sx={{color : theme.gray.tone3}}>$ 600.00</Typography></TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell colSpan={1}><Typography  component="p" variant='body1Semibold' sx={{color : theme.gray.tone3}}>Amount due</Typography></TableCell>
                                <TableCell align="right"><Typography  component="p" variant='body1Semibold' sx={{color : theme.gray.tone3}}>US$ 600.00</Typography></TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell colSpan={1}><Typography  component="p" variant='body1Semibold' sx={{color : theme.gray.tone3}}>Amount due</Typography></TableCell>
                                <TableCell align="right"><Typography  component="p" variant='body1Semibold' sx={{color : theme.gray.tone3}}>US$ 600.00</Typography></TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </TableContainer>
                </Grid>
            </Grid>
            <Typography sx={{mt : 5}}  component="h4" variant='h4Bold'>Payment Gateways</Typography>
            <Box sx={{width : "100%"}}> 
                <Box sx={{ mt: 3, px: 3, display: "flex", justifyContent: "space-between", alignItems: "center" , flexWrap : "wrap",rowGap : 1 }}>
                    {payment.map((item, index) => (
                        <Box
                            key={index}
                            sx={{
                            p: 2,
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center",
                            flexDirection: "column",
                            boxShadow: "5px 5px 40px 2px rgba(0, 0, 0, 0.10)",
                            borderRadius: "12px",
                            border: selectedPayment === item.text ? `2px solid ${theme.button}` : "2px solid transparent",
                            cursor: "pointer",
                            bgcolor :selectedPayment === item.text ? theme.primary.tint3 : "transparent" ,
                            }}
                            onClick={() => handlePaymentSelect(item.text)}
                        >
                            <Box sx={{height: "4rem", objectFit: "contain" }}>
                                <img src={item.img} alt={item.img} style={{width : "100%"}}/>
                            </Box>
                            <Typography mt={4}  component="p" variant="subtitle2Semibold" sx={{color : theme.gray.tone3}} >
                                {item.text}
                            </Typography>
                        </Box>
                    ))}
                </Box>
            </Box>
        </>
    )
}



export default Step6;