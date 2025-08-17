import React from "react";
import ReplyCommentLikeButton from "./ReplyCommentLikeButton";
import {useDispatch} from "react-redux";
import {mention} from "../redux/Details";

export default function PostCommentReplies(props) {
    const dispatch = useDispatch();
    const handleClick = ()=>{
        dispatch(mention("@Sobhan"));
    }

    return (
        <div className="d-flex flex-row ms-12 mt-2 ">
            <a>
                {(props.post.user.profile_image) ? (<img className="max-h-2rem ms-2 me-4 rounded-circle"
                                                         src={import.meta.env.VITE_ASSET_URL + "/public/users/profile/" + props.post.user.profile_image.url}
                                                         alt={props.post.user.profile_image.alt}/>)
                    : (<img className="max-h-2rem ms-2 me-4 rounded-circle"
                            src={import.meta.env.VITE_ASSET_URL + "/public/users/profile/" + props.post.user.sex === 2 ? "female.png" : "male.png"}/>)}

            </a>
            <div className="w-85">
                <div className="bg-gray w-100 rounded-4 text-black p-3">
                    <a className="text-decoration-none">
                        <h6 className="fs-2">{props.post.user.fname} {props.post.user.lname}</h6>
                    </a>
                    <p className="mb-0 fs-1">{props.post.reply}</p>
                    <div className="d-flex flex-row ms-4 mt-2">
                        <ReplyCommentLikeButton auth={props.auth} post={props.post} postid={props.postid} />
                        <a onClick={handleClick}
                           className="rounded-pill py-1 px-3 text-decoration-none text-secondary ms-2 fs-1 align-self-center">Reply</a>
                    </div>
                </div>

            </div>
        </div>
    )
}
