import Vue from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
//import { HTTP } from './http-common';

Vue.config.productionTip = false

/* axios.create({
  baseURL: 'http://127.0.0.1:8000/',
  headers: {
    Authorization: 'Bearer {token}'
  }
}) */

Vue.prototype.$http = axios;

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
