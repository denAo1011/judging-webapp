<script setup>
import { ref } from "vue";

import { useRouter } from "vue-router";
const router = useRouter();

const drawer = ref(null);

function logout() {
    localStorage.clear();
    router.push({ name: "home" });
}
</script>
<template>
    <v-navigation-drawer v-model="drawer" permanent absolute>
        <v-list :lines="false" density="compact" nav color="primary">
            <v-list-item to="/admin/entries">
                <v-list-item-title>Entries</v-list-item-title>
            </v-list-item>
        </v-list>
        <template v-slot:append>
            <v-list :lines="false" density="compact" nav>
                <v-list-item @click="logout">
                    <template v-slot:prepend>
                        <v-icon>mdi-exit-to-app</v-icon>
                    </template>
                    <v-list-item-title>Logout</v-list-item-title>
                </v-list-item>
            </v-list>
        </template>
    </v-navigation-drawer>
</template>
