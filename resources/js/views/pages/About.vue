<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import Button from "../../components/Button.vue";

const router = useRouter();

function goTo(route) {
    router.push(route);
}
</script>
<template>
    <div class="home-container">
        <v-row justify="center">
            <v-col cols="12" xl="8" lg="10">
                <v-row justify="center" class="mt-12 text-center text-white">
                    <h1 class="welcome-text">About anakTV</h1>
                </v-row>
                <v-row class="mb-10">
                    <v-card elevation="0" color="transparent">
                        <v-card-text>
                            <v-row
                                justify="space-between"
                                align="center"
                                class="pa-5"
                            >
                                <v-col cols="6">
                                    <p class="about-text text-white">
                                        The creation of an organization such as
                                        ANAKTV (the original name upon inception
                                        was Southeast Asian Foundation for
                                        Children's Television) was the result of
                                        nagging concerns expressed in various
                                        forums in society. Parents and teachers,
                                        not only in the Philippines but in all
                                        of Asia, increasingly agitated for more
                                        child-sensitive TV programs and shows
                                        that helped define to children what it
                                        was to be Asian. The executives running
                                        the TV networks in the Philippines, even
                                        in Southeast Asia, are parents
                                        themselves, torn between raking in
                                        profit and delighting the stockholders
                                        on one side and ensuring that their
                                        children had a healthy media diet, on
                                        the other.
                                    </p>
                                </v-col>
                                <v-col
                                    cols="6"
                                    class="d-flex justify-content-center"
                                >
                                    <v-img src="/images/logo.png"></v-img>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
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
    <div class="partner-container">
        <v-row justify="center">
            <v-col cols="12" xl="8" lg="10">
                <v-row justify="center" class="mt-12 text-center text-white">
                    <h1 class="welcome-text text-purple-darken-4">
                        Our Partners
                    </h1>
                </v-row>
                <v-row> </v-row>
                <v-row class="mt-10" justify="center">
                    <v-col cols="2">
                        <Button @click="goTo('/about-us')" :text="'Judge'" />
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </div>
</template>
<style scoped>
.home-container {
    height: 100vh;
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    /* Add Linear Background */
    background: linear-gradient(135deg, #4b114b 10%, 50%, #ffffff);
}

.welcome-text {
    font-size: 3rem;
    line-height: normal;
}

.about-text {
    font-size: x-large;
    line-height: normal;
}

.card-shadow {
    box-shadow: -10px 20px 15px 5px rgba(0, 0, 0, 1);
}

.partner-container {
    height: 100vh;
    width: 100vw;
    display: flex;
    justify-content: center;
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
