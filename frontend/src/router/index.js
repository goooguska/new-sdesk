import {createRouter, createWebHistory} from "vue-router";
import Login from "@/views/Auth/Login/Index.vue";
import {useAuthStore} from "@/stores/authStore.js";
import VerifyCode from "@/views/Auth/Verify/Index.vue";
import Info from "@/views/Info/Index.vue";
import Tickets from "@/views/Tickets/Index.vue";
import Dashboard from "@/views/Dashboard/Index.vue";
import CreateTicket from "@/views/Tickets/Create/Index.vue";
import Admin from "@/views/Admin/Index.vue";
import User from "@/views/Admin/Entity/Index.vue";
import Category from "@/views/Admin/Entity/Index.vue";
import Status from "@/views/Admin/Entity/Index.vue";
import Role from "@/views/Admin/Entity/Index.vue";
import Ticket from "@/views/Admin/Entity/Index.vue";
import Detail from "@/views/Tickets/Detail/Index.vue";
import NotFound from "@/views/NotFound/Index.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: Tickets,
            meta: { requiresAuth: true },
        },
        {
            path: '/tickets/:id',
            component: Detail,
            meta: { requiresAuth: true },
        },
        {
            path: '/login',
            component: Login,
            meta: { guest: true },
        },
        {
            path: '/verify-code',
            component: VerifyCode,
            meta: { guest: true, waitCode: true },
        },
        {
            path: '/info',
            component: Info,
            meta: { requiresAuth: true },
        },
        {
            path: '/dashboard',
            component: Dashboard,
            meta: { requiresAuth: true },
        },
        {
            path: '/create-ticket',
            component: CreateTicket,
            meta: { requiresAuth: true },
        },
        {
            path: '/:pathMatch(.*)*',
            name: 'not-found',
            component: NotFound,
        },
        {
            path: '/admin',
            component: Admin,
            meta: { requiresAuth: true },
            redirect: '/admin/statuses',
            children: [
                {
                    path: 'statuses',
                    name: 'statuses',
                    component: Status,
                },
                {
                    path: 'roles',
                    name: 'roles',
                    component: Role,
                },
                {
                    path: 'categories',
                    name: 'categories',
                    component: Category,
                },
                {
                    path: 'users',
                    name: 'users',
                    component: User,
                },
                {
                    path: 'tickets',
                    name: 'tickets',
                    component: Ticket,
                },
            ]
        },
    ]
})

router.beforeEach(async (to, from, next) => {
    const auth = useAuthStore();

    if (!auth.state.isInitialized) {
        await auth.me();
    }

    if (to.meta.waitCode && !auth.state.waitCode) return next('/login');
    if (to.meta.requiresAuth && !auth.state.isAuthenticated) return next('/login');
    if (to.meta.guest && auth.state.isAuthenticated) {
        const role = auth.state.user?.role_code;
        return next(role === 'admin' ? '/admin' : '/');
    }

    if (to.path === '/' && auth.state.user?.role_code === 'admin') {
        return next('/admin');
    }

    next();
});

export default router
