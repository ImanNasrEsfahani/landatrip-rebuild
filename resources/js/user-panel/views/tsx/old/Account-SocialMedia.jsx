import React from "react";
import "../scss/Account-SocialMedia.scss";
import {useMutation, useQuery, useQueryClient} from "react-query";
import axios from '../../../../axiosConfig';
import {useFormik} from "formik";
import * as yup from "yup";
import {toast} from "react-toastify";
import {route} from "../../../helpers";
import {useTranslation} from "react-i18next";
import {SkeletonFramework} from "../../../../SkeletonFramework";
import Error from "../../../../Error";


export default function AccountSocialMedia() {

    const {t} = useTranslation();

    // Access the client
    const queryClient = useQueryClient();

    // Queries to get all records
    const socialMediaDetail = useQuery('contactDetail', async () => {
        const {data} = await axios.get(route("api.web.v1.teacher-panel.account-info.social-media.index"));
        socialMediaDetail.data = data.data;
        await formik.setFieldValue("facebook", data.data.facebook);
        await formik.setFieldValue("instagram", data.data.instagram);
        await formik.setFieldValue("linkedin", data.data.linkedin);
        await formik.setFieldValue("twitter", data.data.twitter);
        console.log(socialMediaDetail.data)
        return socialMediaDetail;
    });

    let initialValue = {
        facebook: "", instagram: "", linkedin: "", twitter: ""
    };

    const formik = useFormik({
        initialValues: initialValue,
        validationSchema: yup.object().shape({
            facebook: yup.string().nullable().min(3).max(150),
            instagram: yup.string().nullable().min(3).max(150),
            linkedin: yup.string().nullable().min(3).max(150),
            twitter: yup.string().nullable().min(3).max(150)
        }),
        onSubmit: values => {
            postSocialMediaDetail.mutate({
                id: formik.values.id,
                facebook: formik.values.facebook,
                instagram: formik.values.instagram,
                linkedin: formik.values.linkedin,
                twitter: formik.values.twitter
            });
        }
    });

    // Create a new record
    const postSocialMediaDetail = useMutation(async (data) => {
        toastId.current = toast.loading("Posting...", {
            closeButton: true, theme: "colored", type: toast.TYPE.INFO
        });
        const response = await axios.put(route("api.account-info.social-media.update"), data);
        return response.data;
    }, {
        onSuccess: data => {
            toast.update(toastId.current, {
                render: "It has saved",
                theme: "colored",
                type: toast.TYPE.SUCCESS,
                autoClose: 6000,
                closeButton: true,
                isLoading: false,
                draggable: true,
                draggablePercent: 60
            });
            socialMediaDetail.refetch();
            formik.resetForm();
        }, onError: () => {
            toast.update(toastId.current, {
                render: "It has a problem on editing",
                theme: "colored",
                type: toast.TYPE.ERROR,
                autoClose: 6000,
                closeButton: true,
                isLoading: false,
                draggable: true,
                draggablePercent: 60
            });
        }, onSettled: () => {
        }
    });

    const toastId = React.useRef(null);

    // Show Error message in query of all record on mounting
    if (socialMediaDetail.isError) {
        return <Error message={socialMediaDetail.error.message} />;
    }


    return (
        <>
            <div className="bg-white w-100 h-auto p-3 rounded-4">
                <div className="row d-flex flex-row justify-content-around">
                    <div className="row bs-dark-text">
                        <h4>
                            <b>{t("Social Media")}</b>
                        </h4>
                        <hr/>
                        <form onSubmit={formik.handleSubmit}>
                            <div className="row">
                                <div className="col-24 col-md-12 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("Facebook")}</b>
                                        {
                                            socialMediaDetail.isLoading ? (
                                                <SkeletonFramework height={40}/>
                                            ) : (
                                                <input id="facebook" className="form-control" type="text"
                                                       name="facebook"
                                                       placeholder={t("Enter your Facebook account address")}
                                                       onChange={formik.handleChange} onBlur={formik.handleBlur}
                                                       value={formik.values.facebook}
                                                       defaultValue={socialMediaDetail.data.facebook}/>
                                            )
                                        }
                                    </label>
                                    {formik.touched.facebook && formik.errors.facebook ? (
                                        <div className="alert alert-warning" role="alert">{formik.errors.facebook}</div>
                                    ) : null}
                                </div>
                                <div className="col-24 col-md-12 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("Instagram")}</b>
                                        {
                                            socialMediaDetail.isLoading ? (
                                                <SkeletonFramework height={40}/>
                                            ) : (
                                                <input id="instagram" className="form-control" type="text"
                                                       name="instagram"
                                                       placeholder={t("Enter your Instagram account address")}
                                                       onChange={formik.handleChange} onBlur={formik.handleBlur}
                                                       value={formik.values.instagram}
                                                       defaultValue={socialMediaDetail.data.instagram}/>
                                            )
                                        }
                                    </label>
                                    {formik.touched.instagram && formik.errors.instagram ? (
                                        <div className="alert alert-warning"
                                             role="alert">{formik.errors.instagram}</div>
                                    ) : null}
                                </div>
                                <div className="col-24 col-md-12 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("linkedin")}</b>
                                        {
                                            socialMediaDetail.isLoading ? (
                                                <SkeletonFramework height={40}/>
                                            ) : (
                                                <input id="linkedin" className="form-control" type="text"
                                                       name="linkedin"
                                                       placeholder={t("Enter your linkedin account address")}
                                                       onChange={formik.handleChange} onBlur={formik.handleBlur}
                                                       value={formik.values.linkedin}
                                                       defaultValue={socialMediaDetail.data.linkedin}/>)
                                        }
                                    </label>
                                    {formik.touched.linkedin && formik.errors.linkedin ? (
                                        <div className="alert alert-warning" role="alert">{formik.errors.linkedin}</div>
                                    ) : null}
                                </div>
                                <div className="col-24 col-md-12 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("Twitter")}</b>
                                        {
                                            socialMediaDetail.isLoading ? (
                                                <SkeletonFramework height={40}/>
                                            ) : (
                                                <input id="twitter" className="form-control" type="text" name="twitter"
                                                       placeholder={t("Enter your Twitter account address")}
                                                       onChange={formik.handleChange} onBlur={formik.handleBlur}
                                                       value={formik.values.twitter}
                                                       defaultValue={socialMediaDetail.data.twitter}/>
                                            )
                                        }
                                    </label>
                                    {formik.touched.twitter && formik.errors.twitter ? (
                                        <div className="alert alert-warning" role="alert">{formik.errors.twitter}</div>
                                    ) : null}
                                </div>
                                <div className="d-flex flex-row justify-content-end">
                                    {
                                        socialMediaDetail.isLoading ? (
                                            <SkeletonFramework height={40} width={250}
                                                               className="btn text-white bg-orange p-2 mt-5 mb-3 rounded-pill col-md-6 col-24"/>
                                        ) : (
                                            <input type="submit"
                                                   value={formik.isValid ? t("Submit") : t("Fill information")}
                                                   className="btn btn-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24"
                                                   disabled={!(formik.isValid && formik.dirty)}/>
                                        )
                                    }
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </>
    );
};
