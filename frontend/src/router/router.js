import {createRouter, createWebHistory} from "vue-router";
import Login from "../pages/Login.vue";

const router = createRouter({
    routes: [
        {path: "/login", component: Login, meta: {isGuest: true}},
    ],
    history: createWebHistory()
});

router.beforeEach((to,from,next)=>{
    console.log(to.meta);
});

export default router;