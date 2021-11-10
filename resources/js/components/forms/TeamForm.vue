<template>
  <validation-observer v-slot="{ invalid, handleSubmit }">
    <b-form @submit.prevent="handleSubmit(onSubmit)">
      <vee-text-input
        rules="required"
        label="Name:"
        name="Name"
        v-model="value.name"
        placeholder="Enter name, please"
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
  name: 'TeamForm',

  props: {
    default: {
      type: Object,
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
      this.value = _.pick(this.default, ['id', 'name']);
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
