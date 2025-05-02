import {createRouter, createWebHistory} from "vue-router";
import Login from "@/views/Auth/Login.vue";
import {useAuthStore} from "@/stores/authStore.js";
import VerifyCode from "@/views/Auth/VerifyCode.vue";
import Home from "@/views/Home.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/login',
            component: Login,
            meta: { guest: true }
        },
        {
            path: '/verify-code',
            component: VerifyCode,
            meta: { guest: true, waitCode: true }
        },
        {
            path: '/home',
            component: Home,
            meta: { requiresAuth: true }
        },
    ]
})

router.beforeEach(async (to, from, next) => {
    const auth = useAuthStore();

    if (to.meta.waitCode && !auth.waitCode) {
        return next('/login');
    }

    if (to.meta.requiresAuth) {
        if (!auth.isAuthenticated) {
            return next('/login');
        }
        return next();
    }

    if (to.meta.guest) {
        if (auth.isAuthenticated) {
            return next('/home');
        }
        return next();
    }

    if (!auth.isAuthenticated) {
        return next('/login');
    }

    next();
})

export default router
