import { createRouter, createWebHistory } from "vue-router";
import { getAuth } from "../boot";
import store from "../store";
const cl =  console.log;
// console.log('store at router', store.getters['user/getAuth'])
// console.log('store at router getAuth', getAuth())
const ifNotAuthenticated = (_to, _from, next) => {
    // if (!store.getters['user/getAuth']) {
    if (!getAuth()) {
        next();
    }
    else next({ name: 'dashboard' })
}

const ifAuthenticated = (_to, _from, next) => {
    // if (store.getters['user/getAuth']){
    if (getAuth()){
        next();
    }
    else {
        next({ name: 'login' })
    }
}


const routes=[
    {
        path: '/',
        name: 'login',
        requiresAuth: false,
        beforeEnter: ifNotAuthenticated,
        component: () => import('../components/auth/Login.vue'),
    },
    {
        path: "/dashboard",
        name: 'dashboard',
        beforeEnter: ifAuthenticated,
        component: () => import('../components/pages/Dashboard.vue'),
    },
    {
        path: "/kanban",
        name: 'kanban',
        beforeEnter: ifAuthenticated,
        component: () => import('../components/pages/Kanban.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router
