import React from "react";
import UserInfo from "./user-info";
import UserMap from "./user-map";
import {useDispatch, useSelector} from "react-redux";
import {useQuery} from "react-query";
import axios from "../../axiosConfig";
import {route} from "../../helpers";
import {getDetails} from "../redux/Details";


export default function UserInfoSidebar(props) {
    const user = props.user;
    console.log(user)
    const dispatch = useDispatch();
    const data = useSelector(state => state.info);
    const followDetails = useQuery('followDetails', async () => {
        const {data} = await axios.get(route("api.public.UserFollowingDetails",{user: user.slug}));
        followDetails.data = data.data;
        dispatch(getDetails(followDetails.data));
        return followDetails;
    },{refetchInterval:10000});
    return (
        <>
            <div className="w-100 text-center p-3 bg-light rounded-3 shadow-lg top-0 mb-4 border-dark-gray">
                {(user.profile_image)?(
                    <img className="max-h-8rem mx-auto rounded-circle mb-5" src={import.meta.env.VITE_ASSET_URL + '/public/users/profile/' + user.profile_image.url}/>
                ):(
                    <img className="max-h-8rem mx-auto rounded-circle mb-5" src={import.meta.env.VITE_ASSET_URL + '/public/users/profile/default.png'}/>
                )}
                <h1 className="h5 text-black">{user.fname} {user.lname}</h1>
                <p className="fs- mb-1 text-dark-gray">{user.title}</p>
                {(user.Role) ? (<p className="fs-3  text-dark">Role <b>Teacher</b></p>) : (
                    <p className="fs-3  text-dark">Role <b>User</b></p>)}
                <div className="d-flex justify-content-around text-center fs-2 fw-bold">
                    <div>Followings {data.data.followings}</div>
                    <div>Followers {data.data.followers}</div>
                </div>
                <hr className="border-dark-gray"/>
                <UserInfo user={user}/>
                <hr className="border-dark-gray"/>
                {/*<UserEducationBackground {...props}/>*/}
                {/*<UserWorkExperience {...props}/>*/}
            </div>
            <UserMap/>
        </>
    )
}
