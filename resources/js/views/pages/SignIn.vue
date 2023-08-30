<script setup>
import Swal from "sweetalert2";
import BaseButton from "../../components/BaseButton.vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { ref } from "vue";
const store = useStore();
const router = useRouter();

let form = ref(false);
let visible = ref(false);
let user = ref({
    email: "",
    password: "",
});
let errors = ref({
    email: "",
    password: "",
});
let rules = ref({
    required: (value) => !!value || "Required.",
    email: (value) => {
        if (!value) {
            return "Required.";
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            return "Invalid Email.";
        }
        return true;
    },
});

async function submitLogin() {
    // const { valid } = await this.$refs.form.validate();
    if (form) {
        window.axios
            .post("/api/login", this.user)
            .then((response) => {
                console.log(response.data);
                let token = response.data;
                store.dispatch("login", token);
                Swal.fire({
                    toast: true,
                    icon: "success",
                    title: "Login Successful",
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                router.push({ name: "entries" });
            })
            .catch((error) => {
                Swal.fire({
                    icon: "error",
                    title: "Invalid Credentials",
                    icon: "error",
                });
                // this.errors = {
                //     email: error.response.data,
                //     password: error.response.data,
                // };
                console.log(error);
            })
            .finally(() => {
                this.loginForm = false;
            });
    }
}
</script>

<template>
    <div class="home-container py-10">
        <v-row justify="center">
            <v-col cols="11" xl="10">
                <v-row justify="center" class="pa-5 text-center">
                    <h1 class="text-5xl font-bold text-white">Admin Login</h1>
                </v-row>
                <v-row justify="center">
                    <v-col cols="12" md="4" lg="3">
                        <v-card class="card-border">
                            <v-card-text>
                                <v-form v-model="form">
                                    <v-row>
                                        <v-col cols="12">
                                            <div
                                                class="text-subtitle-1 text-medium-emphasis"
                                            >
                                                Email
                                            </div>

                                            <v-text-field
                                                density="compact"
                                                placeholder="Email"
                                                prepend-inner-icon="mdi-at"
                                                variant="underlined"
                                                color="primary"
                                                :error-messages="errors.email"
                                                v-model="user.email"
                                                :rules="[rules.email]"
                                            ></v-text-field>

                                            <div
                                                class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
                                            >
                                                Password
                                            </div>

                                            <v-text-field
                                                :append-inner-icon="
                                                    visible
                                                        ? 'mdi-eye-off'
                                                        : 'mdi-eye'
                                                "
                                                :type="
                                                    visible
                                                        ? 'text'
                                                        : 'password'
                                                "
                                                density="compact"
                                                placeholder="Enter your password"
                                                prepend-inner-icon="mdi-lock-outline"
                                                variant="underlined"
                                                color="primary"
                                                :error-messages="
                                                    errors.password
                                                "
                                                v-model="user.password"
                                                :rules="[rules.required]"
                                                @click:append-inner="
                                                    visible = !visible
                                                "
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row justify="center" class="pb-5">
                                        <!-- <v-col cols="7" md="4" lg="4"> -->
                                        <!-- {{ loginForm ? "Login" : "Register" }} -->
                                        <!-- <button type="submit"> -->
                                        <BaseButton
                                            @click="submitLogin()"
                                            :text="'Login'"
                                        />
                                        <!-- </button> -->
                                        <!-- </v-col> -->
                                    </v-row>
                                </v-form>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </div>
</template>
<style scoped>
.home-container {
    height: 100vh;
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    /* Add Linear Background */
    background: #885598;
}

.card-border {
    border-radius: 20px !important;
}
</style>
