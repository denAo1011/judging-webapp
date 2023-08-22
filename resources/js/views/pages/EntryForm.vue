<script setup>
import { ref } from "vue";
import BaseButton from "../../components/BaseButton.vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

let store = useStore();
let router = useRouter();

let entry = ref({
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
    payment_reference: [],
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

let entryForm = ref(false);

function email(value) {
    if (!value) return true;
    return /.+@.+\..+/.test(value) || "E-mail must be valid";
}

function number(value) {
    if (!value) return true;
    return /^\d+$/.test(value) || "Must be a number";
}

function required(value) {
    return !!value || "Required.";
}

function submitEntry() {
    if (this.entryForm) {
        console.log("Valid");
    }
}
</script>

<template>
    <div class="home-container py-10">
        <v-row justify="center">
            <v-col cols="11" xl="10">
                <v-row justify="center" class="pa-5 text-center">
                    <h1 class="text-5xl font-bold text-white">
                        Submission Form
                    </h1>
                </v-row>
                <v-row justify="center">
                    <v-col cols="12" md="8">
                        <v-card class="card-border">
                            <v-card-text>
                                <v-form
                                    v-model="entryForm"
                                    @submit.prevent="submitEntry"
                                >
                                    <v-row>
                                        <v-col cols="12" class="ma-0">
                                            <h3 class="text-lg font-bold">
                                                Network Details
                                            </h3>
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-select
                                                :items="networks"
                                                item-value="id"
                                                item-title="name"
                                                variant="underlined"
                                                color="primary"
                                                v-model="entry.network"
                                                :rules="[required]"
                                            >
                                                <template v-slot:label
                                                    >Network
                                                    <strong class="text-error"
                                                        >*</strong
                                                    ></template
                                                >
                                            </v-select>
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Contact Person"
                                                v-model="entry.contact_person"
                                                :rules="[required]"
                                                ><template v-slot:label
                                                    >Contact Person
                                                    <strong class="text-error"
                                                        >*</strong
                                                    ></template
                                                ></v-text-field
                                            >
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Contact Person Email"
                                                v-model="
                                                    entry.contact_person_email
                                                "
                                                :rules="[required, email]"
                                            >
                                                <template v-slot:label>
                                                    Email
                                                    <strong class="text-error"
                                                        >*</strong
                                                    ></template
                                                ></v-text-field
                                            >
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Contact Person Number"
                                                v-model="
                                                    entry.contact_person_number
                                                "
                                                :rules="[required, number]"
                                                ><template v-slot:label
                                                    >Number
                                                    <strong class="text-error"
                                                        >*</strong
                                                    ></template
                                                ></v-text-field
                                            >
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12" class="ma-0">
                                            <h3 class="text-lg font-bold">
                                                Program Details
                                            </h3>
                                            <span
                                                class="text-medium-emphasis text-caption text-error"
                                            >
                                                Disclaimer: For Producers,
                                                Executive Producers, Directors,
                                                Writer for separate comma
                                            </span>
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Title"
                                                v-model="entry.title"
                                                :rules="[required]"
                                            >
                                                <template v-slot:label
                                                    >Title
                                                    <strong class="text-error"
                                                        >*</strong
                                                    >
                                                </template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Date Published"
                                                v-model="entry.premiere_date"
                                                :rules="[required]"
                                            >
                                                <template v-slot:label
                                                    >Date Published
                                                    <strong class="text-error"
                                                        >*</strong
                                                    >
                                                </template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Day of Airing"
                                                v-model="entry.day_of_airing"
                                                :rules="[required]"
                                            >
                                                <template v-slot:label
                                                    >Dat of Airing
                                                    <strong class="text-error"
                                                        >*</strong
                                                    >
                                                </template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Time of Airing"
                                                v-model="entry.time_of_airing"
                                                :rules="[required]"
                                            >
                                                <template v-slot:label
                                                    >Time of Airing
                                                    <strong class="text-error"
                                                        >*</strong
                                                    >
                                                </template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="6">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Link of Entry"
                                                v-model="entry.link"
                                                :rules="[required]"
                                            >
                                                <template v-slot:label
                                                    >Link of Entry
                                                    <strong class="text-error"
                                                        >*</strong
                                                    >
                                                </template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="6">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Production Company"
                                                v-model="
                                                    entry.production_company
                                                "
                                                :rules="[required]"
                                            >
                                                <template v-slot:label
                                                    >Production Company
                                                    <strong class="text-error"
                                                        >*</strong
                                                    >
                                                </template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Producer(s)"
                                                v-model="entry.producers"
                                            />
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Executive Producer(s)"
                                                v-model="
                                                    entry.executive_producers
                                                "
                                            />
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Director(s)"
                                                v-model="entry.directors"
                                            />
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                color="primary"
                                                label="Writer(s)"
                                                v-model="entry.writers"
                                            />
                                        </v-col>
                                        <v-col cols="12" class="ma-0">
                                            <v-textarea
                                                variant="underlined"
                                                color="primary"
                                                label="Program Synopsis"
                                                v-model="entry.synopsis"
                                                :rules="[required]"
                                            >
                                                <template v-slot:label
                                                    >Program Sypnosis
                                                    <strong class="text-error"
                                                        >*</strong
                                                    >
                                                </template>
                                            </v-textarea>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12" class="ma-0">
                                            <h3 class="text-lg font-bold">
                                                Payment Details
                                            </h3>
                                        </v-col>
                                        <v-col cols="12" class="ma-0">
                                            <v-file-input
                                                v-model="
                                                    entry.payment_reference
                                                "
                                                label="Payment Referrence"
                                                placeholder="Select your files"
                                                prepend-icon="mdi-paperclip"
                                                variant="outlined"
                                                :show-size="1000"
                                                :rules="[required]"
                                            >
                                                <template v-slot:label
                                                    >Payment Referrence
                                                    <strong class="text-error"
                                                        >*</strong
                                                    >
                                                </template>
                                            </v-file-input>
                                        </v-col>
                                        <v-col cols="12" class="ma-0">
                                            <v-checkbox
                                                color="success"
                                                v-model="entry.verify"
                                                :rules="[required]"
                                                label="I hereby certify that the information provided in this form is complete, true and correct to the best of my knowledge."
                                            >
                                            </v-checkbox>
                                        </v-col>
                                    </v-row>
                                    <v-row justify="center" class="pb-5">
                                        <!-- <v-col cols="7" md="4" lg="4"> -->
                                        <button type="submit">
                                            <BaseButton
                                                @click="submitEntry()"
                                                :text="'Submit Entry'"
                                            />
                                        </button>
                                        <!-- </v-col> -->
                                    </v-row>
                                </v-form>
                            </v-card-text>
                        </v-card>
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
    background: #885598;
}

.card-border {
    border-radius: 20px !important;
}
</style>
