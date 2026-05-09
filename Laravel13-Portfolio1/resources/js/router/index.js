import { createRouter, createWebHistory } from "vue-router"

import homeIndex from '../components/pages/home/Index.vue'
import AdminHomeIndex from '../components/admin/home/Index.vue'
import notFoundPage from '../components/NotFoundPage.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: homeIndex,
    },
    {
        path: '/admin/dashboard',
        name: 'admin.home.index',
        component: AdminHomeIndex,
    },
    {
        path: '/:any(.*)*',
        name: 'notFoundPage',
        component: notFoundPage,
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router