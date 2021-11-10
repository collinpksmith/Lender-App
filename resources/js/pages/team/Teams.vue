<template>
  <div>
    <alert :error="error" />

    <crud-table
      name="Teams"
      :items="teams"
      :fields="fields"
      pageView="TeamView"
      pageEdit="TeamEdit"
      pageAdd="TeamAdd"
      @delete-item="onDeleteTeam"
    />
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import { formatDate } from '~/plugins/date';

export default {
  name: 'Teams',

  metaInfo() {
    return { title: 'Teams' };
  },

  middleware: 'auth',

  data() {
    return {
      fields: [
        { key: 'id', label: 'ID' },
        { key: 'name', label: 'Name' },
        {
          key: 'created_at',
          label: 'Created At',
          formatter: value => formatDate(value),
        },
        {
          key: 'updated_at',
          label: 'Updated At',
          formatter: value => formatDate(value),
        },
        'action',
      ],
    }
  },

  created() {
    this.fetchTeams()
  },

  computed: {
    ...mapGetters('team', ['teams', 'error']),
  },

  methods: {
    ...mapActions('team', ['fetchTeams', 'deleteTeam']),

    onDeleteTeam(id) {
      this.deleteTeam(id);
    }
  },
}
</script>
