import React from 'react';
import axios from "../../axiosConfig"
import {route} from '../../helpers'
import {useFormik} from "formik";
import {useMutation} from "react-query";

export default function Follow (props) {
    const user = props.user
    console.log(props)
    //Follow Button Formik
    const formik = useFormik({
        initialValues: { userSlug : user.slug ,follow:props.follow }, validationSchema: "", onSubmit: values => {
            follow.mutate();
        }
    });
    //UnFollow Button Formik
    const formikUN = useFormik({
        initialValues: { userSlug : user.slug ,follow:props.follow }, validationSchema: "", onSubmit: values => {
            unfollow.mutate();
        }
    });
    //Follow Button reactQuery
    const follow = useMutation(async (data) => {
        const response = await axios.post(route('api.public.UserFollow', {user: user.slug}));
        return response.data;
    }, {
        onSuccess: (res) => {
            formik.setFieldValue("follow", "true");
        }, onError: () => {
        }, onSettled: () => {
        },retry : 2
    });
    //UnFollow Button reactQuery
    const unfollow = useMutation(async (data) => {
        const response = await axios.delete(route('api.public.UserUnfollow', {user: user.slug}));
        return response.data;
    }, {
        onSuccess: (res) => {
            formik.setFieldValue("follow", "false");
        }, onError: () => {

        }, onSettled: () => {
        },retry : 2
    });
    return(
        <>
            {formik.values.follow === "true" ? (
                <form className="d-inline-block w-100 w-md-auto mt-2 mt-md-0" onSubmit={formikUN.handleSubmit}>
                    <input className="btn btn-green w-75 text-white px-4 py-1 mx-3 rounded-pill" type="submit" value="UnFollow"/>
                </form>
            ) :
            (
                <form className="d-inline-block w-100 w-md-auto mt-2 mt-md-0"  onSubmit={formik.handleSubmit}>
                    <input className="btn btn-orange w-75 text-white px-4 py-1 mx-3 rounded-pill" type="submit" value="Follow"/>
                </form>
            )}
        </>
    )
}
