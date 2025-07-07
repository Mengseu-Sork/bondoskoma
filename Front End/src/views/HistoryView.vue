<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 mx-4 md:mx-8 lg:mx-16 xl:mx-24 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 pointer-events-none">
      <div class="absolute top-20 left-20 w-96 h-96 bg-gradient-to-r from-blue-200/20 to-purple-200/20 rounded-full blur-3xl animate-float"></div>
      <div class="absolute bottom-20 right-20 w-80 h-80 bg-gradient-to-r from-emerald-200/20 to-teal-200/20 rounded-full blur-3xl animate-float-delayed"></div>
      <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-r from-orange-200/20 to-pink-200/20 rounded-full blur-3xl animate-pulse-slow"></div>
    </div>

    <!-- Enhanced Header Section -->
    <div class="relative py-20 bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 overflow-hidden rounded-3xl mb-8 shadow-2xl">
      <!-- Dynamic Background Pattern -->
      <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-blue-600/10 via-transparent to-purple-600/10"></div>
        <div class="absolute top-10 right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl animate-pulse"></div>
        <div class="absolute bottom-10 left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-56 h-56 bg-white/5 rounded-full blur-3xl animate-spin-slow"></div>
        
        <!-- Geometric Shapes -->
        <div class="absolute top-16 left-1/4 w-4 h-4 bg-white/20 rotate-45 animate-bounce"></div>
        <div class="absolute bottom-16 right-1/4 w-6 h-6 bg-white/15 rounded-full animate-bounce delay-500"></div>
        <div class="absolute top-1/3 right-16 w-3 h-3 bg-white/25 rotate-45 animate-bounce delay-1000"></div>
      </div>
      
      <div class="container mx-auto px-6 md:px-12 lg:px-16 relative z-10">
        <div class="text-center text-white">
          <!-- Animated Badge -->
          <div class="inline-block mb-6 transform hover:scale-105 transition-transform duration-300">
            <span class="bg-white/20 backdrop-blur-lg px-6 py-3 rounded-full text-sm font-bold tracking-wider uppercase border border-white/30 shadow-lg">
              ✨ Our Impact Programs
            </span>
          </div>
          
          <!-- Main Title with Animation -->
          <h1 class="text-5xl md:text-7xl font-black mb-8 leading-tight bg-gradient-to-r from-white via-blue-100 to-purple-100 bg-clip-text text-transparent animate-fade-in">
            Strategic Programs
          </h1>
          
          <!-- Subtitle -->
          <p class="text-xl md:text-2xl text-blue-100 max-w-5xl mx-auto leading-relaxed font-light animate-fade-in-delayed">
            Comprehensive initiatives designed to empower children, strengthen communities, 
            and create lasting transformational change across Cambodia
          </p>
          
          <!-- Decorative Line -->
          <div class="mt-8 flex justify-center">
            <div class="w-24 h-1 bg-gradient-to-r from-transparent via-white to-transparent rounded-full"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Enhanced Grid Section -->
    <div class="relative py-20">
      <!-- Section Introduction with Better Styling -->
      <div class="text-center mb-20">
        <div class="inline-block mb-4">
          <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent text-lg font-bold tracking-wide uppercase">
            Transforming Lives
          </span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8 leading-tight">
          Education That <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Empowers</span>
        </h2>
        <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed font-light">
          Each program represents our unwavering commitment to creating sustainable change and empowering 
          communities across five provinces in Cambodia through innovative educational approaches
        </p>
        
        <!-- Progress Indicator -->
        <div class="mt-12 flex justify-center">
          <div class="flex space-x-2">
            <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
            <div class="w-3 h-3 bg-purple-500 rounded-full animate-pulse delay-200"></div>
            <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse delay-400"></div>
          </div>
        </div>
      </div>

      <div class="container mx-auto px-6 md:px-12 lg:px-16 relative">
        <!-- Enhanced Grid with Staggered Animation -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-16 px-4 md:px-8">
          <div
            v-for="(program, idx) in programs"
            :key="idx"
            class="group transform hover:-translate-y-4 transition-all duration-700 animate-slide-up"
            :style="{ animationDelay: `${idx * 200}ms` }"
          >
            <!-- Enhanced Card Wrapper with Multiple Effects -->
            <div class="relative">
              <!-- Multiple Gradient Backgrounds -->
              <div :class="[
                'absolute -inset-4 rounded-3xl opacity-0 group-hover:opacity-100 transition-all duration-700 blur-2xl',
                program.gradientBg
              ]"></div>
              
              <div :class="[
                'absolute -inset-2 rounded-3xl opacity-0 group-hover:opacity-50 transition-all duration-500 blur-xl',
                program.gradientBg
              ]"></div>
              
              <!-- Card Component with Enhanced Styling -->
              <Card
                :title="program.title"
                :goal="program.goal"
                :justification="program.justification"
                :image="program.image"
                :class="[
                  'flex flex-col h-full relative z-10 bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl group-hover:shadow-2xl transition-all duration-700 border border-gray-200/50 group-hover:border-gray-300/50 overflow-hidden group-hover:bg-white',
                  program.hoverEffect
                ]"
              />
              
              <!-- Enhanced Program Badge -->
              <div :class="[
                'absolute top-6 right-6 z-20 px-4 py-2 rounded-full text-xs font-bold text-white shadow-xl backdrop-blur-sm border border-white/20 transform group-hover:scale-110 transition-all duration-300',
                program.badge
              ]">
                <span class="flex items-center gap-2">
                  <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                  Program {{ idx + 1 }}
                </span>
              </div>
              
              <!-- Corner Accent -->
              <div :class="[
                'absolute bottom-6 left-6 z-20 w-8 h-8 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-110',
                program.accentColor
              ]"></div>
            </div>
          </div>
        </div>

        <!-- Enhanced Bottom Section -->
        <div class="mt-32 text-center">
          <div class="bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900 rounded-3xl p-16 md:p-20 text-white relative overflow-hidden shadow-2xl border border-gray-800">
            <!-- Enhanced Background Pattern -->
            <div class="absolute inset-0 opacity-10">
              <div class="absolute top-0 right-0 w-80 h-80 bg-gradient-to-br from-white to-blue-200 rounded-full transform translate-x-40 -translate-y-40 animate-spin-slow"></div>
              <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-br from-white to-purple-200 rounded-full transform -translate-x-32 translate-y-32 animate-spin-reverse"></div>
              <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-blue-300/20 to-purple-300/20 rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative z-10">
              <!-- Enhanced Title -->
              <div class="mb-8">
                <span class="inline-block bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold tracking-wide uppercase mb-4 border border-white/20">
                  Impact & Vision
                </span>
                <h3 class="text-4xl md:text-5xl font-black mb-6 bg-gradient-to-r from-white via-blue-100 to-purple-100 bg-clip-text text-transparent">
                  Building Cambodia's Future Together
                </h3>
              </div>
              
              <p class="text-xl md:text-2xl text-blue-100 mb-12 max-w-4xl mx-auto leading-relaxed font-light">
                Our strategic programs work in perfect harmony to create comprehensive support systems 
                that nurture children from early childhood through their complete educational journey
              </p>
              
              <!-- Enhanced Stats Grid -->
              <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-16">
                <div 
                  v-for="(stat, index) in stats" 
                  :key="index"
                  class="text-center group transform hover:scale-105 transition-all duration-300"
                >
                  <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 group-hover:bg-white/20 transition-all duration-300">
                    <div class="text-4xl md:text-5xl font-black text-white mb-3 group-hover:text-blue-100 transition-colors duration-300">
                      {{ stat.number }}
                    </div>
                    <div class="text-blue-200 text-sm font-medium uppercase tracking-wide">
                      {{ stat.label }}
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Call to Action Buttons -->
              <div class="mt-16 flex flex-col sm:flex-row gap-6 justify-center">
                <button class="bg-white text-gray-900 px-8 py-4 rounded-full font-bold text-lg hover:bg-blue-50 transform hover:scale-105 transition-all duration-300 shadow-xl">
                  Support Our Mission
                </button>
                <button class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-gray-900 transform hover:scale-105 transition-all duration-300">
                  Learn More
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Card from '../components/CardProgram.vue'

const programs = [
  {
    title: 'COUNTRY GOAL of Bandos Komar',
    goal: 'By 2019, children and youths enjoy the full potential of their rights and live with dignity, becoming empowered individuals who contribute meaningfully to sustainable social and the nation.',
    justification: [
      'To enable children and youths to exercise their rights with dignity, it is essential to provide them with quality and equitable education so that they become agent of change of their society and they deal with confidence with emerging challenges in their lives after the school.',
      'In other words, Bandos Komar is engaged to nurture and build up human capital to tackle changes that will impact on human\'s livelihoods.',
    ],
    image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyEa-i-q-ni2CFVcG89ltLTBMcB-h8zi9Ahg&s',
    gradientBg: 'bg-gradient-to-br from-blue-400 to-purple-600',
    badge: 'bg-gradient-to-r from-blue-500 to-blue-700',
    hoverEffect: 'group-hover:bg-blue-50/50',
    accentColor: 'bg-blue-500'
  },
  {
    title: 'Integrated Early Child Care and Development Programme',
    goal: 'By 2019, children aged below six years old, living in the target areas have full potential and opportunity to carry on their study in primary education level with equity, quality and effectiveness.',
    justification: [
      'All statistical data and empirical data collected by NGOs involved in preschools development and MoEYS, visits to parents, educators, members of committees, and staff of primary schools describe the tremendous positive impact that community preschools have on cognitive, social and motor development of enrolled children aged 3 to 5.',
      'Therefore since 2005, it became clear to IOs, NGOs and MoEYS that the scale-up of community preschools are an effective alternative for the development of young children in Cambodia and probably elsewhere.',
      'Benefits of community preschools identified by parents and local authorities are numerous, ranging from self-confidence, sensitization and practice of basic hygiene, nutrition improvement, to good preparation to socialization in the primary school.',
      'Often perceived as non-formal education for rural children, community preschools actually offer in most remote places unprecedented opportunities for young children to enjoy equitable rights to education.',
    ],
    image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrx0iNsmyejyqzo9Vvm4ji60oizWSDnf6mDQ&s',
    gradientBg: 'bg-gradient-to-br from-emerald-400 to-teal-600',
    badge: 'bg-gradient-to-r from-emerald-500 to-emerald-700',
    hoverEffect: 'group-hover:bg-emerald-50/50',
    accentColor: 'bg-emerald-500'
  },
  {
    title: 'Integrated Quality Primary Education Programme',
    goal: 'By 2019, children and youths living in the target areas acquire knowledge, skills, confidence, sense of entrepreneurship and perseverance in the national and regional context.',
    justification: [
      'In the context of recent regional economic integration of Cambodia, challenges ahead for youths are huge in terms of employment and economic opportunities.',
      'School remains an avoidable instrument of skills provision and sense of entrepreneurship strengthening to turn challenges into opportunities.',
      'By strengthening education quality, adapting life skills to market needs and developing confidence to children and youths, Bandos Komar ambitions to prepare them to harsh competition and highly selective labor market.',
      'Five key strategies will back up this programme such as:',
      'Strengthening capacity of local partners including awareness raising on respect and enforcement of child rights, enhancing quality of parents education, increasing pedagogical skills of teachers and supplying teaching materials, sensitizing the commune council on impact of community preschools for ECCD.',
      'Improving nutrition of early children inspired from UNICEF and World Food Program models combining preschool and home-based parent education.',
      'Upgrading water, sanitation and hygiene infrastructure and education at preschools and homes.',
      'Improving community\'s health through hygiene education, health center access, prevention like hand washing, de-worming, growth tracking.',
      'Partnerships with stakeholders and networks at national and sub-national levels such as MEDICAM, NEP, child rights platform, Plan International, UNICEF.',
      'Strengthening and scaling-up Child Friendly Schools including promotion, leadership capacity, child protection awareness, nutrition improvements.',
      'Improving reproductive health knowledge through curriculum, posters, books, and teaching materials.',
      'Promoting life skills and entrepreneurship in school and community.',
      'Mainstreaming resilience and natural disaster/climate change education with supporting materials.',
      'Continuing partnerships with relevant stakeholders to sharpen action and update good practices.',
    ],
    image: 'https://www.unicef.org/cambodia/sites/unicef.org.cambodia/files/styles/media_banner/public/2019-04/children-in-cambodia-1.jpg.webp?itok=lDq1PIS_',
    gradientBg: 'bg-gradient-to-br from-orange-400 to-red-600',
    badge: 'bg-gradient-to-r from-orange-500 to-orange-700',
    hoverEffect: 'group-hover:bg-orange-50/50',
    accentColor: 'bg-orange-500'
  },
]

const stats = [
  { number: '2019', label: 'Target Year' },
  { number: '5', label: 'Provinces' },
  { number: '1000+', label: 'Children' },
  { number: '34+', label: 'Years Impact' }
]
</script>

<style scoped>
@keyframes float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(-20px) rotate(5deg); }
}

@keyframes float-delayed {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(-15px) rotate(-3deg); }
}

@keyframes pulse-slow {
  0%, 100% { opacity: 0.3; transform: scale(1); }
  50% { opacity: 0.6; transform: scale(1.05); }
}

@keyframes spin-slow {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

@keyframes spin-reverse {
  from { transform: rotate(360deg); }
  to { transform: rotate(0deg); }
}

@keyframes fade-in {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes fade-in-delayed {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes slide-up {
  from { opacity: 0; transform: translateY(50px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-float {
  animation: float 6s ease-in-out infinite;
}

.animate-float-delayed {
  animation: float-delayed 8s ease-in-out infinite;
}

.animate-pulse-slow {
  animation: pulse-slow 4s ease-in-out infinite;
}

.animate-spin-slow {
  animation: spin-slow 20s linear infinite;
}

.animate-spin-reverse {
  animation: spin-reverse 25s linear infinite;
}

.animate-fade-in {
  animation: fade-in 1s ease-out forwards;
}

.animate-fade-in-delayed {
  animation: fade-in-delayed 1s ease-out 0.3s forwards;
  opacity: 0;
}

.animate-slide-up {
  animation: slide-up 0.8s ease-out forwards;
  opacity: 0;
}

.delay-200 { animation-delay: 200ms; }
.delay-400 { animation-delay: 400ms; }
.delay-500 { animation-delay: 500ms; }
.delay-1000 { animation-delay: 1000ms; }
</style>