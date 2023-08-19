<script setup>
import BaseButton from "../../components/BaseButton.vue";
</script>

<template>
  <div class="home-container">
    <v-row justify="center">
      <v-col cols="11" lg="10" xl="8">
        <v-card color="#D2467F" class="card-shadow">
          <v-card-text>
            <v-row>
              <v-col cols="12">
                <v-row>
                  <v-col>
                    <h1 class="text-5xl font-bold text-white">Eligibility</h1>
                    <p class="text-sm lg:text-xl text-white mt-5 text-justify">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem
                      aliquid error odio, eaque asperiores itaque eius, voluptas libero
                      ratione iste hic? Magni architecto recusandae sit eos laudantium
                      quod porro culpa! Lorem ipsum dolor sit amet consectetur adipisicing
                      elit. Iste libero nulla nam, odio atque labore quasi eum omnis
                      voluptate id dolorem dolorum. Unde iure aut repudiandae sunt earum
                      ipsum deleniti, eveniet, voluptates suscipit ea excepturi
                      consequatur iusto, corrupti id in quibusdam harum nam autem ullam
                      blanditiis impedit animi veritatis! Fugiat exercitationem
                      consequatur sapiente, ab minus dolorem culpa illo nam dolorum
                      asperiores. Minima, voluptates iusto? Dolorum aliquam, doloribus
                      aspernatur natus vitae, deserunt blanditiis officia a dolores eaque
                      enim? Eveniet, aliquid voluptatum eligendi nihil eaque eum debitis
                      totam. Praesentium debitis alias eos mollitia provident neque fugiat
                      natus. Rerum necessitatibus doloribus quaerat sit!
                    </p>

                    <p class="text-sm lg:text-xl text-white mt-5 text-justify">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem
                      aliquid error odio, eaque asperiores itaque eius, voluptas libero
                      ratione iste hic? Magni architecto recusandae sit eos laudantium
                      quod porro culpa! Lorem ipsum dolor sit amet consectetur adipisicing
                      elit.
                    </p>
                  </v-col>
                </v-row>
                <v-row justify="center">
                  <v-col cols="3">
                    <BaseButton :text="'Submit Entry'" />
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
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
  background: linear-gradient(45deg, #4b114b 25%, 75%, #e6d1c1);
}

.card-shadow {
  box-shadow: -10px 20px 15px 5px rgba(0, 0, 0, 1);
}
</style>
