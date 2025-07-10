import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
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
    path: '/admin/settings',
    name: 'admin-settings',
    component: () => import('../views/AdminSettingView.vue'),
  },
  {
    path: '/admin/photo',
    name: 'admin-photo',
    component: () => import('../views/PhotoBackEndVeiw.vue'),
  },
  {
    path: '/admin/home',
    name: 'admin-home',
    component: () => import('../views/AdminHomeView.vue'),
  },
  {
    path: '/admin/jobsUsers',
    name: 'admin-jobsUsers',
    component: () => import('../views/AdminJobView.vue'),
  },
  {
    path: '/admin/reports',
    name: 'admin-reports',
    component: () => import('../views/ReportAdminView.vue'),
  },
  {
    path: '/admin/programs',
    name: 'admin-programs',
    component: () => import('../views/AdminProgramView.vue'),
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
  {
    path: '/admin/profile-edit',
    name: 'profile-edit',
    component: () => import('../views/FormUPdateProfileAdmin.vue'),
  },
  {
    path: '/contact',
    name: 'contact',
    component: () => import('../views/ContactView.vue'),
  },
  {
    path: '/admin/notification',
    name: 'admin-notification',
    component: () => import('../views/NotificationView.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

// Navigation guard to protect admin routes based on token presence
router.beforeEach((to) => {
  const isAuthenticated = !!localStorage.getItem('adminToken')
  const isAdminRoute = to.path.startsWith('/admin') && to.path !== '/admin/login'

  if (isAdminRoute && !isAuthenticated) {
    return { path: '/admin/login' }
  }

  if (to.path === '/admin/login' && isAuthenticated) {
    return { path: '/admin/dashboard' }
  }

  return true
})

export default router
