import React from "react";
import "../scss/Account-DeleteUserAccount.scss";

export default function DeleteUserAccount() {
    return (
        <>

        <div className="bg-white w-100 h-auto p-3 rounded-4">
                            <div className="row d-flex flex-row justify-content-around">
                                <div className="row">
                                   <div className="w-100">
                                   <p>Do you want to disable your account?</p>
                                   <p className="text-orange">Please Attention: All of your information and certifications will be hidden.</p>
                                   </div>
                                </div>
                                <div className="del-submit d-flex flex-row justify-content-end">
                                <input type="submit" value="Confirm" className="btn btn-orange text-white p-2 mt-5 mb-3 rounded-pill col-md-6 col-24"/>
                                </div>
                            </div>
           </div>

        </>
      );
}
