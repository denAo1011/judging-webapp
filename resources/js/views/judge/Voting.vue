<script>
import BaseButton from "../../components/BaseButton.vue";
import Swal from "sweetalert2";
import YouTube from "vue3-youtube";
import store from "../../store";
export default {
    components: { BaseButton, YouTube },
    data() {
        return {
            loading: true,
            confirmDialog: true,
            successDialog: false,
            email: "",
            verify: null,
            artists: [],
            networks: [],
            artist: {
                name: "",
                gender: "ALL",
                network: 0,
            },
            votesCount: 0,
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
            },
        };
    },
    computed: {
        filteredArtists() {
            const filters = {
                name: this.artist.name.toLowerCase(),
                gender:
                    this.artist.gender.toUpperCase() !== "ALL"
                        ? this.artist.gender.toUpperCase()
                        : null,
                company_id: this.artist.network
                    ? parseInt(this.artist.network, 10)
                    : null,
            };

            return this.artists.filter((artist) => {
                if (filters.gender !== null && artist.gender !== filters.gender)
                    return false;
                if (
                    filters.company_id !== null &&
                    artist.company_id !== filters.company_id
                )
                    return false;
                if (
                    filters.name &&
                    !artist.name.toLowerCase().includes(filters.name)
                )
                    return false;
                return true;
            });
        },
    },
    methods: {
        goTo(route) {
            // router.push(route);
        },

        fetchArtists() {
            window.axios
                .get("/api/companyArtists", {
                    perPage: 0,
                })
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

        fetchNetworks() {
            axios
                .get("/api/companies", {
                    params: {
                        perPage: 0,
                    },
                })
                .then((response) => {
                    this.networks = response.data.data;
                    //Add network at front
                    this.networks.unshift({
                        id: 0,
                        name: "ALL",
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        async voteArtist(artist) {
            //Check if all tallies rating is not null
            window.axios
                .post(`/api/companyArtists/${artist.id}/vote`, {
                    email: this.email,
                })
                .then((response) => {
                    this.votesCount++;
                    Swal.fire({
                        toast: true,
                        icon: "success",
                        title: "Successfully Voted!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                    this.successDialog = true;
                })
                .catch((error) => {
                    Swal.fire({
                        icon: "error",
                        title: error.response.data.message,
                    });
                    console.log(error);
                    this.$router.push({ name: "home" });
                })
                .finally(() => {

                });
        },

        async validateEmail() {
            const { valid } = await this.$refs.emailForm.validate();
            if (valid) {
                this.confirmDialog = false;
                this.loading = false;
            }
        },

        backHome() {
            if (this.votesCount > 1) {
                this.$router.push({ name: "home" });
            } else {
                this.successDialog = false;
            }
        },
    },

    mounted() {
        this.fetchArtists();
        this.fetchNetworks();
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
    <div class="px-4" v-if="!loading">
        <v-row justify="center" class="py-12 text-center">
            <h1 class="text-5xl font-bold">WELCOME TO ANAK MAKABATA AWARDS</h1>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" md="6">
                <h2 class="text-4xl font-bold">Filter</h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" class="ma-0" md="2">
                <v-select
                    :items="networks"
                    item-value="id"
                    item-title="name"
                    variant="underlined"
                    v-model="artist.network"
                >
                    <template v-slot:label>Network </template>
                </v-select>
            </v-col>
            <v-col cols="12" class="ma-0" md="2">
                <v-select
                    :items="['ALL', 'MALE', 'FEMALE', 'OTHER']"
                    variant="underlined"
                    v-model="artist.gender"
                >
                    <template v-slot:label>Gender </template>
                </v-select>
            </v-col>
            <v-col cols="12" class="ma-0" md="2">
                <v-text-field
                    variant="underlined"
                    label="Name"
                    v-model="artist.name"
                    ><template v-slot:label>Name</template></v-text-field
                >
            </v-col>
        </v-row>
        <!--        One Artist Only-->
        <v-row justify="center">
            <v-col cols="12" lg="11">
                <v-form ref="maleForm" lazy-validation>
                    <v-row justify="center">
                        <v-col
                            v-for="(artist, index) in filteredArtists"
                            :key="index"
                            cols="12"
                            md="3"
                            lg="3"
                        >
                            <v-card class="elevation-0">
                                <v-card-title>
                                    <div
                                        class="text-center font-weight-bold text-3xl lg:text-4xl text-truncate text-black"
                                    >
                                        {{ artist.name }}
                                    </div>
                                </v-card-title>
                                <BaseButton
                                    @click="voteArtist(artist)"
                                    :text="'Vote'"
                                />
                            </v-card>
                        </v-col>
                    </v-row>
                </v-form>
            </v-col>
        </v-row>
    </div>
    <v-dialog v-model="confirmDialog" persistent max-width="500" z-index="999">
        <v-card>
            <v-card-title class="text-center"> Guest Information </v-card-title>

            <v-card-text>
                <v-form ref="emailForm" lazy-validation>
                    <v-text-field
                        v-model="email"
                        label="Please enter your email"
                        placeholder="Input Email"
                        variant="outlined"
                        :show-size="1000"
                        :rules="[rules.email]"
                    >
                        <template v-slot:label
                            >Please enter your email
                            <strong class="text-error">*</strong>
                        </template>
                    </v-text-field>
                    <v-checkbox
                        color="success"
                        v-model="verify"
                        label="I give my consent to AnakTV  to collect, use and process my personal information. I understand that my consent does not preclude the existence of other criteria for lawful processing of personal data, and does not waive any of my rights under the Data Privacy Act of 2012 and other applicable laws. I HEREBY CERTIFY that the information I provide in this form is complete, true and correct to the best of my knowledge."
                        :rules="[rules.required]"
                    >
                    </v-checkbox>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn
                    block
                    variant="elevated"
                    color="primary"
                    @click="validateEmail()"
                    >Confirm</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
    <v-dialog v-model="successDialog" persistent fullscreen z-index="999">
        <v-card>
            <v-card-text
                class="p-8 d-flex align-center justify-center dialog-card"
            >
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
                    <BaseButton
                        @click="backHome()"
                        :text="votesCount > 1 ? 'RETURN HOME' : 'VOTE AGAIN'"
                    />
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
