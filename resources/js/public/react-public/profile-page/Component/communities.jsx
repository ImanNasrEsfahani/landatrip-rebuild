import React from "react";


export default function Communities(props){
    const community = props.community
    return(
        <div className="bg-white rounded-4 shadow py-3 px-2">
            <h6 className="h5 text-black ms-3 mb-4"></h6>
            {community.map((item,index)=>
                <div className="mx-2 rounded-4 shadow p-3 mt-2">
                    <a className="d-flex flex-row m-0 p-0 text-decoration-none" href={item.slug}>
                        {(item.thumbnail_image)?(<img src={import.meta.env.VITE_ASSET_URL + "/public/communities/thumbnails/" + item.thumbnail_image.url} alt={item.thumbnail_image.alt}/>)
                            :(<img className="rounded-3" src={import.meta.env.VITE_ASSET_URL + '/public/communities/thumbnails/default.png'} alt="landa trip"/>)}

                    <span className="d-flex flex-column justify-content-center ms-2">
                <h6 className="fs-2 text-black mb-1">{item.title}</h6>
                <p className="fs-1 text-dark-gray mb-0"></p>
                        <span className="me-1"></span>
               </span>
                </a>
                </div>
            )}

        </div>

)
}
