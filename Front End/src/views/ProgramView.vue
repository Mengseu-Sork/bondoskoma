<template>
  <div class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-indigo-200">
    <!-- Main Content -->
    <main class="min-h-screen bg-white">
      <!-- Programs Section -->
      <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <h2 class="text-5xl font-extrabold text-center mb-16 text-gray-900 tracking-wide animate-fade-in">OUR PROGRAMS FOR CHILDREN</h2>

          <div v-if="programsLoading" class="text-indigo-600 text-xl text-center py-6 flex items-center justify-center">
            <svg class="w-6 h-6 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
            </svg>
            Loading programs...
          </div>
          <div v-else-if="programs.length === 0" class="text-red-600 text-xl text-center py-6">No programs found. Please try again later.</div>
          <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-for="program in programs" :key="program.id" class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
              <div class="relative h-64 overflow-hidden">
                <img :src="imageUrl(program.image)" alt="Program Image" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" @error="onImageError">
                <button @click="donateNow(program)" class="absolute top-4 right-4 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition-all duration-200 shadow-md">DONATE NOW</button>
              </div>
              <div class="p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 line-clamp-2">{{ program.title }}</h3>
                <p class="text-gray-600 mb-6 leading-relaxed line-clamp-3">{{ truncateText(program.description, 120) }}</p>
                <button @click="openModal(program)" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-sm hover:shadow-md">VIEW DETAILS</button>
              </div>
            </div>
          </div>
          <div v-if="programs.length > 0" class="text-center mt-12">
            <button @click="loadMorePrograms" class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-10 py-4 rounded-lg font-semibold text-lg transition-all duration-200 shadow-md hover:shadow-lg">LOAD MORE PROGRAMS</button>
          </div>
        </div>
      </section>

      <!-- Strategies Section -->
      <section class="py-24 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center mb-16">
            <h2 class="text-5xl md:text-6xl font-extrabold text-gray-900 mb-4 animate-fade-in">Our Key Strategies</h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto animate-fade-in-delay">Comprehensive approaches to early childhood development and primary education enhancement</p>
          </div>

          <div v-if="strategiesLoading" class="text-indigo-600 text-xl text-center py-6 flex items-center justify-center">
            <svg class="w-6 h-6 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
            </svg>
            Loading strategies...
          </div>
          <div v-else-if="strategies.length === 0" class="text-red-600 text-xl text-center py-6">No strategies found. Please try again later.</div>
          <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div v-for="strategy in strategies" :key="strategy.id" class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group border border-gray-100">
              <div class="relative h-56 overflow-hidden">
                <img :src="imageUrl(strategy.image)" alt="Strategy Image" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" @error="onImageError">
              </div>
              <div class="p-5">
                <h4 class="text-xl font-semibold text-gray-800 mb-3 line-clamp-2">{{ strategy.title }}</h4>
                <p class="text-gray-600 line-clamp-3">{{ truncateText(strategy.description, 120) }}</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Enhancements Section -->
      <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <h2 class="text-5xl font-extrabold text-center mb-16 text-gray-900 animate-fade-in">Expected Impact</h2>

          <div v-if="enhancementsLoading" class="text-indigo-600 text-xl text-center py-6 flex items-center justify-center">
            <svg class="w-6 h-6 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
            </svg>
            Loading enhancements...
          </div>
          <div v-else-if="enhancements.length === 0" class="text-red-600 text-xl text-center py-6">No enhancements found. Please try again later.</div>
          <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-for="enhancement in enhancements" :key="enhancement.id" class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
              <h4 class="text-2xl font-semibold mb-4 text-gray-800 line-clamp-2">{{ enhancement.title }}</h4>
              <p class="text-gray-600 mb-6 leading-relaxed line-clamp-3">{{ truncateText(enhancement.description, 120) }}</p>
              <img :src="imageUrl(enhancement.image)" alt="Enhancement Image" class="w-full h-48 object-cover rounded-lg mb-4 transition-transform duration-300 hover:scale-105" @error="onImageError">
            </div>
          </div>
        </div>
      </section>

      <!-- Impact Section -->
      <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-8">
          <h2 class="text-5xl font-extrabold text-center mb-16 text-gray-900 animate-fade-in">Our Impact at a Glance</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 text-center shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300">
              <div class="text-5xl font-bold mb-4 text-indigo-600">2019</div>
              <h4 class="text-xl font-semibold mb-4 text-gray-800">Target Year</h4>
              <p class="leading-relaxed text-gray-600">Full implementation of all programs by 2019</p>
            </div>
            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 text-center shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300">
              <div class="text-5xl font-bold mb-4 text-indigo-600">6</div>
              <h4 class="text-xl font-semibold mb-4 text-gray-800">Age Focus</h4>
              <p class="leading-relaxed text-gray-600">Children below 6 years old in target areas</p>
            </div>
            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 text-center shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300">
              <div class="text-5xl font-bold mb-4 text-indigo-600">100%</div>
              <h4 class="text-xl font-semibold mb-4 text-gray-800">Coverage Goal</h4>
              <p class="leading-relaxed text-gray-600">Full potential and opportunity for all children</p>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Program Details Modal -->
    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-4" @click.self="closeModal">
      <div class="bg-white rounded-2xl max-w-5xl w-full max-h-[90vh] overflow-y-auto shadow-2xl" @click.stop>
        <div v-if="selectedProgram" class="relative">
          <!-- Modal Header -->
          <div class="relative">
            <img :src="imageUrl(selectedProgram.image)" :alt="selectedProgram.title" class="w-full h-72 object-cover rounded-t-2xl" @error="onImageError">
            <button @click="closeModal" class="absolute top-6 right-6 bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-800 w-12 h-12 rounded-full flex items-center justify-center transition-all duration-200 shadow-md hover:shadow-lg">✕</button>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
              <h2 class="text-4xl font-extrabold text-white">{{ selectedProgram.title }}</h2>
            </div>
          </div>

          <!-- Modal Content -->
          <div class="p-8">
            <!-- Description -->
            <div class="mb-8">
              <h3 class="text-2xl font-bold text-gray-900 mb-4">About This Program</h3>
              <p class="text-gray-700 leading-relaxed text-lg">{{ selectedProgram.description }}</p>
            </div>

            <!-- Goals (if available) -->
            <div v-if="selectedProgram.goals" class="mb-8">
              <h3 class="text-2xl font-bold text-gray-900 mb-4">Program Goals</h3>
              <ul class="space-y-3">
                <li v-for="(goal, index) in selectedProgram.goals" :key="index" class="flex items-start text-gray-700">
                  <span class="text-teal-500 mr-3 mt-1">✓</span>
                  <span>{{ goal }}</span>
                </li>
              </ul>
            </div>

            <!-- Impact Statistics -->
            <div v-if="selectedProgram.impact" class="mb-8">
              <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Impact</h3>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-teal-50 p-6 rounded-xl text-center">
                  <div class="text-3xl font-bold text-teal-600 mb-2">{{ selectedProgram.impact.beneficiaries }}</div>
                  <div class="text-gray-700">Beneficiaries</div>
                </div>
                <div class="bg-yellow-50 p-6 rounded-xl text-center">
                  <div class="text-3xl font-bold text-yellow-600 mb-2">{{ selectedProgram.impact.communities }}</div>
                  <div class="text-gray-700">Communities</div>
                </div>
                <div class="bg-green-50 p-6 rounded-xl text-center">
                  <div class="text-3xl font-bold text-green-600 mb-2">{{ selectedProgram.impact.successRate }}</div>
                  <div class="text-gray-700">Success Rate</div>
                </div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-6 pt-8 border-t border-gray-200">
              <button @click="donateNow(selectedProgram)" class="flex-1 bg-teal-500 hover:bg-teal-600 text-white px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-200 shadow-md hover:shadow-lg">DONATE NOW</button>
              <button @click="learnMore(selectedProgram)" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-200 shadow-md hover:shadow-lg">LEARN MORE</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import apiInstance from '@/plugin/axios';

// Mock data for testing (remove after API is fixed)
const mockPrograms = [
  { id: 1, title: 'Help to Mothers', description: 'Supporting mothers with essential resources and education to empower their families.', image: 'programs/BbfGNAmIaGTvd5hZCwXcqDfAkhpMkPAfLOPEz8ep.jpg', goals: ['Improve maternal health', 'Provide training'], impact: { beneficiaries: '2,500+', communities: '15', successRate: '85%' } },
  { id: 2, title: 'Child Support', description: 'Comprehensive support for vulnerable children including nutrition and healthcare.', image: 'programs/sample-image.jpg', goals: ['Ensure nutrition', 'Provide healthcare'], impact: { beneficiaries: '5,000+', communities: '25', successRate: '92%' } },
  { id: 3, title: 'New School', description: 'Building modern schools in underserved areas for quality education.', image: 'programs/another-image.jpg', goals: ['Build schools', 'Train teachers'], impact: { beneficiaries: '3,200+', communities: '8', successRate: '95%' } },
];

const mockStrategies = [
  { id: 1, title: 'Strengthening Local Partners', description: 'Enhancing capacity through child rights and parent education.', image: 'programs/partner-image.jpg' },
  { id: 2, title: 'Improving Child Nutrition', description: 'Addressing malnutrition with integrated school meals programs.', image: 'programs/nutrition-image.jpg' },
];

const mockEnhancements = [
  { id: 1, title: 'Child-Friendly Schools', description: 'Creating inclusive and safe learning environments.', image: 'programs/school-image.jpg' },
  { id: 2, title: 'Water & Sanitation', description: 'Providing clean water and hygiene facilities.', image: 'programs/water-image.jpg' },
];

const programs = ref([]);
const programsLoading = ref(true);
const strategies = ref([]);
const strategiesLoading = ref(true);
const enhancements = ref([]);
const enhancementsLoading = ref(true);
const showModal = ref(false);
const selectedProgram = ref(null);
const visiblePrograms = ref(3); // Initial number of programs to show

// Truncate text function
const truncateText = (text, maxLength) => {
  if (text.length <= maxLength) return text;
  return text.slice(0, maxLength) + '...';
};

// Construct full image URL
const imageUrl = (imagePath) => {
  const baseUrl = 'http://127.0.0.1:8000';
  return imagePath ? `${baseUrl}/storage/${imagePath}` : 'https://via.placeholder.com/150';
};

// Image error handler
const onImageError = (event) => {
  console.error('Image failed to load:', event.target.src);
  event.target.src = 'https://via.placeholder.com/150'; // Fallback image
};

// Fetch data functions
const fetchPrograms = async () => {
  programsLoading.value = true;
  try {
    const response = await apiInstance.get('/programs', { timeout: 10000 });
    console.log('Programs response:', response.data); // Debug API response
    const data = response.data.data || response.data;
    if (data && Array.isArray(data)) {
      programs.value = data.map(item => ({
        id: item.id || Date.now() + Math.random(),
        title: item.title || 'Untitled',
        description: item.description || 'No description',
        image: item.image || 'https://via.placeholder.com/150',
        goals: item.goals || [],
        impact: item.impact || {}
      }));
    } else {
      programs.value = mockPrograms;
    }
  } catch (error) {
    console.error('Error fetching programs:', error);
    programs.value = mockPrograms;
  } finally {
    programsLoading.value = false;
  }
};

const fetchStrategies = async () => {
  strategiesLoading.value = true;
  try {
    const response = await apiInstance.get('/strategies', { timeout: 10000 });
    console.log('Strategies response:', response.data); // Debug API response
    const data = response.data.data || response.data;
    if (data && Array.isArray(data)) {
      strategies.value = data.map(item => ({
        id: item.id || Date.now() + Math.random(),
        title: item.title || 'Untitled',
        description: item.description || 'No description',
        image: item.image || 'https://via.placeholder.com/150'
      }));
    } else {
      strategies.value = mockStrategies;
    }
  } catch (error) {
    console.error('Error fetching strategies:', error);
    strategies.value = mockStrategies;
  } finally {
    strategiesLoading.value = false;
  }
};

const fetchEnhancements = async () => {
  enhancementsLoading.value = true;
  try {
    const response = await apiInstance.get('/enhancements', { timeout: 10000 });
    console.log('Enhancements response:', response.data); // Debug API response
    const data = response.data.data || response.data;
    if (data && Array.isArray(data)) {
      enhancements.value = data.map(item => ({
        id: item.id || Date.now() + Math.random(),
        title: item.title || 'Untitled',
        description: item.description || 'No description',
        image: item.image || 'https://via.placeholder.com/150'
      }));
    } else {
      enhancements.value = mockEnhancements;
    }
  } catch (error) {
    console.error('Error fetching enhancements:', error);
    enhancements.value = mockEnhancements;
  } finally {
    enhancementsLoading.value = false;
  }
};

// Modal and action functions
const openModal = (program) => {
  selectedProgram.value = program;
  showModal.value = true;
  document.body.style.overflow = 'hidden';
};

const closeModal = () => {
  showModal.value = false;
  selectedProgram.value = null;
  document.body.style.overflow = 'auto';
};

const donateNow = (program) => {
  console.log('Donate to:', program.title);
  // Implement donation logic (e.g., redirect to payment page)
};

const learnMore = (program) => {
  console.log('Learn more about:', program.title);
  // Implement learn more logic (e.g., external link or detailed page)
};

const loadMorePrograms = () => {
  visiblePrograms.value += 3;
  if (visiblePrograms.value >= programs.value.length) {
    visiblePrograms.value = programs.value.length;
  }
};

// Animations
const animateFadeIn = {
  animation: 'fadeIn 0.5s ease-in',
};
const animateFadeInDelay = {
  animation: 'fadeIn 0.7s ease-in 0.2s backwards',
};

onMounted(() => {
  fetchPrograms();
  fetchStrategies();
  fetchEnhancements();
});
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.transition-all {
  transition: all 0.3s ease;
}
</style>