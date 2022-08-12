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
        { path: "/register", name: "register", component: Register, meta: { isGuest: true } },
        { path: "/forgot", name: "forgot", component: ForgotPassword, meta: { isGuest: true } },
        { path: "/home", name: "home", component: Home, meta: { isGuest: false } },
        { path: "/install", name: "install", component: Install, meta: { isGuest: false } },
    ],

});

router.beforeEach((to, from, next) => {
    console.log(to.meta);
    next();
});

export default router;