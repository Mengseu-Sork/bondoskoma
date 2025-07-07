<template>
  <AdminLayout>
    <div class="h-full">
      <!-- Page Header -->
      <div class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex justify-between items-center">
          <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Settings</h2>
            <p class="text-gray-600">Configure your system preferences and account settings</p>
          </div>
          
          <div class="flex space-x-3">
            <button 
              v-if="hasChanges"
              @click="resetChanges"
              class="px-4 py-2 text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors duration-200"
            >
              Reset
            </button>
            <button 
              @click="saveSettings"
              :disabled="!hasChanges || saving"
              :class="[
                'px-6 py-2 rounded-lg font-medium transition-all duration-200 flex items-center space-x-2',
                hasChanges && !saving
                  ? 'bg-blue-600 hover:bg-blue-700 text-white shadow-md hover:shadow-lg' 
                  : 'bg-gray-300 text-gray-500 cursor-not-allowed'
              ]"
            >
              <svg v-if="saving" class="animate-spin w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
              </svg>
              <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <span>{{ saving ? 'Saving...' : 'Save Changes' }}</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Settings Content -->
      <div class="flex h-full">
        <!-- Settings Tabs Sidebar -->
        <div class="w-64 bg-white border-r border-gray-200 p-6">
          <nav class="space-y-2">
            <button
              v-for="tab in tabs"
              :key="tab.id"
              @click="activeTab = tab.id"
              :class="[
                'w-full flex items-center space-x-3 px-4 py-3 text-left rounded-lg font-medium text-sm transition-all duration-200',
                activeTab === tab.id
                  ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-500'
                  : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
              ]"
            >
              <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="tab.icon" />
              </svg>
              <span>{{ tab.name }}</span>
            </button>
          </nav>
        </div>

        <!-- Tab Content -->
        <div class="flex-1 p-6 overflow-auto">
          <!-- General Settings Tab -->
          <div v-if="activeTab === 'general'" class="space-y-6">
            <!-- Organization Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
              <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                  <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                  </svg>
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">Organization Information</h3>
                  <p class="text-sm text-gray-600">Basic information about your organization</p>
                </div>
              </div>
              
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Organization Name</label>
                  <input 
                    v-model="settings.general.organizationName"
                    @input="markAsChanged"
                    type="text" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                    placeholder="Enter organization name"
                  />
                </div>
                
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Website URL</label>
                  <input 
                    v-model="settings.general.websiteUrl"
                    @input="markAsChanged"
                    type="url" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                    placeholder="https://example.com"
                  />
                </div>
                
                <div class="lg:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                  <textarea 
                    v-model="settings.general.description"
                    @input="markAsChanged"
                    rows="4" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                    placeholder="Brief description of your organization"
                  ></textarea>
                </div>
                
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                  <input 
                    v-model="settings.general.contactEmail"
                    @input="markAsChanged"
                    type="email" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                    placeholder="contact@example.com"
                  />
                </div>
                
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                  <input 
                    v-model="settings.general.phoneNumber"
                    @input="markAsChanged"
                    type="tel" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                    placeholder="+1 (555) 123-4567"
                  />
                </div>
              </div>
            </div>

            <!-- Address Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
              <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                  <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">Address Information</h3>
                  <p class="text-sm text-gray-600">Physical location details</p>
                </div>
              </div>
              
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="lg:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Street Address</label>
                  <input 
                    v-model="settings.general.address.street"
                    @input="markAsChanged"
                    type="text" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                    placeholder="123 Main Street"
                  />
                </div>
                
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                  <input 
                    v-model="settings.general.address.city"
                    @input="markAsChanged"
                    type="text" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                    placeholder="City name"
                  />
                </div>
                
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">State/Province</label>
                  <input 
                    v-model="settings.general.address.state"
                    @input="markAsChanged"
                    type="text" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                    placeholder="State or Province"
                  />
                </div>
                
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">ZIP/Postal Code</label>
                  <input 
                    v-model="settings.general.address.zipCode"
                    @input="markAsChanged"
                    type="text" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                    placeholder="12345"
                  />
                </div>
                
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                  <select 
                    v-model="settings.general.address.country"
                    @change="markAsChanged"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                  >
                    <option value="">Select Country</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="UK">United Kingdom</option>
                    <option value="AU">Australia</option>
                    <option value="DE">Germany</option>
                    <option value="FR">France</option>
                    <option value="JP">Japan</option>
                    <option value="OTHER">Other</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- Security Settings Tab -->
          <div v-if="activeTab === 'security'" class="space-y-6">
            <!-- Authentication Settings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
              <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                  <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">Authentication & Security</h3>
                  <p class="text-sm text-gray-600">Manage login security and access controls</p>
                </div>
              </div>
              
              <div class="space-y-6">
                <!-- Two-Factor Authentication -->
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                  <div class="flex items-center space-x-4">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                      <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                      </svg>
                    </div>
                    <div>
                      <h4 class="text-sm font-medium text-gray-900">Two-Factor Authentication</h4>
                      <p class="text-sm text-gray-500">Add an extra layer of security to your account</p>
                    </div>
                  </div>
                  <button 
                    @click="toggleTwoFactor"
                    :class="[
                      'relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2',
                      settings.security.twoFactorAuth ? 'bg-blue-600' : 'bg-gray-200'
                    ]"
                  >
                    <span 
                      :class="[
                        'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                        settings.security.twoFactorAuth ? 'translate-x-6' : 'translate-x-1'
                      ]"
                    ></span>
                  </button>
                </div>

                <!-- Login Notifications -->
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                  <div class="flex items-center space-x-4">
                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                      <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z" />
                      </svg>
                    </div>
                    <div>
                      <h4 class="text-sm font-medium text-gray-900">Login Notifications</h4>
                      <p class="text-sm text-gray-500">Get notified when someone logs into your account</p>
                    </div>
                  </div>
                  <button 
                    @click="settings.security.loginNotifications = !settings.security.loginNotifications; markAsChanged()"
                    :class="[
                      'relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2',
                      settings.security.loginNotifications ? 'bg-blue-600' : 'bg-gray-200'
                    ]"
                  >
                    <span 
                      :class="[
                        'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                        settings.security.loginNotifications ? 'translate-x-6' : 'translate-x-1'
                      ]"
                    ></span>
                  </button>
                </div>

                <!-- Session Settings -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Session Timeout</label>
                    <select 
                      v-model="settings.security.sessionTimeout"
                      @change="markAsChanged"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                    >
                      <option value="15">15 minutes</option>
                      <option value="30">30 minutes</option>
                      <option value="60">1 hour</option>
                      <option value="120">2 hours</option>
                      <option value="480">8 hours</option>
                    </select>
                  </div>
                  
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Strength</label>
                    <select 
                      v-model="settings.security.passwordStrength"
                      @change="markAsChanged"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                    >
                      <option value="basic">Basic (8+ characters)</option>
                      <option value="medium">Medium (8+ chars, numbers)</option>
                      <option value="strong">Strong (8+ chars, numbers, symbols)</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Notifications Tab -->
          <div v-if="activeTab === 'notifications'" class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
              <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                  <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z" />
                  </svg>
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">Notification Settings</h3>
                  <p class="text-sm text-gray-600">Configure your notification preferences</p>
                </div>
              </div>
              
              <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                  <div>
                    <h4 class="text-sm font-medium text-gray-900">Email Notifications</h4>
                    <p class="text-sm text-gray-500">Receive notifications via email</p>
                  </div>
                  <button 
                    @click="settings.notifications.emailNotifications = !settings.notifications.emailNotifications; markAsChanged()"
                    :class="[
                      'relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2',
                      settings.notifications.emailNotifications ? 'bg-blue-600' : 'bg-gray-200'
                    ]"
                  >
                    <span 
                      :class="[
                        'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                        settings.notifications.emailNotifications ? 'translate-x-6' : 'translate-x-1'
                      ]"
                    ></span>
                  </button>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                  <div>
                    <h4 class="text-sm font-medium text-gray-900">Push Notifications</h4>
                    <p class="text-sm text-gray-500">Browser push notifications</p>
                  </div>
                  <button 
                    @click="settings.notifications.pushNotifications = !settings.notifications.pushNotifications; markAsChanged()"
                    :class="[
                      'relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2',
                      settings.notifications.pushNotifications ? 'bg-blue-600' : 'bg-gray-200'
                    ]"
                  >
                    <span 
                      :class="[
                        'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                        settings.notifications.pushNotifications ? 'translate-x-6' : 'translate-x-1'
                      ]"
                    ></span>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- System Tab -->
          <div v-if="activeTab === 'system'" class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
              <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                  <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                  </svg>
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">System Information</h3>
                  <p class="text-sm text-gray-600">Current system status and information</p>
                </div>
              </div>
              
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                  <p class="text-sm text-blue-600 font-medium">Version</p>
                  <p class="text-lg font-bold text-blue-900">v2.1.0</p>
                </div>
                
                <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                  <p class="text-sm text-green-600 font-medium">Uptime</p>
                  <p class="text-lg font-bold text-green-900">15 days</p>
                </div>
                
                <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                  <p class="text-sm text-yellow-600 font-medium">Storage</p>
                  <p class="text-lg font-bold text-yellow-900">2.3 GB</p>
                </div>
                
                <div class="p-4 bg-purple-50 rounded-lg border border-purple-200">
                  <p class="text-sm text-purple-600 font-medium">Status</p>
                  <p class="text-lg font-bold text-purple-900">Healthy</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Success Message -->
      <div 
        v-if="showSuccessMessage"
        class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2 z-50 transform transition-all duration-300"
        :class="showSuccessMessage ? 'translate-y-0 opacity-100' : 'translate-y-2 opacity-0'"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>Settings saved successfully!</span>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import AdminLayout from '../components/AdminAside.vue'

// Reactive state
const activeTab = ref('general')
const hasChanges = ref(false)
const saving = ref(false)
const showSuccessMessage = ref(false)
const originalSettings = ref({})

// Tab configuration
const tabs = [
  {
    id: 'general',
    name: 'General',
    icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'
  },
  {
    id: 'security',
    name: 'Security',
    icon: 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'
  },
  {
    id: 'notifications',
    name: 'Notifications',
    icon: 'M15 17h5l-5 5v-5z'
  },
  {
    id: 'system',
    name: 'System',
    icon: 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z'
  }
]

// Settings data
const settings = ref({
  general: {
    organizationName: 'Bandos Komar Foundation',
    websiteUrl: 'https://bandoskomar.org',
    description: 'A non-profit organization dedicated to community development and social welfare.',
    contactEmail: 'info@bandoskomar.org',
    phoneNumber: '+1 (555) 123-4567',
    address: {
      street: '123 Foundation Street',
      city: 'Community City',
      state: 'State',
      zipCode: '12345',
      country: 'US'
    }
  },
  security: {
    twoFactorAuth: false,
    loginNotifications: true,
    sessionTimeout: '60',
    passwordStrength: 'medium'
  },
  notifications: {
    emailNotifications: true,
    pushNotifications: false
  }
})

// Methods
const markAsChanged = () => {
  hasChanges.value = true
}

const resetChanges = () => {
  settings.value = JSON.parse(JSON.stringify(originalSettings.value))
  hasChanges.value = false
}

const saveSettings = async () => {
  saving.value = true
  
  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1000))
    
    // Save settings logic here
    console.log('Settings saved:', settings.value)
    
    // Update original settings
    originalSettings.value = JSON.parse(JSON.stringify(settings.value))
    hasChanges.value = false
    showSuccessMessage.value = true
    
    setTimeout(() => {
      showSuccessMessage.value = false
    }, 3000)
    
  } catch (error) {
    console.error('Error saving settings:', error)
  } finally {
    saving.value = false
  }
}

const toggleTwoFactor = () => {
  settings.value.security.twoFactorAuth = !settings.value.security.twoFactorAuth
  markAsChanged()
}

// Load settings on mount
onMounted(() => {
  // Store original settings for reset functionality
  originalSettings.value = JSON.parse(JSON.stringify(settings.value))
  console.log('Settings loaded')
})
</script>
