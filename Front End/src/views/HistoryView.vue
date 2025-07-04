<template>
  <!-- <div class="bg-orange-500 text-white py-2 overflow-hidden">
    <div class="animate-marquee whitespace-nowrap">
      <span class="mx-8"
        >Our 2025 Spring Campaign is live! → Read more & donate here</span
      >
      <span class="mx-8"
        >Our 2025 Spring Campaign is live! → Read more & donate here</span
      >
      <span class="mx-8"
        >Our 2025 Spring Campaign is live! → Read more & donate here</span
      >
      <span class="mx-8"
        >Our 2025 Spring Campaign is live! → Read more & donate here</span
      >
    </div>
  </div> -->
  <div class="min-h-screen bg-white">
    <!-- Campaign Banner -->

    <!-- History Banner Section -->
    <section
      class="bg-gradient-to-r from-teal-600 to-blue-800 text-white py-16 relative overflow-hidden"
    >
      <!-- Background Pattern -->
      <div class="absolute inset-0 opacity-10">
        <div
          class="absolute top-10 left-10 w-20 h-20 border-2 border-white rounded-full"
        ></div>
        <div
          class="absolute top-32 right-20 w-16 h-16 border-2 border-white rounded-full"
        ></div>
        <div
          class="absolute bottom-20 left-32 w-12 h-12 border-2 border-white rounded-full"
        ></div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <!-- Left Content -->
          <div>
            <div class="flex items-center mb-6">
              <div
                class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mr-4"
              >
                <svg
                  class="w-6 h-6 text-white"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                  ></path>
                </svg>
              </div>
              <span class="text-teal-200 font-medium">Since 2004</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold mb-6">
              20 Years of
              <span class="text-orange-400">Transforming Lives</span>
            </h1>

            <p class="text-xl text-teal-100 mb-8 leading-relaxed">
              From a small initiative in rural Thailand to a global movement
              impacting thousands of lives across Asia through digital education
              and career development.
            </p>

            <!-- Key Milestones -->
            <div class="grid grid-cols-2 gap-6 mb-8">
              <div class="text-center">
                <div class="text-3xl font-bold text-orange-400 mb-1">
                  3,000+
                </div>
                <div class="text-teal-200 text-sm">Graduates</div>
              </div>
              <div class="text-center">
                <div class="text-3xl font-bold text-orange-400 mb-1">4</div>
                <div class="text-teal-200 text-sm">Training Centers</div>
              </div>
              <div class="text-center">
                <div class="text-3xl font-bold text-orange-400 mb-1">85%</div>
                <div class="text-teal-200 text-sm">Employment Rate</div>
              </div>
              <div class="text-center">
                <div class="text-3xl font-bold text-orange-400 mb-1">3</div>
                <div class="text-teal-200 text-sm">Countries</div>
              </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
              <button
                class="bg-orange-500 text-white px-8 py-3 rounded-lg hover:bg-orange-600 transition-all transform hover:scale-105 font-semibold"
              >
                Our Full History
              </button>
              <button
                class="border-2 border-white text-white px-8 py-3 rounded-lg hover:bg-white hover:text-teal-600 transition-all font-semibold"
              >
                View Timeline
              </button>
            </div>
          </div>

          <!-- Right Content - Timeline Preview -->
          <div class="relative">
            <div
              class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6"
            >
              <h3 class="text-2xl font-bold mb-6 text-center">
                Key Milestones
              </h3>

              <!-- Mini Timeline -->
              <div class="space-y-4">
                <div
                  v-for="milestone in featuredMilestones"
                  :key="milestone.year"
                  class="flex items-center p-4 bg-white bg-opacity-10 rounded-lg hover:bg-opacity-20 transition-all"
                >
                  <div
                    class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0"
                  >
                    <component
                      :is="milestone.icon"
                      class="w-6 h-6 text-white"
                    />
                  </div>
                  <div>
                    <div class="font-bold text-orange-400">
                      {{ milestone.year }}
                    </div>
                    <div class="text-white font-medium">
                      {{ milestone.title }}
                    </div>
                    <div class="text-teal-200 text-sm">
                      {{ milestone.impact }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="text-center mt-6">
                <button
                  class="text-orange-400 hover:text-orange-300 font-medium"
                >
                  View Complete Timeline →
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Hero Section -->

    <!-- Rest of your existing sections... -->
    <!-- Impact Statistics -->
    <section class="py-16 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">
            Our Global Impact
          </h2>
          <p class="text-xl text-gray-600">
            Empowering youth through digital education across Asia
          </p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div
            v-for="stat in impactStats"
            :key="stat.label"
            class="text-center group"
          >
            <div
              class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1"
            >
              <div
                class="w-16 h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform"
              >
                <component :is="stat.icon" class="w-8 h-8 text-white" />
              </div>
              <div class="text-3xl font-bold text-gray-900 mb-2">
                {{ stat.value }}
              </div>
              <div class="text-gray-600 font-medium">{{ stat.label }}</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <div class="flex items-center mb-4">
              <div
                class="bg-teal-600 text-white px-3 py-2 rounded font-bold text-xl mr-3"
              >
                PN
              </div>
              <div>
                <div class="font-bold text-white">Passerelles Numériques</div>
                <div class="text-sm text-gray-400 italic">
                  A Gateway for Life
                </div>
              </div>
            </div>
            <p class="text-gray-300 mb-6 leading-relaxed">
              Empowering underprivileged youth through digital education and
              creating pathways to successful careers in technology.
            </p>
          </div>

          <div>
            <h3 class="text-lg font-semibold mb-4">Programs</h3>
            <ul class="space-y-2">
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-teal-400 transition-colors"
                  >Digital Training</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-teal-400 transition-colors"
                  >Career Development</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-teal-400 transition-colors"
                  >Soft Skills</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-teal-400 transition-colors"
                  >Alumni Network</a
                >
              </li>
            </ul>
          </div>

          <div>
            <h3 class="text-lg font-semibold mb-4">Get Involved</h3>
            <ul class="space-y-2">
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-teal-400 transition-colors"
                  >Donate</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-teal-400 transition-colors"
                  >Volunteer</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-teal-400 transition-colors"
                  >Partner with Us</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-teal-400 transition-colors"
                  >Corporate Support</a
                >
              </li>
            </ul>
          </div>

          <div>
            <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
            <div class="space-y-2 text-gray-300">
              <p>Phnom Penh, Cambodia</p>
              <p>Phone: +855 (0) 23 xxx xxx</p>
              <p>Email: info@passerellesnumeriques.org</p>
            </div>
          </div>
        </div>

        <div
          class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400"
        >
          <p>
            &copy; 2024 Passerelles Numériques. All rights reserved. | Privacy
            Policy | Terms of Service
          </p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref } from "vue";

// Featured milestones for banner
const featuredMilestones = ref([
  {
    year: "2004",
    title: "Foundation",
    impact: "First center in Thailand",
    icon: "HomeIcon",
  },
  {
    year: "2010",
    title: "Digital Focus",
    impact: "Tech training programs",
    icon: "ComputerDesktopIcon",
  },
  {
    year: "2019",
    title: "Global Recognition",
    impact: "UNESCO Award",
    icon: "StarIcon",
  },
  {
    year: "2024",
    title: "20th Anniversary",
    impact: "3,000+ graduates",
    icon: "CakeIcon",
  },
]);

// Impact statistics
const impactStats = ref([
  { value: "3,000+", label: "Graduates", icon: "UsersIcon" },
  { value: "85%", label: "Employment Rate", icon: "BuildingIcon" },
  { value: "4", label: "Training Centers", icon: "AcademicCapIcon" },
  { value: "3", label: "Countries", icon: "GlobeIcon" },
]);

// Icon components
const HomeIcon = {
  template:
    '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>',
};
const ComputerDesktopIcon = {
  template:
    '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
};
const StarIcon = {
  template:
    '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>',
};
const CakeIcon = {
  template:
    '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0A2.704 2.704 0 003 15.546V12c0-.55.45-1 1-1h16c.55 0 1 .45 1 1v3.546zM7 4V2a1 1 0 011-1h8a1 1 0 011 1v2"></path></svg>',
};
const UsersIcon = {
  template:
    '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path></svg>',
};
const BuildingIcon = {
  template:
    '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>',
};
const AcademicCapIcon = {
  template:
    '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>',
};
const GlobeIcon = {
  template:
    '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
};
</script>

<style scoped>
/* Marquee animation for campaign banner */
@keyframes marquee {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(-100%);
  }
}

.animate-marquee {
  animation: marquee 30s linear infinite;
}

/* Custom hover effects */
.group:hover .group-hover\:scale-110 {
  transform: scale(1.1);
}

.group:hover .group-hover\:translate-x-1 {
  transform: translateX(0.25rem);
}

.group:hover .group-hover\:scale-105 {
  transform: scale(1.05);
}
</style>
