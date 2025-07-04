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
                src="https://www.bandoskomar.org/wp-content/uploads/2017/10/sub-banner.jpg"
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