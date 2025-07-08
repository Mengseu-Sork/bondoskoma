<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex flex-col lg:flex-row justify-center items-start p-4 sm:p-6 lg:p-8 font-sans">
    <!-- Main Donation Form -->
    <div class="w-full lg:w-2/3 bg-white rounded-2xl shadow-xl p-6 sm:p-8 mb-6 lg:mb-0 lg:mr-6 transform transition-all duration-300 hover:shadow-2xl">
      <!-- Warning Banner -->
      <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg mb-6 text-sm flex items-center" role="alert">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h0a1 1 0 100-2v-3a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        Test Mode Enabled - No real live donations are processed
      </div>

      <!-- Donation Amount Section -->
      <div class="mb-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Support Our Cause</h2>
        <div class="flex flex-wrap gap-3 mb-4">
          <button
            v-for="amount in presetAmounts"
            :key="amount"
            @click="selectedAmount = amount; showCustomAmount = false"
            :class="[
              'px-5 py-3 rounded-xl text-base sm:text-lg font-semibold transition-all duration-200',
              selectedAmount === amount
                ? 'bg-gradient-to-r from-purple-600 to-purple-700 text-white shadow-md'
                : 'bg-gray-200 text-gray-800 hover:bg-gray-300'
            ]"
            :aria-label="`Donate $${amount}`"
          >
            ${{ amount }}
          </button>
          <button
            @click="showCustomAmount = !showCustomAmount; selectedAmount = null"
            :class="[
              'px-5 py-3 rounded-xl text-base sm:text-lg font-semibold transition-all duration-200',
              showCustomAmount ? 'bg-gray-300 text-gray-800' : 'bg-gray-200 text-gray-800 hover:bg-gray-300'
            ]"
            :aria-label="`Custom donation amount`"
          >
            Custom
          </button>
        </div>
        <div v-if="showCustomAmount" class="mt-4">
          <div class="relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">$</span>
            <input
              v-model="customAmount"
              type="number"
              placeholder="Enter amount"
              class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-base transition-all duration-200"
              :aria-label="`Custom donation amount`"
              @input="validateAmount"
            />
          </div>
          <p v-if="amountError" class="text-red-500 text-sm mt-1">{{ amountError }}</p>
        </div>
        <div class="mt-4">
          <label class="flex items-center">
            <input v-model="isMonthly" type="checkbox" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
            <span class="ml-2 text-sm text-gray-700">Make it a monthly donation</span>
          </label>
        </div>
      </div>

      <!-- Progress Bar -->
      <div class="mb-6">
        <div class="flex justify-between text-sm text-gray-600 mb-2">
          <span>Raised: $99,500</span>
          <span>Goal: $100,000</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5">
          <div class="bg-green-500 h-2.5 rounded-full" style="width: 99.5%"></div>
        </div>
      </div>

      <!-- Payment Method Section -->
      <div class="mb-6">
        <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-3">Payment Method</h3>
        <select
          v-model="paymentMethod"
          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-base transition-all duration-200"
          :aria-label="`Select payment method`"
        >
          <option value="text">Text Payment</option>
          <option value="offline">Offline Donation</option>
        </select>
      </div>

      <!-- Personal Info Section -->
      <div class="mb-6">
        <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-3">Your Details</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
            <input
              v-model="donorInfo.firstName"
              type="text"
              :class="['w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-base transition-all duration-200', { 'border-red-500': formErrors.firstName }]"
              placeholder="First Name"
              :aria-label="`First name`"
              @input="validateForm"
            />
            <p v-if="formErrors.firstName" class="text-red-500 text-sm mt-1">{{ formErrors.firstName }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
            <input
              v-model="donorInfo.lastName"
              type="text"
              :class="['w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-base transition-all duration-200', { 'border-red-500': formErrors.lastName }]"
              placeholder="Last Name"
              :aria-label="`Last name`"
              @input="validateForm"
            />
            <p v-if="formErrors.lastName" class="text-red-500 text-sm mt-1">{{ formErrors.lastName }}</p>
          </div>
        </div>
        <div class="mt-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input
            v-model="donorInfo.email"
            type="email"
            :class="['w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-base transition-all duration-200', { 'border-red-500': formErrors.email }]"
            placeholder="Email Address"
            :aria-label="`Email address`"
            @input="validateForm"
          />
          <p v-if="formErrors.email" class="text-red-500 text-sm mt-1">{{ formErrors.email }}</p>
        </div>
      </div>

      <!-- Donate Button -->
      <button
        @click="processDonation"
        :disabled="!isFormValid"
        :class="[
          'w-full py-3 rounded-lg font-semibold text-white flex items-center justify-center transition-all duration-200',
          isFormValid
            ? 'bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800'
            : 'bg-gray-400 cursor-not-allowed'
        ]"
        :aria-label="`Donate $${finalAmount} now`"
      >
        <span v-if="!isProcessing">Donate ${{ finalAmount }} Now</span>
        <span v-else class="flex items-center">
          <svg class="animate-spin mr-2 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          Processing...
        </span>
      </button>
    </div>

    <!-- Sidebar with Campaign Info -->
    <div class="w-full lg:w-1/3 bg-white rounded-2xl shadow-xl p-6 sm:p-8 transform transition-all duration-300 hover:shadow-2xl">
      <div class="mb-6">
        <img src="https://via.placeholder.com/300x200" alt="Campaign Image" class="w-full rounded-xl mb-4 transition-opacity duration-300 hover:opacity-90">
        <h3 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-2">Raise Funds for Clean & Healthy Food</h3>
        <p class="text-sm text-gray-600 mb-2">Raised: $99,500 / Goal: $100,000</p>
        <button class="px-4 py-2 bg-yellow-400 text-white rounded-full text-sm font-medium hover:bg-yellow-500 transition-all duration-200">
          Donation Details
        </button>
      </div>
      <div class="border-t border-gray-200 pt-6">
        <h4 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-3">Organizer</h4>
        <div class="flex items-center mb-2">
          <img src="https://via.placeholder.com/40" alt="Organizer" class="w-10 h-10 rounded-full mr-3 transition-transform duration-200 hover:scale-105">
          <div>
            <p class="text-sm font-medium text-gray-900">Elgie A. Philips</p>
            <p class="text-xs text-gray-500">352 5th Ave, New York</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Success Modal -->
    <div v-if="showSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" role="dialog" aria-labelledby="modal-title">
      <div class="bg-white rounded-2xl p-6 sm:p-8 max-w-md w-full text-center transform transition-all duration-300">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <h3 id="modal-title" class="text-2xl font-bold text-gray-900 mb-2">Thank You!</h3>
        <p class="text-gray-600 mb-6">Your donation of ${{ finalAmount }} has been processed successfully. Check your email for confirmation.</p>
        <button
          @click="showSuccessModal = false"
          class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200"
          aria-label="Close modal"
        >
          Close
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'

// Reactive data
const selectedAmount = ref(25)
const customAmount = ref('')
const showCustomAmount = ref(false)
const paymentMethod = ref('text')
const isProcessing = ref(false)
const showSuccessModal = ref(false)
const isMonthly = ref(false)
const donorInfo = ref({
  firstName: '',
  lastName: '',
  email: ''
})
const formErrors = ref({
  firstName: '',
  lastName: '',
  email: ''
})
const amountError = ref('')

// Preset amounts
const presetAmounts = [25, 50, 75, 100, 200]

// Validation
const validateAmount = () => {
  amountError.value = customAmount.value && parseFloat(customAmount.value) <= 0 ? 'Amount must be greater than 0' : ''
}

const validateForm = () => {
  formErrors.value.firstName = !donorInfo.value.firstName ? 'First name is required' : ''
  formErrors.value.lastName = !donorInfo.value.lastName ? 'Last name is required' : ''
  formErrors.value.email = !donorInfo.value.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(donorInfo.value.email) ? 'Valid email is required' : ''
}

const isFormValid = computed(() => {
  return (selectedAmount.value > 0 || (customAmount.value && parseFloat(customAmount.value) > 0)) &&
         !formErrors.value.firstName && !formErrors.value.lastName && !formErrors.value.email && !amountError.value
})

// Methods
const processDonation = async () => {
  if (!isFormValid.value) {
    validateForm()
    return
  }

  isProcessing.value = true
  try {
    await new Promise(resolve => setTimeout(resolve, 2000))
    showSuccessModal.value = true
    // Reset form
    selectedAmount.value = 25
    customAmount.value = ''
    showCustomAmount.value = false
    isMonthly.value = false
    donorInfo.value = { firstName: '', lastName: '', email: '' }
    formErrors.value = { firstName: '', lastName: '', email: '' }
    amountError.value = ''
  } catch (error) {
    console.error('Donation error:', error)
  } finally {
    isProcessing.value = false
  }
}

// Watch for form changes
watch(() => donorInfo.value, validateForm, { deep: true })
watch(() => customAmount.value, validateAmount)
</script>

<style scoped>
/* Custom transitions */
.transition-all {
  transition: all 0.3s ease-in-out;
}

/* Focus styles */
input:focus,
select:focus,
button:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.3);
}

/* Responsive adjustments */
@media (max-width: 1024px) {
  .lg\\:flex-row {
    flex-direction: column;
  }
  .lg\\:w-2\/3, .lg\\:w-1\/3 {
    width: 100%;
  }
  .lg\\:mr-6 {
    margin-right: 0;
  }
}

@media (max-width: 640px) {
  .text-3xl {
    font-size: 1.5rem;
  }
  .text-2xl {
    font-size: 1.25rem;
  }
}
</style>