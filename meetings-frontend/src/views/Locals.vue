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
                        <span class="btn-span mr-3 text-primary" data-toggle="modal" data-target="#addNew" @click="editModal(local)">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span class="btn-span text-danger" @click="deleteLocal(local)">
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
            <h5 class="modal-title" id="addNewLabel">{{ !editMode ? 'Novo Local' : 'Editar Local' }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="!editMode ? createLocal() : updateLocal()">
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Descrição" autofocus required
                        v-model="form.name"
                    />
                </div>
                <h6>Salas</h6>
                <div class="form-group form-row">
                    <input type="text" name="room" class="form-control col-md-10 ml-1" placeholder="nova sala"
                        v-model="room.name" 
                    />
                    <a href="" class="pl-2" style="align-self: center;">
                        <span @click.prevent="addRoom">
                            <i class="fa fa-plus pr-1"></i>incluir
                        </span>
                    </a>
                </div>
                <ul v-show="rooms.length > 0">
                    <li v-for="room in rooms" :key="room.id">
                        {{ room.name }}
                        <span class="pl-1" @click="deleteRoom(room)">
                            <i class="fa fa-close text-danger"></i>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
              <button id="closeModal" type="button" class="btn btn-default" data-dismiss="modal" @click.prevent="rooms = []">Fechar</button>
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
    name: 'locals',
    data() {
        return {
            locals: [],
            form: {
                name: ''
            },
            rooms: [],
            room: {
                name: '',
                local_id: null
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
            this.rooms = local.rooms
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
        },
        addRoom() {
            this.room.local_id = this.form.id
        },
        /* deleteRoom(room) {

        } */
    }
}
</script>

<style scoped>
.btn-span {
    cursor: pointer;
}
.modal-body ul {
    list-style: none;
    max-height: 100px;
    padding: 0;
    overflow-y: auto;
}
.modal-body ul li {
    cursor: pointer;
    padding-left: 4px;
}
.modal-body ul li:hover {
    background-color: #eee;
}
</style>