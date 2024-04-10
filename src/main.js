import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createRouter, createWebHistory } from 'vue-router'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap/dist/js/bootstrap.js"
import "bootstrap"
import "bootstrap-icons/font/bootstrap-icons.css"
import './App.scss'


createApp(App).use(router).mount('#app')
