import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import SignIn from '../views/SignIn.vue'
import Users from '../views/Users.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/signin',
    name: 'signin',
    component: SignIn,
    meta: {
      isPublic: true, // Allow access even if not logged in
      onlyWhenLoggedOut: true
    }
  },
  {
    path: '/users',
    name: 'users',
    component: Users
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  const isPublic = to.matched.some(record => record.meta.isPublic)
  const onlyWhenLoggedOut = to.matched.some(record => record.meta.onlyWhenLoggedOut)
  const isLogged = localStorage.getItem('access_token')
  
  if (!isPublic && !isLogged) {
    console.log(isPublic)
    return next({ path: '/signin' });
  }

  if (isLogged && onlyWhenLoggedOut) {
    return next('/')
  }
  
  next();
})

export default router
