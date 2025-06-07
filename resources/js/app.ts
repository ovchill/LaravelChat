import {createApp} from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'
import App from './App.vue';
import router from '@/router';
import 'vfonts/Lato.css';
import 'vfonts/FiraCode.css';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {create, NButton, NInput, NRadio, NRadioGroup, NForm, NAlert, NMessageProvider, NFormItem} from 'naive-ui'

const naive = create({
    components: [NButton, NInput, NRadio, NRadioGroup, NForm, NAlert, NMessageProvider, NFormItem]
})

createApp(App)
    .use(router)
    .use(VueAxios, axios)
    .use(naive)
    .component('font-awesome-icon', FontAwesomeIcon)
    .mount('#app')
