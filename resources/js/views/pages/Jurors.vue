<script setup>
// import "vue3-carousel/dist/carousel.css";
// import Carousel from "vue3-carousel";

import { ref } from "vue";
import { useRouter } from "vue-router";
import BaseButton from "../../components/BaseButton.vue";
const router = useRouter();

const jurors = ref([
    { id: 1, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/1.jpg" },
    { id: 2, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/2.jpg" },
    { id: 3, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/3.jpg" },
    { id: 4, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/4.jpg" },
    { id: 5, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/5.jpg" },
    { id: 6, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/6.jpg" },
    { id: 7, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/7.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
    { id: 8, name: "Dr. Grace Javier Alfonso", img: "/images/jurors/8.jpg" },
]);

function goTo(route) {
    router.push(route);
}
</script>
<template>
    <div class="juror-container d-flex align-items-start">
        <v-row justify="center" class="mt-12">
            <v-col cols="11" lg="10" xl="8">
                <v-row>
                    <v-col>
                        <h1
                            class="text-5xl font-bold text-white text-center mb-5"
                        >
                            Meet the Jurors
                        </h1>
                        <p class="text-sm lg:text-xl mt-12 text-white">
                            The creation of an organization such as anak TV (the
                            original name upon inception was Southeast Asian
                            Foundation for Children's Television) was the result
                            of nagging concerns expressed in various forums in
                            society.
                            <br /><br />
                            Parents and teachers, not only in the Philippines
                            but in all of Asia, increasingly agitated for more
                            child-sensitive TV programs and shows that helped
                            define to children what it was to be Asian.
                            <br /><br />
                            The executives running the TV networks in the
                            Philippines, even in Southeast Asia, are parents
                            themselves, torn between raking in profit and
                            delighting the stockholders on one side and ensuring
                            that their children had a healthy media diet, on the
                            other.
                        </p>
                    </v-col>
                </v-row>
                <v-row class="mt-5">
                    <v-col cols="12">
                        <v-row>
                            <Carousel></Carousel>
                            <!-- <carousel :items-to-show="1.5">
                                <slide v-for="slide in 10" :key="slide">
                                    {{ slide }}
                                </slide>

                                <template #addons>
                                    <navigation />
                                    <pagination />
                                </template>
                            </carousel> -->
                            <BaseButton
                                @click="goTo('/jurors')"
                                :text="'Jurors'"
                            />
                            <!-- <v-col
                                v-for="(juror, index) in jurors"
                                :key="index"
                                cols="12"
                                lg="3"
                            >
                                <h1 class="text-xl font-bold">
                                    {{ juror.name }}
                                </h1>
                            </v-col> -->
                        </v-row>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </div>
</template>
<style scoped>
.juror-container {
    height: 100vh;
    width: 100vw;
    /* justify-content: center; */
    /* Add Linear Background */
    background: #5452a3;
}

.card-shadow {
    /* box-shadow: -10px 20px 15px 5px rgba(0, 0, 0, 1); */
    border-radius: 20px !important;
}
</style>
