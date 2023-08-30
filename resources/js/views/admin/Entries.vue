<script>
import { VDataTable } from "vuetify/labs/VDataTable";
import { VDatePicker } from "vuetify/labs/VDatePicker";

export default {
    components: {
        VDataTable,
        VDatePicker,
    },
    data: () => ({
        itemsPerPage: 5,
        headers: [
            {
                title: "Network",
                align: "start",
                sortable: false,
                key: "company.name",
            },
            { title: "Title", key: "title", align: "end" },
            {
                title: "Production Company",
                key: "production_company",
                align: "end",
            },
            {
                title: "Executive Producers",
                key: "executive_producers",
                align: "end",
            },
            // { title: "Link", key: "link", align: "end" },
            { title: "Status", key: "status", align: "end" },
            {
                title: "Contact Email",
                key: "contact_person_email",
                align: "end",
            },
            { title: "Actions", key: "actions", align: "end" },
        ],
        search: "",
        serverItems: [],
        loading: true,
        totalItems: 0,
        entries: [],
        photo: "",
        photoDialog: false,
    }),
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
                    this.entries = data.data;
                    this.totalItems = data.meta.total;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        updateEntry(entry, status) {
            axios
                .put(`/api/companyEntries/${entry.id}`, {
                    status: status,
                })
                .then((response) => {
                    this.fetchEntries();
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        openPhotoDialog(entry) {
            this.photo = entry.payment_reference;
            this.photoDialog = true;
        },
    },

    mounted() {
        this.fetchEntries();
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
                        >
                            Add Entries
                        </v-btn>
                    </v-toolbar>
                    <v-card-text>
                        <v-data-table
                            v-model:items-per-page="itemsPerPage"
                            :headers="headers"
                            :items-length="totalItems"
                            :items="entries"
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
                                >
                                    {{ item.selectable.status }}
                                </v-chip>
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <v-btn
                                    v-if="item.selectable.status == 'PENDING'"
                                    class="mr-2"
                                    color="success"
                                    rounded="xl"
                                    size="x-small"
                                    icon="mdi-check"
                                    @click="
                                        updateEntry(item.selectable, 'APPROVED')
                                    "
                                />
                                <v-btn
                                    v-if="item.selectable.status == 'PENDING'"
                                    class="mr-2"
                                    color="red-darken-2"
                                    rounded="xl"
                                    size="x-small"
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
                                    rounded="xl"
                                    size="x-small"
                                    icon="mdi-eye"
                                    @click="openPhotoDialog(item.selectable)"
                                />
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
    <v-dialog v-model="photoDialog">
        <v-card>
            <v-img :src="photo"> </v-img>
        </v-card>
    </v-dialog>
</template>
