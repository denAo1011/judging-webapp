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
                        Competition Guidelines
                    </h1>
                </v-row>
                <v-row>
                    <v-col data-aos="flip-down"  data-aos-anchor-placement="center-center" cols="12" md="4">
                        <v-card color="#885598" class="card-border">
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" class="text-white">
                                        <h2 class="text-center text-2xl lg:text-3xl font-semibold my-4">Submission Guidelines</h2>
                                        <ul class="list-disc pl-6 mb-6 text-base">
                                            <li>Eligibility: Any online show produced by the Anak TV member-networks between <strong>July 1, 2021</strong> and <strong>June 30, 2023</strong> is eligible for the Anak TV Seal Awards (online category).</li>
                                            <li>Advocacy Relevance: The content must be relevant to the advocacy of Anak TV.</li>
                                            <li>Entry Length: Acceptable length of the entries:
                                                <ul class="list-disc pl-6">
                                                    <li><strong>Short Form:</strong> 3 minutes (minimum) to 5 minutes</li>
                                                    <li><strong>Long Form:</strong> over 5 minutes (minimum) to 30 minutes</li>
                                                </ul>
                                            </li>
                                            <li>Anak TV will not accept YouTube Shorts which are less than <strong>3 minutes</strong>.</li>
                                            <!-- Add more guidelines here -->
                                        </ul>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col data-aos="flip-down"  data-aos-anchor-placement="center-center" cols="12" md="4">
                        <v-card color="#769657" class="card-border">
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" class="text-white">
                                        <h2 class="text-center text-base lg:text-3xl font-semibold my-4">Judging Process</h2>
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
                    <v-col data-aos="flip-down"  data-aos-anchor-placement="center-center" cols="12" md="4">
                        <v-card color="#5452a3" class="card-border">
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" class="text-white">
                                        <h2 class="text-center text-base lg:text-3xl font-semibold my-4">Timelines and Deadlines</h2>
                                        <p class="mb-2 text-base">Submission Deadline: <strong> August 26 to September 1, 2023</strong></p>
                                        <p class="mb-2 text-base">First Level Judging: <strong> October 1 to 15, 2023</strong></p>
                                        <p>Second Level Judging: <strong >November 1 to 15, 2023</strong></p>
                                        <!-- Add more timeline and deadline details here -->
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
                <v-row justify="center">
                    <v-col cols="7" md="4" lg="4">
                        <BaseButton @click="goTo('/entry-form')" :text="'Submit Entry'" />
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
</style>
