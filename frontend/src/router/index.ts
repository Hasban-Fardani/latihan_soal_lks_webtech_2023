import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import CreateFormView from '../views/CreateFormView.vue'
import DetailFormView from '../views/DetailFormView.vue'
import ManageFormsView from '../views/ManageFormsView.vue'
import SubmitFormView from '../views/SubmitFormView.vue'
import ResponsesView from '../views/ResponsesView.vue'
import NotFoundView from '../views/NotFoundView.vue'
import ForbiddenView from '../views/ForbiddenView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/create-form',
      name: 'create-form',
      component: CreateFormView
    },
    {
      path: '/detail-form',
      name: 'detail-form',
      component: DetailFormView
    },
    {
      path: '/manage-forms',
      name: 'manage-forms',
      component: ManageFormsView
    },
    {
      path: '/submit-form',
      name: 'submit-form',
      component: SubmitFormView
    },
    {
      path: '/responses',
      name: 'responses',
      component: ResponsesView
    },
    {
      path: '/:notFound',
      name: 'not-found',
      component: NotFoundView
    },
    {
      path: '/forbidden',
      name: 'forbidden',
      component: ForbiddenView
    }
  ]
})

export default router
