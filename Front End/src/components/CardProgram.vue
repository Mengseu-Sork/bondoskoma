<template>
  <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden flex flex-col h-full">
    <!-- Card Image -->
    <img :src="image" alt="Card image" class="w-full h-64 object-cover" />

    <!-- Card Content -->
    <div class="p-6 flex flex-col flex-grow">
      <h2 class="text-2xl font-semibold mb-2">{{ title }}</h2>
      <p class="mb-4 mt-10 text-lg">
        <strong>Goal:</strong> {{ goal }}
      </p>

      <!-- Justification Preview -->
      <div v-if="justification && justification.length" class="flex-grow">
        <h3 class="font-semibold text-lg mb-1">Justification:</h3>
        <ul
          class="list-disc list-inside space-y-1 text-lg"
          :style="{
            maxHeight: showMore ? 'none' : '1.8em',
            overflow: showMore ? 'visible' : 'hidden'
          }"
        >
          <li v-for="(item, idx) in justification" :key="idx">{{ item }}</li>
        </ul>
      </div>

      <!-- Show More Button -->
      <div class="mt-6 flex justify-center">
        <button
          class="px-4 py-2 bg-blue-700 hover:bg-blue-800 rounded-lg text-sm text-white hover:underline focus:outline-none flex items-center gap-1"
          @click="isModalOpen = true"
        >
          <span>Show More</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-4 w-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Modal Overlay -->
    <div
        v-if="isModalOpen"
        class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center p-4"
        >
        <div
            class="bg-white rounded-lg shadow-lg w-[90%] max-w-2xl max-h-[90vh] overflow-y-auto p-6"
        >
            <img :src="image" alt="Card image" class="w-full h-64 object-cover mb-4" />
            
            <h2 class="text-xl font-bold mb-2">{{ title }}</h2>

            <p class="mb-4 text-base"><strong>Goal:</strong> {{ goal }}</p>

            <div>
            <h3 class="font-semibold mb-1">Justification:</h3>
            <ul class="list-disc list-inside space-y-1 text-base">
                <li v-for="(item, idx) in justification" :key="idx">{{ item }}</li>
            </ul>
            </div>

            <div class="mt-4 text-right">
            <button
                @click="isModalOpen = false"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                Close
            </button>
            </div>
        </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

defineProps({
  image: String,
  title: String,
  goal: String,
  justification: Array,
})

const showMore = ref(false)
const isModalOpen = ref(false)
</script>
