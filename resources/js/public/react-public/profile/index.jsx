import * as React from "react";
import HeaderProfile from "./components/HeaderProfile"


const Index = ({user , followers , following}) => {
    const userParse = JSON.parse(user)
    console.log(user, "inershia")
    return (
       <HeaderProfile user={userParse} followers={followers} following={following}/>
    )
}

export default Index;
