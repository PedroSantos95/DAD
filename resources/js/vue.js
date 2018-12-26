/*jshint esversion: 6 */

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

const user = Vue.component('user', require('./components/User.vue'));
const userList = Vue.component('user-list', require('./components/userList.vue'));
const userEdit = Vue.component('user-edit', require('./components/userEdit.vue'));
const userAdd = Vue.component('user-add', require('./components/userAdd.vue'));

const shift = Vue.component('shift',require('./components/shift.vue'));

const item = Vue.component('item', require('./components/item.vue'));
const itemList = Vue.component('item-list', require('./components/itemList.vue'));
const itemEdit = Vue.component('item-edit', require('./components/itemEdit.vue'));
const itemAdd = Vue.component('item-add', require('./components/itemAdd.vue'));

const meal = Vue.component('meal', require('./components/meal.vue'));
const mealList = Vue.component('meal-list', require('./components/mealList.vue'));

const order = Vue.component('order', require('./components/order.vue'));
const orderList = Vue.component('order-list', require('./components/orderList.vue'));

const profile = Vue.component('profile', require('./components/profile.vue'));
const login = Vue.component('login', require('./components/login.vue'));
const logout = Vue.component('logout', require('./components/logout.vue'));

const invoice = Vue.component('invoice', require('./components/invoice.vue'));
const invoiceList = Vue.component('invoice-list', require('./components/invoiceList.vue'));
const invoiceShow = Vue.component('invoice-show', require('./components/invoiceShow.vue'));

const routes = [
  { path: '/', redirect: '/items' },
  { path: '/users', component: user },
  { path: '/users/:id', component: userEdit},
  { path: '/users/new/user', component: userAdd},

  {path:'/shift',component:shift ,name:'shift'},

  { path: '/items', component: item },
  { path: '/items/new/item', component: itemAdd },
  { path: '/items/:id', component: itemEdit },

  { path: '/meals', component: meal },
  { path: '/profile', component: profile, name: 'profile'},
  { path: '/login', component: login, name: 'login'},
  { path: '/logout', component: logout, name: 'logout'},
  
  { path: '/orders', component: order },

  { path: '/invoices', component: invoice },
  { path: '/invoices/:id', component: invoiceShow },
];

const router = new VueRouter({
  routes:routes
});

router.beforeEach((to, from, next) => {
    if ((to.name == 'profile') || (to.name == 'logout')) {
        store.commit('loadTokenAndUserFromSession');
        
        if (!store.state.user) {
            console.log(store.state.user);
            next("/login");
            return;
        }
    }
    next();
});

const app = new Vue({
	router,
	data:{
        items: [],
        users: [],
        meals: [],
        invoices:[],
        meals: [],
        orders: []
	}
}).$mount('#app');

