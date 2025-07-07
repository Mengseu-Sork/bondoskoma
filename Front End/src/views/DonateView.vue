<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 text-white py-20">
      <div class="absolute inset-0 bg-black opacity-20"></div>
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-fade-in">
          Make a Difference Today
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto opacity-90">
          Your donation helps us provide education, healthcare, and hope to children and families in Cambodia
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <button 
            @click="scrollToSection('donation-options')"
            class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg"
          >
            Donate Now
          </button>
          <button 
            @click="scrollToSection('impact')"
            class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300"
          >
            See Our Impact
          </button>
        </div>
      </div>
    </section>

    <!-- Impact Statistics -->
    <section id="impact" class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Your Impact in Numbers</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            See how your donations have transformed lives across Cambodia
          </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div 
            v-for="stat in impactStats" 
            :key="stat.label"
            class="text-center p-6 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2"
          >
            <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2">{{ stat.value }}</div>
            <div class="text-gray-700 font-medium">{{ stat.label }}</div>
            <div class="text-sm text-gray-500 mt-2">{{ stat.description }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Donation Options -->
    <section id="donation-options" class="py-16 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Choose Your Way to Help</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Every contribution makes a difference. Select the option that works best for you.
          </p>
        </div>

        <!-- Donation Type Tabs -->
        <div class="flex flex-wrap justify-center mb-8 bg-white rounded-full p-2 shadow-lg max-w-md mx-auto">
          <button
            v-for="type in donationTypes"
            :key="type.id"
            @click="activeDonationType = type.id"
            :class="[
              'px-6 py-3 rounded-full font-medium transition-all duration-300',
              activeDonationType === type.id
                ? 'bg-blue-600 text-white shadow-md'
                : 'text-gray-600 hover:text-blue-600'
            ]"
          >
            {{ type.name }}
          </button>
        </div>

        <!-- One-Time Donation -->
        <div v-if="activeDonationType === 'one-time'" class="max-w-4xl mx-auto">
          <div class="bg-white rounded-2xl shadow-xl p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Make a One-Time Donation</h3>
            
            <!-- Preset Amounts -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
              <button
                v-for="amount in presetAmounts"
                :key="amount"
                @click="selectedAmount = amount"
                :class="[
                  'p-4 rounded-xl border-2 font-semibold transition-all duration-300 transform hover:scale-105',
                  selectedAmount === amount
                    ? 'border-blue-600 bg-blue-50 text-blue-600'
                    : 'border-gray-200 hover:border-blue-300'
                ]"
              >
                ${{ amount }}
              </button>
            </div>

            <!-- Custom Amount -->
            <div class="mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-2">Custom Amount</label>
              <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-lg">$</span>
                <input
                  v-model="customAmount"
                  type="number"
                  placeholder="Enter amount"
                  class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg"
                  @input="selectedAmount = null"
                />
              </div>
            </div>

            <!-- Donation Purpose -->
            <div class="mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-2">Donation Purpose (Optional)</label>
              <select 
                v-model="donationPurpose"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              >
                <option value="">General Support</option>
                <option value="education">Education Programs</option>
                <option value="healthcare">Healthcare Services</option>
                <option value="nutrition">Nutrition Programs</option>
                <option value="infrastructure">Infrastructure Development</option>
                <option value="emergency">Emergency Relief</option>
              </select>
            </div>

            <!-- Donor Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                <input
                  v-model="donorInfo.name"
                  type="text"
                  required
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Enter your full name"
                />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                <input
                  v-model="donorInfo.email"
                  type="email"
                  required
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Enter your email"
                />
              </div>
            </div>

            <!-- Anonymous Donation Option -->
            <div class="mb-6">
              <label class="flex items-center">
                <input
                  v-model="isAnonymous"
                  type="checkbox"
                  class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                />
                <span class="ml-2 text-sm text-gray-700">Make this donation anonymous</span>
              </label>
            </div>

            <!-- Donation Button -->
            <button
              @click="processDonation"
              :disabled="!canDonate"
              :class="[
                'w-full py-4 px-6 rounded-lg font-semibold text-lg transition-all duration-300 transform',
                canDonate
                  ? 'bg-blue-600 hover:bg-blue-700 text-white hover:scale-105 shadow-lg'
                  : 'bg-gray-300 text-gray-500 cursor-not-allowed'
              ]"
            >
              <span v-if="!isProcessing">
                Donate ${{ finalAmount }} Now
              </span>
              <span v-else class="flex items-center justify-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
              </span>
            </button>
          </div>
        </div>

        <!-- Monthly Donation -->
        <div v-if="activeDonationType === 'monthly'" class="max-w-4xl mx-auto">
          <div class="bg-white rounded-2xl shadow-xl p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Become a Monthly Supporter</h3>
            
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
              <div class="flex items-center">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-blue-800 font-medium">Monthly donations provide sustainable support for our programs</span>
              </div>
            </div>

            <!-- Monthly Amounts -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
              <div
                v-for="plan in monthlyPlans"
                :key="plan.amount"
                @click="selectedMonthlyPlan = plan"
                :class="[
                  'p-6 rounded-xl border-2 cursor-pointer transition-all duration-300 transform hover:scale-105',
                  selectedMonthlyPlan?.amount === plan.amount
                    ? 'border-blue-600 bg-blue-50'
                    : 'border-gray-200 hover:border-blue-300'
                ]"
              >
                <div class="text-center">
                  <div class="text-3xl font-bold text-blue-600 mb-2">${{ plan.amount }}</div>
                  <div class="text-sm text-gray-600 mb-4">per month</div>
                  <div class="text-sm font-medium text-gray-900 mb-2">{{ plan.impact }}</div>
                  <div class="text-xs text-gray-500">{{ plan.description }}</div>
                </div>
              </div>
            </div>

            <!-- Monthly Donor Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                <input
                  v-model="monthlyDonorInfo.name"
                  type="text"
                  required
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Enter your full name"
                />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                <input
                  v-model="monthlyDonorInfo.email"
                  type="email"
                  required
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Enter your email"
                />
              </div>
            </div>

            <button
              @click="processMonthlyDonation"
              :disabled="!selectedMonthlyPlan || !monthlyDonorInfo.name || !monthlyDonorInfo.email"
              class="w-full py-4 px-6 rounded-lg font-semibold text-lg bg-blue-600 hover:bg-blue-700 text-white transition-all duration-300 transform hover:scale-105 shadow-lg disabled:bg-gray-300 disabled:cursor-not-allowed"
            >
              Start Monthly Donation of ${{ selectedMonthlyPlan?.amount || 0 }}
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Other Ways to Help -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Other Ways to Support Us</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            There are many ways to make a difference beyond monetary donations
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div
            v-for="option in otherWaysToHelp"
            :key="option.title"
            class="text-center p-8 rounded-2xl bg-gradient-to-br from-gray-50 to-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2"
          >
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="option.iconPath" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ option.title }}</h3>
            <p class="text-gray-600 mb-4">{{ option.description }}</p>
            <router-link
              :to="option.link"
              class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium"
            >
              Learn More
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </router-link>
          </div>
        </div>
      </div>
    </section>

    <!-- Success Modal -->
    <div v-if="showSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-2xl p-8 max-w-md w-full text-center transform transition-all duration-300 scale-100">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Thank You!</h3>
        <p class="text-gray-600 mb-6">Your donation has been processed successfully. You will receive a confirmation email shortly.</p>
        <button
          @click="showSuccessModal = false"
          class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200"
        >
          Close
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

// Reactive data
const activeDonationType = ref('one-time')
const selectedAmount = ref(null)
const customAmount = ref('')
const donationPurpose = ref('')
const isAnonymous = ref(false)
const isProcessing = ref(false)
const showSuccessModal = ref(false)
const selectedMonthlyPlan = ref(null)

// Donor information
const donorInfo = ref({
  name: '',
  email: ''
})

const monthlyDonorInfo = ref({
  name: '',
  email: ''
})

// Static data
const donationTypes = [
  { id: 'one-time', name: 'One-Time' },
  { id: 'monthly', name: 'Monthly' }
]

const presetAmounts = [25, 50, 100, 250]

const monthlyPlans = [
  {
    amount: 25,
    impact: 'Supporter',
    description: 'Provides school supplies for 2 children'
  },
  {
    amount: 50,
    impact: 'Advocate',
    description: 'Funds a month of meals for 5 children'
  },
  {
    amount: 100,
    impact: 'Champion',
    description: 'Supports healthcare for 10 families'
  }
]

const impactStats = [
  {
    value: '2,500+',
    label: 'Children Educated',
    description: 'Since 1989'
  },
  {
    value: '150+',
    label: 'Communities Served',
    description: 'Across Cambodia'
  },
  {
    value: '$2.5M+',
    label: 'Funds Raised',
    description: 'For programs'
  },
  {
    value: '35+',
    label: 'Years of Service',
    description: 'Making a difference'
  }
]

const otherWaysToHelp = [
  {
    title: 'Volunteer',
    description: 'Join our team and contribute your skills and time to make a direct impact.',
    iconPath: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
    link: '/volunteer'
  },
  {
    title: 'Partner with Us',
    description: 'Explore partnership opportunities to amplify our impact together.',
    iconPath: 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6',
    link: '/partner'
  },
  {
    title: 'Spread the Word',
    description: 'Share our mission with your network and help us reach more supporters.',
    iconPath: 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z',
    link: '/about'
  }
]

// Computed properties
const finalAmount = computed(() => {
  return selectedAmount.value || parseFloat(customAmount.value) || 0
})

const canDonate = computed(() => {
  return finalAmount.value > 0 && donorInfo.value.name && donorInfo.value.email
})

// Methods
const scrollToSection = (sectionId) => {
  const element = document.getElementById(sectionId)
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' })
  }
}

const processDonation = async () => {
  if (!canDonate.value) return
  
  isProcessing.value = true
  
  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 2000))
    
    // Here you would integrate with your payment processor
    // (Stripe, PayPal, etc.)
    
    showSuccessModal.value = true
    
    // Reset form
    selectedAmount.value = null
    customAmount.value = ''
    donationPurpose.value = ''
    donorInfo.value = { name: '', email: '' }
    isAnonymous.value = false
    
  } catch (error) {
    console.error('Donation processing error:', error)
    // Handle error (show error message)
  } finally {
    isProcessing.value = false
  }
}

const processMonthlyDonation = async () => {
  if (!selectedMonthlyPlan.value || !monthlyDonorInfo.value.name || !monthlyDonorInfo.value.email) return
  
  try {
    // Simulate API call for monthly donation setup
    await new Promise(resolve => setTimeout(resolve, 2000))
    
    showSuccessModal.value = true
    
    // Reset form
    selectedMonthlyPlan.value = null
    monthlyDonorInfo.value = { name: '', email: '' }
    
  } catch (error) {
    console.error('Monthly donation setup error:', error)
  }
}
</script>

<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fade-in 1s ease-out;
}

/* Smooth scrolling */
html {
  scroll-behavior: smooth;
}

/* Custom focus styles */
input:focus,
select:focus,
button:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Hover animations */
.transform {
  transition: transform 0.2s ease-in-out;
}

.hover\:scale-105:hover {
  transform: scale(1.05);
}

.hover\:-translate-y-2:hover {
  transform: translateY(-0.5rem);
}
</style>