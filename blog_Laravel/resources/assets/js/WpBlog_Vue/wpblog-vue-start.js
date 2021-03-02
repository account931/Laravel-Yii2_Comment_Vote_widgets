
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap'); //otherwise Bootstrap collapsed menu won't work (bootstrap.js included 2 times)

window.Vue = require('vue');



// Blog
//window.Vue = require('vue');
import store from '../store/index';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);


//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('create-post', require('./components/CreatePost.vue').default);
Vue.component('all-posts', require('./components/AllPosts.vue')/*.default*/);

// Blog





/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


//Form
const app = new Vue({
	store,
    el: '#createPost'
});



//Blog, Dispaly all posts
const app2 = new Vue({
	store, //must-have
    el: '#app2'
});