<template>
    <div class="overflow-hidden whitespace-nowrap relative ">
        <h1 class="text-2xl w-fit uppercase py-4 ml-24 mb-4 border-b border-gray-400">
        Our Partner
        </h1>
        <div class="h-64 bg-yellow-400 flex items-center overflow-hidden w-full">
            <div class="inline-flex animate-marquee gap-6 min-w-[200%]">
            <div 
                v-for="(partner, index) in duplicatedPartners"
                :key="`partner-${index}`"
                class="flex-shrink-0"
            >
                <PartnerCard :partner="partner" />
            </div>
            </div>
        </div>
    </div>
    <div class="mt-6 container max-w-7xl mx-auto">
        <h1 class="text-2xl w-fit uppercase py-4 ml-8 mb-4 border-b border-gray-400">
        Our Visitors
        </h1>
        <div class="p-6">
        <FlagCounter :visitors="visitorData" />
        </div>
    </div>
</template>

<script setup>
import PartnerCard from '@/components/PartnerCard.vue'
import FlagCounter from '@/components/FlagCounter.vue'
import { computed } from 'vue'

const partners = [
  {
    image: "https://www.partage.org/wp-content/uploads/2023/01/Logo-Partage-50-ans-PNG1.png",
    link: "https://www.partage.org/"
  },
  {
    image: "https://www.bandoskomar.org/wp-content/uploads/2017/10/Le-Don-Du-Choeur.png",
    link: "https://don-du-choeur.ch/"
  },
  {
    image: "https://www.ccc-cambodia.org/backend/web/uploads/membership-application-form/16026483865f867942102e79.24058363.png",
    link: "https://www.wvi.org/"
  },
  {
    image: "https://www.ccc-cambodia.org/backend/web/uploads/ngo_logo/16444741836204af47cc91b3.44484496.jpeg",
    link: "https://plan-international.org/cambodia/"
  }
]

const duplicatedPartners = computed(() => [...partners, ...partners])

const visitorData = [
  { code: 'KH', country: 'Cambodia', count: 5108, flag: 'https://flagcdn.com/w40/kh.png', link: 'https://s05.flagcounter.com/more/fq5U/' },
  { code: 'US', country: 'United States', count: 2824, flag: 'https://flagcdn.com/w40/us.png', link: 'https://s05.flagcounter.com/more/fq5U/' },
  { code: 'FR', country: 'France', count: 495, flag: 'https://flagcdn.com/w40/fr.png', link: 'https://s05.flagcounter.com/more/fq5U/' },
  { code: 'SG', country: 'Singapore', count: 415, flag: 'https://flagcdn.com/w40/sg.png', link: 'https://s05.flagcounter.com/more/fq5U/' },
  { code: 'CN', country: 'China', count: 410, flag: 'https://flagcdn.com/w40/cn.png', link: 'https://s05.flagcounter.com/more/fq5U/' },
  { code: 'CA', country: 'Canada', count: 169, flag: 'https://flagcdn.com/w40/ca.png', link: 'https://s05.flagcounter.com/more/fq5U/' },
  { code: 'DE', country: 'Germany', count: 112, flag: 'https://flagcdn.com/w40/de.png', link: 'https://s05.flagcounter.com/more/fq5U/' },
  { code: 'GB', country: 'United Kingdom', count: 85, flag: 'https://flagcdn.com/w40/gb.png', link: 'https://s05.flagcounter.com/more/fq5U/' },
  { code: 'JP', country: 'Japan', count: 81, flag: 'https://flagcdn.com/w40/jp.png', link: 'https://s05.flagcounter.com/more/fq5U/' },
  { code: 'AU', country: 'Australia', count: 69, flag: 'https://flagcdn.com/w40/au.png', link: 'https://s05.flagcounter.com/more/fq5U/' },
  { code: 'NL', country: 'Netherlands', count: 54, flag: 'https://flagcdn.com/w40/nl.png', link: 'https://s05.flagcounter.com/more/fq5U/' },
  { code: 'BR', country: 'Brazil', count: 49, flag: 'https://flagcdn.com/w40/br.png', link: 'https://s05.flagcounter.com/more/fq5U/' },
]
</script>

<style scoped>
@keyframes marquee {
  0% {
    transform: translateX(0%);
  }
  100% {
    transform: translateX(-50%);
  }
}

.animate-marquee {
  animation: marquee 30s linear infinite;
}
</style>