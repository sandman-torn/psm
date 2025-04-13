import axios from 'axios';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import useAuth from './composable/useAuth';

axios.defaults.baseURL = 'http://sanctum-vue-api.test';
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const app = createApp(App);
const { attempt } = useAuth();

attempt().then(() => {
  app.use(router);
  app.mount('#app');
});
