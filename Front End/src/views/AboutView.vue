<template>
  <div class="min-h-screen bg-white">
   
    <!-- Vision & Mission Section -->
    <section id="about" class="py-24 bg-white">
      <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-20">
          <h2 class="text-5xl font-bold text-gray-900 mb-6">Our Purpose</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Dedicated to creating lasting change in the lives of Cambodian children and youth
          </p>
        </div>
        <div class="grid lg:grid-cols-2 gap-16 mb-20">
          <div class="space-y-8">
            <div class="border-l-4 border-gray-900 pl-8">
              <h3 class="text-3xl font-bold text-gray-900 mb-6">Our Vision</h3>
              <p class="text-xl text-gray-700 leading-relaxed mb-8">
                Every child and youth enjoys full development potential with dignity and sustainability.
              </p>
            </div>
            <div class="border-l-4 border-gray-400 pl-8">
              <h3 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h3>
              <p class="text-xl text-gray-700 leading-relaxed">
                To support human resource development and livelihoods improvement, enabling participation opportunities for communities, public institutions, civil society, the private sector and other relevant stakeholders.
              </p>
            </div>
          </div>
          <div class="relative">
            <img src="https://live.staticflickr.com/60/188731500_27a39c9eb1_b.jpg" alt="Children Learning" class="w-full h-96 object-cover rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-2xl"></div>
          </div>
        </div>
        <!-- Strategic Goal -->
        <div class="bg-gray-50 rounded-3xl p-12 lg:p-16">
          <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
              <h3 class="text-4xl font-bold text-gray-900 mb-8">Strategic Goal</h3>
              <blockquote class="text-2xl text-gray-700 leading-relaxed border-l-4 border-gray-300 pl-6">
                "By 2019, children and youths enjoy full potential of their rights in living with dignity to become human capital for sustainable development of the society."
              </blockquote>
            </div>
            <div>
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS73PV9jSPJNx-hfjw0lrEs44ZrGDoLoXhGbtY6zbP_oSCV7ddL2xM_7p6Fa9lDvTbH0f8&usqp=CAU" alt="Strategic Vision" class="w-full h-80 object-cover rounded-2xl shadow-xl">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Timeline Section -->
    <section id="history" class="py-24 bg-gray-50">
      <div class="container mx-auto px-4 max-w-7xl">
        <div class="text-center mb-20">
          <h2 class="text-5xl font-bold text-gray-900 mb-6">Our Journey</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Three decades of unwavering commitment to Cambodian children and communities
          </p>
        </div>

        <!-- Timeline Container -->
        <div class="relative bg-white rounded-3xl p-8 shadow-xl overflow-hidden">
          <!-- Navigation Arrows -->
          <button 
            @click="scrollLeft" 
            class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-4 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 hover:bg-gray-50"
          >
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          
          <button 
            @click="scrollRight" 
            class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-4 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 hover:bg-gray-50"
          >
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>

          <!-- Timeline Content -->
          <div 
            ref="timelineContainer"
            class="mx-16 overflow-x-auto scrollbar-hide scroll-smooth"
            style="scrollbar-width: none; -ms-overflow-style: none;"
          >
            <div class="flex space-x-8 pb-4" style="width: max-content;">
              <!-- Dotted Line -->
              <div class="absolute top-1/2 left-16 right-16 h-0.5 bg-gray-300 transform -translate-y-1/2 pointer-events-none" 
                   style="background-image: repeating-linear-gradient(to right, #d1d5db 0, #d1d5db 8px, transparent 8px, transparent 16px);"></div>
              
              <!-- 1989 - Foundation Era -->
              <div class="flex-shrink-0 w-80 text-center relative">
                <!-- Top Content -->
                <div class="mb-8 h-32">
                  <h4 class="text-lg font-bold text-gray-900 mb-3">Foundation Era</h4>
                  <p class="text-sm text-gray-600 leading-relaxed">
                    <span class="text-blue-500 font-semibold">Partage</span> began operating programs in Cambodia with basic support, focusing on education in pre-schools and primary schools in rural areas and surrounding villages.
                  </p>
                </div>
                
                <!-- Circle Image -->
                <div class="relative inline-block">
                  <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg relative z-10">
                    <img src="https://www.bandoskomar.org/wp-content/uploads/2017/10/Library.jpg" alt="1989 Beginning" class="w-full h-full object-cover">
                  </div>
                  <!-- Timeline Dot -->
                  <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-4 h-4 bg-blue-500 rounded-full border-2 border-white z-20"></div>
                </div>
                
                <!-- Year -->
                <div class="mt-6">
                  <h3 class="text-3xl font-bold text-gray-900">1989</h3>
                  <p class="text-xs text-gray-500 mt-1">November</p>
                </div>
              </div>

              <!-- 1989-1999 - Growth Period -->
              <div class="flex-shrink-0 w-80 text-center relative">
                <!-- Top Content -->
                <div class="mb-8 h-32">
                  <h4 class="text-lg font-bold text-gray-900 mb-3">Growth Period</h4>
                  <p class="text-sm text-gray-600 leading-relaxed">
                    Progressive development of projects with <span class="text-blue-500 font-semibold">6 primary schools</span> and <span class="text-blue-500 font-semibold">6 pre-schools</span> across three provinces: Takeo, Kompong Speu, and Kandal.
                  </p>
                </div>
                
                <!-- Circle Image -->
                <div class="relative inline-block">
                  <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg relative z-10">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_guuqTnUjp4rR1VWQrlZXX2sDscx_kwzMVskxbkiBoIJWZFvlszCIRu2APGWa8xxU9uY&usqp=CAU" alt="Growth Period" class="w-full h-full object-cover">
                  </div>
                  <!-- Timeline Dot -->
                  <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-4 h-4 bg-green-500 rounded-full border-2 border-white z-20"></div>
                </div>
                
                <!-- Year -->
                <div class="mt-6">
                  <h3 class="text-2xl font-bold text-gray-900">1989-1999</h3>
                  <p class="text-xs text-gray-500 mt-1">Development Phase</p>
                </div>

                <!-- Bottom Content -->
                <div class="mt-8 h-24">
                  <p class="text-sm text-gray-600 leading-relaxed">
                    Established strong foundations in <span class="text-green-500 font-semibold">3 provinces</span> with comprehensive educational support programs.
                  </p>
                </div>
              </div>

              <!-- 1999 - Localization -->
              <div class="flex-shrink-0 w-80 text-center relative">
                <!-- Top Content -->
                <div class="mb-8 h-32">
                  <h4 class="text-lg font-bold text-gray-900 mb-3">Localization</h4>
                  <p class="text-sm text-gray-600 leading-relaxed">
                    Historic transition as Partage Cambodia was localized to become <span class="text-blue-500 font-semibold">"Bandos Komar Association"</span> - a fully local NGO taking over all projects.
                  </p>
                </div>
                
                <!-- Circle Image -->
                <div class="relative inline-block">
                  <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg relative z-10">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_guuqTnUjp4rR1VWQrlZXX2sDscx_kwzMVskxbkiBoIJWZFvlszCIRu2APGWa8xxU9uY&usqp=CAU" alt="1999 Localization" class="w-full h-full object-cover">
                  </div>
                  <!-- Timeline Dot -->
                  <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-4 h-4 bg-purple-500 rounded-full border-2 border-white z-20"></div>
                </div>
                
                <!-- Year -->
                <div class="mt-6">
                  <h3 class="text-3xl font-bold text-gray-900">1999</h3>
                  <p class="text-xs text-gray-500 mt-1">July</p>
                </div>

                <!-- Bottom Content -->
                <div class="mt-8 h-24">
                  <p class="text-sm text-gray-600 leading-relaxed">
                    Birth of <span class="text-purple-500 font-semibold">Bandos Komar Association</span> as an independent local NGO, marking a new era of community-led development.
                  </p>
                </div>
              </div>

              <!-- 2002+ - Strategic Expansion -->
              <div class="flex-shrink-0 w-80 text-center relative">
                <!-- Circle Image -->
                <div class="relative inline-block mb-6">
                  <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg relative z-10">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMAbq3i0_MkbcftF6CxbTBYKetrcr55qDNkAeJN8DOia1ro8zpnUcWSF4bNahZoTHcNuA&usqp=CAU" alt="2002 Expansion" class="w-full h-full object-cover">
                  </div>
                  <!-- Timeline Dot -->
                  <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-4 h-4 bg-orange-500 rounded-full border-2 border-white z-20"></div>
                </div>
                
                <!-- Year -->
                <div class="mb-8">
                  <h3 class="text-3xl font-bold text-gray-900">2002+</h3>
                  <p class="text-xs text-gray-500 mt-1">Expansion Era</p>
                </div>

                <!-- Bottom Content -->
                <div class="h-32">
                  <h4 class="text-lg font-bold text-gray-900 mb-3">Strategic Expansion</h4>
                  <p class="text-sm text-gray-600 leading-relaxed mb-4">
                    BK expanded programs to new target provinces: <span class="text-orange-500 font-semibold">Pursat (2002)</span> and <span class="text-orange-500 font-semibold">Siem Reap (2008)</span>, significantly growing our impact across Cambodia.
                  </p>
                  <div class="bg-orange-50 rounded-lg p-2 text-xs text-gray-600">
                    <strong>Current Reach:</strong> 5 provinces serving thousands of children and families
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Core Values Section -->
    <section id="values" class="py-24 bg-white">
      <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-20">
          <h2 class="text-5xl font-bold text-gray-900 mb-6">Our Core Values</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            The fundamental principles that guide our work and shape our impact
          </p>
        </div>
        <div class="grid md:grid-cols-2 gap-12 items-center">
          <div>
            <p class="text-lg text-gray-700 leading-relaxed mb-8">
              At Bandos Komar, our work is grounded in a set of core values: <b>Accountability</b>, <b>Dignity</b>, <b>Equity</b>, <b>Creativity</b>, the <b>Best Interests of Children</b>, <b>Gender Responsiveness</b>, <b>Cooperation and Partnership</b>, <b>Resilience and Flexibility</b>, <b>Child Rights Programming</b>, and a <b>Result-based approach</b>. These values guide every decision we make and every action we take, ensuring that we remain committed to empowering children and communities with respect, fairness, and innovation.
            </p>
          </div>
          <div class="flex justify-center">
            <img src="https://live.staticflickr.com/60/188731500_27a39c9eb1_b.jpg" alt="Core Values" class="rounded-xl shadow-lg w-full max-w-xs">
          </div>
        </div>
      </div>
    </section>

  
  </div>
</template>

<script setup>
import { ref } from 'vue'

const timelineContainer = ref(null)

const scrollLeft = () => {
  if (timelineContainer.value) {
    timelineContainer.value.scrollBy({
      left: -320, // Scroll by one card width
      behavior: 'smooth'
    })
  }
}

const scrollRight = () => {
  if (timelineContainer.value) {
    timelineContainer.value.scrollBy({
      left: 320, // Scroll by one card width
      behavior: 'smooth'
    })
  }
}
</script>

<style scoped>
.container {
  @apply mx-auto px-4;
}

html {
  scroll-behavior: smooth;
}

.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
</style>
