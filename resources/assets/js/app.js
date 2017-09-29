
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


/**
 * Custom Vue Components
 */
Vue.component('example', require('./components/Example.vue'));
Vue.component('weathertext-phone-input', require('./components/WeatherText/PhoneInput.vue'));
Vue.component('numeric-input', require('./components/NumericInput.vue'));
Vue.component('failed-phone-verification', require('./components/PhoneVerificationSendFailed.vue'));
Vue.component('character-inputs', require('./components/ThronesSearcher/CharacterInputs.vue'));




const app = new Vue({
    el: '#app'
});
