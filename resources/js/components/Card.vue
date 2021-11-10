<template>
  <b-card>
    <b-card-title v-if="title" class="card-title mb-4">
      {{ title }}
    </b-card-title>

    <b-alert v-if="error" show variant="danger" dismissible>
      {{ error }}
    </b-alert>

    <slot />
  </b-card>
</template>

<script>
export default {
  name: 'Card',

  props: {
    title: {
      type: String,
    },

    error: {
      type: String,
    }
  }
}
</script>

<style lang="scss" scoped>
.card-title {
	text-align: center;
}
</style>