<template>
  <b-col lg="6" class="m-auto">
    <card title="Player Add">
      <alert :error="error" />

      <player-form
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
  name: 'PlayerAdd',

  layout: 'centered',

  metaInfo() {
    return { title: 'Player Add' };
  },

  middleware: 'auth',

  components: {
    PlayerForm,
  },

  mixins: [TeamMixin],

  computed: {
    ...mapGetters('player', ['error']),
  },

  methods: {
    ...mapActions('player', ['createPlayer']),

    async onSubmit(playerForm) {
      const player = await this.createPlayer(playerForm);
      this.$router.push({ name: 'Players' });
    },

    onCancel() {
      this.$router.push({ name: 'Players' })
    },
  },
}
</script>
