import { createRouter, createWebHistory } from "vue-router"

import homeIndex from '../components/pages/home/Index.vue'
import AdminHomeIndex from '../components/admin/home/Index.vue'
import AdminAboutEdit from '../components/admin/abouts/Edit.vue'
import AdminMediasEdit from '../components/admin/medias/Index.vue'
import AdminServicesEdit from '../components/admin/services/Index.vue'
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
        path: '/admin/abouts',
        name: 'admin.abouts',
        component: AdminAboutEdit,
    },
    {
        path: '/admin/medias',
        name: 'admin.medias.index',
        component: AdminMediasEdit,
    },
    {
        path: '/admin/services',
        name: 'admin.services.index',
        component: AdminServicesEdit,
    },
    {
        path: '/:any(.*)*',
        name: 'notFoundPage',
        component: notFoundPage,
    }
]

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: 'nav-active',
    routes,
})

export default router