import React, {useContext} from "react";
import {useDrag, useDrop} from "react-dnd";
import {ItemTypes} from "./types";


export default function GroupMembers(props){
    const [{isDragging},drag] = useDrag({
        type: ItemTypes.Card,
        item: {ID : props.id,
                status:props.status},
        collect:(monitor) => ({
            isDragging : !!monitor.isDragging()
        })
    })

    return(
        <div className="col-8 text-center">
            <a className="text-decoration-none" href="">
                <img className={`max-h-4rem p-0 rounded-4 mb-1 opacity-${isDragging ? 50 : 100}`} ref={drag}
                     src={import.meta.env.VITE_ASSET_URL + `/public/users/profile/${props.image}`}
                />
            </a>
        </div>
    )
}
