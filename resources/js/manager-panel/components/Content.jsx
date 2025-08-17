import React from 'react';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import "./Content.scss";
import Dashboard from "../views/dashboard";
import Error from "../views/Error";
import AccountContactDetail from "../views/Account-Contactdetails";
import AccountEducationalBackground from "../views/Account-EducationalBackground";
import AccountWorkExperience from "../views/Account-WorkExperience";
import AccountMyDocuments from "../views/Account-MyDocuments";
import AccountAgreement from "../views/AccountAgreement";
import DeleteUserAccount from "../views/Account-DeleteUserAccount";
import MyTours from "../views/MyTours";
import MyActivities from "../views/Activities";
import Badges from "../views/Badge";
import Invoices from "../views/Invoices";
import Coupons from "../views/Coupons";
import Ticket from "../views/ticket";
import AccountChangePassword from "../views/Account-ChangePassword";
import AccountSocialMedia from "../views/Account-SocialMedia";
console.log("Content jsx ");

export default function Content(props) {

    return(
        <div className="main-content w-100 position-relative p-4">
            <Routes>
                <Route path="panel">
                    <Route exact path="" element={<Dashboard />} />
                    <Route path="account-info/details" element={<AccountContactDetail />} />
                    <Route path="account-info/educational-background" element={<AccountEducationalBackground />} />
                    <Route path="account-info/work-experience" element={<AccountWorkExperience />} />
                    <Route path="account-info/my-documents" element={<AccountMyDocuments />} />
                    <Route path="account-info/agreement" element={<AccountAgreement />} />
                    <Route path="account-info/delete-user-account" element={<DeleteUserAccount />} />
                    <Route path="tours" element={<MyTours />} />
                    <Route path="activities" element={<MyActivities />} />
                    <Route path="Badges" element={<Badges />} />
                    <Route path="Invoices" element={<Invoices />} />
                    <Route path="Coupons" element={<Coupons />} />
                    <Route path="ticket" element={<Ticket />} />
                    <Route path="account-info/change-password" element={<AccountChangePassword />} />
                    <Route path="account-info/social-media" element={<AccountSocialMedia />} />

                </Route>
            </Routes>
        </div>
    );
}
