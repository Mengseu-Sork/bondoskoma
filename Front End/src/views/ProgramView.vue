<template>
  <div class="min-h-screen bg-white">


    <!-- Programs Section -->
    <section class="py-20 bg-white">
      <div class="container mx-auto px-4 max-w-7xl">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-900 mb-6">Strategic Programs</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Each program is carefully designed to address specific needs and create sustainable impact
          </p>
        </div>

        <div class="space-y-20">
          <div
            v-for="(program, index) in programs"
            :key="index"
            class="group"
          >
            <div :class="[
              'grid lg:grid-cols-2 gap-12 items-center',
              index % 2 === 0 ? '' : 'lg:grid-flow-col-dense'
            ]">
              <!-- Image Section -->
              <div :class="[
                'relative',
                index % 2 === 0 ? 'lg:order-1' : 'lg:order-2'
              ]">
                <div class="relative group overflow-hidden rounded-3xl">
                  <div :class="[
                    'absolute inset-0 rounded-3xl transform rotate-3 scale-105 opacity-70',
                    program.gradient
                  ]"></div>
                  <img
                    :src="program.image"
                    :alt="program.title"
                    class="relative w-full h-96 object-cover rounded-3xl shadow-2xl transform group-hover:scale-105 transition-transform duration-700"
                  />
                  <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent rounded-3xl"></div>
                </div>
              </div>

              <!-- Content Section -->
              <div :class="[
                'space-y-8',
                index % 2 === 0 ? 'lg:order-2' : 'lg:order-1'
              ]">
                <div>
                  <div :class="[
                    'inline-block px-4 py-2 rounded-full text-sm font-semibold mb-6',
                    program.badge
                  ]">
                    Program {{ index + 1 }}
                  </div>
                  <h3 class="text-3xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ program.title }}
                  </h3>
                </div>

                <!-- Goal Section -->
                <div class="bg-gray-50 rounded-2xl p-8">
                  <h4 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-3">
                    <div :class="['w-3 h-3 rounded-full', program.dotColor]"></div>
                    Our Goal
                  </h4>
                  <p class="text-gray-700 leading-relaxed text-lg">
                    {{ program.goal }}
                  </p>
                </div>

                <!-- Key Highlights -->
                <div>
                  <h4 class="text-xl font-bold text-gray-900 mb-6">Key Highlights</h4>
                  <div class="space-y-4">
                    <div
                      v-for="(highlight, i) in program.highlights"
                      :key="i"
                      class="flex items-start gap-4 group/item"
                    >
                      <div :class="[
                        'w-2 h-2 rounded-full mt-2 flex-shrink-0 group-hover/item:scale-125 transition-transform duration-300',
                        program.dotColor
                      ]"></div>
                      <p class="text-gray-700 group-hover/item:text-gray-900 transition-colors duration-300">
                        {{ highlight }}
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Impact Stats -->
                <div v-if="program.stats" :class="['rounded-2xl p-6', program.statsBg]">
                  <h4 class="text-lg font-bold text-gray-900 mb-4">Expected Impact</h4>
                  <div class="grid grid-cols-2 gap-4">
                    <div
                      v-for="(stat, i) in program.stats"
                      :key="i"
                      class="text-center"
                    >
                      <div :class="['text-2xl font-bold mb-1', program.statsColor]">
                        {{ stat.number }}
                      </div>
                      <div class="text-sm text-gray-600">{{ stat.label }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

 
  </div>
</template>

<script setup>
const programs = [
  {
    title: 'Country Goal Strategy',
    goal: 'By 2019, children and youths enjoy the full potential of their rights and live with dignity, becoming empowered individuals who contribute meaningfully to sustainable social development.',
    highlights: [
      'Quality and equitable education for all children',
      'Building human capital for societal change',
      'Empowering youth to tackle emerging challenges',
      'Creating agents of positive transformation'
    ],
    image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyEa-i-q-ni2CFVcG89ltLTBMcB-h8zi9Ahg&s',
    gradient: 'bg-gradient-to-br from-blue-500 to-purple-600',
    badge: 'bg-blue-100 text-blue-700',
    dotColor: 'bg-blue-500',
    statsBg: 'bg-blue-50',
    statsColor: 'text-blue-600',
    stats: [
      { number: '2019', label: 'Target Year' },
      { number: '5', label: 'Provinces' }
    ]
  },
  {
    title: 'Early Child Care & Development',
    goal: 'By 2019, children aged below six years old in target areas have full potential and opportunity to continue their primary education with equity, quality and effectiveness.',
    highlights: [
      'Community preschools for cognitive development',
      'Social and motor skill enhancement',
      'Basic hygiene and nutrition education',
      'Preparation for primary school socialization'
    ],
    image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrx0iNsmyejyqzo9Vvm4ji60oizWSDnf6mDQ&s',
    gradient: 'bg-gradient-to-br from-emerald-500 to-teal-600',
    badge: 'bg-emerald-100 text-emerald-700',
    dotColor: 'bg-emerald-500',
    statsBg: 'bg-emerald-50',
    statsColor: 'text-emerald-600',
    stats: [
      { number: '3-5', label: 'Age Range' },
      { number: '100%', label: 'School Ready' }
    ]
  },
  {
    title: 'Quality Primary Education',
    goal: 'By 2019, children and youths in target areas acquire knowledge, skills, confidence, entrepreneurship and perseverance in national and regional contexts.',
    highlights: [
      'Strengthening education quality and life skills',
      'Teacher capacity building and material supply',
      'Child-friendly school environments',
      'Life skills and entrepreneurship promotion'
    ],
    image: 'https://www.unicef.org/cambodia/sites/unicef.org.cambodia/files/styles/media_banner/public/2019-04/children-in-cambodia-1.jpg.webp?itok=lDq1PIS_',
    gradient: 'bg-gradient-to-br from-orange-500 to-red-600',
    badge: 'bg-orange-100 text-orange-700',
    dotColor: 'bg-orange-500',
    statsBg: 'bg-orange-50',
    statsColor: 'text-orange-600',
    stats: [
      { number: '10+', label: 'Key Strategies' },
      { number: '1000s', label: 'Students' }
    ]
  }
]
</script>

<style scoped>
html {
  scroll-behavior: smooth;
}
</style>