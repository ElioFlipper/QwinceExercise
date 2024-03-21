import { createRouter, createWebHistory } from 'vue-router'
import UserDetail from './UserDetail.vue'
import Users from './Users.vue'
import Form from './Form.vue'

const routes = [
  { path: '/', name: 'home', component: Users },
  { path: '/user/:id', name: 'userDetail', component: UserDetail },
  { path: '/register ', name: 'register', component: Form }

]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
