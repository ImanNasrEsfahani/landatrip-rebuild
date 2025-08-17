import { configureStore } from '@reduxjs/toolkit';
import infoReducer from './info';


const store = configureStore({
    reducer: {
        information : infoReducer
    },
})

export default store;
