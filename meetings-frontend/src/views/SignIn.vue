<template>
  <div class="col-md-12">
    <form class="col-md-4 text-center m-auto" 
      @submit="submit"
    >
      <img class="mb-4" src="/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Digite seus dados de acesso</h1>

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
    submit() {

    }
  }
}
</script>
