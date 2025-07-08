<template>
  <AdminLayout>
    <div class="h-full">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl px-8 py-6 font-bold text-gray-800">Job Management</h2>
        <button @click="openCreateForm" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 mr-6 rounded-lg font-medium transition-colors duration-200 flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span>Add Jobs</span>
        </button>
      </div>

      <div class="bg-white border-b border-gray-200 px-8 py-4">
        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
          <!-- Search Bar -->
          <div class="relative flex-1 max-w-md">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Search jobs . . ."
              class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
          </div>
        </div>
      </div>

      <table class="min-w-full bg-white border rounded-lg">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <input 
                    type="checkbox" 
                    v-model="selectAll"
                    @change="toggleSelectAll"
                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                  />
            </th>
            <th class="px-4 py-2 text-left text-sm font-semibold">Title</th>
            <th class="px-4 py-2 text-left text-sm font-semibold">Location</th>
            <th class="px-4 py-2 text-left text-sm font-semibold">Type</th>
            <th class="px-4 py-2 text-left text-sm font-semibold">Posted Date</th>
            <th class="px-4 py-2 text-center text-sm font-semibold">Department</th>
            <th class="px-4 py-2 text-sm font-semibold text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="job in filteredJobs" :key="job.id" class="border-t hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
                  <input 
                    type="checkbox" 
                    :value="job.id"
                    v-model="selectedJobs"
                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                  />
            </td>
            <td class="px-4 py-2">{{ job.title }}</td>
            <td class="px-4 py-2">{{ job.location }}</td>
            <td class="px-4 py-2">{{ job.type }}</td>
            <td class="px-4 py-2">{{ new Date(job.posted_date).toLocaleDateString() }}</td>
            <td class="px-4 py-2 text-center">{{ job.department }}</td>
            <td class="px-4 py-2 text-center space-x-2">
                <button 
                    @click="editJob(job)" class="text-blue-600 hover:underline text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </button>
                <button 
                    @click="deleteJobConfirm(job.id)" class="text-red-600 hover:underline text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </td>
          </tr>
          <tr v-if="filteredJobs.length === 0">
            <td colspan="5" class="text-center py-6 text-gray-500">No jobs found.</td>
          </tr>
          
        </tbody>
      </table>

      <!-- Form Modal -->
      <div v-if="showForm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md max-h-[90vh] overflow-y-auto">
          <h3 class="text-lg font-semibold mb-4">{{ editingJob ? 'Edit Job' : 'Create Job' }}</h3>
          <form @submit.prevent="submitForm">
            <div class="space-y-3">
                <input v-model="form.title" type="text" placeholder="Title" class="w-full border px-3 py-2 rounded" required>
                <input v-model="form.location" type="text" placeholder="Location" class="w-full border px-3 py-2 rounded" required>
                <select v-model="form.type" class="w-full border px-3 py-2 rounded" required>
                    <option value="" disabled>Select Type</option>
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                    <option value="Sit Time">Sit Time</option>
                </select>
                <input v-model="form.department" type="text" placeholder="Department" class="w-full border px-3 py-2 rounded" required>
                <input v-model="form.posted_date" type="date" class="w-full border px-3 py-2 rounded" required>

                <!-- Responsibilities -->
                <div>
                    <label class="block font-semibold">Responsibilities</label>
                    <div v-for="(item, index) in form.responsibilities" :key="'res-' + index" class="flex gap-2 mb-2">
                        <input v-model="form.responsibilities[index]" type="text" class="flex-1 border px-3 py-2 rounded" required>
                        <button type="button" @click="form.responsibilities.splice(index, 1)" class="text-red-600">Remove</button>
                    </div>
                    <button type="button" @click="form.responsibilities.push('')" class="text-blue-600">+ Add Responsibility</button>
                </div>

                <!-- Qualifications -->
                <div>
                    <label class="block font-semibold">Qualifications</label>
                    <div v-for="(item, index) in form.qualifications" :key="'qual-' + index" class="flex gap-2 mb-2">
                        <input v-model="form.qualifications[index]" type="text" class="flex-1 border px-3 py-2 rounded" required>
                        <button type="button" @click="form.qualifications.splice(index, 1)" class="text-red-600">Remove</button>
                    </div>
                    <button type="button" @click="form.qualifications.push('')" class="text-blue-600">+ Add Qualification</button>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-4">
              <button type="button" @click="closeForm" class="px-4 py-2 bg-orange-400 text-white rounded">Cancel</button>
              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                {{ editingJob ? 'Update' : 'Create' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <button
        v-if="selectedJobs.length"
        @click="deleteSelectedJobs"
        class="mb-4 bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition"
        >
        Delete
    </button>
  </AdminLayout>
</template>

<script setup>
import { ref, onMounted, computed, watch } from 'vue'
import AdminLayout from '@/components/AdminAside.vue'
import {
  getJobs,
  createJob,
  updateJob,
  deleteJob as apiDeleteJob
} from '@/api/job'

// State
const jobs = ref([])
const showForm = ref(false)
const editingJob = ref(null)
const searchQuery = ref('')
const selectedJobs = ref([])
const selectAll = ref(false)
const form = ref({
  title: '',
  location: '',
  type: '',
  department: '',
  posted_date: '',
  responsibilities: [''],
  qualifications: ['']
})

// Load jobs
const loadJobs = async () => {
  try {
    jobs.value = await getJobs()
  } catch (error) {
    console.error('Failed to load jobs:', error)
  }
}
onMounted(loadJobs)

// Open form to create
const openCreateForm = () => {
  editingJob.value = null
  form.value = {
    title: '',
    location: '',
    type: '',
    department: '',
    posted_date: '',
    responsibilities: [''],
    qualifications: ['']
  }
  showForm.value = true
}

// Edit existing job
const editJob = (job) => {
  editingJob.value = job
  form.value = {
    title: job.title,
    location: job.location,
    type: job.type,
    department: job.department,
    posted_date: job.posted_date,
    responsibilities: Array.isArray(job.responsibilities) ? job.responsibilities : [],
    qualifications: Array.isArray(job.qualifications) ? job.qualifications : []
  }
  showForm.value = true
}

// Close modal
const closeForm = () => {
  showForm.value = false
}

// Submit create or update
const submitForm = async () => {
  try {
    if (editingJob.value) {
      await updateJob(editingJob.value.id, form.value)
    } else {
      await createJob(form.value)
    }
    closeForm()
    loadJobs()
  } catch (error) {
    console.error('Failed to save job:', error)
  }
}

// Delete job
const deleteJobConfirm = async (id) => {
  if (confirm('Are you sure you want to delete this job?')) {
    try {
      await apiDeleteJob(id)
      loadJobs()
    } catch (error) {
      console.error('Failed to delete job:', error)
    }
  }
}

const filteredJobs = computed(() => {
  if (!searchQuery.value) return jobs.value
  const query = searchQuery.value.toLowerCase()
  return jobs.value.filter(job =>
    job.title.toLowerCase().includes(query) ||
    job.location.toLowerCase().includes(query) ||
    job.type.toLowerCase().includes(query) ||
    job.department.toLowerCase().includes(query)
  )
})

const toggleSelectAll = () => {
  if (selectAll.value) {
    selectedJobs.value = filteredJobs.value.map(job => job.id)
  } else {
    selectedJobs.value = []
  }
}

watch(selectedJobs, (newVal) => {
  selectAll.value = newVal.length === filteredJobs.value.length && filteredJobs.value.length > 0
})

const deleteSelectedJobs = async () => {
  if (!selectedJobs.value.length) return
  if (confirm('Are you sure you want to delete the selected jobs?')) {
    try {
      await Promise.all(selectedJobs.value.map(id => apiDeleteJob(id)))
      selectedJobs.value = []
      selectAll.value = false
      await loadJobs()
    } catch (error) {
      console.error('Failed to delete selected jobs:', error)
    }
  }
}

</script>
