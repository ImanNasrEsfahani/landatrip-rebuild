import React from "react";


export default function UserInfo(props){

    const user = props.user
    console.log(user)
    return(
        <>
            <div className="d-block"><h4 className="h6 d-inline-block text-black mx-3">Company</h4>
                 <p className="d-inline-block fs-2 text-dark-gray mb-2 ">{user.Company}</p>
            </div>
            {user.score > 50 ?(<div className="d-block"><h4 className="h6 d-inline-block text-black mx-3">Education Level</h4>
                <p className="d-inline-block fs-2 text-dark-gray mb-2"></p>Master</div>):
                <div className="d-block"><h4 className="h6 d-inline-block text-black mx-3">Experience Level</h4>
                    <p className="d-inline-block fs-2 text-dark-gray mb-2">Medior</p>
                </div>
            }

            <div className="w-100 mt-3 row">
            <div className="col-24 d-flex justify-content-around mb-4 ms-3">
                {user.social_media.map((item,key)=>
                    <a className="text-decoration-none" href={item.pivot.address} ><i
                        className={`fa-brands ${item.icon} text-orange border-bottom border-end border-1 border-light-gray p-2 rounded-3 align-self-center shadow-sm`}></i></a>
                )}
            </div>
               <div className="col-24">
                       <img className="text-orange" src={import.meta.env.VITE_ASSET_URL + "/public/users/location.svg" }/>
                       <p className="ms-2 d-inline-block fs-2 text-dark-gray">{user.location}</p>
                       <img className="text-orange ms-2" src={import.meta.env.VITE_ASSET_URL + "/public/users/sex.svg"}/>
                       <p className="ms-2 d-inline-block fs-2 text-dark-gray">{(user.sex===0)?("male"):(user.sex===1)?("female"):("prefer not to say")}</p>
               </div>
            </div>

            <div className="d-block w-100">
                <h6 className="text-black">About Me</h6>
                <p className="text-dark mb-0">{user.about_me}</p>
                <a className="text-orange fs-1 text-decoration-none" href="#">Read More</a>
            </div>


        </>


)
}
