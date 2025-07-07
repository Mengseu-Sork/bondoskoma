<template>
  <div class="mx-auto my-8 px-4 sm:px-6 lg:px-12 max-w-screen-xl">
    <div class="bg-gray-100 rounded-lg shadow-lg">
      <table class="w-full text-left border-collapse text-base">
        <thead>
          <tr class="bg-blue-700 text-white">
            <th class="px-4 py-3 font-semibold sticky top-0">Title</th>
            <th class="px-4 py-3 font-semibold sticky top-0">Year</th>
            <!-- Show description only on sm+ -->
            <th class="px-4 py-3 font-semibold sticky top-0 hidden sm:table-cell">Description</th>
            <th class="px-4 py-3 font-semibold sticky top-0">Download</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="(report, index) in reports" :key="index">
            <tr
              class="border-t border-gray-300 hover:bg-gray-200 transition-all duration-200 cursor-pointer"
              @click="toggleDescription(index)"
            >
              <td class="px-4 py-3 text-gray-800 font-medium">{{ report.title }}</td>
              <td class="px-4 py-3 text-gray-800 font-medium">{{ report.year }}</td>

              <!-- Desktop: Full description -->
              <td class="px-4 py-3 text-gray-700 hidden lg:table-cell">
                {{ report.description }}
              </td>

              <!-- Tablet: Truncated + Show more -->
              <td class="px-4 py-3 text-gray-700 hidden sm:table-cell lg:hidden">
                <span v-if="expandedIndex === index">{{ report.description }}</span>
                <span v-else class="line-clamp-1">{{ report.description }}</span>
                <button
                  @click.stop="toggleExpand(index)"
                  class="ml-2 text-blue-600 text-sm underline hover:text-blue-800"
                >
                  {{ expandedIndex === index ? 'Show less' : 'Show more' }}
                </button>
              </td>

              <td class="px-4 py-3">
                <button
                  @click.stop="downloadReport(report)"
                  class="px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition"
                >
                  Download
                </button>
              </td>
            </tr>

            <!-- Mobile: Description shown below on click -->
            <tr v-if="isMobile && activeIndex === index" class="bg-gray-50 sm:hidden">
              <td colspan="4" class="px-4 py-3 text-gray-700">
                {{ report.description }}
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ReportTable',
  data() {
    return {
      reports: [
        {
          title: 'Monthly Performance Report',
          year: 2025,
          description: 'Detailed analysis of monthly sales, user engagement, and operational efficiency.'
        },
        {
          title: 'Annual Growth Analysis',
          year: 2024,
          description: 'Comprehensive overview of yearly growth metrics and strategic projections.'
        },
        {
          title: 'User Engagement Report',
          year: 2023,
          description: 'In-depth review of user engagement and retention statistics.'
        }
      ],
      activeIndex: null,
      expandedIndex: null,
      isMobile: false
    };
  },
  mounted() {
    this.checkScreenSize();
    window.addEventListener('resize', this.checkScreenSize);
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.checkScreenSize);
  },
  methods: {
    checkScreenSize() {
      this.isMobile = window.innerWidth < 640;
    },
    toggleDescription(index) {
      if (this.isMobile) {
        this.activeIndex = this.activeIndex === index ? null : index;
      }
    },
    toggleExpand(index) {
      this.expandedIndex = this.expandedIndex === index ? null : index;
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
.line-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
