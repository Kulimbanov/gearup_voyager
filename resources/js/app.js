
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

Vue.component('products', require('./components/Products').default);
Vue.component('services', require('./components/Services').default);
Vue.component('contact', require('./components/Contact').default);
Vue.component('search', require('./components/Search').default);
Vue.component('switch-mode', require('./components/SwitchMode').default);
Vue.component('featured-product', require('./components/Featured').default);
Vue.component('single-product', require('./components/SingleProduct').default);

Vue.component('device-menu', require('./components/nav/DeviceMenu').default);
Vue.component('auth-user', require('./components/nav/AuthUserLink').default);
Vue.component('verified', require('./components/auth/Verified').default);

library.add(faCog)
library.add(faCogs)
library.add(faDna)
library.add(faSpinner)

const router = new VueRouter({
    base: process.env.MIX_APP_API,
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
});//.$mount('app');
