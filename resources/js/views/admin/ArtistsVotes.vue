<script>
import { VDataTable } from "vuetify/labs/VDataTable";
import { VDatePicker } from "vuetify/labs/VDatePicker";
import Swal from "sweetalert2";
import moment from "moment";

export default {
    components: {
        VDataTable,
        VDatePicker,
    },
    data: () => ({
        itemsPerPage: 10,
        headers: [
            { title: "Name", key: "company_artist.name", align: "start" },
            {
                title: "Email",
                key: "email",
                align: "end",
            },
            { title: "IP Address", key: "ip_address", align: "end" },
            {
                title: "User Agent",
                key: "user_agent",
                align: "end",
            },
            { title: "Voted at", key: "created_at", align: "end" },
        ],
        search: "",
        serverItems: [],
        loading: true,
    }),

    methods: {
        fetchArtistsVotes() {
            this.loading = true;
            axios
                .get("/api/companyArtistsVotes", {
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

        formattedDate(date) {
            return moment(date).format("MMM DD, YYYY hh:mm:ss A");
        }
    },

    mounted() {
        this.fetchArtistsVotes();
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
                    </v-toolbar>
                    <v-card-text>
                        <v-data-table
                            v-model:items-per-page="itemsPerPage"
                            :headers="headers"
                            :items="serverItems"
                            :loading="loading"
                            elevation="0"
                            item-value="name"
                            @update:options="fetchArtistsVotes()"
                        >
                            <template v-slot:item.created_at="{ item }">
                            {{ formattedDate(item.selectable.created_at) }}
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
