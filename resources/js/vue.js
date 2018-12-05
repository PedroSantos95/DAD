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

const item = Vue.component('item', require('./components/item.vue'));
const itemList = Vue.component('item-list', require('./components/itemList.vue'));


const routes = [
  { path: '/', redirect: '/items' },
  //{ path: '/users', component: user },
  { path: '/items', component: item }

];

const router = new VueRouter({
  routes:routes
});

const app = new Vue({
	router,
	data:{

	}
}).$mount('#app');

