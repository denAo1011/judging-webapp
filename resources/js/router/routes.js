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
    path: '/entry-form',
    component: () =>import('../views/pages/EntryForm.vue'),
    name: 'entry-form',
  },
  {
    path: '/judge',
    redirect: "/judge/process",
  },
  {
    path: '/judge/process',
    component: () =>import('../views/judge/Process.vue'),
    name: 'process',
  },
  {
    path: '/judge/judging',
    component: () =>import('../views/judge/Judging.vue'),
    name: 'judging',
  },
  {
    path: '/signin',
    component: () =>import('../views/pages/SignIn.vue'),
    name: 'signin',
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
