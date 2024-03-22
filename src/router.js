import { createRouter, createWebHistory } from 'vue-router'
import UserDetail from './UserDetail.vue'
import Users from './Users.vue'
import Form from './Form.vue'
import ModifyUser from './components/ModifyUser.vue'

const routes = [
  { path: '/', name: 'home', component: Users },
  { path: '/user/:id', name: 'userDetail', component: UserDetail },
  { path: '/register ', name: 'register', component: Form },
  { path: '/modify/:id ', name: 'modify', component: ModifyUser }

]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
