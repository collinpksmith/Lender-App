<template>
  <div class="text-center">
    <h3 class="mb-4">Page Is Not Found</h3>

    <div class="links">
      <router-link :to="{ name: 'welcome' }">
        Go Home
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  layout: 'basic',

  name: 'NotFound',
};
</script>
