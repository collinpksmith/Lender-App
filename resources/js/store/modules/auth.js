import axios from 'axios';
import Cookies from 'js-cookie';
import * as types from '../mutation-types';
import { SUCCESS, FAILURE } from '../utils/action';

// state
export const state = {
  user: null,
  token: Cookies.get('token'),
};

// getters
export const getters = {
  user: (state) => state.user,
  token: (state) => state.token,
  check: (state) => state.user !== null,
};

// mutations
export const mutations = {
  [types.SAVE_TOKEN](state, { token, remember }) {
    state.token = token;
    Cookies.set('token', token, { expires: remember ? 365 : null });
  },

  [SUCCESS(types.FETCH_USER)](state, { user }) {
    state.user = user;
  },

  [FAILURE(types.FETCH_USER)](state) {
    state.token = null;
    Cookies.remove('token');
  },

  [types.LOGOUT](state) {
    state.user = null;
    state.token = null;

    Cookies.remove('token');
  },

  [types.UPDATE_USER](state, { user }) {
    state.user = user;
  },
};

// actions
export const actions = {
  saveToken({ commit, dispatch }, payload) {
    commit(types.SAVE_TOKEN, payload);
  },

  async fetchUser({ commit }) {
    try {
      const { data } = await axios.get('/api/user');

      commit(SUCCESS(types.FETCH_USER), { user: data });
    } catch (e) {
      commit(FAILURE(types.FETCH_USER));
    }
  },

  updateUser({ commit }, payload) {
    commit(types.UPDATE_USER, payload);
  },

  async logout({ commit }) {
    try {
      await axios.post('/api/logout');
    } catch (e) {}

    commit(types.LOGOUT);
  },

  async fetchOauthUrl(ctx, { provider }) {
    const { data } = await axios.post(`/api/oauth/${provider}`);

    return data.url;
  },
};
