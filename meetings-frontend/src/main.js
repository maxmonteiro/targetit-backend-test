import Vue from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
//import { HTTP } from './http-common';

Vue.config.productionTip = false

const axiosBase = axios.create({
  baseURL: 'http://127.0.0.1:8000/',
  headers: {
    Authorization: 'Bearer ' + localStorage.getItem('access_token')
  }
})

Vue.prototype.$http = axiosBase;
Vue.prototype.$loggedUser = {};

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
