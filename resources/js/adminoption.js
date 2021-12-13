const Vue = require('vue')
const axios = require('axios')
import VueMyValidation from './vue-validate-my.js';
window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.component('varc', require('./Components/variableManagement.vue').default);
Vue.component('typec', require('./Components/typemanagement.vue').default);
Vue.use(VueMyValidation);
const vue = new Vue({
    el: "#edit-option",

})