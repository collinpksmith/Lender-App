<template>
  <div class="main-layout">
    <navbar />

    <b-container>
      <div class="py-3">
        <child />
      </div>
    </b-container>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar';

export default {
  name: 'MainLayout',

  components: {
    Navbar,
  },
};
</script>
