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
        return groupPostsShow;
    },{refetchInterval:3000});


    return (
        (groupPostsShow.data)?(
            <>
            <div>
                {groupPostsShow.data.data.map((value, key) => (
                    (value.user_id === auth.id)?(
                        <div className="d-flex mb-3 px-1 justify-content-end">
                        <div className="rounded-3 bg-light p-2 pe-3 w-auto">
                            <a className="text-decoration-none" href="#">
                                <h6 className="pt-2 px-2 text-green fw-bold"> { value.user_name }</h6>
                            </a>
                            <p className="px-2 text-black">{ value.message }</p>
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
