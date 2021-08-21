/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import {routes} from './routes';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {faCog, faCogs, faDna, faSpinner} from '@fortawesome/free-solid-svg-icons'
import {library} from "@fortawesome/fontawesome-svg-core";


Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false
Vue.prototype.$http = axios

var VueCookie = require('vue-cookie');
Vue.use(VueCookie);
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('products', require('./components/Products').default);
Vue.component('services', require('./components/Services').default);
Vue.component('contact', require('./components/Contact').default);
Vue.component('search', require('./components/Search').default);
Vue.component('switch-mode', require('./components/SwitchMode').default);

library.add(faCog)
library.add(faCogs)
library.add(faDna)
library.add(faSpinner)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const router = new VueRouter({
    base: process.env.MIX_APP_API,
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
});//.$mount('app');
