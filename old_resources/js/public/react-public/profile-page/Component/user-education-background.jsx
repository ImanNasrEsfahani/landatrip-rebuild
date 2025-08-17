import React from "react";


export default function UserEducationBackground(props){
   const EducationList = JSON.parse(props.Education)
    return(
        <div className="d-block w-100">
            <h6 className="text-black">education</h6>
            <ul className="text-dark-gray fs-2">
                {EducationList.map((item,key)=>
                    <li className="mb-2">{item.level} - {item.title} at {item.university} from {item.form} - {item.to}</li>
                )}
            </ul>

    <div className="d-block w-100">
        <h6 className="text-black">Skills</h6>
        <p className="text-dark-gray fs-2">Skills sub</p>
    </div>
        </div>
)
}
