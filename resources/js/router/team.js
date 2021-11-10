export default (page) => [
  {
    path: '/teams',
    name: 'Teams',
    component: page('team/Teams.vue'),
  },
  {
    path: '/teams/new',
    name: 'TeamAdd',
    component: page('team/TeamAdd.vue'),
  },
  {
    path: '/teams/:id',
    name: 'TeamView',
    component: page('team/TeamView.vue'),
  },
  {
    path: '/teams/:id/edit',
    name: 'TeamEdit',
    component: page('team/TeamEdit.vue'),
  },
];
