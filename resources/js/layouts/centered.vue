<template>
  <div class="main-layout">
    <navbar />

    <b-container>
      <b-row align-v="center" class="centered-body">
        <child />
      </b-row>
    </b-container>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar';

export default {
  name: 'CenteredLayout',

  components: {
    Navbar,
  },
};
</script>

<style lang="scss" scoped>
.centered-body {
  height: calc(100vh - 56px);
}
</style>