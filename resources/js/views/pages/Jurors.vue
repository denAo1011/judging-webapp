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
    <div class="home-container">
        <v-row justify="center">
            <v-col cols="11" lg="10" xl="8">
                <v-card color="#D2467F" class="card-shadow">
                    <v-card-text>
                        <v-row>
                            <v-col cols="11">
                                <v-row>
                                    <v-col>
                                        <h1
                                            class="text-5xl font-bold text-white"
                                        >
                                            Meet the Jurors
                                        </h1>
                                        <p
                                            class="text-sm lg:text-xl text-white mt-5 text-justify"
                                        >
                                            The creation of an organization such
                                            as ANAKTV (the original name upon
                                            inception was Southeast Asian
                                            Foundation for Children's
                                            Television) was the result of
                                            nagging concerns expressed in
                                            various forums in society. Parents
                                            and teachers, not only in the
                                            Philippines but in all of Asia,
                                            increasingly agitated for more
                                            child-sensitive TV programs and
                                            shows that helped define to children
                                            what it was to be Asian. The
                                            executives running the TV networks
                                            in the Philippines, even in
                                            Southeast Asia, are parents
                                            themselves, torn between raking in
                                            profit and delighting the
                                            stockholders on one side and
                                            ensuring that their children had a
                                            healthy media diet, on the other.
                                        </p>
                                    </v-col>
                                </v-row>
                                <v-row class="mt-5">
                                    <v-col cols="12" lg="5">
                                        <v-row justify="center">
                                            <v-col cols="6">
                                                <BaseButton
                                                    :text="'Head Jurors'"
                                                />
                                            </v-col>
                                        </v-row>
                                        <v-row>
                                            <v-col cols="12" lg="6">
                                                <v-img
                                                    src="/images/jurors/1.jpg"
                                                ></v-img>
                                            </v-col>
                                            <v-col cols="12" lg="6">
                                                <v-img
                                                    src="/images/jurors/2.jpg"
                                                ></v-img>
                                            </v-col>
                                        </v-row>
                                    </v-col>
                                    <v-col cols="12" lg="7">
                                        <v-row>
                                            <v-col cols="12" lg="3">
                                                <v-img
                                                    src="/images/jurors/3.jpg"
                                                ></v-img>
                                            </v-col>
                                            <v-col cols="12" lg="3">
                                                <v-img
                                                    src="/images/jurors/4.jpg"
                                                ></v-img>
                                            </v-col>
                                            <v-col cols="12" lg="3">
                                                <v-img
                                                    src="/images/jurors/5.jpg"
                                                ></v-img>
                                            </v-col>
                                            <v-col cols="12" lg="3">
                                                <v-img
                                                    src="/images/jurors/6.jpg"
                                                ></v-img>
                                            </v-col>
                                            <v-col cols="12" lg="3">
                                                <v-img
                                                    src="/images/jurors/7.jpg"
                                                ></v-img>
                                            </v-col>
                                            <v-col cols="12" lg="3">
                                                <v-img
                                                    src="/images/jurors/8.jpg"
                                                ></v-img>
                                            </v-col>
                                            <v-col cols="12" lg="3">
                                                <v-img
                                                    src="/images/jurors/9.jpg"
                                                ></v-img>
                                            </v-col>
                                            <v-col cols="12" lg="3">
                                                <v-img
                                                    src="/images/jurors/10.jpg"
                                                ></v-img>
                                            </v-col>
                                        </v-row>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
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

.card-shadow {
    box-shadow: -10px 20px 15px 5px rgba(0, 0, 0, 1);
}
</style>
