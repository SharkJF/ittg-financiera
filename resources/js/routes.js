import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '@/js/stores';

import Home from '@/js/components/Home';
import About from '@/js/pages/About';
import Login from '@/js/pages/LoginPage';
import View from '@/js/views/View';
import Clients from '@/js/pages/Clients';
import Loans from '@/js/pages/Loans';
import Payments from '@/js/pages/Payments';
import abonoView from '@/js/components/abonoView';


Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '',
            component: View,
            children: [
                {
                    path: '/',
                    name: 'home',
                    component: Home
                },
                {
                    path: '/about',
                    name: 'about',
                    component: About
                },
                {
                    path: '/clients',
                    name: 'clients',
                    component: Clients
                },
                {
                    path: '/clients/show',
                    name: 'clientsShow',
                    component: Clients
                },
                {
                    path: '/loans',
                    name: 'loans',
                    component: Loans
                },
                {
                    path: '/payments',
                    name: 'payments',
                    component: Payments
                },
                {
                    path: '/payments/:id',
                    name: 'abonoView',
                    component: abonoView
                },
            ]
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        }
    ]
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = store.state.isAuthenticated;
    if (to.name !== 'login' && !isAuthenticated) next({ name: 'login'});
    else if (to.name === 'login' && isAuthenticated) next({ name: 'home' });
    else next();
});

export default router;
