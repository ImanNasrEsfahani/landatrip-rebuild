import React from 'react';
import axios from "../../axiosConfig"
import {route} from '../../helpers'
import {useFormik} from "formik";
import {useMutation} from "react-query";

export default function ReplyCommentLikeButton(props) {
    const Count = parseInt(props.post.user_post_comment_reply_likes.length)
    const formik = useFormik({
        initialValues: {userSlug: props.auth?.slug, count: Count, active: checkActive()},
        validationSchema: "",
        onSubmit: values => {
            changeLike.mutate();
        }
    });

    console.log(props.post.user_post_comment_reply_likes)

    function checkActive() {
        let liked = props.post.user_post_comment_reply_likes.filter((value) => {
            return value.user_id === props.auth?.id;
        });
        if (liked.length > 0) {
            return true;
        }
        return false;
    }

    const changeLike = useMutation(async (data) => {
        if (formik.values.active) {
            const response = await axios.delete(route('api.public.UserPostCommentReplyUnLike', {
                user: props.auth.slug,
                post: props.postid,
                comment: props.post.user_post_comment_id,
                reply: props.post.id
            }));
            return response.data;
        } else {
            const response = await axios.post(route('api.public.UserPostCommentReplyLike', {
                user: props.auth.slug,
                post: props.postid,
                comment: props.post.user_post_comment_id,
                reply: props.post.id
            }));
            return response.data;
        }
    }, {
        onSuccess: (res) => {
            formik.values.active = !formik.values.active;
            formik.values.count = formik.values.active ? formik.values.count + 1 : formik.values.count - 1;
        }, onError: () => {
        }, onSettled: () => {
        }, retry: 2
    });

    return (
        <>
            {(props.auth) ? ((formik.values.active) ? (
                    <form onSubmit={formik.handleSubmit}>
                        <button className="bg-transparent border-0" type="submit">
                            <i className="text-align-center me-2 text-orange fa-solid fa-thumbs-up"></i>
                            <p className="d-inline mb-0 text-orange align-self-center fs-1">{formik.values.count}</p>
                        </button>
                    </form>
                ) :
                (
                    <form onSubmit={formik.handleSubmit}>
                        <button className="bg-transparent border-0" type="submit">
                            <i className="text-align-center me-2 text-dark-gray fa-solid fa-thumbs-up"></i>
                            <p className="d-inline text-dark mb-0 align-self-center fs-1">{formik.values.count}</p>
                        </button>
                    </form>
                )) : <a href="#" className="text-decoration-none text-secondary">
                <i className="text-align-center me-2 text-dark-gray fa-solid fa-thumbs-up"></i>
                <p className="d-inline text-dark mb-0 align-self-center fs-1">{formik.values.count} </p></a>
            }

        </>
    )
}
