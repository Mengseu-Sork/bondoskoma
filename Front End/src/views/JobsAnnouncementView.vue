<!-- src/views/JobBoard.vue -->
<template>
  <div class="p-6 max-w-6xl mx-auto">
    <h1 class="text-4xl text-blue-500 font-bold mb-4">Open Positions</h1>
    <p class="text-gray-600 mb-6 text-lg">
      Are you ready to be part of Bandos Komar? Join a passionate team dedicated to improving the lives of children and youth through education and community development. We offer rewarding career opportunities where your work creates a lasting impact.
    </p>
    <p class="text-gray-600 mb-6 text-lg">
      Bandos Komar values teamwork, transparency, and a strong commitment to child rights and sustainable development. As part of our team, you will contribute to building a brighter future for Cambodian communities while growing professionally in a supportive and inclusive environment.
    </p>
    <p class="text-gray-600 mb-6 text-lg">
      Explore the opportunities to join Bandos Komar and make a difference.
    </p>

    <!-- Filter Bar -->
    <div class="bg-blue-500 text-white p-4 rounded-md mb-6 flex items-center gap-6 flex-wrap">
      <span class="font-bold text-xl mr-12">Filter by:</span>

      <select v-model="selectedDepartment" class="rounded px-4 py-2 text-lg w-[350px] text-black">
        <option value="All">All Departments</option>
        <option value="Banking Operation">Banking Operation</option>
        <option value="IT">IT</option>
        <option value="Finance">Finance</option>
      </select>

      <select v-model="selectedDateOrder" class="rounded px-4 py-2 text-lg w-[350px] text-black">
        <option value="Date Posted">Date Posted</option>
        <option value="Newest">Newest</option>
        <option value="Oldest">Oldest</option>
      </select>

      <button
        @click="applyFilters"
        class="bg-blue-700 w-40 text-lg hover:bg-blue-800 text-white font-bold px-6 py-2 rounded"
      >
        SUBMIT
      </button>
    </div>

    <!-- Job Cards -->
    <div>
      <JobCard v-for="(job, index) in filteredJobs" :key="index" :job="job" />
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import JobCard from '@/components/JobAnnouncement.vue'
import jobs from '@/api/job.js'


// Reactive selections for filters (dropdown inputs)
const selectedDepartment = ref('All')
const selectedDateOrder = ref('Date Posted')

// Reactive applied filters to trigger filtering on SUBMIT click
const appliedDepartment = ref('All')
const appliedDateOrder = ref('Date Posted')

// Apply filters button handler
function applyFilters() {
  appliedDepartment.value = selectedDepartment.value
  appliedDateOrder.value = selectedDateOrder.value
}

// Computed filtered jobs based on applied filters
const filteredJobs = computed(() => {
  let filtered = jobs

  // Filter by department
  if (appliedDepartment.value !== 'All') {
    filtered = filtered.filter(job => job.department === appliedDepartment.value)
  }

  // Sort by date posted
  if (appliedDateOrder.value === 'Newest') {
    filtered = filtered.slice().sort((a, b) => new Date(b.postedDate) - new Date(a.postedDate))
  } else if (appliedDateOrder.value === 'Oldest') {
    filtered = filtered.slice().sort((a, b) => new Date(a.postedDate) - new Date(b.postedDate))
  }

  return filtered
})
</script>
