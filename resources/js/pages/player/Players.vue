<template>
  <div>
    <alert :error="error" />

    <crud-table
      name="Players"
      :items="players"
      :fields="fields"
      pageView="PlayerView"
      pageEdit="PlayerEdit"
      pageAdd="PlayerAdd"
      @delete-item="onDeletePlayer"
    />
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import { formatDate } from '~/plugins/date';

export default {
  name: 'Players',

  metaInfo() {
    return { title: 'Players' };
  },

  middleware: 'auth',

  data() {
    return {
      fields: [
        { key: 'id', label: 'ID' },
        { key: 'first_name', label: 'First Name' },
        { key: 'last_name', label: 'Last Name' },
        { 
          key: 'team',
          label: 'Team',
          formatter: value => value.name,
        },
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
    this.fetchPlayers()
  },

  computed: {
    ...mapGetters('player', ['players', 'error']),
  },

  methods: {
    ...mapActions('player', ['fetchPlayers', 'deletePlayer']),

    onDeletePlayer(id) {
      this.deletePlayer(id);
    }
  },
}
</script>
