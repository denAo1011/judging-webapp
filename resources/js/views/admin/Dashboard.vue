<script>
export default {
    data: () => ({
        entries: {},
        jurors: 0,
        votedJurors: 0,
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
                console.log(data);
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
</template>
