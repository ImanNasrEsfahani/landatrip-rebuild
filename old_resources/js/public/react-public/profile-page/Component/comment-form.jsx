import React, {useEffect} from "react";
import {useFormik} from "formik";
import * as yup from "yup";
import {useMutation} from "react-query";
import axios from "../../axiosConfig";
import {route} from "../../helpers";
import {Mention, MentionsInput} from "react-mentions";
import '../../scss/header.scss'
import {useSelector} from "react-redux";

export default function CommentForm(props) {
    const data = useSelector(state => state.info);

    const formik = useFormik({
        initialValues: {comment: data.mention},
        validationSchema: yup.object().shape({
            comment: yup.string().required().min(2).max(150),
        }),
        onSubmit: values => {
            postComment.mutate({
                comment : formik.values.comment
            });
        }
    });
    const postComment = useMutation(async (data) => {
        const response = await axios.post(route("api.public.userPostComment",{user:props.auth.slug,post:props.post.id}), data);
        return response.data;
    }, {
        onSuccess: data => {
            // contactDetail.refetch();
            formik.resetForm();
        }, onError: () => {
        }, onSettled: () => {
        }
    });

    useEffect(() => {
        formik.setValues({ comment: data.mention });
    }, [data.mention]);

    const users = [
        {
            id:"sobhan",
            display:"Sobhan"
        },
        {
            id:"iman",
            display:"Iman"
        },
        {
            id:"amin",
            display:"Amin"
        }
    ]
    return (
        <>
            {(props.auth) ? (<div className="d-flex flex-row">
                {(props.auth.profile_image) ?
                    (<img className="max-h-3rem ms-2 me-4 rounded-circle"
                          src={import.meta.env.VITE_ASSET_URL + '/public/users/profile/' + props.auth.profile_image.url}/>)
                    : (<img className="max-h-3rem ms-2 me-4 rounded-circle"
                            src={import.meta.env.VITE_ASSET_URL + '/public/users/profile/' + props.auth.sex === 2 ? 'female.png' : 'male.png'}/>)}
                <form className="d-flex flex-grow-1 h-fit align-self-center" onSubmit={formik.handleSubmit}>
                    {/*<input className="bg-gray text-dark rounded-5 px-4 py-2 w-100 border-0" type="text" name="comment"*/}
                    {/*       placeholder="what do you want to talk about" value={formik.values.comment} onChange={formik.handleChange}/>*/}
                    <div className="w-100">
                        <MentionsInput className="bg-gray text-dark rounded-5 px-4 py-2 w-100 border-0" name="comment" value={formik.values.comment} onChange={(e) => formik.setFieldValue('comment', e.target.value)}>
                            <Mention data={users} onInput={(e) => formik.setFieldValue('comment', e.target.value)}/>
                        </MentionsInput>
                    </div>
                    <button type="submit" className="bg-transparent border-0">
                    <span className="fa-stack fa-1x text-orange fs-4">
                      <i className="fa-solid fa-circle fa-stack-2x"></i>
                      <i className="fa-solid fa-paper-plane-top fa-stack-1x fa-inverse ps-1"></i>
                    </span>
                    </button>
                </form>

                {/*<div className="alert alert-danger mt-3 rounded-4">*/}
                {/*    <ul className="mb-0"></ul>*/}
                {/*</div>*/}
            </div>) : (
                <div className="d-flex flex-row mt-3 mb-2">
                    <i className="fa-solid fa-circle h-100 fs-9 text-gray me-2"></i>
                    <input className="bg-gray text-dark rounded-5 px-4 py-2 w-100 border-0 disabled" type="text"
                           disabled/>
                    {/*<a className="btn btn-orange text-white align-self-center rounded-pill ms-2">Login</a>*/}
                </div>
            )}
        </>
    )
}
