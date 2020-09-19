<template>
  <div class="col-md-12">
    <h2>Usuários</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome completo</th>
                <th scope="col">Telefone</th>
                <th scope="col">E-mail</th>
                <th scope="col">Setor</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <th scope="row">{{ user.id }}</th>
                <td>{{ user.name }}</td>
                <td>{{ user.phone }}</td>
                <td>{{ user.email }}</td>
                <td>Setor A</td>
                <td>
                    <span class="btn-span mr-3 text-primary">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span class="btn-span text-danger">
                        <i class="fa fa-close"></i>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
    <button v-show="master" class="btn btn-primary">
        <span><i class="fa fa-plus"></i></span>
        Novo usuário
    </button>
  </div>
</template>

<script>
export default {
  name: 'users',
  data() {
    return {
        users: [],
        master: false
    }
  },
  mounted() {
      this.getUsers()
      this.checkUserMaster()
  },
  methods: {
      getUsers() {
          this.$http.get('api/users')
          .then(({data}) => {
              this.users = data.data
          }).catch((err) => {
              console.log(err)
          });
      },
      checkUserMaster() {
          this.$http.get('api/auth/me')
          .then(({data}) => {
              let user = data.data
              if (user.master) {
                  this.master = true
              }
          }).catch((err) => {
              console.log(err)
          });
      }
  }
}
</script>

<style scoped>
.btn-span {
    cursor: pointer;
}
</style>