<script setup>
import BaseButton from "../../components/BaseButton.vue";
import { useRouter } from "vue-router";
const router = useRouter();
function goTo(route) {
    router.push(route);
}
</script>

<template>
    <div class="home-container py-10">
        <v-row justify="center">
            <v-col cols="11"  xl="10">
                <v-row justify="center" class="pa-5 text-center">
                    <h1 class="text-5xl font-bold text-primary">
                        Hello Juror
                    </h1>
                </v-row>
                <v-row justify="center">
                    <v-col data-aos="flip-in"  data-aos-anchor-placement="center-center" cols="12" md="10" lg="5">
                        <v-card color="#769657" class="card-border">
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" class="text-white">
                                        <h2 class="text-center text-base lg:text-3xl font-semibold my-4">Judging Process Reminder</h2>
                                        <p class="mb-4 text-base">Entries are screened and evaluated by jurors based on the following questions:</p>
                                        <ol class="list-decimal pl-6 mb-6 text-base">
                                            <li><strong>Child Supervision:</strong> Is it the kind of online program that my child can watch even with minimal supervision only?</li>
                                            <li><strong>Child-Friendly:</strong> Will I want my child to watch this program because it is child-friendly?</li>
                                        </ol>
                                        <p class="mb-6 text-base"><strong>Ratings:</strong>
                                            <ul class="list-disc pl-6">
                                                <li>1-6 = NOT Child Sensitive</li>
                                                <li>7-10 = Child Sensitive (elevated to the second level of judging)</li>
                                            </ul>
                                        </p>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
                <v-row justify="center">
                    <v-col cols="7" md="3" lg="2">
                        <BaseButton @click="goTo('/judge/judging')" :text="'Judge Now'" />
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
    /* background: #ed8682; */
}
.card-border {
    border-radius: 20px !important;
}
</style>
