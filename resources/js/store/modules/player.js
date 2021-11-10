import { baseAPICreator } from '~/plugins/apiCreator';
import * as types from '../mutation-types';
import { crudMutations } from '../utils/mutation';
import { SUCCESS, FAILURE } from '../utils/action';

const playerApi = baseAPICreator('/api/players');

// state
export const state = {
  players: [],
  currentPlayer: null,
  loading: false,
  error: null,
};

// getters
export const getters = {
  players: (state) => state.players,
  currentPlayer: (state) => state.currentPlayer,
  loading: (state) => state.loading,
  error: (state) => state.error,
};

// mutations
export const mutations = {
  ...crudMutations({
    LIST_ACTION: types.FETCH_PLAYERS,
    CREATE_ATION: types.CREATE_PLAYER,
    READ_ACTION: types.FETCH_PLAYER,
    UPDATE_ACTION: types.UPDATE_PLAYER,
    DELETE_ACTION: types.DELETE_PLAYER,
    all: 'players',
    current: 'currentPlayer',
  }),
};

// actions
export const actions = {
  async fetchPlayers({ commit }) {
    try {
      const { data } = await playerApi.get('/');
      commit(SUCCESS(types.FETCH_PLAYERS), data);
      return data;
    } catch (error) {
      commit(FAILURE(types.FETCH_PLAYERS), error);
      throw Error(error);
    }
  },

  async createPlayer({ commit }, player) {
    try {
      const { data } = await playerApi.post('', player);
      commit(SUCCESS(types.CREATE_PLAYER), data);
      return data;
    } catch (error) {
      commit(FAILURE(types.CREATE_PLAYER), error);
      throw Error(error);
    }
  },

  async fetchPlayer({ commit }, playerId) {
    try {
      const { data } = await playerApi.get(`/${playerId}`);
      commit(SUCCESS(types.FETCH_PLAYER), data);
    } catch (error) {
      commit(FAILURE(types.FETCH_PLAYER), error);
    }
  },

  async updatePlayer({ commit }, player) {
    try {
      const { data } = await playerApi.patch(`/${player.id}`, player);
      commit(SUCCESS(types.UPDATE_PLAYER), data);
      return data;
    } catch (error) {
      commit(FAILURE(types.UPDATE_PLAYER), error);
      throw Error(error);
    }
  },

  async deletePlayer({ commit }, playerId) {
    try {
      await playerApi.delete(`/${playerId}`);
      commit(SUCCESS(types.DELETE_PLAYER), playerId);
      return;
    } catch (error) {
      commit(FAILURE(types.DELETE_PLAYER), error);
      throw Error(error);
    }
  },
};
