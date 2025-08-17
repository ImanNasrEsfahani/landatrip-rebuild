import React from "react";
import "../scss/Affiliate.scss";
import affiliate from "../../images/affiliate.png"
import {useQuery, useQueryClient} from "react-query";
import axios from '../../../../axiosConfig';

export default function Affiliate() {

    const queryClient = useQueryClient();

    // Queries to get all records
    // const affiliateRecords = useQuery('affiliateRecords', async () =>
    // {
    //     const {data} = await axios.get('/contact-info/work-experience');
    //     affiliateRecords.data = data.data;
    //     return affiliateRecords;
    // });

    const value = "";


    const  handleCopyClick = async () => {
        // Get the text field
        const copyText = document.getElementById("myInput");
        console.log(copyText);
        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        try {
            await navigator.clipboard.writeText(copyText.value);
            console.log('Content copied to clipboard');
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
    }

        // const R = document.querySelector('[type=range]');
        // R.style.setProperty('--val', +R.value);
        // R.style.setProperty('--max', +R.max);
        // R.style.setProperty('--min', +R.min);
        //
        // document.documentElement.classList.add('js');
        //
        // R.addEventListener('input', e => {
        //     R.style.setProperty('--val', +R.value);
        // }, false);
        // if (affiliateRecords.isLoading)
        // {
        //     return <h2>Loading...</h2>;
        // }
        //
        // // Show Error message in query of all record on mounting
        // if (affiliateRecords.isError)
        // {
        //     return <h2 className="text-danger">Error! { affiliateRecords.error.message }</h2>;
        // }

        return (<>
            <div className="bg-white w-100 h-auto p-4 rounded-3 text-center mb-8">
                <div className="row justify-content-between flex-sm-row-reverse">
                    <div className="col-24 col-md-12 ">
                        <img className="w-100" src={affiliate} alt="Affiliate"/>
                    </div>
                    <div className="col-24 col-md-12 align-self-center mt-5">
                        <h5>Invite people to <span className="text-green">Landa</span> <span
                            className="text-orange">Trip</span> and get <span className="text-warning">bonus</span></h5>
                        <h5 className="mb-8">They can also enjoy <span className="text-green">Landa</span> <span
                            className="text-orange">Trip</span> by using our lovely tours <span
                            className="text-danger">:)</span></h5>
                    </div>
                </div>
            </div>
            <div className="bg-white w-100 h-auto p-4 rounded-3">
                <div className="row">
                    <div className="col-24 col-md-12">
                        <div className="bg-blue-green-light rounded-5 my-5 p-4 shadow">
                            <p className="col-12 text-white">Select Bonus Amount</p>
                            <div role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" className="btn-check " name="radio" id="btnRadio1"
                                       autoComplete="off"/>
                                <label className="px-4 btn bg-white rounded-pill mx-lg-3 mx-1 shadow-lg"
                                       htmlFor="btnRadio1">5%</label>

                                <input type="radio" className="btn-check " name="radio" id="btnRadio2"
                                       autoComplete="off"/>
                                <label className="btn bg-white rounded-pill mx-lg-3 mx-1 shadow-lg"
                                       htmlFor="btnRadio2">10%</label>

                                <input type="radio" className="btn-check " name="radio" id="btnRadio3"
                                       autoComplete="off"/>
                                <label className="btn bg-white rounded-pill  mx-lg-3 mx-1 shadow-lg"
                                       htmlFor="btnRadio3">15%</label>

                                <input type="radio" className="btn-check " name="radio" id="btnRadio4"
                                       autoComplete="off"/>
                                <label className="btn bg-white rounded-pill mx-lg-3 mx-1 shadow-lg"
                                       htmlFor="btnRadio4">20%</label>

                                <input type="radio" className="btn-check " name="radio" id="btnRadio5"
                                       autoComplete="off"/>
                                <label className="btn bg-white rounded-pill mx-lg-3 ms-1 shadow-lg"
                                       htmlFor="btnRadio5">25%</label>
                            </div>
                        </div>
                        <div className="bg-blue-green-light rounded-5 my-5 p-4 pe-6 shadow">
                            <label htmlFor="customRange2" className="form-label text-white">limit by user</label>
                            <input type="range" className="form-range" min="0" max="3" id="customRange2"
                                   list='tickMarks'/>
                            <div className="text-white" id="tickMarks">
                                <p>1</p>
                                <p>10</p>
                                <p>100</p>
                                <p className="text-nowrap">No limit</p>
                            </div>
                        </div>
                        <div className="bg-blue-green-light rounded-5 my-5 p-4 pe-6 shadow">
                            <label htmlFor="customRange2" className="form-label text-white">limit by number of
                                users</label>
                            <input type="range" className="form-range" min="0" max="3" id="customRange2"
                                   list='tickMarks'/>
                            <div className="text-white" id="tickMarks">
                                <p>1hour</p>
                                <p>1day</p>
                                <p>1week</p>
                                <p className="text-nowrap">No limit</p>
                            </div>
                        </div>
                    </div>
                    <div className="col-24 col-sm-12 col-lg-12">
                        <div className="d-flex flex-row p-2 bg-blue-green-light my-5 rounded-5 mt-n1">
                            <span className="text-white fs-1 me-3 mt-2 ms-2">LinkName</span>
                            <input id="capacity" className="form-control rounded-5 border-0" type="text"
                                   name="capacity"/>
                        </div>
                        <div className="d-flex flex-row justify-content-center">
                            <button type="submit"
                                    className="btn btn-blue-green-light text-white p-2 rounded-5 col-md-8 col-24 mb-3">Generate
                                link
                            </button>
                        </div>
                        {value.length > 0 ? <div
                            className="d-flex border border-dark border-1 rounded-pill mt-5 justify-content-center">
                            <input id="myInput" type="text" className="text-center border-0 py-2 " value={value} readOnly/>
                            <i className="fa-light fa-copy ms-1 p-0  fs-5 align-self-center" onClick={handleCopyClick}></i>
                        </div> : ""
                        }
                    </div>
                </div>
            </div>
                <div className="col-24 col-md-12 bg-white h-auto py-5 px-9 rounded-3 mt-8">
                    <div className="d-flex justify-content-between mb-3">
                        <span className="fs-4">invited :</span>
                        <span className="p-1 px-11 bg-blue-green-light rounded-pill text-white">300</span>
                    </div>
                    <div className="d-flex justify-content-between mb-3">
                        <span className="fs-4">bonus received :</span>
                        <span className="p-1 px-11 bg-blue-green-light rounded-pill text-white">300</span>
                    </div>
                    <div className="d-flex justify-content-between">
                        <span className="fs-4">bonus get :</span>
                        <span className="p-1 px-11 bg-blue-green-light rounded-pill text-white">300</span>
                    </div>
                </div>
        </>);
    }
