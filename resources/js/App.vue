<template>
    <div class="w-full">
        <router-view> </router-view>
    </div>
    <Footer v-if="!isAuth"></Footer>
</template>
<script setup>
import Footer from "./components/Footer.vue";
import { useStore } from "vuex";
import { computed } from "vue";
const store = useStore();

const isAuth = computed(() => {
    return store.getters.isAuth;
});
</script>
