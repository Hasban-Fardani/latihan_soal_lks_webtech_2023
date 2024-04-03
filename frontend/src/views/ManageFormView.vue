<template>
      <nav class="navbar navbar-expand-lg sticky-top bg-primary navbar-dark">
      <div class="container">
         <router-link to="/manage-form" class="navbar-brand">Formify</router-link>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
         <li class="nav-item">
            <router-link to="/" class="nav-link active">Administrator</router-link>
         </li> 
         <li class="nav-item">
            <router-link to="/" class="btn bg-white text-primary ms-4">Logout</router-link>
         </li>
       </ul> 
      </div>
    </nav>

    <main>

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

            <router-link to="detail-form.html" class="card card-default mb-3">
               <div class="card-body">
                  <h5 class="mb-1">Biodata - Web Tech Members</h5>
                  <small class="text-muted">@biodata (limit for 1 response)</small>
               </div>
            </router-link>

            <router-link to="detail-form.html" class="card card-default my-3">
               <div class="card-body">
                  <h5 class="mb-1">HTML Fundamental - Quiz</h5>
                  <small class="text-muted">@html-fundamental-quiz</small>
               </div>
            </router-link>

         </div>
      </div>
      
    </main>
</template>
