<template>
  <nav class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo Section -->
        <div class="flex items-center space-x-3 flex-shrink-0">
          <img 
            src="https://www.bandoskomar.org/wp-content/uploads/2017/12/cropped-cropped-bandos-komar-logo-1-1_white_bg-2.jpg" 
            alt="Bandos Komar Logo" 
            class="h-10 w-auto rounded-md shadow-sm"
          />
          <div class="hidden sm:block">
            <h1 class="font-bold text-lg tracking-wide">Bandos Komar</h1>
            <p class="text-xs text-blue-200">Helping Kids Grow</p>
          </div>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden lg:flex items-center space-x-1">
          <router-link 
            v-for="item in navItems" 
            :key="item.name"
            :to="item.path"
            class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 hover:text-white transition-colors duration-200"
            :class="{ 'bg-blue-700': $route.path === item.path }"
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
              class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 hover:text-white transition-colors duration-200 flex items-center space-x-1"
              :class="{ 'bg-blue-700': activeDropdowns[dropdown.name] }"
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
              class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 transform transition-all duration-200"
              :class="{ 'opacity-100 scale-100': activeDropdowns[dropdown.name], 'opacity-0 scale-95': !activeDropdowns[dropdown.name] }"
            >
              <router-link 
                v-for="subItem in dropdown.items"
                :key="subItem.name"
                :to="subItem.path"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-colors duration-150"
              >
                {{ subItem.label }}
              </router-link>
            </div>
          </div>
        </div>

        <!-- Donate Button (Desktop) -->
        <div class="hidden lg:block">
          <router-link 
            to="/donate"
            class="bg-yellow-500 hover:bg-yellow-400 text-blue-900 px-4 py-2 rounded-full text-sm font-semibold transition-colors duration-200 shadow-md hover:shadow-lg"
          >
            Donate
          </router-link>
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

</style>