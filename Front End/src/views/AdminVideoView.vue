<template>
  <AdminLayout>
    <div class="h-full p-6 bg-white">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Video Management</h2>
        <button @click="openForm()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          + Add Video
        </button>
      </div>

      <!-- Select All + Delete Selected -->
      <div class="flex items-center justify-between mb-4">
        <div>
          <input type="checkbox" v-model="selectAll" @change="toggleSelectAll" />
          <label class="ml-2 text-sm text-gray-700">Select All</label>
        </div>
        <button
          v-if="selectedVideos.length"
          @click="deleteSelectedVideos"
          class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
        >
          Delete Selected ({{ selectedVideos.length }})
        </button>
      </div>

      <!-- Video Card Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
        <div
          v-for="video in videos"
          :key="video.id"
          class="border rounded-lg p-6 shadow-sm hover:shadow-md transition relative"
        >
          <div class="flex justify-between items-start mb-2">
            <input type="checkbox" :value="video.id" v-model="selectedVideos" />
            <div class="flex justify-end space-x-2 text-sm">
              <button @click="openForm(video)" class="text-blue-600 hover:underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </button>
              <button @click="confirmDelete(video.id)" class="text-red-600 hover:underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
            </div>
          </div>

          <!-- Embedded YouTube -->
          <div class="relative w-full pb-[56.25%] mb-4 rounded overflow-hidden">
            <iframe
              class="absolute top-0 left-0 w-full h-full"
              :src="getEmbedUrl(video.video_file)"
              frameborder="0"
              allowfullscreen
            ></iframe>
          </div>
          <h3 class="font-semibold text-lg truncate w-3/4">{{ video.description || 'No Title' }}</h3>

          
        </div>
      </div>

      <!-- Empty State -->
      <div v-if="videos.length === 0" class="text-center text-gray-500 mt-8">
        No videos available.
      </div>

      <!-- Form Modal -->
      <div v-if="showForm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded shadow-lg">
          <h3 class="text-lg font-semibold mb-4">{{ editingVideo ? 'Edit' : 'Create' }} Video</h3>
          <form @submit.prevent="submitForm">
            <div class="space-y-4">
              <input
                v-model="form.video_file"
                type="url"
                placeholder="YouTube Video URL"
                class="w-full border px-3 py-2 rounded"
                required
              />
              <textarea
                v-model="form.description"
                placeholder="Description (optional)"
                class="w-full border px-3 py-2 rounded"
              ></textarea>
            </div>
            <div class="mt-6 flex justify-end gap-2">
              <button @click="closeForm" type="button" class="px-4 py-2 bg-orange-400 text-white rounded">Cancel</button>
              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                {{ editingVideo ? 'Update' : 'Create' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import AdminLayout from '@/components/AdminAside.vue'
import {
  getVideos,
  createVideo,
  updateVideo,
  deleteVideo
} from '@/api/video'

const videos = ref([])
const showForm = ref(false)
const editingVideo = ref(null)
const form = ref({ video_file: '', description: '' })

const selectedVideos = ref([])
const selectAll = ref(false)

const loadVideos = async () => {
  videos.value = await getVideos()
}

onMounted(loadVideos)

const openForm = (video = null) => {
  editingVideo.value = video
  form.value = video
    ? {
        video_file: video.video_file,
        description: video.description ?? ''
      }
    : { video_file: '', description: '' }
  showForm.value = true
}

const closeForm = () => {
  showForm.value = false
  editingVideo.value = null
}

const submitForm = async () => {
  try {
    if (editingVideo.value) {
      await updateVideo(editingVideo.value.id, form.value)
    } else {
      await createVideo(form.value)
    }
    closeForm()
    await loadVideos()
  } catch (e) {
    console.error('Error submitting form:', e)
  }
}

const confirmDelete = async (id) => {
  if (confirm('Are you sure you want to delete this video?')) {
    await deleteVideo(id)
    await loadVideos()
  }
}

const deleteSelectedVideos = async () => {
  if (confirm(`Delete ${selectedVideos.value.length} selected video(s)?`)) {
    for (const id of selectedVideos.value) {
      await deleteVideo(id)
    }
    selectedVideos.value = []
    selectAll.value = false
    await loadVideos()
  }
}

const toggleSelectAll = () => {
  if (selectAll.value) {
    selectedVideos.value = videos.value.map(v => v.id)
  } else {
    selectedVideos.value = []
  }
}

// Helper to convert YouTube URL to embed format
const getEmbedUrl = (url) => {
  const match = url.match(/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/watch\?v=)([\w-]+)/)
  const videoId = match?.[1]
  return videoId ? `https://www.youtube.com/embed/${videoId}` : ''
}

watch(videos, () => {
  if (selectAll.value) {
    selectedVideos.value = videos.value.map(v => v.id)
  }
})
</script>

<style scoped>
/* Optional style for better appearance */
</style>
