import React from 'react'


export default function DashboardAnalitics(){

    return(
        <div className="d-flex row gy-4 w-90 w-md-80 w-xl-100 m-auto gap-10">
            <div className='col-24 col-md-12 col-lg-5'>
                <div
                    className="bg-warning rounded-3 text-center py-8 fs-3 text-white">
                    Completed Tours
                    <br/>
                    3
                </div>

            </div>
            <div className='col-24 col-md-12 col-lg-5'>
                <div
                    className="bg-bittersweet rounded-3 text-center py-8 fs-3 text-white">
                        Pending Tour
                    <br/>
                    50
                </div>
            </div>
            <div className='col-24 col-md-12 col-lg-5'>
                <div
                    className="bg-info rounded-3 text-center py-8 fs-3 text-white">
                    Followers
                    <br/>
                    3
                </div>
           </div>
            <div className='col-24 col-md-12 col-lg-5'>
            <div
                className="bg-deep-sea-green rounded-3 text-center py-8 fs-3 text-white">
                Teacher Assign
                <br/>
                50
            </div>
            </div>
        </div>
    )
}
