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
            entries: [],
            tallies: [],
            loading: false,
            confirmDialog: true,
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
                                title: error.response.data.message,
                                icon: "error",
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
            if (valid) {
                window.axios
                    .post("/api/judging", { tallies: this.tallies })
                    .then((response) => {
                        Swal.fire({
                            icon: "success",
                            title: "Tallies Submitted",
                            icon: "success",
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                    })
                    .finally(() => {
                        // this.loading = false;
                        // this.loading = true;
                    });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Please rate all entries",
                    icon: "error",
                });
            }
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
        <v-form ref="entriesForm" lazy-validation>
            <v-row justify="center" class="pa-5">
                <v-col
                    v-for="(entry, index) in entries"
                    :key="index"
                    cols="12"
                    md="4"
                    lg="4"
                >
                    <v-card height="400">
                        <v-card-title class="text-center">
                            {{ entry.title }}
                        </v-card-title>

                        <v-card-text class="text-center">
                            <YouTube
                                :src="entry.link"
                                width="100%"
                                height="300"
                                ref="youtube"
                                class="contain"
                            />
                            <v-rating
                                color="primary"
                                v-model="tallies[index].rating"
                                :rules="[rules.required]"
                            ></v-rating>
                        </v-card-text>
                    </v-card>
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
                <v-form ref="tokenForm" lazy-validation>
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
</template>
<style scoped>
.card-border {
    border-radius: 20px !important;
}
</style>
