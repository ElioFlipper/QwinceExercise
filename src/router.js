import { createRouter, createWebHistory } from 'vue-router'
import UserDetail from './UserDetail.vue'
import Users from './Users.vue'
import ModifyUser from './ModifyUser.vue'
import PetsRegister from './PetsRegister.vue'
import PetsDetails from './PetsDetails.vue'
import RegisterUser from './RegisterUser.vue'
import Pets from './Pets.vue'
import Subscriptions from './Subscriptions.vue'
import ModifySubscriptions from './ModifySubscriptions.vue'
import AddSubscription from './AddSubscription.vue'
import AddSubToUser from './AddSubToUser.vue'
import SubscriptionsDetail from './SubscriptionsDetail.vue'

const routes = [
  { path: '/users', name: 'users', component: Users },
  { path: '/user/:id', name: 'userDetail', component: UserDetail },
  { path: '/register ', name: 'register', component: RegisterUser },
  { path: '/modify/:id ', name: 'modify', component: ModifyUser },
  { path: '/pets', name: 'pets', component: Pets },
  { path: '/subscription', name: 'subscription', component: Subscriptions },
  { path: '/subscription/:id', name: 'subscriptionDetail', component: SubscriptionsDetail },
  { path: '/subscription/new', name: 'AddSubscription', component: AddSubscription },
  { path: '/user/:id/subscription/new', name: 'addSubToUser', component: AddSubToUser },
  { path: '/subscription/:id', name: 'ModifySubscriptions', component: ModifySubscriptions },
  { path: '/:id/petsRegister ', name: 'petsRegister', component: PetsRegister },
  { path: '/:id/petsDetails', name: 'petsDetails', component: PetsDetails }
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
