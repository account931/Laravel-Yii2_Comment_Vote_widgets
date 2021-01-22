//Start point to mount Vue components (so far mount 2 components => test-ajax-component + list-of-rooms)
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 
/* 
import listOfRooms from './components/generateListOfRooms.vue';
const app = new Vue({
    el: '#appZ1',
    components: { listOfRooms } // Note!!!
});
*/





//Register Components
Vue.component('test-ajax-component',   require('./components/test-ajax.vue'));
Vue.component('list-of-rooms',       require('./components/generateListOfRooms.vue')); //my second component


const appSome = new Vue({
    el: '#appZ'
});

//it is for <list-o-frooms>
//is a must to register for each component
const appSome1 = new Vue({
    el: '#appZ1'
});

