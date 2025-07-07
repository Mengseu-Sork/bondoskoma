<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Video Gallery</h1>
    <p v-if="message" class="text-red-500">{{ message }}</p>

    <div
      v-if="videos.length"
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4"
    >
      <div
        v-for="(video, index) in videos"
        :key="index"
        class="bg-white shadow-md rounded-lg p-4"
      >
        <!-- YouTube Embed -->
        <iframe
          v-if="isYouTube(video.video_file)"
          :src="embedYouTube(video.video_file)"
          frameborder="0"
          allow="encrypted-media"
          allowfullscreen
          class="w-full h-64 rounded"
        ></iframe>

        <!-- Direct Video -->
        <video
          v-else
          controls
          loop
          muted
          class="w-full rounded"
        >
          <source :src="video.video_file" type="video/mp4" />
          Your browser does not support the video tag.
        </video>

        <!-- Description with "See More / See Less" -->
        <p class="mt-2 text-gray-700">
          {{
            isExpanded[index] || video.description.length <= limit
              ? video.description
              : video.description.slice(0, limit) + '...'
          }}
          <button
            v-if="video.description.length > limit"
            @click="toggleExpand(index)"
            class="text-blue-500 ml-1 underline"
          >
            {{ isExpanded[index] ? 'See Less' : 'See More' }}
          </button>
        </p>
      </div>
    </div>

    <!-- Show message if no videos found -->
    <p v-else class="text-gray-500">No videos available.</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '@/plugin/axios' // Make sure this points to your axios instance

const videos = ref([])
const message = ref('')
const isExpanded = ref([])
const limit = 100

// Check if the video link is a YouTube URL
function isYouTube(url) {
  return url.includes('youtube.com') || url.includes('youtu.be')
}

// Convert YouTube URL to embeddable iframe link
function embedYouTube(url) {
  const videoIdMatch = url.match(/(?:youtu\.be\/|v=)([\w-]+)/)
  const videoId = videoIdMatch ? videoIdMatch[1] : null
  return videoId
    ? `https://www.youtube.com/embed/${videoId}?rel=0&loop=1&playlist=${videoId}`
    : ''
}

// Toggle "See More / See Less"
function toggleExpand(index) {
  isExpanded.value[index] = !isExpanded.value[index]
}

// Fetch videos on mount
onMounted(async () => {
  try {
    const res = await api.get('/videos') // from http://127.0.0.1:8000/api/videos
    videos.value = res.data
    isExpanded.value = videos.value.map(() => false)
  } catch (error) {
    message.value = 'Failed to load videos.'
    console.error(error)
  }
})
</script>

<style scoped>
iframe,
video {
  aspect-ratio: 16 / 9;
}
</style>
