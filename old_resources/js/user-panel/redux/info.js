import {createSlice} from "@reduxjs/toolkit";

const initialState = {
    user_id : "",
    firstName: "",
    lastName: "",
    profile_picture: "",
    profile_alt: "",
    USD: 0,
    EUR: 0,
    CAD: 0,
    Rial: 0,
    slug:"",
    score:0,
    email:"",
    title:"",
    location:""
};

export const infoSlice = createSlice({
    name: "info",
    initialState,
    reducers: {
        getInfo: (state) => state,
        saveInfo: (state, action) => {
            return action.payload;
        },
        },
});

export const {getInfo, saveInfo} = infoSlice.actions;
export default infoSlice.reducer;
