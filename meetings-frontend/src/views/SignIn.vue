<template>
  <div class="col-md-12">
    <form class="col-lg-4 col-md-8 text-center m-auto" 
      @submit.prevent="submit"
    >
      <div class="form-header text-center">
        <h5>Login</h5>
        <p class="mb-3 font-weight-normal">Digite seus dados de acesso</p>
      </div>

      <div class="form-group">
        <input type="email" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus
          v-model="form.email"
        />
      </div>
      
      <div class="form-group">
        <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required
          v-model="form.password"
        />
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">
        Entrar
      </button>
      <p v-show="showError" class="mt-2 text-danger">E-mail/senha inválidos</p>
      <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'signin',
  data() {
    return {
      form: {
        email: '',
        password: ''
      },
      showError: false
    }
  },
  methods: {
    submit() {
      var app = this
      let obj = this.form
      axios.post('api/auth/signin', obj)
      .then(({data}) => {
        // Save token
        localStorage.setItem('access_token', data.token)
        // Set header
        axios.defaults.headers.common["Authorization"] = 'Bearer ' + data.token
        axios.get('api/auth/me')
        .then(({data}) => {
            console.log('user', data)
            localStorage.setItem('user_name', data.data.name)
            this.$eventHub.$emit('logged-in')
        }).catch((err) => {
            console.log(err)
        });
        setTimeout(function() {
          app.$router.push('/')
          location.reload();
        }, 600)
      }).catch((err) => {
        console.log(err)
        this.showError = true
      });
    }
  }
}
</script>

<style scoped>
form {
  margin-top: 100px !important;
}
</style>