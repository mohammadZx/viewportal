const Vue = require('vue')
const axios = require('axios')
window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.component('sendquestionform', require('./Components/sendquestion.vue').default);

const vue = new Vue({
    el: "#question-from",
})