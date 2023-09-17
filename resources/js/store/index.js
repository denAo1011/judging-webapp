// import Vue from 'vue';
import { createStore } from 'vuex';
import persistedState from 'vuex-persistedstate';

export default createStore({
  state: {
    token: null,
    jurorToken: null,
    juror: null,
  },
  getters: {
    isAuth(state) {
      return !!state.token;
    },
    token(state) {
      return state.token;
    },
    jurorToken(state) {
      return state.jurorToken;
    },
    juror(state) {
      return state.juror;
    }
  },
  mutations: {
    login(state, token ) {
      state.token = token;
    },
    logout(state) {
      state.token = null;
      state.jurorToken = null;
    },
    setJurorToken(state, jurorToken) {
      state.jurorToken = jurorToken;
    },
    setJuror(state, juror) {
      state.juror = juror;
    }
  },
  actions: {
    login({ commit }, token ) {
      commit('login', token );
    },
    logout({ commit }) {
      commit('logout');
    },
    setJurorToken({ commit }, jurorToken) {
      commit('setJurorToken', jurorToken);
    },
    setJuror({ commit }, juror) {
      commit('setJuror', juror);
    }
  },
  plugins: [
    persistedState({
      storage: window.sessionStorage,
    }),
  ],
});
