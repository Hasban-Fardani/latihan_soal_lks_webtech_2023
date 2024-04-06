<script setup>
import DetailFormLayout from '@/layout/DetailFormLayout.vue'
</script>
<template>
   <DetailFormLayout>
      <div class="py-5">
         <div class="container">

            <div class="row justify-content-center">
               <div class="col-lg-10">

                  <table class="table mt-3">
                     <caption>Total Responses: 3</caption>
                     <thead>
                        <tr class="text-muted">
                           <th>User</th>
                           <th>Name</th>
                           <th>Address</th>
                           <th>Sex</th>
                           <th>Born Date</th>
                           <th>Hobbies</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td class="text-primary">budi@webtech.id</td>
                           <td>Budi Andrianto</td>
                           <td>Jakarta</td>
                           <td>Male</td>
                           <td>2000-09-09</td>
                           <td>Football, Coding, Guitar.</td>
                        </tr>
                        <tr>
                           <td class="text-primary">andi@webtech.id</td>
                           <td>Andi Budiman</td>
                           <td>Surabaya</td>
                           <td>Male</td>
                           <td>2005-10-01</td>
                           <td>Traveling, Watching.</td>
                        </tr>
                        <tr>
                           <td class="text-primary">mela@webtech.id</td>
                           <td>Mela Agustin</td>
                           <td>Bandung</td>
                           <td>Female</td>
                           <td>2003-04-07</td>
                           <td>Guitar, Traveling, Coding.</td>
                        </tr>
                     </tbody>
                  </table>

               </div>
            </div>

         </div>
      </div>
   </DetailFormLayout>
</template>