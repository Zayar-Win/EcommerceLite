<script setup>
import { computed } from 'vue';

const props = defineProps({
    class: {
        type: String,
        default: 'text-white bg-primary hover:bg-blue-900',
    },

    processing: {
        type: Boolean,
        default: false,
    },
    type : {
        type : String,
        default : 'submit'
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    loadingText : {
        type : String,
        default : 'Processing...'
    }
});


const computedClasses = computed(() => props.class);
</script>

<template>
    <button
        :type="type"
        class="text-sm px-4 shadow-md py-3 font-semibold rounded-md duration-150 active:animate-press disabled:opacity-80 disabled:cursor-not-allowed"
        :class="computedClasses"
        :disabled="disabled"
    >
        <div v-if="processing" class="flex items-center justify-center">
            <div
                class="animate-spin inline-block w-5 h-5 border-[3px] border-current border-t-transparent text-white rounded-full mr-2"
            ></div>
            <span>{{loadingText}}</span>
        </div>
        <div v-else>
            <slot />
        </div>
    </button>
</template>
