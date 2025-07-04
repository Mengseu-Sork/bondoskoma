<template>
  <div class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
      <div class="absolute inset-0 bg-black/20"></div>
      <div class="relative px-4 py-20 sm:px-8 lg:px-24">
        <div class="max-w-4xl mx-auto text-center">
          <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
            Empowering Children & Youth
          </h1>
          <p class="text-xl md:text-2xl text-blue-100 leading-relaxed">
            Building a sustainable future through education and community development
          </p>
        </div>
      </div>
      <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-slate-50 to-transparent"></div>
    </div>

    <div class="px-4 sm:px-8 lg:px-24 -mt-10 relative z-10">
      <!-- About Us Card -->
      <div class="max-w-6xl mx-auto mb-12">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-[1.02] transition-all duration-500">
          <div class="md:flex">
            <div class="md:w-1/2">
              <img
                src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                alt="Children learning in a classroom"
                class="w-full h-64 md:h-full object-cover"
              />
            </div>
            <div class="md:w-1/2 p-8 md:p-12">
              <div class="flex items-center mb-6">
                <div class="bg-blue-100 p-3 rounded-full mr-4">
                  <Heart class="w-8 h-8 text-blue-600" />
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">About Us</h2>
              </div>
              <p class="text-lg text-gray-600 leading-relaxed">
                We are committed to the development and well-being of children and youth, ensuring they reach their full potential with dignity and sustainability. Through strategic initiatives, collaboration, and a child Rights-centered approach, we empower communities and contribute to long-term societal transformation.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Vision, Mission, Strategic Goal Grid -->
      <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8 mb-12">
        <!-- Vision Card -->
        <div class="group bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border-t-4 border-emerald-500">
          <div class="flex items-center mb-6">
            <div class="bg-emerald-100 p-3 rounded-full mr-4 group-hover:bg-emerald-200 transition-colors">
              <Eye class="w-6 h-6 text-emerald-600" />
            </div>
            <h3 class="text-2xl font-bold text-gray-800">Vision</h3>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Every child and youth enjoys full development potential with dignity and sustainability.
          </p>
        </div>

        <!-- Mission Card -->
        <div class="group bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border-t-4 border-purple-500">
          <div class="flex items-center mb-6">
            <div class="bg-purple-100 p-3 rounded-full mr-4 group-hover:bg-purple-200 transition-colors">
              <Target class="w-6 h-6 text-purple-600" />
            </div>
            <h3 class="text-2xl font-bold text-gray-800">Mission</h3>
          </div>
          <p class="text-gray-600 leading-relaxed">
            To support the human resource development and livelihoods improvement enabling participation opportunities of the communities, public institutions, civil society, the private sector, and other relevant stakeholders.
          </p>
        </div>

        <!-- Strategic Goal Card -->
        <div class="group bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border-t-4 border-orange-500">
          <div class="flex items-center mb-6">
            <div class="bg-orange-100 p-3 rounded-full mr-4 group-hover:bg-orange-200 transition-colors">
              <Trophy class="w-6 h-6 text-orange-600" />
            </div>
            <h3 class="text-2xl font-bold text-gray-800">Strategic Goal</h3>
          </div>
          <p class="text-gray-600 leading-relaxed">
            By 2019, children and youths enjoy full potential of their rights in living with dignity to become human capital for sustainable development of the society.
          </p>
        </div>
      </div>

      <!-- Background Section -->
      <div class="max-w-6xl mx-auto mb-12">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl shadow-2xl overflow-hidden text-white">
          <div class="p-8 md:p-12">
            <div class="flex items-center mb-8">
              <div class="bg-white/20 p-3 rounded-full mr-4">
                <BookOpen class="w-8 h-8 text-white" />
              </div>
              <h2 class="text-3xl md:text-4xl font-bold">Background of BK</h2>
            </div>
            <div class="grid md:grid-cols-2 gap-8">
              <div class="space-y-6">
                <div class="bg-white/10 p-6 rounded-2xl backdrop-blur-sm">
                  <div class="flex items-center mb-4">
                    <Calendar class="w-5 h-5 mr-2" />
                    <span class="font-semibold">1989 - Foundation</span>
                  </div>
                  <p class="text-blue-100 leading-relaxed">
                    Partage has been operating programs in Cambodia since November 1989. Initially focused on basic support, it has progressively developed projects emphasizing education.
                  </p>
                </div>
              </div>
              <div class="space-y-6">
                <div class="bg-white/10 p-6 rounded-2xl backdrop-blur-sm">
                  <div class="flex items-center mb-4">
                    <Users class="w-5 h-5 mr-2" />
                    <span class="font-semibold">1999 - Localization</span>
                  </div>
                  <p class="text-blue-100 leading-relaxed">
                    By July 1999, Partage Cambodia had been localized as "Bandos Komar Association", which became a local NGO to take over all Partage's projects.
                  </p>
                </div>
              </div>
            </div>
            <div class="mt-8 bg-white/10 p-6 rounded-2xl backdrop-blur-sm">
              <div class="flex items-center mb-4">
                <MapPin class="w-5 h-5 mr-2" />
                <span class="font-semibold">2002-2008 - Expansion</span>
              </div>
              <p class="text-blue-100 leading-relaxed">
                Since 2002, BK has expanded its programs to new target provinces such as Pursat in 2002 and Siem Reap in 2008, focusing on pre-schools and primary schools in rural areas.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Enhanced Partners Section -->
      <div class="max-w-7xl mx-auto mb-12">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
          <!-- Header with gradient background -->
          <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 p-8 md:p-12 text-white text-center">
            <div class="flex items-center justify-center mb-6">
              <div class="bg-white/20 p-4 rounded-full mr-4 backdrop-blur-sm">
                <Handshake class="w-10 h-10 text-white" />
              </div>
              <h2 class="text-3xl md:text-4xl font-bold">Partners</h2>
            </div>
            <p class="text-lg text-indigo-100 max-w-3xl mx-auto leading-relaxed">
              Collaborating with world-class organizations to amplify our impact and create sustainable change in communities across Cambodia
            </p>
          </div>

          <!-- Partners Grid -->
          <div class="p-8 md:p-12 bg-gradient-to-br from-gray-50 to-white">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
              <div
                v-for="(partner, index) in partners"
                :key="partner.name"
                class="group relative"
              >
                <!-- Main Card -->
                <div class="relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-3 transition-all duration-500 overflow-hidden border border-gray-100 hover:border-transparent">
                  <!-- Gradient overlay that appears on hover -->
                  <div 
                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"
                    :class="getPartnerGradient(index)"
                  ></div>
                  
                  <!-- Content -->
                  <div class="relative z-10 p-6">
                    <!-- Logo container with enhanced styling -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 group-hover:from-white group-hover:to-white p-6 rounded-xl shadow-inner group-hover:shadow-lg transition-all duration-300 mb-4">
                      <div class="relative">
                        <img
                          :src="partner.logo"
                          :alt="partner.name"
                          class="w-full h-20 object-contain filter group-hover:brightness-110 transition-all duration-300"
                        />
                        <!-- Subtle glow effect on hover -->
                        <div class="absolute inset-0 bg-gradient-to-t from-transparent to-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded"></div>
                      </div>
                    </div>
                    
                    <!-- Partner name with enhanced typography -->
                    <h3 class="text-center text-base font-bold text-gray-800 group-hover:text-white transition-colors duration-300 leading-tight">
                      {{ partner.name }}
                    </h3>
                    
                    <!-- Partnership type badge -->
                    <div class="mt-3 text-center">
                      <span 
                        class="inline-block px-3 py-1 text-xs font-medium rounded-full transition-all duration-300"
                        :class="getPartnerBadgeClass(index)"
                      >
                        {{ getPartnerType(index) }}
                      </span>
                    </div>
                  </div>
                  
                  <!-- Decorative elements -->
                  <div class="absolute top-0 right-0 w-20 h-20 transform translate-x-10 -translate-y-10">
                    <div 
                      class="w-full h-full rounded-full opacity-10 group-hover:opacity-20 transition-opacity duration-300"
                      :class="getPartnerAccentColor(index)"
                    ></div>
                  </div>
                  
                  <!-- Bottom accent line -->
                  <div 
                    class="absolute bottom-0 left-0 right-0 h-1 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"
                    :class="getPartnerAccentColor(index)"
                  ></div>
                </div>
                
                <!-- Floating partnership duration indicator -->
                <div class="absolute -top-2 -right-2 bg-white rounded-full p-2 shadow-lg opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 transition-all duration-300 z-20">
                  <div 
                    class="w-3 h-3 rounded-full"
                    :class="getPartnerAccentColor(index)"
                  ></div>
                </div>
              </div>
            </div>
            
            <!-- Partnership stats -->
            <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-6">
              <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl">
                <div class="text-2xl font-bold text-blue-600 mb-1">{{ partners.length }}+</div>
                <div class="text-sm text-gray-600">Active Partners</div>
              </div>
              <div class="text-center p-4 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl">
                <div class="text-2xl font-bold text-emerald-600 mb-1">15+</div>
                <div class="text-sm text-gray-600">Years Experience</div>
              </div>
              <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl">
                <div class="text-2xl font-bold text-purple-600 mb-1">50+</div>
                <div class="text-sm text-gray-600">Joint Projects</div>
              </div>
              <div class="text-center p-4 bg-gradient-to-br from-orange-50 to-red-50 rounded-xl">
                <div class="text-2xl font-bold text-orange-600 mb-1">100K+</div>
                <div class="text-sm text-gray-600">Lives Impacted</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="max-w-4xl mx-auto mb-12">
        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-3xl shadow-2xl p-8 md:p-12 text-center text-white">
          <h2 class="text-3xl md:text-4xl font-bold mb-6">Join Our Mission</h2>
          <p class="text-xl text-emerald-100 mb-8 leading-relaxed">
            Together, we can create a brighter future for children and youth in Cambodia
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="bg-white text-emerald-600 px-8 py-4 rounded-full font-semibold hover:bg-emerald-50 transform hover:scale-105 transition-all duration-300 shadow-lg">
              Get Involved
            </button>
            <button class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-emerald-600 transform hover:scale-105 transition-all duration-300">
              Learn More
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'


const partners = [
  {
    name: 'Partage',
    logo: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTacusRaAUG_xABZA8LeZO_nE6wPyCIUbnPqw&s',
  },
  {
    name: 'Le Don du Chœur',
    logo: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSV6gSAH0L9t03j0YAJRA6vas7Gm7AdUT-1dg&s',
  },
  {
    name: 'World Vision',
    logo: 'https://www.ntd-ngonetwork.org/sites/nnn/files/styles/grid-6-wide-logo-16x9/public/content/organisation/logos/2021-09-01/WW%20logo.png?itok=dM3shl0j',
  },
  {
    name: 'Plan International',
    logo: 'https://media.licdn.com/dms/image/v2/D560BAQFnF6LrQoNqAw/company-logo_200_200/company-logo_200_200/0/1704863347525/planinternationalcambodia_logo?e=2147483647&v=beta&t=XsAXDb4LUgDwTPSwmSo3JNIOw9j4khjyU0i8TagztHM',
  }
]


const getPartnerGradient = (index) => {
  const gradients = [
    'bg-gradient-to-br from-blue-500 to-blue-600',
    'bg-gradient-to-br from-purple-500 to-purple-600',
    'bg-gradient-to-br from-emerald-500 to-emerald-600',
    'bg-gradient-to-br from-orange-500 to-orange-600'
  ]
  return gradients[index % gradients.length]
}

const getPartnerAccentColor = (index) => {
  const colors = [
    'bg-blue-500',
    'bg-purple-500',
    'bg-emerald-500',
    'bg-orange-500'
  ]
  return colors[index % colors.length]
}

const getPartnerBadgeClass = (index) => {
  const classes = [
    'bg-blue-100 text-blue-700 group-hover:bg-white group-hover:text-blue-600',
    'bg-purple-100 text-purple-700 group-hover:bg-white group-hover:text-purple-600',
    'bg-emerald-100 text-emerald-700 group-hover:bg-white group-hover:text-emerald-600',
    'bg-orange-100 text-orange-700 group-hover:bg-white group-hover:text-orange-600'
  ]
  return classes[index % classes.length]
}

const getPartnerType = (index) => {
  const types = ['Strategic Partner', 'Implementation Partner', 'Funding Partner', 'Technical Partner']
  return types[index % types.length]
}
</script>

<style scoped>
/* Enhanced animations */
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-5px); }
}

@keyframes pulse-glow {
  0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
  50% { box-shadow: 0 0 30px rgba(99, 102, 241, 0.5); }
}

.group:hover .float {
  animation: float 3s ease-in-out infinite;
}

/* Custom scrollbar for better aesthetics */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}
</style>