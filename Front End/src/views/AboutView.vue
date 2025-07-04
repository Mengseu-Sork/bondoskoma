<template>
  <div class="font-sans bg-white text-gray-800">
    <!-- HERO SECTION -->
    <section class="bg-white-300 py-24 relative text-center">
      <div class="px-4 max-w-4xl mx-auto">
        <h1 class="text-5xl md:text-6xl font-extrabold mb-6">About Us</h1>
        <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
          Learn how we empower communities and build brighter futures for children and youth.
        </p>
      </div>
      <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-4 px-4 max-w-6xl mx-auto">
        <img v-for="n in 4" :key="n" :src="`random/400x300?sig=${n}`" class="rounded-xl object-cover h-48 w-full shadow-lg" />
      </div>
    </section>

    <!-- VALUE PROPOSITION SECTION -->
    <section class="py-20 px-4 max-w-6xl mx-auto text-center">
      <h2 class="text-3xl md:text-4xl font-bold mb-6">Delivering Ideas That Matter</h2>
      <p class="max-w-3xl mx-auto text-gray-600 text-lg leading-relaxed">
        We ensure that every concept we deliver is impactful, sustainable, and community-driven. Our collaborative approach fuels innovation, growth, and meaningful change.
      </p>
    </section>

    <!-- MISSION VISION SECTION -->
    <section class="px-4 max-w-6xl mx-auto py-20 grid md:grid-cols-2 gap-12 items-center">
      <div>
        <img src="https://source.unsplash.com/random/500x400?sig=88" alt="Mission Visual" class="rounded-xl shadow-xl" />
        <div class="mt-4 bg-white p-4 rounded-lg shadow text-center">
          <p class="text-sm italic">"Creating lasting change together"</p>
          <p class="font-semibold text-sm text-gray-500">Founder of Bandos Komar</p>
        </div>
      </div>
      <div>
        <h3 class="text-2xl font-bold mb-4">Our Mission & Vision</h3>
        <p class="text-gray-600 text-lg mb-6">
          Empowering the next generation by fostering education, leadership, and opportunity. Our vision is a Cambodia where every child thrives.
        </p>
        <blockquote class="bg-yellow-100 border-l-4 border-yellow-500 p-4 text-gray-700 italic rounded-md">
          "Children and youth should grow in dignity, reaching their full potential as contributors to society."
        </blockquote>
      </div>
    </section>

    <!-- WHY US SECTION -->
    <section class="py-20 px-4 bg-gray-100">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold">Why Choose Bandos Komar?</h2>
        <p class="max-w-xl mx-auto text-gray-600 mt-4">
          With decades of impact, we are trusted by communities, partners, and governments to deliver education and empowerment initiatives.
        </p>
      </div>
      <div class="grid sm:grid-cols-3 gap-8 max-w-6xl mx-auto text-left">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
          <div class="text-yellow-500 text-4xl mb-4">👩‍🏫</div>
          <h4 class="font-bold text-lg mb-2">Experienced Team</h4>
          <p class="text-gray-600 text-sm">We bring local insight and international standards together to serve better.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
          <div class="text-yellow-500 text-4xl mb-4">🎯</div>
          <h4 class="font-bold text-lg mb-2">Targeted Strategies</h4>
          <p class="text-gray-600 text-sm">Our projects are data-driven, goal-focused, and tailored to community needs.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
          <div class="text-yellow-500 text-4xl mb-4">💡</div>
          <h4 class="font-bold text-lg mb-2">Innovative Solutions</h4>
          <p class="text-gray-600 text-sm">We empower with creativity, collaboration, and scalable ideas.</p>
        </div>
      </div>
    </section>
  </div>
</template>
