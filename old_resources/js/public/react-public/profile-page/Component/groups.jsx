import React from "react";


export default function Groups(props) {
    const group = props.group

    return (
        <div className="bg-white rounded-4 shadow pt-4 pb-4 px-1 mb-3">
            <h6 className="h5 text-black ms-3 mb-1"></h6>
            {(group.length !== 0) ? (
                group.map((item, index) =>
                        <>
                            <a className="d-flex flex-row text-decoration-none m-0 mt-2 p-0" href={item.slug}>
                                <div className="w-100 mx-3 d-flex flex-row rounded-4 shadow p-2 mt-2">
                                    {(item.thumbnail_image) ? (<img className="h-100 max-w-5rem rounded-3"
                                                                    src={import.meta.env.VITE_ASSET_URL + "/public/groups/thumbnails/" + item.thumbnail_image.url}
                                                                    alt={item.thumbnail_image.alt}/>)
                                        : (<img className="h-100 max-w-5rem rounded-3"
                                                src={import.meta.env.VITE_ASSET_URL + "/public/groups/thumbnails/" + item.thumbnail_image.url}
                                                alt="landa trip groups"/>)}
                                    <span className="d-flex flex-column justify-content-around ms-3">
                <h6 className="fs-2 text-black text-center lh-base mb-0">{item.title}</h6>
                                        {(props.auth) ?
                                            ((props.auth === item.pivot.user_id) ? (
                                                    <p className="fs-1 mb-0 text-green">ClassMates</p>)
                                                : (<p className="fs-1 mb-0 text-danger">Not ClassMates</p>))
                                            : ("")}

            </span>
                                </div>
                            </a>

                        </>
                )
            ) : (
                <div className="alert alert-danger">
                    There is'nt any group for you
                </div>
            )}

        </div>
    )
}
