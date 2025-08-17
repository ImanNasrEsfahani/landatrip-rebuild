import React from "react";
import {useQuery} from "react-query";
import axios from "../axiosConfig";
import {route} from "../helpers";




export default function GroupTuor(props){
    const Tutor = useQuery('Tutor', async () => {
        const {data} = await axios.get(route('api.public.group-tutor', {group: props.group.slug}));
        Tutor.data = data.data;
        console.log(Tutor)
        return Tutor;
    });


    return(
        <div className="mt-4 bg-white shadow w-100 h-auto px-2 py-4 rounded-3">
            <div className="w-100">
                <h6 className="h5 ms-3 mb-0">Tutors</h6>
            </div>
            <div className="row mt-4">
                {(Tutor.data)?(
                    <div className="col d-flex flex-column w-fit align-items-center text-center">
                        <a className="text-decoration-none" href="">
                            {Tutor.data.data.map((item,key)=>
                            (item.profile)?(
                                <img className="max-h-6rem ms-2 me-4 rounded-4 mb-2"
                                src={import.meta.env.VITE_ASSET_URL + `/public/users/profile/${item.profile.url}`} alt=""/>)
                                :(<img className="max-h-6rem ms-2 me-4 rounded-4 mb-2" src={import.meta.env.VITE_ASSET_URL + "/public/users/profile/default.png"} alt=""/>)
                            )}
                        </a>
                        <a className="text-decoration-none lh-sm text-dark" href="">
                            <span className="fs-1"></span>
                        </a>
                    </div>
                ):("")}
            </div>
        </div>
    )
}
