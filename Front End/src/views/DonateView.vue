<template>
   <div id="app">
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
      <!-- Header Section -->
      <header class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://source.unsplash.com/random/1920x1080/?community')] opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
          <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate__animated animate__fadeIn">Connect With Us</h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">Join our mission to make a difference. Contact us or support our cause with a donation.</p>
          </div>
        </div>
      </header>

      <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Contact Section -->
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-20">
          <!-- Contact Form -->
          <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl p-8 transform transition-all hover:shadow-2xl">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Send Us a Message</h2>
            
            <form @submit.prevent="submitContact" class="space-y-6">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                  <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                  <input
                    v-model="contactForm.firstName"
                    type="text"
                    id="firstName"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50"
                    placeholder="Your first name"
                    :class="{ 'border-red-500': contactErrors.firstName }"
                    @input="clearError('firstName')"
                  />
                  <p v-if="contactErrors.firstName" class="text-red-500 text-xs mt-1">{{ contactErrors.firstName }}</p>
                </div>
                <div>
                  <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                  <input
                    v-model="contactForm.lastName"
                    type="text"
                    id="lastName"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50"
                    placeholder="Your last name"
                    :class="{ 'border-red-500': contactErrors.lastName }"
                    @input="clearError('lastName')"
                  />
                  <p v-if="contactErrors.lastName" class="text-red-500 text-xs mt-1">{{ contactErrors.lastName }}</p>
                </div>
              </div>

              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                <input
                  v-model="contactForm.email"
                  type="email"
                  id="email"
                  required
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50"
                  placeholder="your.email@example.com"
                  :class="{ 'border-red-500': contactErrors.email }"
                  @input="clearError('email')"
                />
                <p v-if="contactErrors.email" class="text-red-500 text-xs mt-1">{{ contactErrors.email }}</p>
              </div>

              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <input
                  v-model="contactForm.phone"
                  type="tel"
                  id="phone"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50"
                  placeholder="(555) 123-4567"
                />
              </div>

              <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                <select
                  v-model="contactForm.subject"
                  id="subject"
                  required
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50"
                  :class="{ 'border-red-500': contactErrors.subject }"
                  @change="clearError('subject')"
                >
                  <option value="">Select a subject</option>
                  <option value="general">General Inquiry</option>
                  <option value="partnership">Partnership</option>
                  <option value="volunteer">Volunteer Opportunities</option>
                  <option value="donation">Donation Questions</option>
                  <option value="other">Other</option>
                </select>
                <p v-if="contactErrors.subject" class="text-red-500 text-xs mt-1">{{ contactErrors.subject }}</p>
              </div>

              <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                <textarea
                  v-model="contactForm.message"
                  id="message"
                  rows="5"
                  required
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50"
                  placeholder="Tell us how we can help you..."
                  :class="{ 'border-red-500': contactErrors.message }"
                  @input="clearError('message')"
                ></textarea>
                <p v-if="contactErrors.message" class="text-red-500 text-xs mt-1">{{ contactErrors.message }}</p>
              </div>

              <button
                type="submit"
                :disabled="isSubmittingContact"
                class="w-full bg-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                {{ isSubmittingContact ? 'Sending...' : 'Send Message' }}
              </button>
            </form>

            <div v-if="contactMessage" class="mt-6 p-4 rounded-lg animate__animated animate__fadeIn" :class="contactMessage.type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'">
              {{ contactMessage.text }}
            </div>
          </div>

          <!-- Contact Information -->
          <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl shadow-xl p-8 transform transition-all hover:shadow-2xl">
              <h2 class="text-3xl font-bold text-gray-900 mb-8">Contact Information</h2>
              <div class="space-y-6">
                <div class="flex items-start space-x-4">
                  <div class="flex-shrink-0 w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">Address</p>
                    <p class="text-gray-600 text-sm">123 Organization Street<br>City, State 12345</p>
                  </div>
                </div>
                <div class="flex items-start space-x-4">
                  <div class="flex-shrink-0 w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">Phone</p>
                    <p class="text-gray-600 text-sm">(555) 123-4567</p>
                  </div>
                </div>
                <div class="flex items-start space-x-4">
                  <div class="flex-shrink-0 w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">Email</p>
                    <p class="text-gray-600 text-sm">contact@organization.org</p>
                  </div>
                </div>
                <div class="flex items-start space-x-4">
                  <div class="flex-shrink-0 w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">Office Hours</p>
                    <p class="text-gray-600 text-sm">Mon - Fri: 9:00 AM - 5:00 PM<br>Sat: 10:00 AM - 2:00</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Social Media & Stats -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
              <h3 class="text-xl font-semibold text-gray-900 mb-6">Connect With Us</h3>
              <div class="flex space-x-4 mb-8 justify-center">
                <a href="https://x.com" target="_blank" class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center hover:bg-indigo-200 transition duration-300">
                  <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                  </svg>
                </a>
                <a href="https://facebook.com" target="_blank" class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center hover:bg-indigo-200 transition duration-300">
                  <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                  </svg>
                </a>
                <a href="https://linkedin.com" target="_blank" class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center hover:bg-indigo-200 transition duration-300">
                  <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/>
                  </svg>
                </a>
              </div>
              <div class="space-y-4">
                <div class="flex justify-between items-center">
                  <span class="text-sm text-gray-600">Lives Impacted</span>
                  <span class="font-bold text-indigo-600">10,000+</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-sm text-gray-600">Projects Completed</span>
                  <span class="font-bold text-indigo-600">50+</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-sm text-gray-600">Funds Raised</span>
                  <span class="font-bold text-indigo-600">$500K+</span>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Donation Section -->
        <section class="bg-indigo-50 rounded-2xl shadow-xl p-8 border border-indigo-200">
          <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Support Our Mission</h2>
            <p class="text-gray-700 text-lg max-w-3xl mx-auto">Your generosity fuels our community initiatives. Every dollar makes a tangible impact.</p>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Donation Form -->
            <div class="bg-white rounded-2xl p-8 border border-indigo-100">
              <h3 class="text-2xl font-semibold text-gray-900 mb-6">Donation Information</h3>
              <div class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                  <div>
                    <label for="donorName" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input
                      v-model="donationInfo.name"
                      type="text"
                      id="donorName"
                      required
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50"
                      placeholder="Your full name"
                      :class="{ 'border-red-500': donationErrors.name }"
                      @input="clearDonationError('name')"
                    />
                    <p v-if="donationErrors.name" class="text-red-500 text-xs mt-1">{{ donationErrors.name }}</p>
                  </div>
                  <div>
                    <label for="donorEmail" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                    <input
                      v-model="donationInfo.email"
                      type="email"
                      id="donorEmail"
                      required
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50"
                      placeholder="your.email@example.com"
                      :class="{ 'border-red-500': donationErrors.email }"
                      @input="clearDonationError('email')"
                    />
                    <p v-if="donationErrors.email" class="text-red-500 text-xs mt-1">{{ donationErrors.email }}</p>
                  </div>
                </div>

                <div>
                  <label for="donationAmount" class="block text-sm font-medium text-gray-700 mb-2">Donation Amount ($)*</label>
                  <input
                    v-model="donationInfo.amount"
                    type="number"
                    id="donationAmount"
                    required
                    min="1"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50"
                    placeholder="Enter amount"
                    :class="{ 'border-red-500': donationErrors.amount }"
                    @input="clearDonationError('amount')"
                  />
                  <p v-if="donationErrors.amount" class="text-red-500 text-xs mt-1">{{ donationErrors.amount }}</p>
                </div>

                <div>
                  <label for="donationType" class="block text-sm font-medium text-gray-700 mb-2">Donation Type *</label>
                  <div class="flex space-x-4">
                    <label class="flex items-center">
                      <input
                        v-model="donationInfo.type"
                        type="radio"
                        value="one-time"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                      />
                      <span class="ml-2 text-sm text-gray-600">One-Time</span>
                    </label>
                    <label class="flex items-center">
                      <input
                        v-model="donationInfo.type"
                        type="radio"
                        value="recurring"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                      />
                      <span class="ml-2 text-sm text-gray-600">Recurring</span>
                    </label>
                  </div>
                </div>

                <div>
                  <label for="donationMessage" class="block text-sm font-medium text-gray-700 mb-2">Message (Optional)</label>
                  <textarea
                    v-model="donationInfo.message"
                    id="donationMessage"
                    rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50"
                    placeholder="Leave a message with your donation..."
                  ></textarea>
                </div>

                <button
                  @click="saveDonationInfo"
                  class="w-full bg-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300"
                >
                  Save Donation Information
                </button>

                <div v-if="donationMessage" class="p-4 rounded-lg animate__animated animate__fadeIn" :class="donationMessage.type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'">
                  {{ donationMessage.text }}
                </div>
              </div>
            </div>

            <!-- Payment Methods -->
            <div class="bg-white rounded-2xl p-8 border border-indigo-100">
              <h3 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Choose Payment Method</h3>
              <div class="flex justify-center mb-6">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 bg-gray-100 rounded-lg p-2">
                  <button
                    v-for="method in paymentMethods"
                    :key="method.id"
                    @click="selectedPaymentMethod = method.id"
                    :class="selectedPaymentMethod === method.id ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition duration-300"
                  >
                    {{ method.name }}
                  </button>
                </div>
              </div>

              <div class="text-center">
                <div class="inline-block bg-white p-6 rounded-2xl border-2 border-gray-200 shadow-lg mb-6 transform transition-all hover:scale-105">
                  <img 
                    :src="currentQRCode" 
                    :alt="`${getCurrentPaymentMethod().name} QR Code`"
                    class="w-56 h-56 mx-auto"
                  />
                </div>
                <p class="text-lg font-medium text-gray-900 mb-3">Scan with {{ getCurrentPaymentMethod().name }}</p>
                <div class="p-4 bg-indigo-50 rounded-lg mb-6">
                  <p class="text-sm font-medium text-indigo-800">{{ getCurrentPaymentMethod().instruction }}</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg text-left">
                  <h4 class="font-medium text-gray-900 mb-3">Manual Payment Information</h4>
                  <div class="text-sm text-gray-600 space-y-2">
                    <p><strong>{{ getCurrentPaymentMethod().name }}:</strong> {{ getCurrentPaymentMethod().account }}</p>
                    <p><strong>Account Name:</strong> Your Organization Name</p>
                    <p class="text-xs text-gray-500 mt-2">Please include your name and email in the payment description for receipt purposes.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>

      <!-- Footer -->
      <footer class="bg-gray-900 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <p class="text-sm">© 2025 Your Organization. All rights reserved.</p>
        </div>
      </footer>
    </div>
  </div>

</template>

<script setup>
import { ref, computed } from 'vue'

// Contact form data
const contactForm = ref({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  subject: '',
  message: ''
})

const isSubmittingContact = ref(false)
const contactMessage = ref(null)

// Donation data
const donationInfo = ref({
  name: '',
  email: '',
  amount: '',
  message: '',
  type: 'one-time'
})

const donationMessage = ref(null)
const selectedPaymentMethod = ref('paypal')

// Payment methods with QR codes
const paymentMethods = [
  {
    id: 'paypal',
    name: 'PayPal',
    account: 'donations@organization.org',
    instruction: 'Open PayPal app and scan this code to send money',
    qrCode: '/placeholder.svg?height=192&width=192&text=PayPal+QR'
  },
  {
    id: 'venmo',
    name: 'Venmo',
    account: '@YourOrganization',
    instruction: 'Open Venmo app and scan to pay @YourOrganization',
    qrCode: '/placeholder.svg?height=192&width=192&text=Venmo+QR'
  },
  {
    id: 'cashapp',
    name: 'Cash App',
    account: '$YourOrganization',
    instruction: 'Open Cash App and scan to pay $YourOrganization',
    qrCode: '/placeholder.svg?height=192&width=192&text=CashApp+QR'
  },
  {
    id: 'zelle',
    name: 'Zelle',
    account: 'donations@organization.org',
    instruction: 'Use this email in your banking app for Zelle transfer',
    qrCode: '/placeholder.svg?height=192&width=192&text=Zelle+Info'
  }
]

// Computed properties
const currentQRCode = computed(() => {
  const method = paymentMethods.find(m => m.id === selectedPaymentMethod.value)
  return method ? method.qrCode : paymentMethods[0].qrCode
})

const getCurrentPaymentMethod = () => {
  return paymentMethods.find(m => m.id === selectedPaymentMethod.value) || paymentMethods[0]
}

// Contact form submission
const submitContact = async () => {
  isSubmittingContact.value = true
  contactMessage.value = null
  
  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1000))
    
    contactMessage.value = {
      type: 'success',
      text: 'Thank you for your message! We\'ll get back to you within 24 hours.'
    }
    
    // Reset form
    contactForm.value = {
      firstName: '',
      lastName: '',
      email: '',
      phone: '',
      subject: '',
      message: ''
    }
  } catch (error) {
    contactMessage.value = {
      type: 'error',
      text: 'Sorry, there was an error sending your message. Please try again.'
    }
  } finally {
    isSubmittingContact.value = false
  }
}

// Save donation information
const saveDonationInfo = () => {
  if (!donationInfo.value.name || !donationInfo.value.email || !donationInfo.value.amount) {
    donationMessage.value = {
      type: 'error',
      text: 'Please fill in all required fields (Name, Email, and Amount).'
    }
    return
  }

  // Save to localStorage or send to your system
  const donationData = {
    ...donationInfo.value,
    paymentMethod: selectedPaymentMethod.value,
    timestamp: new Date().toISOString()
  }
  
  // Store locally (you can modify this to send to your backend)
  localStorage.setItem('donationInfo', JSON.stringify(donationData))
  
  donationMessage.value = {
    type: 'success',
    text: `Thank you ${donationInfo.value.name}! Your donation information has been saved. Please complete the payment of $${donationInfo.value.amount} using the ${getCurrentPaymentMethod().name} QR code.`
  }
  
  console.log('Donation Info Saved:', donationData)
}
</script>