import {createRouter, createWebHistory} from "vue-router";
import Main from "./components/Main.vue";
import ChatPage from "./components/ChatPage.vue";

const routes = [
    {
        path: '/',
        component: Main
    },
    {
        path: '/chat',
        component: ChatPage
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
