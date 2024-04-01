<template>
    <nav class="navbar navbar-expand-lg sticky-top bg-primary navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="manage-forms.html">Formify</a>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 flex-row">
         <li class="nav-item">
           <a class="nav-link active" href="#">Administrator</a>
         </li> 
         <li class="nav-item">
            <a href="index.html" class="btn bg-white text-primary ms-4">Logout</a>
         </li>
       </ul> 
      </div>
    </nav>
    <main>
        <slot/>
    </main>
</template>