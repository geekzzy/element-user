import { createRouter, createWebHashHistory } from 'vue-router'
import Index from '../components/Index'
import List from '../components/user/List'

const routes = [
  {
    path: '/index',
    name: 'index',
    component: Index,
  },
  {
    path: '/users',
    name: 'users',
    component: List,
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
