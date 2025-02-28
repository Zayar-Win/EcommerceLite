<script setup>
import {computed} from 'vue';

const props=defineProps({
    class: {
        type: String,
        default:'bg-blue-100 text-blue-800',
    },
    primary:{
        type:Boolean,
        required:true
    },
    success:{
        type:Boolean,
        required:true
    },
    info:{
        type:Boolean,
        required:true
    },
    warning:{
        type:Boolean,
        required:true
    },
    error:{
        type:Boolean,
        required:true
    },
    archived:{
        type:Boolean,
        required:true
    },
});


const computedClasses = computed(() => {
    if (props.primary) {
        return 'bg-primary bg-opacity-10 text-yellow-600 border border-primary border-opacity-40';
    }
    if (props.success) {
        return 'bg-green-100 text-green-800';
    }
    if (props.info) {
        return 'bg-blue-100 text-blue-800';
    }
    if (props.warning) {
        return 'bg-yellow-100 text-yellow-800';
    }
    if (props.error) {
        return 'bg-red-100 text-red-800';
    }
    if (props.archived) {
        return 'bg-slate-100 text-slate-800';
    }
    return '';
});
</script>

<template>
    <span
        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 text-[13px] rounded-full capitalize font-semibold"
        :class="[computedClasses, props.class]"
    >
        <slot />
    </span>
</template>
