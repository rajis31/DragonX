import {createRouter, createWebHistory} from "vue-router";
import Login from "../pages/Login.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: "/login", name:"login", component: Login, meta: {isGuest: true}},
    ],
    
});

router.beforeEach((to,from,next)=>{
    console.log(to.meta);
    next();
});

export default router;