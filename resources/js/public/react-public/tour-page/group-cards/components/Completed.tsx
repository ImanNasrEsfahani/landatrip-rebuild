import * as React from "react";
import calenderAdd from "../../../images/calendar-add.svg";
import calender from "../../../images/calendar.svg";
import money from "../../../images/moneys.svg";
import shield from "../../../images/shield-security.svg";
import profile from "../../../images/profile-user.svg";
import {SplideSlide} from "@splidejs/react-splide";


type Data = {
    title: string,
    slug: string,
    thumbnailImage: string,
    start_date: string,
    public: string,
    status: string,
    reserved_user_count: number
    price: number,
    max_capacity: number,
    end_registration_date: number,
    booked_user_count: number,
    users_profileImage: []
}
function Completed(props: {data:Data, tour_slug: string}) {
    console.log(props.data, "completed");

    return (

        <SplideSlide>
            <div className="py-10 px-3  h-full">
        <div className="card bg-base-100 shadow-xl h-full">
            <figure className="px-4 pt-10 relative">
                <img src={props.data.thumbnailImage} alt="Tour"
                    className="rounded-xl w-full h-full object-cover  aspect-video"/>
                <div className="absolute w-full px-7 lg:bottom-[1rem] bottom-2">
                    <div className="flex justify-between">
                        <div className="bg-white text-xs rounded-full opacity-90 flex p-1 px-2"><img
                            className="w-4 me-1" src={calender}/><strong>{props.data.start_date}</strong></div>
                        <div className="bg-white text-xs rounded-full opacity-90 flex p-1 px-2"><img
                            className="w-4 me-1" src={shield}/><strong>{props.data.public} Access</strong></div>
                    </div>
                </div>
            </figure>
            <div className="card-body p-5 items-center text-center w-full flex flex-col justify-between">
                <div className="card-title flex flex-col w-full">
                    <h2 className=" w-full">{props.data.title}</h2>
                    <div className="flex mt-3 justify-between w-full">
                        <div><img src={profile}/></div>
                        <div className="relative w-[75%]">
                            <div className="overflow-hidden h-5 mb-4 text-xs flex rounded-full bg-gray-300">
                                <div
                                    style={{width: `${(100 / props.data.max_capacity) * props.data.booked_user_count}%`}}
                                    className="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-secondary">{props.data.booked_user_count}</div>
                                <div
                                    style={{width: `${(100 / props.data.max_capacity) * props.data.reserved_user_count}%`}}
                                    className="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary">{props.data.reserved_user_count}</div>
                                <div style={{width: "0%"}}
                                    className="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gray-400"></div>
                            </div>
                        </div>
                        <div
                            className="text-gray-500 text-sm">{props.data.booked_user_count + props.data.reserved_user_count}/{props.data.max_capacity}</div>
                    </div>
                </div>
                <div className="card-actions flex flex-col items-center text-center w-full">
                    <div className="flex w-full">
                        <img className="me-2" src={calenderAdd}/>
                        <div className={`${props.data.end_registration_date <= 5 ? "text-red-700": "text-black"}`} >
                            <b>{props.data.end_registration_date} Days</b> Left for Registration
                        </div>
                    </div>
                    <div>
                        <button className="btn btn-disabled rounded-2xl capitalize">
                            Book Now!
                        </button>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </SplideSlide>
    );
}

export default Completed;
