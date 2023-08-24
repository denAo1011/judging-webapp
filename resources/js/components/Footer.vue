<template>
    <v-row justify="center">
        <v-col cols="12" xl="8" lg="10">
            <v-row class="mb-10" justify="center">
                <v-col cols="12" lg="7">
                    <v-row justify="center" class="pa-5">
                        <v-col cols="12">
                            <h1 class="text-4xl font-bold text-primary">
                                More About Us
                            </h1>
                            <p class="text-xl">
                                Anak TV is chiefly an advocacy organization that
                                promotes media literacy, particularly television
                                literacy, and pushes the agenda for
                                child-sensitive, family-friendly television in
                                the Philippines.
                            </p>
                        </v-col>
                        <v-col cols="12">
                            <p class="text-xl">
                                <v-icon color="primary" class="mr-1"
                                    >mdi-phone</v-icon
                                >Phone: (632) 352.2190
                            </p>
                            <p class="text-xl">
                                <v-icon color="primary" class="mr-1"
                                    >mdi-at</v-icon
                                >Email: anaktv_seal@yahoo.com
                            </p>
                            <p class="text-xl">
                                <v-icon color="primary" class="mr-1"
                                    >mdi-pin</v-icon
                                >Address: Unit 607 FSS Building-II, 18 Scout
                                Tuason Cor. Scout Castor Street, Brgy. Laging
                                Handa Quezon City, Philippines
                            </p>
                        </v-col>
                    </v-row>
                </v-col>
                <v-col col="12" sm="6" lg="5">
                    <v-row justify="center" class="pa-5">
                        <v-col>
                            <h1 class="text-4xl font-bold text-primary">
                                Message Us
                            </h1>
                            <v-form
                                v-model="messageForm"
                                @submit.prevent="submitEntry"
                            >
                                <v-row>
                                    <v-col cols="12" class="ma-0" lg="6">
                                        <v-text-field
                                            variant="underlined"
                                            color="primary"
                                            v-model="message.name"
                                            :rules="[required]"
                                            ><template v-slot:label
                                                >Name
                                                <strong class="text-error"
                                                    >*</strong
                                                ></template
                                            ></v-text-field
                                        >
                                    </v-col>
                                    <v-col cols="12" class="ma-0" lg="6">
                                        <v-text-field
                                            variant="underlined"
                                            color="primary"
                                            label="Email"
                                            v-model="message.email"
                                            :rules="[required, email]"
                                        >
                                            <template v-slot:label>
                                                Email
                                                <strong class="text-error"
                                                    >*</strong
                                                ></template
                                            ></v-text-field
                                        >
                                    </v-col>
                                    <v-col cols="12" class="ma-0" lg="12">
                                        <v-text-field
                                            variant="underlined"
                                            color="primary"
                                            label="Subject"
                                            v-model="message.subject"
                                            :rules="[required]"
                                        />
                                    </v-col>
                                    <v-col cols="12" class="ma-0" lg="12">
                                        <v-textarea
                                            variant="underlined"
                                            color="primary"
                                            label="Subject"
                                            v-model="message.text"
                                            :rules="[required]"
                                        />
                                    </v-col>
                                    <v-col cols="12" class="ma-0" lg="12">
                                        <v-btn
                                            color="primary"
                                            class="white--text"
                                            type="submit"
                                            size="large"
                                            >Send Message</v-btn
                                        >
                                    </v-col>
                                </v-row>
                            </v-form>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </v-col>
    </v-row>
    <v-divider></v-divider>
    <div class="text-center d-flex flex-column pb-5">
        <div>
            <a
                v-for="icon in icons"
                :key="icon.icon"
                :href="icon.to"
                target="_blank"
            >
                <v-btn
                    color="primary"
                    class="mx-4"
                    :icon="icon.icon"
                    variant="text"
                ></v-btn>
            </a>
        </div>
        <div>
            {{ new Date().getFullYear() }} — Powered By
            <a href="https://dreamers.ph" target="_blank"
                ><strong class="text-primary">Dreamers.ph</strong></a
            >
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        icons: [
            {
                to: "https://www.facebook.com/AnakTVFoundation/",
                icon: "mdi-facebook",
            },
            {
                to: "https://www.youtube.com/channel/UCTSk_YoUEPcpKXqo9FTIW9g",
                icon: "mdi-youtube",
            },
        ],
        messageForm: false,
        message: {
            name: "",
            email: "",
            subject: "",
            text: "",
        },
    }),
    methods: {
        email(value) {
            if (!value) return true;
            return /.+@.+\..+/.test(value) || "E-mail must be valid";
        },
        number(value) {
            if (!value) return true;
            return /^\d+$/.test(value) || "Must be a number";
        },
        required(value) {
            return !!value || "Required.";
        },
        submitEntry() {
            this.messageForm = true;
        },
    },
};
</script>
