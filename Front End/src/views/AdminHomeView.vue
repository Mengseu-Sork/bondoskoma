<template>
  <admin-aside>
    <div :class="['min-h-screen p-6', isCollapsed ? 'ml-16' : '']" v-if="layoutReady" :style="{ transition: 'margin-left 0.3s ease' }">
      <!-- Header with Gradient -->
      <div class="bg-white p-6 rounded-lg mb-6 shadow-lg border border-gray-100">
        <h1 class="text-3xl font-bold tracking-wide text-gray-900">Admin Dashboard</h1>
        <p class="text-gray-600 mt-1">Manage Home and Lifeskills</p>
      </div>

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
      <div class="bg-white p-6 rounded-lg shadow-xl border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b-2 border-blue-200 pb-2">{{ activeTab === 'home' ? 'Home Content' : 'Life Skills' }}</h2>
        <div v-if="loading" class="text-blue-600 text-lg flex items-center justify-center py-4">
          <svg class="w-6 h-6 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
          </svg>
          Loading...
        </div>
        <div v-else-if="items.length === 0" class="text-red-600 text-lg flex items-center justify-center py-4">No items found.</div>
        <div v-else class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-50">
                <th v-if="activeTab === 'home'" class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium cursor-pointer" @click="sort('paragraph1')">
                  Paragraph 1
                  <span class="ml-1">{{ sortKey === 'paragraph1' ? (sortOrder === 'asc' ? '↑' : '↓') : '' }}</span>
                </th>
                <th v-if="activeTab === 'home'" class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium cursor-pointer" @click="sort('paragraph2')">
                  Paragraph 2
                  <span class="ml-1">{{ sortKey === 'paragraph2' ? (sortOrder === 'asc' ? '↑' : '↓') : '' }}</span>
                </th>
                <th v-if="activeTab === 'lifeskills'" class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium cursor-pointer" @click="sort('title')">
                  Title
                  <span class="ml-1">{{ sortKey === 'title' ? (sortOrder === 'asc' ? '↑' : '↓') : '' }}</span>
                </th>
                <th v-if="activeTab === 'lifeskills'" class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium cursor-pointer" @click="sort('description')">
                  Description
                  <span class="ml-1">{{ sortKey === 'description' ? (sortOrder === 'asc' ? '↑' : '↓') : '' }}</span>
                </th>
                <th class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium">Image</th>
                <th class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in sortedItems" :key="item.id" class="border-b border-gray-100 hover:bg-gray-50 transition duration-200" :class="{ 'bg-gray-100': sortedItems.indexOf(item) % 2 === 0 }">
                <td v-if="activeTab === 'home'" class="p-4 border-r text-gray-800">{{ item.paragraph1 || 'N/A' }}</td>
                <td v-if="activeTab === 'home'" class="p-4 border-r text-gray-800">{{ item.paragraph2 || 'N/A' }}</td>
                <td v-if="activeTab === 'lifeskills'" class="p-4 border-r text-gray-800">{{ item.title || 'N/A' }}</td>
                <td v-if="activeTab === 'lifeskills'" class="p-4 border-r text-gray-800">{{ truncateText(item.description, 50) || 'N/A' }}</td>
                <td class="p-4">
                  <img :src="imageUrl(item.image)" alt="Item Image" class="w-16 h-16 object-cover rounded" @error="onImageError" />
                </td>
                <td class="p-4 flex space-x-2">
                  <button @click="editItem(item)" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                  </button>
                  <button @click="deleteItem(item.id)" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200 flex items-center" :disabled="loading">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete
                  </button>
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
  event.target.src = 'https://via.placeholder.com/150'; // Fallback image
};

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    formData.value.image = file;
    formData.value.imagePreview = URL.createObjectURL(file); // Preview the uploaded image
  }
};

const fetchItems = async () => {
  loading.value = true;
  try {
    const endpoint = activeTab.value === 'home' ? '/homes' : '/lifeskills';
    const response = await apiInstance.get(endpoint, { timeout: 10000 });
    console.log(`API Response for ${endpoint}:`, response.data); // Debug log
    items.value = response.data.data || response.data || [];
    if (items.value.length === 0) {
      showNotification('error', `No ${activeTab.value === 'home' ? 'Home content' : 'Life Skills'} found.`);
    } else {
      showNotification('success', `${activeTab.value === 'home' ? 'Home content' : 'Life Skills'} loaded successfully`);
    }
  } catch (error) {
    console.error(`Error fetching ${activeTab.value} data:`, error.response || error); // Debug log
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
    console.log(`Submit Response for ${method} ${url}:`, response.data); // Debug log
    await fetchItems();
    closeModal();
    showNotification('success', `${activeTab.value === 'home' ? 'Home content' : 'Life Skill'} ${isEditing.value ? 'updated' : 'created'} successfully`);
  } catch (error) {
    console.error(`Error ${isEditing.value ? 'updating' : 'creating'} ${activeTab.value}:`, error.response || error); // Debug log
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
      console.log(`Delete Response for ${endpoint}/${id}:`, response.data); // Debug log
      await fetchItems();
      showNotification('success', `${activeTab.value === 'home' ? 'Home content' : 'Life Skill'} deleted successfully`);
    } catch (error) {
      console.error(`Error deleting ${activeTab.value} item:`, error.response || error); // Debug log
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

th {
  font-weight: 600;
}
td {
  vertical-align: middle;
  max-width: 200px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
tr:hover td {
  background-color: rgba(243, 244, 246, 0.7);
}
</style>