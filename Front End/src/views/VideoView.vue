<template>
  <div :class="{ 'khmer-font': currentLang.code === 'kh' }" class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <!-- Page Header -->
      <h1 class="text-3xl font-bold text-blue-900 mb-8">{{ t.videos }}</h1>

      <!-- Video Grid -->
      <div v-if="videos.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="video in videos"
          :key="video.id"
          class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-105"
        >
          <!-- Video Thumbnail with Play Button -->
          <div class="relative">
            <img
              :src="video.thumbnail"
              :alt="video.title"
              class="w-full h-48 object-cover"
            />
            <button
              @click="openVideoModal(video)"
              class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 hover:bg-opacity-50 transition-opacity duration-200"
              :aria-label="t.playVideo + video.title"
            >
              <svg
                class="w-12 h-12 text-white"
                fill="currentColor"
                viewBox="0 0 24 24"
              >
                <path d="M8 5v14l11-7z" />
              </svg>
            </button>
          </div>
          <!-- Video Info -->
          <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-800">{{ video.title }}</h3>
            <p class="text-sm text-gray-600 mt-1">{{ video.description }}</p>
          </div>
        </div>
      </div>

      <!-- No Videos Message -->
      <div v-else class="text-center text-gray-600">
        {{ t.noVideos }}
      </div>

      <!-- Video Modal -->
      <div
        v-if="selectedVideo"
        class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50"
        @click.self="closeVideoModal"
      >
        <div class="bg-white rounded-lg w-full max-w-3xl p-4 relative">
          <!-- Close Button -->
          <button
            @click="closeVideoModal"
            class="absolute top-2 right-2 text-gray-600 hover:text-gray-900"
            aria-label="Close video modal"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          <!-- Video Player -->
          <div class="relative" style="padding-top: 56.25%;">
            <iframe
              :src="selectedVideo.url"
              class="absolute inset-0 w-full h-full"
              frameborder="0"
              allowfullscreen
            ></iframe>
          </div>
          <h3 class="mt-4 text-lg font-semibold text-gray-800">{{ selectedVideo.title }}</h3>
          <p class="text-sm text-gray-600">{{ selectedVideo.description }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRoute } from 'vue-router'

// Translation data (aligned with your navbar)
const translations = {
  en: {
    videos: 'Videos',
    playVideo: 'Play video: ',
    noVideos: 'No videos available at the moment.',
  },
  kh: {
    videos: 'វីដេអូ',
    playVideo: 'ចាក់វីដេអូ: ',
    noVideos: 'មិនមានវីដេអូនៅពេលនេះទេ។',
  },
}

// Language setup (aligned with your navbar)
const languages = [
  {
    code: 'en',
    label: 'English',
    flag: 'https://cdn.jsdelivr.net/gh/hjnilsson/country-flags/svg/gb.svg',
  },
  {
    code: 'kh',
    label: 'ខ្មែរ',
    flag: 'https://cdn.jsdelivr.net/gh/hjnilsson/country-flags/svg/kh.svg',
  },
]
const currentLang = ref(languages[0])
const t = computed(() => translations[currentLang.value.code])

// Sample video data (replace with your actual data source, e.g., API)
const videos = ref([
  {
    id: 1,
    title: 'Bandos Komar Program Overview',
    description: 'An introduction to our educational programs.',
    thumbnail: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9AY6f3pQLKbl4vmBdY9-Zs8LpamW8qntCVQ&s',
    url: 'https://www.youtube.com/embed/dQw4w9WgXcQ',
  },
  {
    id: 2,
    title: 'Partycipation in Community Events',
    description: ' From our latest community event.',
    thumbnail: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/Screen-Shot-2017-10-06-at-11.19.13-AM.png',
    url: 'https://www.youtube.com/embed/3JZ_D3ELwOQ',
  },
  // Add more videos as needed
])

// Video modal state
const selectedVideo = ref(null)

const openVideoModal = (video) => {
  selectedVideo.value = video
}

const closeVideoModal = () => {
  selectedVideo.value = null
}

// Set language based on route or user preference (optional)
const route = useRoute()
const setLang = (lang) => {
  currentLang.value = lang
}
</script>

<style scoped>
/* Smooth transitions for hover effects */
.transition-all {
  transition: all 0.3s ease-in-out;
}

/* Khmer font support */
.khmer-font * {
  font-family: 'Noto Sans Khmer', 'Battambang', Arial, Helvetica, sans-serif !important;
}

/* Video card hover effect */
.transform:hover {
  transform: scale(1.05);
}

/* Modal backdrop */
.bg-opacity-75 {
  transition: background-color 0.3s ease-in-out;
}
</style>