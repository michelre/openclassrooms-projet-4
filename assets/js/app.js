import 'bootstrap/dist/js/bootstrap.bundle.js';
import 'bootstrap-datepicker';
import Vue from 'vue';
import App  from './components/App.vue';
import VueStripeCheckout from 'vue-stripe-checkout';


new Vue({
  el: '#app',
  template: '<App/>',
  components: { App }
});

const stripeOptions = {
  key: 'pk_test_kBwqpwPofT1iiMdyEFRHInZJ',
  locale: 'auto',
  currency: '€',
  billingAddress: true,
  panelLabel: 'Subscribe {{amount}}'
}

Vue.use(VueStripeCheckout, stripeOptions)


