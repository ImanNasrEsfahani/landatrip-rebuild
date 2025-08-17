import React from "react";



export default function GroupInfo(props){
    return(
        <div className="bg-white shadow w-100 h-auto p-3 rounded-3">
            <div className="w-75 mx-auto text-center">
                {(props.GroupImage)?(<img className="w-100 max-w-10rem text-center rounded-circle" src={import.meta.env.VITE_ASSET_URL + '/public/groups/thumbnails/' + props.GroupImage.url} alt=""/>)
                :(<img className="w-100 max-w-10rem text-center rounded-circle" src={import.meta.env.VITE_ASSET_URL + '/public/groups/thumbnails/default.png'} alt="group image"/>)
                }
            </div>
            <div className="w-100 mt-3">
                <p className="text-center mb-1"><b>{props.group.title}</b></p>
            </div>
            <div className="w-75 mx-auto mt-3">
                <i className="text-orange fa-solid fa-clock"></i>
                <span className="ms-2">{props.GroupDate}</span>
            </div>
            <div className="w-75 mx-auto mt-2">
                {(() => {

                    switch (props.group.status) {
                        case 4:
                            return (
                                <div><i className="text-orange fa-solid fa-battery-full"></i>
                                    <span className="ms-2">Cancelled</span></div>
                            )
                        case 3:
                            return (
                                <div><i className="text-orange fa-solid fa-battery-full"></i>
                                    <span className="ms-2">Completed</span></div>
                            )
                        case 2:
                            return (
                                <div><i className="fa-solid fa-battery-empty"></i>
                                    <span className="ms-2">No Time</span></div>
                            )
                        case 1:
                            return (
                                <div><i className="fa-solid text-orange fa-battery-full"></i>
                                    <span className="ms-2">Sold Out</span></div>
                            )
                        case 0:
                            return (
                                <div><i className="fa-solid text-orange fa-battery-empty"></i>
                                    <span className="ms-2">Booking</span></div>
                            )
                    }
                })()}
            </div>
        </div>

    )
}
