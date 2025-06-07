<script lang="ts">
import Header from "./components/MainComponents/Header.vue";
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'App',
    components: {
        Header
    },
});
</script>

<template>
    <Header/>
    <n-message-provider>
        <router-view />
    </n-message-provider>
</template>
