<template>
  <div class="mx-auto my-8 px-4 sm:px-6 lg:px-12 max-w-screen-xl">
    <h1 class="text-2xl font-bold text-center">Our Volunteer</h1>
    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
      <!-- Search and Year Select Form -->
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
            class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 bg-gray-100 hover:bg-white text-gray-800 placeholder-gray-500"
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
            class="w-full sm:w-48 pl-4 pr-10 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent appearance-none transition-all duration-300 bg-gray-100 hover:bg-white text-gray-800"
            aria-label="Filter by year"
          >
            <option value="">All Years</option>
            <option value="2025">2025</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
            <option value="2022">2022</option>
          </select>
          <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
        </div>
      </div>

      <!-- Filtered Results -->
      <div v-if="filteredReports.length" class="mt-6">
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
                >
                  {{ report.description }}
                </p>
              </div>
              <button
                @click.stop="downloadReport(report)"
                class="mt-3 sm:mt-0 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                aria-label="Download report"
              >
                <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download
              </button>
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

<script>
export default {
  name: 'ReportFilterForm',
  data() {
    return {
      reports: [
        {
          title: 'Monthly Performance Report',
          year: 2025,
          description: 'Detailed analysis of monthly sales, user engagement, and operational efficiency.',
          showDescription: false
        },
        {
          title: 'Annual Growth Analysis',
          year: 2024,
          description: 'Comprehensive overview of yearly growth metrics and strategic projections.',
          showDescription: false
        },
        {
          title: 'User Engagement Report',
          year: 2023,
          description: 'In-depth review of user engagement and retention statistics.',
          showDescription: false
        },
        {
          title: 'Market Trends Report',
          year: 2022,
          description: 'Analysis of market trends and competitive landscape for 2022.',
          showDescription: false
        }
      ],
      searchQuery: '',
      selectedYear: '',
    };
  },
  computed: {
    filteredReports() {
      let filtered = [...this.reports];
      if (this.searchQuery) {
        filtered = filtered.filter(report =>
          report.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          report.description.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      }
      if (this.selectedYear) {
        filtered = filtered.filter(report => report.year.toString() === this.selectedYear);
      }
      return filtered;
    }
  },
  methods: {
    clearSearch() {
      this.searchQuery = '';
    },
    filterReports() {
      // Triggered on year select change, but filtering is handled by computed property
    },
    toggleDescription(index) {
      this.filteredReports[index].showDescription = !this.filteredReports[index].showDescription;
    },
    downloadReport(report) {
      const content = `Report: ${report.title}\nYear: ${report.year}\n\n${report.description}`;
      const blob = new Blob([content], { type: 'text/plain' });
      const url = window.URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href = url;
      link.download = `${report.title.replace(/\s+/g, '_')}_${report.year}.txt`;
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      window.URL.revokeObjectURL(url);
    }
  }
};
</script>

<style scoped>
input, select, button {
  transition: all 0.3s ease-in-out;
}

input:focus, select:focus {
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
}

button:hover {
  transform: scale(1.05);
}

/* Ensure responsiveness for smaller screens */
@media (max-width: 640px) {
  .sm\\:flex-row {
    flex-direction: column;
  }

  .sm\\:w-48 {
    width: 100%;
  }

  .sm\\:text-lg {
    font-size: 1rem;
  }
}
</style>