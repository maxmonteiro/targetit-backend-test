<template>
  <div class="col-md-12">
    <h2>Agendamentos</h2>

    <div class="card mb-4" style="width: 18rem; background-color: #9b59b6;"
      
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
          @closed="getSchedulings"
        ></datepicker>
        <button class="bg-light text-primary" data-toggle="modal" data-target="#addNew" @click="newScheduling">
          <i class="fa fa-plus"></i> Novo
        </button>
      </div>
    </div>

    <div class="list-group col-md-8">
      <ul class="list-group list-group-flush">
        <li v-for="scheduling in schedulings" :key="scheduling.id" class="list-group-item d-flex pb-1 rounded">
          <p>{{ scheduling.time_start | formatTime }} às {{ scheduling.time_end | formatTime }}</p>
          <p class="ml-4">{{ scheduling.room.local.name }}</p>
          <p class="ml-4 pr-2">{{ scheduling.room.name }}</p>
          <span class="span-remove position-absolute pr-3" style="right: 0px; color: gray;" @click.stop="deleteScheduling(scheduling)">
            <i class="fa fa-close"></i>
          </span>
        </li>
      </ul>
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
                <div class="form-group col-md">
                  <label for="">Local</label>
                  <select type="text" name="local_id" class="form-control"
                    v-model="selectedLocal"
                    @change="getRooms"
                  >
                    <option value="">Selecione o local</option>
                    <option v-for="local in locals" :key="local.id" :value="local.id">{{ local.name }}</option>
                  </select>
                </div>
                <div class="form-group col-md">
                  <label for="">Sala</label>
                  <select type="text" name="room_id" class="form-control"
                    v-model="form.room_id"
                  >
                    <option value="">Selecione uma sala</option>
                    <option v-for="room in rooms" :key="room.id" :value="room.id">{{ room.name }}</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="">Duração</label>
                  <select type="text" name="" class="form-control"
                    v-model="selectedDuration"
                  >
                    <option value="30">30 minutos</option>
                    <option value="60">1 hora</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="">Hora de início</label>
                  <select type="text" name="time_start" class="form-control"
                    v-model="form.time_start"
                    @change="setTimeEnd"
                  >
                    <option v-for="(time, index) in timeRange" :key="index" :value="time">{{ time | formatTime }}</option>
                  </select>
                </div>
            </div>
            <div class="modal-footer">
              <button id="closeModal" type="button" class="btn btn-default" data-dismiss="modal" @click="resetForm">Fechar</button>
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
    Datepicker,
  },
  data() {
    return {
      user: {},
      ptBR: ptBR,
      date: '',
      locals: [],
      rooms: [],
      schedulings: [],
      selectedLocal: '',
      selectedDuration: '30',
      form: {
        date_scheduling: '',
        time_start: '',
        time_end: '',
        room_id: '',
        user_id: null
      },
      timeRange: [],
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
    },
    formatTime: (val) => {
      return val.substring(0,5)
    }
  },
  mounted() {
    var dateToday = new Date()
    this.date = dateToday
    this.setTimeRange()
    this.getSchedulings()
    this.getLocals()
    this.getUser()
  },
  methods: {
    setTimeRange() {
      for (var i = 1; i < 24; i++) {
        var time = ''
        if (i < 10) {
          time = '0' + i + ':00:00'
        } else {
          time = i + ':00:00'
        }
        this.timeRange.push(time)
      }
    },
    getUser() {
        axios.get('api/auth/me')
        .then(({data}) => {
            this.user = data.data
            this.form.user_id = data.data.id
        }).catch((err) => {
            console.log(err)
        });
    },
    getSchedulings() {
      let newDate = moment(this.date).format('Y-MM-DD')
      let obj = { date_scheduling: newDate }
      axios.post('api/schedulings/date', obj)
      .then(({data}) => {
        this.schedulings = data.data
      }).catch((err) => {
        console.log(err)
      });
    },
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
    resetForm() {
      this.form.time_start = ''
      this.form.time_end = ''
      this.form.room_id = ''
    },
    newScheduling() {
      console.log('novo agendamento')
      this.editMode = false
      this.showModal = true
      // Removendo da lista de horários os horários agendados
      if (this.schedulings.length > 0) {
        this.schedulings.map(value => {
          this.timeRange.splice(this.timeRange.indexOf(value.time_start), 1)
        })
      }
      // Setando data no formulário
      this.form.date_scheduling = moment(this.date).format('Y-MM-DD')
    },
    setTimeEnd() {
      let duration = parseInt(this.selectedDuration)
      let time_total = moment(moment(this.date).format('Y-MM-DD') + ' ' + this.form.time_start).add(duration, 'minutes').format('HH:mm:ss')
      this.form.time_end = time_total
      console.log(duration)
    },
    createScheduling() {
      let scheduling = this.form
      axios.post('api/schedulings', scheduling)
      .then(({data}) => {
        console.log(data.data)
        if ('message' in data.data) {
          alert(data.data.message)
        } else {
          axios.get('api/schedulings/' + data.data.id)
          .then(({data}) => {
            this.schedulings.push(data.data)
          }).catch((err) => {
            console.log(err)
          });
        }        
        document.getElementById("closeModal").click()
      }).catch((err) => {
        console.log(err)
      });
    },
    updateScheduling() {

    },
    deleteScheduling(scheduling) {
      axios.delete('api/schedulings/' + scheduling.id)
      .then(({data}) => {
          console.log('excluido', data)
          this.schedulings.splice(this.schedulings.indexOf(scheduling), 1)
      }).catch((err) => {
          console.log(err)
      });
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
.list-group li {
  cursor: pointer;
  border: 1px solid #fff;
  transition: border 300ms;
}
.list-group li:hover {
  border: 1px solid #ccc;
}
</style>