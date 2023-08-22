<script setup>
import { ref } from "vue";
import BaseButton from "../../components/BaseButton.vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

let store = useStore();
let router = useRouter();

let entry = ref({
    email: "",
    link: "",
    title: "",
    day_of_airing: "",
    time_of_airing: "",
    production_company: "",
    synopsis: "",
    contact_person: "",
    contact_person_email: "",
    contact_person_number: "",
    producers: "",
    executive_producers: "",
    premiere_date: "",
    directors: "",
    writers: "",
    payment_reference: "",
});

let networks = ref([
    { id: 1, name: "ABS-CBN" },
    { id: 2, name: "GMA" },
    { id: 3, name: "TV5" },
    { id: 4, name: "CNN Philippines" },
    { id: 5, name: "PTV" },
    { id: 6, name: "IBC" },
    { id: 7, name: "RPN" },
    { id: 8, name: "GMA News TV" },
    { id: 9, name: "A2Z" },
    { id: 10, name: "Other" },
]);
</script>

<template>
    <div class="home-container py-10">
        <v-row justify="center">
            <v-col cols="11" xl="10">
                <v-row justify="center" class="pa-5 text-center">
                    <h1 class="text-5xl font-bold text-primary">
                        Submission Form
                    </h1>
                </v-row>
                <v-row justify="center">
                    <v-col cols="12" md="8">
                        <v-card color="#885598" class="card-border">
                            <v-card-text class="text-white">
                                <v-form>
                                    <v-row>
                                        <v-col cols="12" lg="4">
                                            <v-text-field
                                                variant="solo"
                                                label="Email"
                                                v-model="entry.email"
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="4">
                                            <v-select
                                                :items="networks"
                                                item-value="id"
                                                item-title="name"
                                                variant="solo"
                                                label="Network"
                                                v-model="entry.network"
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="4">
                                            <v-text-field
                                                variant="solo"
                                                label="Title"
                                                v-model="entry.title"
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="4">
                                            <v-text-field
                                                variant="solo"
                                                label="Premiere Date"
                                                v-model="entry.premiere_date"
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="4">
                                            <v-text-field
                                                variant="solo"
                                                label="Day of Airing"
                                                v-model="entry.day_of_airing"
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="4">
                                            <v-text-field
                                                variant="solo"
                                                label="Time of Airing"
                                                v-model="entry.time_of_airing"
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="6">
                                            <v-text-field
                                                variant="solo"
                                                label="Link of Entry"
                                                v-model="entry.link"
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="6">
                                            <v-text-field
                                                variant="solo"
                                                label="Production Company"
                                                v-model="
                                                    entry.production_company
                                                "
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="3">
                                            <v-text-field
                                                variant="solo"
                                                label="Producer(s)"
                                                v-model="entry.producers"
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="3">
                                            <v-text-field
                                                variant="solo"
                                                label="Executive Producer(s)"
                                                v-model="
                                                    entry.executive_producers
                                                "
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="3">
                                            <v-text-field
                                                variant="solo"
                                                label="Director(s)"
                                                v-model="entry.directors"
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="3">
                                            <v-text-field
                                                variant="solo"
                                                label="Writer(s)"
                                                v-model="entry.writers"
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="4">
                                            <v-text-field
                                                variant="solo"
                                                label="Contact Person"
                                                v-model="entry.contact_person"
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="4">
                                            <v-text-field
                                                variant="solo"
                                                label="Contact Person Email"
                                                v-model="
                                                    entry.contact_person_email
                                                "
                                            />
                                        </v-col>
                                        <v-col cols="12" lg="4">
                                            <v-text-field
                                                variant="solo"
                                                label="Contact Person Number"
                                                v-model="
                                                    entry.contact_person_number
                                                "
                                            />
                                        </v-col>
                                        <v-col cols="12">
                                            <v-textarea
                                                variant="solo"
                                                label="Program Synopsis"
                                                v-model="entry.synopsis"
                                            />
                                        </v-col>
                                        <v-col cols="12">
                                            <v-checkbox
                                                color="success"
                                                v-model="entry.verify"
                                                label="I hereby certify that the information provided in this form is complete, true and correct to the best of my knowledge."
                                            >
                                            </v-checkbox>
                                        </v-col>
                                    </v-row>
                                </v-form>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
                <v-row justify="center">
                    <v-col cols="7" md="4" lg="4">
                        <BaseButton
                            @click="goTo('/entry-form')"
                            :text="'Submit Entry'"
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
    /* background: #ed8682; */
}

.card-border {
    border-radius: 20px !important;
}
</style>
