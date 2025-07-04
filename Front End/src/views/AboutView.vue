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

      <!-- Partners Section -->
      <div class="max-w-6xl mx-auto mb-12">
        <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12">
          <div class="text-center mb-12">
            <div class="flex items-center justify-center mb-6">
              <div class="bg-indigo-100 p-4 rounded-full mr-4">
                <Handshake class="w-10 h-10 text-indigo-600" />
              </div>
              <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Our Partners</h2>
            </div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
              Working together with leading organizations to create lasting impact in communities
            </p>
          </div>
          
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
              v-for="(partner, index) in partners"
              :key="partner.name"
              class="group bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-gray-200 hover:border-indigo-300"
              :class="getPartnerCardClass(index)"
            >
              <div class="bg-white p-4 rounded-xl shadow-sm mb-4 group-hover:shadow-md transition-shadow">
                <img
                  :src="partner.logo"
                  :alt="partner.name"
                  class="w-full h-16 object-contain"
                />
              </div>
              <h3 class="text-center text-sm font-semibold text-gray-700 group-hover:text-gray-900 transition-colors">
                {{ partner.name }}
              </h3>
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

const partners = ref([
  {
    name: 'Global Education Fund',
    logo: 'https://images.unsplash.com/photo-1629736025171-44f85821f3a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80',
  },
  {
    name: 'Youth Empowerment Network',
    logo: 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80',
  },
  {
    name: 'Community Growth Initiative',
    logo: 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80',
  },
  {
    name: 'Sustainable Future Alliance',
    logo: 'https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80',
  },
])

const getPartnerCardClass = (index) => {
  const colors = [
    'hover:from-blue-50 hover:to-blue-100',
    'hover:from-purple-50 hover:to-purple-100',
    'hover:from-emerald-50 hover:to-emerald-100',
    'hover:from-orange-50 hover:to-orange-100'
  ]
  return colors[index % colors.length]
}
</script>

<style scoped>
/* Additional custom animations */
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
}

.group:hover .float {
  animation: float 2s ease-in-out infinite;
}
</style>
