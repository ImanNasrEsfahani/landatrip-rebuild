import React from "react";
import GroupInfo from "./GroupInfo";
import GroupTuor from "./GroupTuor";
import GroupStudents from "./GroupStudents";
import GroupChat from "./GroupChat";
import {DndProvider} from "react-dnd";
import {HTML5Backend} from "react-dnd-html5-backend";
import GroupHeader from "./GroupHeader";
import './Group.css'

export default function GroupSidebar(props){
    const students = JSON.parse(props.Student)
    const group = JSON.parse(props.group)
    const Auth = JSON.parse(props.Auth)
    const GroupImage = JSON.parse(props.GroupImage)
    const GroupTutor = JSON.parse(props.Tutor)
    const TutorProfile = JSON.parse(props.TutorProfile)
    console.log(GroupTutor)
    return(
        <DndProvider backend={HTML5Backend}>
        <div className="container-fluid m-0 p-0 pb-5 bg-gray">
            <div className="container row mx-auto px-0 justify-content-center ">
                <div className="pt-4 col-23 col-md-6 h-100">
                    <GroupInfo GroupImage={GroupImage} group={group} GroupDate={props.GroupDate}/>
                    <GroupTuor GroupTutor={GroupTutor} TutorProfile={TutorProfile} group={group}/>
                    <GroupStudents Student={students} group={group} Auth={Auth} id={students.map((item,key)=>(item.id))}/>
                </div>
                <div className="pt-4 col-23 col-md-18 overflow-y-scroll d-flex flex-column group">
                    <div className="bg-white shadow rounded-3 w-100 px-4 pt-3 pb-3 group">
                        <GroupHeader GroupImage={GroupImage} group={group} Student={students}/>
                        {/*@includeIf('group.components.group-chat')*/}
                        <GroupChat Auth={props.Auth} group={props.group} />
                    </div>
                </div>
            </div>
        </div>
        </DndProvider>
    )
}
