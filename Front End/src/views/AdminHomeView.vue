<template>
  <admin-aside>
    <div :class="['min-h-screen p-6', isCollapsed ? 'ml-16' : '']" v-if="layoutReady" :style="{ transition: 'margin-left 0.3s ease' }">
      <!-- Header with Gradient -->
      <!-- <div class="bg-white p-6 rounded-lg mb-6 shadow-lg border border-gray-100">
        <h1 class="text-3xl font-bold tracking-wide text-gray-900">Admin Dashboard</h1>
        <p class="text-gray-600 mt-1">Manage Home and Lifeskills</p>
      </div>
       -->
      <!-- Notification Area -->
      <div v-if="notification.message" class="mb-4 p-4 rounded-lg transition-all duration-300"
           :class="notification.type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
        <div class="flex items-center">
          <svg v-if="notification.type === 'success'" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 13l4 4L19 7" />
          </svg>
          <svg v-else class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
          <span>{{ notification.message }}</span>
        </div>
      </div>
      
      <!-- Dropdown and Create Button -->
      <div class="mb-6 flex items-center justify-between">
        <div class="relative w-56">
          <select
            v-model="activeTab"
            class="w-full px-4 py-2 border-none rounded-lg bg-white text-gray-800 font-medium shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-300 appearance-none"
          >
            <option value="home" class="bg-white text-gray-800">Home</option>
            <option value="lifeskills" class="bg-white text-gray-800">Life Skills</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
        </div>
        <button
          @click="openCreateModal"
          class="px-6 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 animate-pulse-slow"
        >
          <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 4v16m8-8H4" />
          </svg>
          Create New
        </button>
      </div>
      
      <!-- Enhanced Table Card -->
      <div class="bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b border-gray-200">
          <h2 class="text-2xl font-bold text-gray-800 flex items-center">
            <div class="w-1 h-8 bg-blue-500 rounded-full mr-3"></div>
            {{ activeTab === 'home' ? 'Home Content Management' : 'Life Skills Management' }}
          </h2>
          <p class="text-gray-600 mt-1">{{ items.length }} {{ items.length === 1 ? 'item' : 'items' }} total</p>
        </div>
        
        <div v-if="loading" class="text-blue-600 text-lg flex items-center justify-center py-12">
          <svg class="w-8 h-8 mr-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
          </svg>
          Loading data...
        </div>
        
        <div v-else-if="items.length === 0" class="text-center py-12">
          <div class="text-gray-400 mb-4">
            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
          </div>
          <p class="text-gray-500 text-lg font-medium">No items found</p>
          <p class="text-gray-400 text-sm mt-1">Create your first {{ activeTab === 'home' ? 'home content' : 'life skill' }} item</p>
        </div>
        
        <div v-else class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200">
              <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-20">
                  #ID
                </th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-32">
                  Image
                </th>
                <th v-if="activeTab === 'home'" 
                    class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors" 
                    @click="sort('paragraph1')">
                  <div class="flex items-center">
                    Paragraph 1
                    <svg class="w-4 h-4 ml-1" :class="{ 'text-blue-500': sortKey === 'paragraph1' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" :d="sortKey === 'paragraph1' && sortOrder === 'desc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7'" />
                    </svg>
                  </div>
                </th>
                <th v-if="activeTab === 'home'" 
                    class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors" 
                    @click="sort('paragraph2')">
                  <div class="flex items-center">
                    Paragraph 2
                    <svg class="w-4 h-4 ml-1" :class="{ 'text-blue-500': sortKey === 'paragraph2' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" :d="sortKey === 'paragraph2' && sortOrder === 'desc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7'" />
                    </svg>
                  </div>
                </th>
                <th v-if="activeTab === 'lifeskills'" 
                    class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors" 
                    @click="sort('title')">
                  <div class="flex items-center">
                    Title
                    <svg class="w-4 h-4 ml-1" :class="{ 'text-blue-500': sortKey === 'title' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" :d="sortKey === 'title' && sortOrder === 'desc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7'" />
                    </svg>
                  </div>
                </th>
                <th v-if="activeTab === 'lifeskills'" 
                    class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors" 
                    @click="sort('description')">
                  <div class="flex items-center">
                    Description
                    <svg class="w-4 h-4 ml-1" :class="{ 'text-blue-500': sortKey === 'description' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" :d="sortKey === 'description' && sortOrder === 'desc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7'" />
                    </svg>
                  </div>
                </th>
                <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-32">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(item, index) in sortedItems" 
                  :key="item.id" 
                  class="hover:bg-blue-50 transition-all duration-200 group"
                  :class="{ 'bg-gray-50': index % 2 === 1 }">
                
                <!-- ID Column -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                      <span class="text-blue-600 font-bold text-sm">{{ item.id }}</span>
                    </div>
                  </div>
                </td>
                
                <!-- Image Column (moved to second position) -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="relative group">
                    <img 
                      :src="imageUrl(item.image)" 
                      alt="Item Image" 
                      class="w-20 h-20 object-cover rounded-lg shadow-md border-2 border-gray-200 group-hover:border-blue-300 transition-all duration-200" 
                      @error="onImageError" 
                    />
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-lg transition-all duration-200 flex items-center justify-center">
                      <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                    </div>
                  </div>
                </td>
                
                <!-- Content Columns -->
                <td v-if="activeTab === 'home'" class="px-6 py-4">
                  <div class="max-w-xs">
                    <p class="text-sm text-gray-900 font-medium leading-relaxed line-clamp-3">
                      {{ item.paragraph1 || 'N/A' }}
                    </p>
                  </div>
                </td>
                
                <td v-if="activeTab === 'home'" class="px-6 py-4">
                  <div class="max-w-xs">
                    <p class="text-sm text-gray-900 font-medium leading-relaxed line-clamp-3">
                      {{ item.paragraph2 || 'N/A' }}
                    </p>
                  </div>
                </td>
                
                <td v-if="activeTab === 'lifeskills'" class="px-6 py-4">
                  <div class="max-w-xs">
                    <h3 class="text-sm font-bold text-gray-900 mb-1">{{ item.title || 'N/A' }}</h3>
                  </div>
                </td>
                
                <td v-if="activeTab === 'lifeskills'" class="px-6 py-4">
                  <div class="max-w-xs">
                    <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                      {{ truncateText(item.description, 100) || 'N/A' }}
                    </p>
                  </div>
                </td>
                
                <!-- Actions Column -->
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <div class="flex items-center justify-center space-x-2">
                    <button 
                      @click="editItem(item)" 
                      class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white text-xs font-bold rounded-lg hover:from-yellow-500 hover:to-yellow-600 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg"
                    >
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                      Edit
                    </button>
                    <button 
                      @click="deleteItem(item.id)" 
                      class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-bold rounded-lg hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg" 
                      :disabled="loading"
                    >
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                      Delete
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      <!-- Modal for Create/Update -->
      <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
          <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ isEditing ? 'Edit' : 'Create' }} {{ activeTab === 'home' ? 'Home Content' : 'Life Skill' }}</h2>
          <form @submit.prevent="handleSubmit" class="space-y-4" enctype="multipart/form-data">
            <div v-if="activeTab === 'home'">
              <label class="block text-sm font-medium text-gray-700">Paragraph 1</label>
              <textarea
                v-model="formData.paragraph1"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                rows="4"
                required
              ></textarea>
              <label class="block text-sm font-medium text-gray-700 mt-3">Paragraph 2</label>
              <textarea
                v-model="formData.paragraph2"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                rows="4"
                required
              ></textarea>
              <label class="block text-sm font-medium text-gray-700 mt-3">Image</label>
              <input
                type="file"
                @change="handleImageUpload"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                accept="image/*"
              />
              <img v-if="formData.imagePreview" :src="formData.imagePreview" alt="Preview" class="w-32 h-32 object-cover mt-2 rounded" />
            </div>
            <div v-if="activeTab === 'lifeskills'">
              <label class="block text-sm font-medium text-gray-700">Title</label>
              <input
                v-model="formData.title"
                type="text"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                required
              />
              <label class="block text-sm font-medium text-gray-700 mt-3">Description</label>
              <textarea
                v-model="formData.description"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                rows="4"
                required
              ></textarea>
              <label class="block text-sm font-medium text-gray-700 mt-3">Image</label>
              <input
                type="file"
                @change="handleImageUpload"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                accept="image/*"
              />
              <img v-if="formData.imagePreview" :src="formData.imagePreview" alt="Preview" class="w-32 h-32 object-cover mt-2 rounded" />
            </div>
            <div class="flex justify-end space-x-3">
              <button
                type="button"
                @click="closeModal"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-200"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200"
                :disabled="loading"
              >
                {{ isEditing ? 'Update' : 'Create' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </admin-aside>
</template>

<script setup>
import { ref, onMounted, watch, computed } from 'vue';
import apiInstance from '@/plugin/axios';
import AdminAside from '../components/AdminAside.vue';

const activeTab = ref('home');
const items = ref([]);
const loading = ref(false);
const layoutReady = ref(false);
const sortKey = ref('');
const sortOrder = ref('asc');
const showModal = ref(false);
const isEditing = ref(false);
const formData = ref({
  id: null,
  paragraph1: '',
  paragraph2: '',
  title: '',
  description: '',
  image: '',
  imagePreview: ''
});
const notification = ref({
  message: '',
  type: ''
});

const isCollapsed = computed(() => {
  return localStorage.getItem('sidebarCollapsed') === 'true';
});

const sortedItems = computed(() => {
  if (!sortKey.value) return [...items.value];
  return [...items.value].sort((a, b) => {
    const aValue = a[sortKey.value]?.toString() || '';
    const bValue = b[sortKey.value]?.toString() || '';
    return sortOrder.value === 'asc' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
  });
});

const truncateText = (text, maxLength) => {
  if (!text || text.length <= maxLength) return text || 'N/A';
  return text.slice(0, maxLength) + '...';
};

const sort = (key) => {
  if (sortKey.value === key) {
    sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc';
  } else {
    sortKey.value = key;
    sortOrder.value = 'asc';
  }
};

const imageUrl = (imagePath) => {
  const baseUrl = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000';
  return imagePath ? `${baseUrl}/storage/${imagePath}` : 'https://via.placeholder.com/150';
};

const onImageError = (event) => {
  console.error('Image failed to load:', event.target.src);
  event.target.src = 'https://via.placeholder.com/150';
};

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    formData.value.image = file;
    formData.value.imagePreview = URL.createObjectURL(file);
  }
};

const fetchItems = async () => {
  loading.value = true;
  try {
    const endpoint = activeTab.value === 'home' ? '/homes' : '/lifeskills';
    const response = await apiInstance.get(endpoint, { timeout: 10000 });
    console.log(`API Response for ${endpoint}:`, response.data);
    items.value = response.data.data || response.data || [];
    if (items.value.length === 0) {
      showNotification('error', `No ${activeTab.value === 'home' ? 'Home content' : 'Life Skills'} found.`);
    } else {
      showNotification('success', `${activeTab.value === 'home' ? 'Home content' : 'Life Skills'} loaded successfully`);
    }
  } catch (error) {
    console.error(`Error fetching ${activeTab.value} data:`, error.response || error);
    showNotification('error', `Error fetching ${activeTab.value === 'home' ? 'Home content' : 'Life Skills'} data: ${error.response?.data?.message || error.message}`);
  } finally {
    loading.value = false;
  }
};

const openCreateModal = () => {
  isEditing.value = false;
  formData.value = { id: null, paragraph1: '', paragraph2: '', title: '', description: '', image: '', imagePreview: '' };
  showModal.value = true;
};

const editItem = (item) => {
  isEditing.value = true;
  formData.value = { ...item, imagePreview: item.image ? imageUrl(item.image) : '' };
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
  formData.value = { id: null, paragraph1: '', paragraph2: '', title: '', description: '', image: '', imagePreview: '' };
};

const handleSubmit = async () => {
  loading.value = true;
  try {
    const endpoint = activeTab.value === 'home' ? '/homes' : '/lifeskills';
    const method = isEditing.value ? 'put' : 'post';
    const url = isEditing.value ? `${endpoint}/${formData.value.id}` : endpoint;
    const payload = new FormData();
    if (activeTab.value === 'home') {
      payload.append('paragraph1', formData.value.paragraph1);
      payload.append('paragraph2', formData.value.paragraph2);
    } else {
      payload.append('title', formData.value.title);
      payload.append('description', formData.value.description);
    }
    if (formData.value.image instanceof File) {
      payload.append('image', formData.value.image);
    }
    const response = await apiInstance[method](url, payload, {
      headers: { 'Content-Type': 'multipart/form-data' }
    });
    console.log(`Submit Response for ${method} ${url}:`, response.data);
    await fetchItems();
    closeModal();
    showNotification('success', `${activeTab.value === 'home' ? 'Home content' : 'Life Skill'} ${isEditing.value ? 'updated' : 'created'} successfully`);
  } catch (error) {
    console.error(`Error ${isEditing.value ? 'updating' : 'creating'} ${activeTab.value}:`, error.response || error);
    showNotification('error', `Error ${isEditing.value ? 'updating' : 'creating'} ${activeTab.value === 'home' ? 'Home content' : 'Life Skill'}: ${error.response?.data?.message || error.message}`);
  } finally {
    loading.value = false;
  }
};

const deleteItem = async (id) => {
  if (confirm(`Are you sure you want to delete this ${activeTab.value === 'home' ? 'Home content' : 'Life Skill'} item?`)) {
    loading.value = true;
    try {
      const endpoint = activeTab.value === 'home' ? '/homes' : '/lifeskills';
      const response = await apiInstance.delete(`${endpoint}/${id}`);
      console.log(`Delete Response for ${endpoint}/${id}:`, response.data);
      await fetchItems();
      showNotification('success', `${activeTab.value === 'home' ? 'Home content' : 'Life Skill'} deleted successfully`);
    } catch (error) {
      console.error(`Error deleting ${activeTab.value} item:`, error.response || error);
      showNotification('error', `Error deleting ${activeTab.value === 'home' ? 'Home content' : 'Life Skill'} item: ${error.response?.data?.message || error.message}`);
    } finally {
      loading.value = false;
    }
  }
};

const showNotification = (type, message) => {
  notification.value = { type, message };
  setTimeout(() => {
    notification.value = { message: '', type: '' };
  }, 3000);
};

onMounted(() => {
  fetchItems();
  layoutReady.value = true;
});

watch(activeTab, () => {
  fetchItems();
  sortKey.value = '';
  sortOrder.value = 'asc';
});
</script>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.5s ease-in;
}

.animate-pulse-slow {
  animation: pulse 2s infinite;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Custom scrollbar for table */
.overflow-x-auto::-webkit-scrollbar {
  height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}
</style>