<!-- src/components/JobCard.vue -->
<template>
  <router-link
    :to="`/jobs/${encodeURIComponent(job.title)}`"
    class="flex items-center justify-between gap-4 p-4 border-b hover:bg-blue-50 transition"
  >
    <!-- Left: Icon + Info -->
    <div class="flex items-center gap-6">
      <div class="w-16 h-16 rounded-lg border-2 border-blue-400 flex items-center justify-center overflow-hidden">
        <img :src="job.icon" class="w-full h-full p-2 object-contain" alt="Job Icon" />
      </div>
      <div>
        <h2 class="text-blue-500 text-xl font-bold">{{ job.title }}</h2>
        <p class="text-gray-500 text-lg">Posted {{ job.posted }}</p>
      </div>
    </div>

    <!-- Right: Location and Type -->
    <div class="text-right whitespace-nowrap">
      <p class="text-gray-500 text-lg">{{ job.location }}</p>
      <p class="text-blue-600 font-semibold text-lg">{{ job.type }}</p>
    </div>
  </router-link>
</template>

<script setup>
defineProps({
  job: Object,
})
</script>
