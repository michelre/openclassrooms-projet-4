<template>
  <div>
    <component
      :is="currentStep"
      :setIsDateAvailable="setIsDateAvailable"
      :setNbBillets="setNbBillets"
      :recap="recap"
      :reservation="reservation"
      :isCheckingAvailability="isCheckingAvailability"
      :changeVisitorTarif="changeVisitorTarif"
      :navigateAction="navigateAction"
      :onDataChange="onDataChange"
      :submitReservation="submitReservation"
    ></component>
  </div>
</template>

<script>
  import dayjs from 'dayjs'
  import axios from 'axios'
  import Step1 from "./Step1.vue";
  import Step2 from "./Step2.vue";
  import Step3 from "./Step3.vue";
  import Step4 from "./Step4.vue";

  export default {
    components: {
      Step4,
      Step3,
      Step2,
      Step1
    },
    name: 'App',
    created() {
      axios.get('/api/tarifs').then(({ data: tarifs }) => {
        this.tarifs = tarifs
        this.reservation = {...this.reservation, visitors: [this.createVisitor()]}
      })
    },
    data() {
      return {
        reservation: {nbPlaces: 1, visitDate: null, visitors: [], isDateAvailable: null, isHalf: false},
        isDateAvailable: true,
        nbBillets: 1,
        tarifs: [],
        currentStep: 'Step1',
        isCheckingAvailability: null,
        recap: {}
      }
    },
    methods: {
      getTarif(visitor) {
        if (visitor.isHalf) {
          return this.tarifs.find(t => t.name === 'réduit');
        }
        const age = dayjs().diff(visitor.birthdate, 'year')
        if (age >= 0 && age < 4) {
          return this.tarifs.find(t => t.name === 'gratuit');
        }
        if (age >= 5 && age < 12) {
          return this.tarifs.find(t => t.name === 'enfant');
        }
        if (age >= 12 && age < 60) {
          return this.tarifs.find(t => t.name === 'normal');
        }
        if (age >= 60) {
          return this.tarifs.find(t => t.name === 'senior');
        }
      },
      createVisitor() {
        const v = {fullName: '', country: 'fr', birthdate: dayjs().format('YYYY-MM-DD'), isHalf: false}
        return {...v, tarif: this.getTarif(v)}
      },
      setIsDateAvailable(isDateAvailable) {
        this.isDateAvailable = isDateAvailable
      },
      setNbBillets() {
        const visitors = Array.apply(null, {length: this.reservation.nbPlaces}).map(() => this.createVisitor())
        this.reservation = {...this.reservation, visitors}
      },
      changeVisitorTarif(visitorIndex) {
        const visitors = this.reservation.visitors.map((v, i) => {
          const tarif = this.getTarif(v)
          return (i === visitorIndex) ? {...v, tarif} : v
        });
        this.reservation = {...this.reservation, visitors}
      },
      onDataChange(e) {
        this.isCheckingAvailability = true
        axios.get(`/api/reservation/available?date=${this.reservation.visitDate}&nbPlaces=${this.reservation.nbPlaces}`).then(({data}) => {
          this.reservation.isDateAvailable = data.isDateAvailable
          this.setIsDateAvailable(data.isDateAvailable)
          this.isCheckingAvailability = false
        });
      },
      navigateAction(nextStep) {
        this.currentStep = nextStep
      },
      submitReservation(){
        axios.post('/api/reservation', this.reservation).then((d) => {
          this.currentStep = 'Step4'
          this.recap = d.data
        })
      }
    }
  }
</script>

<style lang="scss"></style>
