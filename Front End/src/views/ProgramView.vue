<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-6 py-10 bg-gray-50 min-h-screen">
    <Card
      v-for="(program, idx) in programs"
      :key="idx"
      :title="program.title"
      :goal="program.goal"
      :justification="program.justification"
      :image="program.image"
      class="flex flex-col h-full"
    />
  </div>
  <footer class="bg-gray-900 text-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <!-- Our Projects -->
          <div>
            <h3 class="text-lg font-semibold mb-4 text-blue-400">OUR PROJECTS</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Our Story</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Our Team</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Annual Report</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Careers</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Awards We've Won</a></li>
            </ul>
          </div>

          <!-- Ways to Help -->
          <div>
            <h3 class="text-lg font-semibold mb-4 text-blue-400">WAYS TO HELP</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Donate</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Volunteer</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Fundraise</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Corporate Partnerships</a></li>
            </ul>
          </div>

          <!-- Actions -->
          <div>
            <h3 class="text-lg font-semibold mb-4 text-blue-400">ACTIONS</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Contact</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Privacy Policy</a></li>
              <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Terms</a></li>
            </ul>
          </div>

          <!-- Newsletter Signup -->
          <div>
            <h3 class="text-lg font-semibold mb-4 text-blue-400">Subscribe for Speech News and Other Updates</h3>
            <div class="space-y-4">
              <input 
                type="email" 
                placeholder="Enter your email"
                class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
              />
              <button class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                Subscribe
              </button>
            </div>
            
            <!-- Social Media Icons -->
            <div class="flex space-x-4 mt-6">
              <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>
</template>

<script setup>
import Card from '../components/CardProgram.vue'

const programs = [
  {
    title: 'COUNTRY GOAL of Bandos Komar',
    goal:
      'By 2019, children and youths enjoy the full potential of their rights and live with dignity, becoming empowered individuals who contribute meaningfully to sustainable social and the nation.',
    justification: [
      'To enable children and youths to exercise their rights with dignity, it is essential to provide them with quality and equitable education so that they become agent of change of their society and they deal with confidence with emerging challenges in their lives after the school.',
      'In other words, Bandos Komar is engaged to nurture and build up human capital to tackle changes that will impact on human’s livelihoods.',
    ],
    image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyEa-i-q-ni2CFVcG89ltLTBMcB-h8zi9Ahg&s',
  },
  {
    title: 'Integrated Early Child Care and Development Programme',
    goal:
      'By 2019, children aged below six years old, living in the target areas have full potential and opportunity to carry on their study in primary education level with equity, quality and effectiveness.',
    justification: [
      'All statistical data and empirical data collected by NGOs involved in preschools development and MoEYS, visits to parents, educators, members of committees, and staff of primary schools describe the tremendous positive impact that community preschools have on cognitive, social and motor development of enrolled children aged 3 to 5.',
      'Therefore since 2005, it became clear to IOs, NGOs and MoEYS that the scale-up of community preschools are an effective alternative for the development of young children in Cambodia and probably elsewhere.',
      'Benefits of community preschools identified by parents and local authorities are numerous, ranging from self-confidence, sensitization and practice of basic hygiene, nutrition improvement, to good preparation to socialization in the primary school.',
      'Often perceived as non-formal education for rural children, community preschools actually offer in most remote places unprecedented opportunities for young children to enjoy equitable rights to education.',
    ],
    image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrx0iNsmyejyqzo9Vvm4ji60oizWSDnf6mDQ&s',
  },
  {
    title: 'Integrated Quality Primary Education Programme',
    goal:
      'By 2019, children and youths living in the target areas acquire knowledge, skills, confidence, sense of entrepreneurship and perseverance in the national and regional context.',
    justification: [
      'In the context of recent regional economic integration of Cambodia, challenges ahead for youths are huge in terms of employment and economic opportunities.',
      'School remains an avoidable instrument of skills provision and sense of entrepreneurship strengthening to turn challenges into opportunities.',
      'By strengthening education quality, adapting life skills to market needs and developing confidence to children and youths, Bandos Komar ambitions to prepare them to harsh competition and highly selective labor market.',
      'Five key strategies will back up this programme such as:',
      'Strengthening capacity of local partners including awareness raising on respect and enforcement of child rights, enhancing quality of parents education, increasing pedagogical skills of teachers and supplying teaching materials, sensitizing the commune council on impact of community preschools for ECCD.',
      'Improving nutrition of early children inspired from UNICEF and World Food Program models combining preschool and home-based parent education.',
      'Upgrading water, sanitation and hygiene infrastructure and education at preschools and homes.',
      'Improving community’s health through hygiene education, health center access, prevention like hand washing, de-worming, growth tracking.',
      'Partnerships with stakeholders and networks at national and sub-national levels such as MEDICAM, NEP, child rights platform, Plan International, UNICEF.',
      'Strengthening and scaling-up Child Friendly Schools including promotion, leadership capacity, child protection awareness, nutrition improvements.',
      'Improving reproductive health knowledge through curriculum, posters, books, and teaching materials.',
      'Promoting life skills and entrepreneurship in school and community.',
      'Mainstreaming resilience and natural disaster/climate change education with supporting materials.',
      'Continuing partnerships with relevant stakeholders to sharpen action and update good practices.',
    ],
    image: 'https://www.unicef.org/cambodia/sites/unicef.org.cambodia/files/styles/media_banner/public/2019-04/children-in-cambodia-1.jpg.webp?itok=lDq1PIS_',
  },
]
</script>

<style scoped>
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
</style>
