import React from "react";
import {useQuery} from "react-query";
import axios from "../axiosConfig";
import {route} from "../helpers";
import GroupNewPost from "./GroupNewPost";
import PhotoSwipeLightbox from "photoswipe/lightbox";


function GroupChat (props) {
    const group = JSON.parse(props.group);
    const auth = JSON.parse(props.Auth)

    const groupPostsShow = useQuery('groupPosts', async () => {
        const {data} = await axios.get(route("api.public.group-posts.show", {group: group.slug}));
        groupPostsShow.data = data.data;
        console.log(groupPostsShow)
        return groupPostsShow;
    },{refetchInterval:3000});

    const lightbox = new PhotoSwipeLightbox({
        gallery: '#my-gallery',
        children: 'a',
        pswpModule: () => import('photoswipe'),
        initialZoomLevel: 1,
        secondaryZoomLevel: 'fit',
        maxZoomLevel: 4
    });
    lightbox.init();

    return (
        (groupPostsShow.data)?(
            <>
            <div>
                {groupPostsShow.data.data.map((value, key) => (
                    (value.user_id===auth.id)?(
                        <div key={key} className="d-flex mb-3 px-1 justify-content-end">
                        <div className="rounded-3 bg-light p-2 pe-3 w-50">
                            <a className="text-decoration-none" href="#">
                                <h6 className="pt-2 px-2 text-green fw-bold d-flex justify-content-end"> { value.user_name }</h6>
                            </a>
                            <div>
                                {(value.image)?(
                                        <div class="pswp-gallery pswp-gallery--single-column" id="my-gallery">
                                            <a className="position-relative d-flex justify-content-end"
                                               href={import.meta.env.VITE_ASSET_URL + `/public/groups/chat/${value.image.url}`}
                                               data-pswp-width={import.meta.env.VITE_ASSET_URL + `/public/groups/chat/${value.image.url}`}
                                               data-pswp-height={import.meta.env.VITE_ASSET_URL + `/public/groups/chat/${value.image.url}`}
                                               data-cropped="true"
                                               target="_blank">
                                                <img className="w-20 rounded-3"
                                                     src={import.meta.env.VITE_ASSET_URL + `/public/groups/chat/${value.image.url}`}
                                                     alt=""/>
                                            </a>
                                        </div>
                                    )
                                    // <img className="w-20 rounded-4 mt-5" src={import.meta.env.VITE_APP_URL + `/storage/users/chat/${value.image.url}`} />)
                                    :("")}
                            </div>
                            <p className="px-2 text-black d-flex justify-content-end">{ value.message }</p>
                            <span className="d-flex flex-row justify-content-end fs-1 text-dark-gray"></span>
                        </div>
                            <div className="px-1">
                                <a className="text-decoration-none" href="#">
                                    <img className="max-h-3rem rounded-circle" src={import.meta.env.VITE_ASSET_URL + `/public/users/profile/${value.user_profile_image}`} />
                                </a>
                            </div>
                    </div>):(
                        <div className="d-flex mb-3 px-1">
                            <div className="px-1">
                                <a className="text-decoration-none" href="#">
                                    <img className="max-h-3rem rounded-circle"  src={import.meta.env.VITE_ASSET_URL + `/public/users/profile/${value.user_profile_image}`} />
                                </a>
                            </div>
                            <div className="rounded-3 bg-light p-2 pe-3 w-auto">
                                <a className="text-decoration-none" href="#">
                                    <h6 className="pt-2 px-2 text-green fw-bold"> { value.user_name }</h6>
                                </a>
                                <p className="px-2 text-black">{ value.message }</p>
                                <span className="d-flex flex-row justify-content-end fs-1 text-dark-gray"></span>
                            </div>
                        </div>
                    )
                ))}
            </div>
            <GroupNewPost auth={auth} group={group.slug}/>
            </>
        ):("loading")

    )
}

export default GroupChat;
