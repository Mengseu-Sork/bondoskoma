<template>
  <section class="relative pt-0 pb-12">
    <div class="w-full overflow-hidden relative">
      <div class="flex transition-transform duration-700 ease-in-out" :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
        <div v-for="(image, index) in bannerImages" :key="index" class="w-full flex-shrink-0 relative">
          <img :src="image.src" :alt="image.alt" class="w-full h-96 object-cover" />
          <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-blue-800/40 to-transparent"></div>
        </div>
      </div>
      <button @click="prevSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-blue-700 text-white p-3 rounded-full hover:bg-blue-800 z-10 shadow-lg">
        ‹
      </button>
      <button @click="nextSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-blue-700 text-white p-3 rounded-full hover:bg-blue-800 z-10 shadow-lg">
        ›
      </button>
      <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <button v-for="(dot, index) in bannerImages.length" :key="index" @click="currentSlide = index" class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition-all duration-200" :class="{ 'opacity-100 scale-125': currentSlide === index }"></button>
      </div>
    </div>
    <div class="absolute inset-0 flex flex-col justify-center pointer-events-none">
      <div class="w-full flex flex-col items-start justify-center h-full px-4 md:px-16">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-2 drop-shadow-lg text-left">
          <span class="text-sky-500">Welcome to </span><br>
          <span class="text-white">Bondos Komar</span>
        </h1>
        <p class="text-lg md:text-xl text-white mb-8 drop-shadow text-left max-w-2xl">
          Partage has been operating programs in Cambodia since November 1989.
        </p>
        <a href="#" class="pointer-events-auto bg-orange-400 hover:bg-orange-500 text-white px-8 py-3 rounded-full font-bold shadow-lg transition-all duration-200 text-lg md:text-xl">
          Learn More
        </a>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

// Banner images for slideshow
const currentSlide = ref(0)
const bannerImages = ref([
  { src: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/Bandos-Komar-org_1.jpg', alt: 'Children learning' },
  { src: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/Library.jpg', alt: 'Library activities' },
  { src: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/sub-banner.jpg', alt: 'Community event' },
  { src: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/agri-farm1-__.jpg', alt: 'Agricultural project' }
])

const prevSlide = () => {
  currentSlide.value = (currentSlide.value - 1 + bannerImages.value.length) % bannerImages.value.length
}
const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % bannerImages.value.length
}

// Auto-advance slideshow every 4 seconds
let intervalId = null
onMounted(() => {
  intervalId = setInterval(() => {
    nextSlide()
  }, 4000)
})
onUnmounted(() => {
  if (intervalId) clearInterval(intervalId)
})
</script>

<style scoped>
/* Smooth transitions */
.transition-all {
  transition: all 0.3s ease;
}

/* Banner text animation */
@keyframes bounce-slow {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-8px); }
}
.animate-bounce-slow {
  animation: bounce-slow 2.5s infinite;
}
</style>