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


