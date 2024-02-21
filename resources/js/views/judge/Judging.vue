<script>
import BaseButton from "../../components/BaseButton.vue";
import Swal from "sweetalert2";
import YouTube from "vue3-youtube";
import store from "../../store";
export default {
    components: { BaseButton, YouTube },
    data() {
        return {
            token: "",
            consent: false,
            entries: [],
            tallies: [],
            loading: false,
            confirmDialog: true,
            successDialog: false,
            entryInfoDialog: false,
            rules: {
                required: (value) => !!value || "Required.",
            },
        };
    },
    methods: {
        goTo(route) {
            // router.push(route);
        },
        async validateToken() {
            const { valid } = await this.$refs.tokenForm.validate();
            if (valid) {
                this.confirmDialog = false;
                this.loading = true;
                //Clear store jurorToken
                store.dispatch("setJurorToken", null);

                //Add in the axios headers the token
                window.axios.defaults.headers.common["X-Juror-Token"] =
                    this.token;
                window.axios
                    .get("/api/tokenCheck")
                    .then((response) => {
                        store.dispatch("setJurorToken", this.token);
                        store.dispatch("setJuror", response.data.juror);
                        this.fetchEntries();
                        setTimeout(() => {
                            this.confirmDialog = false;
                            this.loading = false;
                        }, 3000);
                    })
                    .catch((error) => {
                        setTimeout(() => {
                            this.confirmDialog = true;
                            this.loading = false;
                            Swal.fire({
                                icon: "error",
                                title: error.response.data.error,
                            });
                        }, 3000);
                    })
                    .finally(() => {
                        // this.loading = false;
                        // this.loading = true;
                    });
            }
        },

        fetchEntries() {
            window.axios
                .get("/api/judging")
                .then((response) => {
                    this.entries = response.data;
                    this.entries.forEach((entry) => {
                        this.tallies.push({
                            entry_id: entry.id,
                            rating: null,
                        });
                    });
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    // this.loading = false;
                    // this.loading = true;
                });
        },

        async submitEntries() {
            //Check if all tallies rating is not null
            let valid = true;
            this.tallies.forEach((tally) => {
                if (tally.rating == null) {
                    valid = false;
                }
            });
            //Validate entry form
            const { validEntry } = await this.$refs.form.validate();
            if (this.consent == false) {
                Swal.fire({
                    icon: "error",
                    title: "Please check the data privacy consent",
                });
                return;
            }
            if (valid && this.consent) {
                window.axios
                    .post("/api/judging", { tallies: this.tallies })
                    .then((response) => {
                        Swal.fire({
                            icon: "success",
                            title: "Tallies Submitted",
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                    })
                    .finally(() => {
                        this.successDialog = true;
                    });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Please rate all entries",
                });
            }
        },

        entryInfo(entry) {
            this.entry = entry;
            this.entryInfoDialog = true;
        },

        backHome() {
            this.$router.push({ name: "home" });
        },
    },
};
</script>

<template>
    <v-overlay
        v-model="loading"
        color="white"
        z-index="1"
        class="align-center justify-center opacity-90"
    >
        <v-progress-circular
            :size="100"
            :width="5"
            color="primary"
            indeterminate
        ></v-progress-circular>
    </v-overlay>
    <div v-if="!confirmDialog && !loading">
        <v-form ref="form" lazy-validation @submit.prevent="submitEntries()">
            <v-row justify="center" class="pa-5">
                <v-col
                    v-for="(entry, index) in entries"
                    :key="index"
                    cols="12"
                    md="4"
                    lg="4"
                >
                    <v-card height="400" class="elevation-0">
                        <v-card-text class="text-center">
                            <div class="flex justify-between py-2">
                                <div
                                    class="text-left font-weight-bold text-xl text-truncate"
                                >
                                    {{ entry.title }}
                                </div>
                                <div class="text-right">
                                    <v-icon
                                        size="30"
                                        @click="entryInfo(entry)"
                                        color="primary"
                                    >
                                        mdi-information
                                    </v-icon>
                                </div>
                            </div>
                            <YouTube
                                :src="entry.link"
                                width="100%"
                                height="300"
                                ref="youtube"
                                class="contain"
                            />
                            <v-rating
                                density="comfortable"
                                length="10"
                                color="primary"
                                v-model="tallies[index].rating"
                            ></v-rating>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" class="ma-0">
                    <v-checkbox
                        color="success"
                        v-model="consent"
                        label="I HEREBY CERTIFY that the information provided in this form is complete, true and correct to the best of my knowledge. I give my consent to AnakTV  to collect, use and process my personal information. I understand that my consent does not preclude the existence of other criteria for lawful processing of personal data, and does not waive any of my rights under the Data Privacy Act of 2012 and other applicable laws."
                        :rules="[rules.required]"
                    >
                    </v-checkbox>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="7" md="3" lg="2">
                    <BaseButton @click="submitEntries()" :text="'Submit'" />
                </v-col>
            </v-row>
        </v-form>
    </div>
    <v-dialog v-model="confirmDialog" persistent max-width="500" z-index="999">
        <v-card>
            <v-card-title class="text-center"> Enter Juror Token </v-card-title>

            <v-card-text>
                <v-form ref="tokenForm" lazy-validation @submit.prevent="validateToken()">
                    <v-text-field
                        v-model="token"
                        label="Juror Token"
                        placeholder="Input token"
                        variant="outlined"
                        :show-size="1000"
                        :rules="[rules.required]"
                    >
                        <template v-slot:label
                            >Juror Token
                            <strong class="text-error">*</strong>
                        </template>
                    </v-text-field>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn
                    block
                    variant="elevated"
                    color="primary"
                    @click="validateToken()"
                    >Confirm</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
    <v-dialog v-model="successDialog" persistent fullscreen z-index="999">
        <v-card>
            <v-card-text class="p-8 d-flex align-center justify-center">
                <div>
                    <v-row justify="center" class="text-center space-y-4 mb-12">
                        <v-col>
                            <h1 class="text-congrats font-bold text-green-500">
                                ALL SET.
                            </h1>
                            <h1 class="text-congrats font-bold text-blue-500">
                                THANK YOU!
                            </h1>
                            <p class="text-xl text-gray-600">
                                You've successfully submitted your entries
                            </p>
                        </v-col>
                    </v-row>
                    <!-- <v-row justify="center" class="mt-6">
                        <v-col cols="12" md="8" lg="2"> -->
                    <BaseButton @click="backHome()" :text="'RETURN TO HOME'" />
                    <!-- </v-col> -->
                    <!-- </v-row> -->
                </div>
            </v-card-text>
        </v-card>
    </v-dialog>
    <v-dialog v-model="entryInfoDialog" z-index="999" max-width="500">
        <v-card>
            <v-card-title class="text-center"> {{ entry.title }} </v-card-title>
            <v-card-text class="p-8 d-flex align-center justify-center">
                <!-- Add Synopsis and Other Information -->
                <v-row justify="space-between" class="text-start">
                    <v-col cols="12">
                        <span class="text-gray-600">Synopsis: </span>
                        <span class="text-black-600">
                            {{ entry.synopsis }}
                        </span>
                    </v-col>
                    <v-col cols="12">
                        <span class="text-gray-600">Production Company: </span>
                        <span class="text-black-600">
                            {{ entry.production_company }}
                        </span>
                    </v-col>
                    <v-col cols="12">
                        <span class="text-gray-600">Producers: </span>
                        <span class="text-black-600">
                            {{ entry.producers }}
                        </span>
                    </v-col>
                    <v-col cols="12">
                        <span class="text-gray-600">Executive Producers: </span>
                        <span class="text-black-600">
                            {{ entry.executive_producers }}
                        </span>
                    </v-col>
                    <v-col cols="12">
                        <span class="text-gray-600">Director: </span>
                        <span class="text-black-600">
                            {{ entry.directors }}
                        </span>
                    </v-col>
                    <v-col cols="12">
                        <span class="text-gray-600">Writer: </span>
                        <span class="text-black-600">
                            {{ entry.writers }}
                        </span>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
<style scoped>
.card-border {
    border-radius: 20px !important;
}

.text-congrats {
    font-size: 4rem;
    line-height: 1;
}
</style>
