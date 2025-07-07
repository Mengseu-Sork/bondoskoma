<template>
  <section class="mb-12">
    <h2 class="text-3xl font-bold text-blue-700 mb-4">{{ title }}</h2>
    <div v-for="(block, index) in content" :key="index" class="mb-4">
      <h3 v-if="block.heading" class="text-xl font-semibold text-gray-800">{{ block.heading }}</h3>
      <p class="text-gray-700 mt-2 leading-relaxed">{{ block.text }}</p>
    </div>
  </section>
</template>

<script setup>
defineProps({
  title: String,
  content: Array
});
</script>
