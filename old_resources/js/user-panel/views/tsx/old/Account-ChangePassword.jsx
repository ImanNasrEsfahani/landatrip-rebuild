import React from "react";
import "../scss/Account-ChangePassword.scss";
import axios from '../../../../axiosConfig';
import {useMutation, useQuery, useQueryClient} from "react-query";
import {useFormik} from "formik";
import * as yup from "yup";
import {toast} from "react-toastify";
import {route} from "../../../helpers";


export default function AccountChangePassword() {

    // Access the client
    const queryClient = useQueryClient();
    let initialValue = {
        old_password : "", password : "", password_confirmation : ""
    };

    const formik = useFormik({
        initialValues : initialValue,
        validationSchema : yup.object().shape({
            old_password : yup.string().required("Please Enter your old password"),
            password : yup.string().required("Please Enter your new password").matches(
                /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/,
                "Must Contain 8 Characters, One Uppercase, One Lowercase, One Number and one special case Character"
            ),
            password_confirmation : yup.string().required("Please Repeat your new password").oneOf([yup.ref("password"), null], "Passwords must match")
        }),
        onSubmit : values =>
        {
            postChangePassword.mutate({

                old_password : formik.values.old_password,
                password : formik.values.password,
                password_confirmation : formik.values.password_confirmation
            });
        }
    });

    // Create a new record
    const postChangePassword = useMutation(async (data) =>
    {
        toastId.current = toast.loading("Posting...", {
            closeButton : true, theme : "colored", type : toast.TYPE.INFO
        });
        const response = await axios.put(route('api.web.v1.teacher-panel.account-info.change-password'), data);
        return response.data;
    }, {
        onSuccess : data =>
        {
            toast.update(toastId.current, {
                render : "It has saved",
                theme : "colored",
                type : toast.TYPE.SUCCESS,
                autoClose : 6000,
                closeButton : true,
                isLoading : false,
                draggable : true,
                draggablePercent : 60
            });

            formik.resetForm();
        }, onError : () =>
        {
            toast.update(toastId.current, {
                render : "It has a problem on editing",
                theme : "colored",
                type : toast.TYPE.ERROR,
                autoClose : 6000,
                closeButton : true,
                isLoading : false,
                draggable : true,
                draggablePercent : 60
            });
        }, onSettled : () =>
        {
        }
    });

    const toastId = React.useRef(null);

    return (
        <>
        <div className="bg-white w-100 h-auto p-3 rounded-4">
            <h4 ><b>Change Password</b></h4>
            <hr/>
            <form onSubmit={ formik.handleSubmit }>
                <div className="row">
                    <div className="col-24 col-md-12 col-lg-8 mb-4">
                        <label className="mb-2 w-100">
                            <b>Old Password<span className="text-orange ms-1">*</span></b>
                            <input id="old_password" className="form-control" type="password" name="old_password" placeholder="Enter your first name" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.old_password }/>
                            { formik.touched.old_password && formik.errors.old_password ? (
                                <div className="alert alert-warning mt-1" role="alert">{ formik.errors.old_password }</div>
                            ) : null }
                        </label>
                    </div>

                    <div className="col-24 col-md-12 col-lg-8 mb-4">
                        <label className="mb-2 w-100">
                            <b>New Password<span className="text-orange ms-1">*</span></b>
                            <input id="password" className="form-control" type="password" name="password" placeholder="Enter your first name" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.password }/>
                            { formik.touched.password && formik.errors.password ? (
                                <div className="alert alert-warning mt-1" role="alert">{ formik.errors.password }</div>
                            ) : null }
                        </label>
                    </div>
                    <div className="col-24 col-md-12 col-lg-8 mb-4">
                        <label className="mb-2 w-100">
                            <b>Repeat New Password<span className="text-orange ms-1">*</span></b>
                            <input id="password_confirmation" className="form-control" type="password" name="password_confirmation" placeholder="Enter your first name" onChange={ formik.handleChange } onBlur={ formik.handleBlur } value={ formik.values.password_confirmation }/>
                            { formik.touched.password_confirmation && formik.errors.password_confirmation ? (
                                <div className="alert alert-warning mt-1" role="alert">{ formik.errors.password_confirmation }</div>
                            ) : null }
                        </label>
                    </div>
                    <div className="d-flex flex-row justify-content-end">
                        <input type="submit" value={ formik.isValid ? "Submit" : "Fill information" } className="btn btn-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24" disabled={ !(formik.isValid && formik.dirty) }/>
                    </div>
                </div>
            </form>
        </div>
    </>
    );
};
