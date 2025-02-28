<script setup>
import { computed } from 'vue';

const props = defineProps({
    src: {
        type: String,
        default:''
    // default: image
    },
    class: {
        type: String,
        default: () => ''
    },
    rounded:{
        type:Boolean,
        default:false
    }
});

const computedClasses = computed(() => props.class);
</script>

<template>
    <td class="px-6 py-4">
        <div :class="computedClasses">
            <img v-if="src" :src="src" :alt="src" class="object-cover w-[55px] h-[55px] border border-slate-300 overflow-hidden"
                 :class="{'rounded-full':rounded,'rounded-md':!rounded}"
            />
            <!-- <img v-else :src="image" :alt="src" class="w-full h-full object-cover" /> -->
        </div>
    </td>
</template>
