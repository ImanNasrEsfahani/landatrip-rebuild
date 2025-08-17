import React from 'react';
import axios from "../../axiosConfig"
import {route} from '../../helpers'
import {useFormik} from "formik";
import {useMutation} from "react-query";

export default function CommentLikeButton (props) {
    const formik = useFormik({
        initialValues: {userSlug: props.auth?.slug, count: props.likes.length, active: checkActive()},
        comment: props.likes.user_post_comment_id,
        validationSchema: "",
        onSubmit: values => {
            changeLike.mutate();
        }
    });

    function checkActive() {
        let liked = props.likes.filter((value) => {
            return value.user_id === props.auth?.id;
        });
        if (liked.length > 0) {
            return true;
        }
        return false;
    }

    const changeLike = useMutation(async (data) => {
        if (formik.values.active) {
            const response = await axios.delete(route('api.public.UserPostCommentUnLike', {
                user: props.auth.slug,
                post: props.postid,
                comment: props.post.id
            }));
            return response.data;
        } else {
            const response = await axios.post(route('api.public.UserPostCommentLike', {
                user: props.auth.slug,
                post: props.postid,
                comment: props.post.id
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
                            <button className="bg-transparent border-0">
                                <i className="text-align-center me-2 text-orange fa-solid fa-thumbs-up"></i>
                                <p className="d-inline mb-0 text-orange align-self-center">{formik.values.count}</p>
                            </button>
                        </form>
                    ) :
                    (
                        <form onSubmit={formik.handleSubmit}>
                            <button className="bg-transparent border-0">
                                <i className="text-align-center me-2 text-dark-gray fa-solid fa-thumbs-up"></i>
                                <p className="d-inline text-dark mb-0 align-self-center">{formik.values.count}</p>
                            </button>
                        </form>
                    )) :
                <a href="#" className="text-decoration-none text-secondary">
                    <i className="text-align-center me-2 text-dark-gray fa-solid fa-thumbs-up"></i>
                    <p className="d-inline text-dark mb-0 align-self-center">{formik.values.count} </p></a>
            }

        </>
    )
}
