
require('./bootstrap');

window.Vue = require('vue');

import "tailwindcss/tailwind.css"
import Vue from "vue";
Vue.component('main-component', require('./Main.vue').default);
Vue.use(require("bridge-vue-notification"));


import router from "./router";

window.Event = new Vue();
const app = new Vue({
    router,
    el: '#app',
});
