import * as React from "react";
import {Splide, SplideSlide} from "@splidejs/react-splide";
import axios from "../../axiosConfig";
import {useState} from "react";
import tourThumbnail from "../../images/tour.png";
import {route} from "../../helpers";
import {useQuery} from "react-query";

import calendarRemove from "../../images/calendar-remove.svg";
import shieldSecurity from "../../images/shield-security.svg";
import moneys from "../../images/moneys.svg";
import calendar from "../../images/calendar.svg";
import BeforeRegistration from "./components/BeforeRegistration";
import StartedRegistration from "./components/StartedRegistration";
import LastWeekRegistration from "./components/LastWeekRegistration";
import StartSoon from "./components/StartSoon";
import Ongoing from "./components/Ongoing";
import Completed from "./components/Completed";
import {cloneDeep} from "lodash";

export default function Groups(props) {
    const [filter, setFilter] = useState(["Registration"]);

    const groupsCards = useQuery("groupsCards", async () => {
        const {data} = await axios.get(route("api.public.tour.show", {tour: props.slug}));
        groupsCards.data = data.data;
        return groupsCards;
    });
    const handleFilterToggle = (...argument) => {
        let array = structuredClone(filter);
        if(argument.length > 5) {
            return setFilter(argument);
        }
        for (var i= 0; i < argument.length; i++) {
            console.log("argument " + argument[i] + " result: " + array.includes(argument[i]));
            array = array.includes(argument[i]) ? array.filter(el => el !== argument[i]) : [...array, argument[i]];
        }
        return setFilter(array);
    }

    if (groupsCards.isLoading) {
        return <p>Loading</p>
    }

    if (groupsCards.isError) {
        return <p>Error</p>
    }
    const filterFunc = (item, key) => {
        if (filter.includes(item.status)) {
            console.log(item, "dad", filter)
            switch (item.status) {
                case "Registration":
                    return <StartedRegistration data={item} tour_slug={props.slug}/>
                case "Pre Registration":
                    return <BeforeRegistration data={item} tour_slug={props.slug}/>
                case "On Going":
                    return <Ongoing data={item} tour_slug={props.slug}/>
                case "Completed":
                    return <Completed data={item} tour_slug={props.slug}/>
                case "Start Soon":
                    return <StartSoon  data={item} tour_slug={props.slug}/>
                case "Sold Out":
                    return <StartSoon  data={item} tour_slug={props.slug}/>
            }
        }
    }

    return (
        <>
            <div>
                <div className="flex">
                    <p className="mb-10 text-4xl text-center lg:text-left fw-bold grow">
                        Groups
                    </p>
                    <div className="grow-0">
                        <button onClick={() => handleFilterToggle('Pre Registration', 'Registration', 'Start Soon', 'On Going', 'Completed', 'Sold Out')}
                            className={`w-full border-footer border text-black hover:bg-footer  hover:text-white active:bg-primary active:text-white font-bold px-20  py-2 rounded-full ${filter.length > 5 ? 'bg-footer text-white' : 'text-black'}`}>
                            See All
                        </button>
                    </div>
                </div>
                <div className="flex  justify-between gap-x-3 mt-5 ">
                    <button onClick={() => handleFilterToggle('Registration')}
                        className={`w-full border-primary border text-black hover:bg-neutral  hover:text-white active:bg-primary active:text-white font-bold  py-2 rounded-full ${filter.includes('Registration') ? 'bg-primary text-white' : 'text-black'}`}>
                        Open
                    </button>
                    <button onClick={() => handleFilterToggle('Pre Registration')}
                        className={`w-full border-primary border text-black hover:bg-neutral  hover:text-white active:bg-primary active:text-white font-bold  py-2 rounded-full ${filter.includes('Pre Registration') ? 'bg-primary text-white' : 'text-black'}`}>
                        Pre Registration
                    </button>
                    <button onClick={() => handleFilterToggle('Start Soon')}
                        className={`w-full border-primary border text-black hover:bg-neutral  hover:text-white active:bg-primary active:text-white font-bold  py-2 rounded-full ${filter.includes('Start Soon') ? 'bg-primary text-white' : 'text-black'}`}>
                        Start Soon
                    </button>
                    <button onClick={() => handleFilterToggle('Completed','On Going', 'Sold Out')}
                        className={`w-full border-primary border text-black hover:bg-neutral  hover:text-white active:bg-primary active:text-white font-bold  py-2 rounded-full ${filter.includes('Completed') ? 'bg-primary text-white' : 'text-black'}`}>
                        Completed
                    </button>
                </div>
            </div>
            <Splide options={{
                rewind: true,
                height:'40rem',
                arrows: false,
                pagination: false,
                gap: '1rem',
                perPage: 2,
                breakpoints: {
                    768:{
                        perPage:1
                    },
                    900: {
                        perPage: 1,
                    },
                }
            }}>
                {groupsCards.data.data.map((item, key) => {
                    return filterFunc(item, key);
                })}
            </Splide>
        </>
    );
}
