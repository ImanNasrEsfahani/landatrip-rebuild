import React from "react";

function LastWeekRegistration() {
    return (
        <div className="card w-96 h-[33rem] my-10 bg-base-100 shadow-xl">
            <figure className="px-4 pt-10">
                <img
                    src={"http://landatrip.test/storage/website/tours/tour.png"}
                    alt="Tour"
                    className="rounded-xl w-full h-full object-cover"
                />
                <div className="absolute w-full px-7 top-[12rem]">
                    <div className="flex justify-between">
                        <div className="flex text-black bg-white/70 backdrop-opacity-90 backdrop-blur-3xl  overflow-x-hidden p-2 rounded-full text-sm">
                            <p className="text-[#E7922B] px-1">ICON </p>
                            <p> 25 July</p>
                        </div>
                        <div className="flex text-black bg-white/70 backdrop-opacity-90 backdrop-blur-3xl  overflow-x-hidden p-2 rounded-full text-sm">
                            <p className="text-[#E7922B] px-1">ICON </p>
                            <p> Private Access</p>
                        </div>
                    </div>
                </div>
            </figure>
            <div className="card-body p-5 items-center text-center w-full flex flex-col justify-between">
                <div className="card-title flex flex-col w-full">
                    <h2 className=" w-full text-left text-xl font-bold">
                        Bazdid az asgarabad (summer)
                    </h2>
                    <div className="flex justify-between w-full mt-4">
                        <div className="text-[#E7922B] text-sm">ICON</div>
                        <div className="w-full self-center h-full">
                            <div className=" px-5 h-full">
                                <div className="flex h-full overflow-hidden rounded-full bg-gray-100 text-xs">
                                    <div className="flex items-center bg-[#E7922B] transition-all duration-500 ease-out w-[45%] text-white">
                                        <p>45</p>
                                    </div>
                                    <div className="flex items-center bg-[#007560] transition-all duration-500 ease-out w-[25%] text-white">
                                        <p>25</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="text-[#919191] text-sm">1/30</div>
                    </div>
                    <div className="self-start pl-10">
                        <div className="avatar-group -space-x-5">
                            <div className="avatar">
                                <div className="w-7">
                                    <img
                                        src={
                                            "http://landatrip.test/storage/website/tours/tour.png"
                                        }
                                        alt="Avatar"
                                    />
                                </div>
                            </div>
                            <div className="avatar">
                                <div className="w-7">
                                    <img
                                        src={
                                            "http://landatrip.test/storage/website/tours/tour.png"
                                        }
                                        alt="Avatar"
                                    />
                                </div>
                            </div>
                            <div className="avatar">
                                <div className="w-7">
                                    <img
                                        src={
                                            "http://landatrip.test/storage/website/tours/tour.png"
                                        }
                                        alt="Avatar"
                                    />
                                </div>
                            </div>
                            <div className="avatar placeholder">
                                <div className="w-7 bg-neutral-focus text-neutral-content">
                                    <span className="text-xs">+72</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="card-actions flex flex-col items-center text-center w-full ">
                    <div className="flex w-full">
                        <div className="text-[#007560] px-1">ICON</div>
                        <div className="text-[#B91010]">
                            <b>16 Days</b> Left for Registration
                        </div>
                    </div>
                    <div className="flex justify-between">
                        <div className="text-xl text-[#007560]"> ICON </div>
                        <div>
                            <p className="text-xl font-bold px-1"> From </p>
                        </div>
                        <div>
                            <p className="text-xl font-bold pr-1 line-through decoration-[#B91010] decoration-2 text-[#4F4F4F]">
                                {" "}
                                $470{" "}
                            </p>
                        </div>
                        <div>
                            <p className="text-xl font-bold text-[#E7922B]">
                                {" "}
                                $270{" "}
                            </p>
                        </div>
                    </div>
                    <div>
                        <button className="btn btn-info bg-black text-white rounded-2xl capitalize">
                            Book Now!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default LastWeekRegistration;
