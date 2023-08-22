<script setup>
import BaseButton from "../../components/BaseButton.vue";
</script>
<template>
    <div class="home-container py-10">
        <v-row justify="center">
            <v-col cols="12" xl="8" lg="10">
                <v-row justify="center" class="pa-5 text-center">
                    <h1 class="text-5xl font-bold text-secondary">
                        WELCOME TO THE 2023 DIGITAL AWARDS
                    </h1>
                </v-row>
                <v-row class="mb-10" justify="center" align="center">
                    <v-col col="12" sm="6" lg="5">
                        <v-img src="/images/logo1.png"></v-img>
                    </v-col>
                    <v-col cols="12" lg="7">
                        <v-card color="primary" class="card-border">
                            <v-card-text>
                                <v-row
                                    justify="center"
                                    align="center"
                                    class="pa-5"
                                >
                                    <v-col>
                                        <p
                                            class="lg:text-lg xl:text-2xl text-white"
                                        >
                                            The creation of an organization such
                                            as anak TV (the original name upon
                                            inception was Southeast Asian
                                            Foundation for Children's
                                            Television) was the result of
                                            nagging concerns expressed in
                                            various forums in society.
                                            <br /><br />
                                            Parents and teachers, not only in
                                            the Philippines but in all of Asia,
                                            increasingly agitated for more
                                            child-sensitive TV programs and
                                            shows that helped define to children
                                            what it was to be Asian.
                                            <br /><br />
                                            The executives running the TV
                                            networks in the Philippines, even in
                                            Southeast Asia, are parents
                                            themselves, torn between raking in
                                            profit and delighting the
                                            stockholders on one side and
                                            ensuring that their children had a
                                            healthy media diet, on the other.
                                        </p>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
                <v-row class="mt-10 px-5" justify="center">
                    <v-col cols="6" sm="3" lg="2">
                        <BaseButton
                            @click="$emit('goTo', 'aboutPage')"
                            :text="'About Us'"
                        />
                    </v-col>
                    <v-col cols="6" sm="3" lg="2">
                        <BaseButton
                            @click="$emit('goTo', 'jurorPage')"
                            :text="'Jurors'"
                        />
                    </v-col>
                    <v-col cols="6" sm="3" lg="2">
                        <BaseButton
                            @click="$emit('goTo', 'eligibilityPage')"
                            :text="'Eligibility'"
                        />
                    </v-col>
                    <v-col cols="6" sm="3" lg="2">
                        <BaseButton
                            @click="$emit('goTo', 'faqPage')"
                            :text="'FAQs'"
                        />
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </div>
</template>
<style scoped>
.home-container {
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    /* Add Linear Background */
    /* background: #f6eaf6; */
}

.about-text {
    font-size: x-large;
    line-height: normal;
}
</style>
