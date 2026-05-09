// import './bootstrap';

import { createApp } from 'vue';
import router from './router';
import admin from './components/Admin.vue'

createApp(admin).use(router).mount('#admin')