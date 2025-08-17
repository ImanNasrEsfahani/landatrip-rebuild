import React, {useState} from "react";
import Follow from "./Follow";
import {route} from "../../helpers";
import '../../scss/header.scss'
import '../../group/new.css'
import {FilePond, registerPlugin} from "react-filepond";
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';

registerPlugin(FilePondPluginFileValidateType,FilePondPluginImageCrop);
export default function Header(props){
    const auth = props.auth
    const user = props.user
    const follow = props.follow
    const [files , setFiles] = useState([])
    console.log(user)

    return(
        <>
            <div className="position-relative container mx-auto p-0 text-center rounded-4 overflow-hidden min-vh-90 min-vh-lg-60 min-vh-xl-50 min-vh-xxl-40 d-flex flex-column justify-content-center tour-bg-header">
                <img className="w-100" src={(user.header_image)?(`${import.meta.env.VITE_ASSET_URL + '/public/users/header/'+user.header_image.url}`):
                    `${import.meta.env.VITE_ASSET_URL + '/public/users/header/Landa-trip-header.png'}`}/>
                <div className="d-flex flex-row justify-content-between align-items-center w-100 blur-stripe position-absolute bottom-0 start-0 rounded-bottom h-auto">
                    <div className="row w-100 m-0 p-0">
            <span className="col-24 col-md-16 text-center text-md-start">
                {(props.auth) ? (
                    // Authenticated
                    auth.id!==user.id ?
                    <div className="react-follow-button">
                        <Follow user={user} follow={follow} />
                    </div> :  <FilePond
                            className="file-pond-profile"
                            files={files}
                            onupdatefiles={setFiles}
                            allowMultiple={false}
                            allowImagePreview={true}
                            allowImageCrop={true}
                            imageCropAspectRatio={'16:9'}
                            maxFiles={1}
                            acceptedFileTypes={['image/jpeg', 'image/png']}
                            server={{
                                process: {
                                    url: route("api.public.userHaeder",{user:auth.slug}),
                                    headers: {
                                        'X-CSRF-TOKEN': document.head
                                            .querySelector('meta[name="csrf-token"]')
                                            .getAttribute('content'),
                                    },
                                    method: 'post',
                                    timeout: 30 * 1000,
                                    withCredentials: true,
                                },
                                restore: null,
                                revert: null
                            }

                            }
                            name="files"
                            labelIdle='<span class="filepond--label-action"><a class="btn blur-stripe text-white bg-orange px-4 py-1 mx-3 rounded-pill mb-4">Edit Profile</a></span>'
                        />
                ):(
                    // Unauthenticated
                    <a href={ route("login")} className="btn btn-orange text-white align-self-center rounded-pill ms-2">Login</a>
                )}
            {/*    <div>*/}
            {/*        <img src={import.meta.env.VITE_APP_URL + '/storage/users/header/landa-trip-header.png'}/>*/}
            {/*</div>*/}

        </span>
                    </div>
                </div>
            </div>
        </>
)
}
