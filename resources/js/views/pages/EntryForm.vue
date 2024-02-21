<script>
import Swal from "sweetalert2";
import { onMounted, ref } from "vue";
import BaseButton from "../../components/BaseButton.vue";
import { VDatePicker } from "vuetify/labs/VDatePicker";
import { useRouter } from "vue-router";
import { Store } from "vuex";
import moment from "moment";
export default {
    components: { BaseButton, VDatePicker },
    data() {
        return {
            entry: {
                network: "",
                link: "",
                title: "",
                day_of_airing: ["MONDAY"],
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
                payment_reference_number: "",
            },
            dateMenu: false,
            networks: [],
            image_name: [],
            disclaimerDialog: true,
            rules: {
                required: (value) => !!value || "Required.",
                email: (value) => {
                    if (!value) {
                        return "Required.";
                    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                        return "Invalid Email.";
                    }
                    return true;
                },
                number: (value) => {
                    if (!value) {
                        return "Required.";
                    } else if (!/^\d+$/.test(value)) {
                        return "Must be a number.";
                    }
                },
                link: (value) => {
                    if (!value) {
                        return "Required.";
                    } else if (
                        !/^https?:\/\/(?:www\.)?youtube\.com\/watch\?(?=.*v=\w+).*$/i.test(
                            value
                        )
                    ) {
                        return "Invalid Link.";
                    }
                    return true;
                },
            },
        };
    },
    methods: {
        async submitEntry() {
            console.log(this.image_name[0].type);
            const { valid } = await this.$refs.form.validate();
            if (
                this.entry.payment_reference.length == 0 ||
                this.entry.payment_reference == null
            ) {
                await Swal.fire({
                    icon: "warning",
                    title: "Incomplete form!",
                    text: "Please upload a screenshot of your payment referrence",
                });
                return;
            }
            //Check if image_name is a image file
            let types = ["image/jpeg", "image/png", "image/jpg"];
            if (
                !this.image_name[0] ||
                !types.includes(this.image_name[0].type)
            ) {
                await Swal.fire({
                    icon: "warning",
                    title: "Incomplete form!",
                    text: "Please upload an image file only",
                });
            }
            if (valid) {
                window.axios
                    .post(
                        "/api/companies/" +
                            this.entry.network +
                            "/companyEntries",
                        {
                            ...this.entry,
                            email: this.entry.contact_person_email,
                            premiere_date: moment(
                                this.entry.premiere_date
                            ).format("YYYY-MM-DD"),
                        }
                    )
                    .then((response) => {
                        // Store.dispatch("login", response.data.token);
                        Swal.fire({
                            icon: "success",
                            title: "Entry Submitted!",
                        });
                        this.entry = {
                            ...this.entry,
                            link: "",
                            title: "",
                            day_of_airing: ["MONDAY"],
                            time_of_airing: "",
                            production_company: "",
                            synopsis: "",
                            producers: "",
                            executive_producers: "",
                            premiere_date: "",
                            directors: "",
                            writers: "",
                        };
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: "error",
                            title: error.response.data.message,
                        });
                        console.log(error);
                    })
                    .finally(() => {});
            }
        },
        fetchNetworks() {
            window.axios
                .get("/api/companies", {
                    params: {
                        perPage: 0,
                    },
                })
                .then((response) => {
                    this.networks = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        convertImage() {
            try {
                const file = this.image_name[0];
                const blob = new Blob([file], { type: file.type });
                const reader = new FileReader();
                reader.onload = () => {
                    this.entry.payment_reference = reader.result;
                };
                reader.readAsDataURL(blob);
            } catch (error) {
                this.image_name = null;
                this.entry.payment_reference = null;
            }
        },
    },
    computed: {
        formattedDate() {
            return this.entry.premiere_date
                ? moment(this.entry.premiere_date).format("MMMM Do YYYY")
                : "";
        },
    },
    mounted() {
        this.fetchNetworks();
        window.scrollTo(0, 0);
    },
};
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
                        <v-card class="card-border">
                            <v-card-text>
                                <v-form ref="form">
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
                                                v-model="entry.network"
                                                :rules="[rules.required]"
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
                                                label="Contact Person"
                                                v-model="entry.contact_person"
                                                :rules="[rules.required]"
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
                                                label="Contact Person Email"
                                                v-model="
                                                    entry.contact_person_email
                                                "
                                                :rules="[rules.email]"
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
                                                label="Contact Person Number"
                                                v-model="
                                                    entry.contact_person_number
                                                "
                                                :rules="[rules.number]"
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
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                label="Title"
                                                v-model="entry.title"
                                                :rules="[rules.required]"
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
                                            <v-menu
                                                v-model="dateMenu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                transition="scale-transition"
                                                end
                                                min-width="auto"
                                            >
                                                <template
                                                    v-slot:activator="{ props }"
                                                >
                                                    <v-text-field
                                                        variant="underlined"
                                                        label="Date Published"
                                                        readonly
                                                        v-bind="props"
                                                        v-model="formattedDate"
                                                        :rules="[
                                                            rules.required,
                                                        ]"
                                                    >
                                                        <template v-slot:label
                                                            >Date Published
                                                            <strong
                                                                class="text-error"
                                                                >*</strong
                                                            >
                                                        </template>
                                                    </v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="
                                                        entry.premiere_date
                                                    "
                                                    @click:save="
                                                        dateMenu = false
                                                    "
                                                ></v-date-picker>
                                            </v-menu>
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-select
                                                :items="[
                                                    'MONDAY',
                                                    'TUESDAY',
                                                    'WEDNESDAY',
                                                    'THURSDAY',
                                                    'FRIDAY',
                                                    'SATURDAY',
                                                    'SUNDAY',
                                                ]"
                                                multiple
                                                variant="underlined"
                                                label="Day of Airing"
                                                v-model="entry.day_of_airing"
                                                :rules="[rules.required]"
                                            >
                                                <template v-slot:label
                                                    >Day of Airing
                                                    <strong class="text-error"
                                                        >*</strong
                                                    >
                                                </template>
                                            </v-select>
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                label="Time of Airing"
                                                type="time"
                                                v-model="entry.time_of_airing"
                                                :rules="[rules.required]"
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
                                                label="Link of Entry"
                                                v-model="entry.link"
                                                :rules="[rules.link]"
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
                                                label="Production Company"
                                                v-model="
                                                    entry.production_company
                                                "
                                                :rules="[rules.required]"
                                            >
                                                <template v-slot:label
                                                    >Production Company
                                                    <strong class="text-error"
                                                        >*</strong
                                                    >
                                                </template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <span
                                                class="text-medium-emphasis text-caption text-error"
                                            >
                                                Disclaimer: For Producers,
                                                Executive Producers, Directors,
                                                and Writer, please use comma (,)
                                                to separate multiple entries
                                            </span>
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                label="Producer(s)"
                                                v-model="entry.producers"
                                            />
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                label="Executive Producer(s)"
                                                v-model="
                                                    entry.executive_producers
                                                "
                                            />
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                label="Director(s)"
                                                v-model="entry.directors"
                                            />
                                        </v-col>
                                        <v-col cols="12" class="ma-0" lg="3">
                                            <v-text-field
                                                variant="underlined"
                                                label="Writer(s)"
                                                v-model="entry.writers"
                                            />
                                        </v-col>
                                        <v-col cols="12" class="ma-0">
                                            <v-textarea
                                                variant="underlined"
                                                label="Program Synopsis"
                                                v-model="entry.synopsis"
                                                :rules="[rules.required]"
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
                                        <!-- Display the bank details -->
                                        <v-col cols="12" class="ma-0">
                                            <h3 class="text-sm">
                                                Bank:
                                                <strong
                                                    >Metrobank Tomas
                                                    Morato</strong
                                                ><br />
                                                Bank Account name:
                                                <strong>Anak TV Inc.</strong
                                                ><br />
                                                Account number:
                                                <strong>007 180 50946 8</strong>
                                            </h3>
                                        </v-col>
                                        <span
                                            class="ml-3 text-medium-emphasis text-caption text-error"
                                        >
                                            Disclaimer: Please input the
                                            referrence number and upload a
                                            screenshot of your payment
                                            referrence
                                        </span>
                                        <v-col cols="12" lg="6" class="ma-0">
                                            <v-text-field
                                                v-model="
                                                    entry.payment_reference_number
                                                "
                                                label="Payment Referrence Number"
                                                placeholder="Input the referrence number"
                                                variant="outlined"
                                                :show-size="1000"
                                                :rules="[rules.required]"
                                            >
                                                <template v-slot:label
                                                    >Payment Referrence Number
                                                    <strong class="text-error"
                                                        >*</strong
                                                    >
                                                </template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" lg="6" class="ma-0">
                                            <v-file-input
                                                v-model="image_name"
                                                label="Payment Referrence"
                                                placeholder="Select your files"
                                                prepend-icon="mdi-paperclip"
                                                variant="outlined"
                                                @change="convertImage()"
                                                accept="image/*"
                                                :show-size="1000"
                                                :rules="[rules.required]"
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
                                                label="I HEREBY CERTIFY that the information provided in this form is complete, true and correct to the best of my knowledge. I give my consent to AnakTV  to collect, use and process my personal information. I understand that my consent does not preclude the existence of other criteria for lawful processing of personal data, and does not waive any of my rights under the Data Privacy Act of 2012 and other applicable laws."
                                                :rules="[rules.required]"
                                            >
                                            </v-checkbox>
                                        </v-col>
                                    </v-row>
                                    <v-row justify="center" class="pb-5">
                                        <!-- <v-col cols="7" md="4" lg="4"> -->
                                        <!-- <button type="submit"> -->
                                        <BaseButton
                                            @click="submitEntry()"
                                            :text="'Submit Entry'"
                                        />
                                        <!-- </button> -->
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
    <v-dialog v-model="disclaimerDialog" persistent width="500">
        <v-card class="card-border">
            <v-card-title class="text-h5 text-center"> Notice! </v-card-title>
            <v-card-text>
                You can opt to skip the online submission process if you prefer
                to pay in cash or by cheque. Offline submission must be
                completed at the Anak TV office.
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="green-darken-1"
                    class="mr-3"
                    @click="disclaimerDialog = false"
                >
                    Continue
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<style scoped>
.home-container {
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    /* Add Linear Background */
    background: #b7f1a5;
}

.card-border {
    border-radius: 20px !important;
}
</style>
