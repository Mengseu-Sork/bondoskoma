<template>
  <div class="min-h-screen bg-gray-50">

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-6">Our Programs</h1>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-8">
          Comprehensive educational initiatives designed to transform lives and build stronger communities
        </p>
        <div class="flex flex-wrap justify-center gap-4">
          <button 
            v-for="category in programCategories" 
            :key="category"
            @click="selectedCategory = category"
            :class="[
              'px-6 py-2 rounded-full font-medium transition-all',
              selectedCategory === category 
                ? 'bg-white text-blue-600' 
                : 'bg-blue-500 text-white hover:bg-blue-400'
            ]"
          >
            {{ category }}
          </button>
        </div>
      </div>
    </section>

    <!-- Program Overview Stats -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
          <div v-for="stat in programStats" :key="stat.label" class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl">
            <div class="text-4xl font-bold text-blue-600 mb-2">{{ stat.value }}</div>
            <div class="text-gray-700 font-medium">{{ stat.label }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Programs Section -->
    <section class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Core Programs</h2>
          <p class="text-xl text-gray-600">Transforming lives through comprehensive educational initiatives</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
          <div 
            v-for="program in filteredPrograms" 
            :key="program.id"
            class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
          >
            <div class="relative">
              <img :src="program.image" :alt="program.title" class="w-full h-48 object-cover">
              <div class="absolute top-4 left-4">
                <span :class="[
                  'px-3 py-1 rounded-full text-sm font-medium',
                  getCategoryColor(program.category)
                ]">
                  {{ program.category }}
                </span>
              </div>
            </div>
            
            <div class="p-6">
              <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ program.title }}</h3>
              <p class="text-gray-600 mb-4">{{ program.description }}</p>
              
              <div class="space-y-3 mb-6">
                <div class="flex items-center text-sm text-gray-500">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  {{ program.location }}
                </div>
                <div class="flex items-center text-sm text-gray-500">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                  </svg>
                  {{ program.beneficiaries }} beneficiaries
                </div>
                <div class="flex items-center text-sm text-gray-500">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a4 4 0 11-8 0v-4a4 4 0 018 0v4z"></path>
                  </svg>
                  {{ program.duration }}
                </div>
              </div>

              <div class="space-y-2 mb-6">
                <h4 class="font-semibold text-gray-900">Key Features:</h4>
                <ul class="space-y-1">
                  <li v-for="feature in program.features" :key="feature" class="flex items-start">
                    <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm text-gray-600">{{ feature }}</span>
                  </li>
                </ul>
              </div>

              <div class="flex justify-between items-center">
                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                  Learn More
                </button>
                <button class="text-blue-600 hover:text-blue-700 font-medium">
                  Apply Now →
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Program Impact Section -->
    <section class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">Program Impact</h2>
          <p class="text-xl text-gray-600">Real results from our educational initiatives</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="impact in programImpacts" :key="impact.title" class="text-center">
            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
              <component :is="impact.icon" class="w-10 h-10 text-white" />
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ impact.value }}</h3>
            <h4 class="text-lg font-semibold text-blue-600 mb-2">{{ impact.title }}</h4>
            <p class="text-gray-600">{{ impact.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Success Stories -->
    <section class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">Success Stories</h2>
          <p class="text-xl text-gray-600">Hear from those whose lives have been transformed</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="story in successStories" :key="story.name" class="bg-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center mb-4">
              <img :src="story.image" :alt="story.name" class="w-16 h-16 rounded-full object-cover mr-4">
              <div>
                <h3 class="font-semibold text-gray-900">{{ story.name }}</h3>
                <p class="text-sm text-gray-500">{{ story.program }}</p>
              </div>
            </div>
            <blockquote class="text-gray-600 italic mb-4">"{{ story.quote }}"</blockquote>
            <div class="text-sm text-blue-600 font-medium">{{ story.achievement }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- How to Get Involved -->
    <section class="py-20 bg-blue-600 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">Get Involved</h2>
          <p class="text-xl text-blue-100">Join us in making education accessible to all</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div v-for="involvement in involvementOptions" :key="involvement.title" class="text-center">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
              <component :is="involvement.icon" class="w-8 h-8 text-white" />
            </div>
            <h3 class="text-xl font-semibold mb-3">{{ involvement.title }}</h3>
            <p class="text-blue-100 mb-6">{{ involvement.description }}</p>
            <button class="bg-white text-blue-600 px-6 py-2 rounded-lg hover:bg-gray-100 transition-colors font-medium">
              {{ involvement.action }}
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <div class="text-2xl font-bold text-blue-600 mb-4">EduCharity</div>
            <p class="text-gray-300 mb-6">
              Empowering children through education and creating brighter futures for communities worldwide.
            </p>
          </div>
          <div>
            <h3 class="text-lg font-semibold mb-4">Programs</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-blue-600">Early Childhood</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-600">Primary Education</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-600">Vocational Training</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-600">Teacher Development</a></li>
            </ul>
          </div>
          <div>
            <h3 class="text-lg font-semibold mb-4">Support</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-blue-600">Donate</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-600">Volunteer</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-600">Sponsor a Child</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-600">Corporate Partners</a></li>
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
          <p>&copy; 2024 EduCharity. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

// Program categories for filtering
const programCategories = ref(['All Programs', 'Early Childhood', 'Primary Education', 'Vocational Training', 'Teacher Development', 'Community Outreach'])
const selectedCategory = ref('All Programs')

// Program statistics
const programStats = ref([
  { value: '12', label: 'Active Programs' },
  { value: '25,000+', label: 'Students Enrolled' },
  { value: '150+', label: 'Partner Schools' },
  { value: '15', label: 'Countries' }
])

// Main programs data
const programs = ref([
  {
    id: 1,
    title: 'Early Childhood Development',
    category: 'Early Childhood',
    description: 'Comprehensive early learning programs for children aged 3-6, focusing on cognitive, social, and emotional development.',
    image: '/placeholder.svg?height=200&width=400',
    location: 'Rural Thailand, Cambodia',
    beneficiaries: '2,500+',
    duration: 'Year-round',
    features: [
      'Play-based learning curriculum',
      'Nutritional support program',
      'Parent education workshops',
      'Health and wellness monitoring'
    ]
  },
  {
    id: 2,
    title: 'Primary Education Excellence',
    category: 'Primary Education',
    description: 'Quality primary education with modern teaching methods, technology integration, and comprehensive student support.',
    image: '/placeholder.svg?height=200&width=400',
    location: 'Southeast Asia, Africa',
    beneficiaries: '15,000+',
    duration: '6-year program',
    features: [
      'STEM-focused curriculum',
      'Digital literacy training',
      'Multilingual education',
      'After-school tutoring'
    ]
  },
  {
    id: 3,
    title: 'Vocational Skills Training',
    category: 'Vocational Training',
    description: 'Practical skills training for youth and adults in high-demand trades and modern technology sectors.',
    image: '/placeholder.svg?height=200&width=400',
    location: 'Urban and rural centers',
    beneficiaries: '3,500+',
    duration: '6-18 months',
    features: [
      'Industry-relevant skills',
      'Job placement assistance',
      'Entrepreneurship training',
      'Certification programs'
    ]
  },
  {
    id: 4,
    title: 'Teacher Development Program',
    category: 'Teacher Development',
    description: 'Comprehensive training and ongoing support for educators to improve teaching quality and student outcomes.',
    image: '/placeholder.svg?height=200&width=400',
    location: 'Regional training centers',
    beneficiaries: '1,200+',
    duration: 'Ongoing',
    features: [
      'Modern pedagogy training',
      'Technology integration',
      'Continuous professional development',
      'Mentorship programs'
    ]
  },
  {
    id: 5,
    title: 'Community Learning Centers',
    category: 'Community Outreach',
    description: 'Local learning hubs providing educational resources, adult literacy, and community development programs.',
    image: '/placeholder.svg?height=200&width=400',
    location: 'Remote communities',
    beneficiaries: '8,000+',
    duration: 'Permanent',
    features: [
      'Adult literacy classes',
      'Digital access points',
      'Community workshops',
      'Resource libraries'
    ]
  },
  {
    id: 6,
    title: 'Scholarship Program',
    category: 'Primary Education',
    description: 'Financial support and mentorship for exceptional students to pursue higher education and leadership roles.',
    image: '/placeholder.svg?height=200&width=400',
    location: 'Multiple countries',
    beneficiaries: '500+',
    duration: '4-year support',
    features: [
      'Full tuition coverage',
      'Living allowances',
      'Mentorship support',
      'Leadership development'
    ]
  }
])

// Filtered programs based on selected category
const filteredPrograms = computed(() => {
  if (selectedCategory.value === 'All Programs') {
    return programs.value
  }
  return programs.value.filter(program => program.category === selectedCategory.value)
})

// Program impact data
const programImpacts = ref([
  {
    title: 'Graduation Rate',
    value: '94%',
    description: 'Students successfully completing our programs',
    icon: 'AcademicCapIcon'
  },
  {
    title: 'Employment Rate',
    value: '87%',
    description: 'Vocational graduates finding employment within 6 months',
    icon: 'BriefcaseIcon'
  },
  {
    title: 'Community Impact',
    value: '250+',
    description: 'Communities directly benefiting from our programs',
    icon: 'UsersIcon'
  },
  {
    title: 'Teacher Training',
    value: '1,200+',
    description: 'Teachers trained in modern educational methods',
    icon: 'UserGroupIcon'
  },
  {
    title: 'Digital Literacy',
    value: '18,000+',
    description: 'Students gaining essential digital skills',
    icon: 'ComputerDesktopIcon'
  },
  {
    title: 'Scholarships Awarded',
    value: '500+',
    description: 'Students receiving educational scholarships',
    icon: 'TrophyIcon'
  }
])

// Success stories
const successStories = ref([
  {
    name: 'Somchai Patel',
    program: 'Vocational Training Graduate',
    image: '/placeholder.svg?height=100&width=100',
    quote: 'The vocational training program gave me the skills I needed to start my own electronics repair business. Now I employ 5 people from my community.',
    achievement: 'Started successful business, employs 5 people'
  },
  {
    name: 'Maria Santos',
    program: 'Teacher Development Program',
    image: '/placeholder.svg?height=100&width=100',
    quote: 'The training transformed how I teach. My students are more engaged, and test scores in my class have improved by 40%.',
    achievement: 'Improved student performance by 40%'
  },
  {
    name: 'Aisha Rahman',
    program: 'Scholarship Recipient',
    image: '/placeholder.svg?height=100&width=100',
    quote: 'Without the scholarship, I never could have attended university. Now I\'m a doctor serving my rural community.',
    achievement: 'Became a doctor, serves rural community'
  }
])

// Get involved options
const involvementOptions = ref([
  {
    title: 'Volunteer',
    description: 'Join our team of dedicated volunteers and make a direct impact in communities.',
    action: 'Apply to Volunteer',
    icon: 'HandRaisedIcon'
  },
  {
    title: 'Donate',
    description: 'Support our programs with financial contributions that directly fund education initiatives.',
    action: 'Donate Now',
    icon: 'HeartIcon'
  },
  {
    title: 'Partner',
    description: 'Collaborate with us as an institutional partner to expand our reach and impact.',
    action: 'Become a Partner',
    icon: 'HandshakeIcon'
  }
])

// Helper function to get category colors
const getCategoryColor = (category) => {
  const colors = {
    'Early Childhood': 'bg-pink-100 text-pink-800',
    'Primary Education': 'bg-blue-100 text-blue-800',
    'Vocational Training': 'bg-green-100 text-green-800',
    'Teacher Development': 'bg-purple-100 text-purple-800',
    'Community Outreach': 'bg-orange-100 text-orange-800'
  }
  return colors[category] || 'bg-gray-100 text-gray-800'
}

// Icon components (simplified for demo)
const AcademicCapIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>' }
const BriefcaseIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4a2 2 0 00-2-2H8a2 2 0 00-2 2v2m8 0V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0h4a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h4"></path></svg>' }
const UsersIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path></svg>' }
const UserGroupIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>' }
const ComputerDesktopIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>' }
const TrophyIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>' }
const HandRaisedIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path></svg>' }
const HeartIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>' }
const HandshakeIcon = { template: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>' }
</script>

<style scoped>
/* Custom animations and transitions */
.transform {
  transition: transform 0.3s ease-in-out;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .grid {
    gap: 1rem;
  }
}
</style>