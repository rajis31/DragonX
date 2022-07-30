import { createStore } from 'vuex'

const store = createStore({
    state:{
        isLoggedIn: false
    },
    getters: {
        getIsLoggedIn(state){
            return state.isLoggedIn;
        }
    }
});


export default store;