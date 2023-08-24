<script setup>
import BaseButton from "../../components/BaseButton.vue";
</script>
<template>
    <div class="home-container py-10">
        <v-row justify="center">
            <v-col cols="12" xl="9" lg="11">
                <v-row justify="center" class="pa-5 text-center">
                    <h1
                        data-aos="fade-down"
                        class="text-5xl font-bold text-primary"
                    >
                        WELCOME TO THE 2023 DIGITAL AWARDS
                    </h1>
                </v-row>
                <v-row class="mb-10" justify="center" align="center">
                    <v-col data-aos="fade-right" col="12" sm="6" lg="6">
                        <v-img src="/images/logo-full.png"></v-img>
                    </v-col>
                    <v-col data-aos="fade-left" cols="12" lg="6">
                        <v-card color="tertiary" class="card-border">
                            <v-card-text>
                                <v-row
                                    justify="center"
                                    align="center"
                                    class="pa-5"
                                >
                                    <v-col>
                                        <p
                                            class="lg:text-lg xl:text-2xl text-black"
                                        >
                                            Transforming Anak TV from a
                                            traditional setup to a cutting-edge
                                            digital powerhouse is an
                                            exhilarating journey! Imagine this:
                                            parents, teachers, and visionaries
                                            from all corners of Asia coming
                                            together to make kid-friendly,
                                            Asian-inspired TV that's nothing
                                            short of excellence.
                                            <br /><br />
                                            Our executives, torn between profit
                                            and their own kids' media health,
                                            are now steering Anak TV into a bold
                                            digital future. Our aim? To
                                            turbocharge our organization with
                                            the latest tech and ingenious
                                            strategies, supercharging efficiency
                                            and magnifying our outreach. We're
                                            not just embracing digitalization;
                                            we're redefining it.
                                            <br /><br />
                                            A world where AnakTV seamlessly
                                            weaves into every fiber of our
                                            existence, revolutionizing how we
                                            fulfill our mission. Join us on this
                                            electrifying journey as we harness
                                            digital power to ignite change and
                                            magnify our impact for the
                                            communities we cherish!
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
                            :text="'Guidelines'"
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
    background: url("/images/bg3.png");
    /* background: url("/images/bg2.gif"); */
    /* background-size: cover; */
    /* Add Parallax Effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.about-text {
    font-size: x-large;
    line-height: normal;
}
</style>
