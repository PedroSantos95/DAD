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

const user = Vue.component('user', require('./components/user.vue'));
const userList = Vue.component('user-list', require('./components/userList.vue'));

const item = Vue.component('item', require('./components/item.vue'));
const itemList = Vue.component('item-list', require('./components/itemList.vue'));

const meal = Vue.component('meal', require('./components/meal.vue'));
const mealList = Vue.component('meal-list', require('./components/mealList.vue'));

const profile = Vue.component('profile', require('./components/profile.vue'));
const login = Vue.component('login', require('./components/login.vue'));
const logout = Vue.component('logout', require('./components/logout.vue'));


const routes = [
  { path: '/', redirect: '/items' },
  { path: '/users', component: user },
  { path: '/items', component: item },
  { path: '/orders', component: meal },
  { path: '/profile', component: profile, name: 'profile'},
  { path: '/login', component: login, name: 'login'},
  { path: '/logout', component: logout, name: 'logout'},

];

const router = new VueRouter({
  routes:routes
});

const app = new Vue({
	router,
	data:{
	}
}).$mount('#app');

