import {useFormik} from "formik";
import {useMutation} from "react-query";
import axios from "../axiosConfig";
import {route} from "../helpers";
import * as yup from "yup";
import Picker from "@emoji-mart/react";


function GroupNewPost(props) {
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
    const SUPPORTED_FORMATS = [
        "image/jpg",
        "image/jpeg",
        "image/gif",
        "image/png",
        "application/pdf",
        "application/vnd.ms-excel",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "video/mp4",
        "video/mpeg",
        "video/quicktime",
        "video/x-msvideo",
        "video/x-ms-wmv",
        "video/mkv"
    ];
    const validationSchema = yup.object({
        message: yup.string().required("message is required").min(3).max(250),
        // image: yup.mixed().test("fileSize", "The file is too large", (value) => {
        //         return value && value.size <= 5000000
        //     }).test(
        //         'is-big-file',
        //         'VALIDATION_FIELD_FILE_WRONG_TYPE',
        //         value => value && SUPPORTED_FORMATS.includes(value.type)
        //     )
    })
    const formik = useFormik({
        initialValues,
        validationSchema,
        onSubmit: values => {
            mutation.mutate(
                {message: formik.values.message},
                formik.resetForm()
            );
        }
    })
    const mutation = useMutation(async (data) => {
        const response = await axios.post(route("api.public.group-posts.store", {group: props.group}), data)
        return response.data;
    }, {
        onSuccess: () => {
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

    return (
        <form className="d-flex flex-column  h-fit align-self-center" onSubmit={formik.handleSubmit}>
            <div className="w-100 d-flex flex-column flex-lg-row ">
                <button className="border-0 p-0 bg-transparent me-3" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    <i className="fa-solid fa-face-awesome fs-5 text-orange"></i></button>
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
                <div className="d-flex flex-row mt-2 mt-lg-0 justify-content-end">
                    <label htmlFor="image" className="align-self-center px-2">
                        <i className="fa-solid fa-cloud-arrow-up text-secondary fs-8"></i>
                    </label>
                    <input className="d-none" name="image" id="image" type="file"
                           accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.xls,./xlsx"/>

                </div>
            </div>
        </form>
    )
}

export default GroupNewPost;
