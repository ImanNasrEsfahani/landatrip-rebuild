import {createSlice} from "@reduxjs/toolkit";

const initialState = {
    data: {
        firstName: "",
        lastName: "",
        slug: "",
        score: 0,
        profile_picture: "",
        profile_alt: "",
        USD: 0,
        EUR: 0,
        CAD: 0,
        Rial: 0,
    },
    loading:true
};

export const infoSlice = createSlice({
    name: "info",
    initialState,
    reducers: {
        getInfo: (state, action) => {
            state.loading = false
            state.data = action.payload
        },
    },
});

export const {getInfo} = infoSlice.actions;
export default infoSlice.reducer;
