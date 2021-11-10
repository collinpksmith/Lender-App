<template>
  <div>
    <alert :error="error" />

    <div v-if="currentTeam">
      <div class="d-flex justify-content-between align-items-center">
        <b-button
          variant="success"
          :to="{ name: 'TeamEdit', params: { id: currentTeam.id } }"
        >
          Edit
        </b-button>
        
        <h2>{{ currentTeam.name }}</h2>

        <b-button
          variant="light"
          :to="{ name: 'Teams' }"
        >
          Teams
        </b-button>
      </div>

      <card title="Players">
        <b-table
          name="Player Table"
          :fields="playerFields"
          :items="currentTeam.players"
          @row-clicked="playerClicked"
          hover
          striped
          class="text-center"
        />
      </card>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import { formatDate } from '~/plugins/date';

export default {
  name: 'TeamView',

  metaInfo() {
    return { title: 'TeamView' };
  },

  middleware: 'auth',

  data() {
    return {
      playerFields: [
        { key: 'id', label: 'ID' },
        { key: 'first_name', label: 'First Name' },
        { key: 'last_name', label: 'Last Name' },
        {
          key: 'created_at',
          label: 'Created At',
          formatter: (value) => formatDate(value),
        },
      ],
    }
  },

  created() {
    this.fetchTeam(this.$route.params.id);
  },

  computed: {
    ...mapGetters('team', ['currentTeam', 'error']),
  },

  methods: {
    ...mapActions('team', ['fetchTeam']),

    playerClicked(player) {
      this.$router.push({ name: 'PlayerView', params: { id: player.id }});
    }
  },
}
</script>
