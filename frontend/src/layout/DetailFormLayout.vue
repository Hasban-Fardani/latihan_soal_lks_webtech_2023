<script setup>
import DefaultLayout from './DefaultLayout.vue'
</script>
<template>
    <DefaultLayout>
        <div class="hero py-5 bg-light">
            <div class="container text-center">
                <h2 class="mb-2">
                    Biodata - Web Tech Members
                </h2>
                <div class="text-muted mb-4">
                    To save web tech members biodata
                </div>
                <div>
                    <div>
                        <small>For user domains</small>
                    </div>
                    <small><span class="text-primary">webtech.id, webtech.org</span></small>
                </div>
            </div>
        </div>

        <div class="py-5">
            <div class="container">

                <div class="row justify-content-center ">
                    <div class="col-lg-5 col-md-6">
                        <div class="input-group mb-5">
                            <input type="text" class="form-control form-link" readonly
                                value="http://localhost:8080/forms/biodata" />
                            <a href="submit-form.html" class="btn btn-primary">Copy</a>
                        </div>

                        <ul class="nav nav-tabs mb-2 justify-content-center">
                            <li class="nav-item">
                                <RouterLink to="/detail-form" class="nav-link active">
                                    Questions
                                </RouterLink>
                            </li>
                            <li class="nav-item">
                                <RouterLink to="/responses" class="nav-link">
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