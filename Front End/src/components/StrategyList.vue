<template>
  <div class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-800 mb-3">Key Strategies</h2>
    <ul class="list-disc list-inside text-gray-700 space-y-2">
      <li v-for="(item, index) in strategies" :key="index">
        <strong>{{ item.title }}:</strong> {{ item.detail }}
      </li>
    </ul>
  </div>
</template>

<script setup>
defineProps({
  strategies: Array 
});
</script>
