/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');

require('./bootstrap');
require('./custom');
require('./textwriting');


Vue.component('example', require('./components/Example.vue'));
Vue.component('absence-create', require('./components/gestion-absence/AbsenceCreate.vue'));

const app = new Vue({
    el: '#vue-app'
});