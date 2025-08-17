import * as React from 'react';
import axios from "axios";
import {useState} from "react";
import emptyHeader from "../../images/empty-heart.svg";
import fullHeart from "../../images/full-heart.svg";
import {route} from "../../helpers";
import {useMutation} from "react-query";

type Data={
    count:number,
    tourCommentReply:string,
    isLiked:number
}
export default function LikeReplyComments(props:Data) {

    const [like, setLike] = useState<number>(Number(props.isLiked));
    const [countLike, setCountLike] = useState<number>(props.count);

    const likeComment = useMutation('likeComment', async()=>{
        return await axios.post(route("api.public.TourCommentReplyLike", {"tourCommentReply": props.tourCommentReply}))
    },{
        onSuccess: (data):void => {
            setLike(1);
            setCountLike(prevCount => Number(prevCount)+1);
        }
    })

    const dislikeComment = useMutation('dislikeComment', async()=>{
        return await axios.post(route("api.public.TourCommentReplyDislike", {"tourCommentReply": props.tourCommentReply}))
    },{
        onSuccess:(data):void => {
            setLike(0);
            setCountLike(prevCount => Number(prevCount)-1);

        }
    })

    const likeHandle =():void=> {
        if(props.isLiked >= 0) {
            if (like == 1){
                dislikeComment.mutate();
            } else {
                likeComment.mutate();
            }
        }
    }

    return (
        <div className="flex items-center gap-x-2">
            <button className="h-full" onClick={likeHandle}>
                <img width="20" src={ like > 0 ? fullHeart : emptyHeader }/>
            </button>
            <p>
                {countLike == 0 ? "Like": countLike}
            </p>
        </div>
    );
}


