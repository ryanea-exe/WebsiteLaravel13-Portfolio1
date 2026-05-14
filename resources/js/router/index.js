import { createRouter, createWebHistory } from "vue-router"
import homeIndex from '../components/pages/home/Index.vue'
import AdminHomeIndex from '../components/admin/home/Index.vue'
import AdminAboutEdit from '../components/admin/abouts/Edit.vue'
import AdminMediasIndex from '../components/admin/medias/Index.vue'
import AdminServicesIndex from '../components/admin/services/Index.vue'
import AdminSkillsIndex from '../components/admin/skills/Index.vue'
import AdminEducationsIndex from '../components/admin/educations/Index.vue'
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
        component: AdminMediasIndex,
    },
    {
        path: '/admin/services',
        name: 'admin.services.index',
        component: AdminServicesIndex,
    },
    {
        path: '/admin/skills',
        name: 'admin.skills.index',
        component: AdminSkillsIndex,
    },
    {
        path: '/admin/educations',
        name: 'admin.educations.index',
        component: AdminEducationsIndex,
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