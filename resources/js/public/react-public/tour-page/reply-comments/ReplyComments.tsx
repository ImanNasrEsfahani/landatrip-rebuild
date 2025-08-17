import * as React from "react";
import {useState} from "react";
import {useMutation} from "react-query";
import axios from "../../axiosConfig";
import {route} from "../../helpers";
import {SubmitHandler, useForm} from "react-hook-form";

type Data = {
    tourComment: string,
    tour: string,
    user: string,
    user_profile: string,
    replyTo: string
}
export default function ReplyComments(props:Data) {
    const [replyOpen, setReplyOpen] = useState(false);
    const [successMessage, setSuccessMessage] = useState(false);

    interface ReplyMessage {
        reply: string;
    }

    const {register, handleSubmit, reset} = useForm<ReplyMessage>();
    const onSubmit: SubmitHandler<ReplyMessage> = (data) => {
        replyComments.mutate(data);
        reset();
    };

    const replyComments = useMutation(
        "replyComments",
        async (data:ReplyMessage) => {
            return await axios.post(route("api.public.TourCommentReply", {"tourComment": props.tourComment}), data);
        },
        {
            onSuccess: (data) => {
                setSuccessMessage(true);
            }
        }
    );


    return (
        <div>
            <button onClick={() => setReplyOpen(props.user?!replyOpen:'')} className="px-3 fs-1 flex rounded-pill text-md font-medium mx-2">
                <span className={`${replyOpen?"rotate-180":""}`}>
                    <svg width="20" height="20" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.91406 22.8877H18.9141C22.3641 22.8877 25.1641 20.0877 25.1641 16.6377C25.1641 13.1877 22.3641 10.3877 18.9141 10.3877H5.16406"
                        stroke={`${replyOpen?"#007560":"#6C757D"}`}
                       />
                    <path d="M8.03594 13.5123L4.83594 10.3123L8.03594 7.1123" stroke={`${replyOpen?"#007560":"#6C757D"}`}
                      />
                </svg>
                </span>
                <span className={`ms-1 ${replyOpen?"text-primary":""}`}>
                Reply
                </span>
            </button>
            {replyOpen ? (
                <form onSubmit={handleSubmit(onSubmit)} className="w-full flex mt-3">
                        <img src={props.user_profile} className="aspect-square rounded-full w-[3rem] me-3"/>
                    <div className="my-auto w-full">
                        <div className={`flex flex-row justify-between w-100 border-[0.125rem] rounded-2xl w-full items-center p-2 ${successMessage?"bg-primary border-secondary":''}`}>
                            {successMessage?
                            <div className="text-white">Your Comment Posted Successfully</div>
                                :
                                <>
                                    <span className="mx-1 text-sm font-bold text-black">{props.replyTo}</span>
                                    <input className="grow form-input focus:border-none focus:outline-none" {...register("reply")}
                                        placeholder="write your reply"/>
                                    <button className="bg-transparent">
                                        <svg width="28" height="24" viewBox="0 0 28 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.25655 0C1.65807 0 1.08411 0.210714 0.660928 0.585786C0.237743 0.960859 0 1.46957 0 2V8C0.000734259 8.41423 0.146568 8.81804 0.41736 9.15566C0.688151 9.49327 1.07054 9.74804 1.51171 9.88477C1.75091 9.96003 2.00272 9.99899 2.25655 10C2.26463 10 2.27271 10 2.28079 10L15.7958 12L2.28079 14.002C2.27271 14.0013 2.26463 14.0006 2.25655 14C2.00198 14.0008 1.74941 14.0398 1.50951 14.1152C1.06875 14.2523 0.686835 14.5072 0.416461 14.8448C0.146086 15.1824 0.000573986 15.586 0 16V22C0 22.5304 0.237743 23.0391 0.660928 23.4142C1.08411 23.7893 1.65807 24 2.25655 24C2.64943 23.9993 3.03531 23.9078 3.37601 23.7344H3.37821L26.391 12.9219L26.3932 12.918C26.5963 12.8412 26.7694 12.7132 26.8912 12.5501C27.0131 12.3869 27.0782 12.1957 27.0786 12C27.0789 11.8035 27.0138 11.6112 26.8915 11.4472C26.7693 11.2833 26.5952 11.1549 26.391 11.0781L3.37821 0.265625C3.03686 0.0918909 2.65018 0.000318242 2.25655 0Z"
                                                fill="#007560"/>
                                        </svg>
                                    </button>
                                </>
                            }
                        </div>
                    </div>

                </form>
            ) : null}
        </div>
    );
}


