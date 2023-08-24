// general routes

export default [
    {
        path: '/',
        redirect: '/digital-judging',
    },
  {
    path: '/digital-judging',
    component: () => import('../views/pages/Home.vue'),
    name: 'home',
  },
  {
    path: '/digital-judging/about-us',
    component: () =>import('../views/pages/About.vue'),
    name: 'about',
  },
  {
    path: '/digital-judging/jurors',
    component: () =>import('../views/pages/Jurors.vue'),
    name: 'jurors',
  },
  {
    path: '/digital-judging/eligibility',
    component: () =>import('../views/pages/Eligibility.vue'),
    name: 'eligibility',
  },
  {
    path: '/digital-judging/faqs',
    component: () =>import('../views/pages/FAQ.vue'),
    name: 'faqs',
  },
  {
    path: '/digital-judging/entry-form',
    component: () =>import('../views/pages/EntryForm.vue'),
    name: 'entry-form',
  },
  {
    path: '/digital-judging/judge',
    redirect: "/judge/process",
  },
  {
    path: '/digital-judging/judge/process',
    component: () =>import('../views/judge/Process.vue'),
    name: 'process',
  },
  {
    path: '/digital-judging/judge/judging',
    component: () =>import('../views/judge/Judging.vue'),
    name: 'judging',
  },
  {
    path: '/digital-judging/signin',
    component: () =>import('../views/pages/SignIn.vue'),
    name: 'signin',
  },
  {
    path: '/digital-judging/admin',
    redirect: "/admin/entries",
    component: () =>import('../views/admin/Scaffold.vue'),
    children: [
      {
        path: '/digital-judging/admin/entries',
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
