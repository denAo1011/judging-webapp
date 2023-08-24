<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import BaseButton from "../../components/BaseButton.vue";
const router = useRouter();

const partners = ref([
    { id: 1, img: "/images/partners/1.png" },
    { id: 2, img: "/images/partners/2.png" },
    { id: 3, img: "/images/partners/3.png" },
    { id: 4, img: "/images/partners/4.png" },
    { id: 5, img: "/images/partners/5.png" },
    { id: 6, img: "/images/partners/6.jpg" },
    { id: 7, img: "/images/partners/7.png" },
    { id: 8, img: "/images/partners/9.png" },
    { id: 9, img: "/images/partners/10.png" },
    { id: 10, img: "/images/partners/11.png" },
    { id: 11, img: "/images/partners/12.png" },
]);

function goTo(route) {
    router.push(route);
}
</script>
<template>
    <div class="py-10">
        <div class="about-container">
            <v-row justify="center">
                <v-col cols="12" xl="8" lg="11">
                    <v-row
                        justify="center"
                        class="mt-12 text-center text-white"
                    >
                        <h1 class="text-5xl font-bold text-primary">
                            About Anak TV
                        </h1>
                    </v-row>
                    <v-row class="mt-8" justify="center" align="center">
                        <v-col
                            data-aos="fade-up-right"
                            cols="11"
                            lg="6"
                            class="order-2 order-lg-1"
                        >
                            <v-card color="#9BE484" class="card-border">
                                <v-card-text>
                                    <p class="text-sm lg:text-2xl text-black">
                                        The creation of an organization such as
                                        Anak TV (the original name upon
                                        inception was Southeast Asian Foundation
                                        for Children's Television) was the
                                        result of nagging concerns expressed in
                                        various forums in society. <br /><br />
                                        Parents and teachers, not only in the
                                        Philippines but in all of Asia,
                                        increasingly agitated for more
                                        child-sensitive TV programs and shows
                                        that helped define to children what it
                                        was to be Asian.
                                        <br /><br />
                                        The executives running the TV networks
                                        in the Philippines, even in Southeast
                                        Asia, are parents themselves, torn
                                        between raking in profit and delighting
                                        the stockholders on one side and
                                        ensuring that their children had a
                                        healthy media diet, on the other.
                                    </p>
                                    <v-row
                                        justify="space-between"
                                        align="center"
                                        class="pa-5"
                                    >
                                    </v-row>
                                </v-card-text>
                            </v-card>
                        </v-col>
                        <v-col
                            data-aos="fade-up-left"
                            cols="12"
                            lg="6"
                            sm="6"
                            class="d-flex justify-content-center order-1 order-lg-2"
                        >
                            <v-img
                                src="/images/about.gif"
                                max-height="600"
                            ></v-img>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
            <svg
                class="hero-waves"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28 "
                preserveAspectRatio="none"
            >
                <defs>
                    <path
                        id="wave-path"
                        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"
                    />
                </defs>
                <g class="wave1">
                    <use
                        xlink:href="#wave-path"
                        x="50"
                        y="3"
                        fill="rgba(255,255,255, .1)"
                    />
                </g>
                <g class="wave2">
                    <use
                        xlink:href="#wave-path"
                        x="50"
                        y="0"
                        fill="rgba(255,255,255, .2)"
                    />
                </g>
                <g class="wave3">
                    <use xlink:href="#wave-path" x="50" y="9" fill="#fff" />
                </g>
            </svg>
        </div>
        <div
            class="partner-container d-flex justify-content-center align-items-center"
        >
            <v-row justify="center" class="mt-12">
                <v-col cols="11">
                    <v-row
                        justify="center"
                        class="my-12 text-center text-white"
                    >
                        <h1 class="text-5xl font-bold text-primary">
                            Member Networks
                        </h1>
                    </v-row>
                    <v-row class="mt-12" justify="center">
                        <v-col
                            data-aos="fade-up"
                            :data-aos-delay="index + 1 + '00'"
                            cols="6"
                            md="4"
                            lg="2"
                            v-for="(partner, index) in partners"
                            :key="index"
                            class="d-flex justify-content-center align-items-center py-5"
                        >
                            <v-img height="200" :src="partner.img" />
                        </v-col>
                    </v-row>
                    <!-- <v-row class="mt-12" justify="center">
                        <v-col cols="10" lg="3" xl="2">
                            <BaseButton @click="goTo('/jurors')" :text="'Jurors'" />
                        </v-col>
                    </v-row> -->
                </v-col>
            </v-row>
        </div>
    </div>
</template>
<style scoped>
.about-container {
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    /* Add Linear Background */
    background: linear-gradient(0deg, #b7f1a5 10%, 50%, #ffffff);
}

.about-text {
    font-size: x-large;
    line-height: normal;
}

.partner-container {
    width: 100vw;
    background: white;
}

.hero-waves {
    display: block;
    margin-top: 60px;
    width: 100%;
    height: 60px;
    z-index: 5;
    position: relative;
}

.wave1 use {
    -webkit-animation: move-forever1 10s linear infinite;
    animation: move-forever1 10s linear infinite;
    -webkit-animation-delay: -2s;
    animation-delay: -2s;
}

.wave2 use {
    -webkit-animation: move-forever2 8s linear infinite;
    animation: move-forever2 8s linear infinite;
    -webkit-animation-delay: -2s;
    animation-delay: -2s;
}

.wave3 use {
    -webkit-animation: move-forever3 6s linear infinite;
    animation: move-forever3 6s linear infinite;
    -webkit-animation-delay: -2s;
    animation-delay: -2s;
}

@-webkit-keyframes move-forever1 {
    0% {
        transform: translate(85px, 0%);
    }
    100% {
        transform: translate(-90px, 0%);
    }
}

@keyframes move-forever1 {
    0% {
        transform: translate(85px, 0%);
    }
    100% {
        transform: translate(-90px, 0%);
    }
}

@-webkit-keyframes move-forever2 {
    0% {
        transform: translate(-90px, 0%);
    }
    100% {
        transform: translate(85px, 0%);
    }
}

@keyframes move-forever2 {
    0% {
        transform: translate(-90px, 0%);
    }
    100% {
        transform: translate(85px, 0%);
    }
}

@-webkit-keyframes move-forever3 {
    0% {
        transform: translate(-90px, 0%);
    }
    100% {
        transform: translate(85px, 0%);
    }
}

@keyframes move-forever3 {
    0% {
        transform: translate(-90px, 0%);
    }
    100% {
        transform: translate(85px, 0%);
    }
}
</style>
