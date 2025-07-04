<template>
  <a
    :href="partner.link"
    target="_blank"
    rel="noopener noreferrer"
    class="bg-white rounded-xl shadow-md overflow-hidden w-[280px] text-center hover:shadow-lg transition block"
  >
    <img
      :src="partner.image"
      alt="Partner Logo"
      class="w-full h-40 object-contain bg-white p-4"
    />
  </a>
</template>

<script setup>
defineProps({
  partner: {
    type: Object,
    required: true,
    default: () => ({
      name: 'Partner Name',
      image: 'https://via.placeholder.com/150',
      link: '#'
    })
  }
})
</script>
