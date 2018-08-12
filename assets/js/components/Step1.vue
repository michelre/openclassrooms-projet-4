<template>
  <div>
    <h1>Vos billets</h1>
    <hr/>
    <div>
      <div class="form-group">
        <label>Nombre de places:</label>
        <div>
          <input class="form-control" type="number" v-model="reservation.nbPlaces" @change="onDataChange"/>
        </div>
      </div>
      <div class="form-group">
        <label>Date:</label>
        <div class="d-flex align-items-center">
          <input type="date" class="form-control" v-model="reservation.visitDate" @change="onDataChange"/>
        </div>
      </div>
      <div class="form-group">
        <label>Demi-journée:</label>
        <div class="d-flex align-items-center">
          <input type="checkbox" class="form-control" v-model="reservation.isHalf" />
        </div>
      </div>
      <button class="btn btn-primary mr-3"
              @click="clickNextAction()"
              v-bind:class="{disabled: !reservation.isDateAvailable}">Suivant
      </button>
      <i class="fas fa-spinner fa-spin" v-if="isCheckingAvailability"></i>
      <div class="alert alert-danger mt-2" v-if="showImpossibleAlert">
        Il n'est pas possible de réserver une entrée sur cette date.
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'Step1',
    props: {
      reservation: Object,
      isCheckingAvailability: Boolean,
      setIsDateAvailable: Function,
      setNbBillets: Function,
      navigateAction: Function,
      onDataChange: Function
    },
    computed: {
      showImpossibleAlert(){
        const { isDateAvailable, visitDate } = this.reservation
        return isDateAvailable !== null && !isDateAvailable && visitDate
      }
    },
    methods: {
      clickNextAction(){
        this.setNbBillets();
        this.navigateAction('Step2')
      }
    }
  }
</script>

<style lang="scss"></style>
