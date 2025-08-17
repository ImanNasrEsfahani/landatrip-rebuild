import {createSlice} from "@reduxjs/toolkit";


const initialState = {
    data: {
        followings: 0,
        followers: 0
    },
    loading: true,
    mention:""
};

export const DetailsSlice = createSlice({
    name: "Details",
    initialState,
    reducers: {
        getDetails: (state, action) => {
            state.loading = false
            state.data = action.payload
        },
        mention:(state,action)=>{
            state.mention = action.payload
        }
    },
})

export const {getDetails,mention} = DetailsSlice.actions;
export default DetailsSlice.reducer;
