
<template>
  <admin-aside>
      <div class="min-h-screen bg-gray-50">
    <!-- Include the sidebar -->
    <AdminSidebar />
    
    <!-- Main content area with left margin to account for fixed sidebar -->
    <div class="">

      <!-- Main Content -->
      <main class="p-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div
            v-for="stat in stats"
            :key="stat.title"
            class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-600">{{ stat.title }}</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ stat.value }}</p>
                <p :class="[
                  'text-sm mt-2 flex items-center',
                  stat.change.startsWith('+') ? 'text-green-600' : 'text-red-600'
                ]">
                  {{ stat.change }} from last month
                </p>
              </div>
              <div :class="[
                'w-12 h-12 rounded-lg flex items-center justify-center',
                stat.bgColor
              ]">
                <component :is="stat.icon" :class="['w-6 h-6', stat.iconColor]" />
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Navigation Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
          <router-link
            v-for="quickLink in quickLinks"
            :key="quickLink.title"
            :to="quickLink.route"
            class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1 group"
          >
            <div class="flex items-center justify-between mb-4">
              <div :class="[
                'w-12 h-12 rounded-lg flex items-center justify-center transition-colors duration-200',
                quickLink.bgColor,
                'group-hover:' + quickLink.hoverBg
              ]">
                <component :is="quickLink.icon" :class="['w-6 h-6', quickLink.iconColor]" />
              </div>
              <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ quickLink.title }}</h3>
            <p class="text-gray-600 text-sm">{{ quickLink.description }}</p>
          </router-link>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
          <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
              <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
              <router-link
                to="/admin/analytics"
                class="text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors duration-200"
              >
                View All →
              </router-link>
            </div>
          </div>
          <div class="p-6">
            <div class="space-y-4">
              <div
                v-for="activity in recentActivities"
                :key="activity.id"
                class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200"
              >
                <div :class="[
                  'w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0',
                  activity.bgColor
                ]">
                  <component :is="activity.icon" :class="['w-4 h-4', activity.iconColor]" />
                </div>
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">{{ activity.title }}</p>
                  <p class="text-sm text-gray-600">{{ activity.description }}</p>
                  <p class="text-xs text-gray-500 mt-1">{{ activity.time }}</p>
                </div>
                <router-link
                  :to="activity.link"
                  class="text-blue-600 hover:text-blue-700 text-sm font-medium"
                >
                  View
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  </admin-aside>
</template>

<script setup>


import AdminAside from '../components/AdminAside.vue';

// Dashboard statistics
const stats = [
  {
    title: 'Total Programs',
    value: '12',
    change: '+2',
    icon: 'ProgramIcon',
    bgColor: 'bg-blue-100',
    iconColor: 'text-blue-600'
  },
  {
    title: 'Active Users',
    value: '1,234',
    change: '+12%',
    icon: 'UsersIcon',
    bgColor: 'bg-green-100',
    iconColor: 'text-green-600'
  },
  {
    title: 'Donations',
    value: '$45,678',
    change: '+8%',
    icon: 'DonationIcon',
    bgColor: 'bg-yellow-100',
    iconColor: 'text-yellow-600'
  },
  {
    title: 'Volunteers',
    value: '89',
    change: '+5',
    icon: 'VolunteerIcon',
    bgColor: 'bg-purple-100',
    iconColor: 'text-purple-600'
  }
]

// Quick navigation links
const quickLinks = [
  {
    title: 'Manage Programs',
    description: 'Add, edit, and organize your programs',
    route: '/admin/programs',
    icon: 'ProgramIcon',
    bgColor: 'bg-blue-100',
    hoverBg: 'bg-blue-200',
    iconColor: 'text-blue-600'
  },
  {
    title: 'User Management',
    description: 'Manage admin users and permissions',
    route: '/admin/users',
    icon: 'UsersIcon',
    bgColor: 'bg-green-100',
    hoverBg: 'bg-green-200',
    iconColor: 'text-green-600'
  },
  {
    title: 'Content Pages',
    description: 'Edit website pages and content',
    route: '/admin/pages',
    icon: 'PagesIcon',
    bgColor: 'bg-purple-100',
    hoverBg: 'bg-purple-200',
    iconColor: 'text-purple-600'
  },
  {
    title: 'Media Library',
    description: 'Upload and manage images and files',
    route: '/admin/media',
    icon: 'MediaIcon',
    bgColor: 'bg-yellow-100',
    hoverBg: 'bg-yellow-200',
    iconColor: 'text-yellow-600'
  },
  {
    title: 'Analytics',
    description: 'View detailed reports and statistics',
    route: '/admin/analytics',
    icon: 'AnalyticsIcon',
    bgColor: 'bg-red-100',
    hoverBg: 'bg-red-200',
    iconColor: 'text-red-600'
  },
  {
    title: 'Settings',
    description: 'Configure system settings',
    route: '/admin/settings',
    icon: 'SettingsIcon',
    bgColor: 'bg-gray-100',
    hoverBg: 'bg-gray-200',
    iconColor: 'text-gray-600'
  }
]

// Recent activities
const recentActivities = [
  {
    id: 1,
    title: 'New program added',
    description: 'Early Child Care program was created',
    time: '2 hours ago',
    icon: 'ProgramIcon',
    bgColor: 'bg-blue-100',
    iconColor: 'text-blue-600',
    link: '/admin/programs'
  },
  {
    id: 2,
    title: 'User registered',
    description: 'New admin user Sarah Johnson was added',
    time: '4 hours ago',
    icon: 'UsersIcon',
    bgColor: 'bg-green-100',
    iconColor: 'text-green-600',
    link: '/admin/users'
  },
  {
    id: 3,
    title: 'Page updated',
    description: 'About Us page content was modified',
    time: '1 day ago',
    icon: 'PagesIcon',
    bgColor: 'bg-purple-100',
    iconColor: 'text-purple-600',
    link: '/admin/pages'
  },
  {
    id: 4,
    title: 'Media uploaded',
    description: '5 new images added to gallery',
    time: '2 days ago',
    icon: 'MediaIcon',
    bgColor: 'bg-yellow-100',
    iconColor: 'text-yellow-600',
    link: '/admin/media'
  }
]
</script>

<style scoped>
/* Icon placeholders */
.ProgramIcon, .UsersIcon, .DonationIcon, .VolunteerIcon,
.PagesIcon, .MediaIcon, .AnalyticsIcon, .SettingsIcon {
  width: 1.25rem;
  height: 1.25rem;
}
</style>


