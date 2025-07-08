<template>
  <div>
    <!-- Show navbar, banner, footer only when NOT on specific admin pages -->
    <template v-if="!hideLayout">
      <Navbar />
      <Banner />
    </template>
    
    <!-- Main routed content -->
    <router-view />
    
    <!-- Show footer only when NOT on specific admin pages -->
    <Footer v-if="!hideLayout" />
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import Banner from './components/Banner.vue'
import Footer from './components/Footer.vue'
import Navbar from './components/Navbar.vue'


const route = useRoute()

// Define specific routes where you want to hide the layout
const hideLayout = computed(() => {
  const adminRoutes = [
    '/admin/login',
    '/admin/dashboard',
    '/admin/programs',
    '/admin/users',
    '/admin/settings',
    '/admin/jobsUsers',
    '/admin/home'
    // Add more admin routes as needed
  ]
  
  return adminRoutes.includes(route.path)
})
</script>