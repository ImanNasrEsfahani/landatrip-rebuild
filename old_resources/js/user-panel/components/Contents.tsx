import * as React from "react";
import {Route, Routes} from "react-router-dom";

import Tour from "../views/tsx/tours/tour";
import Dashboard from "../views/tsx/dashboard/Dashboard";
import AccountInfo from "../views/tsx/account-info/AccountInfo";
import Applications from "../views/tsx/applications/Applications";
import Conversation from "../views/tsx/conversation/Conversation";
import Affiliation from "../views/tsx/affiliation/Affiliation";
import Agreements from "../views/tsx/agreements/Agreements";
import AgreementInfo from "../views/tsx/agreements/AgreementInfo";
import Calender from "../views/tsx/calender/Calender";
import Wallet from "../views/tsx/wallet/Wallet";
import Badge from "../views/tsx/badge/Badge";
import Certificate from "../views/tsx/certificate/Certificate";
import CertificatePic from "../views/tsx/certificate/CertificatePic";
import Privacy from "../views/tsx/privacy/Privacy";
import Activities from "../views/tsx/activities/Activities";
import Invoices from "../views/tsx/invoice/Invoices";
import StudentInvite from "../views/tsx/student-invite/StudentInvite";
import CouponsList from "../views/tsx/coupons-list/CouponsList";
import DeleteAccount from "../views/tsx/delete-account/DeleteAccount";
import ConfirmDeleteAccount from "../views/tsx/delete-account/confirmDeleteAccount";
import Tickets from "../views/tsx/tickets/Tickets";
import NewTickets from "../views/tsx/tickets/NewTickets";
import TicketSupportChat from "../views/tsx/tickets/TicketSuportChat";


export default function Contents() {
    return (
        <>
            <Routes>
                <Route path="user-panel">
                    <Route path="" element={<Dashboard/>}/>
                    <Route path="account-info" element={<AccountInfo/>}/>
                    <Route path="tours" element={<Tour/>}/>
                    <Route path="Applications" element={<Applications/>}/>
                    <Route path="Conversation" element={<Conversation/>}/>
                    <Route path="Affiliation" element={<Affiliation/>}/>
                    <Route path="agreements" element={<Agreements/>}/>
                    <Route path="agreements/:id" element={<AgreementInfo/>}/>
                    <Route path="Calender" element={<Calender/>}/>
                    <Route path="Wallet" element={<Wallet/>}/>
                    <Route path="Badge" element={<Badge/>}/>
                    <Route path="Privacy" element={<Privacy/>}/>
                    <Route path="Certificate" element={<Certificate/>}/>
                    <Route path="Certificate/CertificatePic" element={<CertificatePic/>}/>
                    <Route path="activities" element={<Activities/>}/>
                    <Route path="invoice" element={<Invoices/>}/>
                    <Route path="student-invite" element={<StudentInvite/>}/>
                    <Route path="coupons-list" element={<CouponsList/>}/>
                    <Route path="delete-account" element={<DeleteAccount/>}/>
                    <Route path="delete-account/confirm" element={<ConfirmDeleteAccount/>}/>
                    <Route path="tickets" element={<Tickets/>}/>
                    <Route path="tickets/:id" element={<TicketSupportChat/>}/>
                    <Route path="tickets/new-tickets" element={<NewTickets/>}/>
                </Route>
            </Routes>
        </>
    );
}
