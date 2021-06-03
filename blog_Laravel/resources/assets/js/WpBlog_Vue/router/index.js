//Defines routes. The links themselves are located in VueRouteMenu
//https://github.com/hayanisaid/Vue-router
import Vue from 'vue';
import Router from 'vue-router';
import home from '../components/pages/home';
import blog from '../components/pages/blog';

import services from '../components/pages/services';
import contact from  '../components/pages/contact';
import details from  '../components/pages/details';


Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',      //define URL route path. The links themselves are located in VueRouteMenu
      name: 'home',   //same name as in component return section
      component: home //component itself in '../components/pages/home'
    },
    {
      path: '/home',
      name: 'home',
      component: home
    },
    {
      path: '/blog',
      name: 'blog',
      component: blog
    },
	
    {
      path: '/services',
      name: 'services',
      component: services
    },
    {
      path: '/contact',
      name: 'contact',
      component: contact
    },
    {
      path: '/details/:Pid',
      name: 'details',
      component: details
    }
	
  ]
})