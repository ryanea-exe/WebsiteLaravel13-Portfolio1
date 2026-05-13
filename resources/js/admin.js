// import './bootstrap';

import { createApp } from 'vue';
import Swal from 'sweetalert2';

window.Swal = Swal
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
});
window.toast = toast

import router from './router';
import admin from './components/Admin.vue'

createApp(admin).use(router).mount('#admin')