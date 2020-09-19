<template>
  <div class="col-md-12">
    <form class="col-md-3 text-center m-auto" 
      @submit.prevent="submit"
    >
      <h2>Login</h2>
      <h4 class="h4 mb-3 font-weight-normal">Digite seus dados de acesso</h4>

      <label for="inputEmail" class="sr-only">
        Endereço de e-mail
      </label>
      <input type="email" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus
        v-model="form.email"
      />

      <label for="inputPassword" class="sr-only">
        Senha
      </label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required
        v-model="form.password"
      />

      <button class="btn btn-lg btn-primary btn-block" type="submit">
        Entrar
      </button>

      <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
    </form>
  </div>
</template>

<script>
export default {
  name: 'signin',
  components: {
    
  },
  data() {
    return {
      form: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    async submit() {
      let obj = this.form
      let res = this.$http.post('http://127.0.0.1:8000/api/auth/signin', obj)
      /* .then(({data}) => {
        console.log('res', data)
      }).catch((err) => {
        console.log(err)
      }); */
      console.log(res)
    }
  }
}
</script>
