//ENTRY POINT

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap'); //alerady included in views/layout/app.php. Otherwise Bootstrap collapsed menu won't work (bootstrap.js included 2 times)

window.Vue = require('vue');

//include Vue Router
//var VueRouter = require('vue-router');
//import Router from 'vue-router';
//import homeZ from './components/VueRouterMenu';
//import router from './router/index.js'


// Blog
//window.Vue = require('vue');
  import store from './store/index';//import store from '../store/index'; //import Vuex Store
//import ElementUI from 'element-ui'; //import ElementUI pop-up modal window
//import 'element-ui/lib/theme-chalk/index.css'; //moved as sepearate CSS Fileto css in /layout/app.php

//Vue.use(ElementUI); //connect Vue to use with ElementUI
//Vue.use(Router); //connect Vue to use with VueRouter


//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('captcha-component', require('./components/pages/captcha-div.vue')); //register component dispalying Captcha
//Vue.component('create-post',            require('./components/CreatePost.vue')/*.default*/);
//Vue.component('all-posts',              require('./components/AllPosts.vue')/*.default*/); //register component dispalying all posts

//vue-router-menu
//Vue.component('vue-router-menu-with-link-content-display',  require('./components/VueRouterMenu.vue')); //register component dispalying vue-router-menu






/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Component to Show div with Captcha
const appQuant = new Vue({
	store, //connect Vuex store, must-have
    el: '#captchaVue'
});


