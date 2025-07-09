<template>
  <admin-aside>
    <div :class="['min-h-screen p-6', isCollapsed ? 'ml-16' : '']" v-if="layoutReady" :style="{ transition: 'margin-left 0.3s ease' }">
      <!-- Header with Gradient -->
      <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white p-4 rounded-lg mb-6 shadow-lg">
        <h1 class="text-3xl font-extrabold tracking-wide animate-fade-in">Manage Programs</h1>
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

      <!-- Create Button -->
      <div class="mb-6 flex justify-end">
        <button
          @click="openCreateModal"
          class="px-6 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 animate-pulse-slow"
        >
          <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 4v16m8-8H4" />
          </svg>
          Create New Program
        </button>
      </div>

      <!-- Programs Table -->
      <div class="bg-white p-6 rounded-lg shadow-xl border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b-2 border-blue-200 pb-2">Programs List</h2>
        <div v-if="loading" class="text-blue-600 text-lg flex items-center justify-center py-4">
          <svg class="w-6 h-6 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
          </svg>
          Loading...
        </div>
        <div v-else-if="programs.length === 0" class="text-red-600 text-lg flex items-center justify-center py-4">No programs found.</div>
        <div v-else class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-50">
                <th class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium cursor-pointer" @click="sort('title')">
                  Title
                  <span class="ml-1">{{ sortKey === 'title' ? (sortOrder === 'asc' ? '↑' : '↓') : '' }}</span>
                </th>
                <th class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium cursor-pointer" @click="sort('description')">
                  Description
                  <span class="ml-1">{{ sortKey === 'description' ? (sortOrder === 'asc' ? '↑' : '↓') : '' }}</span>
                </th>
                <th class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium">Image</th>
                <th class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium">Goals</th>
                <th class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium">Impact</th>
                <th class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="program in sortedPrograms" :key="program.id" class="border-b border-gray-100 hover:bg-gray-50 transition duration-200" :class="{ 'bg-gray-100': sortedPrograms.indexOf(program) % 2 === 0 }">
                <td class="p-4 border-r text-gray-800">{{ program.title || 'N/A' }}</td>
                <td class="p-4 border-r text-gray-800">{{ truncateText(program.description, 50) || 'N/A' }}</td>
                <td class="p-4 border-r text-gray-800">
                  <img :src="program.image || 'https://via.placeholder.com/50x50?text=Image'" alt="Program Image" class="w-12 h-12 object-cover rounded" />
                </td>
                <td class="p-4 border-r text-gray-800">{{ program.goals?.length ? program.goals.join(', ') : 'N/A' }}</td>
                <td class="p-4 border-r text-gray-800">
                  {{ program.beneficiaries || 'N/A' }} / {{ program.communities || 'N/A' }} / {{ program.success_rate || 'N/A' }}
                </td>
                <td class="p-4 flex space-x-2">
                  <button @click="editProgram(program)" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                  </button>
                  <button @click="deleteProgram(program.id)" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200 flex items-center" :disabled="loading">
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
        <div class="bg-white rounded-lg p-6 w-full max-w-lg overflow-y-auto max-h-[90vh]">
          <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ isEditing ? 'Edit' : 'Create' }} Program</h2>
          <form @submit.prevent="handleSubmit" class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Title</label>
              <input
                v-model="formData.title"
                type="text"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                required
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Description</label>
              <textarea
                v-model="formData.description"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                rows="4"
                required
              ></textarea>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Image URL</label>
              <input
                v-model="formData.image"
                type="url"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="https://example.com/image.jpg"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Goals (comma-separated)</label>
              <textarea
                v-model="goalsInput"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                rows="3"
                placeholder="Goal 1, Goal 2, Goal 3"
              ></textarea>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Beneficiaries</label>
              <input
                v-model="formData.beneficiaries"
                type="text"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="e.g., 2500+ mothers"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Communities</label>
              <input
                v-model="formData.communities"
                type="text"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="e.g., 15 communities"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Success Rate</label>
              <input
                v-model="formData.success_rate"
                type="text"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="e.g., 85%"
              />
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
import { ref, onMounted, computed } from 'vue';
import apiInstance from '@/plugin/axios';
import AdminAside from '../components/AdminAside.vue';

const programs = ref([]);
const loading = ref(false);
const layoutReady = ref(false);
const sortKey = ref('');
const sortOrder = ref('asc');
const showModal = ref(false);
const isEditing = ref(false);
const formData = ref({
  id: null,
  title: '',
  description: '',
  image: '',
  goals: [],
  beneficiaries: '',
  communities: '',
  success_rate: '',
});
const goalsInput = ref('');
const notification = ref({
  message: '',
  type: '',
});

const isCollapsed = computed(() => {
  return localStorage.getItem('sidebarCollapsed') === 'true';
});

const sortedPrograms = computed(() => {
  if (!sortKey.value) return [...programs.value];
  return [...programs.value].sort((a, b) => {
    const aValue = a[sortKey.value]?.toString().toLowerCase() || '';
    const bValue = b[sortKey.value]?.toString().toLowerCase() || '';
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

const fetchPrograms = async () => {
  loading.value = true;
  try {
    const response = await apiInstance.get('/lifeskills', { timeout: 10000 });
    console.log('API Response for /lifeskills:', response.data); // Debug log
    programs.value = (response.data.data || response.data || []).map(item => ({
      id: item.id,
      title: item.title || 'Untitled Program',
      description: item.description || 'No description available.',
      image: item.image || 'https://via.placeholder.com/50x50?text=Image',
      goals: item.goals || ['No goals defined.'],
      beneficiaries: item.beneficiaries || 'N/A',
      communities: item.communities || 'N/A',
      success_rate: item.success_rate || 'N/A',
    }));
    if (programs.value.length === 0) {
      showNotification('error', 'No programs found.');
    } else {
      showNotification('success', 'Programs loaded successfully.');
    }
  } catch (error) {
    console.error('Error fetching programs:', error.response || error);
    showNotification('error', `Error fetching programs: ${error.response?.data?.message || error.message}`);
  } finally {
    loading.value = false;
  }
};

const openCreateModal = () => {
  isEditing.value = false;
  formData.value = { id: null, title: '', description: '', image: '', goals: [], beneficiaries: '', communities: '', success_rate: '' };
  goalsInput.value = '';
  showModal.value = true;
};

const editProgram = (program) => {
  isEditing.value = true;
  formData.value = { ...program, goals: program.goals || [] };
  goalsInput.value = program.goals?.join(', ') || '';
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
  formData.value = { id: null, title: '', description: '', image: '', goals: [], beneficiaries: '', communities: '', success_rate: '' };
  goalsInput.value = '';
};

const handleSubmit = async () => {
  loading.value = true;
  try {
    const endpoint = '/lifeskills';
    const method = isEditing.value ? 'put' : 'post';
    const url = isEditing.value ? `${endpoint}/${formData.value.id}` : endpoint;
    const payload = {
      title: formData.value.title,
      description: formData.value.description,
      image: formData.value.image || null,
      goals: goalsInput.value ? goalsInput.value.split(',').map(g => g.trim()) : [],
      beneficiaries: formData.value.beneficiaries || null,
      communities: formData.value.communities || null,
      success_rate: formData.value.success_rate || null,
    };
    const response = await apiInstance[method](url, payload);
    console.log(`Submit Response for ${method} ${url}:`, response.data); // Debug log
    await fetchPrograms();
    closeModal();
    showNotification('success', `Program ${isEditing.value ? 'updated' : 'created'} successfully`);
  } catch (error) {
    console.error(`Error ${isEditing.value ? 'updating' : 'creating'} program:`, error.response || error);
    showNotification('error', `Error ${isEditing.value ? 'updating' : 'creating'} program: ${error.response?.data?.message || error.message}`);
  } finally {
    loading.value = false;
  }
};

const deleteProgram = async (id) => {
  if (confirm('Are you sure you want to delete this program?')) {
    loading.value = true;
    try {
      const response = await apiInstance.delete(`/lifeskills/${id}`);
      console.log(`Delete Response for /lifeskills/${id}:`, response.data); // Debug log
      await fetchPrograms();
      showNotification('success', 'Program deleted successfully');
    } catch (error) {
      console.error('Error deleting program:', error.response || error);
      showNotification('error', `Error deleting program: ${error.response?.data?.message || error.message}`);
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
  fetchPrograms();
  layoutReady.value = true;
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