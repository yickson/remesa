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
import Notifications from 'vue-notification';
import VueCurrencyFilter from 'vue-currency-filter';
import VeeValidate, { Validator } from 'vee-validate';
import es from 'vee-validate/dist/locale/es';

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import VueSweetalert2 from 'vue-sweetalert2';
import RateComponent from "./components/RateComponent";
import RateNowComponent from "./components/RateNowComponent";
import ContactComponent from "./components/ContactComponent";
//Import Admin
import BankAccountComponent from "./components/admin/BankAccountComponent";
import DemandComponent from "./components/admin/DemandComponent";
//Import MicroComponents
import ErrorsValidateComponent from "./components/microComponents/ErrorsValidate";
Vue.component('errors-validate-component', ErrorsValidateComponent)
Vue.component('rate-component', RateComponent);
Vue.component('rate-now-component', RateNowComponent);
Vue.component('contact-component', ContactComponent);
//Component Administrator
Vue.component('bank-account-component', BankAccountComponent);
Vue.component('demand-component', DemandComponent);

Vue.use(BootstrapVue);
Vue.use(VeeValidate);
Validator.localize("es", es);
Vue.use(Notifications);
Vue.use(VueSweetalert2);
Vue.use(VueCurrencyFilter, {
      symbol: 'BsS',
      thousandsSeparator: '.',
      fractionCount: 2,
      fractionSeparator: ',',
      symbolPosition: '',
      symbolSpacing: true
   });

const app = new Vue({
    el: '#app',
});
