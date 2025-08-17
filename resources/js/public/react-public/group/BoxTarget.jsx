import React, {useContext} from "react";
import {useDrop} from "react-dnd";
import {ItemTypes} from "./types";
import {CardContext} from "./GroupStudents";


export default function BoxTarget(props) {
    const {children, auth , group} = props;
    const {MarkAsDrag} = useContext(CardContext);
    const [{isOver}, drop] = useDrop({
        accept: ItemTypes.Card,
        drop: (item, monitor) => MarkAsDrag(item.ID),
        collect: (monitor) => ({
            isOver: !!monitor.isOver()
        })
    });
    return (
        <div className="row mt-3 gy-3 justify-content-evenly mx-1" ref={drop}>
                <div
                    className={`title row justify-content-between mx-1 py-2 px-1 rounded-4 border bg-${isOver ? "gray" : "white"}`}>
                    {children}
                </div>
        </div>
    )
}
