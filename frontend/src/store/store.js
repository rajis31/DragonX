import { createStore } from 'vuex'

const store = createStore({
    state:{
        isLoggedIn: false,
        // backendURI: "http://127.0.0.1:8000"
        backendURI: "https://dragonx.dev-top.com/api",
    },
    getters: {
        getIsLoggedIn(state){
            return state.isLoggedIn;
        },
        getBackendURI(state){
            return state.backendURI;
        }
    }
});


export default store;