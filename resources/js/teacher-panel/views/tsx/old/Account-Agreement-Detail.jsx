import React from "react";
import { useParams, useNavigate } from "react-router-dom";
import "../scss/Account-Agreement-Detail.scss";
import { useMutation, useQuery, useQueryClient } from "react-query";
import axios from '../../../../axiosConfig';
import { useFormik } from "formik";
import * as yup from "yup";
import { toast } from "react-toastify";
import Error from "../../../../Error";

export default function AccountAgreementDetail()
{
    const params = useParams();
    const navigate = useNavigate();
    const queryClient = useQueryClient();


    // Queries to get all records
    const accountAgreementRecord = useQuery('agreementDetail', async () =>
    {
        const {data} = await axios.get(`account/contact-info/agreement/${ params.id }`);
        accountAgreementRecord.data = data.data;
        await formik.setFieldValue("acceptance_1", data.data.acceptance_1);
        await formik.setFieldValue("acceptance_2", data.data.acceptance_2);
        return accountAgreementRecord;
    });

    let initialValue = {
        acceptance_1 : false, acceptance_2 : false
    };

    const formik = useFormik({
        initialValues : initialValue,
        validationSchema : yup.object().shape({
            acceptance_1 : yup.boolean().oneOf([true], 'Accept Terms & Conditions is required'),
            acceptance_2 : yup.boolean().oneOf([true], 'Accept Terms & Conditions is required')
        }),
        onSubmit : values =>
        {
            postAgreementAcceptance.mutate({
                id : params.id,
                acceptance_1 : formik.values.acceptance_1,
                acceptance_2 : formik.values.acceptance_2
            });
        }
    });

    // Create a new record
    const postAgreementAcceptance = useMutation(async (data) =>
    {
        toastId.current = toast.loading("Posting...", {
            closeButton : true, theme : "colored", type : toast.TYPE.INFO
        });
        const response = await axios.post(`http://landatrip.test/api/teacher-panel/account/contact-info/agreement/${ params.id }`, data);
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
            accountAgreementRecord.refetch();
            formik.resetForm();
            setTimeout(() => navigate('/panel/account-info/agreement', { replace: true }), 2000)
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

    if (accountAgreementRecord.isLoading)
    {
        return <h2>Loading...</h2>;
    }

    // Show Error message in query of all record on mounting
    if (accountAgreementRecord.isError)
    {
        return <Error message={accountAgreementRecord.error.message} />;
    }

    return (<>
            <div className="bg-white w-100 h-auto p-3 rounded-4">
                <div className="row d-flex flex-row justify-content-around">
                  <div className="row">
                    <h4 className="mt-2">{ accountAgreementRecord.data.data.title }</h4>
                    <hr/>
                    <div className="bg-light-gray w-100 max-vh-80 p-4 rounded-3 lh-base fs-3 overflow-auto mb-6" dangerouslySetInnerHTML={ {__html : accountAgreementRecord.data.data.text} }></div>

                    <form className="mt-5" onSubmit={ formik.handleSubmit }>
                        <div className="form-group w-100 w-lg-75 mb-4">
                            <div className="form-check mb-3">
                                <div className="w-100 d-flex flex-row">
                                    <input className="form-checkbox big-checkbox align-self-center" type="checkbox" name="acceptance_1" id="acceptance_1" value={ accountAgreementRecord.data.data.acceptance_1 ? "true" : "false"} onChange={ formik.handleChange } onBlur={ formik.handleBlur } checked={ formik.values.acceptance_1 } disabled={ accountAgreementRecord.data.data.acceptance_1 }/>
                                    <label className="form-check fs-3 ms-3 lh-base" htmlFor="acceptance_1">I agreed to this contract and understand that we'll send account notices to the verified email address you provided</label>
                                </div>
                                { formik.touched.acceptance_1 && formik.errors.acceptance_1 ? (
                                    <div className="d-flex alert alert-warning mt-3" role="alert">{ formik.errors.acceptance_1 }</div>
                                ) : null }
                            </div>

                            <div className="form-check mb-5">
                                <div className="w-100 d-flex flex-row">
                                    <input className="form-checkbox big-checkbox align-self-center" type="checkbox" name="acceptance_2" id="acceptance_2" value={ accountAgreementRecord.data.data.acceptance_2 ? "true" : "false"} onChange={ formik.handleChange } onBlur={ formik.handleBlur } checked={ formik.values.acceptance_2 } disabled={ accountAgreementRecord.data.data.acceptance_2 }/>
                                    <label className="form-check fs-3 ms-3 lh-base" htmlFor="acceptance_2">I have read and agree to follow the articles and privacy and policy of this contract</label>
                                </div>
                                { formik.touched.acceptance_2 && formik.errors.acceptance_2 ? (
                                    <div className="d-flex alert alert-warning mt-3" role="alert">{ formik.errors.acceptance_2 }</div>
                                ) : null }
                            </div>
                        </div>

                        <div className="form-group w-100 text-center text-lg-end my-4">
                            <input className="btn btn-orange text-white py-2 px-12 rounded-pill fs-2" type="submit" value={ accountAgreementRecord.data.data.acceptance_1 && accountAgreementRecord.data.data.acceptance_2 ? "You have already agreed" : "Submit"} disabled={ accountAgreementRecord.data.data.acceptance_1 && accountAgreementRecord.data.data.acceptance_2 }/>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </>);
};
