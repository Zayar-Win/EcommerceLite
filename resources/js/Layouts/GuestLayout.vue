<script setup>
import Navbar from '@/Components/Common/Navbar.vue';
import Footer from '@/Components/Common/Footer.vue';
import Cart from '@/Components/Common/Cart.vue';
import FlashMessage from '@/Components/Common/FlashMessage.vue';
import ConfirmationDialog from '@/Components/Molecules/ConfirmationDialog.vue';
</script>

<template>
    <FlashMessage />
    <Cart />
    <Navbar />
    <slot />
    <Footer />
    <ConfirmationDialog />
</template>
