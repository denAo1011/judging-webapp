// general routes

export default [
  {
    path: '/',
    component: () => import('../views/pages/Home.vue'),
    name: 'home',
  },
  {
    path: '/about-us',
    component: () =>import('../views/pages/About.vue'),
    name: 'about',
  },
  {
    path: '/jurors',
    component: () =>import('../views/pages/Jurors.vue'),
    name: 'jurors',
  },
  {
    path: '/eligibility',
    component: () =>import('../views/pages/Eligibility.vue'),
    name: 'eligibility',
  },
  {
    path: '/faqs',
    component: () =>import('../views/pages/FAQ.vue'),
    name: 'faqs',
  },
  {
    path: '/admin',
    redirect: "/admin/entries",
    component: () =>import('../views/admin/Scaffold.vue'),
    children: [
      {
        path: '/admin/entries',
        name: 'entries',
        component: () =>import('../views/admin/Entries.vue'),
      },
    ],
  },
//   {
//     path: '/:pathMatch(.*)*',
//     component: NotFound,
//     name: 'NotFound',
//   },
];
