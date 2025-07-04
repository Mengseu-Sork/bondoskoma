<template>
  <div class="bg-white bg-gray-50">
    <!-- Banner Component -->

    <!-- Welcome Section (was Our Purpose) -->
    <section class="py-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          <div>
            <h2 class="text-4xl font-extrabold text-blue-900 mb-8">Welcome to Bandos Komar Association</h2>
            <div class="space-y-5 text-gray-700 leading-relaxed text-lg">
              <p>
                Partage has been operating programs in Cambodia since November 1989. Then it started by basic supports and it has developed progressively project focusing on education particularly in pre-schools and primary schools in rural areas and some villages surrounding target schools. There were six primary and six pre-schools in three provinces (Takeo, Kompong Speu, and Kandal) under Partage’s projects during the period of 1989 to 1999.
              </p>
              <p>
                By July 1999, Partage Cambodia had been localized as “Bandos Komar Association”, which became a local NGO in order to take over all Partage’s projects. Since 2002, BK has expanded its programs to new target provinces such as Pursat in 2002 and Siem Reap in 2008.
              </p>
            </div>
          </div>
          <div class="relative">
            <img 
              src="https://www.bandoskomar.org/wp-content/uploads/2017/10/sub-banner.jpg" 
              alt="Happy children in classroom" 
              class="rounded-3xl shadow-2xl w-full h-96 object-cover border-4 border-blue-100"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Life Skills Section -->
    <section class="py-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
          <div>
            <h2 class="text-4xl font-extrabold text-blue-900 mb-6">Life Skills</h2>
            <p class="text-xl mb-4">
              Our Life Skills program empowers children with practical abilities, confidence, and a sense of responsibility—helping them thrive in their families, communities, and future careers.
            </p>
            <ul class="list-disc pl-6 space-y-3 text-gray-700 text-lg mb-4">
              <li><span class="font-semibold text-blue-700">Practical Agriculture:</span> Children participate in our "School Gardening" project, learning to plant, nurture, and harvest crops.</li>
              <li><span class="font-semibold text-blue-700">Career Preparation:</span> Our training helps students develop essential skills for future employment.</li>
              <li><span class="font-semibold text-blue-700">Community Engagement:</span> Students and teachers work together on meaningful projects.</li>
              <li><span class="font-semibold text-blue-700">Personal Growth:</span> Children gain confidence, responsibility, and a positive attitude toward work and community life.</li>
            </ul>
            <p class="text-gray-700">
              After learning the best ways to grow vegetables, our students and teachers cultivate crops like cabbage, water chestnuts, and beans.
            </p>
          </div>
          <div class="flex flex-col gap-6">
            <img src="https://www.bandoskomar.org/wp-content/uploads/2020/01/SR-LS-scaled.jpg" alt="Life Skill 1" class="rounded-3xl shadow-xl w-full h-60 object-cover border-4 border-blue-100" />
            <img src="https://www.bandoskomar.org/wp-content/uploads/2017/10/agri-farm1-__.jpg" alt="Life Skill 2" class="rounded-3xl shadow-xl w-full h-60 object-cover border-4 border-blue-100" />
          </div>
        </div>
      </div>
    </section>

  <!-- Video Section -->
<section class="py-10 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-4xl font-extrabold text-blue-900 mb-4">Our Videos</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="relative group">
        <iframe
          class="rounded-3xl shadow-2xl w-full h-64 border-4 border-blue-100"
          src="https://www.youtube.com/embed/u-QiVv-DsRo"
          title="YouTube video player"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen
        ></iframe>
      </div>
      <div class="relative group">
        <iframe
          class="rounded-3xl shadow-2xl w-full h-64 border-4 border-blue-100"
          src="https://www.youtube.com/embed/QGs9-x9U2Q8"
          title="YouTube video player"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen
        ></iframe>
      </div>
    </div>
  </div>
</section>


    

    <!-- Google Map Embed -->
    <section>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7813.98096032579!2d104.89539253807404!3d11.52517511029406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109514b9c1a2b2d%3A0x891e079bf7d67e7e!2sBondoskomar%20Organization!5e0!3m2!1sen!2skh!4v1720072101076!5m2!1sen!2skh" width="100%" height="400" style="border:0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const instagramPosts = ref([
  { image: 'https://www.partage-rise.org/wp-content/uploads/2020/07/Children-council-Educate-using-toilet.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/Library.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/sub-banner.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/agri-farm1-__.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/Library.jpg' },
  { image: 'https://www.bandoskomar.org/wp-content/uploads/2017/10/agri-farm1-__.jpg' }
])
</script>

<style scoped>
.group:hover .group-hover\:scale-105 {
  transform: scale(1.05);
}
.group:hover .group-hover\:opacity-100 {
  opacity: 1;
}
.transition-all {
  transition: all 0.3s ease;
}
</style>
