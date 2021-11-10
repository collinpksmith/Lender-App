export default (page) => [
  {
    path: '/players',
    name: 'Players',
    component: page('player/Players.vue'),
  },
  {
    path: '/players/new',
    name: 'PlayerAdd',
    component: page('player/PlayerAdd.vue'),
  },
  {
    path: '/players/:id',
    name: 'PlayerView',
    component: page('player/PlayerView.vue'),
  },
  {
    path: '/players/:id/edit',
    name: 'PlayerEdit',
    component: page('player/PlayerEdit.vue'),
  },
];
