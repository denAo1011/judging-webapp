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
                <v-row class="mb-10">
                    <v-card color="#D2467F" class="card-shadow">
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
                                <v-col cols="4">
                                    <v-img src="/images/logo-bg.png"></v-img>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                </v-row>
                <v-row justify="center" class="mt-12 text-center text-white">
                    <h1 class="welcome-text">
                        WELCOME TO THE 2023 DIGITAL AWARDS
                    </h1>
                </v-row>
                <v-row class="mt-10" justify="center">
                    <v-col cols="2">
                        <Button @click="goTo('/about-us')" :text="'About Us'" />
                    </v-col>
                    <v-col cols="2">
                        <Button @click="goTo('/jurors')" :text="'Jurors'" />
                    </v-col>
                    <v-col cols="2">
                        <Button
                            @click="goTo('/eligibility')"
                            :text="'Eligibility'"
                        />
                    </v-col>
                    <v-col cols="2">
                        <Button @click="goTo('/faqs')" :text="'FAQs'" />
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
    /* Add Linear Background */
    background: linear-gradient(45deg, #4b114b 25%, 75%, #e6d1c1);
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
</style>
