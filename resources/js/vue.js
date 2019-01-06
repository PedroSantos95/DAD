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

import store from './stores/global-store';

const user = Vue.component('user', require('./components/User.vue'));
const userList = Vue.component('user-list', require('./components/userList.vue'));
const userEdit = Vue.component('user-edit', require('./components/userEdit.vue'));
const userAdd = Vue.component('user-add', require('./components/userAdd.vue'));

const shift = Vue.component('shift',require('./components/shift.vue'));

const item = Vue.component('item', require('./components/items/item.vue'));
const itemList = Vue.component('item-list', require('./components/items/itemList.vue'));
const itemEdit = Vue.component('item-edit', require('./components/items/itemEdit.vue'));
const itemAdd = Vue.component('item-add', require('./components/items/itemAdd.vue'));

const meal = Vue.component('meal', require('./components/meals/meal.vue'));
const mealList = Vue.component('meal-list', require('./components/meals/mealList.vue'));
const mealStart = Vue.component('meal-start', require('./components/meals/mealStart.vue'));
const mealInfo = Vue.component('meal-info', require('./components/meals/mealInfo.vue'));

const order = Vue.component('order', require('./components/orders/order.vue'));
const orderList = Vue.component('order-list', require('./components/orders/orderList.vue'));
const orderAdd = Vue.component('order-add', require('./components/orders/orderAdd.vue'));

const profile = Vue.component('profile', require('./components/profile.vue'));
const changePass = Vue.component('changePass', require('./components/changePass.vue'));

const login = Vue.component('login', require('./components/auth/login.vue'));
const logout = Vue.component('logout', require('./components/auth/logout.vue'));

const invoice = Vue.component('invoice', require('./components/invoices/invoice.vue'));
const invoiceList = Vue.component('invoice-list', require('./components/invoices/invoiceList.vue'));
const invoiceInfo = Vue.component('invoice-info', require('./components/invoices/invoiceInfo.vue'));
const invoiceEnd = Vue.component('end-invoice', require('./components/invoices/invoiceEnd'));

const r_tables = Vue.component('tables', require('./components/tables/restaurantTables.vue'));
const r_tablesList = Vue.component('tables-list', require('./components/tables/restaurantTablesList.vue'));
const r_tablesAdd = Vue.component('tables-add', require('./components/tables/restaurantTablesAdd.vue'));
const r_tablesShow = Vue.component('tables-show', require('./components/tables/restaurantTablesShow.vue'));
const r_tablesEdit = Vue.component('tables-edit', require('./components/tables/restaurantTablesEdit.vue'));



const routes = [
  { path: '/', redirect: '/items' },
  { path: '/users', component: user },
  { path: '/users/:id', component: userEdit},
  { path: '/users/new/user', component: userAdd},
  { path: '/changePass', component: changePass },

  { path:'/shift',component:shift ,name:'shift'},

  { path: '/items', component: item },
  { path: '/items/new/item', component: itemAdd },
  { path: '/items/:id', component: itemEdit },

  { path: '/meals', component: meal },
  { path: '/meals/:id',component: mealInfo },
  { path: '/meals/start',component: mealStart },

  { path: '/profile', component: profile, name: 'profile'},
  { path: '/login', component: login, name: 'login'},
  { path: '/logout', component: logout, name: 'logout'},

  { path: '/orders', component: order },
  { path: '/orders/new/order', component: orderAdd },

  { path: '/invoices', component: invoice },
  { path: '/invoices/info', component: invoiceInfo },
  { path: '/invoices/:id' , component: invoiceEnd},

  { path: '/restaurantTables', component: r_tables },
  { path: '/restaurantTables/add', component: r_tablesAdd },
  { path: '/restaurantTables/show/:table_number', component: r_tablesShow },
  { path: '/restaurantTables/edit/:table_number', component: r_tablesEdit }
];

const router = new VueRouter({
  routes:routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.loggedIn) {
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
	},
  store
}).$mount('#app');

