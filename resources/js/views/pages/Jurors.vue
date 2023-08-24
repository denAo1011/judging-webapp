<script setup>
// import "vue3-carousel/dist/carousel.css";
// import Carousel from "vue3-carousel";

import { ref } from "vue";
import { useRouter } from "vue-router";
import BaseButton from "../../components/BaseButton.vue";
const router = useRouter();

const jurors = ref([
    {
        id: 1,
        name: "Rina Lopez-Bautista",
        position: "President",
        company: "Knowledge Channel",
    },
    {
        id: 2,
        name: "Ralph Menorca",
        position: "Head of Programming and On Air Operations",
        company: "ABS-CBN",
    },
    {
        id: 3,
        name: "Aleli Suguitan",
        position: "Head, Digital Media and Interactive Services",
        company: "PTV",
    },
    {
        id: 4,
        name: "Cheryl Ching-Sy",
        position: "VP, Business Development 1, Drama, Entertainment Group",
        company: "GMA",
    },
]);

function goTo(route) {
    router.push(route);
}
</script>
<template>
    <div class="juror-container d-flex align-items-start py-12">
        <v-row justify="center">
            <v-col cols="11" lg="11" xl="9">
                <v-row>
                    <v-col>
                        <h1
                            class="text-5xl font-bold text-white text-center mb-5"
                        >
                            Meet the Jurors
                        </h1>
                        <p class="text-sm lg:text-xl mt-12 text-white">
                            At the heart of Anak TV's commitment to excellence
                            lies our meticulous approach to selecting jurors for
                            our prestigious awards, such as the coveted Net Anak
                            TV Seal award. Our dedicated Anak TV Secretariat
                            takes great care in handpicking jurors from diverse
                            sectors encompassing the Academe, Business,
                            Advertising, TV Networks, child-focused groups, and
                            more.
                        </p>
                    </v-col>
                </v-row>
                <v-row class="mt-5">
                    <v-col cols="12">
                        <v-row>
                            <!-- <carousel :items-to-show="1.5">
                                <slide v-for="slide in 10" :key="slide">
                                    {{ slide }}
                                </slide>

                                <template #addons>
                                    <navigation />
                                    <pagination />
                                </template>
                            </carousel> -->
                            <v-col
                                v-for="(juror, index) in jurors"
                                :key="index"
                                cols="12"
                                lg="3"
                            >
                                <v-card class="card-border">
                                    <v-card-text>
                                        <h1
                                            class="text-xl font-bold text-center"
                                        >
                                            {{ juror.name }}
                                        </h1>
                                        <p class="text-sm text-center">
                                            {{ juror.position }}
                                        </p>
                                        <p
                                            class="text-sm text-center text-primary"
                                        >
                                            {{ juror.company }}
                                        </p>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </div>
</template>
<style scoped>
.juror-container {
    width: 100vw;
    /* justify-content: center; */
    /* Add Linear Background */
    background: #5452a3;
}

.card-border {
    /* box-shadow: -10px 20px 15px 5px rgba(0, 0, 0, 1); */
    border-radius: 20px !important;
}
</style>
