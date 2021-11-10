<template>
  <router-view />
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  layout: 'default',

  metaInfo() {
    return { title: 'Welcome' };
  },

  data: () => ({
    title: window.config.appName,
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  }),
};
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}
</style>
