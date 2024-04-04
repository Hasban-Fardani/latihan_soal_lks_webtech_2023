<script setup lang="ts">
import axios from 'axios'
import { useRouter } from 'vue-router';
import { ref } from 'vue'

const router = useRouter()

const BASE_URL = import.meta.env.VITE_BACKEND_URL

let data = {
   email: "",
   password: ""
}

let showMessage = ref(false)
let message = ref('')

const onSubmit = () => {
   axios.post(
      `${BASE_URL}/auth/login`,
      data
   ).then((v) => {
      localStorage.setItem('accessToken', v.data.user.accessToken)
      router.push('/manage-forms')
   }).catch((v) => {
      showMessage.value = true
      message.value = v.response.data.message
   })
}
</script>
<template>
   <main>
      <div class="alert alert-danger" role="alert" v-if="showMessage">
         {{ message }}
      </div>
      <section class="login">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-5 col-md-6">
                  <h1 class="text-center mb-4">Formify</h1>
                  <div class="card card-default">
                     <div class="card-body">
                        <h3 class="mb-3">Login</h3>

                        <form @submit.prevent="onSubmit">
                           <!-- s: input -->
                           <div class="form-group my-3">
                              <label for="email" class="mb-1 text-muted">Email Address</label>
                              <input type="email" id="email" name="email" value="" class="form-control" autofocus
                                 v-model="data.email" />
                           </div>

                           <!-- s: input -->
                           <div class="form-group my-3">
                              <label for="password" class="mb-1 text-muted">Password</label>
                              <input type="password" id="password" name="password" value="" class="form-control"
                                 v-model="data.password" />
                           </div>

                           <div class="mt-4">
                              <button type="submit" class="btn btn-primary">Login</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>
</template>
