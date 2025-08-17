import react from 'react'
import Dahboard from './assets/Dashboard.svg'
import Trasaction from './assets/trasaction.svg'
import Employs from './assets/employs.svg'
import Teachers from './assets/teachers.svg'
import Students from './assets/Students.svg'
import Courses from './assets/Courses.svg'
import Clients from './assets/Clients.svg'


export const SidebarContent =[
    {
        name :'Dashboard',
        icon : <img src={Dahboard} className="icon"/>,
        path : "",
        bsclass: "d-md-none",
        children:[
            {
                name : "Analytics"
            },
            {
                name : "Sales"
            },
            {
                name : "commerece"
            }
        ]
    },
    {
        name :'Trasaction',
        icon : <img src={Trasaction} className="icon"/>,
        path : "",
        bsclass: "d-md-none"
    },
    {
        name :'Employes',
        icon : <img src={Employs} className="icon"/>,
        path : "",
        bsclass: "d-md-none"
    },
    {
        name :'Teachers',
        icon : <img src={Teachers} className="icon"/>,
        path : "",
        bsclass: "d-md-none"
    },
    {
        name :'students',
        icon : <img src={Students} className="icon"/>,
        path : "",
        bsclass: "d-md-none"
    },
    {
        name :'Courses',
        icon : <img src={Courses} className="icon"/>,
        path : "",
        bsclass: "d-md-none"
    },
    {
        name :'Clients',
        icon : <img src={Clients} className="icon"/>,
        path : "",
        bsclass: "d-md-none"
    }

]
