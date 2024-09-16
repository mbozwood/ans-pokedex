import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: "/",
        component: () => import('./pages/Index.vue'),
    },
    {
        path: "/:name",
        component: () => import('./pages/View.vue'),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
