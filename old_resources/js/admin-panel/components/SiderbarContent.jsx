import {React, useEffect, useState} from 'react';

// import "./SidebarContent.scss";
import {NavLink} from "react-router-dom";


console.log("SidebarContent jsx ");

// export default function SidebarContent(){
//     return (
//         <div>
//             link
//         </div>
//     )
// }

export default function SidebarContent(props){
    const name = props.name;
    const icon = props.icon;
    const path = props.path;
    const type = props.type;
    const children = props.children;
    const bsclass = props.bsclass;
    const id = props.id;
    const [isActiveMenu, setIsActiveMenu] = useState(false);

    const pathname = window.location.pathname
    const [isActive, setIsActive] = useState(false);

    useEffect(() => {
        console.log("useEffect sidebar");
        // console.log(pathname.substring(1));
        // console.log(pathname.substring(1).split("/")[1]);
        // console.log(path.split("/")[1]);
        if(path.split("/")[1] === pathname.substring(1).split("/")[1]) {
            setIsActive(true);
        }

    }, [pathname])

    const checkActivePath = ({ isActive }) => {
        console.log("checkActivePath : " + isActive);
        setIsActiveMenu(isActive === "true");
        // return isActive;
        // if(path === pathname.substring(1)) {
        //        console.log("this is math");
        //     return isActive = true;
        // }
        // return false;
    }

    if (type) {
        return(
            <div className="accordion " id="accordionExample">
                <div className="menu-item mx-1 accordion-item border-0 bg-transparent">
                    <h2 className="accordion-header" id={id+"h"}>
                        <button className={`accordion-button bg-transparent text-white px-3 py-3 ${!isActive ? "collapsed" : ""}`} type="button" data-bs-toggle="collapse"
                                data-bs-target={`#${id}`} aria-expanded="false" aria-controls={id} data-toggle = "tooltip"
                                title = {name}>
                            <i className={`text-white opacity-90 ${icon}`} />
                            <span className="text fs-2 ms-3">{name}</span>
                        </button>
                    </h2>
                </div>
                <div id={id} className={`accordion-collapse my-2 mx-3 bg-white bg-opacity-25 rounded-3 ${!isActive ? "collapse" : "collapse show"}`} aria-labelledby={id+"h"}
                     data-bs-parent="#accordionExample">
                    <div className="accordion-body py-1 px-0">
                        {
                            children.map((item, index) => (
                                <NavLink className={`text-decoration-none fs-1 ps-3 py-2 my-1 d-block w-100 opacity-90`} style={({ isActive }) => ({color: isActive ? 'orange' : 'white' })} to={item.path} key={index}>{item.name}</NavLink>
                            ))
                        }
                    </div>
                </div>
            </div>
        );
    } else {
        return(
            <div className={`menu-item border-0 bg-transparent py-3 px-3 mx-1 ${bsclass}`} data-toggle = "tooltip"
                 title = {name}>
                <NavLink className="bg-transparent text-decoration-none" to={path} style={({ isActive }) => ({color: isActive ? 'orange' : 'white' })}>
                    <i className={`opacity-90 ${icon}`} />
                    <span className="text fs-2 ms-3">{name}</span>
                </NavLink>
            </div>
        );
    }
}
