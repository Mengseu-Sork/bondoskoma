<template>
  <admin-aside>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <form
      @submit.prevent="verified ? updateAdmin() : verifyOldCredentials()"
      class="bg-white p-8 rounded-lg shadow-md w-full max-w-md space-y-6"
    >
      <h2 class="text-2xl font-semibold text-center text-gray-800">
        {{ verified ? 'Update New Credentials' : 'Verify Old Credentials' }}
      </h2>

      <!-- Old Email -->
      <div>
        <label class="block text-gray-700 mb-1">Your Email</label>
        <input
          v-model="form.old_email"
          type="email"
          class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500"
          :disabled="verified"
          required
        />
      </div>

      <!-- Old Password -->
      <div>
        <label class="block text-gray-700 mb-1">Your Password</label>
        <input
          v-model="form.old_password"
          type="password"
          class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500"
          :disabled="verified"
          required
        />
      </div>

      <!-- New Email -->
      <div v-if="verified">
        <label class="block text-gray-700 mb-1">New Email</label>
        <input
          v-model="form.new_email"
          type="email"
          class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500"
          required
        />
      </div>

      <!-- New Password -->
      <div v-if="verified">
        <label class="block text-gray-700 mb-1">New Password</label>
        <input
          v-model="form.new_password"
          type="password"
          class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500"
          required
        />
      </div>

      <!-- Success & Error Messages -->
      <div v-if="message" class="text-green-600 text-sm text-center">{{ message }}</div>
      <div v-if="error" class="text-red-600 text-sm text-center">{{ error }}</div>

      <!-- Button -->
      <button
        type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition"
      >
        {{ verified ? 'Update' : 'Verify' }}
      </button>
    </form>
  </div>
  </admin-aside>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
import AdminAside from '@/components/AdminAside.vue'

const router = useRouter()

const form = reactive({
  old_email: '',
  old_password: '',
  new_email: '',
  new_password: ''
})

const verified = ref(false)
const message = ref('')
const error = ref('')
let adminId = null

// Step 1: Verify old credentials
const verifyOldCredentials = async () => {
  error.value = ''
  message.value = ''

  try {
    const res = await axios.post('http://127.0.0.1:8000/api/admin/verify', {
      email: form.old_email,
      password: form.old_password
    })
    adminId = res.data.admin_id
    verified.value = true
    message.value = res.data.message || 'Verified successfully.'
  } catch (err) {
    error.value = err.response?.data?.message || 'Verification failed.'
  }
}

// Step 2: Update new email/password
const updateAdmin = async () => {
  error.value = ''
  message.value = ''

  try {
    const res = await axios.put(`http://127.0.0.1:8000/api/admin/${adminId}`, form)
    message.value = res.data.message || 'Update successful.'

    // Optional delay to show message
    setTimeout(() => {
      router.push('/admin/dashboard')
    }, 1000)

  } catch (err) {
    error.value = err.response?.data?.message || 'Update failed.'
  }
}
</script>
