import React from 'react';
import ErrorImg from './user-panel/components/assets/system.png'
import {useNavigate} from 'react-router-dom'

export default function Error(props) {

    let navigate = useNavigate();

    return (
        <>
            <div className="bg-white w-100 h-auto p-3 rounded-4 d-flex p-12">
                <div className="align-self-center mx-auto text-center">
                    <img className="mx-auto" src={ErrorImg}/>
                    <p className="fs-4 text-danger mt-5 fw-bolder">Oops!</p>
                    <p className="fs-3 fw-bold">Something Went Wrong</p>
                    <p className="fs-4"><span className="text-danger fw-bolder">Error:</span> {props.message}</p>
                    <button className="text-white bg-danger rounded-pill border-0 p-2 px-10 shadow-lg " onClick={() => navigate(-1)}>Return</button>
                </div>
            </div>
        </>
    )
}
