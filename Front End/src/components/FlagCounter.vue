<template>
  <div class="overflow-hidden whitespace-nowrap relative">
    <div class="inline-flex animate-marquee gap-4">
      <div
        v-for="(visitor, index) in duplicatedVisitors"
        :key="`${visitor.code}-${index}`"
        class="w-28 text-sm border rounded shadow p-2 text-center flex-shrink-0"
      >
        <a :href="visitor.link" target="_blank" rel="noopener noreferrer">
            <img
                :src="visitor.flag"
                :alt="visitor.country"
                class="mx-auto w-8 h-5 object-cover mb-1"
            />
            <p class="font-medium">{{ visitor.code }}</p>
            <p class="text-gray-600">{{ visitor.count.toLocaleString() }}</p>
        </a>
      </div>
    </div>
  </div>

  <p class="mt-4 text-center text-gray-500">
    Pageviews: {{ totalPageviews.toLocaleString() }}
  </p>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  visitors: {
    type: Array,
    required: true
  }
})

const totalPageviews = computed(() =>
  props.visitors.reduce((sum, v) => sum + v.count, 0)
)

// Duplicate visitors for seamless scroll
const duplicatedVisitors = computed(() => [...props.visitors, ...props.visitors])
</script>

<style scoped>
@keyframes marquee {
  0% {
    transform: translateX(0%);
  }
  100% {
    transform: translateX(-50%);
  }
}

.animate-marquee {
  animation: marquee 30s linear infinite;
}
</style>
