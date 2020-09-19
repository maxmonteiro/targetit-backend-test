<template>
  <div class="col-md-12">
    <h2>Locais</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="local in locals" :key="local.id">
                    <th scope="row">{{ local.id }}</th>
                    <td>{{ local.name }}</td>
                    <td>
                        <span class="btn-span mr-3 text-primary" data-toggle="modal" data-target="#addNew" @click="editModal(user)">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span class="btn-span text-danger" @click="deleteLocal(user)">
                            <i class="fa fa-close"></i>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <button class="btn btn-primary" data-toggle="modal" data-target="#addNew" @click.prevent="newModal">
        <span><i class="fa fa-plus pr-2"></i></span>
        Novo local
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewLabel">{{ !editMode ? 'Novo Usuário' : 'Editar Usuário' }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="!editMode ? createUser() : updateUser()">
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Nome completo" autofocus required
                        v-model="form.name"
                    />
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="E-mail" required
                        v-model="form.email"
                    />
                </div>
                <div v-show="!editMode" class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Senha"
                        v-model="form.password"
                    />
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="(86)99999-9999"
                        v-model="form.phone"
                    />
                </div>
                <div class="form-group">
                    <select type="text" name="sector_id" class="form-control"
                        v-model="form.sector_id"
                    >
                      <option value="">Selecione um setor</option>
                      <option v-for="sector in sectors" :key="sector.id" :value="sector.id">{{ sector.name }}</option>
                    </select>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="master" id="exampleRadios1" value="1"
                        v-model="form.master"
                    />
                    <label class="form-check-label" for="master">
                        Usuário MASTER
                    </label>
                </div>
            </div>
            <div class="modal-footer">
              <button id="closeModal" type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
  </div>
</template>
<script>
import axios from 'axios'
export default {
    name: 'users',
    data() {
        return {
            locals: [],
            form: {
                name: ''
            },
            showModal: false,
            editMode: false
        }
    },
    mounted() {
        this.getLocals()
    },
    methods: {
        getLocals() {
            axios.get('api/locals')
            .then(({data}) => {
                this.locals = data.data
            }).catch((err) => {
                console.log(err)
            });
        },
        newModal() {
            this.editMode = false
            this.form = {
                name: ''
            }
            this.showModal = true
        },
        editModal(local) {
            this.editMode = true;
            this.form = {
                name: ''
            }
            this.form = local
        },
        createLocal() {
            let obj = this.form
            axios.post('api/locals', obj)
            .then(({data}) => {
                console.log('gravado', data)
                this.locals.push(data.data)
                document.getElementById("closeModal").click()
            }).catch((err) => {
                console.log(err)
            });
        },
        updateLocal() {
            let obj = this.form
            axios.put('api/locals/' + obj.id, obj)
            .then(({data}) => {
                console.log('atualizado', data)
                document.getElementById("closeModal").click()
            }).catch((err) => {
                console.log(err)
            });
        },
        deleteLocal(local) {
            axios.delete('api/locals/' + local.id)
            .then(({data}) => {
                console.log('excluido', data)
                this.locals.splice(this.locals.indexOf(local), 1)
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