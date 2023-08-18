// import Vue from 'vue';
import { createStore } from 'vuex';
import persistedState from 'vuex-persistedstate';

export default createStore({
  state: {
    //
  },
  mutations: {
    //
  },
  actions: {
    //
  },
  plugins: [
    persistedState({
      storage: window.sessionStorage,
    }),
  ],
});
