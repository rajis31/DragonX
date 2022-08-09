import { createApp } from 'vue';
import App from './App.vue';
import "./index.css";
import store from "./store/store";
import router from "./router/router";
import { library } from '@fortawesome/fontawesome-svg-core';
import {
    faDragon,
    faXmark,
    faCheck,
    faArrowLeft,
    faHouse,
    faFlag,
    faShop
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add([faDragon, 
             faXmark, 
             faCheck, 
             faArrowLeft, 
             faHouse, 
             faFlag,
             faShop
            ]);

createApp(App)
    .use(store)
    .use(router)
    .component('font-awesome-icon', FontAwesomeIcon)
    .mount('#app');


