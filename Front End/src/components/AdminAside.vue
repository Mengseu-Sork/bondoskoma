```vue
<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside :class="[
      'bg-white shadow-lg min-h-screen border-r border-gray-200 fixed left-0 top-0 z-50 transition-all duration-300',
      isCollapsed ? 'w-16' : 'w-64'
    ]">
      <!-- Sidebar Header -->
      <div class="p-4 border-b border-gray-100">
        <div class="flex items-center justify-between">
          <div v-if="!isCollapsed" class="flex items-center space-x-3">
            <div class="relative">
              <img 
                src="https://www.bandoskomar.org/wp-content/uploads/2017/12/cropped-cropped-bandos-komar-logo-1-1_white_bg-2.jpg"
                alt="Bandos Komar Logo"
                class="h-10 w-10 rounded-lg shadow-md border border-gray-200"
              />
              <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
            </div>
            <div>
              <h2 class="text-lg font-bold text-gray-900">Admin Panel</h2>
              <p class="text-xs text-gray-500">Bandos Komar</p>
            </div>
          </div>
          
          <!-- Collapse Toggle -->
          <button
            @click="toggleSidebar"
            class="p-2 rounded-lg bg-gray-50 hover:bg-gray-100 text-gray-600 hover:text-gray-900 transition-all duration-200"
            aria-label="Toggle sidebar"
          >
            <svg 
              :class="[
                'w-4 h-4 transition-transform duration-300',
                isCollapsed ? 'rotate-180' : ''
              ]" 
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Navigation Menu -->
      <nav class="mt-6 px-3 pb-20">
        <div class="space-y-2">
          <!-- Dashboard -->
          <router-link
            to="/admin/dashboard"
            :class="[
              'group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 relative',
              $route.path === '/admin/dashboard' 
                ? 'bg-blue-50 text-blue-700 border-r-4 border-blue-500 shadow-sm' 
                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900'
            ]"
          >
            <svg 
              :class="[
                'flex-shrink-0 transition-colors duration-200',
                isCollapsed ? 'w-6 h-6' : 'w-5 h-5 mr-3',
                $route.path === '/admin/dashboard' ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600'
              ]" 
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z" />
            </svg>
            
            <span v-if="!isCollapsed" class="truncate">Dashboard</span>

            <div 
              v-if="isCollapsed"
              class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap z-50"
            >
              Dashboard
            </div>
          </router-link>

          <!-- Management Folder -->
          <div>
            <button
              @click="toggleManagementMenu"
              :class="[
                'group flex items-center w-full px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 relative',
                isManagementMenuOpen ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900'
              ]"
              :aria-expanded="isManagementMenuOpen"
              aria-controls="management-submenu"
            >
              <svg 
                :class="[
                  'flex-shrink-0 transition-colors duration-200',
                  isCollapsed ? 'w-6 h-6' : 'w-5 h-5 mr-3',
                  isManagementMenuOpen ? 'text-gray-600' : 'text-gray-400 group-hover:text-gray-600'
                ]" 
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 11h18M3 15h18M3 19h18" />
              </svg>
              
              <span v-if="!isCollapsed" class="truncate">Management</span>
              
              <svg 
                v-if="!isCollapsed"
                :class="[
                  'w-4 h-4 ml-auto transition-transform duration-200',
                  isManagementMenuOpen ? 'rotate-180' : ''
                ]"
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>

              <div 
                v-if="isCollapsed"
                class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap z-50"
              >
                Management
              </div>
            </button>

            <!-- Management Submenu -->
            <div 
              v-if="isManagementMenuOpen && !isCollapsed"
              id="management-submenu"
              class="ml-4 mt-2 space-y-1"
            >
              <!-- Home -->
              <router-link
                to="/admin/home"
                :class="[
                  'group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative',
                  $route.path === '/admin/home' 
                    ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                ]"
              >
                <svg 
                  :class="[
                    'flex-shrink-0 w-5 h-5 mr-3 transition-colors duration-200',
                    $route.path === '/admin/home' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
                  ]" 
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9zM9 22V12h6v10" />
                </svg>
                
                <span class="truncate">Home</span>
              </router-link>

              <!-- Photo -->
              <router-link
                to="/admin/photo"
                :class="[
                  'group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative',
                  $route.path === '/admin/photo' 
                    ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                ]"
              >
                <svg 
                  :class="[
                    'flex-shrink-0 w-5 h-5 mr-3 transition-colors duration-200',
                    $route.path === '/admin/photo' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
                  ]" 
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                
                <span class="truncate">Photo</span>
              </router-link>

              <!-- Reports -->
              <router-link
                to="/admin/reports"
                :class="[
                  'group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative',
                  $route.path === '/admin/reports' 
                    ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                ]"
              >
                <svg 
                  :class="[
                    'flex-shrink-0 w-5 h-5 mr-3 transition-colors duration-200',
                    $route.path === '/admin/reports' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
                  ]" 
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6m-6 0v6m3-3h6m-6 0H6m-3 6h18M3 3h18v18H3V3z" />
                </svg>
                
                <span class="truncate">Reports</span>
              </router-link>

              <!-- Video -->
              <router-link
                to="/admin/videoUsers"
                :class="[
                  'group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative',
                  $route.path === '/admin/videoUsers' 
                    ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                ]"
              >
                <svg 
                  :class="[
                    'flex-shrink-0 w-5 h-5 mr-3 transition-colors duration-200',
                    $route.path === '/admin/videoUsers' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
                  ]" 
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.586-4.39A1 1 0 006.666 7.764v8.472a1 1 0 001.5.866l6.586-4.39a1 1 0 000-1.732zM5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                </svg>
                
                <span class="truncate">Video</span>
              </router-link>

              <!-- Volunteers -->
              <router-link
                to="/admin/VolunteesUsers"
                :class="[
                  'group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative',
                  $route.path === '/admin/VolunteesUsers' 
                    ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                ]"
              >
                <svg 
                  :class="[
                    'flex-shrink-0 w-5 h-5 mr-3 transition-colors duration-200',
                    $route.path === '/admin/VolunteesUsers' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
                  ]" 
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6 4a4 4 0 10-8 0 4 4 0 008 0z" />
                </svg>
                
                <span class="truncate">Volunteers</span>
              </router-link>

              <!-- HR -->
              <router-link
                to="/admin/hr"
                :class="[
                  'group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative',
                  $route.path === '/admin/hr' 
                    ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                ]"
              >
                <svg 
                  :class="[
                    'flex-shrink-0 w-5 h-5 mr-3 transition-colors duration-200',
                    $route.path === '/admin/hr' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
                  ]" 
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13.5 7a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                
                <span class="truncate">HR</span>
              </router-link>

              <!-- Jobs -->
              <router-link
                to="/admin/jobsUsers"
                :class="[
                  'group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative',
                  $route.path === '/admin/jobsUsers' 
                    ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                ]"
              >
                <svg 
                  :class="[
                    'flex-shrink-0 w-5 h-5 mr-3 transition-colors duration-200',
                    $route.path === '/admin/jobsUsers' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
                  ]" 
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                
                <span class="truncate">Jobs</span>
              </router-link>

              <!-- Programs -->
              <router-link
                to="/admin/programs"
                :class="[
                  'group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative',
                  $route.path === '/admin/programs' 
                    ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                ]"
              >
                <svg 
                  :class="[
                    'flex-shrink-0 w-5 h-5 mr-3 transition-colors duration-200',
                    $route.path === '/admin/programs' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
                  ]" 
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7h18M3 4h18M4 4v17M20 4v17" />
                </svg>
                
                <span class="truncate">Programs</span>
              </router-link>

              <!-- Donation -->
              <router-link
                to="/admin/donations"
                :class="[
                  'group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative',
                  $route.path === '/admin/donations' 
                    ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                ]"
              >
                <svg
                  :class="[
                    'flex-shrink-0 w-5 h-5 mr-3 transition-colors duration-200',
                    $route.path === '/admin/donations' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
                  ]"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <rect x="2" y="7" width="20" height="10" rx="2" ry="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <line x1="2" y1="11" x2="22" y2="11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <line x1="7" y1="15" x2="7.01" y2="15" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="truncate">Donation</span>
              </router-link>
            </div>
          </div>

          <!-- Settings -->
          <router-link
            to="/admin/settings"
            :class="[
              'group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 relative',
              $route.path === '/admin/settings' 
                ? 'bg-purple-50 text-purple-700 border-r-4 border-purple-500 shadow-sm' 
                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900'
            ]"
          >
            <svg 
              :class="[
                'flex-shrink-0 transition-colors duration-200',
                isCollapsed ? 'w-6 h-6' : 'w-5 h-5 mr-3',
                $route.path === '/admin/settings' ? 'text-purple-600' : 'text-gray-400 group-hover:text-gray-600'
              ]" 
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            
            <span v-if="!isCollapsed" class="truncate">Settings</span>

            <div 
              v-if="isCollapsed"
              class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap z-50"
            >
              Settings
            </div>
          </router-link>
        </div>
      </nav>
    </aside>

    <!-- Main Content Area -->
    <div :class="[
      'transition-all duration-300',
      isCollapsed ? 'ml-16' : 'ml-64'
    ]">
      <!-- Top Navbar -->
      <nav class="bg-white shadow-sm border-b border-gray-200 px-6 py-4 sticky top-0 z-40">
        <div class="flex justify-between items-center">
          <!-- Left side - Page title and breadcrumb -->
          <div class="flex items-center space-x-4">
            <!-- Mobile menu button -->
            <button
              @click="toggleMobileSidebar"
              class="md:hidden p-2 rounded-lg bg-gray-50 hover:bg-gray-100 text-gray-600 hover:text-gray-900 transition-all duration-200"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>

            <!-- Page Title and Breadcrumb -->
            <div>
              <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-1">
                <router-link to="/admin/dashboard" class="hover:text-gray-700 transition-colors duration-200">
                  Admin
                </router-link>
                <span>/</span>
                <span class="text-gray-900 font-medium">{{ currentPageTitle }}</span>
              </nav>
              <h1 class="text-xl font-bold text-gray-900">{{ currentPageTitle }}</h1>
            </div>
          </div>

          <!-- Right side - User info and actions -->
          <div class="flex items-center space-x-4">
            <!-- Search Bar -->
            <div class="hidden md:block relative">
              <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Search..."
                class="w-64 pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 focus:bg-white transition-all duration-200"
              />
            </div>

            <!-- Notifications -->
            <div class="relative notifications-dropdown">
              <button 
                @click="toggleNotifications"
                class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors duration-200 rounded-lg hover:bg-gray-50"
              >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z" />
                </svg>
                <!-- Notification badge -->
                <span
                  v-if="unreadCount > 0"
                  class="absolute -top-1 -right-1 min-w-[1.25rem] h-5 bg-red-500 text-white text-xs font-medium rounded-full flex items-center justify-center"
                >
                  {{ unreadCount }}
                </span>
              </button>

              <!-- Notifications Dropdown -->
              <div
                v-if="showNotifications"
                class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50"
              >
                <div class="px-4 py-3 border-b border-gray-100">
                  <h3 class="text-sm font-semibold text-gray-900">Notifications</h3>
                </div>
                <div class="max-h-64 overflow-y-auto">
                  <div
                    v-for="notification in notifications"
                    :key="notification.id"
                    class="px-4 py-3 hover:bg-gray-50 transition-colors duration-200 border-b border-gray-50 last:border-b-0"
                  >
                    <div class="flex items-start space-x-3">
                      <div :class="[
                        'w-2 h-2 rounded-full mt-2 flex-shrink-0',
                        notification.read ? 'bg-gray-300' : 'bg-blue-500'
                      ]"></div>
                      <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ notification.name }}</p>
                        <p class="text-xs text-gray-600 mt-1 line-clamp-2">{{ notification.paragraph }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ notification.time }}</p>
                      </div>
                    </div>
                  </div>
                  <div v-if="notifications.length === 0" class="px-4 py-3 text-center text-gray-500">
                    No notifications available.
                  </div>
                </div>
                <div class="px-4 py-2 border-t border-gray-100">
                  <router-link
                    to="/admin/notification"
                    @click="showNotifications = false"
                    class="text-sm text-blue-600 hover:text-blue-700 font-medium"
                  >
                    View all notifications
                  </router-link>
                </div>
              </div>
            </div>

            <!-- User dropdown -->
            <div class="relative" ref="userDropdown">
              <button
                @click="showUserMenu = !showUserMenu"
                class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition-all duration-200 group"
              >
                <!-- User avatar -->
                <div class="relative">
                  <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center shadow-md">
                    <span class="text-white text-sm font-bold">{{ userInitials }}</span>
                  </div>
                  <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                </div>

                <!-- User info -->
                <div class="hidden md:block text-left">
                  <p class="text-sm font-medium text-gray-900">{{ currentUser.name }}</p>
                  <p class="text-xs text-gray-500">{{ currentUser.role }}</p>
                </div>

                <!-- Dropdown arrow -->
                <svg 
                  :class="[
                    'w-4 h-4 text-gray-400 transition-transform duration-200',
                    showUserMenu ? 'rotate-180' : ''
                  ]" 
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>

              <!-- Dropdown menu -->
              <div
                v-if="showUserMenu"
                class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50"
              >
                <!-- User info section -->
                <div class="px-4 py-3 border-b border-gray-100">
                  <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                      <span class="text-white text-sm font-bold">{{ userInitials }}</span>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-900">{{ currentUser.name }}</p>
                      <p class="text-xs text-gray-500">{{ currentUser.email }}</p>
                      <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-1">
                        {{ currentUser.role }}
                      </span>
                    </div>
                  </div>
                </div>

                <!-- Menu items -->
                <div class="py-2">
                  <!-- Profile -->
                  <router-link
                    to="/admin/profile-edit"
                    @click="showUserMenu = false"
                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200"
                  >
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Profile Edit
                  </router-link>

                  <!-- Settings -->
                  <router-link
                    to="/admin/settings"
                    @click="showUserMenu = false"
                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200"
                  >
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Admin Settings
                  </router-link>

                  <!-- Divider -->
                  <div class="border-t border-gray-100 my-2"></div>

                  <!-- View Website -->
                  <a
                    href="/"
                    target="_blank"
                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200"
                  >
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    View Website
                    <svg class="w-3 h-3 ml-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                  </a>

                  <!-- Help -->
                  <button
                    @click="showHelp"
                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200"
                  >
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Help & Support
                  </button>

                  <!-- Divider -->
                  <div class="border-t border-gray-100 my-2"></div>

                  <!-- Logout -->
                  <button
                    @click="logout"
                    class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200"
                  >
                    <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Content -->
      <main class="min-h-screen">
        <slot />
      </main>
    </div>

    <!-- Mobile Overlay -->
    <div 
      v-if="showMobileOverlay"
      class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
      @click="closeMobileSidebar"
    ></div>

    <!-- Toast Notifications -->
    <div v-if="toastMessage" class="fixed bottom-4 right-4 bg-gray-900 text-white px-4 py-2 rounded-lg shadow-lg">
      {{ toastMessage }}
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import api from '@/plugin/axios'

const router = useRouter()
const route = useRoute()

// Reactive state
const isCollapsed = ref(false)
const isManagementMenuOpen = ref(false)
const showUserMenu = ref(false)
const showNotifications = ref(false)
const showMobileOverlay = ref(false)
const searchQuery = ref('')
const userDropdown = ref(null)
const notifications = ref([])
const toastMessage = ref('')

// Current user info
const currentUser = ref({
  name: 'Admin User',
  role: 'Administrator',
  email: 'admin@bandoskomar.org'
})

const userInitials = computed(() => {
  return currentUser.value.name
    .split(' ')
    .map(name => name.charAt(0))
    .join('')
    .toUpperCase()
})

// Compute unread notifications count
const unreadCount = computed(() => {
  return notifications.value.filter(n => !n.read).length
})

// Get current page title based on route
const currentPageTitle = computed(() => {
  const routeMap = {
    '/admin/dashboard': 'Dashboard',
    '/admin/home': 'Home',
    '/admin/photo': 'Photo',
    '/admin/reports': 'Reports',
    '/admin/videoUsers': 'Video',
    '/admin/VolunteesUsers': 'Volunteers',
    '/admin/hr': 'HR',
    '/admin/jobsUsers': 'Jobs',
    '/admin/programs': 'Programs',
    '/admin/settings': 'Settings',
    '/admin/profile-edit': 'Profile Edit',
    '/admin/notification': 'Notifications'
  }
  return routeMap[route.path] || 'Admin'
})

// Load read and deleted statuses from localStorage
const loadReadStatuses = () => {
  return JSON.parse(localStorage.getItem('notificationReadStatuses') || '{}')
}
const loadDeletedIds = () => {
  return JSON.parse(localStorage.getItem('deletedNotificationIds') || '[]')
}

// Fetch notifications from API
const fetchNotifications = async () => {
  try {
    const response = await api.get('/contact')
    const readStatuses = loadReadStatuses()
    const deletedIds = loadDeletedIds()
    notifications.value = response.data.contact
      .filter(contact => !deletedIds.includes(contact.id))
      .map(contact => ({
        id: contact.id,
        name: contact.name,
        paragraph: contact.paragraph,
        phone: contact.phone,
        time: new Date(contact.created_at).toLocaleString(),
        read: readStatuses[contact.id] || false
      }))
  } catch (error) {
    console.error('Error fetching notifications:', error)
    showToast('Failed to fetch notifications.')
  }
}

// Show toast message
const showToast = (message) => {
  toastMessage.value = message
  setTimeout(() => {
    toastMessage.value = ''
  }, 3000)
}

// Methods
const toggleSidebar = () => {
  isCollapsed.value = !isCollapsed.value
  localStorage.setItem('sidebarCollapsed', isCollapsed.value.toString())
}

const toggleManagementMenu = () => {
  if (!isCollapsed.value) {
    isManagementMenuOpen.value = !isManagementMenuOpen.value
    localStorage.setItem('managementMenuOpen', isManagementMenuOpen.value.toString())
  }
}

const toggleMobileSidebar = () => {
  showMobileOverlay.value = !showMobileOverlay.value
}

const closeMobileSidebar = () => {
  showMobileOverlay.value = false
}

const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value
}

const goToProfile = () => {
  showUserMenu.value = false
  console.log('Go to profile')
}

const showHelp = () => {
  showUserMenu.value = false
  console.log('Show help')
}

const logout = () => {
  showUserMenu.value = false
  if (confirm('Are you sure you want to logout?')) {
    localStorage.removeItem('adminToken')
    localStorage.removeItem('adminLoggedIn')
    localStorage.removeItem('adminRole')
    localStorage.removeItem('adminPermissions')
    localStorage.removeItem('adminUser')
    router.push('/admin/login')
  }
}

// Close dropdowns when clicking outside
const handleClickOutside = (event) => {
  if (userDropdown.value && !userDropdown.value.contains(event.target)) {
    showUserMenu.value = false
  }
  if (!event.target.closest('.notifications-dropdown')) {
    showNotifications.value = false
  }
}

// Load sidebar and menu state from localStorage
const loadSidebarState = () => {
  const savedSidebarState = localStorage.getItem('sidebarCollapsed')
  if (savedSidebarState !== null) {
    isCollapsed.value = savedSidebarState === 'true'
  }
  const savedMenuState = localStorage.getItem('managementMenuOpen')
  if (savedMenuState !== null) {
    isManagementMenuOpen.value = savedMenuState === 'true'
  }
}

onMounted(() => {
  loadSidebarState()
  fetchNotifications()
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>
```