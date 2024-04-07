<script setup>
import axios from 'axios';
import DefaultLayout from './DefaultLayout.vue'
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const { slug } = route.params

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL
const BASE_URL = window.location.origin
const token = localStorage.getItem('accessToken')

let form = ref({})

onMounted(() => {
    // get form detail
    axios.get(
        `${BACKEND_URL}/forms/${slug}`,
        {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }
    ).then(({ data }) => {
        form.value = data.form
        console.log(data.form)
    })
})
</script>
<template>
    <DefaultLayout>
        <div class="hero py-5 bg-light">
            <div class="container text-center">
                <h2 class="mb-2">
                    {{ form.name }}
                </h2>
                <div class="text-muted mb-4">
                    {{ form.description }}
                </div>
                <div v-if="form.allowed_domains">
                    <div>
                        <small>For user domains</small>
                    </div>
                    <small>
                        <span class="text-primary">
                            {{ form.allowed_domains.map(i => i.domain).join(',') }}
                        </span>
                    </small>
                </div>
            </div>
        </div>

        <div class="py-5">
            <div class="container">

                <div class="row justify-content-center ">
                    <div class="col-lg-5 col-md-6">
                        <div class="input-group mb-5">
                            <input type="text" class="form-control form-link" readonly
                                :value="`${BASE_URL}/forms/${slug}`" />
                            <RouterLink to="/submit-form" class="btn btn-primary">Copy</RouterLink>
                        </div>

                        <ul class="nav nav-tabs mb-2 justify-content-center">
                            <li class="nav-item">
                                <RouterLink :to="`/detail-form/${slug}`" class="nav-link"
                                    :class="{ 'active': $route.path === `/detail-form/${slug}` }">
                                    Questions
                                </RouterLink>
                            </li>
                            <li class="nav-item">
                                <RouterLink :to="`/detail-form/${slug}/responses/`" class="nav-link"
                                    :class="{ 'active': $route.path === `/detail-form/${slug}/responses/` }">
                                    Responese
                                </RouterLink>
                            </li>
                        </ul>
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </DefaultLayout>
</template>