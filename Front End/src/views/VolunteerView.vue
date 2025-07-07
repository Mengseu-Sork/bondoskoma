<template>
 <h1 class="text-2xl font-bold text-center">Our Volunteer</h1>
  <div class="flex flex-wrap justify-center gap-6 pt-16">
    <div
      v-for="(person, index) in profiles"
      :key="index"
      class="bg-white rounded-2xl shadow-lg text-center max-w-xs w-full pt-16 pb-6 px-6 relative my-6"
    >
      <!-- Profile Image -->
      <div class="absolute -top-12 left-1/2 transform -translate-x-1/2">
        <img
          :src="person.image"
          alt="Profile"
          class="w-24 h-24 object-cover rounded-full border-4 border-white shadow-md"
        />
      </div>

      <!-- Role -->
      <p class="text-sm text-gray-400 mt-4">{{ person.role }}</p>

      <!-- Name -->
      <h2 class="text-xl font-semibold text-gray-800 mt-1">Name: {{ person.name }}</h2>

      <!-- Description Box with fixed height -->
      <div class="h-[72px] mt-3 overflow-hidden">
        <p class="text-gray-500 text-sm line-clamp-3">
          {{ person.description }}
        </p>
      </div>

      <!-- View Details Button (always in same spot) -->
      <div class="mt-5">
        <button
          @click="openModal(person)"
          class="bg-blue-500 hover:bg-blue-600 text-white font-medium text-sm py-2 px-6 rounded-full shadow transition duration-300"
        >
          View Details
        </button>
      </div>
    </div>

    <!-- Modal -->
    <div v-if="selectedProfile" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-xl max-w-md w-full p-6 relative shadow-lg">
        <button
          @click="selectedProfile = null"
          class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl"
        >
          ✕
        </button>

        <div class="text-center">
          <img
            :src="selectedProfile.image"
            alt="Profile"
            class="w-24 h-24 object-cover rounded-full border-4 border-white mx-auto shadow"
          />
          <h3 class="text-xl font-bold mt-4">{{ selectedProfile.name }}</h3>
          <p class="text-gray-500 text-sm">{{ selectedProfile.role }}</p>
          <p class="text-gray-600 mt-4 text-sm">{{ selectedProfile.description }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProfileCardList",
  data() {
    return {
      profiles: [
        {
          image: "https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg", // Replace with actual image/base64
          name: "Samoun Suon",
          role: "Project Leader",
          description:
            "A detail-oriented leader who ensures every project meets deadlines, stays on budget, and exceeds expectations. Passionate about teamwork and innovation.",
        },
        {
          image: "https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg", // Replace with actual image/base64
          name: "Samoun Suon",
          role: "Project Leader",
          description:
            "A detail-oriented leader who ensures every project meets deadlines, stays on budget, and exceeds expectations. Passionate about teamwork and innovation.",
        },
        {
          image: "https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg", // Replace with actual image/base64
          name: "Samoun Suon",
          role: "Project Leader",
          description:
            "A detail-oriented leader who ensures every project meets deadlines, stays on budget, and exceeds expectations. Passionate about teamwork and innovation.",
        },
        {
          image: "https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg", // Replace with actual image/base64
          name: "Samoun Suon",
          role: "Project Leader",
          description:
            "A detail-oriented leader who ensures every project meets deadlines, stays on budget, and exceeds expectations. Passionate about teamwork and innovation.",
        },
        {
          image: "https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg", // Replace with actual image/base64
          name: "Samoun Suon",
          role: "Project Leader",
          description:
            "A detail-oriented leader who ensures every project meets deadlines, stays on budget, and exceeds expectations. Passionate about teamwork and innovation.",
        },
        {
          image: "https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg", // Replace with actual image/base64
          name: "Samoun Suon",
          role: "Project Leader",
          description:
            "A detail-oriented leader who ensures every project meets deadlines, ",
        },

      ],
      selectedProfile: null, 
    };
  },
  methods: {
    openModal(profile) {
      this.selectedProfile = profile;
    },
  },
};
</script>
