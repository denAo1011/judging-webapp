<script>
import { VDataTable } from "vuetify/labs/VDataTable";
import { VDatePicker } from "vuetify/labs/VDatePicker";
import Swal from "sweetalert2";

export default {
    components: {
        VDataTable,
        VDatePicker,
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
            { title: "Name", key: "name", align: "end" },
            {
                title: "Position",
                key: "position",
                align: "end",
            },
            {
                title: "Token",
                key: "token",
                align: "end",
            },
            {
                title: "Status",
                key: "voted_at",
                align: "end",
            },
            { title: "Actions", key: "actions", align: "end" },
        ],
        search: "",
        serverItems: [],
        networks: [],
        juror: {},
        loading: true,
        editedIndex: -1,
        rules: {
            required: (value) => !!value || "Required.",
        },
        jurorDialog: false,
    }),
    computed: {
        buttonText() {
            return this.editedIndex === -1 ? "Create" : "Update";
        },
    },
    methods: {
        fetchJurors() {
            this.loading = true;
            axios
                .get("/api/companyJurors", {
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

        editJuror(item) {
            console.log(item);
            this.editedIndex = this.serverItems.indexOf(item);
            this.juror = Object.assign({}, item);
            this.juror.network = item.company.id;
            this.juror.is_current = item.is_current == 1 ? true : false;
            this.jurorDialog = true;
        },

        saveJuror() {
            this.juror.company_id = this.juror.network;
            this.juror.is_current = this.juror.is_current == true ? 1 : 0;
            if (this.editedIndex === -1) {
                this.createJuror();
            } else {
                this.updateJuror();
            }
        },

        createJuror() {
            axios
                .post(
                    `/api/companies/${this.juror.network}/companyJurors`,
                    this.juror
                )
                .then((response) => {
                    this.jurorDialog = false;
                    this.fetchJurors();
                    Swal.fire({
                        icon: "success",
                        title: "Juror Created",
                        icon: "success",
                    });
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.juror = {};
                });
        },

        updateJuror() {
            axios
                .put(`/api/companyJurors/${this.juror.id}`, this.juror)
                .then((response) => {
                    this.jurorDialog = false;
                    this.fetchJurors();
                    Swal.fire({
                        icon: "success",
                        title: "Juror Updated",
                        icon: "success",
                    });
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.juror = {};
                });
        },

        deleteJuror(item) {
            console.log(item);
        },

        openJurorDialog() {
            this.editedIndex = -1;
            this.juror = {};
            this.jurorDialog = true;
        },
    },

    mounted() {
        this.fetchJurors();
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
                            @click="openJurorDialog()"
                        >
                            Add Jurors
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
                            @update:options="fetchJurors()"
                        >
                            <template v-slot:item.voted_at="{ item }">
                                <v-chip :color="item.selectable.voted_at != null ? 'success' : 'warning'">
                                    {{  item.selectable.voted_at != null ? "Voted" : "Pending" }}
                                </v-chip>
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <v-btn
                                    color="warning"
                                    variant="text"
                                    icon="mdi-pen"
                                    @click="editJuror(item.selectable)"
                                />
                                <v-btn
                                    color="red-darken-2"
                                    variant="text"
                                    icon="mdi-delete"
                                    @click="
                                        deleteJuror(
                                            item.selectable,
                                            'DISAPPROVED'
                                        )
                                    "
                                />
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
    <v-dialog v-model="jurorDialog" max-width="1000px">
        <v-card>
            <v-card-text>
                <v-form ref="form">
                    <v-row>
                        <v-col cols="12" class="ma-0" md="6">
                            <v-select
                                :items="networks"
                                item-value="id"
                                item-title="name"
                                variant="underlined"
                                v-model="juror.network"
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
                        <v-col cols="12" class="ma-0" md="6">
                            <v-text-field
                                variant="underlined"
                                label="Name"
                                v-model="juror.name"
                                :rules="[rules.required]"
                                ><template v-slot:label
                                    >Name
                                    <strong class="text-error"
                                        >*</strong
                                    ></template
                                ></v-text-field
                            >
                        </v-col>
                        <v-col cols="12" class="ma-0" md="6">
                            <v-text-field
                                variant="underlined"
                                label="Position"
                                v-model="juror.position"
                                :rules="[rules.required]"
                            >
                                <template v-slot:label>
                                    Position
                                    <strong class="text-error"
                                        >*</strong
                                    ></template
                                ></v-text-field
                            >
                        </v-col>
                        <v-col cols="12" class="ma-0" md="6">
                            <v-checkbox
                                color="success"
                                v-model="juror.is_current"
                                label="Current Juror"
                                :rules="[rules.required]"
                            >
                            </v-checkbox>
                        </v-col>
                    </v-row>
                    <v-row justify="end" class="mb-2">
                        <!-- <v-col cols="7" md="4" lg="4"> -->
                        <v-btn size="x-large" @click="saveJuror()">
                            {{ buttonText }}
                        </v-btn>
                        <!-- </v-col> -->
                    </v-row>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
