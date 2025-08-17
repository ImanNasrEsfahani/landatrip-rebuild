import React from "react";
import CommentLikeButton from "./CommentLikeButton";
import PostCommentReplies from "./post-comment-replies";
import {useDispatch} from "react-redux";
import {mention} from "../redux/Details";

export default function PostComment(props) {

    const dispatch = useDispatch();
    const handleClick = ()=>{
        dispatch(mention("@Sobhan"));
    }
    return (
            <>
                <div className="d-flex flex-column mt-2 mb-4">
                    <div className="d-flex flex-row">
                        <a  href={props.value.user_id}>
                            {(props.value.user.profile_image) ? (<img className="max-h-3rem ms-2 me-4 rounded-circle "
                                                               src={import.meta.env.VITE_ASSET_URL + "/public/users/profile/" + props.value.user.profile_image.url}/>):
                                (<img className="max-h-3rem ms-2 me-4 rounded-circle"
                                      src={import.meta.env.VITE_ASSET_URL + "/public/users/profile/" + (props.value.user.sex===2)?("female.png"):("male.png")}/>)}
                        </a>
                        <div className="w-100">
                            <div className="bg-gray w-100 rounded-4 text-black p-3 ">
                                <a className="text-decoration-none">
                                    <h6>{props.value.user.fname} {props.value.user.lname}</h6>
                                </a>
                                <p className="mb-0">{props.value.comment}</p>
                                <div className="d-flex flex-row ms-6 mt-2">
                                    <CommentLikeButton likes={props.value.user_post_comment_likes} auth={props.auth} post={props.value} postid={props.postid}/>
                                    <div className="like-comment-btn">
                                        {(props.auth)?(<a onClick={handleClick} className="rounded-pill py-1 px-3 text-decoration-none text-secondary ms-2 fs-2 align-self-center">Reply</a>):("")}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {props.value.user_post_comment_replies.map((item,index)=><PostCommentReplies auth={props.auth} post={item} postid={props.postid}/>)}
                </div>
            </>
    )
}
