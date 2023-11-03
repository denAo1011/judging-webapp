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
                title: "Gender",
                key: "gender",
                align: "end",
            },

            // {
            //     title: "Image",
            //     key: "image",
            //     align: "end",
            // },
            {
                title: "Votes",
                key: "votes",
                align: "end",
            },
            { title: "Actions", key: "actions", align: "end" },
        ],
        search: "",
        serverItems: [],
        networks: [],
        artist: {},
        loading: true,
        editedIndex: -1,
        rules: {
            required: (value) => !!value || "Required.",
        },
        image_name: null,
        artistDialog: false,
    }),
    computed: {
        buttonText() {
            return this.editedIndex === -1 ? "Create" : "Update";
        },
    },
    methods: {
        fetchArtists() {
            this.loading = true;
            axios
                .get("/api/companyArtists", {
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

        editArtist(item) {
            console.log(item);
            this.editedIndex = this.serverItems.indexOf(item);
            this.artist = Object.assign({}, item);
            this.artist.network = item.company.id;
            this.artistDialog = true;
        },

        saveArtist() {
            this.artist.company_id = this.artist.network;
            if (this.editedIndex === -1) {
                this.createArtist();
            } else {
                this.updateArtist();
            }
        },

        createArtist() {
            axios
                .post(
                    `/api/companies/${this.artist.network}/companyArtists`,
                    this.artist
                )
                .then((response) => {
                    this.artistDialog = false;
                    this.fetchArtists();
                    Swal.fire({
                        icon: "success",
                        title: "Artist Created",
                        icon: "success",
                    });
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.artist = {};
                });
        },

        updateArtist() {
            axios
                .put(`/api/companyArtists/${this.artist.id}`, this.artist)
                .then((response) => {
                    this.artistDialog = false;
                    this.fetchArtists();
                    Swal.fire({
                        icon: "success",
                        title: "Artist Updated",
                        icon: "success",
                    });
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.artist = {};
                });
        },

        deleteArtist(item) {
            console.log(item);
        },

        openArtistDialog() {
            this.editedIndex = -1;
            this.artist = {};
            this.artistDialog = true;
        },

        convertImage() {
            try {
                const reader = new FileReader();
                reader.onload = () => {
                    this.artist.image = reader.result;
                };
                if (this.image_name && this.image_name.length > 0) {
                    reader.readAsDataURL(this.image_name[0]);
                }
            } catch (error) {
                this.image_name = null;
                this.artist.image = null;
            }
        }
    },

    mounted() {
        this.fetchArtists();
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
                            @click="openArtistDialog()"
                        >
                            Add Artists
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
                            @update:options="fetchArtists()"
                        >
<!--                            <template v-slot:item.image="{ item }">-->
<!--                               <v-img :src="item.selectable.image" />-->
<!--                            </template>-->
                            <template v-slot:item.actions="{ item }">
                                <v-btn
                                    color="warning"
                                    variant="text"
                                    icon="mdi-pen"
                                    @click="editArtist(item.selectable)"
                                />
                                <!-- <v-btn
                                    color="red-darken-2"
                                    variant="text"
                                    icon="mdi-delete"
                                    @click="
                                        deleteArtist(
                                            item.selectable
                                        )
                                    "
                                /> -->
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
    <v-dialog v-model="artistDialog" max-width="1000px">
        <v-card>
            <v-card-text>
                <v-form ref="form">
                    <v-row>
                        <v-col cols="12" class="ma-0" md="4">
                            <v-select
                                :items="networks"
                                item-value="id"
                                item-title="name"
                                variant="underlined"
                                v-model="artist.network"
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
                        <v-col cols="12" class="ma-0" md="4">
                            <v-text-field
                                variant="underlined"
                                label="Name"
                                v-model="artist.name"
                                :rules="[rules.required]"
                                ><template v-slot:label
                                    >Name
                                    <strong class="text-error"
                                        >*</strong
                                    ></template
                                ></v-text-field
                            >
                        </v-col>
                        <v-col cols="12" class="ma-0" md="4">
                            <v-select
                                :items="['MALE','FEMALE','OTHER']"
                                variant="underlined"
                                v-model="artist.gender"
                                :rules="[rules.required]"
                            >
                                <template v-slot:label
                                    >Gender
                                    <strong class="text-error"
                                        >*</strong
                                    ></template
                                >
                            </v-select>
                        </v-col>
<!--                        <v-col cols="12" class="ma-0" md="6">-->
<!--                            <v-file-input-->
<!--                                chips-->
<!--                                variant=underlined-->
<!--                                v-model="image_name"-->
<!--                                accept="image/*"-->
<!--                                @change="convertImage()"-->
<!--                        />-->
<!--                        </v-col>-->
                    </v-row>
                    <v-row justify="end" class="mb-2">
                        <!-- <v-col cols="7" md="4" lg="4"> -->
                        <v-btn size="x-large" @click="saveArtist()">
                            {{ buttonText }}
                        </v-btn>
                        <!-- </v-col> -->
                    </v-row>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
