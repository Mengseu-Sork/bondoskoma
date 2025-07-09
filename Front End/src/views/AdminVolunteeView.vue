<template>
  <AdminLayout>
    <div class="h-full bg-white p-6">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Volunteer Management</h2>
        <button 
          @click="openCreateForm"
          class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center space-x-2"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
          </svg>
          <span>Add Volunteer</span>
        </button>
      </div>

      <!-- Search -->
      <div class="mb-4 max-w-md relative">
        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Search volunteers..."
          class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        />
      </div>

      <!-- Table -->
      <table class="min-w-full bg-white border rounded-lg">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-3 text-center">
              <input type="checkbox" :checked="selectAll" @change="selectAll = $event.target.checked" />
            </th>
            <th class="px-6 py-3 text-sm font-semibold text-left">Image</th>
            <th class="px-6 py-3 text-sm font-semibold text-left">Name</th>
            <th class="px-6 py-3 text-sm font-semibold text-left">Role</th>
            <th class="px-6 py-3 text-sm font-semibold text-left">Bio</th>
            <th class="px-6 py-3 text-sm font-semibold text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="volunteer in filteredVolunteers" :key="volunteer.id" class="border-t hover:bg-gray-50">
            <td class="text-center">
              <input type="checkbox" :value="volunteer.id" v-model="selectedVolunteers" />
            </td>
            <td class="px-6 py-4">
              <img v-if="volunteer.image_url" :src="volunteer.image_url" alt="Image" class="w-8 h-8 object-cover rounded" />
            </td>
            <td class="px-6 py-4">{{ volunteer.name }}</td>
            <td class="px-6 py-4">{{ volunteer.role }}</td>
            <td class="px-6 py-4">
              {{ volunteer.bio?.slice(0, 50) }}{{ volunteer.bio?.length > 50 ? '...' : '' }}
            </td>
            <td class="px-6 py-4 text-center flex justify-center space-x-2">
              <button @click="viewVolunteerDetail(volunteer)" title="View" class="text-blue-600 hover:text-blue-800">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  class="w-5 h-5"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                  />
                  <circle
                    cx="12"
                    cy="12"
                    r="3"
                    stroke="currentColor"
                    stroke-width="2"
                    fill="none"
                  />
                </svg>
              </button>
              <button @click="editVolunteer(volunteer)" title="Edit" class="text-green-600 hover:text-green-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </button>
              <button @click="deleteVolunteerConfirm(volunteer.id)" title="Delete" class="text-red-600 hover:text-red-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
            </td>
          </tr>
          <tr v-if="filteredVolunteers.length === 0">
            <td colspan="6" class="text-center py-6 text-gray-500">No volunteers found.</td>
          </tr>
        </tbody>
      </table>

      

      <!-- Form Modal -->
      <div v-if="showForm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md max-h-[90vh] overflow-y-auto">
          <h3 class="text-lg font-semibold mb-4">{{ editingVolunteer ? 'Edit Volunteer' : 'Add Volunteer' }}</h3>
          <form @submit.prevent="submitForm">
            <div class="space-y-4">
              <input v-model="form.name" type="text" placeholder="Name" class="w-full border px-3 py-2 rounded" required />
              <input type="file" @change="handleFileChange" class="w-full border px-3 py-2 rounded" :required="!editingVolunteer" />
              <textarea v-model="form.bio" placeholder="Bio" rows="3" class="w-full border px-3 py-2 rounded"></textarea>
              <input v-model="form.role" type="text" placeholder="Role" class="w-full border px-3 py-2 rounded" required />
            </div>
            <div class="flex justify-end gap-2 mt-4">
              <button type="button" @click="closeForm" class="px-4 py-2 bg-orange-400 text-white rounded">Cancel</button>
              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                {{ editingVolunteer ? 'Update' : 'Create' }}
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Detail Modal -->
      <div v-if="selectedVolunteer" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 relative overflow-y-auto max-h-[90vh]">
          <!-- Close button -->
          <button
            @click="closeDetailModal"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 focus:outline-none"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>

          <h3 class="text-2xl font-semibold mb-5 text-blue-800">Volunteer Detail</h3>

          <div class="flex items-start space-x-5">
            <img
              v-if="selectedVolunteer.image_url"
              :src="selectedVolunteer.image_url"
              alt="Volunteer Image"
              class="w-24 h-24 rounded-lg object-cover border border-gray-300"
            />
            <div class="space-y-1">
              <p class="text-xl font-semibold text-gray-800">{{ selectedVolunteer.name }}</p>
              <p class="text-lg text-gray-500">{{ selectedVolunteer.role }}</p>
            </div>
          </div>

          <div class="mt-5">
            <p class="text-sm font-medium text-gray-700">Bio:</p>
            <p class="mt-1 text-gray-700 whitespace-pre-line leading-relaxed border p-3 rounded bg-gray-50 text-sm">
              {{ selectedVolunteer.bio }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <button
        v-if="selectedVolunteers.length"
        @click="deleteSelectedVolunteers"
        class="mt-4 bg-red-600 text-white px-6 py-2 ml-6 rounded hover:bg-red-700"
      >
        Delete
    </button>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import AdminLayout from '@/components/AdminAside.vue'
import { getVolunteers, createVolunteer, updateVolunteer, deleteVolunteer } from '@/api/volunteer'

const volunteers = ref([])
const searchQuery = ref('')
const selectedVolunteers = ref([])
const showForm = ref(false)
const editingVolunteer = ref(null)
const selectedVolunteer = ref(null)
const fileInput = ref(null)
const form = ref({ name: '', image: null, role: '', bio: '' })

const fetchVolunteers = async () => {
  const data = await getVolunteers()
  volunteers.value = Array.isArray(data) ? data : data
}

const filteredVolunteers = computed(() => {
  const q = searchQuery.value.toLowerCase().trim()
  if (!q) return volunteers.value
  return volunteers.value.filter(v =>
    [v.name, v.role, v.bio].filter(Boolean).some(txt => txt.toLowerCase().includes(q))
  )
})

// Computed Select All binding for checkbox
const selectAll = computed({
  get() {
    return filteredVolunteers.value.length > 0 &&
           filteredVolunteers.value.every(v => selectedVolunteers.value.includes(v.id))
  },
  set(value) {
    if (value) {
      selectedVolunteers.value = filteredVolunteers.value.map(v => v.id)
    } else {
      selectedVolunteers.value = []
    }
  }
})

function openCreateForm() {
  resetForm()
  editingVolunteer.value = null
  showForm.value = true
}

function editVolunteer(v) {
  editingVolunteer.value = v
  form.value = { name: v.name, image: null, role: v.role, bio: v.bio }
  showForm.value = true
}

function closeForm() {
  showForm.value = false
  resetForm()
}

function resetForm() {
  form.value = { name: '', image: null, role: '', bio: '' }
  if (fileInput.value) fileInput.value.value = ''
}

function handleFileChange(e) {
  form.value.image = e.target.files[0] || null
}

async function submitForm() {
  try {
    const fd = new FormData()
    fd.append('name', form.value.name)
    fd.append('role', form.value.role)
    fd.append('bio', form.value.bio)
    if (form.value.image) fd.append('image', form.value.image)

    if (editingVolunteer.value) {
      await updateVolunteer(editingVolunteer.value.id, fd)
    } else {
      await createVolunteer(fd)
    }

    await fetchVolunteers()
    closeForm()
    selectedVolunteers.value = []
  } catch (err) {
    console.error(err.response?.data || err)
    alert('Failed to save volunteer. Please try again.')
  }
}

async function deleteVolunteerConfirm(id) {
  if (!confirm('Delete this volunteer?')) return
  await deleteVolunteer(id)
  await fetchVolunteers()
  selectedVolunteers.value = selectedVolunteers.value.filter(x => x !== id)
}

async function deleteSelectedVolunteers() {
  if (!confirm(`Delete ${selectedVolunteers.value.length} volunteers?`)) return
  for (const id of selectedVolunteers.value) {
    await deleteVolunteer(id)
  }
  await fetchVolunteers()
  selectedVolunteers.value = []
}

function viewVolunteerDetail(v) {
  selectedVolunteer.value = v
}

function closeDetailModal() {
  selectedVolunteer.value = null
}

onMounted(fetchVolunteers)
</script>