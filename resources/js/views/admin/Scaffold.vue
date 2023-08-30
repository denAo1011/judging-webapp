<script setup>
import { ref, onBeforeMount } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import Drawer from "../../components/Drawer.vue";
import View from "../../components/View.vue";
const store = useStore();
const router = useRouter();

onBeforeMount(() => {
    if (!store.getters.isAuth) {
        router.push({ name: "signin" });
    }
});
</script>

<template>
    <v-app>
        <Drawer />
        <View />
    </v-app>
</template>
