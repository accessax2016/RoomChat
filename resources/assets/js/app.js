
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// Import and Use Vue Router
import VueRouter from 'vue-router';
window.Vue.use(VueRouter);
// Import and Use Vue Moment
import VueMoment from 'vue-moment';
window.Vue.use(VueMoment);
// Import and Use Vue Chat Scroll
import VueChatScroll from 'vue-chat-scroll';
window.Vue.use(VueChatScroll);
// Import and Use Vue Toaster
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
window.Vue.use(Toaster)


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import ListRoom from './components/room/ListRoom.vue';
import NoneRoom from './components/room/NoneRoom.vue';
import DetailRoom from './components/room/DetailRoom.vue';

const routes = [
    {
        path: '/home',
        components: {
            listRoom: ListRoom,
            noneRoom: NoneRoom
        },
        name: 'home'
    },
    {
        path: '/room/:id',
        components: {
            listRoom: ListRoom,
            detailRoom: DetailRoom
        },
        name: 'detailRoom'
    }
]

const router = new VueRouter({ mode: 'history', routes })

const app = new Vue({ router }).$mount('#app')
