<script>
import BaseButton from "../../components/BaseButton.vue";
import { useRouter } from "vue-router";
export default {
    components: { BaseButton },
    data() {
        return {};
    },
    methods: {
        goTo(route) {
            // router.push(route);
        },
    },
};
</script>

<template>
    <v-row justify="center" class="pa-5">
        <v-col cols="12" md="4" lg="3" xl="2">
            <v-card>
                <v-card-title class="text-center"> Sample Title </v-card-title>

                <v-card-text>
                    <v-rating color="primary"></v-rating>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
    <v-row justify="center">
        <v-col cols="7" md="3" lg="2">
            <BaseButton :text="'Submit'" />
        </v-col>
    </v-row>
    <v-dialog> </v-dialog>
</template>
<style scoped>
.card-border {
    border-radius: 20px !important;
}
</style>
