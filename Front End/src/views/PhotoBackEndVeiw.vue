<template>
  <AdminAside>
    <div class="p-4 sm:p-6 min-h-screen bg-gray-50">
      <!-- Header -->
      <div class="mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-7xl text-center mb-4">Photo Gallery</h1>
        <!-- Error Message -->
        <div v-if="message" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 text-center">
          {{ message }}
        </div>
      </div>
  
      <!-- Controls Section -->
      <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
        <!-- Mobile: Stack vertically, Desktop: Flex row -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
          
          <!-- Search and Filter Section -->
          <div class="flex flex-col sm:flex-row gap-3 flex-1">
            <!-- Search Input -->
            <div class="flex-1">
              <div class="relative">
                <input
                  v-model="searchQuery"
                  type="text"
                  placeholder="Search by description..."
                  class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                />
                <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </div>
            </div>
  
            <!-- Date Filter -->
            <div class="sm:w-40">
              <input
                v-model="selectedDate"
                type="date"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
              />
            </div>
  
            <!-- Search Button -->
            <button
              @click="applyFilters"
              class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium"
            >
              Search
            </button>
          </div>
  
          <!-- Create Button -->
          <button
            @click="openCreateForm"
            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors text-sm font-medium flex items-center justify-center gap-2"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Photo
          </button>
        </div>
      </div>
  
      <!-- Modal Form (Create/Edit) -->
      <div v-if="showForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
          <div class="p-6">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-lg font-semibold text-gray-800">
                {{ isEditing ? 'Edit Photo' : 'Upload New Photo' }}
              </h2>
              <button
                @click="closeForm"
                class="text-gray-400 hover:text-gray-600 text-2xl leading-none"
              >
                ×
              </button>
            </div>
            
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                <input 
                  type="file" 
                  accept="image/*" 
                  @change="previewImage"
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                />
                <p v-if="isEditing" class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
              </div>
              
              <div v-if="imagePreview || (isEditing && editingPhoto)" class="flex justify-center">
                <img 
                  :src="imagePreview || (isEditing ? editingPhoto.image_url : '')" 
                  alt="Preview" 
                  class="w-24 h-24 object-cover rounded-lg border-2 border-gray-200" 
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea
                  v-model="description"
                  rows="3"
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm resize-none"
                  placeholder="Enter image description..."
                ></textarea>
              </div>
              
              <button
                @click="submitForm"
                :disabled="isSubmitting"
                class="w-full bg-blue-500 text-white px-4 py-3 rounded-lg hover:bg-blue-600 transition-colors disabled:opacity-50 font-medium"
              >
                {{ isSubmitting ? 'Processing...' : (isEditing ? 'Update Photo' : 'Upload Photo') }}
              </button>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Results Info -->
      <div class="flex justify-between items-center mb-4 text-sm text-gray-600">
        <span>{{ filteredPhotos.length }} photo(s) found</span>
        <button
          v-if="searchQuery || selectedDate"
          @click="clearFilters"
          class="text-blue-500 hover:text-blue-700"
        >
          Clear filters
        </button>
      </div>
  
      <!-- Mobile Cards View (visible on small screens) -->
      <div class="block lg:hidden space-y-4">
        <div
          v-for="(photo, index) in filteredPhotos"
          :key="photo.id"
          class="bg-white rounded-lg shadow-sm border border-gray-200 p-4"
        >
          <div class="flex gap-4">
            <div class="flex-shrink-0">
              <img
                :src="photo.image_url"
                alt="Photo"
                class="w-16 h-16 object-cover rounded-lg border border-gray-200"
              />
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex justify-between items-start mb-2">
                <span class="text-sm font-medium text-gray-900">#{{ index + 1 }}</span>
                <span class="text-xs text-gray-500">{{ photo.created_at_formatted }}</span>
              </div>
              <p class="text-sm text-gray-700 mb-3 line-clamp-2">
                {{ photo.description || 'No description' }}
              </p>
              <div class="flex gap-2">
                <button
                  @click="handleEdit(photo)"
                  class="flex-1 bg-yellow-500 text-white px-3 py-2 rounded-md hover:bg-yellow-600 transition-colors text-xs font-medium"
                >
                  Edit
                </button>
                <button
                  @click="handleDelete(photo)"
                  class="flex-1 bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600 transition-colors text-xs font-medium"
                >
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Desktop Table View (hidden on small screens) -->
      <div class="hidden lg:block overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
        <table class="min-w-full text-sm text-left">
          <thead class="bg-gray-50 text-gray-700">
            <tr>
              <th class="px-6 py-4 font-medium">ID</th>
              <th class="px-6 py-4 font-medium">Image</th>
              <th class="px-6 py-4 font-medium">Description</th>
              <th class="px-6 py-4 font-medium">Created At</th>
              <th class="px-6 py-4 font-medium">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <tr
              v-for="(photo, index) in filteredPhotos"
              :key="photo.id"
              class="hover:bg-gray-50 transition-colors"
            >
              <td class="px-6 py-4 font-medium text-gray-900">{{ index + 1 }}</td>
              <td class="px-6 py-4">
                <img
                  :src="photo.image_url"
                  alt="Photo"
                  class="w-16 h-16 object-cover rounded-lg border border-gray-200"
                />
              </td>
              <td class="px-6 py-4 text-gray-700 max-w-xs">
                <div class="line-clamp-2">{{ photo.description || 'No description' }}</div>
              </td>
              <td class="px-6 py-4 text-gray-600">{{ photo.created_at_formatted }}</td>
              <td class="px-6 py-4">
                <div class="flex gap-2">
                  <button
                    @click="handleEdit(photo)"
                    class="bg-yellow-500 text-white px-3 py-1.5 rounded-md hover:bg-yellow-600 transition-colors text-xs font-medium"
                  >
                    Edit
                  </button>
                  <button
                    @click="handleDelete(photo)"
                    class="bg-red-500 text-white px-3 py-1.5 rounded-md hover:bg-red-600 transition-colors text-xs font-medium"
                  >
                    Delete
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Empty State -->
      <div v-if="filteredPhotos.length === 0" class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">No photos found</h3>
        <p class="mt-1 text-sm text-gray-500">
          {{ searchQuery || selectedDate ? 'Try adjusting your search criteria.' : 'Get started by uploading a new photo.' }}
        </p>
      </div>
    </div>
  </AdminAside>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import api from '@/plugin/axios'
import AdminAside from '@/components/AdminAside.vue'

const photos = ref([])
const message = ref('')
const showForm = ref(false)
const description = ref('')
const imageFile = ref(null)
const imagePreview = ref(null)
const isEditing = ref(false)
const editingPhoto = ref(null)
const isSubmitting = ref(false)

// Filter states
const searchQuery = ref('')
const selectedDate = ref('')

// Computed properties
const filteredPhotos = computed(() => {
  let filtered = photos.value

  // Filter by search query
  if (searchQuery.value.trim()) {
    const query = searchQuery.value.toLowerCase().trim()
    filtered = filtered.filter(photo => 
      photo.description && photo.description.toLowerCase().includes(query)
    )
  }

  // Filter by date
  if (selectedDate.value) {
    filtered = filtered.filter(photo => {
      try {
        // Parse photo date and format to YYYY-MM-DD in local time
        const photoDate = new Date(photo.created_at_formatted)
        if (isNaN(photoDate.getTime())) {
          console.warn(`Invalid date format for photo ID ${photo.id}: ${photo.created_at_formatted}`)
          return false
        }
        // Format date as YYYY-MM-DD in local time
        const formattedPhotoDate = `${photoDate.getFullYear()}-${String(photoDate.getMonth() + 1).padStart(2, '0')}-${String(photoDate.getDate()).padStart(2, '0')}`
        // Log for debugging
        console.log(`Comparing photo date ${formattedPhotoDate} with selected date ${selectedDate.value}`)
        return formattedPhotoDate === selectedDate.value
      } catch (error) {
        console.error(`Error parsing date for photo ID ${photo.id}: ${photo.created_at_formatted}`, error)
        return false
      }
    })
  }

  return filtered
})

// Load all images on page load
onMounted(async () => {
  try {
    const res = await api.get('/images')
    photos.value = res.data
    // Log API response for debugging date formats
    console.log('API response:', res.data)
  } catch (error) {
    message.value = 'Failed to load images.'
    console.error(error)
  }
})

// Filter functions
function applyFilters() {
  // Filters apply automatically via computed property
}

const clearFilters = () => {
  searchQuery.value = ''
  selectedDate.value = ''
}

// Form functions
const openCreateForm = () => {
  isEditing.value = false
  editingPhoto.value = null
  description.value = ''
  imageFile.value = null
  imagePreview.value = null
  showForm.value = true
}

const closeForm = () => {
  showForm.value = false
  isEditing.value = false
  editingPhoto.value = null
  description.value = ''
  imageFile.value = null
  imagePreview.value = null
}

const previewImage = (e) => {
  const file = e.target.files[0]
  if (file) {
    imageFile.value = file
    imagePreview.value = URL.createObjectURL(file)
  }
}

const submitForm = async () => {
  if (!isEditing.value && !imageFile.value) {
    alert('Please select an image.')
    return
  }
  
  isSubmitting.value = true
  const formData = new FormData()
  
  if (imageFile.value) {
    formData.append('image_file', imageFile.value)
  }
  formData.append('description', description.value)
  
  try {
    let res
    if (isEditing.value) {
      res = await api.post(`/images/${editingPhoto.value.id}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'X-HTTP-Method-Override': 'PUT'
        },
      })
      
      const index = photos.value.findIndex(p => p.id === editingPhoto.value.id)
      if (index !== -1) {
        photos.value[index] = res.data.image
      }
    } else {
      res = await api.post('/images', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })
      
      photos.value.unshift(res.data.image)
    }
    
    closeForm()
    message.value = ''
  } catch (error) {
    console.error(error)
    message.value = isEditing.value ? 'Failed to update image.' : 'Failed to upload image.'
  } finally {
    isSubmitting.value = false
  }
}

const handleEdit = (photo) => {
  isEditing.value = true
  editingPhoto.value = photo
  description.value = photo.description || ''
  imageFile.value = null
  imagePreview.value = null
  showForm.value = true
}

const handleDelete = async (photo) => {
  if (confirm(`Are you sure you want to delete this photo?`)) {
    try {
      await api.delete(`/images/${photo.id}`)
      photos.value = photos.value.filter(p => p.id !== photo.id)
      message.value = ''
    } catch (error) {
      console.error(error)
      message.value = 'Failed to delete photo.'
    }
  }
}
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>