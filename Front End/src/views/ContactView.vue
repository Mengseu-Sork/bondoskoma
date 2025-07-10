<!-- src/views/ContactView.vue -->
<template>
  <div class="min-h-screen bg-gray-100 p-6 flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
      <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Contact Me</h1>

      <form @submit.prevent="submitForm" class="space-y-5">
        <div>
          <label class="block text-sm font-medium text-gray-700">Name</label>
          <input
            v-model="form.name"
            type="text"
            placeholder="Your Name"
            class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
            required
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Phone</label>
          <input
            v-model="form.phone"
            type="tel"
            placeholder="012 345 678"
            class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
            required
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Paragraph</label>
          <textarea
            v-model="form.paragraph"
            rows="4"
            placeholder="Your message..."
            class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
            required
          ></textarea>
        </div>

        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-md transition"
        >
          Send Message
        </button>

        <p v-if="message" class="text-center mt-3 text-green-600 font-medium">
          {{ message }}
        </p>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
// import axios from 'axios'
import api from '@/plugin/axios';

const form = ref({
  name: '',
  phone: '',
  paragraph: '',
})

const message = ref('')

const submitForm = async () => {
  try {
    const res = await api.post('/contact', form.value)

    message.value = res.data.message 


    // Reset form
    form.value = { name: '', phone: '', paragraph: '' }
  } catch (error) {
    message.value = '❌ Failed to send message.'
    console.error(error)
  }
}
</script>
