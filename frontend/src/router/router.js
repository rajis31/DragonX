import {createRouter, createWebHistory} from "vue-router";
import Login from "../pages/Login.vue";
import Register from "../pages/Register.vue";
import ForgotPassword from "../pages/ForgotPassword.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: "/login", name:"login", component: Login, meta: {isGuest: true}},
        {path: "/register",name:"register", component: Register, meta: {isGuest: true}},
        {path: "/forgot",name:"forgot", component: ForgotPassword, meta: {isGuest: true}},
    ],
    
});

router.beforeEach((to,from,next)=>{
    console.log(to.meta);
    next();
});

export default router;