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
        <div class="hidden lg:block">
          <ul class="flex items-center space-x-1">
            <li>
              <a 
                href="#" 
                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 hover:text-white transition-colors duration-200"
                :class="{ 'bg-blue-700': activeItem === 'home' }"
                @click="setActive('home')"
              >
                Home
              </a>
            </li>
            <li>
              <a 
                href="#" 
                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 hover:text-white transition-colors duration-200"
                :class="{ 'bg-blue-700': activeItem === 'history' }"
                @click="setActive('history')"
              >
                History
              </a>
            </li>
            <li>
              <a 
                href="#" 
                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 hover:text-white transition-colors duration-200"
                :class="{ 'bg-blue-700': activeItem === 'about' }"
                @click="setActive('about')"
              >
                About Us
              </a>
            </li>
            <li>
              <a 
                href="#" 
                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 hover:text-white transition-colors duration-200"
                :class="{ 'bg-blue-700': activeItem === 'program' }"
                @click="setActive('program')"
              >
                Our Program
              </a>
            </li>
            <li>
              <a 
                href="#" 
                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 hover:text-white transition-colors duration-200"
                :class="{ 'bg-blue-700': activeItem === 'hr' }"
                @click="setActive('hr')"
              >
                HR
              </a>
            </li>
            
            <!-- Dropdown: Info & Resources -->
            <li class="relative" @mouseenter="showDropdown('info')" @mouseleave="hideDropdown('info')">
              <button 
                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 hover:text-white transition-colors duration-200 flex items-center space-x-1"
                :class="{ 'bg-blue-700': dropdowns.info }"
                @click="toggleDropdown('info')"
              >
                <span>Info & Resources</span>
                <svg 
                  class="w-4 h-4 transition-transform duration-200" 
                  :class="{ 'rotate-180': dropdowns.info }"
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div 
                v-show="dropdowns.info"
                class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 transform transition-all duration-200"
                :class="dropdowns.info ? 'opacity-100 scale-100' : 'opacity-0 scale-95'"
              >
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-colors duration-150">
                   Reports
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-colors duration-150">
                   Partners
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-colors duration-150">
                   Resources
                </a>
              </div>
            </li>

            <!-- Dropdown: Get Involved -->
            <li class="relative" @mouseenter="showDropdown('involved')" @mouseleave="hideDropdown('involved')">
              <button 
                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 hover:text-white transition-colors duration-200 flex items-center space-x-1"
                :class="{ 'bg-blue-700': dropdowns.involved }"
                @click="toggleDropdown('involved')"
              >
                <span>Get Involved</span>
                <svg 
                  class="w-4 h-4 transition-transform duration-200" 
                  :class="{ 'rotate-180': dropdowns.involved }"
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div 
                v-show="dropdowns.involved"
                class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 transform transition-all duration-200"
                :class="dropdowns.involved ? 'opacity-100 scale-100' : 'opacity-0 scale-95'"
              >
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-colors duration-150">
                   Volunteer
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-colors duration-150">
                   Donate
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-colors duration-150">
                   Events
                </a>
              </div>
            </li>

            <!-- Dropdown: Gallery -->
            <li class="relative" @mouseenter="showDropdown('gallery')" @mouseleave="hideDropdown('gallery')">
              <button 
                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 hover:text-white transition-colors duration-200 flex items-center space-x-1"
                :class="{ 'bg-blue-700': dropdowns.gallery }"
                @click="toggleDropdown('gallery')"
              >
                <span>Gallery</span>
                <svg 
                  class="w-4 h-4 transition-transform duration-200" 
                  :class="{ 'rotate-180': dropdowns.gallery }"
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div 
                v-show="dropdowns.gallery"
                class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 transform transition-all duration-200"
                :class="dropdowns.gallery ? 'opacity-100 scale-100' : 'opacity-0 scale-95'"
              >
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-colors duration-150">
                   Photos
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-colors duration-150">
                   Videos
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-colors duration-150">
                   Kids' Art
                </a>
              </div>
            </li>
          </ul>
        </div>

        <!-- Contact Button (Desktop) -->
        <div class="hidden lg:block">
          <a 
            href="#" 
            class="bg-yellow-500 hover:bg-yellow-400 text-blue-900 px-4 py-2 rounded-full text-sm font-semibold transition-colors duration-200 shadow-md hover:shadow-lg"
          >
            Donate
          </a>
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
      :class="mobileMenuOpen ? 'opacity-100 max-h-screen' : 'opacity-0 max-h-0'"
    >
      <div class="px-4 py-3 space-y-1">
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition-colors duration-200">
           Home
        </a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition-colors duration-200">
           History
        </a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition-colors duration-200">
           About Us
        </a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition-colors duration-200">
           Our Program
        </a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition-colors duration-200">
           HR
        </a>
        
        <!-- Mobile Dropdowns -->
        <div class="border-t border-blue-700 pt-2 mt-2">
          <button 
            @click="toggleMobileDropdown('info')"
            class="w-full text-left px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center justify-between"
          >
            <span> Info & Resources</span>
            <svg 
              class="w-4 h-4 transition-transform duration-200" 
              :class="{ 'rotate-180': mobileDropdowns.info }"
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div v-show="mobileDropdowns.info" class="pl-6 space-y-1">
            <a href="#" class="block px-3 py-2 text-sm hover:bg-blue-700 rounded-md transition-colors duration-200">Reports</a>
            <a href="#" class="block px-3 py-2 text-sm hover:bg-blue-700 rounded-md transition-colors duration-200">Partners</a>
            <a href="#" class="block px-3 py-2 text-sm hover:bg-blue-700 rounded-md transition-colors duration-200">Resources</a>
          </div>
        </div>

        <div>
          <button 
            @click="toggleMobileDropdown('involved')"
            class="w-full text-left px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center justify-between"
          >
            <span> Get Involved</span>
            <svg 
              class="w-4 h-4 transition-transform duration-200" 
              :class="{ 'rotate-180': mobileDropdowns.involved }"
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div v-show="mobileDropdowns.involved" class="pl-6 space-y-1">
            <a href="#" class="block px-3 py-2 text-sm hover:bg-blue-700 rounded-md transition-colors duration-200">Volunteer</a>
            <a href="#" class="block px-3 py-2 text-sm hover:bg-blue-700 rounded-md transition-colors duration-200">Donate</a>
            <a href="#" class="block px-3 py-2 text-sm hover:bg-blue-700 rounded-md transition-colors duration-200">Events</a>
          </div>
        </div>

        <div>
          <button 
            @click="toggleMobileDropdown('gallery')"
            class="w-full text-left px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center justify-between"
          >
            <span> Gallery</span>
            <svg 
              class="w-4 h-4 transition-transform duration-200" 
              :class="{ 'rotate-180': mobileDropdowns.gallery }"
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div v-show="mobileDropdowns.gallery" class="pl-6 space-y-1">
            <a href="#" class="block px-3 py-2 text-sm hover:bg-blue-700 rounded-md transition-colors duration-200">Photos</a>
            <a href="#" class="block px-3 py-2 text-sm hover:bg-blue-700 rounded-md transition-colors duration-200">Videos</a>
            <a href="#" class="block px-3 py-2 text-sm hover:bg-blue-700 rounded-md transition-colors duration-200">Kids' Art</a>
          </div>
        </div>

        <!-- Mobile Contact Button -->
        <div class="pt-4 border-t border-blue-700">
          <a 
            href="#" 
            class="block w-full text-center bg-yellow-500 hover:bg-yellow-400 text-blue-900 px-4 py-3 rounded-lg font-semibold transition-colors duration-200"
          >
           Donate
          </a>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

// Reactive state
const mobileMenuOpen = ref(false)
const activeItem = ref('home')
const dropdowns = ref({
  info: false,
  involved: false,
  gallery: false
})
const mobileDropdowns = ref({
  info: false,
  involved: false,
  gallery: false
})

// Methods
const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value
}

const setActive = (item) => {
  activeItem.value = item
}

const showDropdown = (dropdown) => {
  dropdowns.value[dropdown] = true
}

const hideDropdown = (dropdown) => {
  setTimeout(() => {
    dropdowns.value[dropdown] = false
  }, 150)
}

const toggleDropdown = (dropdown) => {
  dropdowns.value[dropdown] = !dropdowns.value[dropdown]
}

const toggleMobileDropdown = (dropdown) => {
  mobileDropdowns.value[dropdown] = !mobileDropdowns.value[dropdown]
}

const closeAllDropdowns = () => {
  Object.keys(dropdowns.value).forEach(key => {
    dropdowns.value[key] = false
  })
}

const handleClickOutside = (event) => {
  if (!event.target.closest('nav')) {
    closeAllDropdowns()
    mobileMenuOpen.value = false
  }
}

// Lifecycle
onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>