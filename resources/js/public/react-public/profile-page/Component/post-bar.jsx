import React from "react";
import Like from "./Like";


export default function PostBar(props){
    const post = props.post
    const auth = props.auth
    return(
        <div className="d-flex flex-row justify-content-between px-3 mt-3 mb-2">
        <span className="d-flex flex-row">
        <Like auth={auth} likes={post.user_post_likes.map((item,key)=>{
           return  item.user_id
        })} postid={post.id} userId={props.user.slug} id={props.user.id} count={post.user_post_likes.length}/>
            </span>
        </div>
    )
}



{/*                <div className="like-post-react-btn"></div>*/}
{/*                                <div className="like-react-btn" active="LikeInactive" ></div>*/}
{/*                <a className="btn btn-orange text-white align-self-center rounded-pill ms-2">Login</a>*/}
{/*        </span>*/}
{/*    <span className="d-flex flex-row">*/}
{/*        <i className="text-orange align-self-center fa-solid fa-comment ms-3"></i>*/}
{/*        <p className="align-self-center text-dark-gray mb-0 ms-2 me-3"></p>*/}
{/*        <i className="text-orange align-self-center fa-solid fa-share-nodes ms-3"></i>*/}
{/*        <p className="align-self-center text-dark-gray mb-0 ms-2 me-3"></p>*/}
{/*    */}
