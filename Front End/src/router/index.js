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
      path: '/jobs/:id',
      name: 'JobDetail',
      component: () => import('../views/DetailJobView.vue'),
    },
    {
      path: '/admin/login',
      name: 'admin-login',
      component: () => import('../views/AdminLoginView.vue'),
    },
    {
      path: '/admin/dashboard',
      name: 'admin-dashboard',
      component: () => import('../views/AdminDashboardView.vue'),
    },
    {
      path: '/admin/users',
      name: 'admin-users',
      component: () => import('../views/AdminUserView.vue'),
    },
    {
      path: '/admin/settings',
      name: 'admin-settings',
      component: () => import('../views/AdminSettingView.vue'),
    },
    {
      path: '/admin/jobsUsers',
      name: 'admin-jobsUsers',
      component: () => import('../views/AdminJobView.vue'),
    },
    {
      path: '/admin/videoUsers',
      name: 'admin-videoUsers',
      component: () => import('../views/AdminVideoView.vue'),
    },
    {
      path: '/admin/VolunteesUsers',
      name: 'admin-VolunteesUsers',
      component: () => import('../views/AdminVolunteeView.vue'),
    },
    {
      path: '/admin/hr',
      name: 'admin-hr',
      component: () => import('../views/HrView.vue'),
    },
  ],
})
// router.beforeEach((to, from, next) => {
//   const isAuthenticated = !!localStorage.getItem('adminToken')
//   const isAdminRoute = to.path.startsWith('/admin') && to.path !== '/admin/login'

//   // If trying to access admin pages without being logged in, redirect to login
//   if (isAdminRoute && !isAuthenticated) {
//     next('/admin/login')
//   } 
//   // If already logged in and trying to access login page, redirect to dashboard
//   else if (to.path === '/admin/login' && isAuthenticated) {
//     next('/admin/dashboard')
//   } 
//   else {
//     next()
//   }
// })


  export default router
