<template>
  <div class="p-8 min-h-screen">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-10">Photo Gallery</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
      <div
        v-for="(photo, index) in photos"
        :key="index"
        @click="toggleDetails(index)"
        class="bg-white rounded-[10px] border border-gray-200 shadow-lg hover:shadow-xl cursor-pointer transition duration-300"
      >
        <img
          :src="photo.image"
          alt="Photo"
          :class="[
            'w-full h-52 object-cover transition-all duration-300',
            photo.show ? 'rounded-none' : 'rounded-[10px]'
          ]"
        />

        <div v-if="photo.show" class="p-4 border-t border-gray-100 bg-white rounded-b-[10px]">
          <p class="text-gray-700 font-medium mb-1">{{ photo.description }}</p>
          <p class="text-sm text-gray-500">{{ formatDate(photo.date) }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const photos = ref([
  {
    image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/Screen-Shot-2017-10-06-at-11.19.13-AM.png',
    description: 'A peaceful view of the mountains.',
    date: '2025-07-04T10:30:00',
    show: false
  },
  {
    image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/Library.jpg',
    description: 'An ancient temple hidden in the jungle.',
    date: '2025-07-02T14:15:00',
    show: false
  },
  {
    image: 'https://www.bandoskomar.org/wp-content/uploads/2020/01/SR-LS-scaled.jpg',
    description: 'Relaxing beach during golden hour.',
    date: '2025-07-01T18:30:00',
    show: false
  },
  {
    image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/sub-banner.jpg',
    description: 'Flowing river with lush surroundings.',
    date: '2025-06-28T11:00:00',
    show: false
  },
  {
    image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/sub-banner.jpg',
    description: 'Flowing river with lush surroundings.',
    date: '2025-06-28T11:00:00',
    show: false
  }
])

const toggleDetails = (index) => {
  photos.value[index].show = !photos.value[index].show
}

const formatDate = (dateStr) => {
  const date = new Date(dateStr)
  return date.toLocaleDateString(undefined, {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  })
}
</script>
