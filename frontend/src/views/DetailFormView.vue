<script setup>
import DetailFormLayout from '@/layout/DetailFormLayout.vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
import { ref, onMounted } from 'vue'

const route = useRoute()
const { slug } = route.params
const BACKEND_URL = import.meta.env.VITE_BACKEND_URL

const questions = ref([])
onMounted(async () => {
   await axios.get(
      `${BACKEND_URL}/forms/${slug}`,
      {
         headers: {
            Authorization: `Bearer ${localStorage.getItem('accessToken')}`
         }
      }).then(({ data }) => {
         questions.value = data.form.questions
      })
})

</script>
<template>
   <DetailFormLayout>
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-6">

            <div class="question-item  card card-default my-4" v-for="(question, index) in questions"
               :key="question.name">
               <div class="card-body">
                  <div class="form-group my-3">
                     <input v-if="question.type != 'paragraph'" type="text" placeholder="Question" class="form-control"
                        :name="question.name" :value="question.name" disabled />
                  </div>

                  <div class="form-group my-3">
                     <select name="choice_type" class="form-select" disabled>
                        <option>Choice Type</option>
                        <option value="short answer" :selected="question.choice_type == 'short answer'">Short Answer
                        </option>
                        <option value="paragraph" :selected="question.choice_type == 'paragraph'">Paragraph</option>
                        <option value="multiple choice" :selected="question.choice_type == 'multiple choice'">Multiple
                           Choice
                        </option>
                        <option value="dropdown" :selected="question.choice_type == 'dropdown'">Dropdown</option>
                        <option value="checkboxes" :selected="question.choice_type == 'checkboxes'">Checkboxes</option>
                     </select>
                  </div>

                  <div class="form-group my-3"
                     v-if="['dropdown', 'checkboxes', 'multiple choice'].includes(question.choice_type)">
                     <textarea placeholder="Choices" class="form-control" name="choices" rows="4" disabled
                        v-model="question.choices"></textarea>
                     <div class="form-text">
                        Separate choices using comma ",".
                     </div>
                  </div>
                  <div class="form-check form-switch" aria-colspan="my-3">
                     <input class="form-check-input" type="checkbox" role="switch" id="required" disabled
                        :checked="question.is_required" />
                     <label class="form-check-label" for="required">Required</label>
                  </div>
                  <div class="mt-3">
                     <button type="submit" class="btn btn-outline-danger">Remove</button>
                  </div>
               </div>
            </div>

            <div class="question-item card card-default my-4">
               <div class="card-body">
                  <form>
                     <div class="form-group my-3">
                        <input type="text" placeholder="Question" class="form-control" name="name" value="" />
                     </div>

                     <div class="form-group my-3">
                        <select name="choice_type" class="form-select">
                           <option selected>Choice Type</option>
                           <option value="short answer">Short Answer</option>
                           <option value="paragraph">Paragraph</option>
                           <option value="date">Date</option>
                           <option value="multiple choice">Multiple Choice</option>
                           <option value="dropdown">Dropdown</option>
                           <option value="checkboxes">Checkboxes</option>
                        </select>
                     </div>
                     <div class="form-check form-switch" aria-colspan="my-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="required" />
                        <label class="form-check-label" for="required">Required</label>
                     </div>
                     <div class="mt-3">
                        <button type="submit" class="btn btn-outline-primary">Save</button>
                     </div>
                  </form>
               </div>
            </div>

         </div>
      </div>
   </DetailFormLayout>
</template>