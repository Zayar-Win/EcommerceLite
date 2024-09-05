<script setup>
import Navbar from '@/Components/Common/Navbar.vue';
import Footer from '@/Components/Common/Footer.vue';
</script>

<template>
    <Navbar />
    <slot />
    <Footer />
</template>
