<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex flex-col lg:flex-row justify-center items-start p-4 sm:p-6 lg:p-8 font-sans overflow-x-hidden">
    <!-- Back to Top Button -->
    <button
      @click="scrollToTop"
      class="fixed bottom-6 right-6 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 opacity-0 invisible lg:visible"
      :class="{ 'opacity-100 visible': isScrolled }"
      aria-label="Back to top"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
      </svg>
    </button>

    <!-- Main Donation Form -->
    <div class="w-full lg:w-2/3 bg-white rounded-2xl shadow-xl p-6 sm:p-8 mb-6 lg:mb-0 lg:mr-6 transform transition-all duration-300 hover:shadow-2xl">
      <!-- Warning Banner -->
      <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg mb-6 text-sm flex items-center" role="alert" aria-live="polite">
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
            @click="selectedAmount = amount; showCustomAmount = false; updateImpact()"
            :class="[
              'px-5 py-3 rounded-xl text-base sm:text-lg font-semibold transition-all duration-300',
              selectedAmount === amount
                ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-md'
                : 'bg-gray-200 text-gray-800 hover:bg-gray-300 hover:shadow-sm'
            ]"
            :aria-label="`Donate $${amount}`"
          >
            ${{ amount }}
          </button>
          <button
            @click="showCustomAmount = !showCustomAmount; selectedAmount = null; updateImpact()"
            :class="[
              'px-5 py-3 rounded-xl text-base sm:text-lg font-semibold transition-all duration-300',
              showCustomAmount ? 'bg-gray-300 text-gray-800' : 'bg-gray-200 text-gray-800 hover:bg-gray-300 hover:shadow-sm'
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
              class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base transition-all duration-300"
              :aria-label="`Custom donation amount`"
              @input="validateAmount; updateImpact()"
            />
          </div>
          <p v-if="amountError" class="text-red-500 text-sm mt-1">{{ amountError }}</p>
        </div>
        <div class="mt-4 flex items-center">
          <label class="flex items-center mr-4">
            <input v-model="isMonthly" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" @change="updateImpact()">
            <span class="ml-2 text-sm text-gray-700">Make it monthly</span>
          </label>
          <span v-if="impactMessage" class="text-sm text-gray-600 italic">{{ impactMessage }}</span>
        </div>
      </div>

      <!-- Progress Bar -->
      <div class="mb-6">
        <div class="flex justify-between text-sm text-gray-600 mb-2">
          <span>Raised: $99,500</span>
          <span>Goal: $100,000</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
          <div class="bg-blue-500 h-2.5 rounded-full transition-all duration-500" :style="{ width: progress + '%' }"></div>
        </div>
      </div>

      <!-- Donation Summary -->
      <div class="mb-6 p-4 bg-blue-50 rounded-lg">
        <h3 class="text-lg font-semibold text-blue-800 mb-2">Donation Summary</h3>
        <p class="text-sm text-gray-700">Amount: ${{ finalAmount }} <span v-if="isMonthly">/ month</span></p>
        <!-- <p v-if="impactMessage" class="text-sm text-gray-600">{{ impactMessage }}</span> -->
      </div>

      <!-- Payment Method Section -->
      <div class="mb-6">
        <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-3">Payment Method</h3>
        <select
          v-model="paymentMethod"
          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base transition-all duration-300"
          :aria-label="`Select payment method`"
        >
          <option value="text">Text Payment</option>
          <option value="offline">Offline Donation</option>
          <option value="guest">Donate as Guest</option>
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
              :class="['w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base transition-all duration-300', { 'border-red-500': formErrors.firstName }]"
              placeholder="First Name"
              :aria-label="`First name`"
              :aria-invalid="formErrors.firstName ? 'true' : 'false'"
              @input="validateForm"
            />
            <p v-if="formErrors.firstName" class="text-red-500 text-sm mt-1">{{ formErrors.firstName }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
            <input
              v-model="donorInfo.lastName"
              type="text"
              :class="['w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base transition-all duration-300', { 'border-red-500': formErrors.lastName }]"
              placeholder="Last Name"
              :aria-label="`Last name`"
              :aria-invalid="formErrors.lastName ? 'true' : 'false'"
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
            :class="['w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base transition-all duration-300', { 'border-red-500': formErrors.email }]"
            placeholder="Email Address"
            :aria-label="`Email address`"
            :aria-invalid="formErrors.email ? 'true' : 'false'"
            @input="validateForm"
          />
          <p v-if="formErrors.email" class="text-red-500 text-sm mt-1">{{ formErrors.email }}</p>
        </div>
        <div class="mt-2 text-sm text-gray-500">Fields marked with * are required unless donating as a guest.</div>
      </div>

      <!-- Donate Button -->
      <button
        @click="processDonation"
        :disabled="!isFormValid"
        :class="[
          'w-full py-3 rounded-lg font-semibold text-white flex items-center justify-center transition-all duration-300',
          isFormValid
            ? 'bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800'
            : 'bg-gray-400 cursor-not-allowed'
        ]"
        :aria-label="`Donate $${finalAmount} now`"
        tabindex="0"
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
        <h3 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-2">Raise Funds for Clean & Healthy Food</h3>
        <p class="text-sm text-gray-600 mb-2">Raised: $99,500 / Goal: $100,000</p>
      </div>
      <div class="border-t border-gray-200 pt-6">
        <h4 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-3">Thank You For Supporting</h4>
        <p class="text-sm text-gray-700 leading-relaxed mb-4">
          Thanks to your incredible support, we are just steps away from reaching our goal. Your donations have helped us provide nutritious meals, clean drinking water, and essential food supplies to hundreds of families struggling with hunger.
        </p>
        <p class="text-sm text-gray-700 leading-relaxed mb-4">
          Every act of kindness—big or small—brings hope and health to communities that need it most. Your compassion fuels our mission and shows what we can achieve when we come together for a greater purpose.
        </p>
        <p class="text-sm text-gray-700 leading-relaxed mb-6">
          We deeply appreciate your generosity. If you'd like to continue supporting or help us reach the final $500, please consider sharing our campaign or making a final contribution. Together, we can make a lasting impact.
        </p>
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
        <p class="text-gray-600 mb-6">Your donation of ${{ confirmedAmount }} has been processed successfully. Check your email for confirmation.</p>
        <button
          @click="showSuccessModal = false"
          class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-300"
          aria-label="Close modal"
          tabindex="0"
        >
          Close
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed } from 'vue';
import { createDonet } from '@/api/donation';

// Preset donation amounts
const presetAmounts = [10, 25, 50, 100];

// State variables
const selectedAmount = ref(null);
const showCustomAmount = ref(false);
const customAmount = ref('');
const amountError = ref('');
const isMonthly = ref(false);
const paymentMethod = ref('text');
const isProcessing = ref(false);
const showSuccessModal = ref(false);
const confirmedAmount = ref(0); // ✅ Keeps value for success modal

// Donor information
const donorInfo = reactive({
  firstName: '',
  lastName: '',
  email: '',
});

// Form errors
const formErrors = reactive({
  firstName: '',
  lastName: '',
  email: '',
});

// Computed amount from selection or custom input
const finalAmount = computed(() => {
  if (showCustomAmount.value) {
    return Number(customAmount.value) || 0;
  }
  return selectedAmount.value || 0;
});

// Validate donation amount
function validateAmount() {
  amountError.value = '';
  if (finalAmount.value <= 0) {
    amountError.value = 'Please enter an amount greater than zero.';
    return false;
  }
  return true;
}

// Validate donor form
function validateForm() {
  // Reset form errors
  formErrors.firstName = '';
  formErrors.lastName = '';
  formErrors.email = '';

  // Validate donor fields unless guest
  if (paymentMethod.value !== 'guest') {
    if (!donorInfo.firstName.trim()) {
      formErrors.firstName = 'First name is required.';
    }
    if (!donorInfo.lastName.trim()) {
      formErrors.lastName = 'Last name is required.';
    }
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!donorInfo.email.trim()) {
      formErrors.email = 'Email is required.';
    } else if (!emailRegex.test(donorInfo.email)) {
      formErrors.email = 'Email is invalid.';
    }
  }

  return (
    !formErrors.firstName &&
    !formErrors.lastName &&
    !formErrors.email &&
    validateAmount()
  );
}


// Computed overall form validity
const isFormValid = computed(() => validateForm());

// Submit donation
async function processDonation() {
  if (!validateForm()) return;

  isProcessing.value = true;

  const donationPayload = {
    amount: finalAmount.value,
    is_monthly: isMonthly.value,
    payment_method: paymentMethod.value,
    first_name: donorInfo.firstName.trim() || null,
    last_name: donorInfo.lastName.trim() || null,
    email: donorInfo.email.trim() || null,
  };

  try {
    await createDonet(donationPayload);

    // ✅ Save the donated amount before reset
    confirmedAmount.value = finalAmount.value;

    showSuccessModal.value = true;

    // Reset form state
    selectedAmount.value = null;
    showCustomAmount.value = false;
    customAmount.value = '';
    isMonthly.value = false;
    paymentMethod.value = 'text';
    donorInfo.firstName = '';
    donorInfo.lastName = '';
    donorInfo.email = '';
  } catch (error) {
    alert('Donation failed: ' + (error.message || 'Please try again.'));
  } finally {
    isProcessing.value = false;
  }
}
</script>
