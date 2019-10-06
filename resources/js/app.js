require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import axios from 'axios';


import { Form, HasError, AlertError } from 'vform';
window.Form = Form;

import swal from 'sweetalert2';
window.swal = swal;

const Toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000
});
window.Toast = Toast;


Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css';
Vue.use(VueGoodTablePlugin);

let routes = [
    { name:'Domain',
      path: '/domain', 
      component: require('./components/Domain.vue').default },

    { name:'Market',
      path: '/market', 
      component: require('./components/Market.vue').default },     
    { 
      name:'Server',
      path: '/server', 
      component: require('./components/Server.vue').default },
      { 
        name:'Payment',
        path: '/payment', 
        component: require('./components/Payment.vue').default }
  ]

const router = new VueRouter({
    mode:'history',
    linkExactActiveClass: 'active',
    routes 
  })

const app = new Vue({
    el: '#app',
    router,
});
