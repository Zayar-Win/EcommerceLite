<script setup lang="ts">
defineProps({
    forHtml:{
        type:String,
        required:false
    },
    label:{
        type:String,
        required:true
    },
    required:{
        type:Boolean,
        default:false
    }
});
</script>

<template>
    <label
        :for="forHtml"
        class="text-left block w-full mb-2.5 text-sm font-semibold text-darkGray"
    >
        {{ label }}

        <span v-if="required" class="text-darkRed">*</span>
    </label>
</template>
