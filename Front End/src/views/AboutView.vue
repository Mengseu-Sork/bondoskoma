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

    <!-- History Section with Horizontal Timeline -->
    <section id="history" class="py-24 bg-gray-50">
      <div class="container mx-auto px-4 max-w-7xl">
        <div class="text-center mb-20">
          <h2 class="text-5xl font-bold text-gray-900 mb-6">Our Journey</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Three decades of unwavering commitment to Cambodian children and communities
          </p>
        </div>

        <!-- Horizontal Timeline -->
        <div class="relative overflow-hidden">
          <!-- Navigation Arrows -->
          <button class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-3 shadow-lg hover:shadow-xl transition-shadow">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          <button class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-3 shadow-lg hover:shadow-xl transition-shadow">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>

          <!-- Timeline Container -->
          <div class="mx-16">
            <div class="relative">
              <!-- Dotted Line -->
              <div class="absolute top-1/2 left-0 right-0 h-0.5 bg-gray-300 transform -translate-y-1/2" style="background-image: repeating-linear-gradient(to right, #d1d5db 0, #d1d5db 8px, transparent 8px, transparent 16px);"></div>
              
              <!-- Timeline Points -->
              <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                <!-- 1989 -->
                <div class="text-center relative">
                  <!-- Top Content -->
                  <div class="mb-8">
                    <p class="text-sm text-gray-600 leading-relaxed max-w-xs mx-auto">
                      Launch of the <span class="text-blue-500 font-semibold">first</span> educational programs in Cambodia with basic support and progressive development focusing on pre-schools and primary schools.
                    </p>
                  </div>
                  
                  <!-- Circle Image -->
                  <div class="relative inline-block">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg relative z-10">
                      <img src="https://via.placeholder.com/150x150?text=1989" alt="1989 Beginning" class="w-full h-full object-cover">
                    </div>
                    <!-- Timeline Dot -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-4 h-4 bg-blue-500 rounded-full border-2 border-white z-20"></div>
                  </div>
                  
                  <!-- Year -->
                  <div class="mt-6">
                    <h3 class="text-3xl font-bold text-gray-900">1989</h3>
                  </div>
                </div>

                <!-- 1999 -->
                <div class="text-center relative">
                  <!-- Top Content -->
                  <div class="mb-8">
                    <p class="text-sm text-gray-600 leading-relaxed max-w-xs mx-auto">
                      Localization of Partage Cambodia as <span class="text-blue-500 font-semibold">"Bandos Komar Association"</span>, becoming a local NGO supporting six primary and six pre-schools.
                    </p>
                  </div>
                  
                  <!-- Circle Image -->
                  <div class="relative inline-block">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg relative z-10">
                      <img src="https://via.placeholder.com/150x150?text=1999" alt="1999 Localization" class="w-full h-full object-cover">
                    </div>
                    <!-- Timeline Dot -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-4 h-4 bg-blue-500 rounded-full border-2 border-white z-20"></div>
                  </div>
                  
                  <!-- Year -->
                  <div class="mt-6">
                    <h3 class="text-3xl font-bold text-gray-900">1999</h3>
                  </div>

                  <!-- Bottom Content -->
                  <div class="mt-8">
                    <p class="text-sm text-gray-600 leading-relaxed max-w-xs mx-auto">
                      Inauguration of the BK Cambodia building and <span class="text-blue-500 font-semibold">first</span> graduating class of local staff and community leaders.
                    </p>
                  </div>
                </div>

                <!-- 2002+ -->
                <div class="text-center relative">
                  <!-- Circle Image -->
                  <div class="relative inline-block mb-6">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg relative z-10">
                      <img src="https://via.placeholder.com/150x150?text=2002" alt="2002 Expansion" class="w-full h-full object-cover">
                    </div>
                    <!-- Timeline Dot -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-4 h-4 bg-blue-500 rounded-full border-2 border-white z-20"></div>
                  </div>
                  
                  <!-- Year -->
                  <div class="mb-8">
                    <h3 class="text-3xl font-bold text-gray-900">2002+</h3>
                  </div>

                  <!-- Bottom Content -->
                  <div>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-xs mx-auto">
                      For the first time, <span class="text-blue-500 font-semibold">expansion</span> to new provinces including Pursat (2002) and Siem Reap (2008), growing our impact across Cambodia.
                    </p>
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

    <!-- Partners Section -->
   <div class="grid md:grid-cols-4 gap-12 items-center">
  <div>
    <img src="https://www.bandoskomar.org/wp-content/uploads/2017/10/Partner-Logo2.jpg" alt="Partnership 1" class="w-full h-64 object-cover rounded-lg shadow-sm">
  </div>
  <div>
    <img src="https://www.bandoskomar.org/wp-content/uploads/2017/10/Partner-Logo2.jpg" alt="Partnership 2" class="w-full h-64 object-cover rounded-lg shadow-sm">
  </div>
  <div>
    <img src="https://www.bandoskomar.org/wp-content/uploads/2017/10/Partner-Logo2.jpg" alt="Partnership 3" class="w-full h-64 object-cover rounded-lg shadow-sm">
  </div>
  <div>
    <img src="https://www.bandoskomar.org/wp-content/uploads/2017/10/Partner-Logo2.jpg" alt="Partnership 4" class="w-full h-64 object-cover rounded-lg shadow-sm">
  </div>
</div>
  </div>
</template>

<script setup>
</script>

<style scoped>
.container {
  @apply mx-auto px-4;
}

html {
  scroll-behavior: smooth;
}
</style>