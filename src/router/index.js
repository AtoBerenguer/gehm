import { createRouter, createWebHistory } from 'vue-router';
import mainContent from '@/components/mainContent.vue';
import loginApp from '@/components/loginApp.vue';

const routes = [
    {
        path: '/',
        name: 'login',
        component: loginApp
        
    },
    {
        path: '/main',
        name: 'mainContent',
        component: mainContent
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router