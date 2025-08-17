import React from 'react'
import DashboardAnalitics from "./../../components/DashboardAnalitics";
import DashboardRecentContracts from "@/agent-panel/components/DashboardRecentContracts";


export default function Dashboard(){
    return (
        <div className="dashboard bg-white w-100 h-auto p-3 rounded-3">
            <div className="row d-flex flex-row justify-content-around">
                <div>
                    <h5>
                        <b>Dashboard</b>
                        <hr/>
                    </h5>
                    <div className="row mb-5 mx-3">
                        <div className="col-24 d-flex flex-column ">
                            <DashboardAnalitics/>
                            <div className='row mt-10 justify-content-between'>
                                <div className="col-24 col-lg-10 bg-white rounded-3 shadow p-0 pb-3">
                                    <div className="border-0 fs-4 fw-semibold p-3">
                                        Recent Tickets
                                    </div>
                                </div>
                                    <div className="col-24 col-lg-10 bg-white rounded-3 shadow p-0 pb-3">
                                        <div className="border-0 fs-4 fw-semibold p-3">
                                            Recommended Tours
                                        </div>
                                        {/*<DashboardRecentContracts/>*/}
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
