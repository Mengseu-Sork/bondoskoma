<template>
  <div id="app">
    <!-- Full-Width Banner -->
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
      <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <section class="rounded-2xl">
          <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Support Our Mission</h2>
            <p class="text-gray-700 text-base max-w-2xl mx-auto">Your generosity fuels our community initiatives. Upload a payment confirmation to support our cause.</p>
          </div>
          
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Donation Form -->
            <div class="bg-white rounded-2xl p-6 border border-indigo-100">
              <h3 class="text-xl font-semibold text-gray-900 mb-4">Donation Information</h3>
              <form @submit.prevent="saveDonationInfo" class="space-y-4">
                <!-- Name -->
                <div>
                  <label for="donorName" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                  <input
                    v-model="donationInfo.name"
                    type="text"
                    id="donorName"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50 text-sm"
                    placeholder="Your full name"
                    :class="{ 'border-red-500': donationErrors.name }"
                    @input="clearDonationError('name')"
                  />
                  <p v-if="donationErrors.name" class="text-red-500 text-xs mt-1">{{ donationErrors.name }}</p>
                </div>

                <!-- Email -->
                <div>
                  <label for="donorEmail" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                  <input
                    v-model="donationInfo.email"
                    type="email"
                    id="donorEmail"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50 text-sm"
                    placeholder="your.email@example.com"
                    :class="{ 'border-red-500': donationErrors.email }"
                    @input="clearDonationError('email')"
                  />
                  <p v-if="donationErrors.email" class="text-red-500 text-xs mt-1">{{ donationErrors.email }}</p>
                </div>

                <!-- Image -->
                <div>
                  <label for="donationImage" class="block text-sm font-medium text-gray-700 mb-1">Payment Confirmation Image *</label>
                  <input
                    type="file"
                    id="donationImage"
                    accept="image/*"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 bg-gray-50 text-sm"
                    :class="{ 'border-red-500': donationErrors.image }"
                    @change="handleImageUpload"
                  />
                  <p v-if="donationErrors.image" class="text-red-500 text-xs mt-1">{{ donationErrors.image }}</p>
                  <p v-if="donationInfo.image" class="text-xs text-gray-600 mt-1">Selected: {{ donationInfo.image.name }}</p>
                </div>

                <!-- Submit -->
                <button
                  type="submit"
                  class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 text-sm"
                >
                  Submit Donation
                </button>
              </form>

              <!-- Success / Error Message -->
              <div v-if="donationMessage" class="mt-4 p-3 rounded-lg animate__animated animate__fadeIn" :class="donationMessage.type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'">
                {{ donationMessage.text }}
              </div>
            </div>

            <!-- Payment Methods -->
            <div class="bg-white rounded-2xl p-6 border border-indigo-100">
              <h3 class="text-xl font-semibold text-gray-900 mb-4 text-center">Choose Payment Method</h3>
              <div class="flex justify-center mb-4">
                <div class="grid grid-cols-3 gap-2 bg-gray-100 rounded-lg p-2">
                  <button
                    v-for="method in paymentMethods"
                    :key="method.id"
                    @click="selectedPaymentMethod = method.id"
                    :class="selectedPaymentMethod === method.id ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-200'"
                    class="px-3 py-1 rounded-lg text-xs font-medium transition duration-300"
                  >
                    {{ method.name }}
                  </button>
                </div>
              </div>

              <!-- QR and Account Info -->
              <div class="text-center">
                <div class="inline-block bg-white p-4 rounded-2xl border-2 border-gray-200 shadow-lg mb-4 transform transition-all hover:scale-105">
                  <img 
                    :src="currentQRCode" 
                    :alt="`${getCurrentPaymentMethod().name} QR Code`"
                    class="w-48 h-48 mx-auto"
                  />
                </div>
                <p class="text-base font-medium text-gray-900 mb-1">
                  Scan with {{ getCurrentPaymentMethod().name }}
                </p>
                <p class="text-sm text-gray-600 mb-3">
                  Account: {{ getCurrentPaymentMethod().account }}
                </p>
                <p class="text-gray-700 text-sm max-w-md mx-auto">
                  We are deeply grateful to everyone who has contributed to our mission. Your support makes a real difference in the lives of Cambodian children and communities. Thank you!
                </p>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
  </div>
</template>
<script setup>
import { ref, computed } from 'vue';

const PAYMENT_METHODS = [
  { id: 'ABA', name: 'ABA', account: 'donations@organization.org', qrCode: '../src/assets/image/image.png' },
  { id: 'Acelida', name: 'Acelida', account: '@YourOrganization', instruction: 'Scan via Acelida app', qrCode: '../src/assets/image/image.png' },
  { id: 'Wing', name: 'Wing', account: '$YourOrganization', instruction: 'Scan via Wing app', qrCode: '../src/assets/image/image.png' },
];

const paymentMethods = PAYMENT_METHODS;
const selectedPaymentMethod = ref('ABA');

const donationInfo = ref({
  name: '',
  email: '',
  image: null,
  type: 'one-time',
  message: '',
});

const donationErrors = ref({
  name: '',
  email: '',
  image: '',
  type: '',
});

const donationMessage = ref(null);

const currentQRCode = computed(() => PAYMENT_METHODS.find((m) => m.id === selectedPaymentMethod.value)?.qrCode || '');
const getCurrentPaymentMethod = () => PAYMENT_METHODS.find((m) => m.id === selectedPaymentMethod.value) || PAYMENT_METHODS[0];

const validateEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

const clearDonationError = (field) => {
  donationErrors.value[field] = '';
};

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (!file) {
    donationErrors.value.image = 'Please select an image';
    donationInfo.value.image = null;
    return;
  }
  if (!file.type.startsWith('image/')) {
    donationErrors.value.image = 'Please upload a valid image file';
    donationInfo.value.image = null;
  } else if (file.size > 5 * 1024 * 1024) {
    donationErrors.value.image = 'Image size must be less than 5MB';
    donationInfo.value.image = null;
  } else {
    donationErrors.value.image = '';
    donationInfo.value.image = file;
  }
};

const saveDonationInfo = async () => {
  donationErrors.value = { name: '', email: '', image: '', type: '' };
  let isValid = true;

  if (!donationInfo.value.name.trim()) {
    donationErrors.value.name = 'Full name is required';
    isValid = false;
  }
  if (!donationInfo.value.email.trim()) {
    donationErrors.value.email = 'Email is required';
    isValid = false;
  } else if (!validateEmail(donationInfo.value.email)) {
    donationErrors.value.email = 'Please enter a valid email address';
    isValid = false;
  }
  if (!donationInfo.value.image) {
    donationErrors.value.image = 'Please upload a payment confirmation image';
    isValid = false;
  }

  if (!isValid) {
    donationMessage.value = { type: 'error', text: 'Please correct the errors in the form.' };
    return;
  }

  let imageData = '';
  try {
    imageData = await new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.onload = () => resolve(reader.result);
      reader.onerror = reject;
      reader.readAsDataURL(donationInfo.value.image);
    });
  } catch (error) {
    donationErrors.value.image = 'Error processing image';
    donationMessage.value = { type: 'error', text: 'Failed to process the uploaded image. Please try again.' };
    return;
  }

  const donationData = {
    name: donationInfo.value.name,
    email: donationInfo.value.email,
    image: imageData,
    type: donationInfo.value.type,
    message: donationInfo.value.message,
    paymentMethod: selectedPaymentMethod.value,
    timestamp: new Date().toISOString(),
  };

  try {
    await new Promise((resolve) => setTimeout(resolve, 1000));
    localStorage.setItem('donationInfo', JSON.stringify(donationData));

    donationMessage.value = {
      type: 'success',
      text: `Thank you, ${donationInfo.value.name}! Your donation has been saved. We will verify it via ${getCurrentPaymentMethod().name}.`,
    };

    donationInfo.value = { name: '', email: '', image: null, type: 'one-time', message: '' };
  } catch (error) {
    donationMessage.value = { type: 'error', text: 'Sorry, there was an error saving your donation. Please try again.' };
  }
};
</script>
