require('./bootstrap');

import { createApp } from 'vue';

import AppLogin from './components/auth/App'

import { router } from './components/auth/router';

const app = createApp(AppLogin); 

app.use(router);

app.mount('#app-login');