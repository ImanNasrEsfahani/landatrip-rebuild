import React from "react";
import UserInfoSidebar from "./Component/user-info-sidebar";
import Header from "./Component/header";
import Posts from "./Component/posts";
import Groups from "./Component/groups";
import Communities from "./Component/communities";
import NewPost from "./Component/new-post";

export default function ProfilePage(props) {
    const user = props.user;
    const auth = props.auth
    const groups = props.user.groups;
    console.log(props);

    return(
        <div className="container-fluid m-0 p-0 bg-light-gray">
            <div className="container mx-auto">
                <div className="row gy-4 justify-content-center px-0 pt-4">
                    <div className="col-23 col-lg-6">
                        <UserInfoSidebar user={user}/>
                    </div>
                    <div className="col-23 col-lg-18 ps-0 ps-lg-3 pe-0 mb-5">
                        <Header user={user} auth={auth} follow={props.follow}/>
                        <div className="row gy-4 px-0 mt-3">
                            <div className="col-24 col-lg-16">
                                <NewPost auth={auth} user={user}/>
                                {(user.user_posts)?(user.user_posts.map((item,index)=>
                                        <Posts post={item} auth={auth} user={user}/>
                                    )):(<div className="bg-white rounded-4 shadow py-3">
                                    <div className="w-100 px-4 text-dark-gray">
                                        <p>No Activities are stored until yet</p>
                                    </div>
                                </div>)}

                            </div>
                            <div className="col-24 col-lg-8">
                                <Groups group={groups} auth={auth}/>
                                <Communities community={props.user.communities}/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
