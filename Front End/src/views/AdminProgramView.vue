<template>
  <admin-aside>
    <div :class="['min-h-screen p-6', isCollapsed ? 'ml-16' : '']" v-if="layoutReady" :style="{ transition: 'margin-left 0.3s ease' }">
      <!-- Dashboard Header -->
      <div class="bg-white p-6 rounded-lg mb-6 shadow-lg border border-gray-100">
        <h1 class="text-3xl font-bold tracking-wide text-gray-900">Admin Dashboard</h1>
        <p class="text-gray-600 mt-1">Manage Programs, Strategies, and Enhancements</p>
      </div>

      <!-- Filters and Actions -->
      <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="relative w-full sm:w-64">
          <select
            v-model="activeSection"
            class="w-full px-4 py-2 border-none rounded-lg bg-white text-gray-800 font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none"
          >
            <option value="programs">Programs</option>
            <option value="strategies">Strategies</option>
            <option value="enhancements">Enhancements</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
        </div>
        <div class="flex gap-4 w-full sm:w-auto">
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Search by title or description..."
            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200"
          />
          <button
            @click="openCreateModal"
            class="px-6 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 hover:shadow-lg transition-all duration-200"
          >
            Add New
          </button>
        </div>
      </div>

      <!-- Notification Area -->
      <div v-if="notification.message" class="mb-6 p-4 rounded-lg transition-all duration-300"
           :class="notification.type === 'success' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700'">
        <div class="flex items-center">
          <svg v-if="notification.type === 'success'" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
          <svg v-else class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
          <span>{{ notification.message }}</span>
        </div>
      </div>

      <!-- Table Section -->
      <div class="bg-white rounded-lg shadow-md border border-gray-100">
        <div class="p-6">
          <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b-2 border-blue-100 pb-2">{{ getSectionTitle }} List</h2>
          <div v-if="loading" class="flex items-center justify-center py-4 text-blue-600">
            <svg class="w-6 h-6 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
            </svg>
            Loading...
          </div>
          <div v-else-if="filteredItems.length === 0" class="text-red-600 text-center py-4">No items found.</div>
          <div v-else class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
              <thead class="bg-gray-50 sticky top-0 z-10">
                <tr>
                  <th class="p-3 border-b-2 border-gray-200 text-gray-600 font-medium">ID</th>
                  <th class="p-3 border-b-2 border-gray-200 text-gray-600 font-medium">Image</th>
                  <th class="p-3 border-b-2 border-gray-200 text-gray-600 font-medium cursor-pointer hover:bg-gray-100"
                      @click="sort('title')"
                      :aria-sort="sortKey === 'title' ? (sortOrder === 'asc' ? 'ascending' : 'descending') : 'none'">
                    Title
                    <span class="ml-1 inline-block">{{ sortKey === 'title' ? (sortOrder === 'asc' ? '↑' : '↓') : '' }}</span>
                  </th>
                  <th class="p-3 border-b-2 border-gray-200 text-gray-600 font-medium cursor-pointer hover:bg-gray-100"
                      @click="sort('description')"
                      :aria-sort="sortKey === 'description' ? (sortOrder === 'asc' ? 'ascending' : 'descending') : 'none'">
                    Description
                    <span class="ml-1 inline-block">{{ sortKey === 'description' ? (sortOrder === 'asc' ? '↑' : '↓') : '' }}</span>
                  </th>
                  <th class="p-3 border-b-2 border-gray-200 text-gray-600 font-medium">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in paginatedItems" :key="item.id" class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                  <td class="p-3 text-gray-800">{{ item.id }}</td>
                  <td class="p-3">
                    <img :src="imageUrl(item.image)" alt="Item Image" class="w-16 h-16 object-cover rounded" @error="onImageError" />
                    <span v-if="!item.image" class="text-gray-400 ml-2">N/A</span>
                  </td>
                  <td class="p-3 text-gray-800 max-w-xs truncate">{{ item.title || 'Untitled' }}</td>
                  <td class="p-3 text-gray-600 max-w-xs truncate">{{ truncateText(item.description, 50) || 'No description' }}</td>
                  <td class="p-3 flex gap-2">
                    <button @click="editItem(item)" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-200 flex items-center gap-1"
                            aria-label="Edit item">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                      Edit
                    </button>
                    <button @click="deleteItem(item.id)" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200 flex items-center gap-1"
                            :disabled="loading" aria-label="Delete item">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div v-if="filteredItems.length > 0" class="p-4 flex justify-center items-center gap-4 bg-gray-50">
          <button @click="currentPage--" :disabled="currentPage === 1" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200"
                  aria-label="Previous page">
            Previous
          </button>
          <span class="text-gray-700">{{ currentPage }} of {{ totalPages }}</span>
          <button @click="currentPage++" :disabled="currentPage === totalPages" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200"
                  aria-label="Next page">
            Next
          </button>
        </div>
      </div>

      <!-- Modal for Create/Update -->
      <div v-if="showModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md overflow-y-auto max-h-[90vh]">
          <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ isEditing ? 'Edit' : 'Create' }} {{ getSectionTitle }}</h2>
          <form @submit.prevent="handleSubmit" class="space-y-4" enctype="multipart/form-data">
            <div>
              <label class="block text-sm font-medium text-gray-700">Title</label>
              <input
                v-model="formData.title"
                type="text"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Description</label>
              <textarea
                v-model="formData.description"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                rows="4"
                required
              ></textarea>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Image</label>
              <input
                type="file"
                @change="handleImageUpload"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                accept="image/*"
              />
              <img v-if="formData.imagePreview" :src="formData.imagePreview" alt="Preview" class="w-24 h-24 object-cover mt-2 rounded" />
            </div>
            <div class="flex justify-end gap-3">
              <button
                type="button"
                @click="closeModal"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-200"
                aria-label="Cancel"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200"
                :disabled="loading"
                aria-label="Submit form"
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

const activeSection = ref('programs');
const programs = ref([]);
const strategies = ref([]);
const enhancements = ref([]);
const loading = ref(false);
const layoutReady = ref(false);
const showModal = ref(false);
const isEditing = ref(false);
const formData = ref({ id: null, title: '', description: '', image: '', imagePreview: '' });
const notification = ref({ message: '', type: '' });
const searchQuery = ref('');
const currentPage = ref(1);
const itemsPerPage = ref(10);
const sortKey = ref('');
const sortOrder = ref('asc');

const isCollapsed = computed(() => localStorage.getItem('sidebarCollapsed') === 'true');

const items = computed(() => {
  switch (activeSection.value) {
    case 'programs': return programs.value;
    case 'strategies': return strategies.value;
    case 'enhancements': return enhancements.value;
    default: return [];
  }
});

const sortedItems = computed(() => {
  let result = [...items.value];
  if (sortKey.value) {
    result.sort((a, b) => {
      const aValue = a[sortKey.value]?.toString().toLowerCase() || '';
      const bValue = b[sortKey.value]?.toString().toLowerCase() || '';
      return sortOrder.value === 'asc' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
    });
  }
  return result;
});

const filteredItems = computed(() => {
  return sortedItems.value.filter(item =>
    item.title?.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    item.description?.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

const paginatedItems = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  const end = start + itemsPerPage.value;
  return filteredItems.value.slice(start, end);
});

const totalPages = computed(() => Math.ceil(filteredItems.value.length / itemsPerPage.value));

const getSectionTitle = computed(() => {
  switch (activeSection.value) {
    case 'programs': return 'Programs';
    case 'strategies': return 'Strategies';
    case 'enhancements': return 'Enhancements';
    default: return '';
  }
});

const truncateText = (text, maxLength) => {
  if (!text || text.length <= maxLength) return text || 'No description';
  return text.slice(0, maxLength) + '...';
};

const imageUrl = (imagePath) => {
  const baseUrl = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000';
  return imagePath ? `${baseUrl}/storage/${imagePath}` : 'https://via.placeholder.com/150';
};

const onImageError = (event) => {
  event.target.src = 'https://via.placeholder.com/150';
};

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    formData.value.image = file;
    formData.value.imagePreview = URL.createObjectURL(file);
  }
};

const fetchData = async (endpoint) => {
  loading.value = true;
  try {
    const response = await apiInstance.get(`/${endpoint}`, { timeout: 10000 });
    const data = response.data.data || response.data || [];
    switch (endpoint) {
      case 'programs':
        programs.value = data.map(item => ({ id: item.id, title: item.title || 'Untitled', description: item.description || 'No description', image: item.image || null }));
        break;
      case 'strategies':
        strategies.value = data.map(item => ({ id: item.id, title: item.title || 'Untitled', description: item.description || 'No description', image: item.image || null }));
        break;
      case 'enhancements':
        enhancements.value = data.map(item => ({ id: item.id, title: item.title || 'Untitled', description: item.description || 'No description', image: item.image || null }));
        break;
    }
    if (items.value.length === 0) {
      showNotification('error', `No ${getSectionTitle.value} found.`);
    }
  } catch (error) {
    showNotification('error', `Error fetching ${getSectionTitle.value}: ${error.response?.data?.message || error.message}`);
  } finally {
    loading.value = false;
  }
};

const openCreateModal = () => {
  isEditing.value = false;
  formData.value = { id: null, title: '', description: '', image: '', imagePreview: '' };
  showModal.value = true;
};

const editItem = (item) => {
  isEditing.value = true;
  formData.value = { ...item, imagePreview: item.image ? imageUrl(item.image) : '' };
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
  formData.value = { id: null, title: '', description: '', image: '', imagePreview: '' };
};

const handleSubmit = async () => {
  loading.value = true;
  try {
    const endpoint = activeSection.value;
    const method = isEditing.value ? 'put' : 'post';
    const url = isEditing.value ? `${endpoint}/${formData.value.id}` : endpoint;

    const payload = new FormData();
    payload.append('title', formData.value.title);
    payload.append('description', formData.value.description);
    if (formData.value.image instanceof File) {
      payload.append('image', formData.value.image);
    }

    await apiInstance[method](url, payload, { headers: { 'Content-Type': 'multipart/form-data' } });
    await fetchData(activeSection.value);
    closeModal();
    showNotification('success', `${getSectionTitle.value} ${isEditing.value ? 'updated' : 'created'} successfully`);
  } catch (error) {
    showNotification('error', `Error ${isEditing.value ? 'updating' : 'creating'} ${getSectionTitle.value}: ${error.response?.data?.message || error.message}`);
  } finally {
    loading.value = false;
  }
};

const deleteItem = async (id) => {
  if (confirm(`Are you sure you want to delete this ${getSectionTitle.value.toLowerCase()}?`)) {
    loading.value = true;
    try {
      await apiInstance.delete(`/${activeSection.value}/${id}`);
      await fetchData(activeSection.value);
      showNotification('success', `${getSectionTitle.value} deleted successfully`);
    } catch (error) {
      showNotification('error', `Error deleting ${getSectionTitle.value}: ${error.response?.data?.message || error.message}`);
    } finally {
      loading.value = false;
    }
  }
};

const sort = (key) => {
  if (sortKey.value === key) {
    sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc';
  } else {
    sortKey.value = key;
    sortOrder.value = 'asc';
  }
};

const showNotification = (type, message) => {
  notification.value = { type, message };
  setTimeout(() => (notification.value = { message: '', type: '' }), 3000);
};

onMounted(() => {
  fetchData('programs');
  fetchData('strategies');
  fetchData('enhancements');
  layoutReady.value = true;
});

watch(activeSection, () => {
  fetchData(activeSection.value);
  currentPage.value = 1;
  sortKey.value = '';
  sortOrder.value = 'asc';
});

watch(searchQuery, () => {
  currentPage.value = 1;
});
</script>

<style scoped>
.truncate {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.animate-spin {
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

.transition-all {
  transition: all 0.3s ease;
}

table {
  border-collapse: separate;
  border-spacing: 0;
}

th:hover {
  background-color: #f9fafb;
}

td {
  vertical-align: middle;
}
</style>