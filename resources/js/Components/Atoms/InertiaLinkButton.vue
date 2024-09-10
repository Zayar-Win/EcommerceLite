<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    href: {
        type:String,
        required:true
    },

    class: {
        type: String,
        default: 'text-white bg-primary hover:bg-yellow-700'
    },

    method: {
        type: String,
        default: 'get'
    },

    data: {
        type: Object
    },

    preserveState: {
        type: Boolean,
        default: false
    },

    preserveScroll: {
        type: Boolean,
        default: false
    },

    replace: {
        type: Boolean,
        default: false
    }
});

const computedClasses = computed(() => props.class);
</script>

<template>
    <Link
        as="button"
        :method="method"
        :href="href"
        :data="data"
        class="text-sm px-4 shadow-md py-3 font-semibold rounded-md transition-all active:animate-press"
        :class="computedClasses"
        :preserve-state="preserveState"
        :preserve-scroll="preserveScroll"
    >
        <slot />
    </Link>
</template>
