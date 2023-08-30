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
            { title: "Actions", key: "actions", align: "end" },
        ],
        search: "",
        serverItems: [],
        loading: true,
        totalItems: 0,
    }),
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
                    this.totalItems = data.meta.total;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        deleteJuror(item) {
            console.log(item);
        },
    },

    mounted() {
        this.fetchJurors();
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
                            Add Jurors
                        </v-btn>
                    </v-toolbar>
                    <v-card-text>
                        <v-data-table
                            v-model:items-per-page="itemsPerPage"
                            :headers="headers"
                            :items-length="totalItems"
                            :items="serverItems"
                            :loading="loading"
                            elevation="0"
                            item-value="name"
                            @update:options="fetchJurors()"
                        >
                            <template v-slot:item.actions="{ item }">
                                <v-btn
                                    color="info"
                                    rounded="xl"
                                    size="x-small"
                                    icon="mdi-trash"
                                    @click="deleteJuror(item.selectable)"
                                />
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
