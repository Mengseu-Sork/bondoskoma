<template>
  <div class="bg-white">
    <!-- Full-Width Banner with Slideshow -->
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
      <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-2 drop-shadow-lg text-center">Welcome to Simply for Speech</h1>
        <p class="text-lg md:text-2xl text-white mb-6 drop-shadow text-center max-w-2xl">Empowering children in Myanmar since 1989 with education and therapy.<br>Join us at 01:44 PM +07 on Thursday, July 03, 2025, for our live event.</p>
        <a href="#" class="pointer-events-auto bg-gradient-to-r from-blue-700 to-indigo-600 text-white px-8 py-3 rounded-full hover:from-blue-800 hover:to-indigo-700 transition-all font-bold shadow-lg animate-bounce-slow">Get Involved</a>
      </div>
    </section>

    <!-- Welcome Section (was Our Purpose) -->
    <section class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          <div>
            <h2 class="text-4xl font-extrabold text-blue-900 mb-8">Welcome to Bandos Komar Association</h2>
            <div class="space-y-5 text-gray-700 leading-relaxed text-lg">
              <p>
                Partage has been operating programs in Cambodia since November 1989. Then it started by basic supports and it has developed progressively project focusing on education particularly in pre-schools and primary schools in rural areas and some villages surrounding target schools. There were six primary and six pre-schools in three provinces (Takeo, Kompong Speu, and Kandal) under Partage’s projects during the period of 1989 to 1999.
              </p>
              <p>
                By July 1999, Partage Cambodia had been localized as “Bandos Komar Association”, which became a local NGO in order to take over all Partage’s projects. Since 2002, BK has expanded its programs to new target provinces such as Pursat in 2002 and Siem Reap in 2008.
              </p>
            </div>
          </div>
          <div class="relative">
            <img 
              src="https://www.bandoskomar.org/wp-content/uploads/2017/10/sub-banner.jpg" 
              alt="Happy children in classroom" 
              class="rounded-3xl shadow-2xl w-full h-96 object-cover border-4 border-blue-100"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Life Skills Section (balanced text and images) -->
    <section class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
          <!-- Text Content -->
          <div>
            <h2 class="text-4xl font-extrabold text-blue-900 mb-6">Life Skills</h2>
            <p class="text-xl mb-4">
              Our Life Skills program empowers children with practical abilities, confidence, and a sense of responsibility—helping them thrive in their families, communities, and future careers.
            </p>
            <ul class="list-disc pl-6 space-y-3 text-gray-700 text-lg mb-4">
              <li>
                <span class="font-semibold text-blue-700">Practical Agriculture:</span>
                Children participate in our "School Gardening" project, learning to plant, nurture, and harvest crops. This hands-on experience builds teamwork, self-reliance, and a love for sustainable farming.
              </li>
              <li>
                <span class="font-semibold text-blue-700">Career Preparation:</span>
                Our training helps students develop essential skills for future employment, reducing the need for migration and opening doors to new opportunities.
              </li>
              <li>
                <span class="font-semibold text-blue-700">Community Engagement:</span>
                Students and teachers work together on meaningful projects, share harvests, and use proceeds to support school needs—fostering a spirit of giving and collaboration.
              </li>
              <li>
                <span class="font-semibold text-blue-700">Personal Growth:</span>
                Through real-world challenges, children gain confidence, responsibility, and a positive attitude toward work and community life.
              </li>
            </ul>
            <p class="text-gray-700">
              After learning the best ways to grow vegetables, our students and teachers cultivate crops like cabbage, water chestnuts, and beans. The harvest is shared among families and sold to fund school supplies and seeds for the next season—creating a cycle of growth and support.
            </p>
          </div>
          <!-- Images Side -->
          <div class="flex flex-col gap-6">
            <img 
              src="https://www.bandoskomar.org/wp-content/uploads/2020/01/SR-LS-scaled.jpg"
              alt="Life Skill Example 1"
              class="rounded-3xl shadow-xl w-full h-60 object-cover border-4 border-blue-100"
            />
            <img 
              src="https://www.bandoskomar.org/wp-content/uploads/2017/10/agri-farm1-__.jpg"
              alt="Life Skill Example 2"
              class="rounded-3xl shadow-xl w-full h-60 object-cover border-4 border-blue-100"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Take Action Section -->
    <section class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
          <h2 class="text-4xl font-extrabold text-blue-900 mb-4">Take Action</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            There are several ways you can get involved with Simply for Speech. Below are a few of the most popular options.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
          <div v-for="action in takeActions" :key="action.title" 
               class="bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl transition-all transform hover:-translate-y-2 border border-blue-100 group">
            <div class="text-center">
              <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-200 transition-all">
                <component :is="action.icon" class="w-8 h-8 text-blue-600" />
              </div>
              <h3 class="text-xl font-bold text-blue-900 mb-4">{{ action.title }}</h3>
              <p class="text-gray-600 mb-6 leading-relaxed">{{ action.description }}</p>
              <button class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-full hover:from-blue-700 hover:to-indigo-700 transition-all font-semibold w-full shadow group-hover:scale-105">
                {{ action.buttonText }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Instagram Section -->
    <section class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-4xl font-extrabold text-blue-900 mb-4">Connect with us on Instagram</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
          <div v-for="(post, index) in instagramPosts" :key="index" 
               class="relative group overflow-hidden rounded-xl aspect-square hover:transform hover:scale-105 transition-all shadow-lg">
            <img 
              :src="post.image" 
              :alt="`Instagram post ${index + 1}`"
              class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
              <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Divider -->
  

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <!-- Our Projects -->
          <div>
            <h3 class="text-lg font-semibold mb-4 text-blue-400">OUR PROJECTS</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Our Story</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Our Team</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Annual Report</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Careers</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Awards We've Won</a></li>
            </ul>
          </div>

          <!-- Ways to Help -->
          <div>
            <h3 class="text-lg font-semibold mb-4 text-blue-400">WAYS TO HELP</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Donate</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Volunteer</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Fundraise</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Corporate Partnerships</a></li>
            </ul>
          </div>

          <!-- Actions -->
          <div>
            <h3 class="text-lg font-semibold mb-4 text-blue-400">ACTIONS</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Contact</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Privacy Policy</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Terms</a></li>
            </ul>
          </div>

          <!-- Newsletter Signup -->
          <div>
            <h3 class="text-lg font-semibold mb-4 text-blue-400">Subscribe for Speech News and Other Updates</h3>
            <div class="space-y-4">
              <input 
                type="email" 
                placeholder="Enter your email"
                class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
              />
              <button class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                Subscribe
              </button>
            </div>
            
            <!-- Social Media Icons -->
            <div class="flex space-x-4 mt-6">
              <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

// Take Action data
const takeActions = ref([
  {
    title: 'Donate',
    description: 'Your contribution helps us provide therapy and education. Donations can be made online or through various methods.',
    buttonText: 'Donate Us',
    icon: 'HeartIcon'
  },
  {
    title: 'Volunteer',
    description: 'Join us to support children with communication challenges. We need volunteers for therapy sessions and events.',
    buttonText: 'Become Volunteer',
    icon: 'HandRaisedIcon'
  },
  {
    title: 'Join Us',
    description: 'We seek speech therapists and students to expand our reach in Myanmar. Help us make a difference.',
    buttonText: 'Join Us',
    icon: 'UsersIcon'
  }
])

// Instagram posts (placeholder images)
const instagramPosts = ref([
  { image: 'https://www.partage-rise.org/wp-content/uploads/2020/07/Children-council-Educate-using-toilet.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/Library.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/sub-banner.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/agri-farm1-__.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/Library.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/agri-farm1-__.jpg' }
])

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

// Icon components
const HeartIcon = { 
  template: `
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
    </svg>
  ` 
}

const HandRaisedIcon = { 
  template: `
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path>
    </svg>
  ` 
}

const UsersIcon = { 
  template: `
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
    </svg>
  ` 
}
</script>

<style scoped>
/* Custom hover effects */
.group:hover .group-hover\:scale-105 {
  transform: scale(1.05);
}

.group:hover .group-hover\:opacity-100 {
  opacity: 1;
}

/* Smooth transitions */
.transition-all {
  transition: all 0.3s ease;
}

/* Banner text animation */
@keyframes bounce-slow {
  0%, 100% { transform: translateY(0);}
  50% { transform: translateY(-8px);}
}
.animate-bounce-slow {
  animation: bounce-slow 2.5s infinite;
}
</style>