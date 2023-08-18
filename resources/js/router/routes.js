// general routes

export default [
  {
    path: '/',
    component: import('../views/pages/Home.vue'),
    name: 'home',
  },
  {
    path: '/about-us',
    component: import('../views/pages/About.vue'),
    name: 'about',
  },
  {
    path: '/admin',
    redirect: "/admin/entries",
    component: import('../views/admin/Scaffold.vue'),
    children: [
      {
        path: '/admin/entries',
        name: 'entries',
        component: import('../views/admin/Entries.vue'),
      },
    ],
  },
//   {
//     path: '/:pathMatch(.*)*',
//     component: NotFound,
//     name: 'NotFound',
//   },
];
