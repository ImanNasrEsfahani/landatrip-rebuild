import React from 'react'


export default function GroupHeader(props){
    console.log(props.group)
    return(
        <>
        <div className="d-flex flex-row">
            {(props.GroupImage)?( <img className="h-100 mt-1 rounded-circle max-w-4rem" src={import.meta.env.VITE_ASSET_URL + '/public/groups/thumbnails/' + props.GroupImage.url}  alt=""/>)
                :
                (<img className="h-100 mt-1 rounded-circle max-w-4rem"
                      src={ import.meta.env.VITE_ASSET_URL + '/public/groups/thumbnails/default.png'} alt="group image"/>)
            }
                    <div className="ms-3 d-flex flex-column flex-grow-1 align-self-center">
                        <h5 className="h6 mb-1">{props.group.title}</h5>
                        <p className="text-dark-gray mb-0">{props.Student.length} members</p>
                    </div>
        </div>
    <hr className="w-100 mt-2 mb-4 mx-auto border-dark-gray"/>
    </>
    )
}
