import {createRouter, createWebHistory} from "vue-router";
import Login from "@/views/Auth/Login/Index.vue";
import {useAuthStore} from "@/stores/authStore.js";
import VerifyCode from "@/views/Auth/Verify/Index.vue";
import Info from "@/views/Info/Index.vue";
import Tickets from "@/views/Tickets/Index.vue";
import Dashboard from "@/views/Dashboard/Index.vue";
import CreateTicket from "@/views/Tickets/Create/Index.vue";



const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: Tickets,
            meta: { requiresAuth: true }
        },
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
            path: '/info',
            component: Info,
            meta: { requiresAuth: true }
        },
        {
            path: '/dashboard',
            component: Dashboard,
            meta: { requiresAuth: true }
        },
        {
            path: '/create-ticket',
            component: CreateTicket,
            meta: { requiresAuth: true }
        },
    ]
})

router.beforeEach(async (to, from, next) => {
    const auth = useAuthStore()

    if (!auth.state.isInitialized) {
        await auth.me()
    }

    if (to.meta.waitCode && !auth.state.waitCode) return next('/login')
    if (to.meta.requiresAuth && !auth.state.isAuthenticated) return next('/login')
    if (to.meta.guest && auth.state.isAuthenticated) return next('/')

    next()
})

export default router
