<template>
  <footer class="bg-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- First row: OUR PROJECTS and WAYS TO HELP (always in a row) -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8 mb-8 lg:mb-0">
        <!-- Our Projects -->
        <div>
          <h3 class="text-sm lg:text-lg font-semibold mb-3 lg:mb-4 text-blue-400">OUR PROJECTS</h3>
          <ul class="space-y-1 lg:space-y-2">
            <li>
              <a href="#" class="text-xs lg:text-sm text-gray-300 hover:text-blue-400 transition-colors">
                Our Story
              </a>
            </li>
            <li>
              <a href="#" class="text-xs lg:text-sm text-gray-300 hover:text-blue-400 transition-colors">
                Our Team
              </a>
            </li>
            <li>
              <a href="#" class="text-xs lg:text-sm text-gray-300 hover:text-blue-400 transition-colors">
                Annual Report
              </a>
            </li>
            <li>
              <a href="#" class="text-xs lg:text-sm text-gray-300 hover:text-blue-400 transition-colors">
                Careers
              </a>
            </li>
            <li>
              <a href="#" class="text-xs lg:text-sm text-gray-300 hover:text-blue-400 transition-colors">
                Awards We've Won
              </a>
            </li>
          </ul>
        </div>

        <!-- Ways to Help -->
        <div>
          <h3 class="text-sm lg:text-lg font-semibold mb-3 lg:mb-4 text-blue-400">WAYS TO HELP</h3>
          <ul class="space-y-1 lg:space-y-2">
            <li>
              <a href="#" class="text-xs lg:text-sm text-gray-300 hover:text-blue-400 transition-colors">
                Donate
              </a>
            </li>
            <li>
              <a href="#" class="text-xs lg:text-sm text-gray-300 hover:text-blue-400 transition-colors">
                Volunteer
              </a>
            </li>
            <li>
              <a href="#" class="text-xs lg:text-sm text-gray-300 hover:text-blue-400 transition-colors">
                Fundraise
              </a>
            </li>
            <li>
              <a href="#" class="text-xs lg:text-sm text-gray-300 hover:text-blue-400 transition-colors">
                Corporate Partnerships
              </a>
            </li>
          </ul>
        </div>

        <!-- Actions (hidden on mobile, shown on lg+) -->
        <div class="hidden lg:block">
          <h3 class="text-lg font-semibold mb-4 text-blue-400">ACTIONS</h3>
          <ul class="space-y-2">
            <li>
              <a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">
                Contact
              </a>
            </li>
            <li>
              <a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">
                Privacy Policy
              </a>
            </li>
            <li>
              <a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">
                Terms
              </a>
            </li>
          </ul>
        </div>

        <!-- Newsletter Signup (hidden on mobile, shown on lg+) -->
        <div class="hidden lg:block">
          <h3 class="text-lg font-semibold mb-4 text-blue-400">Subscribe for Speech News and Other Updates</h3>
          <div class="space-y-4">
            <input
              v-model="email"
              type="email"
              placeholder="Enter your email"
              class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent placeholder:text-gray-400"
            />
            <button 
              @click="subscribe"
              class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold"
            >
              Subscribe
            </button>
          </div>

          <!-- Social Media Icons -->
          <div class="flex space-x-4 mt-6">
            <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
              </svg>
              <span class="sr-only">Twitter</span>
            </a>
            <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
              </svg>
              <span class="sr-only">Facebook</span>
            </a>
            <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
              </svg>
              <span class="sr-only">LinkedIn</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Second row: Actions and Newsletter (visible only on mobile) -->
      <div class="grid grid-cols-1 gap-6 lg:hidden mt-8">
        <!-- Actions (mobile) -->
        <div>
          <h3 class="text-sm font-semibold mb-3 text-blue-400">ACTIONS</h3>
          <ul class="space-y-1">
            <li>
              <a href="#" class="text-xs text-gray-300 hover:text-blue-400 transition-colors">
                Contact
              </a>
            </li>
            <li>
              <a href="#" class="text-xs text-gray-300 hover:text-blue-400 transition-colors">
                Privacy Policy
              </a>
            </li>
            <li>
              <a href="#" class="text-xs text-gray-300 hover:text-blue-400 transition-colors">
                Terms
              </a>
            </li>
          </ul>
        </div>

        <!-- Newsletter Signup (mobile) -->
        <div>
          <h3 class="text-sm font-semibold mb-3 text-blue-400">Subscribe for Updates</h3>
          <div class="space-y-3">
            <input
              v-model="email"
              type="email"
              placeholder="Enter your email"
              class="w-full px-3 py-2 text-sm rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent placeholder:text-gray-400"
            />
            <button 
              @click="subscribe"
              class="w-full bg-blue-600 text-white px-4 py-2 text-sm rounded-lg hover:bg-blue-700 transition-colors font-semibold"
            >
              Subscribe
            </button>
          </div>

          <!-- Social Media Icons (mobile) -->
          <div class="flex space-x-4 mt-4 justify-center">
            <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
              </svg>
              <span class="sr-only">Twitter</span>
            </a>
            <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
              </svg>
              <span class="sr-only">Facebook</span>
            </a>
            <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
              </svg>
              <span class="sr-only">LinkedIn</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'Footer',
  data() {
    return {
      email: ''
    }
  },
  methods: {
    subscribe() {
      if (this.email) {
        console.log('Subscribing email:', this.email)
        // Add your subscription logic here
        alert('Thank you for subscribing!')
        this.email = ''
      } else {
        alert('Please enter a valid email address')
      }
    }
  }
}
</script>

<style scoped>
.transition-colors {
  transition: color 0.3s ease;
}
</style>
