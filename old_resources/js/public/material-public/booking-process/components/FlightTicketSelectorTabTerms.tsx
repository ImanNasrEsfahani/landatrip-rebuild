import * as React from "react";
import { Box, Typography } from "@mui/material";
import customTheme from '../../custom';

const theme : any = customTheme.palette;

const api = [
    {
        title : "General",
        text : `General
        These Terms and Conditions (“Terms”) govern the access and use of the website, mobile site and mobile application (collectively, “Website”) and all software, information and services available on the Website, except where we expressly state that separate terms apply. This Website is owned and operated by Air India Limited, whose registered office is at Block 4, Vatika One on One, Sector 16, NH 48, Gurugram-122001, Haryana. The Terms also include our privacy policy (“Privacy Policy”) and cookie policy (“Cookie Policy) and any guidelines, additional terms, policies, or disclaimers made available or issued and updated by us from time to time, each of which are incorporated by reference in these Terms.
        For the purposes of these Terms, "we", "our", "us" and “Air India” refers to Air India Limited and its affiliates, while references to “you” and “your” refers to the persons accessing the Website. Please review these Terms carefully before using the Website. By the using the Website, you agree that you have read, understood, and are bound by these Terms as updated from time to time, and that you comply with the requirements listed here. You hereby represent and warrant that you have full legal capacity and authority to bind yourself to these Terms. If you represent an entity, organisation, or any other person, you confirm and represent that you have the necessary power and authority to bind such entity, organisation, or person to these Terms. Your use of the Website indicates your agreement to be bound by these Terms in consideration of the access provided to the Website.
        If you do not agree to these Terms , any of the related documentation linked within the Terms or other restrictions notified to you during the course of your use of the Website, you are not permitted to, and agree not to, use or access the Website.`
    },
    {
        title : "Scope of the Terms",
        text : `Scope of the Terms
        These Terms only govern your use of the Website.
        Separate terms and conditions apply to online bookings, mobile bookings, privacy, loyalty programme, as well as or any other promotion which we may run from time to time. In the event of any ambiguity, conflict or inconsistency between these Terms and the separate terms and conditions, the latter will prevail.`
    }
]

const FlightTicketSelectorTabTerms = () => {
    return(
        <Box className="scrollbarInputs" sx={{height : "80vh" , overflow : "auto" , pr : 1}}>
            {api.map((item,index)=>(
                <>
                    <Typography key={index} component="h6" variant="h6">
                        {item.title}
                    </Typography>
                    <Typography component="p" variant="subtitle1" sx={{color : theme.gray.tone3 , textAlign : "justify", mb:3}}>
                        {item.text}
                    </Typography>
                </>
            ))}
        </Box>
    )
}

export default FlightTicketSelectorTabTerms;
