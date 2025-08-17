import React from 'react';
import {QueryClient, QueryClientProvider} from "react-query";
import ProfilePage from "./profilePage";
import {Mention} from "react-mentions";
import store from "./redux";
import {Provider} from "react-redux";

const queryClient = new QueryClient();
// const element = document.getElementById("group-react")
// if (elements) {
//     const groupPost = element.getAttribute("group")
//     const Auth = element.getAttribute("auth")
//     const Student = element.getAttribute("student")
//     const GroupImage = element.getAttribute("groupImage")
//     const GroupDate = element.getAttribute("groupDate")
//     const Tutor = element.getAttribute("tutor")
//     const TutorProfile = element.getAttribute("tutorProfile")
//     createRoot(element).render(
//         <QueryClientProvider client={queryClient}>
//             <GroupSidebar group={groupPost} Auth={Auth} Student={Student}
//                           GroupImage={GroupImage} GroupDate={GroupDate} Tutor={Tutor} TutorProfile={TutorProfile}/>
//         </QueryClientProvider>
//     )
// }

export default function ProfileHomePage(props){
    console.log(props)
    return(
        <QueryClientProvider client={queryClient}>
            <Provider store={store}>
            <ProfilePage {...props}/>
            <Mention/>
            </Provider>
        </QueryClientProvider>
    )}

// const elements = document.getElementById("profile-react");
// if (elements) {
//     createRoot(elements).render(<ProfileHomePage />)
// }

// const elements = document.getElementById("profile-react");
// if (elements) {
//     const ProfileImage = elements.getAttribute('profile');
//     const User = elements.getAttribute('user');
//     const Auth = elements.getAttribute('auth-user')
//     const Followed = elements.getAttribute('followed')
//     const HeaderImage = elements.getAttribute('header-image')
//     const Role = elements.getAttribute('role')
//     const Posts= elements.getAttribute('posts')
//     const Content = elements.getAttribute('content')
//     const Count = elements.getAttribute('count')
//     const Active = elements.getAttribute('active')
//     const Groups = elements.getAttribute('group')
//     const Community = elements.getAttribute('community')
//     const Company = elements.getAttribute('company')
//     const Education = elements.getAttribute('education')
//     const WorkExperince = elements.getAttribute('work-experience')
//     const PostComments = elements.getAttribute('post-comments')
//     createRoot(elements).render(<ProfileHomePage ProfileImage={ProfileImage} User={User} Auth={Auth} Followed={Followed}
//                                                 HeaderImage={HeaderImage} Role={Role} Posts={Posts} Content={Content} Count={Count} Active={Active} Groups={Groups}
//                                                 Community={Community} Company={Company} Education={Education} WorkExperince={WorkExperince} PostComments={PostComments}/>)
// }
