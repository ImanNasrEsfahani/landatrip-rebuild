import { configureStore } from '@reduxjs/toolkit';
import DetailsReducer from './Details';



const store = configureStore({
    reducer: {
        info : DetailsReducer
    },
})

export default store;
