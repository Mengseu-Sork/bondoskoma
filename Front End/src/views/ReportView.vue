<template>
  <div class="max-w-7xl mx-auto my-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gray-800 text-white">
              <th class="px-4 py-2 text-sm font-semibold sticky top-0 bg-gray-800 sm:px-3">Title</th>
              <th class="px-4 py-2 text-sm font-semibold sticky top-0 bg-gray-800 sm:px-3">Year</th>
              <th class="px-4 py-2 text-sm font-semibold sticky top-0 bg-gray-800 sm:px-3">Description</th>
              <th class="px-4 py-2 text-sm font-semibold sticky top-0 bg-gray-800 sm:px-3">Download</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(report, index) in reports"
              :key="index"
              class="border-t border-gray-300 hover:bg-gray-200 transition-all duration-200"
            >
              <td class="px-4 py-2 text-xs text-gray-800 font-medium sm:px-3">{{ report.title }}</td>
              <td class="px-4 py-2 text-xs text-gray-800 font-medium sm:px-3">{{ report.year }}</td>
              <td class="px-4 py-2 text-xs text-gray-600 sm:px-3">{{ report.description }}</td>
              <td class="px-4 py-2 sm:px-3">
                <button
                  @click="downloadReport(report)"
                  class="px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-all duration-200 flex items-center space-x-1"
                >
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                  </svg>
                  <span>Download</span>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
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
      ]
    };
  },
  methods: {
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