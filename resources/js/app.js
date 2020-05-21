/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import Notifications from 'vue-notification'
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import VueSweetalert2 from 'vue-sweetalert2';
import RateComponent from "./components/RateComponent";
import ContactComponent from "./components/ContactComponent";
//Import Admin
import BankAccountComponent from "./components/admin/BankAccountComponent";
Vue.component('rate-component', RateComponent);
Vue.component('contact-component', ContactComponent);
//Component Administrator
Vue.component('bank-account-component', BankAccountComponent)

Vue.use(BootstrapVue);
Vue.use(Notifications);
Vue.use(VueSweetalert2);

const app = new Vue({
    el: '#app',
});
