import React from "react";
import {QueryClient, QueryClientProvider} from "react-query";
import {createRoot} from "react-dom/client";
import Groups from "./tour-page/group-cards/Groups";
import LikeComments from "./tour-page/like-comments/LikeComments";
import ReplyComments from "./tour-page/reply-comments/ReplyComments";
import LikeReplyComments from "./tour-page/like-reply-comments/LikeReplyComments";
import Search from "./search-homePage/Search";
import Index from "./profile"
import {bool} from "yup";

console.log("react public jsx");

const queryClient = new QueryClient({
    defaultOptions: {
        queries: {
            refetchOnWindowFocus: false,
            retry: 5,
            retryDelay: 3000,
            refetchInterval: 60000,
            cacheTime: 1000 * 60 * 60 * 24,
        },
    },
});


if (document.getElementById("group-cards")) {
    console.log("group card")
    const slug = document.getElementById('group-cards').getAttribute("slug");
    createRoot(document.getElementById("group-cards")).render(
        <QueryClientProvider client={queryClient}>
            <Groups slug={slug}/>
        </QueryClientProvider>
    );
}

if (document.getElementsByClassName("likeComments")) {
    let element = document.getElementsByClassName("likeComments")
    const arr = [].slice.call(element)
    arr.map((item, index) => {
        const count = item.getAttribute("count")
        const tourComment = item.getAttribute("tourComment")
        const isLiked = item.getAttribute("isLiked")
        createRoot(item).render(
            <QueryClientProvider client={queryClient}>
            <LikeComments count={count} tourComment={tourComment} isLiked={isLiked}/>
            </QueryClientProvider>
        )
    })
}

if (document.getElementsByClassName("replyComments")) {
    let element = document.getElementsByClassName("replyComments")
    const arr = [].slice.call(element)
    const queryClient = new QueryClient();
    arr.map((item, index) => {
        const tourComment = item.getAttribute("tourComment")
        const user =item.getAttribute("user")
        const user_profile=item.getAttribute("userProfile")
        const replyTo=item.getAttribute("replyTo")
        createRoot(item).render(<QueryClientProvider client={queryClient}>
            <ReplyComments tourComment={tourComment} user={user} user_profile={user_profile} replyTo={replyTo}/>
        </QueryClientProvider>)
    })
}

if (document.getElementsByClassName("likesReplyComments")) {
    let element = document.getElementsByClassName("likesReplyComments")
    const arr = [].slice.call(element)
    arr.map((item, index) => {
        const count = item.getAttribute("count");
        const tourCommentReply = item.getAttribute("tourCommentReply");
        const isLiked = item.getAttribute("isLiked")
        createRoot(item).render(<QueryClientProvider client={queryClient}><LikeReplyComments count={count} tourCommentReply={tourCommentReply} isLiked={isLiked}/></QueryClientProvider>)
    })
}

if(document.getElementById("search-home-page")){
    let element = document.getElementById("search-home-page")
    console.log("mohsen" , element)
    createRoot(element).render(
        <QueryClientProvider client={queryClient}>
            <Search/>
        </QueryClientProvider>
    )
}


if(document.getElementById("profile-pro")){
    let element = document.getElementById("profile-pro")
    const user = element.getAttribute("user")
    const followers = element.getAttribute("followers")
    const following = element.getAttribute("following")
    createRoot(element).render(
        <QueryClientProvider client={queryClient}>
            <Index user={user} followers={followers} following={following}/>
        </QueryClientProvider>
    )
}
