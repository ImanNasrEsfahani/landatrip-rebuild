import React from 'react';
import axios from "../../axiosConfig";
import {useMutation} from "react-query";
import {route} from '../../helpers'
import {useFormik} from "formik";

export default function Like(props) {
   const { auth, likes, postid, count , userId } = props;

    const formik = useFormik({
        initialValues: {userSlug: auth?.slug, count: count, active: checkActive()},
        validationSchema: "",
        onSubmit: values => {
            changeLike.mutate();
        }
    });
    function checkActive() {
        let liked = likes.filter((value) => {
            return value === auth?.id;
        });
        if (liked.length > 0) {
            return true;
        }
        return false;
    }

    console.log(checkActive(),postid)
    const changeLike = useMutation(async (data) => {
        if (formik.values.active) {
            const response = await axios.delete(route('api.public.UserPostUnLike', {
                user: props.auth.slug,
                post: props.postid
            }));
            return response.data;
        } else {
            const response = await axios.post(route('api.public.UserPostLike', {
                user: props.auth.slug,
                post: props.postid
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
            {(auth) ? ((formik.values.active===true) ? (
                        <form onSubmit={formik.handleSubmit}>
                            <button className="bg-transparent border-0" type="submit">
                                <i className="text-align-center me-2 text-orange fa-solid fa-thumbs-up"></i>
                                <p className="d-inline mb-0 text-orange align-self-center">{formik.values.count} Liked</p>
                            </button>
                        </form>
                    ) :
                    <form onSubmit={formik.handleSubmit}>
                        <button className="bg-transparent border-0" type="submit">
                            <i className="text-align-center me-2 text-dark-gray fa-solid fa-thumbs-up"></i>
                            <p className="d-inline text-dark mb-0 align-self-center">{formik.values.count} Like</p>
                        </button>
                    </form>) :
                <a href="#" className="text-decoration-none text-secondary">
                    <i className="text-align-center ms-2 me-2 text-dark-gray fa-solid fa-thumbs-up"></i><p
                    className="d-inline text-dark mb-0 align-self-center">{formik.values.count} </p></a>
            }
        </>
    )
}
