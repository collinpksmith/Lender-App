<template>
  <b-alert
    :show="!!error"
    variant="danger"
    dismissible
  >
    {{ error }}
  </b-alert>
</template>

<script>
export default {
  name: 'Alert',

  props: {
    error: {
      type: String,
    }
  },
};
</script>
