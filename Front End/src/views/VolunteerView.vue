<template>
 <h1 class="text-2xl font-bold text-center">Our Volunteer</h1>
  <div class="flex flex-wrap p-8 gap-6 pt-16">
    <div
      v-for="(person, index) in profiles"
      :key="index"
      class="bg-white rounded-2xl shadow-lg text-center max-w-xs w-full pt-16 pb-6 px-6 relative my-6"
    >
      <!-- Profile Image -->
      <div class="absolute -top-12 left-1/2 transform -translate-x-1/2">
        <img
          :src="person.image_url"
          alt="Profile"
          class="w-24 h-24 object-cover rounded-full border-4 border-white shadow-md"
        />
      </div>

      <!-- Role -->
      <p class="text-sm text-gray-400 mt-4">{{ person.role }}</p>

      <!-- Name -->
      <h2 class="text-xl font-semibold text-gray-800 mt-1">Name: {{ person.name }}</h2>

      <!-- Description Box with fixed height -->
      <div class="h-[72px] mt-3 overflow-hidden">
        <p class="text-gray-500 text-sm line-clamp-3">
          {{ person.bio }}
        </p>
      </div>

      <!-- View Details Button (always in same spot) -->
      <div class="mt-5">
        <button
          @click="openModal(person)"
          class="bg-blue-500 hover:bg-blue-600 text-white font-medium text-sm py-2 px-6 rounded-full shadow transition duration-300"
        >
          View Details
        </button>
      </div>
    </div>

    <!-- Modal -->
    <div v-if="selectedProfile" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-xl max-w-md w-full p-6 relative shadow-lg">
        <button
          @click="selectedProfile = null"
          class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl"
        >
          ✕
        </button>

        <div class="text-center">
          <img
            :src="selectedProfile.image_url"
            alt="Profile"
            class="w-24 h-24 object-cover rounded-full border-4 border-white mx-auto shadow"
          />
          <h3 class="text-xl font-bold mt-4">{{ selectedProfile.name }}</h3>
          <p class="text-gray-500 text-sm">{{ selectedProfile.role }}</p>
          <p class="text-gray-600 mt-4 text-sm">{{ selectedProfile.bio }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getVolunteers } from '@/api/volunteer'

const profiles = ref([])
const selectedProfile = ref(null)

const openModal = (person) => {
  selectedProfile.value = person
}

// Fetch volunteers from API
onMounted(async () => {
  profiles.value = await getVolunteers()
})
</script>
