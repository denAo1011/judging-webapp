<script>
export default {
    data: () => ({
        entries: {},
        jurors: 0,
    }),
    methods: {
        fetchDashboard() {
            this.loading = true;
            axios.get("/api/dashboard/statistics").then((response) => {
                let data = response.data;
                this.jurors = data.jurors;
                this.entries = data.entries;
            });
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
                                <v-card>
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
                                <v-card>
                                    <v-card-text class="text-center">
                                        <h1
                                            class="text-5xl font-bold text-success"
                                        >
                                            {{ entries.approved }}
                                        </h1>
                                        <h2
                                            class="text-xl font-bold text-success"
                                        >
                                            Approved
                                        </h2>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" md="6" lg="3">
                                <v-card>
                                    <v-card-text class="text-center">
                                        <h1
                                            class="text-5xl font-bold text-error"
                                        >
                                            {{ entries.disapproved }}
                                        </h1>
                                        <h2
                                            class="text-xl font-bold text-error"
                                        >
                                            Rejected
                                        </h2>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" md="6" lg="3">
                                <v-card>
                                    <v-card-text class="text-center">
                                        <h1
                                            class="text-5xl font-bold text-warning"
                                        >
                                            {{ entries.pending }}
                                        </h1>
                                        <h2
                                            class="text-xl font-bold text-warning"
                                        >
                                            Pending
                                        </h2>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" md="6" lg="3">
                                <v-card>
                                    <v-card-text class="text-center">
                                        <h1
                                            class="text-5xl font-bold text-secondary"
                                        >
                                            {{ jurors }}
                                        </h1>
                                        <h2
                                            class="text-xl font-bold text-secondary"
                                        >
                                            Total Jurors
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
</template>
