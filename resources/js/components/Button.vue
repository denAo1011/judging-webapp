<script setup>
//Get props text
defineProps({
    text: String,
});
</script>
<template>
    <v-hover>
        <template v-slot:default="{ isHovering, props }">
            <v-card
                @click="$emit('click')"
                v-bind="props"
                :color="isHovering ? '#D2467F' : '#FF005C'"
                class="button-shadow"
            >
                <v-card-text class="text-center text-white">
                    <h1>{{ text }}</h1>
                </v-card-text></v-card
            >
        </template>
    </v-hover>
</template>
<style scoped>
.button-shadow {
    box-shadow: -5px 5px 5px 3px rgba(0, 0, 0, 1);
    cursor: pointer;
}
</style>
