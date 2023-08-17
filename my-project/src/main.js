import { createApp } from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import './legasy-st.css'
import './assets/images/ex.svg'
import './assets/images/icim1.svg'
import './custom-styles.css';

loadFonts()

createApp(App)
  .use(vuetify)
  .mount('#app')
