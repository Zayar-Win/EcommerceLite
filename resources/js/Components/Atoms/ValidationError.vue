<script setup>

defineProps({
    message:{
        type:String,
        default:'',
        required:false
    }
});
</script>

<template>
    <p data-cy="validation-message" v-if="message" class="text-xs font-semibold mt-3 w-full text-left text-red-600">
        {{ message }}
    </p>
</template>
