<template>
  <AdminAside>
  <div class="p-6 bg-white shadow-lg mb-8 border border-gray-200">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
      <div>
        <h2 class="text-2xl font-bold text-gray-800 ">Applicant Management</h2>
        <!-- <p class="text-sm text-gray-500">Track and manage candidate applications</p> -->
      </div>

      <!-- Filters -->
      <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
        <!-- Search -->
        <div class="relative w-full sm:w-64">
          <div class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
          <input v-model="searchQuery" type="text" placeholder="Search name..."
            class="pl-10 pr-3 py-2 w-full border rounded-lg text-sm border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto border rounded-xl">
      <table class="min-w-full bg-white divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th
              v-for="(header, index) in headers"
              :key="index"
              class="px-5 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide"
            >
              {{ header.label }}
            </th>
            <th class="px-5 py-3 text-sm font-semibold text-gray-700 uppercase tracking-wide">Download</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100 text-base">
          <tr
            v-for="(applicant, index) in paginatedApplicants"
            :key="index"
            class="hover:bg-gray-50 transition duration-150"
          >
            <!-- Name -->
            <td class="px-5 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div
                  class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-700 font-bold text-base"
                >
                  {{ getInitials(applicant.fullName) }}
                </div>
                <div class="ml-3">
                  <div class="font-medium text-gray-800">{{ applicant.fullName }}</div>
                  <div class="text-sm text-gray-500">{{ applicant.position }}</div>
                </div>
              </div>
            </td>

            <!-- Email -->
            <td class="px-5 py-4 text-gray-700 whitespace-nowrap">{{ applicant.email }}</td>

            <!-- Phone -->
            <td class="px-5 py-4 text-gray-700 whitespace-nowrap">{{ applicant.phone }}</td>

            <!-- Actions -->
            <td class="px-5 py-4 mt-2 flex justify-center items-center whitespace-nowrap">
              <div class="flex items-center gap-4">
                <a
                  :href="applicant.cvUrl"
                  rel="noopener noreferrer"
                  :download="`${applicant.fullName.replace(/[^a-z0-9]/gi, '_')}_CV.pdf`"
                  title="Download CV"
                  class="text-gray-600 hover:text-gray-800 transition"
                >
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                  </svg>
                </a>
                <button
                  @click="Delete(applicant)"
                  class=" text-red-600 rounded-md transition"
                  title="Delete"
                >
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m5 0H6"
                    />
                  </svg>
                </button>
              </div>
            </td>
          </tr>

          <!-- Empty state -->
          <tr v-if="filteredApplicants.length === 0">
            <td colspan="5" class="text-center py-8 text-gray-500">
              <div class="flex flex-col items-center">
                <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>
                <p class="text-base font-medium">No applicants found</p>
                <p class="text-sm text-gray-400">Try adjusting your search or filters</p>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>


    <!-- Pagination -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-6">
      <div class="text-xs text-gray-500">
        Showing <span class="font-medium">{{ paginationStart }} - {{ paginationEnd }}</span> of
        <span class="font-medium">{{ filteredApplicants.length }}</span> applicants
      </div>
      <div class="flex gap-2">
        <button @click="currentPage--" :disabled="currentPage === 1"
          class="px-3 py-1.5 border text-xs rounded-md disabled:opacity-50 hover:bg-gray-50">
          Previous
        </button>
        <button @click="currentPage++" :disabled="currentPage * itemsPerPage >= filteredApplicants.length"
          class="px-3 py-1.5 border text-xs rounded-md disabled:opacity-50 hover:bg-gray-50">
          Next
        </button>
      </div>
    </div>
  </div>
  </AdminAside>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { getApplies, deleteApply } from '@/api/applies'
import AdminAside from '@/components/AdminAside.vue'

// State
const applicants = ref([])
const searchQuery = ref('')
const currentPage = ref(1)
const itemsPerPage = ref(5)

// Table headers
const headers = [
  { label: 'Name' },
  { label: 'Email' },
  { label: 'Phone' },
]

// Fetch applicants from API
onMounted(async () => {
  try {
    const data = await getApplies()
    applicants.value = data.map(applicant => ({
      fullName: applicant.name,
      email: applicant.email,
      phone: applicant.phone,
      position: applicant.job_announcement?.title || 'Unknown',
      cvUrl: applicant.cv_url,
      id: applicant.id,
    }))
  } catch (error) {
    console.error('Failed to load applicants:', error)
  }
})

// Filtered applicants
const filteredApplicants = computed(() => {
  const query = searchQuery.value.toLowerCase()
  return applicants.value.filter(applicant =>
    applicant.fullName.toLowerCase().includes(query) ||
    applicant.email.toLowerCase().includes(query) ||
    applicant.phone.toLowerCase().includes(query)
  )
})

// Pagination
const paginatedApplicants = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  return filteredApplicants.value.slice(start, start + itemsPerPage.value)
})

const paginationStart = computed(() =>
  filteredApplicants.value.length === 0 ? 0 : (currentPage.value - 1) * itemsPerPage.value + 1
)

const paginationEnd = computed(() =>
  Math.min(currentPage.value * itemsPerPage.value, filteredApplicants.value.length)
)

// Get initials from name
function getInitials(name) {
  return name
    .split(' ')
    .map(part => part[0])
    .join('')
    .toUpperCase()
}

// Delete applicant
async function Delete(applicant) {
  if (confirm(`Are you sure you want to delete ${applicant.fullName}'s application?`)) {
    try {
      await deleteApply(applicant.id)
      applicants.value = applicants.value.filter(a => a.id !== applicant.id)
      alert('Application deleted successfully.')
    } catch (error) {
      console.error('Failed to delete application:', error)
      alert('Failed to delete application. Please try again later.')
    }
  }
}
</script>
