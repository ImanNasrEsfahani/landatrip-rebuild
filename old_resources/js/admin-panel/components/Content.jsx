import React from 'react';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import "./Content.scss";
import CreatTicket from "../views/jsx/Create-Ticket";
import UnassignedTickets from "../views/jsx/Unassigned-Tickets";
import OpenTickets from "../views/jsx/Open-Tickets";
import ArchivedTickets from "../views/jsx/Archived-Tickets";
import TicketDetails from "../views/jsx/TicketDetails";
import AddUserGroups from "../views/jsx/AddUser-Groups";

// import Dashboard from "../views/Dashboard";
// // import Error from "../views/Error";
// import AccountEducationalBackground from "../views/Account-EducationalBackground";
// import AccountWorkExperience from "../views/Account-WorkExperience";
// import AccountMyDocuments from "../views/Account-MyDocuments";
// import AccountAgreement from "../views/Account-Agreement";
// import DeleteUserAccount from "../views/Account-DeleteUserAccount";
// import TourList from "../views/TourList";
// import AddTour from "../views/AddTour";
// import GroupList from "../views/GroupList";
// import AddGroup from "../views/AddGroup";
// import AffiliateGenerate from "../views/Affiliate";
// import Ticket from "../views/Ticket";
// import AccountChangePassword from "../views/Account-ChangePassword";
// import AccountSocialMedia from "../views/Account-SocialMedia";
// import AffiliateList from "../views/AffiliateList"
console.log("Content jsx ");

export default function Content(props) {

    return(
        <div className="main-content w-100 position-relative p-4">
            <Routes>
                <Route path="admin-panel">
                    {/*<Route exact path="" element={<Dashboard />} />*/}
                    <Route path="tickets/new-tickets" element={<CreatTicket />} />
                    <Route path="tickets/unassigned" element={<UnassignedTickets />} />
                    <Route path="tickets/open-tickets" element={<OpenTickets />} />
                    <Route path="tickets/archived-tickets" element={<ArchivedTickets />} />
                    <Route path="ticket/:id" element={<TicketDetails />} />
                    <Route path="groups/add-user-group" element={<AddUserGroups />} />
                    {/*<Route path="account-info/delete-user-account" element={<DeleteUserAccount />} />*/}
                    {/*<Route path="tours/tour-list" element={<TourList />} />*/}
                    {/*<Route path="tours/add-new" element={<AddTour />} />*/}
                    {/*<Route path="groups/groups-list" element={<GroupList />} />*/}
                    {/*<Route path="groups/add-new" element={<AddGroup />} />*/}
                    {/*<Route path="affiliates/affiliate-generator" element={<AffiliateGenerate />} />*/}
                    {/*<Route path="affiliates/affiliate-list" element={<AffiliateList />} />*/}
                    {/*<Route path="ticket" element={<Ticket />} />*/}
                    {/*<Route path="account-info/change-password" element={<AccountChangePassword />} />*/}
                    {/*<Route path="account-info/social-media" element={<AccountSocialMedia />} />*/}

                </Route>
            </Routes>
        </div>
    );
}
