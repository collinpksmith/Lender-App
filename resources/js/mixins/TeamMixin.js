import { mapGetters, mapActions } from 'vuex';

export default {
  computed: {
    ...mapGetters('team', ['teams']),

    teamOptions() {
      return this.teams.map((team) => ({
        value: team.id,
        text: team.name,
      }));
    },
  },

  created() {
    this.fetchTeams();
  },

  methods: {
    ...mapActions('team', ['fetchTeams']),
  },
};
