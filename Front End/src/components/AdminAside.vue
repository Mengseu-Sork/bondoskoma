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
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
            </svg>
            
            <span v-if="!isCollapsed" class="truncate">Dashboard</span>

            <!-- Tooltip for collapsed state -->
            <div 
              v-if="isCollapsed"
              class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap z-50"
            >
              Dashboard
            </div>
          </router-link>

          <!-- Users -->
          <router-link
            to="/admin/users"
            :class="[
              'group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 relative',
              $route.path === '/admin/users' 
                ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900'
            ]"
          >
            <svg 
              :class="[
                'flex-shrink-0 transition-colors duration-200',
                isCollapsed ? 'w-6 h-6' : 'w-5 h-5 mr-3',
                $route.path === '/admin/users' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
              ]" 
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
            </svg>
            
            <span v-if="!isCollapsed" class="truncate">Users</span>

            <div 
              v-if="isCollapsed"
              class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap z-50"
            >
              Users
            </div>
          </router-link>
          





          

 <router-link
            to="/admin/photo"
            :class="[
              'group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 relative',
              $route.path === '/admin/photo' 
                ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900'
            ]"
          >
            <svg 
              :class="[
                'flex-shrink-0 transition-colors duration-200',
                isCollapsed ? 'w-6 h-6' : 'w-5 h-5 mr-3',
                $route.path === '/admin/photo' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
              ]" 
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
            </svg>
            
            <span v-if="!isCollapsed" class="truncate">photo</span>

            <div 
              v-if="isCollapsed"
              class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap z-50"
            >
              photo
            </div>
          </router-link>








          

 <router-link
            to="/admin/reports"
            :class="[
              'group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 relative',
              $route.path === '/admin/reports' 
                ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900'
            ]"
          >
            <svg 
              :class="[
                'flex-shrink-0 transition-colors duration-200',
                isCollapsed ? 'w-6 h-6' : 'w-5 h-5 mr-3',
                $route.path === '/admin/reports' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
              ]" 
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
            </svg>
            
            <span v-if="!isCollapsed" class="truncate">reports</span>

            <div 
              v-if="isCollapsed"
              class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap z-50"
            >
              reports
            </div>
          </router-link>











          <!-- Jobs -->
          <router-link
            to="/admin/jobsUsers"
            :class="[
              'group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 relative',
              $route.path === '/admin/jobsUsers' 
                ? 'bg-green-50 text-green-700 border-r-4 border-green-500 shadow-sm' 
                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900'
            ]"
          >
            <svg
              :class="[
                'flex-shrink-0 transition-colors duration-200',
                isCollapsed ? 'w-6 h-6' : 'w-5 h-5 mr-3',
                $route.path === '/admin/jobsUsers' ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600'
              ]"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 11V13M3 7H21V17H3V7ZM16 7V5A2 2 0 0014 3H10A2 2 0 008 5V7H16Z" />
            </svg>
            <span v-if="!isCollapsed" class="truncate">Jobs</span>

            <div 
              v-if="isCollapsed"
              class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap z-50"
            >
              Jobs
            </div>
          </router-link>

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
            <div class="relative">
              <button 
                @click="showNotifications = !showNotifications"
                class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors duration-200 rounded-lg hover:bg-gray-50"
              >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z" />
                </svg>
                <!-- Notification badge -->
                <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
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
                        <p class="text-sm font-medium text-gray-900">{{ notification.title }}</p>
                        <p class="text-xs text-gray-600 mt-1">{{ notification.message }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ notification.time }}</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="px-4 py-2 border-t border-gray-100">
                  <button class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                    View all notifications
                  </button>
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
                  <button
                    @click="goToProfile"
                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200"
                  >
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile Settings
                  </button>

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
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'

const router = useRouter()
const route = useRoute()

// Reactive state
const isCollapsed = ref(false)
const showUserMenu = ref(false)
const showNotifications = ref(false)
const showMobileOverlay = ref(false)
const searchQuery = ref('')
const userDropdown = ref(null)

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

// Get current page title based on route
const currentPageTitle = computed(() => {
  const routeMap = {
    '/admin/dashboard': 'Dashboard',
    '/admin/users': 'Users',
    '/admin/settings': 'Settings'
  }
  return routeMap[route.path] || 'Admin'
})

// Sample notifications
const notifications = ref([
  {
    id: 1,
    title: 'New user registered',
    message: 'John Doe has created a new account',
    time: '2 minutes ago',
    read: false
  },
  {
    id: 2,
    title: 'System update',
    message: 'System maintenance completed successfully',
    time: '1 hour ago',
    read: false
  },
  {
    id: 3,
    title: 'Backup completed',
    message: 'Daily backup has been completed',
    time: '3 hours ago',
    read: true
  }
])

// Methods
const toggleSidebar = () => {
  isCollapsed.value = !isCollapsed.value
  localStorage.setItem('sidebarCollapsed', isCollapsed.value.toString())
}

const toggleMobileSidebar = () => {
  showMobileOverlay.value = !showMobileOverlay.value
}

const closeMobileSidebar = () => {
  showMobileOverlay.value = false
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

// Load sidebar state from localStorage
const loadSidebarState = () => {
  const savedState = localStorage.getItem('sidebarCollapsed')
  if (savedState !== null) {
    isCollapsed.value = savedState === 'true'
  }
}

onMounted(() => {
  loadSidebarState()
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>
