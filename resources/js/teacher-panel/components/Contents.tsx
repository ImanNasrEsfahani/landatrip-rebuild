import * as React from "react";
import { Route, Routes} from "react-router-dom";


import Tour from "../views/tsx/tours/Tour"
import Dashboard from "../views/tsx/dashboard/Dashboard"
import AccountInfo from "../views/tsx/account-info/AccountInfo";
import Applications from "../views/tsx/applications/Applications";
import Conversation from "../views/tsx/conversation/Conversation";
import Affiliation from "../views/tsx/affiliation/Affiliation";
import Agreements from "../views/tsx/agreements/Agreements";
import Calender from "../views/tsx/calender/Calender";
import Wallet from "../views/tsx/wallet/Wallet";
import AddTour from "../views/tsx/tours/AddTour"
import TourDescription from "../views/tsx/tours/TourDescription"
import AddNewGroup from "../views/tsx/tours/AddNewGroup"

export default function Contents() {
    return (
        <>
            <Routes>
                <Route path="teacher-panel">
                    <Route path="" element={<Dashboard />} />
                    <Route path="account-info" element={<AccountInfo />} />
                    <Route path="tours" element={<Tour />} />
                    <Route path="tours/:id" element={<TourDescription/>}/>
                    <Route path="tours/:id/add-new-group" element={<AddNewGroup/>}/>
                    <Route path="tours/add-tour" element={<AddTour />} />
                    <Route path="Applications" element={<Applications />} />
                    <Route path="Conversation" element={<Conversation />} />
                    <Route path="Affiliation" element={<Affiliation />} />
                    <Route path="Agreements" element={<Agreements />} />
                    <Route path="Calender" element={<Calender />} />
                    <Route path="Wallet" element={<Wallet />} />
                </Route>
            </Routes>
        </>
    );
}
