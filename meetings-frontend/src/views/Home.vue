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
        <button class="bg-light text-primary" @click.stop="newScheduling">
          <i class="fa fa-plus"></i> Novo
        </button>
      </div>
    </div>

  </div>
</template>

<script>
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
      date: ''
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
  },
  methods: {
    openDatepicker() {
      this.$refs.datepicker.showCalendar()
    },
    newScheduling() {
      console.log('novo agendamento')
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
  font-size: 18px;
  border: none;
  border-radius: 500px;
  outline: none;
  box-shadow: 0px 3px 11px -1px rgba(125,125,125,1);
}
.vdp-datepicker >>> input {
  display: none;
}
</style>