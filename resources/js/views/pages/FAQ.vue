<script setup>
import { ref } from "vue";

const faqs = ref([
    {
        question: "What is the purpose of this Anak TV Seal Judging website?",
        answer: "This digital judging website of Anak TV serves as a platform to conduct online screening and survey of all programs from the different networks of the country that are child-friendly, values laden, and child-centric. It allows jurors or the viewers to evaluate submissions remotely and efficiently..",
    },
    {
        question: "How do I become a judge on this platform?",
        answer: "The Anak TV Secretariat handpicked and invited jurors from different sectors like the Academe, Business, Advertising, TV Networks, child-focus groups, etc. for specific competitions like the Net Anak TV Seal award. You can also be one of the Jurors for the Net Makabata Star award, where we will let the netizens choose the artist that they think has the characteristics of being a Makabata Star awardee.",
    },
    {
        question: "What kind of programs can I expect to judge here?",
        answer: "You can expect to judge a wide range of programs, as well as artist from the different networks of the country. The platform caters to diverse fields and interests.",
    },
    {
        question: "How does the judging process work?",
        answer: "Once registered and selected as a judge for the event, you will gain access to the submissions assigned to you. You can review each submission, provide feedback, and assign scores based on predefined criteria.",
    },
    {
        question: "Is the judging process anonymous?",
        answer: "Yes, the judging process for the Net Makabata Star has an option to be anonymous. You won't have access to the names or identities of the participants while evaluating their submissions.",
    },
    {
        question:
            "Can I communicate with other jurors or participants during the judging process?",
        answer: "No, the platform doesn't provide communication tools that allow you to discuss submissions with fellow jurors. However, direct communication with participants might be limited to maintain fairness.",
    },
    {
        question: "How are the winners determined?",
        answer: "Winners are determined based on the cumulative scores from all judges for each submission. For Anak TV Seal submissions, the programs with 7-10 ratings win the recognition.",
    },
    {
        question: "Can I participate as a juror in both awards simultaneously?",
        answer: "No, you can't participate as a juror in multiple events running separately. However, ensure that you can allocate sufficient time to review and evaluate submissions for each award.",
    },
    {
        question: "What if I encounter technical issues while judging?",
        answer: "If you face technical problems, you can contact the platform's support team for assistance. Look for the contact information provided or help resources on the website.",
    },
    {
        question: "Can I access the judging platform from my mobile device?",
        answer: "Yes, the platform is accessible from both desktop and android or iOS mobile devices, allowing you to judge on the go.",
    },
    {
        question: "How can I provide feedback about the judging experience?",
        answer: 'You can provide your thoughts in the "Message Us" section. Alternatively, you might contact the Anak TV Secretariat directly with your feedback.',
    },
    {
        question:
            "Where can I find additional help if my question isn't answered here?",
        answer: "If you have more questions or need assistance, you can explore the platform's help section or contact the Anak TV Secretariat through the provided support channels.",
    },
]);
</script>

<template>
    <div class="faq-container d-flex py-12">
        <v-row justify="center">
            <v-col cols="11" lg="11" xl="9">
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

.card-border {
    border-radius: 20px !important;
}
</style>
