<script setup>
import axios from 'axios'
import { useRouter } from 'vue-router';

const router = useRouter()
const BACKEND_URL = import.meta.env.VITE_BACKEND_URL
const logout = () => {
  axios.post(
    `${BACKEND_URL}/auth/logout`,
    {},
    {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('accessToken')}`
      }
    }
  ).then((v) => {
    localStorage.removeItem('accessToken')
    router.push('/')
    console.log('logout: ', v)
  }).catch((v) => {
    console.log("error", v)
  })
}
</script>
<template>
  <nav class="navbar navbar-expand-lg sticky-top bg-primary navbar-dark">
    <div class="container">
      <router-link class="navbar-brand" to="/manage-forms">Formify</router-link>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 flex-row">
        <li class="nav-item">
          <router-link class="nav-link active" to="/">Administrator</router-link>
        </li>
        <li class="nav-item">
          <button class="btn bg-white text-primary ms-4" @click="logout">Logout</button>
        </li>
      </ul>
    </div>
  </nav>
  <main>
    <slot />
  </main>
</template>