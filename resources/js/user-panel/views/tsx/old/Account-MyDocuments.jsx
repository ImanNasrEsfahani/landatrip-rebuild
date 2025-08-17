import React, {useRef, useState} from "react";
import {useMutation, useQuery, useQueryClient} from "react-query";
import axios from '../../../../axiosConfig';
import {toast} from "react-toastify";
import * as yup from 'yup';
import {useFormik} from "formik";
import Error from "../../../../Error";

// Import React FilePond
import {FilePond, registerPlugin} from 'react-filepond';

// Import FilePond styles
import 'filepond/dist/filepond.min.css';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import {route} from "../../../helpers";
import {useTranslation} from "react-i18next";
import {SkeletonFramework, SkeletonTableAccountDocuments} from "../../../../SkeletonFramework";

registerPlugin(FilePondPluginImageExifOrientation, FilePondPluginImagePreview);

export default function AccountDocuments() {

    const {t} = useTranslation();

    const [files, setFiles] = useState([]);
    const queryClient = useQueryClient();

    function onUpload(fieldName, file, metadata, load, error, progress, abort, transfer, options) {
        // set data
        const formData = new FormData();
        formData.append('file', file, file.name);

        // related to aborting the request
        const CancelToken = axios.CancelToken;
        const source = CancelToken.source();

        // the request itself
        axios({
            method: 'post',
            data: formData,
            cancelToken: source.token,
            onUploadProgress: (e) => {
                progress(e.lengthComputable, e.loaded, e.total);
            }
        }).then(response => {
            load(response.data);
            formik.values.file = response.data;
        }).catch((thrown) => {
            if (axios.isCancel(thrown)) {
                console.log('Request canceled', thrown.message);
            } else {
                // handle error
            }
        });

        // Setup abort interface
        return {
            abort: () => {
                source.cancel('Operation canceled by the user.');
            }
        };

    }

    function onRevert() {
        formik.values.file = "";
    }


    function titleChange(e) {
        formik.values.title = e.target.value;
    }

    // Queries to get all records
    const myDocumentsRecords = useQuery('myDocuments', async () => {
        const {data} = await axios.get(route("api.web.v1.teacher-panel.account-info.documents.index"));
        myDocumentsRecords.data = data.data;
        return myDocumentsRecords;
    });

    let initialValue = {file: "", title: ""};

    const toastId = useRef(null);

    const formik = useFormik({
        initialValues: initialValue,
        validationSchema: yup.object().shape({
            title: yup.string().required("Document name is a required field").min(3).max(150),
            file: yup.string().required("Uploading File is required")
        }), onSubmit: values => {
            postMyDocumentsRecords.mutate({
                title: formik.values.title,
                file: formik.values.file
            });
        }
    });

    const postMyDocumentsRecords = useMutation(async (data) => {
        toastId.current = toast.loading("Posting...", {
            closeButton: true, theme: "colored", type: toast.TYPE.INFO
        });
        const response = await axios.post(route("api.web.v1.teacher-panel.account-info.documents.store"), data);
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
            formik.resetForm();
            formik.setValues({title: "", file: ""});
            myDocumentsRecords.refetch();
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

    const deleteMyDocumentsRecord = useMutation((id) => {
        toastId.current = toast.loading("Deleting...", {
            // autoClose: 5000,
            // progress: 100,
            closeButton: true, theme: "colored", type: toast.TYPE.WARNING
        });
        return axios.delete(route("api.web.v1.teacher-panel.account-info.documents.destroy", {"document": id}));
    }, {
        onSuccess: data => {
            toast.update(toastId.current, {
                render: "It has been deleted",
                theme: "colored",
                type: toast.TYPE.SUCCESS,
                autoClose: 6000,
                closeButton: true,
                isLoading: false,
                draggable: true,
                draggablePercent: 60
            });
            myDocumentsRecords.refetch();
            formik.resetForm();
        }, onError: () => {
            toast.update(toastId.current, {
                render: "It has a problem on deleting",
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

    const renderStatus = (param) => {
        switch (param) {
            case 'Rejected':
                return <h6
                    className="w-95 fs-2 mb-0 badge bg-danger rounded-pill px-3 py-2 fw-normal">{t("Rejected")}</h6>;
            case 'Pending':
                return <h6
                    className="w-95 fs-2 mb-0 badge bg-info rounded-pill px-3 py-2 fw-normal">{t("Pending")}</h6>;
            default:
                return <h6
                    className="w-95 fs-2 mb-0 badge bg-green rounded-pill px-3 py-2 fw-normal">{t("Verified")}</h6>;
        }
    };

    // Show Error message in query of all record on mounting
    if (myDocumentsRecords.isError) {
        return <Error message={myDocumentsRecords.error.message} />;
    }

    return (
        <>
            <div className="bg-white w-100 h-auto p-5 rounded-4">
                <div className="row d-flex flex-row justify-content-around">
                    <div className="row">
                        <h5>{t("My Documents")}</h5>
                        <hr/>
                        <div className="overflow-auto">
                            <table className="table table-striped table-hover text-center">
                                <thead>
                                <tr>
                                    <th>{t("Document Name")}</th>
                                    <th>{t("Type")}</th>
                                    <th>{t("Date")}</th>
                                    <th style={{width: "15%"}}>{t("STATUS")}</th>
                                    <th>{t("Remove")}</th>
                                </tr>
                                </thead>
                                <tbody>
                                {
                                    myDocumentsRecords.isLoading ? (
                                        <SkeletonTableAccountDocuments/>
                                    ) : (
                                        (myDocumentsRecords.data.data.length > 0 ?
                                                myDocumentsRecords.data.data.map((value, key) => (
                                                    <tr key={key}>
                                                        <td className="align-middle">{value.title}</td>
                                                        <td className="align-middle">{value.type}</td>
                                                        <td className="align-middle">{value.created_at}</td>
                                                        <td className="align-middle">{renderStatus(value.status)}</td>
                                                        <td className="align-middle">
                                                            <button className="border-0 bg-transparent"
                                                                    onClick={() => deleteMyDocumentsRecord.mutate(
                                                                        value.id)}><i
                                                                className="fs-3 ms-3 text-danger fa-solid fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                )) :
                                                <tr>
                                                    <td colSpan="5" className="text-danger">{t("No Data")}</td>
                                                </tr>
                                        ))
                                }
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div className="row w-95 mx-auto mt-10">
                        <h5>{t("Insert New")}</h5>
                        <hr/>
                        <form className="m-0 mt-5 p-0" onSubmit={formik.handleSubmit} encType="multipart/form-data">
                            <div className="row">
                                <div className="col-24 col-md-12 col-lg-8 mb-4">
                                    <label className="mb-2 w-100">
                                        <b>{t("Document Name")}<span className="text-orange ms-1">*</span></b>
                                        <input id="text" className="form-control w-100 mt-2" type="text" name="title"
                                               onChange={e => titleChange(e)} onBlur={e => titleChange(e)}
                                               placeholder={t("Document Name")}/>
                                    </label>
                                    {formik.touched.title && formik.errors.title ? (<div className="alert alert-warning"
                                                                                         role="alert">{formik.errors.title}</div>) : null}
                                </div>
                                <input type="hidden" className="form-control w-100 mt-2" name="file"/>
                                <div className="col-24 col-md-12 col-lg-8 mb-4">
                                    <FilePond files={files} allowMultiple={true} maxFiles={3} server={{
                                        fetch: null,
                                        process: onUpload,
                                        load: null,
                                        revert: onRevert,
                                        restore: null
                                    }} name="files"
                                              labelIdle='Drag & Drop your files or <span className="filepond--label-action">Browse</span>'/>

                                    {formik.touched.file && formik.errors.file ? (<div className="alert alert-warning"
                                                                                       role="alert">{formik.errors.file}</div>) : null}
                                </div>
                            </div>

                            <div className="d-flex flex-row justify-content-end">
                                {
                                    myDocumentsRecords.isLoading ? (
                                        <SkeletonFramework height={40} width={250}
                                                           className="btn bg-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24"/>
                                    ) : (
                                        <input value={t("Submit")} type="submit"
                                               className="btn btn-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24"/>
                                    )
                                }

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </>
    );
}

