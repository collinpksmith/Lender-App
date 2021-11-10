<template>
  <b-navbar toggleable="lg" type="dark" variant="info">
    <b-navbar-brand :to="{ name: 'welcome' }">
      {{ title }}
    </b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav v-if="user" class="ml-auto">
        <b-nav-item :to="{ name: 'Teams' }" active-class="active">
          Teams
        </b-nav-item>
        <b-nav-item :to="{ name: 'Players' }" active-class="active">
          Players
        </b-nav-item>
        <b-nav-item-dropdown right>
          <!-- Using 'button-content' slot -->
          <template #button-content>
            <img :src="user.photo_url" class="rounded-circle profile-photo mr-1" />
            <em>{{ user.name }}</em>
          </template>

          <b-dropdown-item href="#" @click.prevent="onLogOut">Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>

      <b-navbar-nav v-else class="ml-auto">
        <b-nav-item :to="{ name: 'login' }" right>LogIn</b-nav-item>
        <b-nav-item :to="{ name: 'register' }" right>Register</b-nav-item>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  computed: mapGetters('auth', ['user']),

  data: () => ({
    title: window.config.appName,
  }),

  methods: {
    ...mapActions('auth', ['logout']),

    async onLogOut() {
      await this.logout();
      this.$router.push({ name: 'login' });
    },
  },
};
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -0.375rem 0;
}
</style>
