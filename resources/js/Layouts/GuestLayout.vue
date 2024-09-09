<script setup>
import Navbar from '@/Components/Common/Navbar.vue';
import Footer from '@/Components/Common/Footer.vue';
import Cart from '@/Components/Common/Cart.vue';
</script>

<template>
    <Cart />
    <Navbar />
    <slot />
    <Footer />
</template>
