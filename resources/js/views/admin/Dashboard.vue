<script>
import { VDataTable } from "vuetify/labs/VDataTable";
export default {
    components: {
        VDataTable,
    },
    data: () => ({
        entries: {},
        jurors: 0,
        votedJurors: 0,
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
            {
                title: "Score",
                key: "avg_level_one_rating",
                align: "start",
            },
        ],
        levelOneRanking: [],
        levelTwoanking: [],
        loading: true,
    }),
    methods: {
        fetchDashboard() {
            this.loading = true;
            axios.get("/api/dashboard/statistics").then((response) => {
                let data = response.data;
                this.jurors = data.jurors;
                this.entries = data.entries;
                this.votedJurors = data.votedJurors;
            });

            axios.get("/api/dashboard/rankings").then((response) => {
                let data = response.data;
                this.levelOneRanking = data.level_one;
                this.levelTwoRanking = data.level_two;
                this.loading = false;
            });
        },

        downloadRankings(rank) {
            window.open(
                window.location.origin +
                    `/api/reports/companyEntryLevel${rank}Rankings`,
                "_blank"
            );
        },
    },

    mounted() {
        this.fetchDashboard();
    },
};
</script>
<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="pa-10">
                    <v-toolbar color="transparent">
                        <h1 class="text-5xl font-bold text-primary">
                            Dashboard
                        </h1>
                    </v-toolbar>
                    <v-card-text>
                        <v-row justify="center">
                            <v-col cols="12" md="6" lg="3">
                                <v-card class="rounded-lg">
                                    <v-card-text class="text-center">
                                        <h1
                                            class="text-5xl font-bold text-primary"
                                        >
                                            {{ entries.total }}
                                        </h1>
                                        <h2
                                            class="text-xl font-bold text-primary"
                                        >
                                            Total Entries
                                        </h2>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" md="6" lg="3">
                                <v-card class="rounded-lg">
                                    <v-card-text class="text-center">
                                        <h1
                                            class="text-5xl font-bold text-success"
                                        >
                                            {{ entries.approved }}
                                        </h1>
                                        <h2
                                            class="text-xl font-bold text-success"
                                        >
                                            Entries Approved
                                        </h2>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" md="6" lg="3">
                                <v-card class="rounded-lg">
                                    <v-card-text class="text-center">
                                        <h1
                                            class="text-5xl font-bold text-error"
                                        >
                                            {{ entries.disapproved }}
                                        </h1>
                                        <h2
                                            class="text-xl font-bold text-error"
                                        >
                                            Entries Rejected
                                        </h2>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" md="6" lg="3">
                                <v-card class="rounded-lg">
                                    <v-card-text class="text-center">
                                        <h1
                                            class="text-5xl font-bold text-warning"
                                        >
                                            {{ entries.pending }}
                                        </h1>
                                        <h2
                                            class="text-xl font-bold text-warning"
                                        >
                                            Entries Pending
                                        </h2>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" md="6" lg="3">
                                <v-card class="rounded-lg">
                                    <v-card-text class="text-center">
                                        <h1
                                            class="text-5xl font-bold text-primary"
                                        >
                                            {{ jurors }}
                                        </h1>
                                        <h2
                                            class="text-xl font-bold text-primary"
                                        >
                                            Total Jurors
                                        </h2>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" md="6" lg="3">
                                <v-card class="rounded-lg">
                                    <v-card-text class="text-center">
                                        <h1
                                            class="text-5xl font-bold text-success"
                                        >
                                            {{ votedJurors }}
                                        </h1>
                                        <h2
                                            class="text-xl font-bold text-success"
                                        >
                                            Jurors Voted
                                        </h2>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="pa-10">
                    <v-toolbar color="transparent">
                        <h1 class="text-3xl font-bold text-primary">
                            Level 1 Rankings
                        </h1>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="success"
                            variant="elevated"
                            rounded="lg"
                            prepend-icon="mdi-download"
                            size="small"
                            @click="downloadRankings('One')"
                        >
                            Download
                        </v-btn>
                    </v-toolbar>
                    <v-card-text>
                        <v-data-table
                            v-model:items-per-page="itemsPerPage"
                            :headers="headers"
                            :items="levelOneRanking"
                            :loading="loading"
                            elevation="0"
                            item-value="name"
                        >
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-card class="pa-10">
                    <v-toolbar color="transparent">
                        <h1 class="text-3xl font-bold text-primary">
                            Level 2 Rankings
                        </h1>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="success"
                            variant="elevated"
                            rounded="lg"
                            prepend-icon="mdi-download"
                            size="small"
                            @click="downloadRankings('Two')"
                        >
                            Download
                        </v-btn>
                    </v-toolbar>
                    <v-card-text>
                        <v-data-table
                            v-model:items-per-page="itemsPerPage"
                            :headers="headers"
                            :items="levelTwoRanking"
                            :loading="loading"
                            elevation="0"
                            item-value="name"
                        >
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
