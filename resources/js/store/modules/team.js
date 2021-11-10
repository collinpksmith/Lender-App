import { baseAPICreator } from '~/plugins/apiCreator';

import * as types from '../mutation-types';
import { crudMutations } from '../utils/mutation';
import { SUCCESS, FAILURE } from '../utils/action';

const teamApi = baseAPICreator('/api/teams');

// state
export const state = {
  teams: [],
  currentTeam: null,
  loading: false,
  error: null,
};

// getters
export const getters = {
  teams: (state) => state.teams,
  error: (state) => state.error,
  currentTeam: (state) => state.currentTeam,
  loading: (state) => state.loading,
};

// mutations
export const mutations = {
  ...crudMutations({
    LIST_ACTION: types.FETCH_TEAMS,
    CREATE_ATION: types.CREATE_TEAM,
    READ_ACTION: types.FETCH_TEAM,
    UPDATE_ACTION: types.UPDATE_TEAM,
    DELETE_ACTION: types.DELETE_TEAM,
    all: 'teams',
    current: 'currentTeam',
  }),
};

// actions
export const actions = {
  async fetchTeams({ commit }) {
    try {
      const { data } = await teamApi.get('/');
      commit(SUCCESS(types.FETCH_TEAMS), data);
      return data;
    } catch (error) {
      commit(FAILURE(types.FETCH_TEAMS), error);
      throw Error(error);
    }
  },

  async createTeam({ commit }, team) {
    try {
      const { data } = await teamApi.post('', team);
      commit(SUCCESS(types.CREATE_TEAM), data);
      return data;
    } catch (error) {
      commit(FAILURE(types.CREATE_TEAM), error);
      throw Error(error);
    }
  },

  async fetchTeam({ commit }, teamId) {
    try {
      const { data } = await teamApi.get(`/${teamId}`);
      commit(SUCCESS(types.FETCH_TEAM), data);
      return data;
    } catch (error) {
      commit(FAILURE(types.FETCH_TEAM), error);
      throw Error(error);
    }
  },

  async updateTeam({ commit }, team) {
    try {
      const { data } = await teamApi.patch(`/${team.id}`, team);
      commit(SUCCESS(types.UPDATE_TEAM), data);
      return data;
    } catch (error) {
      commit(FAILURE(types.UPDATE_TEAM), error);
      throw Error(error);
    }
  },

  async deleteTeam({ commit }, teamId) {
    try {
      await teamApi.delete(`/${teamId}`);
      commit(SUCCESS(types.DELETE_TEAM), teamId);
      return true;
    } catch (error) {
      commit(FAILURE(types.DELETE_TEAM), error);
      throw Error(error);
    }
  },
};
