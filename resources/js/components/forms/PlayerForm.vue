<template>
  <validation-observer v-slot="{ invalid, handleSubmit }">
    <b-form @submit.prevent="handleSubmit(onSubmit)">
      <vee-text-input
        rules="required"
        label="First Name:"
        name="First Name"
        v-model="value.first_name"
        placeholder="Enter first name, please"
      />

      <vee-text-input
        rules="required"
        label="Last Name:"
        name="Last Name"
        v-model="value.last_name"
        placeholder="Enter last name, please"
      />

      <vee-select
        label="Team:"
        v-model="value.team_id"
        :options="teams"
      />

      <div class="d-flex justify-content-between align-items-center">
        <b-button
          type="submit"
          variant="primary"
          :disabled="invalid"
        >
          Submit
        </b-button>

        <b-button
          variant="light"
          @click.prevent="onCancel"
        >
          Cancel
        </b-button>
      </div>
    </b-form>
  </validation-observer>
</template>

<script>
import _ from 'lodash';

export default {
  name: 'PlayerForm',

  props: {
    default: {
      type: Object,
      default: () => ({}),
    },

    teams: {
      type: Array,
      required: true,
    },
  },

  data: () => ({
    value: {},
  }),

  created() {
    this.updateValue();
  },

  watch: {
    default() {
      this.updateValue();
    },
  },

  methods: {
    updateValue() {
      this.value = _.pick(this.default, [
        'id',
        'team_id',
        'first_name',
        'last_name',
      ]);
    },

    onSubmit() {
      this.$emit('submit', { ...this.value });
    },

    onCancel() {
      this.$emit('cancel');
    },
  },
}
</script>
