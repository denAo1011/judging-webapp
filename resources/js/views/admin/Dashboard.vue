<script>
export default {
    data: () => ({}),
    methods: {
        fetchDashboard() {
            this.loading = true;
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
                                    <v-card-text>
                                        <h1
                                            class="text-5xl font-bold text-primary"
                                        >
                                            0
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
                                    <v-card-text>
                                        <h1
                                            class="text-5xl font-bold text-primary"
                                        >
                                            0
                                        </h1>
                                        <h2
                                            class="text-xl font-bold text-primary"
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
