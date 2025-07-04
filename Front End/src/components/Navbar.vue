<template>
  <nav class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-xl sticky top-0 z-50 backdrop-blur-md border-b border-blue-900/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo Section -->
        <div class="flex items-center space-x-2 flex-shrink-0">
          <img 
            src="https://www.bandoskomar.org/wp-content/uploads/2017/12/cropped-cropped-bandos-komar-logo-1-1_white_bg-2.jpg" 
            alt="Bandos Komar Logo" 
            class="h-8 w-auto rounded shadow"
          />

        </div>

        <!-- Desktop Menu -->
        <div class="hidden lg:flex items-center space-x-6">
          <router-link 
            v-for="item in navItems" 
            :key="item.name"
            :to="item.path"
            class="px-2 py-2 rounded-md text-xs font-bold uppercase tracking-wide hover:bg-blue-900/60 hover:text-yellow-400 hover:underline transition-all duration-200"
            :class="{ 'text-yellow-400 underline bg-blue-900/70': $route.path === item.path }"
            @click="setActive(item.name)"
          >
            {{ item.label }}
          </router-link>

          <!-- Dropdown Menus -->
          <div 
            v-for="dropdown in dropdowns" 
            :key="dropdown.name"
            class="relative"
            @mouseenter="showDropdown(dropdown.name)"
            @mouseleave="hideDropdown(dropdown.name)"
          >
            <button 
              class="px-2 py-2 rounded-md text-xs font-bold uppercase tracking-wide hover:bg-blue-900/60 hover:text-yellow-400 hover:underline transition-all duration-200 flex items-center space-x-1"
              :class="{ 'text-yellow-400 underline bg-blue-900/70': activeDropdowns[dropdown.name] }"
              @click="toggleDropdown(dropdown.name)"
            >
              <span>{{ dropdown.label }}</span>
              <svg 
                class="w-4 h-4 transition-transform duration-200" 
                :class="{ 'rotate-180': activeDropdowns[dropdown.name] }"
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div 
              v-show="activeDropdowns[dropdown.name]"
              class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 transform transition-all duration-200"
              :class="{ 'opacity-100 scale-100': activeDropdowns[dropdown.name], 'opacity-0 scale-95': !activeDropdowns[dropdown.name] }"
            >
              <router-link 
                v-for="subItem in dropdown.items"
                :key="subItem.name"
                :to="subItem.path"
                class="block px-4 py-2 text-xs text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-colors duration-150"
              >
                {{ subItem.label }}
              </router-link>
            </div>
          </div>
        </div>

        <!-- Donate Button (Desktop) & Language Selector -->
        <div class="hidden lg:flex items-center space-x-3">
          <router-link 
            to="/donate"
            class="bg-gradient-to-r from-orange-400 to-yellow-400 hover:from-orange-500 hover:to-yellow-500 text-white px-5 py-2 rounded-full text-xs font-bold flex items-center gap-2 shadow-lg transition-all duration-200 border-2 border-orange-300"
          >
            <span>DONATE</span>
   
          </router-link>
          <!-- Language Selector -->
          <div class="relative group">
            <button class="flex items-center px-2 py-2 rounded-full bg-white bg-opacity-20 hover:bg-opacity-40 transition">
              <img src="https://cdn.jsdelivr.net/gh/hjnilsson/country-flags/svg/gb.svg" alt="English" class="w-5 h-5 rounded-full" />
              <svg class="w-4 h-4 ml-1 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div class="absolute right-0 mt-2 w-32 bg-white rounded shadow-lg py-1 z-50 opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition-all duration-200 border border-blue-100">
              <button class="flex items-center w-full px-3 py-2 text-xs text-gray-700 hover:bg-blue-50">
                <img src="https://cdn.jsdelivr.net/gh/hjnilsson/country-flags/svg/fr.svg" alt="French" class="w-5 h-5 rounded-full mr-2" /> Français
              </button>
              <!-- Add more languages as needed -->
            </div>
          </div>
        </div>

        <!-- Mobile Menu Button -->
        <div class="lg:hidden">
          <button 
            @click="toggleMobileMenu"
            class="p-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-white transition-colors duration-200"
            :aria-expanded="mobileMenuOpen"
            aria-label="Toggle mobile menu"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path 
                v-if="!mobileMenuOpen"
                stroke-linecap="round" 
                stroke-linejoin="round" 
                stroke-width="2" 
                d="M4 6h16M4 12h16M4 18h16"
              />
              <path 
                v-else
                stroke-linecap="round" 
                stroke-linejoin="round" 
                stroke-width="2" 
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div 
      v-show="mobileMenuOpen"
      class="lg:hidden bg-blue-800 border-t border-blue-700 transform transition-all duration-300 ease-in-out"
      :class="{ 'opacity-100 max-h-screen': mobileMenuOpen, 'opacity-0 max-h-0': !mobileMenuOpen }"
    >
      <div class="px-4 py-3 space-y-1">
        <router-link 
          v-for="item in navItems"
          :key="item.name"
          :to="item.path"
          class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition-colors duration-200"
          @click="mobileMenuOpen = false"
        >
          {{ item.label }}
        </router-link>

        <!-- Mobile Dropdowns -->
        <div 
          v-for="dropdown in dropdowns"
          :key="dropdown.name"
          class="border-t border-blue-700 pt-2 mt-2"
        >
          <button 
            @click="toggleMobileDropdown(dropdown.name)"
            class="w-full text-left px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center justify-between"
          >
            <span>{{ dropdown.label }}</span>
            <svg 
              class="w-4 h-4 transition-transform duration-200" 
              :class="{ 'rotate-180': mobileDropdowns[dropdown.name] }"
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div 
            v-show="mobileDropdowns[dropdown.name]"
            class="pl-6 space-y-1"
          >
            <router-link 
              v-for="subItem in dropdown.items"
              :key="subItem.name"
              :to="subItem.path"
              class="block px-3 py-2 text-sm hover:bg-blue-700 rounded-md transition-colors duration-200"
              @click="mobileMenuOpen = false"
            >
              {{ subItem.label }}
            </router-link>
          </div>
        </div>

        <!-- Mobile Donate Button -->
        <div class="pt-4 border-t border-blue-700">
          <router-link 
            to="/donate"
            class="block w-full text-center bg-yellow-500 hover:bg-yellow-400 text-blue-900 px-4 py-3 rounded-lg font-semibold transition-colors duration-200"
            @click="mobileMenuOpen = false"
          >
            Donate
          </router-link>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main routed content -->
  <router-view />
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useRoute } from 'vue-router'

// Reactive state
const route = useRoute()
const mobileMenuOpen = ref(false)
const activeItem = ref('home')
const activeDropdowns = ref({
  info: false,
  involved: false,
  gallery: false
})
const mobileDropdowns = ref({
  info: false,
  involved: false,
  gallery: false
})

// Navigation items
const navItems = [
  { name: 'home', label: 'Home', path: '/' },
  { name: 'history', label: 'History', path: '/history' },
  { name: 'about', label: 'About Us', path: '/about' },
  { name: 'program', label: 'Our Program', path: '/our-program' },
  { name: 'hr', label: 'HR', path: '/hr' }
]

// Dropdown items
const dropdowns = [
  {
    name: 'info',
    label: 'Info & Resources',
    items: [
      { name: 'reports', label: 'Reports', path: '/report' },
      { name: 'partners', label: 'Partners', path: '/partner' },
      { name: 'resources', label: 'Resources', path: '/resource' }
    ]
  },
  {
    name: 'involved',
    label: 'Get Involved',
    items: [
      { name: 'volunteer', label: 'Volunteer', path: '/volunteer' },
      { name: 'events', label: 'Events', path: '/event' }
    ]
  },
  {
    name: 'gallery',
    label: 'Gallery',
    items: [
      { name: 'photos', label: 'Photos', path: '/photo' },
      { name: 'videos', label: 'Videos', path: '/video' },
      { name: 'kids-art', label: "Kids' Art", path: '/kid-art' }
    ]
  }
]

// Methods
const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value
  if (mobileMenuOpen.value) {
    Object.keys(mobileDropdowns.value).forEach(key => {
      mobileDropdowns.value[key] = false
    })
  }
}

const setActive = (item) => {
  activeItem.value = item
}

const showDropdown = (dropdown) => {
  activeDropdowns.value[dropdown] = true
}

const hideDropdown = (dropdown) => {
  setTimeout(() => {
    activeDropdowns.value[dropdown] = false
  }, 150)
}

const toggleDropdown = (dropdown) => {
  activeDropdowns.value[dropdown] = !activeDropdowns.value[dropdown]
}

const toggleMobileDropdown = (dropdown) => {
  mobileDropdowns.value[dropdown] = !mobileDropdowns.value[dropdown]
}

const closeAllDropdowns = () => {
  Object.keys(activeDropdowns.value).forEach(key => {
    activeDropdowns.value[key] = false
  })
  Object.keys(mobileDropdowns.value).forEach(key => {
    mobileDropdowns.value[key] = false
  })
}

// Handle click outside
const handleClickOutside = (event) => {
  if (!event.target.closest('nav')) {
    closeAllDropdowns()
    mobileMenuOpen.value = false
  }
}

// Lifecycle hooks
onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>

<style scoped>
/* Smooth transitions for dropdowns */
.transition-all {
  transition: all 0.2s ease-in-out;
}

/* Ensure mobile menu is hidden by default */
.max-h-0 {
  max-height: 0;
  overflow: hidden;
}

.max-h-screen {
  max-height: 100vh;
}

/* Navbar underline effect for active/hover */
.router-link-exact-active,
.router-link-active {
  font-weight: bold;
  text-decoration: underline;
  color: #fbbf24 !important; /* yellow-400 */
}

/* Language dropdown */
.group:hover .group-hover\:opacity-100 {
  opacity: 1 !important;
  pointer-events: auto !important;
}
.group .group-hover\:opacity-100 {
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.2s;
}

/* Subtle blur for sticky nav */
nav {
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  background-clip: padding-box;
}
</style>