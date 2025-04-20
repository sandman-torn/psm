import './assets/main.css';
// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'jsvectormap/dist/jsvectormap.css';
import 'flatpickr/dist/flatpickr.css';

import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import VueApexCharts from 'vue3-apexcharts';
import axios from 'axios';
import useAuth from './composable/useAuth';
import useAuthPenganjur from './composable/useAuthPenganjur'
import useAuthPentadbir from './composable/useAuthPentadbir'

axios.defaults.baseURL = 'http://psm-b.test';
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;


const authRole = localStorage.getItem('authRole') // 'Peserta', 'Penganjur', 'Pentadbir'
let attemptPromise

if (authRole === 'Pentadbir') {
    const { attempt } = useAuthPentadbir()
    attemptPromise = attempt()
  } else if (authRole === 'Penganjur') {
    const { attempt } = useAuthPenganjur()
    attemptPromise = attempt()
  } else {
    const { attempt } = useAuth() // default Peserta
    attemptPromise = attempt()
  }
  
  const app = createApp(App);

// Proceed after session attempt check
attemptPromise.finally(() => {
    app.use(router)
    app.use(VueApexCharts)
    app.mount('#app')
  })