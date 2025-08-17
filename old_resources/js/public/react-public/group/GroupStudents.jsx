import React, {createContext, useState} from "react";
import GroupMembers from "./GroupMembers";
import BoxTarget from "./BoxTarget";
import {useMutation, useQuery} from "react-query";
import axios from "axios";
import {route} from "../helpers";


 export const CardContext = createContext({
      MarkAsDrag : (id)=>{}
  })
export default function GroupStudents(props){

    const [dragging , setDragging] = useState(null);
    const GroupRatingRecords = useQuery('GroupRating', async () => {
        const {data} = await axios.get(route("api.public.group.user.rating.index",{user: props.Auth.id, group: props.group.slug}));
        GroupRatingRecords.data = data.data;
        return GroupRatingRecords;
    }, { onSuccess: (response) => {
            setDragging(response.data.map((item,key) => {
                        return {
                            profile: item.profile,
                            fname: item.fname,
                            laname: item.lname,
                            Id: item.user_id,
                            status: item.status
                        }
                    }
                )
            )
        }
    });

    console.log(props.group.status)
    const MarkAsDrag = (id) => {
        const dragged = dragging.filter((item,i)=>item.Id===id)[0];

        if(dragging.filter((item) => item.status === "drag").length < 3 && dragged.status === "undrag") {
            dragged.status="drag";
            setDragging(dragging.filter((item,i)=>item.Id!==id).concat(dragged));
        }else {
            dragged.status="undrag";
            setDragging(dragging.filter((item,i)=>item.Id!==id).concat(dragged));
        }
    }
    const handleSubmit = (e) => {
        e.preventDefault();
        let users = [];
        const user_rated_ids = dragging
            .filter((item) => item.status === "drag")
            .map((item) => item.Id);
        users.push(...user_rated_ids.map((user_rated_id) => ({ user_rated_id })));
        sendRate.mutate({ users });}


    const sendRate = useMutation(async (data) => {
        const response = await axios.post(route("api.public.group.user.rating.store", {user: props.Auth.id, group: props.group.slug}), data)
        return response.data;
    }, {
        onSuccess: () => {
        }, onError: () => {
        }, onSettled: () => {
        }, retry: 2
    })

    return(
        <>
        {(GroupRatingRecords.isLoading)?(
           <div>loading...</div>
        ):(
            <CardContext.Provider value={{MarkAsDrag}}>

                <div className="mt-4 w-100 bg-white shadow rounded-3 d-flex flex-column">
                    <form action="" onSubmit={(e) => handleSubmit(e)}>
                        <div className="bg-white w-100 h-auto px-3 py-4 rounded-3">
                            <h5 className="h5 ms-2 d-inline-block">Participants</h5>
                            <span className="fs-1 text-dark-gray"> {props.Student.length} Member</span>
                            <div id="up">
                                <div >
                                    <BoxTarget>
                                        {dragging.filter((it,i)=>it.status==="undrag")
                                            .map((item,key)=>
                                                <GroupMembers id={item.Id} image={item.profile}/>)}
                                    </BoxTarget>
                                </div>
                            </div>
                            {(props.group.status===3)?(
                                <BoxTarget auth={props.Auth.id} group={props.group.slug}>
                                    {dragging.filter((it,i)=>it.status==="drag")
                                        .map((item,key)=>
                                            <GroupMembers id={item.Id} image={item.profile}/>)}
                                    {dragging.filter((item) => item.status === "drag").length > 0 ?
                                        "":<p className="text-secondary">Drag the top three Your Favorite Companion Here</p>}
                                    <button type="submit" className="btn btn-orange mt-4 text-white w-75 mx-auto">Submit</button>
                                </BoxTarget>
                            ):("")}
                        </div>
                    </form>
                </div>
            </CardContext.Provider>
        )}
        </>
    )
}
