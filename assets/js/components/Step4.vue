<template>
  <div>
    <h1>Merci pour votre réservation</h1>
    <hr/>
    <p>Votre réservation <b>{{recap.reservation.code}}</b> d'un montant de {{recap.total}}€ a bien été enregistrée</p>
    <button
      class="btn btn-primary"
      v-if="!isPayed"
      @click="clickPayAction"
    >Payer
    </button>
    <div
      class="alert alert-success"
      v-if="isPayed"
    >Merci pour votre paiement. Vous allez recevoir un mail récapitulatif</div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'Step3',
    props: {
      recap: Object,
    },
    data() {
      return {
        isPayed: false,
      }
    },
    methods: {
      clickPayAction() {
        this.$checkout.open({
          name: 'Payer vos billets',
          currency: 'EUR',
          amount: this.recap.total * 100,
          token: (token) => {
            if(token){
              axios.put(`/api/reservation/${this.recap.reservation.code}/pay`).then(() => {
                this.isPayed = true
              })
            }
          }
        })
      }
    }
  }
</script>

<style lang="scss"></style>
