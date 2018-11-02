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
// Vue.component('base-loading', require('./components/BaseLoading.vue'));
Vue.component('absence-create', require('./components/gestion-absence/AbsenceCreate.vue'));
Vue.component('professeur-edt', require('./components/professeurs/ProfesseurEmploiDuTemps.vue'));
Vue.component('eleves-inscrits-list', require('./components/ElevesInscritList.vue'));
Vue.component('matieres-enseigner', require('./components/MatieresEnseigner.vue'));
Vue.component('classe-edt', require('./components/ClasseEmploiDuTemps.vue'));
Vue.component('edt-today', require('./components/EmploiDuTempsToday.vue'));

const app = new Vue({
    el: '#vue-app'
});