<template>
  <div>
    <h1>Récapitulatif</h1>
    <hr/>
    <ul>
      <li>Vous avez commandé {{nbBilletsText}} pour le {{formatDate}}</li>
      <li v-if="hasHalfTarif">Certains de vos billets sont concernés par des tarifs réduits: <span class="font-weight-bold">pensez à vous munir des pièces justificatives</span></li>
      <li>Total de la réservation: {{totalReservation}}€</li>
    </ul>
    <hr />
    <div class="form-group">
      <label>Votre email:</label>
      <div>
        <input type="text" v-model="reservation.email" placeholder="foo@bar.com" class="form-control">
      </div>
    </div>
    <button class="btn btn-primary" @click="() => navigateAction('Step2')">Précédent</button>
    <button class="btn btn-success" @click="submitReservation">Valider la réservation</button>
  </div>
</template>

<script>
  import daysjs from 'dayjs'

  export default {
    name: 'Step3',
    props: {
      reservation: Object,
      navigateAction: Function,
      submitReservation: Function,
    },
    data() {
      return {}
    },
    computed: {
      hasHalfTarif() {
        return !!this.reservation.visitors.find(({isHalf}) => isHalf)
      },
      nbBilletsText(){
        return (this.reservation.nbPlaces > 1) ? `${this.reservation.nbPlaces} billets` : `${this.reservation.nbPlaces} billet`
      },
      formatDate(){
        return daysjs().format('DD/MM/YYYY')
      },
      totalReservation(){
        return this.reservation.visitors.reduce((acc, curr) => {
          console.log(curr.tarif)
          return acc + curr.tarif.price
        }, 0)
      }
    },
    methods: {}
  }
</script>

<style lang="scss"></style>
