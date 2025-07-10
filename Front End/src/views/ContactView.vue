<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
    <div class="max-w-6xl mx-auto">
      <!-- Header Section -->
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Get In Touch</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Have a question or want to work together? I'd love to hear from you.
          Send me a message or visit my office.
        </p>
      </div>

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Contact Form -->
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
          <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Send Message</h2>
            <p class="text-gray-600">
              Fill out the form below and I'll get back to you soon.
            </p>
          </div>

          <form @submit.prevent="submitForm" class="space-y-6">
            <!-- Name -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                Name <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <input
                  v-model="form.name"
                  type="text"
                  placeholder="Enter your full name"
                  class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 pl-12"
                  :class="{
                    'border-red-300 focus:ring-red-500 focus:border-red-500':
                      errors.name,
                  }"
                  required
                />
                <svg
                  class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                  />
                </svg>
              </div>
              <p v-if="errors.name" class="text-red-500 text-sm">
                {{ errors.name }}
              </p>
            </div>

            <!-- Email -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                Email <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <input
                  v-model="form.email"
                  type="email"
                  placeholder="your@email.com"
                  class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 pl-12"
                  :class="{
                    'border-red-300 focus:ring-red-500 focus:border-red-500':
                      errors.email,
                  }"
                  required
                />
                <svg
                  class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                  />
                </svg>
              </div>
              <p v-if="errors.email" class="text-red-500 text-sm">
                {{ errors.email }}
              </p>
            </div>

            <!-- Phone -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                Phone <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <input
                  v-model="form.phone"
                  type="tel"
                  placeholder="012 345 678"
                  class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 pl-12"
                  :class="{
                    'border-red-300 focus:ring-red-500 focus:border-red-500':
                      errors.phone,
                  }"
                  required
                />
                <svg
                  class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                  />
                </svg>
              </div>
              <p v-if="errors.phone" class="text-red-500 text-sm">
                {{ errors.phone }}
              </p>
            </div>

            <!-- Message -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                Message <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <textarea
                  v-model="form.paragraph"
                  rows="5"
                  placeholder="Tell me about your project, ideas, or just say hello..."
                  class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 resize-none"
                  :class="{
                    'border-red-300 focus:ring-red-500 focus:border-red-500':
                      errors.paragraph,
                  }"
                  required
                ></textarea>
                <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                  {{ form.paragraph.length }}/500
                </div>
              </div>
              <p v-if="errors.paragraph" class="text-red-500 text-sm">
                {{ errors.paragraph }}
              </p>
            </div>

            <!-- Submit Button -->
            <button
              type="submit"
              :disabled="isSubmitting"
              class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 disabled:from-gray-400 disabled:to-gray-500 text-white font-bold py-4 px-6 rounded-lg transition-all duration-200 transform hover:scale-[1.02] disabled:scale-100 disabled:cursor-not-allowed flex items-center justify-center space-x-2"
            >
              <svg
                v-if="isSubmitting"
                class="animate-spin w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                />
              </svg>
              <svg
                v-else
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                />
              </svg>
              <span>{{ isSubmitting ? "Sending..." : "Send Message" }}</span>
            </button>

            <!-- Messages -->
            <div
              v-if="message && messageType === 'success'"
              class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-center space-x-3"
            >
              <svg
                class="w-6 h-6 text-green-600 flex-shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
              <p class="text-green-800 font-medium">{{ message }}</p>
            </div>

            <div
              v-if="message && messageType === 'error'"
              class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-center space-x-3"
            >
              <svg
                class="w-6 h-6 text-red-600 flex-shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
              <p class="text-red-800 font-medium">{{ message }}</p>
            </div>
          </form>
        </div>
        <div class="space-y-6">
          <!-- Map -->
          <div
            class="rounded-lg overflow-hidden shadow-md border border-gray-200 mb-6"
          >
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.6280410541416!2d104.888328!3d11.550561!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109511e7a409b83%3A0xa54896247da13e13!2sYour%20Office%20Location!5e0!3m2!1sen!2skh!4v1720592091093!5m2!1sen!2skh"
              width="100%"
              height="300"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>

          <!-- Office Hours -->
          <div class="bg-white p-6 rounded-lg border shadow">
            <h3 class="font-semibold text-xl mb-2">Office Hours</h3>
            <div class="space-y-1">
              <p>Mon - Fri: 9:00 AM - 6:00 PM</p>
              <p>Saturday: 10:00 AM - 4:00 PM</p>
              <p>
                Sunday: <span class="text-red-500 font-semibold">Closed</span>
              </p>
            </div>
            <div class="mt-4">
              <div
                v-if="currentStatus === 'Open'"
                class="bg-green-50 border border-green-200 p-3 rounded"
              >
                <span class="text-green-700 font-semibold">Currently Open</span>
                <p class="text-green-600 text-sm">Closes at {{ closeTime }}</p>
              </div>
              <div v-else class="bg-red-50 border border-red-200 p-3 rounded">
                <span class="text-red-700 font-semibold">Currently Closed</span>
                <p class="text-red-600 text-sm">Please leave a message</p>
              </div>
            </div>
          </div>
          <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Follow Me</h2>

            <div class="flex space-x-4">
              <!-- Facebook -->
              <a
                href="https://facebook.com/yourusername"
                target="_blank"
                class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg transition-colors"
              >
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M22.676 0H1.326C.593 0 0 .593 0 1.326v21.348C0 23.407.593 24 1.326 24H12.82V14.708H9.692v-3.62h3.127V8.413c0-3.1 1.893-4.788 4.658-4.788 1.325 0 2.464.099 2.797.143v3.24l-1.92.001c-1.504 0-1.794.715-1.794 1.763v2.311h3.587l-.467 3.62h-3.12V24h6.116C23.407 24 24 23.407 24 22.674V1.326C24 .593 23.407 0 22.676 0z"
                  />
                </svg>
              </a>

              <!-- LinkedIn -->
              <a
                href="https://linkedin.com/in/yourusername"
                target="_blank"
                class="bg-blue-800 hover:bg-blue-900 text-white p-3 rounded-lg transition-colors"
              >
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"
                  />
                </svg>
              </a>

              <!-- Instagram -->
              <a
                href="https://instagram.com/yourusername"
                target="_blank"
                class="bg-pink-500 hover:bg-pink-600 text-white p-3 rounded-lg transition-colors"
              >
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M12 2.163c3.204 0 3.584.012 4.849.07 1.366.062 2.633.341 3.608 1.316.975.975 1.254 2.243 1.316 3.608.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.062 1.366-.341 2.633-1.316 3.608-.975.975-2.243 1.254-3.608 1.316-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.366-.062-2.633-.341-3.608-1.316-.975-.975-1.254-2.243-1.316-3.608C2.175 15.747 2.163 15.367 2.163 12s.012-3.584.07-4.849c.062-1.366.341-2.633 1.316-3.608.975-.975 2.243-1.254 3.608-1.316C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.741 0 8.332.014 7.052.072 5.765.13 4.644.357 3.675 1.326 2.707 2.294 2.48 3.416 2.422 4.704.014 8.332 0 8.741 0 12c0 3.259.014 3.668.072 4.948.058 1.288.285 2.41 1.254 3.379.969.968 2.09 1.195 3.379 1.254C8.332 23.986 8.741 24 12 24s3.668-.014 4.948-.072c1.288-.058 2.41-.285 3.379-1.254.968-.969 1.195-2.09 1.254-3.379.058-1.28.072-1.689.072-4.948s-.014-3.668-.072-4.948c-.058-1.288-.285-2.41-1.254-3.379-.969-.968-2.09-1.195-3.379-1.254C15.668.014 15.259 0 12 0zM12 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zm0 10.162a3.999 3.999 0 1 1 0-7.998 3.999 3.999 0 0 1 0 7.998zm6.406-11.845a1.44 1.44 0 1 1-2.881 0 1.44 1.44 0 0 1 2.881 0z"
                  />
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import api from '@/plugin/axios'

const form = ref({
  name: '',
  email: '',
  phone: '',
  paragraph: '',
})

const message = ref('')
const messageType = ref('')
const isSubmitting = ref(false)
const currentTime = ref(new Date())

const errors = reactive({
  name: '',
  email: '',
  phone: '',
  paragraph: '',
})

// Update current time every minute
onMounted(() => {
  const interval = setInterval(() => {
    currentTime.value = new Date()
  }, 60000)
  
  // Cleanup interval on unmount
  return () => clearInterval(interval)
})

// Computed properties for office status
const currentStatus = computed(() => {
  const now = currentTime.value
  const day = now.getDay() // 0 = Sunday, 1 = Monday, etc.
  const hour = now.getHours()
  const minute = now.getMinutes()
  const currentMinutes = hour * 60 + minute

  // Sunday is closed
  if (day === 0) return 'Closed'
  
  // Monday - Friday: 9:00 AM - 6:00 PM
  if (day >= 1 && day <= 5) {
    const openTime = 9 * 60 // 9:00 AM
    const closeTime = 18 * 60 // 6:00 PM
    return currentMinutes >= openTime && currentMinutes < closeTime ? 'Open' : 'Closed'
  }
  
  // Saturday: 10:00 AM - 4:00 PM
  if (day === 6) {
    const openTime = 10 * 60 // 10:00 AM
    const closeTime = 16 * 60 // 4:00 PM
    return currentMinutes >= openTime && currentMinutes < closeTime ? 'Open' : 'Closed'
  }
  
  return 'Closed'
})

const closeTime = computed(() => {
  const now = currentTime.value
  const day = now.getDay()
  
  if (day >= 1 && day <= 5) return '6:00 PM'
  if (day === 6) return '4:00 PM'
  return 'Closed'
})

const openTime = computed(() => {
  const now = currentTime.value
  const day = now.getDay()
  
  if (day >= 1 && day <= 5) return '9:00 AM'
  if (day === 6) return '10:00 AM'
  if (day === 0) return 'Monday 9:00 AM'
  return '9:00 AM'
})

const validateForm = () => {
  // Reset errors
  Object.keys(errors).forEach(key => {
    errors[key] = ''
  })
  
  let isValid = true

  // Name validation
  if (!form.value.name.trim()) {
    errors.name = 'Name is required'
    isValid = false
  } else if (form.value.name.trim().length < 2) {
    errors.name = 'Name must be at least 2 characters'
    isValid = false
  }

  // Email validation
  if (!form.value.email.trim()) {
    errors.email = 'Email is required'
    isValid = false
  } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.value.email)) {
    errors.email = 'Please enter a valid email address'
    isValid = false
  }

  // Phone validation
  if (!form.value.phone.trim()) {
    errors.phone = 'Phone number is required'
    isValid = false
  } else if (!/^[\d\s\-\+()]+$/.test(form.value.phone)) {
    errors.phone = 'Please enter a valid phone number'
    isValid = false
  }

  // Message validation
  if (!form.value.paragraph.trim()) {
    errors.paragraph = 'Message is required'
    isValid = false
  } else if (form.value.paragraph.trim().length < 10) {
    errors.paragraph = 'Message must be at least 10 characters'
    isValid = false
  } else if (form.value.paragraph.length > 500) {
    errors.paragraph = 'Message must be less than 500 characters'
    isValid = false
  }

  return isValid
}

const submitForm = async () => {
  if (!validateForm()) {
    return
  }

  isSubmitting.value = true
  message.value = ''

  try {
    const res = await api.post('/contact', form.value)
    message.value = res.data.message || '✅ Message sent successfully!'
    messageType.value = 'success'

    // Reset form
    form.value = { name: '', email: '', phone: '', paragraph: '' }

    // Clear message after 5 seconds
    setTimeout(() => {
      message.value = ''
      messageType.value = ''
    }, 5000)

  } catch (error) {
    console.error('Contact form error:', error)
    message.value = '❌ Failed to send message. Please try again.'
    messageType.value = 'error'

    // Clear error message after 5 seconds
    setTimeout(() => {
      message.value = ''
      messageType.value = ''
    }, 5000)
  } finally {
    isSubmitting.value = false
  }
}
</script>
