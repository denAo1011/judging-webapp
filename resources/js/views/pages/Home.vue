<script setup>
import AOS from "aos";
import { onMounted, ref } from "vue";
import Hero from "./Hero.vue";
import AboutPage from "./About.vue";
import JurorsPage from "./Jurors.vue";
import EligibilityPage from "./Eligibility.vue";
import FaqsPage from "./FAQ.vue";

const showScrollButton = ref(false);

function goTo(route) {
    const targetElement = document.getElementById(route);
    console.log(targetElement);

    if (targetElement) {
        targetElement.scrollIntoView({
            behavior: "smooth",
            block: "start",
        });
    }
}

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
}

function scrollToNext() {
    const targetElement = document.getElementById("aboutPage");
    console.log(targetElement);

    if (targetElement) {
        targetElement.scrollIntoView({
            behavior: "smooth",
            block: "start",
        });
    }
}

window.addEventListener("scroll", () => {
    showScrollButton.value = window.scrollY > 200;
});

onMounted(() => {
    AOS.init();
});
</script>
<template>
    <Hero @go-to="goTo" />
    <AboutPage id="aboutPage" />
    <JurorsPage id="jurorPage" />
    <EligibilityPage id="eligibilityPage" />
    <FaqsPage id="faqPage" />

    <v-btn
        v-if="showScrollButton"
        @click="scrollToTop"
        class="rounded-circle floating-button"
        icon="mdi-arrow-up"
        size="large"
    ></v-btn>
    <v-btn
        v-if="!showScrollButton"
        @click="scrollToNext"
        class="rounded-circle floating-button"
        icon="mdi-arrow-down"
        size="large"
    ></v-btn>
</template>
<style>
.home-container {
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
}

.about-text {
    font-size: x-large;
    line-height: normal;
}

.card-border {
    border-radius: 20px !important;
}

.card-shadow {
    box-shadow: -10px 20px 15px 5px rgba(0, 0, 0, 1);
}

.floating-button {
    position: fixed !important;
    bottom: 20px !important;
    right: 20px !important;
    z-index: 999 !important;
}
</style>
