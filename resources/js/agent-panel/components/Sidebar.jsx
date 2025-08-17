import React from 'react';
import "./Sidebar.scss";
import SidebarContent from "./SidebarContent";
import SidebarHeader from "@/agent-panel/components/SidebarHeader";

export default function Sidebar({children}) {
    const menuItem=[
        {
            path: "agent-panel/notification",
            name: "Notification",
            icon: "fa-light fa-bell fs-3",
            type: false,
            bsclass: "d-md-none"
        },
        {
            path: "agent-panel/account-info",
            name: "Account info",
            icon: "fa-solid fa-id-card fs-3",
            type: true,
            id : "account-info",
            children: [
                {
                    name: 'Contact details',
                    path: 'agent-panel/account-info/details/'
                },
                {
                    name: 'My Documents',
                    path: 'agent-panel/account-info/documents'
                },
                {
                    name: 'Agreements',
                    path: 'agent-panel/account-info/agreements'
                }
                ,
                {
                    name: 'Delete user Account',
                    path: 'agent-panel/account-info/delete-user-account'
                }
            ]
        },
        {
            path: "agent-panel/tours",
            name: "My Tours",
            icon: "fa-solid fa-plane-up fs-3",
            type: true,
            id : "tours",
            children: [
                {
                    name: 'Tour List',
                    path: 'agent-panel/tours/my-tours'
                }
            ]
        },
        {
            path: "agent-panel/affiliate",
            name: "Affiliate Links",
            icon: "fa-solid fa-file-certificate fs-3",
            type: true,
            id : "affiliate",
            children: [
                {
                    name: 'Generate New Link',
                    path: 'agent-panel/affiliate/generate-new-link'
                },
                {
                    name: 'Links List',
                    path: 'agent-panel/affiliate/links-list'
                },
                {
                    name: 'People List',
                    path: 'agent-panel/affiliate/people-list'
                }
            ]
        },
        {
            path: "agent-panel/invoices",
            name: "Invoices",
            icon: "fa-solid fa-file-invoice-dollar fs-3",
            type: false
        },
        {
            path: "agent-panel/ticket",
            name: "Ticket",
            icon: "fa-solid fa-tickets-airline fs-3",
            type: false
        },
        {
            path:"agent-panel/wallet",
            name:"Wallet",
            icon: "fa-solid fa-file-invoice-dollar fs-3",
            type: false
        }
    ]
    return(
        <>
            <nav id="sidebar" className="d-md-block bg-deep-sea-green text-white shadow collapse navbar-collapse">
                <SidebarHeader/>
                {
                    menuItem.map((item, index) => (
                        <SidebarContent name={(item.name)} bsclass={item.bsclass} icon={item.icon} path={item.path} type={item.type} children={item.children} id={item.id} key={index}/>
                    ))
                }
            </nav>
        </>
    );
}
