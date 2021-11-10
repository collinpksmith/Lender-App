<template>
  <validation-provider
    :vid="vid"
    :name="$attrs.name"
    :rules="rules"
    v-slot="{ valid, errors }"
  >
    <b-form-group v-bind="$attrs">
      <b-form-input
        v-bind="$attrs"
        :value="value"
        :state="errors[0] ? false : valid ? true : null"
        :type="type"
        @input="$emit('input', $event)"
      />

      <b-form-invalid-feedback id="inputLiveFeedback">
        {{ errors[0] }}
      </b-form-invalid-feedback>
    </b-form-group>
  </validation-provider>
</template>

<script>
export default {
  name: 'VeeTextInput',

  props: {
    vid: {
      type: String,
    },

    rules: {
      type: [Object, String],
      default: '',
    },

    value: {
      type: null,
    },

    type: {
      type: String,
      default: 'text',
    },
  },
}
</script>
