/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

// import FlipClock from 'flipclock';
import 'flipclock/dist/flipclock.css';

// vue-qrcode-reader
import VueQRCodeReader from 'vue-qrcode-reader';
import 'vue-qrcode-reader/dist/vue-qrcode-reader.css';

// font-awesome
import 'font-awesome/css/font-awesome.css';

// vue-iziToast 
import VueIziToast from "vue-izitoast";
import 'izitoast/dist/css/iziToast.min.css';

Vue.use(VueIziToast);
Vue.use(VueQRCodeReader);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-login', require('./components/Login/AdminLogin.vue').default);
Vue.component('user-login', require('./components/Login/UserLogin.vue').default);
Vue.component('download-file', require('./components/Register/DownloadFile.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
