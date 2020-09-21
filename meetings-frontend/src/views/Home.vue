<template>
  <div>
    <h2>Agendamentos</h2>

    <div class="card" style="width: 18rem; background-color: #9b59b6;"
      
    >
      <div class="card-body">
        <h5 class="card-title text-light">{{ date | dayWeek }}</h5>
        <p class="card-text text-light" @click="openDatepicker">
          {{ date | formatDate }} <i class="fa fa-calendar pl-2"></i>
        </p>
        <datepicker 
          ref="datepicker" 
          v-model="date" 
          :language="ptBR"
        ></datepicker>
        <button class="bg-light text-primary" data-toggle="modal" data-target="#addNew" @click="newScheduling">
          <i class="fa fa-plus"></i> Novo
        </button>
      </div>
    </div>

    <!-- Modal agendamento -->
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
            <h5 class="modal-title" id="addNewLabel">{{ !editMode ? 'Novo Agendamento' : 'Editar Agendamento' }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="!editMode ? createScheduling() : updateScheduling()">
            <div class="modal-body">
                <label for="">Local</label>
                <div class="form-group">
                    <select type="text" name="local_id" class="form-control"
                      v-model="selectedLocal"
                      @change="getRooms"
                    >
                      <option value="">Selecione o local</option>
                      <option v-for="local in locals" :key="local.id" :value="local.id">{{ local.name }}</option>
                    </select>
                </div>
                <label for="">Sala</label>
                <div class="form-group">
                    <select type="text" name="room_id" class="form-control">
                      <option value="">Selecione uma sala</option>
                      <option v-for="room in rooms" :key="room.id" :value="room.id">{{ room.name }}</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button id="closeModal" type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div><!-- ./Modal agendamento -->

  </div>
</template>

<script>
import axios from 'axios'
import Datepicker from 'vuejs-datepicker'
import { ptBR } from 'vuejs-datepicker/dist/locale'
import moment from 'moment'
export default {
  name: 'Home',
  components: {
    Datepicker
  },
  data() {
    return {
      ptBR: ptBR,
      date: '',
      locals: [],
      selectedLocal: '',
      rooms: [],
      form: {
        
      },
      editMode: false,
    }
  },
  filters: {
    formatDate: (val) => {
      var date = new Date(val)
      return moment(date).locale('pt-br').format('D MMMM')
    },
    dayWeek: (val) => {
      var date = new Date(val)
      return moment(date).locale('pt-br').format('dddd')
    }
  },
  mounted() {
    var dateToday = new Date()
    this.date = dateToday

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
    getRooms() {
      let local = this.locals.find(elem => {
        return elem.id == this.selectedLocal
      })
      this.rooms = local.rooms
    },
    openDatepicker() {
      this.$refs.datepicker.showCalendar()
    },
    newScheduling() {
      console.log('novo agendamento')
      this.editMode = false
      this.showModal = true
    },
    createScheduling() {

    },
    updateScheduling() {

    }
  }
}
</script>

<style scoped>
.card {
  box-shadow: 0px 3px 11px -1px rgba(125,125,125,1);
}
.card-body p {
  cursor: pointer;
  width: fit-content;
  font-size: 22px;
}
.card-body button {
  position: absolute;
  right: 0px;
  padding: 4px 12px;
  font-size: 16px;
  border: none;
  border-radius: 500px;
  outline: none;
  box-shadow: 0px 3px 11px -1px rgba(125,125,125,1);
}
.vdp-datepicker >>> input {
  display: none;
}
</style>