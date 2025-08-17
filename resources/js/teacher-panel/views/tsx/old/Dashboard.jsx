import React from "react";
import "../scss/Dashboard.scss";
import img from "../../images/netur.jpg";
import img1 from "../../images/download.jfif";
import img2 from "../../images/niagara.jfif";
import img3 from "../../images/download (2).jfif";

export default function Dashboard() {
    return (<>
        <div className="bg-white w-100 h-auto p-4 rounded-3">
            <div className="row d-flex flex-row justify-content-evenly">
                <div className="boxinfo col-20 col-md-7 col-lg-4 p-3 mt-4 mb-3 rounded-3"
                     style={{backgroundColor: "#FF8C00"}}>
                    <span>Active Tickets</span>
                    <span>2</span>
                </div>
                <div className="boxinfo col-20 col-md-7 col-lg-4 p-3 mt-4 mb-3 rounded-3"
                     style={{backgroundColor: "#E2209E"}}>
                    <span>Unpaid Invoices</span>
                    <span>1</span>
                </div>
                <div className="boxinfo col-20 col-md-7 col-lg-4 p-3 mt-4 mb-3 rounded-3"
                     style={{backgroundColor: "#5E1DBB"}}>
                    <span>Certificates</span>
                    <span>3</span>
                </div>
                <div className="boxinfo col-20 col-md-7 col-lg-4 p-3 mt-4 mb-3 rounded-3"
                     style={{backgroundColor: "#007560"}}>
                    <span>My Tours</span>
                    <span>2</span>
                </div>
                <div className="boxinfo col-20 col-md-7 col-lg-4 p-3 mt-4 mb-3 rounded-3"
                     style={{backgroundColor: "#D26800"}}>
                    <span>followers</span>
                    <span>50</span>
                </div>
            </div>
            <div className="row justify-content-around p-2">
                <div className="col-sm-24 col-lg-16 rounded-3 border-white p-3 mb-3">
                    <label htmlFor="exampleFormControlTextarea1" className="form-label">PRIMARY TEXT</label>
                </div>
                <div className="col-sm-24 col-lg-7 p-3 rounded-3 border-white">
                    <div className="mb-3">
                        <label htmlFor="exampleFormControlTextarea1" className="form-label">Form</label>
                        <textarea className="form-control " id="exampleFormControlTextarea1" rows="3"
                                  placeholder="text area"></textarea>
                    </div>
                    <div className="submit d-flex flex-row justify-content-end">
                        <input type="submit" value="Submit" className="p-2 mt-3 mb-3 rounded-pill col-lg-24 col-md-10 col-24"/>
                    </div>
                </div>
            </div>
        </div>
        <div className="bg-white w-100 h-auto p-4 rounded-3 mt-4">
            <div className="row justify-content-between">
                <div className="col-24 col-md-8 col-sm-24">
                    <div className=" rounded-3 shadow p-0 m-2 mb-10">
                        <img src={img} height='180px' width='150px' className='rounded-top p-0 w-100'/>
                        <div className="col-24 px-5 pt-6 d-grid">
                            <p className="fs-4 m-0">How to write business plan</p>
                            <div className="my-2">
                                <i className="fa-regular fa-location-dot text-orange opacity-95 fs-4"></i>
                                <span className="fs-1 text-secondary ms-1">Bali, Indonesia</span>
                            </div>
                            <p className="text-orange">$700<span
                                className="ms-2 bg-orange text-white px-3 rounded-pill">20%</span></p>
                            <p className="text-secondary">$1400</p>
                        </div>
                        <div className="text-center">
                            <button type="submit" className="btn btn-orange text-white p-3 m-4 rounded-pill w-90">View
                                Details
                            </button>
                        </div>
                    </div>
                </div>
                <div className="col-24 col-md-8 col-sm-24">
                    <div className=" rounded-3 shadow p-0 m-2 mb-10">
                        <img src={img2} height='180px' width='150px' className='rounded-top p-0 w-100'/>
                        <div className="col-24 px-5 pt-6 d-grid">
                            <p className="fs-4 m-0">How to write business plan</p>
                            <div className="my-2">
                                <i className="fa-regular fa-location-dot text-orange opacity-95 fs-4"></i>
                                <span className="fs-1 text-secondary ms-1">Bali, Indonesia</span>
                            </div>
                            <p className="text-orange">$700<span
                                className="ms-2 bg-orange text-white px-3 rounded-pill">20%</span></p>
                            <p className="text-secondary">$1400</p>
                        </div>
                        <div className="text-center">
                            <button type="submit" className="btn btn-orange text-white p-3 m-4 rounded-pill w-90">View
                                Details
                            </button>
                        </div>
                    </div>
                </div>
                <div className="col-24 col-md-8 col-sm-24">
                    <div className=" rounded-3 shadow p-0 m-2 mb-10">
                        <img src={img3} height='180px' width='150px' className='rounded-top p-0 w-100'/>
                        <div className="col-24 px-5 pt-6 d-grid">
                            <p className="fs-4 m-0">How to write business plan</p>
                            <div className="my-2">
                                <i className="fa-regular fa-location-dot text-orange opacity-95 fs-4"></i>
                                <span className="fs-1 text-secondary ms-1">Bali, Indonesia</span>
                            </div>
                            <p className="text-orange">$700<span
                                className="ms-2 bg-orange text-white px-3 rounded-pill">20%</span></p>
                            <p className="text-secondary">$1400</p>
                        </div>
                        <div className="text-center">
                            <button type="submit" className="btn btn-orange text-white p-3 m-4 rounded-pill w-90">View
                                Details
                            </button>
                        </div>
                    </div>
                </div>
                <div className="col-24 col-md-8 col-sm-24">
                    <div className=" rounded-3 shadow p-0 m-2 mb-10">
                        <img src={img1} height='180px' width='150px' className='rounded-top p-0 w-100'/>
                        <div className="col-24 px-5 pt-6 d-grid">
                            <p className="fs-4 m-0">How to write business plan</p>
                            <div className="my-2">
                                <i className="fa-regular fa-location-dot text-orange opacity-95 fs-4"></i>
                                <span className="fs-1 text-secondary ms-1">Bali, Indonesia</span>
                            </div>
                            <p className="text-orange">$700<span
                                className="ms-2 bg-orange text-white px-3 rounded-pill">20%</span></p>
                            <p className="text-secondary">$1400</p>
                        </div>
                        <div className="text-center">
                            <button type="submit" className="btn btn-orange text-white p-3 m-4 rounded-pill w-90">View
                                Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </>);
}


