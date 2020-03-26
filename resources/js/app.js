

require('./bootstrap');
require("../../node_modules/bootstrap-vue/dist/bootstrap-vue");

window.Vue = require('vue');

import VueRouter from 'vue-router';
import routes from "./routes";

const router = new VueRouter({
    routes
})

Vue.component('spinner', require('vue-simple-spinner'));

import App from './App.vue';

Vue.use(VueRouter);
Vue.use(BootstrapVue);
new Vue({
    router,
    render: h => h(App)
}).$mount('#app');
