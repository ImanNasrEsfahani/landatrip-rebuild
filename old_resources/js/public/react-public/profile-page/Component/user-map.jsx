import React from "react";


export default function UserMap(){
    return(
        <div className="w-100 p-3 pt-4 bg-light rounded-3 shadow-lg mb-4 ">
            <h6 className="h5 mb-3">Map</h6>
            <img className="w-100" src={import.meta.env.VITE_ASSET_URL + '/public/users/map.png'}/>
        </div>
)
}
