<template>
  <div class="mx-auto my-8 px-4 sm:px-6 lg:px-12 max-w-screen-xl">
    <h1 class="text-2xl font-bold text-center mb-6">Our Reports</h1>
    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
      <!-- Sticky Search and Year Select Form -->
      <div class="sticky top-0 z-10 bg-white pb-4 border-b border-gray-200 mb-4">
        <div class="flex flex-col sm:flex-row gap-4">
          <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Search reports by title or description..."
              class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100 hover:bg-white"
              aria-label="Search reports"
            />
            <button
              v-if="searchQuery"
              @click="clearSearch"
              class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700"
              aria-label="Clear search"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="relative">
            <select
              v-model="selectedYear"
              class="w-full sm:w-40 pl-3 pr-8 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100 hover:bg-white"
              aria-label="Filter by year"
            >
              <option value="">All Years</option>
              <option v-for="year in availableYears" :key="year" :value="year.toString()">{{ year }}</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="text-gray-600 text-center py-4">
        Loading reports...
      </div>
      <!-- Error State -->
      <div v-else-if="error" class="text-red-600 text-center py-4">
        Failed to load reports: {{ error }}
      </div>
      <!-- Reports Table -->
      <div v-else-if="filteredReports.length" class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
          <thead>
            <tr class="bg-gray-100">
              <th class="py-2 px-4 border-b text-left text-gray-700">Title</th>
              <th class="py-2 px-4 border-b text-left text-gray-700">Year</th>
              <th class="py-2 px-4 border-b text-left text-gray-700">Description</th>
              <th class="py-2 px-4 border-b text-left text-gray-700">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(report, index) in filteredReports"
              :key="index"
              class="hover:bg-gray-50 transition-colors"
            >
              <td class="py-2 px-4 border-b text-gray-900">{{ report.title }}</td>
              <td class="py-2 px-4 border-b text-gray-600">{{ report.year }}</td>
              <td class="py-2 px-4 border-b text-gray-600">{{ report.description }}</td>
              <td class="py-2 px-4 border-b flex gap-2">
                <button
                  @click="editReport(index)"
                  class="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                  aria-label="Edit report"
                >
                  Edit
                </button>
                <button
                  @click="deleteReport(index)"
                  class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                  aria-label="Delete report"
                >
                  Delete
                </button>
                <a
                  v-if="report.file_url"
                  :href="report.file_url"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
                  aria-label="Download report"
                >
                  Download
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else class="text-gray-600 text-center py-4">
        No reports match your search criteria.
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import api from "@/plugin/axios";

const reports = ref([]);
const searchQuery = ref("");
const selectedYear = ref("");
const loading = ref(false);
const error = ref(null);

onMounted(async () => {
  loading.value = true;
  try {
    const res = await api.get("/reports");
    reports.value = res.data.data.map(report => ({
      ...report,
      year: Number(report.year),
    }));
  } catch (err) {
    error.value = err.message || "An error occurred while fetching reports.";
  } finally {
    loading.value = false;
  }
});

const availableYears = computed(() => {
  return [...new Set(reports.value.map(report => report.year))].sort((a, b) => b - a);
});

const filteredReports = computed(() => {
  let filtered = [...reports.value];
  if (searchQuery.value) {
    filtered = filtered.filter(
      (report) =>
        report.title?.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        report.description?.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
  }
  if (selectedYear.value) {
    filtered = filtered.filter((report) => String(report.year) === selectedYear.value);
  }
  return filtered;
});

const clearSearch = () => {
  searchQuery.value = "";
};

const editReport = (index) => {
  const originalIndex = reports.value.findIndex((r) => r === filteredReports.value[index]);
  alert(`Editing report: ${reports.value[originalIndex].title}`);
  // Implement edit logic here (e.g., open a modal or redirect to edit page)
};

const deleteReport = async (index) => {
  const originalIndex = reports.value.findIndex((r) => r === filteredReports.value[index]);
  const report = reports.value[originalIndex];
  if (confirm(`Are you sure you want to delete "${report.title}"?`)) {
    try {
      await api.delete(`/reports/${report.id}`);
      reports.value.splice(originalIndex, 1);
    } catch (err) {
      error.value = err.message || "Failed to delete report.";
    }
  }
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  text-align: left;
  padding: 8px;
}

button, a {
  transition: all 0.2s ease-in-out;
}

button:hover, a:hover {
  transform: scale(1.05);
}

@media (max-width: 640px) {
  .sm\:flex-row {
    flex-direction: column;
  }
  .sm\:w-40 {
    width: 100%;
  }
}
</style>