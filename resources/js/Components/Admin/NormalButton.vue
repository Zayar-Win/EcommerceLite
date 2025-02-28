<script setup>
import { computed } from 'vue';

const props = defineProps({
    class: {
        type: String,
        default: 'text-white bg-thaiFlagRed hover:bg-darkRed'
    },

    type: {
        type: String,
        default: 'button'
    }
});

const computedClasses = computed(() => props.class);
</script>

<template>
    <button
        :type="type"
        class="text-sm px-4 shadow-md py-3 font-semibold rounded-md  disabled:opacity-80 disabled:cursor-not-allowed duration-150 active:animate-press"
        :class="computedClasses"
    >
        <slot />
    </button>
</template>
