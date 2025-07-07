<template>
  <div class="p-6 bg-white rounded-2xl max-w-6xl mx-auto shadow-lg border border-gray-200">
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
        <th class="px-5 py-3 text-right text-sm font-semibold text-gray-700 uppercase tracking-wide">Actions</th>
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
        <td class="px-5 py-4 text-right whitespace-nowrap">
          <div class="flex justify-end items-center gap-3">
            <!-- View Details -->
            <button
              @click="viewDetails(applicant)"
              type="button"
              title="View Details"
              class="text-blue-600 hover:text-blue-800 transition"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z"
                />
              </svg>
            </button>

            <!-- Download CV -->
            <a
              :href="applicant.cvUrl"
              target="_blank"
              rel="noopener noreferrer"
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
</template>

<script setup>
import { ref, computed } from 'vue'

const headers = [
  { label: 'Name', key: 'fullName' },
  { label: 'Email Address', key: 'email' },
  { label: 'Phone Number', key: 'phone' },
]

const sortColumn = ref('fullName')
const sortDirection = ref('asc')
const searchQuery = ref('')
const statusFilter = ref('')
const currentPage = ref(1)
const itemsPerPage = ref(5)

const applicants = [
  {
    fullName: 'Sok Dara',
    email: 'dara@example.com',
    phone: '012 345 678',
    cvUrl: '#',
    position: 'Frontend Developer',
    status: 'Pending'
  },
  {
    fullName: 'Chan Sophea',
    email: 'sophea@example.com',
    phone: '098 765 432',
    cvUrl: '#',
    position: 'UX Designer',
    status: 'Approved'
  },
  {
    fullName: 'Lim Vannak',
    email: 'vannak@example.com',
    phone: '011 223 344',
    cvUrl: '#',
    position: 'Backend Engineer',
    status: 'Rejected'
  },
  {
    fullName: 'Kong Srey Pov',
    email: 'sreypov@example.com',
    phone: '077 889 900',
    cvUrl: '#',
    position: 'Product Manager',
    status: 'Pending'
  },
  {
    fullName: 'Mao Samnang',
    email: 'samnang@example.com',
    phone: '099 887 766',
    cvUrl: '#',
    position: 'Data Analyst',
    status: 'Approved'
  }
]

const filteredApplicants = computed(() => {
  let result = [...applicants]

  if (searchQuery.value) {
    const q = searchQuery.value.toLowerCase()
    result = result.filter(
      (a) =>
        a.fullName.toLowerCase().includes(q) ||
        a.email.toLowerCase().includes(q) ||
        a.phone.toLowerCase().includes(q) ||
        a.position.toLowerCase().includes(q)
    )
  }

  if (statusFilter.value) {
    result = result.filter((a) => a.status === statusFilter.value)
  }

  result.sort((a, b) => {
    const aVal = a[sortColumn.value]
    const bVal = b[sortColumn.value]
    return sortDirection.value === 'asc'
      ? aVal.localeCompare(bVal)
      : bVal.localeCompare(aVal)
  })

  return result
})

const paginatedApplicants = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  return filteredApplicants.value.slice(start, start + itemsPerPage.value)
})

const paginationStart = computed(() => (currentPage.value - 1) * itemsPerPage.value + 1)
const paginationEnd = computed(() => Math.min(currentPage.value * itemsPerPage.value, filteredApplicants.value.length))

function getInitials(name) {
  return name
    .split(' ')
    .map((n) => n[0])
    .join('')
    .toUpperCase()
}

function viewDetails(applicant) {
  alert(`Viewing details for ${applicant.fullName}`)
  // Replace alert with modal or navigation logic
}

function statusClass(status) {
  return {
    Approved: 'bg-green-100 text-green-700',
    Pending: 'bg-yellow-100 text-yellow-700',
    Rejected: 'bg-red-100 text-red-700'
  }[status] || 'bg-gray-100 text-gray-700'
}
</script>
