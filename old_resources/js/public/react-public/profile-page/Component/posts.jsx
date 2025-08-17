import React from "react";
import PostBar from "./post-bar";
import PostComment from "./post-comment";
import CommentForm from "./comment-form";


export default function Posts(props) {

    const post = props.post
    const auth = props.auth

    return (
        <>
                    <div className="bg-white rounded-4 shadow pb-2 pt-4 mb-4" >
                        <p className="text-black h6 ps-4 mb-1">{post.title}</p>
                        <div className="d-flex flex-row ps-3 mb-2">
                            <img className="text-orange ms-1 me-2"/>
                            <p className="text-dark-gray mb-0">{post.location}</p>
                            <span className="text-dark-gray ms-2 me-1">-</span>
                            <p className="text-dark-gray pb-0 mb-1">{post.human}</p>
                        </div>
                        {
                            (post.content_image) ?
                                (<img className="w-100"
                                  src={import.meta.env.VITE_ASSET_URL + "/public/posts/" + post.content_image.url}
                                  alt={import.meta.env.VITE_ASSET_URL + "/public/posts/" + post.content_image.alt}/>)
                                :
                                ( <img className="w-100" src={import.meta.env.VITE_ASSET_URL + "/public/posts/default.png"}/>)
                        }
                        <PostBar post={post} auth={auth} user={props.user}/>
                        <hr className="text-dark-gray w-100 px-3"/>
                        <div className=" w-100 px-3" >
                            {post.user_post_comments.map((item,index) => <PostComment value={item} auth={auth} postid={post.id}/> )}
                            <CommentForm auth={auth} post={post}/>
                            </div>
                    </div>
        </>
    )
}
