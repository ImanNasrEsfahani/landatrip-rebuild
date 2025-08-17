import {useFormik} from "formik";
import {useMutation} from "react-query";
import axios from "../axiosConfig";
import {route} from "../helpers";
import * as yup from "yup";
import Picker from "@emoji-mart/react";
import {FilePond} from "react-filepond";
import {useState} from "react";
import 'filepond/dist/filepond.css';
import './new.css'

function GroupNewPost(props) {

    const [previewUrl, setPreviewUrl] = useState('');
    const [files, setFiles] = useState([])
    const custom = [
        {
            searchPosition: 'none',
            previewPosition: 'none',
            showSearch: true,
        }]
    const initialValues = {
        message: "",
        image: ""
    }
    //display preview in another element
    const handleFileUpdate = (e) => {
        if (e.length > 0) {
            const file = e[0].file;
            const fileUrl = URL.createObjectURL(file);
            setPreviewUrl(fileUrl);
        } else {
            setPreviewUrl('');
        }
        setFiles(e);
    };
    //display remove button in another element
    const RemoveButton = () => {
        const handleRemove = () => {
            setFiles([]);
        };
        if (files.length > 0){
            return (
                <div>
                    <a href="#"><i className="fa-solid fa-circle-xmark" onClick={handleRemove}></i></a>
                </div>
            );
        }else {
            return null
        }
    }

    const validationSchema = yup.object({
        message: yup.string().required("message is required").min(3).max(250),
        image : yup.mixed()
    })
    const formik = useFormik({
        initialValues,
        validationSchema,
        onSubmit: values => {
            mutation.mutate(
                {
                    message: formik.values.message,
                    image : formik.values.image
                },
            );
        }
    })
    const mutation = useMutation(async (data) => {
        const response = await axios.post(route("api.public.group-posts.store", {group: props.group}), data)
        return response.data;
    }, {
        onSuccess: () => {
            formik.resetForm()
            setPreviewUrl("")
            setFiles([]);
        }, onError: () => {
        }, onSettled: () => {
        }, retry: 2
    })
    const addEmoji = (e) => {
        let sym = e.unified.split("-");
        let codesArray = [];
        sym.forEach((el) => codesArray.push("0x" + el));
        let emoji = String.fromCodePoint(...codesArray);
        formik.setFieldValue("message", formik.values.message + emoji + " ");
    };
    console.log(formik.values.image)
    return (
        <form className="d-flex flex-column  h-fit align-self-center" onSubmit={formik.handleSubmit}>
            <div>
                <RemoveButton/>
                <img src={previewUrl} className="w-20 rounded-5"/>
            </div>
            <div className="w-100 d-flex flex-column flex-lg-row ">
                <div>
                    <FilePond
                        className="file-pond-group"
                        files={files}
                        onupdatefiles={handleFileUpdate}
                        allowMultiple={false}
                        allowImagePreview={true}
                        maxFiles={1}
                        server={{
                            process: {
                                url: route("api.public.temporary-file.store"),
                                headers: {
                                    'X-CSRF-TOKEN': document.head
                                        .querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                },
                                method: 'POST',
                                timeout: 30 * 1000,
                                withCredentials: true,
                                onload: function (response) {
                                    console.log(response, "response from server");
                                    formik.setFieldValue("image", response);
                                }
                            },
                            remove: null,
                            restore: null,
                            revert: null
                        }
                        }
                        name="files"
                        labelIdle='<span class="filepond--label-action"><i class="fa-solid fa-up-from-bracket text-orange fs-5 mt-3 ms-md-4"></i></span>'
                    />
                </div>
                <button className="border-0 p-0 bg-transparent me-3" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    <i className="fa-solid fa-face-awesome fs-5 text-orange ms-md-8"></i></button>
                <div className="position-relative w-n-0rem h-4rem">
                    <div className="dropdown-menu p-0">
                        {<Picker onEmojiSelect={addEmoji} custom={custom}/>}
                    </div>
                </div>
                <div className="d-flex flex-row p-0 form-control w-100 rounded-pill">
                    <input
                        className="form-control ps-4 pe-1 flex-grow-1 lh-lg w-100 p-2 border-0 rounded-pill"
                        type="text" id="message"
                        placeholder="What do you want to talk about?"
                        onChange={formik.handleChange} value={formik.values.message}
                    />
                    <button className="border-0 bg-transparent pe-2">
                            <span className="fa-stack fa-1x text-secondary fs-4">
                              <i className="fa-solid fa-circle fa-stack-2x" type="submit"></i>
                              <i className="fa-solid fa-paper-plane-top fa-stack-1x fa-inverse ps-1"></i>
                            </span>
                    </button>
                </div>
            </div>
        </form>
    )
}

export default GroupNewPost;
