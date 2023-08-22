<script setup>
import Hero from "./Hero.vue";
import AboutPage from "./About.vue";
import JurorsPage from "./Jurors.vue";
import EligibilityPage from "./Eligibility.vue";
import FaqsPage from "./FAQ.vue";

function goTo(route) {
    let ref = route;
    const targetElement = this.$refs[ref];

    if (targetElement) {
        targetElement.scrollIntoView({
            behavior: "smooth", // Use 'auto' for instant scroll
            block: "start", // Scroll to the top of the target element
        });
    }
}
</script>
<template>
    <Hero @go-to="goTo" />
    <AboutPage ref="aboutPage" />
    <JurorsPage />
    <EligibilityPage />
    <FaqsPage />
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
</style>
