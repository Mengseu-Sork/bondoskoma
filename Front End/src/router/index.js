  import { createRouter, createWebHistory } from 'vue-router'
  import HomeView from '../views/HomeView.vue'
  

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue'),
    },
    {
      path: '/donate',
      name: 'donate',
      component: () => import('../views/DonateView.vue'),
    },
    {
      path: '/event',
      name: 'event',
      component: () => import('../views/EventView.vue'),
    },
    {
      path: '/history',
      name: 'history',
      component: () => import('../views/HistoryView.vue'),
    },
    {
      path: '/hr',
      name: 'hr',
      component: () => import('../views/HrView.vue'),
    },
    {
      path: '/kid-art',
      name: 'kid-art',
      component: () => import('../views/KidArtView.vue'),
    },
    {
      path: '/partner',
      name: 'partner',
      component: () => import('../views/PartnerView.vue'),
    },
    {
      path: '/photo',
      name: 'photo',
      component: () => import('../views/PhotoView.vue'),
    },
    {
      path: '/our-program',
      name: 'our-program',
      component: () => import('../views/ProgramView.vue'),
    },
    {
      path: '/report',
      name: 'report',
      component: () => import('../views/ReportView.vue'),
    },
    {
      path: '/video',
      name: 'video',
      component: () => import('../views/VideoView.vue'),
    },
    {
      path: '/volunteer',
      name: 'volunteer',
      component: () => import('../views/VolunteerView.vue'),
    },
    {
      path: '/jobs',
      name: 'Jobs Announcement',
      component: () => import('../views/JobsAnnouncementView.vue'),
    },
    {
      path: '/jobs/:title',
      name: 'JobDetail',
      component: () => import('../views/DetailJobView.vue'),
    },
    {
      path: '/admin/login',
      name: 'admin-login',
      component: () => import('../views/AdminLoginView.vue'),
    },
  ],
})

  export default router
