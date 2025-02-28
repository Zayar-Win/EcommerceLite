<script setup>
import { computed } from 'vue';

const props = defineProps({
    class: {
        type: String,
        default: () => 'min-w-[50px]'
    }
});

const computedClasses = computed(() => props.class);
</script>
<template>
    <td class="px-6 py-4">
        <span class="text-darkGray p-1.5 font-semibold block" :class="computedClasses">
            <slot />
        </span>
    </td>
</template>
