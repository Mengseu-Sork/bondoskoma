<template>
  <router-link
    :to="`/jobs/${job.id}`"
    class="flex flex-col sm:flex-row justify-between gap-4 p-4 border-b hover:bg-blue-50 transition"
  >
    <!-- Left: Icon + Info -->
    <div class="flex gap-4 sm:gap-6 items-start sm:items-center">
      <div class="w-16 h-16 rounded-lg border-2 border-blue-400 flex items-center justify-center overflow-hidden flex-shrink-0">
        <img src="../../icon.png" class="w-full h-full p-2 object-contain" alt="Job Icon" />
      </div>
      <div>
        <h2 class="text-blue-500 text-lg sm:text-xl font-bold">{{ job.title }}</h2>
        <p class="text-gray-500 text-sm sm:text-base">Posted {{ job.posted }}</p>
      </div>
    </div>

    <!-- Right: Location and Type -->
    <div class="text-left sm:text-right whitespace-normal sm:whitespace-nowrap">
      <p class="text-gray-500 text-sm sm:text-base">{{ job.location }}</p>
      <p class="text-blue-600 font-semibold text-sm sm:text-base">{{ job.type }}</p>
    </div>
  </router-link>
</template>

<script setup>
defineProps({
  job: Object,
})
</script>
