<script>
import BaseButton from "../../components/BaseButton.vue";
import Swal from "sweetalert2";
import YouTube from "vue3-youtube";
import store from "../../store";
export default {
    components: { BaseButton, YouTube },
    data() {
        return {
            loading: false,
            successDialog: false,
            artists: [],
            rules: {
                required: (value) => !!value || "Required.",
            },
        };
    },
    computed: {
        maleArtists() {
            return this.artists.filter((artist) => {
                return artist.gender === "Male";
            })
        },
        femaleArtists() {
            return this.artists.filter((artist) => {
                return artist.gender === "Female";
            })
        }
    },
    methods: {
        goTo(route) {
            // router.push(route);
        },

        fetchArtists() {
            window.axios
                .get("/api/companyArtists")
                .then((response) => {
                    this.artists = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    // this.loading = false;
                    // this.loading = true;
                });
        },

        async voteArtist(artist) {
            //Check if all tallies rating is not null
            window.axios
                .post(`/api/companyArtists/${artist.id}/vote`)
                .then((response) => {
                    Swal.fire({
                        toast: true,
                        icon: "success",
                        title: "Successfully Voted!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.successDialog = true;
                });
        },

        backHome() {
            this.$router.push({ name: "home" });
        },
    },

    mounted() {
            this.fetchArtists();
        },
};
</script>

<template>
    <v-overlay
        v-model="loading"
        color="white"
        z-index="1"
        class="align-center justify-center opacity-90"
    >
        <v-progress-circular
            :size="100"
            :width="5"
            color="primary"
            indeterminate
        ></v-progress-circular>
    </v-overlay>
    <div v-if="!loading">
        <v-row justify="center" class="py-12 text-center">
            <h1
                class="text-5xl font-bold"
            >
                WELCOME TO ANAK MAKABATA AWARDS
            </h1>
        </v-row>
<!--        One Artist Only-->
        <v-row justify="center">
            <v-col cols="12" lg="9">
                <v-form ref="maleForm" lazy-validation>
                    <v-row justify="center" >
                        <v-col
                            v-for="(artist, index) in artists"
                            :key="index"
                            cols="12"
                            md="4"
                            lg="4"
                        >
                            <v-card class="elevation-0">
                                <v-img
                                    :src="artist.image"
                                    class="align-end"
                                    gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                                    cover
                                    height="400"
                                >
                                    <v-card-title>
                                        <div
                                            class="text-center font-weight-bold text-2xl text-truncate text-white"
                                        >
                                            {{ artist.name }}
                                        </div>
                                    </v-card-title>
                                </v-img>
                                <BaseButton @click="voteArtist(artist)" :text="'Vote'" />
                            </v-card>
                        </v-col>
                    </v-row>
                </v-form>
            </v-col>
        </v-row>
<!--        Separate Voting for Male and Female-->
<!--        <v-row>-->
<!--            <v-col cols="12" lg="6">-->
<!--                <v-row justify="center" class="pa-5 text-center">-->
<!--                    <h2-->
<!--                        class="text-4xl font-black text-gray-700"-->
<!--                    >-->
<!--                        FOR MALE CATEGORY-->
<!--                    </h2>-->
<!--                </v-row>-->
<!--                <v-form ref="maleForm" lazy-validation>-->
<!--                    <v-row justify="center" class="pa-5">-->
<!--                        <v-col-->
<!--                            v-for="(artist, index) in maleArtists"-->
<!--                            :key="index"-->
<!--                            cols="12"-->
<!--                            md="4"-->
<!--                            lg="4"-->
<!--                        >-->
<!--                            <v-card class="elevation-0">-->
<!--                                <v-img-->
<!--                                    :src="artist.image"-->
<!--                                    class="align-end"-->
<!--                                    gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"-->
<!--                                    cover-->
<!--                                >-->
<!--                                    <v-card-title>-->
<!--                                        <div-->
<!--                                            class="text-center font-weight-bold text-2xl text-truncate text-white"-->
<!--                                        >-->
<!--                                            {{ artist.name }}-->
<!--                                        </div>-->
<!--                                    </v-card-title>-->
<!--                                </v-img>-->
<!--                                <BaseButton @click="voteArtist(artist)" :text="'Vote'" />-->
<!--                            </v-card>-->
<!--                        </v-col>-->
<!--                    </v-row>-->
<!--                </v-form>-->
<!--            </v-col>-->
<!--            <v-col cols="12" lg="6">-->
<!--                <v-row justify="center" class="pa-5 text-center">-->
<!--                    <h2-->
<!--                        class="text-4xl font-black text-gray-700"-->
<!--                    >-->
<!--                        FOR FEMALE CATEGORY-->
<!--                    </h2>-->
<!--                </v-row>-->
<!--                <v-form ref="femaleForm" lazy-validation>-->
<!--                    <v-row justify="center" class="pa-5">-->
<!--                        <v-col-->
<!--                            v-for="(artist, index) in femaleArtists"-->
<!--                            :key="index"-->
<!--                            cols="12"-->
<!--                            md="4"-->
<!--                            lg="4"-->
<!--                        >-->
<!--                            <v-card class="elevation-0">-->
<!--                                <v-img-->
<!--                                    :src="artist.image"-->
<!--                                    class="align-end"-->
<!--                                    gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"-->
<!--                                    cover-->
<!--                                >-->
<!--                                    <v-card-title>-->
<!--                                        <div-->
<!--                                            class="text-center font-weight-bold text-2xl text-truncate text-white"-->
<!--                                        >-->
<!--                                            {{ artist.name }}-->
<!--                                        </div>-->
<!--                                    </v-card-title>-->
<!--                                </v-img>-->
<!--                                <BaseButton @click="voteArtist(artist)" :text="'Vote'" />-->
<!--                            </v-card>-->
<!--                        </v-col>-->
<!--                    </v-row>-->
<!--                </v-form>-->
<!--            </v-col>-->
<!--        </v-row>-->
    </div>
    <v-dialog v-model="successDialog" persistent fullscreen z-index="999">
        <v-card>
            <v-card-text class="p-8 d-flex align-center justify-center dialog-card">
                <div>
                    <v-row justify="center" class="text-center space-y-4 mb-12">
                        <v-col>
                            <h1 class="text-congrats font-bold text-green-500">
                                ALL SET.
                            </h1>
                            <h1 class="text-congrats font-bold text-blue-500">
                                THANK YOU!
                            </h1>
                            <p class="text-xl text-gray-600">
                                You've successfully voted an artists
                            </p>
                        </v-col>
                    </v-row>
                    <!-- <v-row justify="center" class="mt-6">
                        <v-col cols="12" md="8" lg="2"> -->
                    <BaseButton @click="backHome()" :text="'RETURN TO HOME'" />
                    <!-- </v-col> -->
                    <!-- </v-row> -->
                </div>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
<style scoped>
.card-border {
    border-radius: 20px !important;
}

.text-congrats {
    font-size: 4rem;
    line-height: 1;
}

.dialog-card {
    background: url("/images/bg3.png");
}
</style>
