import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import CreateFormView from '@/views/CreateFormView.vue'
import DetailFormView from '@/views/DetailFormView.vue'
import ManageFormsView from '@/views/ManageFormsView.vue'
import SubmitFormView from '@/views/SubmitFormView.vue'
import ResponsesView from '@/views/ResponsesView.vue'
import NotFoundView from '@/views/NotFoundView.vue'
import ForbiddenView from '@/views/ForbiddenView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: HomeView
    },
    {
      path: '/create-form',
      name: 'create-form',
      component: CreateFormView,
      meta: {
        requireAuth: true
      }
    },
    {
      path: '/detail-form/:slug',
      name: 'detail-form',
      component: DetailFormView,
      meta: {
        requireAuth: true
      }
    },
    {
      path: '/manage-forms',
      name: 'manage-forms',
      component: ManageFormsView,
      meta: {
        requireAuth: true
      }
    },
    {
      path: '/submit-form',
      name: 'submit-form',
      component: SubmitFormView,
      meta: {
        requireAuth: true
      }
    },
    {
      path: '/responses',
      name: 'responses',
      component: ResponsesView,
      meta: {
        requireAuth: true
      }
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

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('accessToken')
  console.log('token: ', token)
  console.log('current route: ', to.meta.requireAuth)
  if (to.meta.requireAuth && !localStorage.getItem('accessToken')) {
    return next({ name: 'forbidden' })
  }

  return next()
})

export default router
