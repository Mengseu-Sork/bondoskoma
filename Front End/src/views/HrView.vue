<template>
  <div class="p-6 bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
      <div>
        <h2 class="text-3xl font-bold text-slate-800 mb-6 text-center">Applicant List</h2>
        <!-- <p class="text-sm text-gray-500 mt-1">Showing {{ filteredApplicants.length }} applicants</p> -->
      </div>
      <div class="relative w-full sm:w-56">
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Search..."
          class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
        >
        <svg class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-500">
      <table class="min-w-full divide-y divide-gray-500 ">
        <thead class="bg-gray-50 text-3xl font-bold text-slate-800 mb-6 text-center">
          <tr>
            <th 
              v-for="(header, index) in headers" 
              :key="index"
              class="px-4 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider cursor-pointer "
              @click="sortTable(header.key)"
            >
              <div class="flex items-center">
                {{ header.label }}
                <svg 
                  v-if="sortColumn === header.key" 
                  class="w-3 h-3 ml-1" 
                  :class="{ 'transform rotate-180': sortDirection === 'desc' }"
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24" 
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-500 ">
          <tr 
            v-for="(applicant, index) in paginatedApplicants" 
            :key="index"
            class="hover:bg-gray-50 transition-colors duration-150 "
          >
            <td class="px-4 py-3 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 text-xs font-medium">
                  {{ getInitials(applicant.fullName) }}
                </div>
                <div class="ml-3">
                  <div class="text-sm font-medium text-gray-800">{{ applicant.fullName }}</div>
                  <div class="text-xs text-gray-500">{{ applicant.position }}</div>
                </div>
              </div>
            </td>
            <td class="px-4 py-3 text-sm text-gray-600">
              {{ applicant.email }}
            </td>
            <td class="px-4 py-3 text-sm text-gray-600">
              {{ applicant.phone }}
            </td>
            <td class="px-4 py-3 whitespace-nowrap">
              <span class="px-2 py-1 inline-flex text-xs leading-4 font-medium rounded" 
                :class="{
                  'bg-green-50 text-green-700': applicant.status === 'Approved',
                  'bg-yellow-50 text-yellow-700': applicant.status === 'Pending',
                  'bg-red-50 text-red-700': applicant.status === 'Rejected'
                }"
              >
                {{ applicant.status }}
              </span>
            </td>
            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
              <div class="flex space-x-2">
                <a
                  :href="applicant.cvUrl"
                  target="_blank"
                  class="inline-flex items-center px-2.5 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-1 focus:ring-blue-500"
                >
                  CV
                </a>
                <button
                  @click="viewDetails(applicant)"
                  class="inline-flex items-center px-2.5 py-1 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500"
                >
                  View
                </button>
              </div>
            </td>
          </tr>
          <tr v-if="filteredApplicants.length === 0">
            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
              No matching applicants found
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
      <div class="text-xs text-gray-500">
        Showing {{ Math.min(filteredApplicants.length, currentPage * itemsPerPage) }} of {{ filteredApplicants.length }} applicants
      </div>
      <div class="flex space-x-2">
        <button 
          class="px-3 py-1 border rounded text-xs font-medium"
          :class="{
            'bg-gray-50 text-gray-400 cursor-not-allowed': currentPage === 1,
            'bg-white text-gray-600 hover:bg-gray-50': currentPage > 1
          }"
          :disabled="currentPage === 1"
          @click="currentPage--"
        >
          Previous
        </button>
        <button 
          class="px-3 py-1 border rounded text-xs font-medium"
          :class="{
            'bg-gray-50 text-gray-400 cursor-not-allowed': currentPage * itemsPerPage >= filteredApplicants.length,
            'bg-white text-gray-600 hover:bg-gray-50': currentPage * itemsPerPage < filteredApplicants.length
          }"
          :disabled="currentPage * itemsPerPage >= filteredApplicants.length"
          @click="currentPage++"
        >
          Next
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const headers = [
  { label: 'Applicant', key: 'fullName' },
  { label: 'Email', key: 'email' },
  { label: 'Phone', key: 'phone' },
  { label: 'Status', key: 'status' }
];

const sortColumn = ref('fullName');
const sortDirection = ref('asc');
const searchQuery = ref('');
const currentPage = ref(1);
const itemsPerPage = ref(5);

const applicants = [
  {
    fullName: "Sok Dara",
    email: "dara@example.com",
    phone: "012 345 678",
    cvUrl: "#",
    position: "Frontend Developer",
    status: "Pending"
  },
  {
    fullName: "Chan Sophea",
    email: "sophea@example.com",
    phone: "098 765 432",
    cvUrl: "#",
    position: "UX Designer",
    status: "Approved"
  },
  {
    fullName: "Lim Vannak",
    email: "vannak@example.com",
    phone: "011 223 344",
    cvUrl: "#",
    position: "Backend Engineer",
    status: "Rejected"
  },
  {
    fullName: "Kong Srey Pov",
    email: "sreypov@example.com",
    phone: "077 889 900",
    cvUrl: "#",
    position: "Product Manager",
    status: "Pending"
  }
];

const filteredApplicants = computed(() => {
  let result = [...applicants];
  
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase();
    result = result.filter(applicant => 
      applicant.fullName.toLowerCase().includes(query) ||
      applicant.email.toLowerCase().includes(query) ||
      applicant.phone.toLowerCase().includes(query) ||
      applicant.position.toLowerCase().includes(query)
    );
  }
  
  if (sortColumn.value) {
    result.sort((a, b) => {
      const aValue = a[sortColumn.value];
      const bValue = b[sortColumn.value];
      
      if (aValue < bValue) return sortDirection.value === 'asc' ? -1 : 1;
      if (aValue > bValue) return sortDirection.value === 'asc' ? 1 : -1;
      return 0;
    });
  }
  
  return result;
});

const paginatedApplicants = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  const end = start + itemsPerPage.value;
  return filteredApplicants.value.slice(start, end);
});

function sortTable(column) {
  if (sortColumn.value === column) {
    sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
  } else {
    sortColumn.value = column;
    sortDirection.value = 'asc';
  }
}

function getInitials(name) {
  return name.split(' ').map(n => n[0]).join('').toUpperCase();
}

function viewDetails(applicant) {
  console.log("Viewing details for", applicant.fullName);
  // Implement your detail view logic here
}
</script>