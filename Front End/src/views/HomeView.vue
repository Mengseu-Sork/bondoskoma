<template>
  <div class="bg-white bg-gray-50">
    <!-- Welcome Section -->
    <section class="py-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          <div>
            <h2 class="text-4xl font-extrabold text-blue-900 mb-8">
              Welcome to Bandos Komar Association
            </h2>
            <div v-if="loading" class="text-blue-500 text-lg">Loading...</div>
            <div v-else-if="homeData" class="space-y-5 text-gray-700 leading-relaxed text-lg">
              <p>{{ homeData.paragraph1 || 'No paragraph 1 available' }}</p>
              <p>{{ homeData.paragraph2 || 'No paragraph 2 available' }}</p>
            </div>
            <div v-else class="text-red-600 text-lg">No data found. Check API or configuration.</div>
          </div>
          <div class="relative">
            <img
              :src="imageUrl(homeData?.image)"
              alt="Welcome Section Image"
              class="rounded-3xl shadow-2xl w-full h-96 object-cover border-4 border-blue-100"
              @error="onImageError"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Life Skills Section -->
    <section class="py-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
          <div>
            <h2 class="text-4xl font-extrabold text-blue-900 mb-6">Life Skills</h2>
            <p class="text-xl mb-4">
              Our Life Skills program empowers children with practical abilities, confidence, and a sense of responsibility—helping them thrive in their families, communities, and future careers.
            </p>
            <div v-if="lifeSkillsLoading" class="text-blue-500 text-lg">Loading life skills...</div>
            <div v-else-if="lifeSkills.length > 0" class="space-y-6">
              <ul class="list-disc pl-6 space-y-3 text-gray-700">
                <li v-for="(skill, index) in lifeSkills" :key="skill.id" class="text-xl">
                  <span class="font-bold text-blue-700 text-2xl">{{ skill.title || 'Untitled' }}:</span> {{ skill.description || 'No description' }}
                </li>
              </ul>
            </div>
            <div v-else class="text-red-600 text-lg">No life skills found. Check API or configuration.</div>
          </div>
          <div class="flex flex-col gap-6">
            <img
              src="https://www.bandoskomar.org/wp-content/uploads/2020/01/SR-LS-scaled.jpg"
              alt="Life Skill 1"
              class="rounded-3xl shadow-xl w-full h-60 object-cover border-4 border-blue-100"
            />
            <img
              src="https://www.bandoskomar.org/wp-content/uploads/2017/10/agri-farm1-__.jpg"
              alt="Life Skill 2"
              class="rounded-3xl shadow-xl w-full h-60 object-cover border-4 border-blue-100"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Video Section -->
    <section class="py-10 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-4xl font-extrabold text-blue-900 mb-4">Our Videos</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="relative group">
            <iframe
              class="rounded-3xl shadow-2xl w-full h-64 border-4 border-blue-100"
              src="https://www.youtube.com/embed/u-QiVv-DsRo"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
            ></iframe>
          </div>
          <div class="relative group">
            <iframe
              class="rounded-3xl shadow-2xl w-full h-64 border-4 border-blue-100"
              src="https://www.youtube.com/embed/QGs9-x9U2Q8"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
            ></iframe>
          </div>
        </div>
      </div>
    </section>

    <!-- Google Map Embed -->
    <section>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7813.98096032579!2d104.89539253807404!3d11.52517511029406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109514b9c1a2b2d%3A0x891e079bf7d67e7e!2sBondoskomar%20Organization!5e0!3m2!1sen!2skh!4v1720072101076!5m2!1sen!2skh"
        width="100%"
        height="400"
        style="border:0"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
      ></iframe>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import apiInstance from '@/plugin/axios';

// Mock data for testing (remove after API is fixed)
const mockHomeData = {
  paragraph1: 'Welcome to our association dedicated to empowering children through education and support.',
  paragraph2: 'We strive to create a nurturing environment for all our students.',
  image: 'programs/welcome-image.jpg', // Mock image path
};

const mockLifeSkills = [
  { id: 1, title: 'Communication', description: 'Learn to express ideas clearly.' },
  { id: 2, title: 'Teamwork', description: 'Work effectively with others.' },
];

const homeData = ref(null);
const loading = ref(true);
const lifeSkills = ref([]);
const lifeSkillsLoading = ref(true);
const instagramPosts = ref([
  { image: 'https://www.partage-rise.org/wp-content/uploads/2020/07/Children-council-Educate-using-toilet.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/Library.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/sub-banner.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/agri-farm1-__.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/Library.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/agri-farm1-__.jpg' },
]);

// Construct full image URL
const imageUrl = (imagePath) => {
  const baseUrl = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000';
  return imagePath ? `${baseUrl}/storage/${imagePath}` : 'https://via.placeholder.com/150';
};

// Image error handler
const onImageError = (event) => {
  console.error('Image failed to load:', event.target.src);
  event.target.src = 'https://via.placeholder.com/150'; // Fallback image
};

onMounted(async () => {
  // Fetch Home Data
  try {
    console.log("Starting API request to /homes...");
    console.log("VITE_API_URL:", import.meta.env.VITE_API_URL || 'No VITE_API_URL set');
    const response = await apiInstance.get('/homes', {
      timeout: 10000,
    });
    console.log("✅ Home response:", response);
    console.log("✅ Home response data:", response.data);

    // Handle different data structures
    const data = response.data.data || response.data;
    if (data && (Array.isArray(data) ? data.length > 0 : data)) {
      homeData.value = Array.isArray(data) ? data[0] : data;
      console.log("✅ Assigned homeData:", homeData.value);
    } else {
      console.warn("⚠️ No home data found or invalid structure:", data);
      // Fallback to mock data if API fails
      homeData.value = mockHomeData;
    }
  } catch (error) {
    console.error("❌ Error fetching home data:", {
      message: error.message,
      status: error.response?.status,
      data: error.response?.data,
      url: error.config?.url,
    });
    // Fallback to mock data on error
    homeData.value = mockHomeData;
  } finally {
    console.log("Home loading complete, setting loading to false");
    loading.value = false;
  }

  // Fetch Life Skills Data
  try {
    console.log("Starting API request to /lifeskills...");
    console.log("VITE_API_URL:", import.meta.env.VITE_API_URL || 'No VITE_API_URL set');
    const response = await apiInstance.get('/lifeskills', {
      timeout: 10000,
    });
    console.log("✅ LifeSkills response:", response);
    console.log("✅ LifeSkills response data:", response.data);

    // Handle different data structures
    const data = response.data.data || response.data;
    if (data && Array.isArray(data)) {
      lifeSkills.value = data;
      console.log("✅ Assigned lifeSkills:", lifeSkills.value);
    } else {
      console.warn("⚠️ No life skills data found or invalid structure:", data);
      // Fallback to mock data if API fails
      lifeSkills.value = mockLifeSkills;
    }
  } catch (error) {
    console.error("❌ Error fetching life skills data:", {
      message: error.message,
      status: error.response?.status,
      data: error.response?.data,
      url: error.config?.url,
    });
    // Fallback to mock data on error
    lifeSkills.value = mockLifeSkills;
  } finally {
    console.log("LifeSkills loading complete, setting lifeSkillsLoading to false");
    lifeSkillsLoading.value = false;
  }
});
</script>

<style scoped>
.group:hover .group-hover\:scale-105 {
  transform: scale(1.05);
}
.group:hover .group-hover\:opacity-100 {
  opacity: 1;
}
.transition-all {
  transition: all 0.3s ease;
}
</style>