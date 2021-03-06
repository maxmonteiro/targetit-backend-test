import Vue from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import config from './config.js'

Vue.config.productionTip = false

// Set the base url
const baseURL = config.API_URL;
axios.defaults.baseURL = baseURL;

// Set header if token exists
if (localStorage.getItem('access_token')) {
  axios.defaults.headers.common.Authorization = 'Bearer ' + localStorage.getItem('access_token')
} else {
  axios.defaults.headers.common = {}
}

window.axios = axios;

Vue.prototype.$user = {}
Vue.prototype.$eventHub = new Vue();

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
