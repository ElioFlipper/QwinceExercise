import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createRouter, createWebHistory } from 'vue-router'

createApp(App).use(router).mount('#app')
