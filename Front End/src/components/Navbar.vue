<template>
  <div :class="{ 'khmer-font': currentLang.code === 'kh' }">
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
              @click="setActive(item.name); closeAllDropdowns()"
            >
              {{ t[item.name] }}
            </router-link>

            <!-- Dropdown Menus -->
            <div 
              v-for="dropdown in dropdowns" 
              :key="dropdown.name"
              class="relative"
            >
              <button 
                class="px-2 py-2 rounded-md text-xs font-bold uppercase tracking-wide hover:bg-blue-900/60 hover:text-yellow-400 hover:underline transition-all duration-200 flex items-center space-x-1"
                :class="{ 'text-yellow-400 underline bg-blue-900/70': activeDropdowns[dropdown.name] }"
                @click="toggleDropdown(dropdown.name)"
                :aria-expanded="activeDropdowns[dropdown.name]"
                aria-haspopup="true"
                type="button"
              >
                <span>{{ t[dropdown.name] }}</span>
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
              <!-- Dropdown Backdrop for click-outside -->
              <div 
                v-if="activeDropdowns[dropdown.name]"
                class="fixed inset-0 z-40"
                @click="closeAllDropdowns"
                style="background: transparent;"
              ></div>
              <div 
                v-show="activeDropdowns[dropdown.name]"
                class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 transform transition-all duration-200"
                :class="{ 'opacity-100 scale-100': activeDropdowns[dropdown.name], 'opacity-0 scale-95': !activeDropdowns[dropdown.name] }"
                @click.stop
              >
                <router-link 
                  v-for="subItem in dropdown.items"
                  :key="subItem.name"
                  :to="subItem.path"
                  class="block px-4 py-2 text-xs text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-colors duration-150"
                  @click="closeAllDropdowns"
                >
                  {{ t[subItem.name] }}
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
              <span>{{ t.donate }}</span>
            </router-link>
            <!-- Language Selector -->
            <div class="relative">
              <button @click="toggleLangDropdown" class="flex items-center px-2 py-2 rounded-full bg-white bg-opacity-20 hover:bg-opacity-40 transition">
                <img :src="currentLang.flag" :alt="currentLang.label" class="w-5 h-5 rounded-full" />
                <span class="ml-2 text-xs font-semibold">{{ currentLang.label }}</span>
                <svg class="w-4 h-4 ml-1 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div
                v-show="showLangDropdown"
                class="absolute right-0 mt-2 w-32 bg-white rounded shadow-lg py-1 z-50 border border-blue-100"
              >
                <button
                  v-for="lang in languages"
                  :key="lang.code"
                  @click="setLang(lang)"
                  class="flex items-center w-full px-3 py-2 text-xs text-gray-700 hover:bg-blue-50"
                  :class="{ 'bg-yellow-100': currentLang.code === lang.code }"
                >
                  <img :src="lang.flag" :alt="lang.label" class="w-5 h-5 rounded-full mr-2" />
                  {{ lang.label }}
                </button>
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
            {{ t[item.name] }}
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
              <span>{{ t[dropdown.name] }}</span>
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
                {{ t[subItem.name] }}
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
              {{ t.donate }}
            </router-link>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useRoute } from 'vue-router'

const translations = {
  en: {
    home: 'Home',
    history: 'History',
    about: 'About Us',
    program: 'Our Program',
    hr: 'HR',
    info: 'Info & Resources',
    involved: 'Get Involved',
    gallery: 'Gallery',
    jobs: 'Jobs Announcement',
    reports: 'Reports',
    partners: 'Partners',
    resources: 'Resources',
    volunteer: 'Volunteer',
    events: 'Events',
    photos: 'Photos',
    videos: 'Videos',
    'kids-art': "Kids' Art",
    donate: 'Donate'
  },
  kh: {
    home: 'ទំព័រដើម',
    history: 'ប្រវត្តិ',
    about: 'អំពីពួកយើង',
    program: 'កម្មវិធីរបស់យើង',
    hr: 'ធនធានមនុស្ស',
    info: 'ព័ត៌មាន និងធនធាន',
    involved: 'ចូលរួម',
    jobs: 'ការប្រកាសការងារ',
    gallery: 'វិចិត្រសាល',
    reports: 'របាយការណ៍',
    partners: 'ដៃគូ',
    resources: 'ធនធាន',
    volunteer: 'ស្ម័គ្រចិត្ត',
    events: 'ព្រឹត្តិការណ៍',
    photos: 'រូបថត',
    videos: 'វីដេអូ',
    'kids-art': 'សិល្បៈកុមារ',
    donate: 'បរិច្ចាគ'
  }
}

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

const navItems = [
  { name: 'home', path: '/' },
  { name: 'history', path: '/history' },
  { name: 'about', path: '/about' },
  { name: 'program', path: '/our-program' },
  { name: 'hr', path: '/hr' }
]

const dropdowns = [
  {
    name: 'info',
    items: [
      { name: 'jobs', path: '/jobs' },
      { name: 'reports', path: '/report' },
      { name: 'partners', path: '/partner' },
      { name: 'resources', path: '/resource' }
    ]
  },
  {
    name: 'involved',
    items: [
      { name: 'volunteer', path: '/volunteer' },
      { name: 'events', path: '/event' }
    ]
  },
  {
    name: 'gallery',
    items: [
      { name: 'photos', path: '/photo' },
      { name: 'videos', path: '/video' },
      { name: 'kids-art', path: '/kid-art' }
    ]
  }
]

const showLangDropdown = ref(false)
const languages = [
  {
    code: 'en',
    label: 'English',
    flag: 'https://cdn.jsdelivr.net/gh/hjnilsson/country-flags/svg/gb.svg'
  },
  {
    code: 'kh',
    label: 'ខ្មែរ',
    flag: 'https://cdn.jsdelivr.net/gh/hjnilsson/country-flags/svg/kh.svg'
  }
]
const currentLang = ref(languages[0])
const t = computed(() => translations[currentLang.value.code])

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

const toggleDropdown = (dropdown) => {
  Object.keys(activeDropdowns.value).forEach(key => {
    if (key !== dropdown) activeDropdowns.value[key] = false
  })
  activeDropdowns.value[dropdown] = !activeDropdowns.value[dropdown]
}

const toggleMobileDropdown = (dropdown) => {
  mobileDropdowns.value[dropdown] = !mobileDropdowns.value[dropdown]
}

const toggleLangDropdown = () => {
  showLangDropdown.value = !showLangDropdown.value
}

const setLang = (lang) => {
  currentLang.value = lang
  showLangDropdown.value = false
}

const closeAllDropdowns = () => {
  Object.keys(activeDropdowns.value).forEach(key => {
    activeDropdowns.value[key] = false
  })
  Object.keys(mobileDropdowns.value).forEach(key => {
    mobileDropdowns.value[key] = false
  })
  showLangDropdown.value = false
}

const handleClickOutside = (event) => {
  if (!event.target.closest('nav')) {
    closeAllDropdowns()
    mobileMenuOpen.value = false
  }
}

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
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;700&display=swap');
.khmer-font * {
  font-family: 'Noto Sans Khmer', 'Battambang', Arial, Helvetica, sans-serif !important;
}
</style>