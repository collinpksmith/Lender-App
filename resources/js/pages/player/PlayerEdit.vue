<template>
  <b-col lg="6" class="m-auto">
    <card title="Player Edit">
      <alert :error="error" /> 

      <player-form
        v-if="currentPlayer"
        :default="currentPlayer"
        :teams="teamOptions"
        @submit="onSubmit"
        @cancel="onCancel"
      />
    </card>
  </b-col>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import PlayerForm from '~/components/forms/PlayerForm';
import TeamMixin from '../../mixins/TeamMixin';

export default {
  name: 'PlayerEdit',

  layout: 'centered',

  metaInfo() {
    return { title: 'Player Edit' };
  },

  middleware: 'auth',

  components: {
    PlayerForm,
  },

  mixins: [TeamMixin],

  created() {
    this.fetchPlayer(this.$route.params.id);
  },

  computed: {
    ...mapGetters('player', ['currentPlayer', 'error']),
  },

  methods: {
    ...mapActions('player', ['fetchPlayer', 'updatePlayer']),

    async onSubmit(playerForm) {
      const player = await this.updatePlayer(playerForm);
      this.$router.push({ name: 'Players' });
    },

    onCancel() {
      this.$router.push({ name: 'Players' })
    },
  },
}
</script>
