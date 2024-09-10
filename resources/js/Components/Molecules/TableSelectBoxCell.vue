<template>
    <select name="status"  v-model="selectedStatus" @change="handleStatusChange" class="block w-full p-2.5 rounded-md font-semibold text-sm text-darkGray bg-gray-50 outline-none disabled:cursor-not-allowed transition-all focus:ring-2 focus:ring-slate-300 border border-gray-300 focus:border-slate-400">
        <option v-for="option in options" :key="option.value" :value="option.value" >
            {{ option.label }}
        </option>
    </select>
</template>

<script setup>
import { ref,watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { createToaster } from '@meforma/vue-toaster';
const toast = createToaster();
const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    options: {
        type: Array,
        required: true,
    },
    currentStatus: {
        type: String,
        required: true,
    },
});
const selectedStatus = ref(props.currentStatus);

watch(() => props.currentStatus, (newStatus) => {
    selectedStatus.value = newStatus;
}, { immediate: true });

const handleStatusChange = () => {
    submitForm(selectedStatus.value);
};
const submitForm = (status) => {
    router.put(props.href, { status },{
        onSuccess:()=>{
            toast.success('Ticket updated successfully.');
        }
    });
};
</script>
