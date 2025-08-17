import React from 'react';

import "./Sidebar.scss";
import SidebarHeader from "./SidebarHeader";
import SidebarContent from "./SiderbarContent";
import {NavLink} from "react-router-dom";

console.log("Sidebar jsx ");

export default function Sidebar({children}) {
    const menuItem=[
        {
            path: "admin-panel/notification",
            name: "Notification",
            icon: "fa-light fa-bell fs-3",
            type: false,
            bsclass: "d-md-none"
        },
        {
            path: "admin-panel/apps",
            name: "Apps",
            icon: "fa-light fa-grid-3 fs-3",
            type: false,
            bsclass: "d-md-none"
        },
        {
            path: "admin-panel/user",
            name: "User",
            icon: "fa-light fa-user fs-3",
            type: false,
            bsclass: "d-md-none"
        },
        {
            path: "admin-panel/settings",
            name: "Settings",
            icon: "fa-light fa-gear fs-3",
            type: false,
            bsclass: "d-md-none"
        },
        {
            path: "admin-panel/tickets",
            name: "Tickets",
            icon: "fa-solid fa-ticket fs-3",
            type: true,
            id:"tickets",
            children: [
                {
                    name: 'New tickets',
                    path: 'admin-panel/tickets/new-tickets'
                },
                {
                    name: 'Unassigned',
                    path: 'admin-panel/tickets/unassigned'
                },
                {
                    name: 'Open tickets',
                    path: 'admin-panel/tickets/open-tickets'
                },
                {
                    name: 'Archived tickets',
                    path: 'admin-panel/tickets/archived-tickets'
                }
            ]
        },
        {
            path: "admin-panel/payments",
            name: "Payments",
            icon: "fa-solid fa-credit-card fs-3",
            type: true,
            id:"payments",
            children: [
                {
                    name: 'Recent transactions',
                    path: 'admin-panel/payments/recent-transactions/'
                },
                {
                    name: 'Add user transaction',
                    path: 'admin-panel/payments/add-user-transaction/'
                },
            ]
        },
        {
            path: "admin-panel/invoices",
            name: "Invoices",
            icon: "fa-solid fa-file-invoice-dollar fs-3",
            type: true,
            id:"invoices",
            children: [
                {
                    name: 'Recent invoices',
                    path: 'admin-panel/invoices/recent-invoices/'
                },
                {
                    name: 'Add user invoices',
                    path: 'admin-panel/invoices/add-user-invoices/'
                },
            ]
        },
        {
            path: "admin-panel/tours",
            name: "Tours",
            icon: "fa-solid fa-plane-up fs-3",
            type: true,
            id:"tours",
            children: [
                {
                    name:"Pending tours",
                    path: "admin-panel/tours/pending-tours"
                },
                {
                    name:"Add user tours",
                    path: "admin-panel/tours/add-user-tours"
                }
            ]
        },
        {
            path: "admin-panel/groups",
            name: "Groups",
            icon: "fa-solid fa-users fs-3",
            type: true,
            id:"groups",
            children: [
                {
                    name:"Recent groups",
                    path: "admin-panel/groups/recent-groups"
                },
                {
                    name:"Add user  group",
                    path: "admin-panel/groups/add-user-group"
                },
                {
                    name:"Archived groups",
                    path: "admin-panel/groups/archived-groups"
                }
            ]
        },
        {
            path: "admin-panel/agreement",
            name: "Agreement",
            icon: "fa-solid fa-handshake fs-3",
            type: true,
            id:"agreement",
            children: [
                {
                    name:"Add agreement",
                    path: "admin-panel/agreement/add-agreement"
                },
                {
                    name:"Add user agreement",
                    path: "admin-panel/agreement/add-user-agreement"
                }
            ]
        },
        {
            path: "admin-panel/verification",
            name: "Verification",
            icon: "fa-solid fa-badge-check fs-3",
            type: true,
            id:"verification",
            children: [
                {
                    name:"User documents",
                    path: "admin-panel/verification/user-documents"
                },
                {
                    name:"Change user status",
                    path: "admin-panel/verification/chang-user-status"
                }
            ]
        }
    ]
    return(
        <>
            <nav id="sidebar" className="d-md-block bg-gray-light text-white shadow collapse navbar-collapse">
                <SidebarHeader />
                {
                    menuItem.map((item, index) => (
                        <SidebarContent name={item.name} bsclass={item.bsclass} id={item.id} icon={item.icon} path={item.path} type={item.type} children={item.children} key={index}/>
                    ))
                }
            </nav>
        </>
    );
}
