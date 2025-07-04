<template>
  <div>
    <Navbar />
    <Banner />
    <!-- Main routed content -->
    <router-view />
    <Footer />
  </div>
</template>

<script setup>
import Banner from './components/Banner.vue';
import Footer from './components/Footer.vue';
import Navbar from './components/Navbar.vue'
</script>
