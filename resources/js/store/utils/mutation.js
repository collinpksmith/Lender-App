import { SUCCESS, FAILURE } from './action';

export const crudMutations = ({
  LIST_ACTION,
  CREATE_ATION,
  READ_ACTION,
  UPDATE_ACTION,
  DELETE_ACTION,
  all,
  current,
}) => ({
  [LIST_ACTION](state) {
    state.loading = true;
    state.error = null;
  },

  [SUCCESS(LIST_ACTION)](state, allItems) {
    state[all] = allItems;
    state.loading = false;
  },

  [FAILURE(LIST_ACTION)](state, error) {
    state.error = error.response?.data?.message || error.message;
    state.loading = false;
  },

  [SUCCESS(CREATE_ATION)](state, item) {
    state[current] = item;
    state[all] = [...state[all], item];
    state.loading = false;
  },

  [FAILURE(CREATE_ATION)](state, error) {
    state.error = error.response?.data?.message || error.message;
    state.loading = false;
  },

  [READ_ACTION](state) {
    state[current] = {};
    state.loading = false;
    state.error = null;
  },

  [SUCCESS(READ_ACTION)](state, item) {
    state[current] = item;
    state.loading = false;
  },

  [FAILURE(READ_ACTION)](state, error) {
    state.error = error.response?.data?.message || error.message;
    state.loading = false;
  },

  [SUCCESS(UPDATE_ACTION)](state, item) {
    state[current] = item;
    state[all] = [...state[all].map((each) => (each.id === item.id ? item : each))];
    state.loading = false;
  },

  [FAILURE(UPDATE_ACTION)](state, error) {
    state.error = error.response?.data?.message || error.message;
    state.loading = false;
  },

  [SUCCESS(DELETE_ACTION)](state, itemId) {
    state[all] = [...state[all].filter((item) => item.id !== itemId)];
  },

  [FAILURE(DELETE_ACTION)](state, error) {
    state.error = error.response?.data?.message || error.message;
  },
});
