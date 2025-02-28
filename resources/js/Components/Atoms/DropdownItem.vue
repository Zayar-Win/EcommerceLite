<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
    data:{
        type:Object,
        required:false,
        default:()=>{}
    }
});
</script>

<template>
    <Link as="button" :href="href" :data="data" class="cursor-pointer block py-2 px-5 text-sm w-full text-left font-semibold text-darkGray hover:bg-gray-100 rounded-md transition-all">
        <slot />
    </Link>
</template>
