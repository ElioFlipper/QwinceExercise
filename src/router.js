// router.js

import { createRouter, createWebHistory } from 'vue-router'
import UserDetail from './UserDetail.vue'
import Users from './Users.vue'

const routes = [
  { path: '/', component: Users },
  { path: '/user/:id', name: 'userDetail', component: UserDetail }

]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
