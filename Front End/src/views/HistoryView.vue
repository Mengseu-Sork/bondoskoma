<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-white">
    <!-- Page Title -->
    <div class="container mx-auto px-4 max-w-6xl pt-16 pb-8">
      <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 tracking-tight">
          Our History
        </h1>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
        <p class="text-lg text-gray-600 mt-6 max-w-2xl mx-auto">
          Journey through three decades of transformative impact in Cambodia
        </p>
      </div>
    </div>

    <!-- Horizontal Timeline Section -->
    <section class="py-24 bg-white relative overflow-hidden">
      <!-- Background Pattern -->
      <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(0,0,0,0.15) 1px, transparent 0); background-size: 20px 20px;"></div>
      </div>
      
      <div class="container mx-auto px-4 max-w-7xl relative">
        <div class="relative">
          <!-- Navigation Arrows -->
          <button
            @click="scrollLeft"
            class="absolute left-2 top-1/2 transform -translate-y-1/2 z-20 bg-white rounded-full p-4 shadow-2xl hover:shadow-3xl transition-all duration-300 hover:scale-110 border border-gray-100 group"
          >
            <svg
              class="w-6 h-6 text-gray-600 group-hover:text-blue-600 transition-colors duration-300"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 19l-7-7 7-7"
              ></path>
            </svg>
          </button>
          
          <button
            @click="scrollRight"
            class="absolute right-2 top-1/2 transform -translate-y-1/2 z-20 bg-white rounded-full p-4 shadow-2xl hover:shadow-3xl transition-all duration-300 hover:scale-110 border border-gray-100 group"
          >
            <svg
              class="w-6 h-6 text-gray-600 group-hover:text-blue-600 transition-colors duration-300"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5l7 7-7 7"
              ></path>
            </svg>
          </button>

          <!-- Timeline Content -->
          <div
            ref="timelineContainer"
            class="mx-20 overflow-x-auto scrollbar-hide scroll-smooth"
            style="scrollbar-width: none; -ms-overflow-style: none"
          >
            <div
              class="flex space-x-10 pb-8 relative"
              style="width: max-content"
            >
              <!-- Enhanced Timeline Line -->
              <div class="absolute top-1/2 left-0 right-0 h-1 bg-gradient-to-r from-blue-200 via-purple-200 to-orange-200 transform -translate-y-1/2 pointer-events-none rounded-full shadow-sm"></div>

              <!-- Timeline Items -->
              <div
                v-for="(milestone, index) in milestones"
                :key="index"
                class="flex-shrink-0 w-80 text-center relative group"
              >
                <!-- Top Content -->
                <div class="mb-8 h-40 bg-white rounded-xl p-5 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                  <h3
                    :class="['text-xl font-bold mb-3 tracking-tight', milestone.titleColor]"
                  >
                    {{ milestone.title }}
                  </h3>
                  <p class="text-gray-600 leading-relaxed text-sm">
                    <span v-html="milestone.description"></span>
                  </p>
                </div>

                <!-- Enhanced Circle Image with Timeline Dot -->
                <div class="relative inline-block mb-8">
                  <div class="relative">
                    <div
                      class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-2xl relative z-10 group-hover:scale-105 transition-transform duration-300"
                    >
                      <img
                        :src="milestone.image"
                        :alt="milestone.title"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                      />
                    </div>
                    <!-- Enhanced Timeline Dot -->
                    <!-- <div
                      :class="['absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-6 h-6 rounded-full border-4 border-white z-20 shadow-xl group-hover:scale-125 transition-transform duration-300', milestone.dotColor]"
                    ></div> -->
                    <!-- Pulse Animation -->
                    <div
                      :class="['absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-6 h-6 rounded-full opacity-75 animate-ping', milestone.dotColor]"
                    ></div>
                  </div>
                </div>

                <!-- Enhanced Year and Period -->
                <div class="mb-6 bg-gradient-to-br from-gray-50 to-white rounded-xl p-5 shadow-lg border border-gray-100">
                  <h2 class="text-3xl font-bold text-gray-900 mb-2 tracking-tight">
                    {{ milestone.year }}
                  </h2>
                  <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">
                    {{ milestone.period }}
                  </p>
                </div>

                <!-- Bottom Description -->
                <div class="h-24 bg-white rounded-xl p-4 shadow-lg border border-gray-100">
                  <p class="text-gray-600 text-sm leading-relaxed">
                    <span v-html="milestone.bottomText"></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Enhanced Legacy Section -->
    <section class="py-16 bg-gradient-to-br from-gray-50 to-blue-50 relative">
      <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-16">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 tracking-tight">
            Our Legacy Today
          </h2>
          <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full mb-6"></div>
          <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Three decades of dedication have built a foundation for lasting
            change in Cambodia
          </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
          <div
            v-for="(achievement, index) in currentAchievements"
            :key="index"
            class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 text-center border border-gray-100 group hover:-translate-y-2"
          >
            <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 mb-4 group-hover:scale-110 transition-transform duration-300">
              {{ achievement.number }}
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-3 tracking-tight">
              {{ achievement.title }}
            </h3>
            <p class="text-gray-600 text-sm leading-relaxed">
              {{ achievement.description }}
            </p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from "vue";

const timelineContainer = ref(null);

const milestones = [
  {
    title: "Foundation Era",
    year: "1989",
    period: "November",
    titleColor: "text-gray-900",
    dotColor: "bg-blue-500",
    image:
      "https://scontent.fpnh19-1.fna.fbcdn.net/v/t1.6435-9/118849428_139293047859941_1494900947512703826_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFDEm4qNJx3kQLEE2vuhBFvAsdcKb5SVFkCx1wpvlJUWTH28ehdiSTeGR_WwHFo4wzpISuaRT_sdefLOJ2KOS0I&_nc_ohc=ylhlvC17bv0Q7kNvwE_j-Qe&_nc_oc=Adk3o3ivVA_R6RCajLU1tGSX5fr3nJiklDOMbevwAVth-zkBlaVFBhEeoCLG17aNhuY&_nc_zt=23&_nc_ht=scontent.fpnh19-1.fna&_nc_gid=tYaKLL9aa_AbtNjc-hvKvg&oh=00_AfRomrLN66dI5LA_mc5r2QR0FfXLNxx24JdBR5NPi3-xbw&oe=68941A65",
    description: `<span class="text-blue-500 font-semibold">Partage</span> began operating programs in Cambodia with basic support, focusing on education in pre-schools and primary schools in rural areas.`,
    bottomText: "Establishing the foundation for educational development in rural Cambodia",
  },
  {
    title: "Growth Period",
    year: "1989-1999",
    period: "Development Phase",
    titleColor: "text-gray-900",
    dotColor: "bg-green-500",
    image:
      "https://scontent.fpnh19-1.fna.fbcdn.net/v/t39.30808-6/475476462_932198885714932_6153510935851522538_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeGb8kA47wNWrs0At3tNh1cUOUG6BJpf_w45QboEml__DjV1X62c8Ocmo32I-_N_5HEDAP4QuEHxVKNRUSK-5ZJc&_nc_ohc=BQYFk4Eg9OMQ7kNvwHIntW8&_nc_oc=AdlvJbT0_PkHggIt298x-V1O9z1l7aCJowsbDWJZoyDvgDHlnTnqBuR1LHWGy3RZPqo&_nc_zt=23&_nc_ht=scontent.fpnh19-1.fna&_nc_gid=wKd4fGmGMba_IhgjJNaw-Q&oh=00_AfSfyzHTjN_bcTvQERqtVjBHXJ2R2v--ffX0bd0pzKJxQg&oe=68729064",
    description: `Progressive development of projects with <span class="text-green-500 font-semibold">6 primary schools</span> and <span class="text-green-500 font-semibold">6 pre-schools</span> across three provinces: Takeo, Kompong Speu, and Kandal.`,
    bottomText: `Established strong foundations in <span class="text-green-500 font-semibold">3 provinces</span> with comprehensive educational support programs.`,
  },
  {
    title: "Localization",
    year: "1999",
    period: "July",
    titleColor: "text-gray-900",
    dotColor: "bg-purple-500",
    image:
      "https://scontent.fpnh19-1.fna.fbcdn.net/v/t39.30808-6/481672505_951417323793088_3885819188452260543_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFL3OmciAnxOBtBn6iX7WOOEnLtHRdkktwScu0dF2SS3IJmeOZZIa7gCSzsnoW6_wzo4hKjdR8QAVia6DKWe4sp&_nc_ohc=CUZVXphWOOIQ7kNvwF48EVI&_nc_oc=Adn4YfNpEVVlXv2Gpdvhs1meadtNWneiu9GfMT7GR4K4BbGDA_fi5T8789xUTiBWKgo&_nc_zt=23&_nc_ht=scontent.fpnh19-1.fna&_nc_gid=PVvox8pYeET7U-gKfK8O0Q&oh=00_AfR3ngL9QLMIhqY2k6voRpoBauO4pMN8hnHTt4Sfwu4zaA&oe=687276B7",
    description: `Historic transition as Partage Cambodia was localized to become <span class="text-purple-500 font-semibold">"Bandos Komar Association"</span> - a fully local NGO taking over all projects.`,
    bottomText: `Birth of <span class="text-purple-500 font-semibold">Bandos Komar Association</span> as an independent local NGO, marking a new era of community-led development.`,
  },
  {
    title: "Strategic Expansion",
    year: "2002+",
    period: "Expansion Era",
    titleColor: "text-gray-900",
    dotColor: "bg-orange-500",
    image:
      "https://scontent.fpnh19-1.fna.fbcdn.net/v/t39.30808-6/490635628_979552260979594_9071224742155653327_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeEUzj26NbjP2pWvDlBPQYG7Fd01-mJah_sV3TX6YlqH-xG6ZbgoF-tR5oqOG72Eb_WtJ4WqKlRUKOAVRRw0sO5P&_nc_ohc=n6bWvUeDoYkQ7kNvwEl5rFM&_nc_oc=Adk4r8RhGWXazFp283cu5TVLmsVjYRczP8ThcOP7BB6fi3IWYjtGy4rkX25C3qiT07s&_nc_zt=23&_nc_ht=scontent.fpnh19-1.fna&_nc_gid=eRpm88VfO1-KzrVdVdKwww&oh=00_AfSGQE2ApgPZ9EVhra0c-g1HrgAeaIH6yCr0pcAll8dEkg&oe=687273E3",
    description: `BK expanded programs to new target provinces: <span class="text-orange-500 font-semibold">Pursat (2002)</span> and <span class="text-orange-500 font-semibold">Siem Reap (2008)</span>, significantly growing our impact across Cambodia.`,
    bottomText: `<strong>Current Reach:</strong> 5 provinces serving thousands of children and families`,
  },
];

const currentAchievements = [
  {
    number: "5",
    title: "Provinces Served",
    description:
      "Active programs across Takeo, Kompong Speu, Kandal, Pursat, and Siem Reap provinces",
  },
  {
    number: "10,000+",
    title: "Lives Impacted",
    description:
      "Children, families, and community members who have benefited from our programs",
  },
  {
    number: "34",
    title: "Years of Service",
    description:
      "Three decades of unwavering commitment to Cambodia's development",
  },
];

const scrollLeft = () => {
  if (timelineContainer.value) {
    timelineContainer.value.scrollBy({
      left: -320,
      behavior: "smooth",
    });
  }
};

const scrollRight = () => {
  if (timelineContainer.value) {
    timelineContainer.value.scrollBy({
      left: 320,
      behavior: "smooth",
    });
  }
};
</script>

<style scoped>
html {
  scroll-behavior: smooth;
}

.scrollbar-hide::-webkit-scrollbar {
  display: none;
}

.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
}

.animate-ping {
  animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
}

@keyframes ping {
  75%, 100% {
    transform: translate(-50%, -50%) scale(2);
    opacity: 0;
  }
}
</style>