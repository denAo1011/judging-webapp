// import Vue from 'vue';
import { createStore } from 'vuex';
import persistedState from 'vuex-persistedstate';

export default createStore({
  state: {
    token: null,
  },
  getters: {
    isAuth(state) {
      return !!state.token;
    },
    token(state) {
      return state.token;
    }
  },
  mutations: {
    login(state, token ) {
      state.token = token;
    },
    logout(state) {
      state.token = null;
    }
  },
  actions: {
    login({ commit }, token ) {
      commit('login', token );
    },
    logout({ commit }) {
      commit('logout');
    }
  },
  plugins: [
    persistedState({
      storage: window.sessionStorage,
    }),
  ],
});
