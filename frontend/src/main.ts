import './assets/css/main.css'
import './assets/js/bootstrap'
import './assets/js/popper'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(router)

app.mount('#app')
