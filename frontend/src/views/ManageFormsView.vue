<script setup>
import axios from 'axios'
import { ref, onMounted } from 'vue'
import DefaultLayout from '@/layout/DefaultLayout.vue';
import { useRoute } from 'vue-router';

const BASE_URL = import.meta.env.VITE_BACKEND_URL

const route = useRoute()
const { slug } = route.params

let forms = ref([])

onMounted(() => {
   // get all forms
   axios.get(
      `${BASE_URL}/forms`,
      {
         headers: { Authorization: `Bearer ${localStorage.getItem('accessToken')}` }
      }).then(({ data }) => {
         console.log(data)
         forms.value = data.forms
      })
})
</script>
<template>
   <DefaultLayout>
      <div class="hero py-5 bg-light">
         <div class="container">
            <router-link to="/create-form" class="btn btn-primary">
               Create Form
            </router-link>
         </div>
      </div>

      <div class="list-form py-5">
         <div class="container">
            <h6 class="mb-3">List Form</h6>
            <router-link v-for="form in forms" :key="form.id" :to="`/detail-form/${form.slug}`"
               class="card card-default mb-3">
               <div class="card-body">
                  <h5 class="mb-1">{{ form.name }}</h5>
                  <small class="text-muted">
                     @{{ form.slug }}
                     <span v-if="form.limit_one_response">
                        (limit for 1 response)
                     </span>
                  </small>
               </div>
            </router-link>
         </div>
      </div>
   </DefaultLayout>
</template>
