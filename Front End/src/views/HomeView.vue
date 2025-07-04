<template>
  <div class="min-h-screen bg-white">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 text-white overflow-hidden">
      <div class="absolute inset-0 bg-black opacity-20"></div>
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div class="text-center lg:text-left">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
              Bandos <span class="text-yellow-400">Komar</span><br>
              Of Cambodia
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 leading-relaxed">
              Help us provide quality education to children in need. Every donation makes a difference in a child's future and transforms entire communities.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
              <button class="bg-yellow-500 text-gray-900 px-8 py-4 rounded-lg hover:bg-yellow-400 transition-all transform hover:scale-105 font-semibold text-lg shadow-lg">
                Donate Now
              </button>
              <button class="border-2 border-white text-white px-8 py-4 rounded-lg hover:bg-white hover:text-blue-600 transition-all font-semibold text-lg">
                Learn More
              </button>
            </div>
            <div class="mt-8 flex flex-wrap justify-center lg:justify-start gap-8 text-sm">
              <div class="text-center">
                <div class="text-2xl font-bold">50,000+</div>
                <div class="text-blue-200">Lives Changed</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold">150+</div>
                <div class="text-blue-200">Schools Built</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold">25</div>
                <div class="text-blue-200">Countries</div>
              </div>
            </div>
          </div>
          <div class="relative">
            <div class="relative z-10">
              <!-- <img src="/placeholder.svg?height=600&width=500" alt="Happy children learning" class="rounded-2xl shadow-2xl w-full"> -->
            </div>
            <div class="absolute -top-4 -right-4 w-full h-full bg-yellow-400 rounded-2xl opacity-20"></div>
          </div>
        </div>
      </div>
      
      <!-- Floating Elements -->
      <div class="absolute top-20 left-10 w-20 h-20 bg-yellow-400 rounded-full opacity-10 animate-bounce"></div>
      <div class="absolute bottom-20 right-20 w-16 h-16 bg-white rounded-full opacity-10 animate-pulse"></div>
    </section>

    <!-- Impact Statistics -->
    <section class="py-16 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Global Impact</h2>
          <p class="text-xl text-gray-600">Making a difference in communities worldwide</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div v-for="stat in impactStats" :key="stat.label" class="text-center group">
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
              <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                <component :is="stat.icon" class="w-8 h-8 text-white" />
              </div>
              <div class="text-3xl font-bold text-gray-900 mb-2">{{ stat.value }}</div>
              <div class="text-gray-600 font-medium">{{ stat.label }}</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Us Preview -->
    <section class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          <div>
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Transforming Lives Through Education</h2>
            <p class="text-lg text-gray-700 mb-6 leading-relaxed">
              For over 20 years, EduCharity has been dedicated to breaking the cycle of poverty through quality education. 
              We believe every child deserves the opportunity to learn, grow, and achieve their dreams regardless of their circumstances.
            </p>
            <p class="text-lg text-gray-700 mb-8 leading-relaxed">
              Our comprehensive approach includes building schools, training teachers, providing scholarships, and creating 
              sustainable educational programs that empower entire communities.
            </p>
            <div class="space-y-4 mb-8">
              <div v-for="value in coreValues" :key="value.title" class="flex items-start">
                <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                  <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 mb-1">{{ value.title }}</h3>
                  <p class="text-gray-600">{{ value.description }}</p>
                </div>
              </div>
            </div>
            <button class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
              Learn Our Story
            </button>
          </div>
          <div class="relative">
            <!-- <img src="/placeholder.svg?height=500&width=600" alt="Children in classroom" class="rounded-2xl shadow-2xl"> -->
            <div class="absolute -bottom-6 -left-6 bg-yellow-400 p-6 rounded-xl shadow-lg">
              <div class="text-2xl font-bold text-gray-900">20+</div>
              <div class="text-gray-700">Years of Impact</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured Programs -->
    <section class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Programs</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Comprehensive educational initiatives designed to create lasting change in communities worldwide
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="program in featuredPrograms" :key="program.id" 
               class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all transform hover:-translate-y-2 group">
            <div class="relative overflow-hidden">
              <img :src="program.image" :alt="program.title" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
              <div class="absolute top-4 left-4">
                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                  {{ program.category }}
                </span>
              </div>
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold text-gray-900 mb-3">{{ program.title }}</h3>
              <p class="text-gray-600 mb-4">{{ program.description }}</p>
              <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500">
                  <span class="font-medium">{{ program.beneficiaries }}</span> beneficiaries
                </div>
                <button class="text-blue-600 hover:text-blue-700 font-medium group-hover:translate-x-1 transition-transform">
                  Learn More →
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-12">
          <button class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
            View All Programs
          </button>
        </div>
      </div>
    </section>

    <!-- Success Stories -->
    <section class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">Success Stories</h2>
          <p class="text-xl text-gray-600">Real stories of transformation and hope</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="story in successStories" :key="story.name" 
               class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all">
            <div class="flex items-center mb-4">
              <img :src="story.image" :alt="story.name" class="w-16 h-16 rounded-full object-cover mr-4">
              <div>
                <h3 class="font-semibold text-gray-900">{{ story.name }}</h3>
                <p class="text-sm text-blue-600">{{ story.program }}</p>
              </div>
            </div>
            <blockquote class="text-gray-700 italic mb-4 leading-relaxed">
              "{{ story.quote }}"
            </blockquote>
            <div class="text-sm text-gray-600 font-medium">{{ story.achievement }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- How You Can Help -->
    <section class="py-20 bg-blue-600 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">How You Can Help</h2>
          <p class="text-xl text-blue-100 max-w-3xl mx-auto">
            Join our mission to make quality education accessible to every child. There are many ways to get involved.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div v-for="way in waysToHelp" :key="way.title" 
               class="text-center group hover:transform hover:scale-105 transition-all">
            <div class="bg-white bg-opacity-10 p-8 rounded-2xl backdrop-blur-sm hover:bg-opacity-20 transition-all">
              <div class="w-20 h-20 bg-yellow-400 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                <component :is="way.icon" class="w-10 h-10 text-gray-900" />
              </div>
              <h3 class="text-2xl font-bold mb-4">{{ way.title }}</h3>
              <p class="text-blue-100 mb-6 leading-relaxed">{{ way.description }}</p>
              <button class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg hover:bg-yellow-300 transition-colors font-semibold">
                {{ way.action }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Latest News -->
    <section class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">Latest News & Updates</h2>
          <p class="text-xl text-gray-600">Stay informed about our recent activities and achievements</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <article v-for="article in latestNews" :key="article.title" 
                   class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all group">
            <div class="relative overflow-hidden">
              <img :src="article.image" :alt="article.title" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
              <div class="absolute top-4 right-4 bg-white bg-opacity-90 px-3 py-1 rounded-full text-sm font-medium text-gray-700">
                {{ article.date }}
              </div>
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                {{ article.title }}
              </h3>
              <p class="text-gray-600 mb-4">{{ article.excerpt }}</p>
              <button class="text-blue-600 hover:text-blue-700 font-medium group-hover:translate-x-1 transition-transform">
                Read More →
              </button>
            </div>
          </article>
        </div>

        <div class="text-center mt-12">
          <button class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
            View All News
          </button>
        </div>
      </div>
    </section>

    <!-- Newsletter Signup -->
    <section class="py-16 bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Stay Connected</h2>
        <p class="text-xl text-blue-100 mb-8">
          Subscribe to our newsletter for updates on our programs and impact stories
        </p>
        <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
          <input 
            type="email" 
            placeholder="Enter your email address"
            class="flex-1 px-4 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-400"
          >
          <button class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg hover:bg-yellow-300 transition-colors font-semibold">
            Subscribe
          </button>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <div class="text-2xl font-bold text-blue-600 mb-4">EduCharity</div>
            <p class="text-gray-300 mb-6 leading-relaxed">
              Empowering children through education and creating brighter futures for communities worldwide.
            </p>
            <div class="flex space-x-4">
              <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
              </a>
            </div>
          </div>

          <div>
            <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-blue-600 transition-colors">About Us</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-600 transition-colors">Our Programs</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-600 transition-colors">Get Involved</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-600 transition-colors">Success Stories</a></li>
            </ul>
          </div>

          <div>
            <h3 class="text-lg font-semibold mb-4">Support</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-blue-600 transition-colors">Donate</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-600 transition-colors">Volunteer</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-600 transition-colors">Sponsor a Child</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-600 transition-colors">Corporate Partners</a></li>
            </ul>
          </div>

          <div>
            <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
            <div class="space-y-2 text-gray-300">
              <p>123 Education Street</p>
              <p>Hope City, HC 12345</p>
              <p>Phone: (555) 123-4567</p>
              <p>Email: info@educharity.org</p>
            </div>
          </div>
        </div>

        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
          <p>&copy; 2024 EduCharity. All rights reserved. | Privacy Policy | Terms of Service</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref } from 'vue'

// Impact statistics
const impactStats = ref([
  { value: '50,000+', label: 'Lives Changed', icon: 'UsersIcon' },
  { value: '150+', label: 'Schools Built', icon: 'BuildingIcon' },
  { value: '2,500+', label: 'Teachers Trained', icon: 'AcademicCapIcon' },
  { value: '25', label: 'Countries', icon: 'GlobeIcon' }
])

// Core values
const coreValues = ref([
  {
    title: 'Quality Education',
    description: 'Providing world-class educational resources and modern teaching methods.'
  },
  {
    title: 'Community Empowerment',
    description: 'Building sustainable programs that strengthen entire communities.'
  },
  {
    title: 'Global Impact',
    description: 'Creating positive change that transcends borders and cultures.'
  }
])

// Featured programs
const featuredPrograms = ref([
  {
    id: 1,
    title: 'Early Childhood Development',
    category: 'Ages 3-6',
    description: 'Comprehensive early learning programs focusing on cognitive, social, and emotional development.',
    image: '/placeholder.svg?height=200&width=400',
    beneficiaries: '2,500+'
  },
  {
    id: 2,
    title: 'Primary Education Excellence',
    category: 'Ages 6-12',
    description: 'Quality primary education with STEM focus, digital literacy, and multilingual support.',
    image: '/placeholder.svg?height=200&width=400',
    beneficiaries: '15,000+'
  },
  {
    id: 3,
    title: 'Vocational Training',
    category: 'Youth & Adults',
    description: 'Practical skills training in high-demand trades and modern technology sectors.',
    image: '/placeholder.svg?height=200&width=400',
    beneficiaries: '3,500+'
  }
])

// Success stories
const successStories = ref([
  {
    name: 'Somchai Patel',
    program: 'Vocational Training Graduate',
    image: '/placeholder.svg?height=100&width=100',
    quote: 'The training program gave me skills to start my own business. Now I employ 5 people from my community.',
    achievement: 'Started successful electronics repair business'
  },
  {
    name: 'Maria Santos',
    program: 'Teacher Development Program',
    image: '/placeholder.svg?height=100&width=100',
    quote: 'The professional development transformed my teaching. My students test scores improved by 40%.',
    achievement: 'Improved student performance significantly'
  },
  {
    name: 'Aisha Rahman',
    program: 'Scholarship Recipient',
    image: '/placeholder.svg?height=100&width=100',
    quote: 'Without the scholarship, I never could have become a doctor. Now I serve my rural community.',
    achievement: 'Became a doctor serving rural areas'
  }
])

// Ways to help
const waysToHelp = ref([
  {
    title: 'Donate',
    description: 'Your financial support directly funds educational programs and transforms lives.',
    action: 'Donate Now',
    icon: 'HeartIcon'
  },
  {
    title: 'Volunteer',
    description: 'Join our team of dedicated volunteers and make a hands-on impact in communities.',
    action: 'Get Involved',
    icon: 'HandRaisedIcon'
  },
  {
    title: 'Sponsor',
    description: 'Sponsor a child\'s education and follow their journey to success.',
    action: 'Sponsor Now',
    icon: 'GiftIcon'
  }
])

// Latest news
const latestNews = ref([
  {
    title: 'New School Opens in Rural Cambodia',
    excerpt: 'Thanks to generous donations, we opened our 151st school, providing education to 300 children in remote areas.',
    date: 'Dec 15, 2024',
    image: '/placeholder.svg?height=200&width=300'
  },
  {
    title: 'Teacher Training Program Success',
    excerpt: 'Our latest teacher training program graduated 50 new educators ready to transform their communities.',
    date: 'Dec 10, 2024',
    image: '/placeholder.svg?height=200&width=300'
  },
  {
    title: 'Annual Impact Report Released',
    excerpt: 'See how your donations made a difference in 2024 with our comprehensive impact report.',
    date: 'Dec 5, 2024',
    image: '/placeholder.svg?height=200&width=300'
  }
])

// Icon components (simplified for demo)
const UsersIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path></svg>' }
const BuildingIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>' }
const AcademicCapIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>' }
const GlobeIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' }
const HeartIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>' }
const HandRaisedIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path></svg>' }
const GiftIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>' }
</script>

<style scoped>
/* Custom animations */
@keyframes bounce {
  0%, 20%, 53%, 80%, 100% {
    transform: translate3d(0,0,0);
  }
  40%, 43% {
    transform: translate3d(0, -30px, 0);
  }
  70% {
    transform: translate3d(0, -15px, 0);
  }
  90% {
    transform: translate3d(0, -4px, 0);
  }
}

@keyframes pulse {
  0%, 100% {
    opacity: 0.1;
  }
  50% {
    opacity: 0.3;
  }
}

.animate-bounce {
  animation: bounce 2s infinite;
}

.animate-pulse {
  animation: pulse 2s infinite;
}

/* Smooth scrolling */
html {
  scroll-behavior: smooth;
}

/* Custom hover effects */
.group:hover .group-hover\:scale-110 {
  transform: scale(1.1);
}

.group:hover .group-hover\:translate-x-1 {
  transform: translateX(0.25rem);
}

.group:hover .group-hover\:scale-105 {
  transform: scale(1.05);
}
</style>