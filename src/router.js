import { createRouter, createWebHistory } from 'vue-router'
import UserDetail from './UserDetail.vue'
import Users from './Users.vue'
import ModifyUser from './ModifyUser.vue'
import PetsRegister from './PetsRegister.vue'
import PetsDetails from './PetsDetails.vue'
import RegisterUser from './RegisterUser.vue'

const routes = [
  { path: '/', name: 'home', component: Users },
  { path: '/user/:id', name: 'userDetail', component: UserDetail },
  { path: '/register ', name: 'register', component: RegisterUser },
  { path: '/modify/:id ', name: 'modify', component: ModifyUser },
  { path: '/:id/petsRegister ', name: 'petsRegister', component: PetsRegister },
  { path: '/:id/petsDetails', name: 'petsDetails', component: PetsDetails }
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
