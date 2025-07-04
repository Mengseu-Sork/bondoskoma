<template>
  <div class="bg-white">
    <!-- Banner Component -->
    <Banner />

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

    <!-- Footer Component -->

  </div>
</template>

<script setup>
import { ref } from 'vue'
import Banner from '@/components/Banner.vue' // Import the Banner component


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
</style>