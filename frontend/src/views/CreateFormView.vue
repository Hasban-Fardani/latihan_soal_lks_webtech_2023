<script setup> 
import DefaultLayout from '@/layout/DefaultLayout.vue' 
import VInput from '@/components/VInput.vue' 
import VTextarea from '@/components/VTextarea.vue' 
</script>
<template>
   <DefaultLayout>
      <div class="hero py-5 bg-light">
         <div class="container">
            <h2>Create Form</h2>
         </div>
      </div>

      <div class="py-5">
         <div class="container">
            <div class="row">
               <div class="col-md-6 col-lg-4">
                  
                  <form action="detail-form.html">
                     <VInput label="Form Name" name="name" type="text" autofocus />

                     <VInput label="Form Slug" name="slug" type="text" />
                     
                     <VTextarea label="Description" name="description" type="textarea" rows="4"/>
                     
                     
                     <!-- s: input -->
                     <div class="form-group my-3">
                        <label for="allowed-domains" class="mb-1 text-muted">Allowed Domains</label>
                        <input type="text" id="allowed-domains" name="allowed_domains" class="form-control" />
                        <div class="form-text">Separate domains using comma ",". Ignore for public access.</div>
                     </div>
                     
                     <!-- s: input -->
                     <div class="form-check form-switch" aria-colspan="my-3">
                        <input type="checkbox" id="limit_one_response" name="limit_one_response" class="form-check-input" role="switch"/>
                        <label class="form-check-label" for="limit_one_response">Limit to 1 response</label>
                      </div>

                     <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                     </div>
                  </form>

               </div>
            </div>
         </div>
      </div>
   </DefaultLayout>
</template>