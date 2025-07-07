<template>
  <div class="min-h-screen bg-white">
    <!-- Page Title -->
    <div class="container mx-auto px-4 max-w-6xl pt-12 pb-4">
      <h1 class="text-5xl font-bold text-gray-900 text-center mb-8">Our History</h1>
    </div>

    <!-- Horizontal Timeline Section -->
    <section class="py-20 bg-white">
      <div class="container mx-auto px-4 max-w-7xl">
        <div class="relative">
          <!-- Navigation Arrows -->
          <button 
            @click="scrollLeft"
            class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-4 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110"
          >
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          
          <button 
            @click="scrollRight"
            class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-4 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110"
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
            <div class="flex space-x-8 pb-4 relative" style="width: max-content;">
              <!-- Horizontal Timeline Line -->
              <div class="absolute top-1/2 left-0 right-0 h-0.5 bg-gray-300 transform -translate-y-1/2 pointer-events-none"></div>
              
              <!-- Timeline Items -->
              <div
                v-for="(milestone, index) in milestones"
                :key="index"
                class="flex-shrink-0 w-80 text-center relative"
              >
                <!-- Top Content -->
                <div class="mb-8 h-40">
                  <h3 :class="['text-2xl font-bold mb-4', milestone.titleColor]">{{ milestone.title }}</h3>
                  <p class="text-gray-600 leading-relaxed text-sm px-4">
                    <span v-html="milestone.description"></span>
                  </p>
                </div>

                <!-- Circle Image with Timeline Dot -->
                <div class="relative inline-block mb-8">
                  <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-xl relative z-10">
                    <img 
                      :src="milestone.image" 
                      :alt="milestone.title" 
                      class="w-full h-full object-cover"
                    />
                  </div>
                  <!-- Timeline Dot -->
                  <div 
                    :class="['absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-6 h-6 rounded-full border-4 border-white z-20 shadow-lg', milestone.dotColor]"
                  ></div>
                </div>

                <!-- Year and Period -->
                <div class="mb-6">
                  <h2 class="text-4xl font-bold text-gray-900 mb-2">{{ milestone.year }}</h2>
                  <p class="text-gray-500 text-sm">{{ milestone.period }}</p>
                </div>

                <!-- Bottom Description -->
                <div class="h-24">
                  <p class="text-gray-600 text-sm leading-relaxed">
                    <span v-html="milestone.bottomText"></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Legacy Section -->
    <section class="py-5 bg-gray-50">
      <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Legacy Today</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Three decades of dedication have built a foundation for lasting change in Cambodia
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <div
            v-for="(achievement, index) in currentAchievements"
            :key="index"
            class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 text-center"
          >
            <div class="text-4xl font-bold text-blue-600 mb-4">{{ achievement.number }}</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ achievement.title }}</h3>
            <p class="text-gray-600">{{ achievement.description }}</p>
          </div>
        </div>

      
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const timelineContainer = ref(null)

const milestones = [
  {
    title: "Foundation Era",
    year: "1989",
    period: "November",
    titleColor: "text-gray-900",
    dotColor: "bg-blue-500",
    image: "",
    description: `<span class="text-blue-500 font-semibold">Partage</span> began operating programs in Cambodia with basic support, focusing on education in pre-schools and primary schools in rural areas and surrounding villages.`,
    bottomText: ""
  },
  {
    title: "Growth Period", 
    year: "1989-1999",
    period: "Development Phase",
    titleColor: "text-gray-900",
    dotColor: "bg-green-500",
    image: "",
    description: `Progressive development of projects with <span class="text-green-500 font-semibold">6 primary schools</span> and <span class="text-green-500 font-semibold">6 pre-schools</span> across three provinces: Takeo, Kompong Speu, and Kandal.`,
    bottomText: `Established strong foundations in <span class="text-green-500 font-semibold">3 provinces</span> with comprehensive educational support programs.`
  },
  {
    title: "Localization",
    year: "1999", 
    period: "July",
    titleColor: "text-gray-900",
    dotColor: "bg-purple-500",
    image: "",
    description: `Historic transition as Partage Cambodia was localized to become <span class="text-purple-500 font-semibold">"Bandos Komar Association"</span> - a fully local NGO taking over all projects.`,
    bottomText: `Birth of <span class="text-purple-500 font-semibold">Bandos Komar Association</span> as an independent local NGO, marking a new era of community-led development.`
  },
  {
    title: "Strategic Expansion",
    year: "2002+",
    period: "Expansion Era", 
    titleColor: "text-gray-900",
    dotColor: "bg-orange-500",
    image: "",
    description: `BK expanded programs to new target provinces: <span class="text-orange-500 font-semibold">Pursat (2002)</span> and <span class="text-orange-500 font-semibold">Siem Reap (2008)</span>, significantly growing our impact across Cambodia.`,
    bottomText: `<strong>Current Reach:</strong> 5 provinces serving thousands of children and families`
  }
]

const currentAchievements = [
  {
    number: "5",
    title: "Provinces Served",
    description: "Active programs across Takeo, Kompong Speu, Kandal, Pursat, and Siem Reap provinces"
  },
  {
    number: "10,000+",
    title: "Lives Impacted", 
    description: "Children, families, and community members who have benefited from our programs"
  },
  {
    number: "34",
    title: "Years of Service",
    description: "Three decades of unwavering commitment to Cambodia's development"
  }
]

const scrollLeft = () => {
  if (timelineContainer.value) {
    timelineContainer.value.scrollBy({
      left: -320,
      behavior: 'smooth'
    })
  }
}

const scrollRight = () => {
  if (timelineContainer.value) {
    timelineContainer.value.scrollBy({
      left: 320, 
      behavior: 'smooth'
    })
  }
}
</script>

<style scoped>
html {
  scroll-behavior: smooth;
}

.scrollbar-hide::-webkit-scrollbar {
  display: none;
}

.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>