import React from "react";


export default function UserWorkExperience(props){
    const WorkExperinceList = JSON.parse(props.WorkExperince)
    return(
        <div className="d-block w-100 mt-4">
            <h6 className="text-black">Companies</h6>
            {WorkExperinceList.map((item,index)=>
                <div className="d-block ms-2">
                    <h6 className="text-black">{item.company_name} - from {item.from} to {item.to}</h6>
                    <p className="text-dark-gray fs-2">position<b/>{item.position}</p>
                </div>
            )}
        </div>

    )
}
