import React, {useState} from "react";
import {route} from "../../helpers";
import {FilePond} from "react-filepond";
import {useFormik} from "formik";
import {useMutation} from "react-query";
import {toast} from "react-toastify";
import axios from "../../axiosConfig";
import '../../group/new.css'

export default function NewPost(props){

    const auth = props.auth
    const user = props.user
    const toastId = React.useRef(null);
    const [files , setFiles] = useState([])
    const [previewUrl, setPreviewUrl] = useState('');

    const formik = useFormik({
        initialValues: {location : "" , title : "" ,image : ""}, validationSchema: "", onSubmit: values => {
            setFiles("")
            newPost.mutate({
                title:formik.values.title,
                location : formik.values.location,
                image : formik.values.image
            })
        }
    });
    const newPost = useMutation(async (data) => {
        toastId.current = toast.loading("newPost...", {
            closeButton: true, theme: "colored", type: toast.TYPE.INFO
        });
        const response = await axios.post(route("api.public.userNewPost",{user: auth.slug}), data);
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
        }
    };
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

    return(
        <>
            {(props.auth)?(
                auth.id===user.id ?
                <div className="bg-white rounded-4 shadow p-3 mb-4">
                    <div className="d-flex flex-row">
                        {(auth.profile_image) ? (<img className="mt-auto max-w-3rem ms-2 me-4 rounded-circle" src={import.meta.env.VITE_ASSET_URL + '/public/users/profile/' + auth.profile_image.url}/>)
                         : (<img className="mt-auto max-w-3rem ms-2 me-4 rounded-circle" src={import.meta.env.VITE_ASSET_URL + '/public/users/profile/' + auth.sex===0 ? 'female.png' : 'male.png'}/>)}

                        <form className="d-flex flex-column flex-grow-1 h-fit align-self-center" onSubmit={formik.handleSubmit}>
                           <div className="w-100 d-flex flex-column flex-lg-row">
                               <input className="bg-gray rounded-pill text-dark px-4 py-2 mb-2 w-100 w-lg-50 form-control col-14" onChange={formik.handleChange}
                                      type="text" name="location" id="location" placeholder="where is it ?" value={formik.values.location}/>
                               <div className="col-10 d-flex justify-content-end">
                                   <RemoveButton/>
                                   <img src={previewUrl} className="w-30 rounded-5"/>
                               </div>
                           </div>
                            <div className="w-100 d-flex flex-column flex-lg-row ">
                                <input
                                    className="bg-gray rounded-pill text-dark px-4 py-2 w-100 form-control form-control-sm border-0 me-lg-10 c" onChange={formik.handleChange}
                                    type="text" name="title" id="title" placeholder="What do you want to talk about ?" value={formik.values.title}/>

                                <div className="d-flex flex-row mt-lg-0 justify-content-end">
                                    <FilePond
                                        className="file-pond-new"
                                        files={files}
                                        onupdatefiles={handleFileUpdate}
                                        allowMultiple={false}
                                        allowImagePreview={true}
                                        maxFiles={1}
                                        server={{
                                            load: (source, load, error, progress, abort, headers) => {
                                                let myRequest = new Request(source);
                                                fetch(myRequest).then(function (response) {
                                                    response.blob().then(function (myBlob) {
                                                        load(myBlob);
                                                    });
                                                });
                                            },
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
                                                    formik.setFieldValue("image", response);
                                                }
                                            },
                                            remove:(source, load, error)=>{
                                                func()
                                                error("ohhhh haj akbarrr")
                                                load()
                                            } ,
                                            restore: null,
                                            revert: null
                                        }

                                        }
                                        name="files"
                                        labelIdle='<span class="filepond--label-action"><i class="fa-solid fa-cloud-arrow-up text-orange fs-8 me-9 mb-3"></i></span>'
                                    />
                                    <button type="submit" className="bg-transparent border-0 px-0">
                            <span className="fa-stack fa-1x text-orange fs-4">
                              <i className="fa-solid fa-circle fa-stack-2x"></i>
                              <i className="fa-solid fa-paper-plane-top fa-stack-1x fa-inverse ps-1"></i>
                            </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>:""
            ):( <div className="bg-white rounded-4 shadow p-3 mb-4">
                    <div className="d-flex flex-row align-items-center">
                        <input className="bg-gray rounded-pill text-dark px-4 py-2 w-100 form-control disabled"
                               type="text" id="title"
                               placeholder="Please login and put your post here" disabled/>
                    </div>
                </div>)}
        </>

)
}
