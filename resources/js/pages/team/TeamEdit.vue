<template>
  <b-col lg="6" class="m-auto">
    <card title="Team Edit">
      <alert :error="error" /> 

      <team-form
        v-if="currentTeam"
        :default="currentTeam"
        @submit="onSubmit"
        @cancel="onCancel"
      />
    </card>
  </b-col>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import TeamForm from '~/components/forms/TeamForm';

export default {
  name: 'TeamEdit',

  layout: 'centered',

  metaInfo() {
    return { title: 'Team Edit' };
  },

  middleware: 'auth',

  components: {
    TeamForm,
  },

  created() {
    this.fetchTeam(this.$route.params.id);
  },

  computed: {
    ...mapGetters('team', ['currentTeam', 'error']),
  },

  methods: {
    ...mapActions('team', ['fetchTeam', 'updateTeam']),

    async onSubmit(teamForm) {
      const team = await this.updateTeam(teamForm);
      this.$router.push({ name: 'Teams' });
    },

    onCancel() {
      this.$router.push({ name: 'Teams' })
    },
  },
}
</script>
