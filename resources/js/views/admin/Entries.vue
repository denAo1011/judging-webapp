<script>
import BaseButton from "../../components/BaseButton.vue";
import { VDataTable } from "vuetify/labs/VDataTable";
import { VDatePicker } from "vuetify/labs/VDatePicker";
import moment from "moment";
import Swal from "sweetalert2";

export default {
    components: {
        VDataTable,
        VDatePicker,
        BaseButton,
    },
    data: () => ({
        itemsPerPage: 10,
        headers: [
            {
                title: "Network",
                align: "start",
                sortable: false,
                key: "company.name",
            },
            { title: "Title", key: "title", align: "start" },
            {
                title: "Production Company",
                key: "production_company",
                align: "start",
            },
            // {
            //     title: "Executive Producers",
            //     key: "executive_producers",
            //     align: "start",
            // },
            // { title: "Link", key: "link", align: "start" },
            { title: "Status", key: "status", align: "start" },
            {
                title: "Contact Email",
                key: "contact_person_email",
                align: "start",
            },
            { title: "Actions", key: "actions", align: "end" },
        ],
        search: "",
        serverItems: [],
        loading: true,
        editedIndex: -1,
        networks: [],
        entry: {},
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
        photo: "",
        dateMenu: false,
        entryDialog: false,
        photoDialog: false,
    }),
    computed: {
        viewMode() {
            return this.editedIndex >= 0;
        },

        formattedDate() {
            return this.entry.premiere_date
                ? moment(this.entry.premiere_date).format("MMMM Do YYYY")
                : "";
        },
    },
    methods: {
        fetchEntries() {
            this.loading = true;
            axios
                .get("/api/companyEntries", {
                    params: {
                        perPage: 0,
                    },
                })
                .then((response) => {
                    let data = response.data;
                    this.serverItems = data.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        fetchNetworks() {
            axios
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

        updateEntry(entry, status) {
            axios
                .put(`/api/companyEntries/${entry.id}`, {
                    status: status,
                })
                .then((response) => {
                    this.fetchEntries();
                    Swal.fire({
                        icon: "success",
                        title: "Entry Updated!",
                        icon: "success",
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        async submitEntry() {
            const { valid } = await this.$refs.form.validate();
            if (valid) {
                axios
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
                            icon: "success",
                        });
                        this.fetchEntries();
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: "error",
                            title: "Invalid Credentials",
                            icon: "error",
                        });
                        // this.errors = {
                        //     email: error.response.data,
                        //     password: error.response.data,
                        // };
                        console.log(error);
                    })
                    .finally(() => {
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
                    });
            }
        },

        openCreateDialog() {
            this.editedIndex = -1;
            this.entry = {};
            this.entryDialog = true;
        },

        viewDetails(entry) {
            this.editedIndex = this.serverItems.indexOf(entry);
            this.entry = entry;
            this.entry.network = entry.company.id;
            this.entryDialog = true;
        },

        openPhotoDialog() {
            this.photo = this.entry.payment_reference;
            this.photoDialog = true;
        },
    },

    mounted() {
        this.fetchEntries();
        this.fetchNetworks();
    },
};
</script>
<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card>
                    <v-toolbar elevation="0" color="transparent">
                        <v-spacer />
                        <v-btn
                            color="success"
                            variant="elevated"
                            rounded="lg"
                            prepend-icon="mdi-plus"
                            size="small"
                            @click="openCreateDialog()"
                        >
                            Add Entries
                        </v-btn>
                    </v-toolbar>
                    <v-card-text>
                        <v-data-table
                            v-model:items-per-page="itemsPerPage"
                            :headers="headers"
                            :items="serverItems"
                            :loading="loading"
                            elevation="0"
                            item-value="name"
                            @update:options="fetchEntries"
                        >
                            <template v-slot:item.status="{ item }">
                                <v-chip
                                    :color="
                                        item.selectable.status == 'PENDING'
                                            ? 'warning'
                                            : item.selectable.status ==
                                              'APPROVED'
                                            ? 'success'
                                            : 'error'
                                    "
                                    variant="elevated"
                                    small
                                >
                                    {{ item.selectable.status }}
                                </v-chip>
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <div>
                                    <v-btn
                                        v-if="
                                            item.selectable.status == 'PENDING'
                                        "
                                        color="success"
                                        variant="text"
                                        icon="mdi-check"
                                        @click="
                                            updateEntry(
                                                item.selectable,
                                                'APPROVED'
                                            )
                                        "
                                    />
                                    <v-btn
                                        v-if="
                                            item.selectable.status == 'PENDING'
                                        "
                                        color="red-darken-2"
                                        variant="text"
                                        icon="mdi-close"
                                        @click="
                                            updateEntry(
                                                item.selectable,
                                                'DISAPPROVED'
                                            )
                                        "
                                    />
                                    <v-btn
                                        color="info"
                                        variant="text"
                                        icon="mdi-eye"
                                        @click="viewDetails(item.selectable)"
                                    />
                                </div>
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
    <v-dialog v-model="entryDialog" max-width="1000px">
        <v-card>
            <v-card-text>
                <v-form ref="form" :readonly="viewMode">
                    <v-row>
                        <v-col cols="12" class="ma-0">
                            <h3 class="text-lg font-bold">Network Details</h3>
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
                                v-model="entry.contact_person_email"
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
                                v-model="entry.contact_person_number"
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
                            <h3 class="text-lg font-bold">Program Details</h3>
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
                                    <strong class="text-error">*</strong>
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
                                <template v-slot:activator="{ props }">
                                    <v-text-field
                                        variant="underlined"
                                        label="Date Published"
                                        readonly
                                        v-bind="props"
                                        v-model="formattedDate"
                                        :rules="[rules.required]"
                                    >
                                        <template v-slot:label
                                            >Date Published
                                            <strong class="text-error"
                                                >*</strong
                                            >
                                        </template>
                                    </v-text-field>
                                </template>
                                <v-date-picker
                                    v-model="entry.premiere_date"
                                    @click:save="dateMenu = false"
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
                                    <strong class="text-error">*</strong>
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
                                    <strong class="text-error">*</strong>
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
                                    <strong class="text-error">*</strong>
                                </template>
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" class="ma-0" lg="6">
                            <v-text-field
                                variant="underlined"
                                label="Production Company"
                                v-model="entry.production_company"
                                :rules="[rules.required]"
                            >
                                <template v-slot:label
                                    >Production Company
                                    <strong class="text-error">*</strong>
                                </template>
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <span
                                class="text-medium-emphasis text-caption text-error"
                            >
                                Disclaimer: For Producers, Executive Producers,
                                Directors, and Writer, please use comma (,) to
                                separate multiple entries
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
                                v-model="entry.executive_producers"
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
                                    <strong class="text-error">*</strong>
                                </template>
                            </v-textarea>
                        </v-col>
                    </v-row>
                    <v-row v-if="viewMode">
                        <v-col cols="12" class="ma-0">
                            <h3 class="text-lg font-bold">Payment Details</h3>
                        </v-col>
                        <v-col cols="12" lg="6" class="ma-0">
                            <v-text-field
                                v-model="entry.payment_reference_number"
                                label="Payment Referrence Number"
                                placeholder="Input the referrence number"
                                variant="outlined"
                                :show-size="1000"
                                :rules="[rules.required]"
                            >
                                <template v-slot:label
                                    >Payment Referrence Number
                                    <strong class="text-error">*</strong>
                                </template>
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" lg="6" class="ma-0">
                            <v-btn
                                size="x-large"
                                block
                                color="primary"
                                @click="openPhotoDialog()"
                            >
                                View Payment Reference
                            </v-btn>
                        </v-col>
                    </v-row>
                    <v-row v-if="!viewMode" justify="end" class="pb-5">
                        <v-col cols="7" md="4" lg="4">
                            <!-- <button type="submit"> -->
                            <BaseButton
                                @click="submitEntry()"
                                :text="'Submit Entry'"
                            />
                            <!-- </button> -->
                        </v-col>
                    </v-row>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
    <v-dialog v-model="photoDialog">
        <v-card>
            <v-img :src="photo"> </v-img>
        </v-card>
    </v-dialog>
</template>
