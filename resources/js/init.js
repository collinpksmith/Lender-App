import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import { ValidationObserver, ValidationProvider } from 'vee-validate';
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueSweetalert2);

Vue.component('validation-observer', ValidationObserver);
Vue.component('validation-provider', ValidationProvider);
