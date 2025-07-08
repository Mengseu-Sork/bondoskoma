<template>
  <admin-aside>
    <div :class="['min-h-screen p-6', isCollapsed ? 'ml-16' : '']" v-if="layoutReady" :style="{ transition: 'margin-left 0.3s ease' }">
      <!-- Header with Gradient -->
      <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white p-4 rounded-lg mb-6 shadow-lg">
        <h1 class="text-3xl font-extrabold tracking-wide animate-fade-in">Admin Home</h1>
      </div>

      <!-- Dropdown and Create Button -->
      <div class="mb-6 flex items-center justify-between">
        <!-- Custom Dropdown -->
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
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
        </div>

        <!-- Glowing Create Button -->
        <button
          @click="openCreateModal"
          class="px-6 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 animate-pulse-slow"
        >
          <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Create New
        </button>
      </div>

      <!-- Enhanced Table Card -->
      <div class="bg-white p-6 rounded-lg shadow-xl border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b-2 border-blue-200 pb-2">{{ activeTab === 'home' ? 'Home Content' : 'Life Skills' }}</h2>
        <div v-if="loading" class="text-blue-600 text-lg flex items-center justify-center py-4">
          <svg class="w-6 h-6 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
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
                <th class="p-4 border-b-2 border-gray-200 text-gray-700 font-medium">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in sortedItems" :key="item.id" class="border-b border-gray-100 hover:bg-gray-50 transition duration-200" :class="{ 'bg-gray-100': sortedItems.indexOf(item) % 2 === 0 }">
                <td v-if="activeTab === 'home'" class="p-4 border-r text-gray-800">{{ item.paragraph1 }}</td>
                <td v-if="activeTab === 'home'" class="p-4 border-r text-gray-800">{{ item.paragraph2 }}</td>
                <td v-if="activeTab === 'lifeskills'" class="p-4 border-r text-gray-800">{{ item.title }}</td>
                <td v-if="activeTab === 'lifeskills'" class="p-4 border-r text-gray-800">{{ truncateText(item.description, 50) }}</td>
                <td class="p-4 flex space-x-2">
                  <button @click="editItem(item)" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                  </button>
                  <button @click="deleteItem(item.id)" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200 flex items-center" :disabled="loading">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

const isCollapsed = computed(() => {
  return localStorage.getItem('sidebarCollapsed') === 'true';
});

const sortedItems = computed(() => {
  if (!sortKey.value) return [...items.value];
  return [...items.value].sort((a, b) => {
    const aValue = a[sortKey.value] || '';
    const bValue = b[sortKey.value] || '';
    return sortOrder.value === 'asc' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
  });
});

const truncateText = (text, maxLength) => {
  if (text.length <= maxLength) return text;
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

const fetchItems = async () => {
  loading.value = true;
  try {
    const endpoint = activeTab.value === 'home' ? '/homes' : '/lifeskills';
    const response = await apiInstance.get(endpoint, { timeout: 500 });
    items.value = response.data.data || [];
  } catch (error) {
    console.error(`Error fetching ${activeTab.value} data:`, error);
  } finally {
    loading.value = false;
  }
};

const openCreateModal = () => {
  console.log('Open create modal for', activeTab.value);
  // TODO: Implement modal or navigate to create page
};

const editItem = (item) => {
  console.log('Edit item:', item);
  // TODO: Add form or modal for updating item
};

const deleteItem = async (id) => {
  if (confirm(`Are you sure you want to delete this ${activeTab.value} item?`)) {
    loading.value = true;
    try {
      const endpoint = activeTab.value === 'home' ? '/homes' : '/lifeskills';
      await apiInstance.delete(`${endpoint}/${id}`);
      await fetchItems();
    } catch (error) {
      console.error(`Error deleting ${activeTab.value} item:`, error);
    } finally {
      loading.value = false;
    }
  }
};

onMounted(() => {
  fetchItems();
  layoutReady.value = true;
});

watch(activeTab, fetchItems);
</script>

<style scoped>
/* Animations */
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

/* Table and General Styling */
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