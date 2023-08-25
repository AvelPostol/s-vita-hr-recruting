import { createStore } from 'vuex';

export const state = () => ({
  dialogVisible: false,
});

export const getters = {
  popup: state => {
    return state.dialogVisible;
  },
};

export const mutations = {
  ToggleDialog(state, payload) {
    state.dialogVisible = payload;
  },
};

export const actions = {
  async TOGGLE_DIALOG({ commit }, payload) {
    commit('ToggleDialog', payload);
  },
};