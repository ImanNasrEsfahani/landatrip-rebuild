import React from 'react';
import { Routes, Route } from "react-router-dom";
import "./Content.scss";
import Dashboard from "./../views/jsx/Dashboard";
import AccountContactDetails from "@/agent-panel/views/jsx/Account-ContactDetails";
import AccountAgreements from "@/agent-panel/views/jsx/Account-Agreements";
import AccountMyDocuments from "@/agent-panel/views/jsx/Account-MyDocuments";
import AccountDeleteAccount from "@/agent-panel/views/jsx/Account-DeleteAccount";
import TourList from "@/agent-panel/views/jsx/Mytour-TourList";
import AffiliateGenerateLinks from "@/agent-panel/views/jsx/Affiliate-GenerateLinks";
import AffiliateLinksList from "@/agent-panel/views/jsx/Affiliate-LinksList";
import AffiliatePeopleList from "@/agent-panel/views/jsx/Affiliate-PeopleList";
import Invoices from "@/agent-panel/views/jsx/Invoices";
import Ticket from "@/agent-panel/views/jsx/Ticket";
import Wallet from "@/agent-panel/views/jsx/Wallet";

export default function Content(props) {

    return(
        <div className="main-content w-100 position-relative p-4">
            <Routes>
                <Route path="agent-panel">
                    <Route exact path="" element={<Dashboard />} />
                    <Route path="account-info">
                        <Route path="details" element={<AccountContactDetails />} />
                        <Route path="agreements" element={<AccountAgreements />} />
                        <Route path="documents" element={<AccountMyDocuments />} />
                        <Route path="delete-user-account" element={<AccountDeleteAccount />} />
                    </Route>
                    <Route path="tours">
                        <Route path="my-tours" element={<TourList/>} />
                    </Route>
                    <Route path="affiliate">
                        <Route path="generate-new-link" element={<AffiliateGenerateLinks/>} />
                        <Route path="links-list" element={<AffiliateLinksList/>} />
                        <Route path="people-list" element={<AffiliatePeopleList/>} />
                    </Route>
                    <Route path="invoices" element={<Invoices/>} />
                    <Route path="ticket" element={<Ticket/>} />
                    <Route path="wallet" element={<Wallet/>} />
                </Route>
            </Routes>
        </div>
    );
}
