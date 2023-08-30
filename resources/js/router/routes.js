// general routes
import store from '../store';
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
    beforeEnter: (to, from, next) => {
      if (!store.getters.isAuth) {
        next();
      } else {
        next('/digital-judging/admin/entries');
      }
    },
  },
  {
    path: '/digital-judging/admin',
    redirect: "/digital-judging/admin/entries",
    component: () =>import('../views/admin/Scaffold.vue'),
    children: [
      {
        path: '/digital-judging/admin/entries',
        name: 'entries',
        component: () =>import('../views/admin/Entries.vue'),
      },
      {
        path: '/digital-judging/admin/jurors',
        name: 'jurors',
        component: () =>import('../views/admin/Jurors.vue'),
      },
      {
        path: '/digital-judging/admin/dashboard',
        name: 'dashboard',
        component: () =>import('../views/admin/Dashboard.vue'),
      }
    ],
    beforeEnter: (to, from, next) => {
      if (store.getters.isAuth) {
        next();
      } else {
        next('/digital-judging/signin');
      }
    }
  },
//   {
//     path: '/:pathMatch(.*)*',
//     component: NotFound,
//     name: 'NotFound',
//   },
];
