import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/Login.vue";
import Register from "../pages/Register.vue";
import ForgotPassword from "../pages/ForgotPassword.vue";
import Home from "../pages/Home.vue";
import Install from "../pages/Install.vue";


const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/login", name: "login", component: Login, meta: { isGuest: true } },
        { path: "/register/:shop", name: "register", component: Register, meta: { isGuest: true } },
        { path: "/forgot", name: "forgot", component: ForgotPassword, meta: { isGuest: true } },
        { path: "/home", name: "home", component: Home, meta: { isGuest: false } },
        { path: "/install", name: "install", component: Install, meta: { isGuest: false } },
        { path: "/api"},
        {path: "/", name:"main", beforeEnter(to) { 
            console.log(to);
            console.log(this.$route.params);
            // window.location.href = window.location.origin+"/api/installation" ;

        }},
        // { path: "/:catchAll(.*)", beforeEnter(to){  window.location.href = window.location.origin+"/api/installation" }},
        // { path: "/:catchAll(.*)", redirect(to){  window.location.href = "http://127.0.0.1:8000/api/installation" }},
    ],

});

router.beforeEach((to, from, next) => {
    console.log(to.meta);
    next();
});

export default router;