<template>
    <div class="w-full">
        <router-view> </router-view>
    </div>
    <Footer v-if="!safeRoute"></Footer>
</template>
<script setup>
import Footer from "./components/Footer.vue";
import { useRouter } from "vue-router";
import { computed } from "vue";
const router = useRouter();
const validRoutePaths = [
    "/digital-judging/judge/process",
    "/digital-judging/judge/judging",
    "/digital-judging/entry-form",
];
const safeRoute = computed(() => {
    return validRoutePaths.includes(router.currentRoute.value.path);
});
</script>
