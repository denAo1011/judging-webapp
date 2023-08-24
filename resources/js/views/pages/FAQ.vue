<script setup>
import { ref } from "vue";

const faqs = ref([
    {
        question: "How do I manage my account?",
        answer: "Dolorem aliquid error odio, eaque asperiores itaque eius, voluptas libero ratione iste hic? Magni architecto recusandae sit eos laudantium quod porro culpa! Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste libero nulla nam, odio atque labore quasi eum omnis voluptate id dolorem dolorum.",
    },
    {
        question: "How do I manage my account?",
        answer: "Dolorem aliquid error odio, eaque asperiores itaque eius, voluptas libero ratione iste hic? Magni architecto recusandae sit eos laudantium quod porro culpa! Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste libero nulla nam, odio atque labore quasi eum omnis voluptate id dolorem dolorum.",
    },
    {
        question: "How do I manage my account?",
        answer: "Dolorem aliquid error odio, eaque asperiores itaque eius, voluptas libero ratione iste hic? Magni architecto recusandae sit eos laudantium quod porro culpa! Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste libero nulla nam, odio atque labore quasi eum omnis voluptate id dolorem dolorum.",
    },
    {
        question: "How do I manage my account?",
        answer: "Dolorem aliquid error odio, eaque asperiores itaque eius, voluptas libero ratione iste hic? Magni architecto recusandae sit eos laudantium quod porro culpa! Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste libero nulla nam, odio atque labore quasi eum omnis voluptate id dolorem dolorum.",
    },
    {
        question: "How do I manage my account?",
        answer: "Dolorem aliquid error odio, eaque asperiores itaque eius, voluptas libero ratione iste hic? Magni architecto recusandae sit eos laudantium quod porro culpa! Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste libero nulla nam, odio atque labore quasi eum omnis voluptate id dolorem dolorum.",
    },
    {
        question: "How do I manage my account?",
        answer: "Dolorem aliquid error odio, eaque asperiores itaque eius, voluptas libero ratione iste hic? Magni architecto recusandae sit eos laudantium quod porro culpa! Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste libero nulla nam, odio atque labore quasi eum omnis voluptate id dolorem dolorum.",
    },
    {
        question: "How do I manage my account?",
        answer: "Dolorem aliquid error odio, eaque asperiores itaque eius, voluptas libero ratione iste hic? Magni architecto recusandae sit eos laudantium quod porro culpa! Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste libero nulla nam, odio atque labore quasi eum omnis voluptate id dolorem dolorum.",
    },
    {
        question: "How do I manage my account?",
        answer: "Dolorem aliquid error odio, eaque asperiores itaque eius, voluptas libero ratione iste hic? Magni architecto recusandae sit eos laudantium quod porro culpa! Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste libero nulla nam, odio atque labore quasi eum omnis voluptate id dolorem dolorum.",
    },
]);
</script>

<template>
    <div class="faq-container d-flex py-12">
        <v-row justify="center">
            <v-col cols="11" lg="10" xl="8">
                <v-row justify="center" class="pa-5 text-center">
                    <h1 class="text-5xl font-bold text-primary">
                        Frequently Asked Questions
                    </h1>
                </v-row>
                <v-card color="white" class="card-border mt-12">
                    <v-card-text>
                        <v-row>
                            <v-col
                                data-aos="fade-up"
                                :data-aos-delay="index + 1 + '00'"
                                v-for="(faq, index) in faqs"
                                :key="index"
                                cols="12"
                                lg="6"
                            >
                                <dt
                                    class="text-sm lg:text-xl text-primary font-semibold"
                                >
                                    {{ faq.question }}
                                </dt>
                                <dd class="mt-3 text-black-400 text-sm">
                                    {{ faq.answer }}
                                </dd>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<style scoped>
.faq-container {
    width: 100vw;
    /* Add Linear Background */
    background: #a9df73;
}
</style>
