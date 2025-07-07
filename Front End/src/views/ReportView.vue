<template>
  <div class="mx-auto my-8 px-4 sm:px-6 lg:px-12 max-w-screen-xl">
    <h1 class="text-2xl font-bold text-center">Our Reports</h1>
    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
      <!-- Sticky Search and Year Select Form -->
      <div class="sticky top-0 z-10 bg-white pb-4 border-b border-gray-200">
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
              class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 bg-gray-100 hover:bg-white text-gray-800 placeholder-gray-500 text-base"
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
              @change="filterReports"
              class="w-full sm:w-48 pl-4 pr-10 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent appearance-none transition-all duration-300 bg-gray-100 hover:bg-white text-gray-800 text-base"
              aria-label="Filter by year"
            >
              <option value="">All Years</option>
              <option v-for="year in availableYears" :key="year" :value="year.toString()">{{ year }}</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="mt-6 text-gray-600 text-center">
        Loading reports...
      </div>
      <!-- Error State -->
      <div v-else-if="error" class="mt-6 text-red-600 text-center">
        Failed to load reports: {{ error }}
      </div>
      <!-- Filtered Results -->
      <div v-else-if="filteredReports.length" class="mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Filtered Reports</h3>
        <ul class="space-y-3">
          <li
            v-for="(report, index) in filteredReports"
            :key="index"
            class="p-4 bg-gray-50 rounded-lg shadow-sm hover:bg-indigo-50 transition-all duration-300 cursor-pointer"
            @click="toggleDescription(index)"
          >
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
              <div>
                <h4 class="text-gray-900 font-medium text-base sm:text-lg">{{ report.title }}</h4>
                <p class="text-gray-600 text-sm">{{ report.year }}</p>
                <p
                  v-if="report.showDescription"
                  class="text-gray-600 text-sm mt-2 transition-all duration-300"
                  :aria-expanded="report.showDescription"
                >
                  {{ report.description }}
                </p>
              </div>
              <a
                v-if="report.file_url"
                :href="report.file_url"
                target="_blank"
                rel="noopener noreferrer"
                class="mt-3 sm:mt-0 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                aria-label="Download report"
              >
                <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download
              </a>
              <span
                v-else
                class="mt-3 sm:mt-0 px-4 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed"
                aria-label="Download unavailable"
              >
                Download Unavailable
              </span>
            </div>
          </li>
        </ul>
      </div>
      <div v-else class="mt-6 text-gray-600 text-center">
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
      year: Number(report.year), // Ensure year is a number
      showDescription: false, // Add showDescription property for toggling
    }));
    console.log("Fetched reports:", reports.value); // Debug API response
    console.log("Available years:", availableYears.value); // Debug available years
  } catch (err) {
    error.value = err.message || "An error occurred while fetching reports.";
    console.error("Failed to fetch reports:", err);
  } finally {
    loading.value = false;
  }
});

const availableYears = computed(() => {
  const years = [...new Set(reports.value.map(report => report.year))].sort((a, b) => b - a);
  console.log("Computed available years:", years); // Debug years
  return years;
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
  console.log("Filtered reports:", filtered); // Debug filtered results
  return filtered;
});

const clearSearch = () => {
  searchQuery.value = "";
};

const filterReports = () => {
  // Filtering handled by computed property
};

const toggleDescription = (index) => {
  const originalIndex = reports.value.findIndex((r) => r === filteredReports.value[index]);
  reports.value[originalIndex].showDescription = !reports.value[originalIndex].showDescription;
};
</script>

<style scoped>
input,
select,
button,
a {
  transition: all 0.3s ease-in-out;
}

input:focus,
select:focus {
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
}

a:hover,
button:hover {
  transform: scale(1.05);
}

/* Ensure responsiveness for smaller screens */
@media (max-width: 640px) {
  .sm\:flex-row {
    flex-direction: column;
  }

  .sm\:w-48 {
    width: 100%;
  }

  .sm\:text-lg {
    font-size: 1rem;
  }

  select {
    font-size: 0.875rem; /* Ensure dropdown text is not too large on mobile */
  }
}
</style>