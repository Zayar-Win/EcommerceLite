<script setup>
import Pagination from '@/Components/Common/Pagination.vue';
import NoTableDataCard from '@/Components/Atoms/NoTableDataCard.vue';

defineProps({
    dataCount: {
        type: Number,
        default: 0,
        required: true,
    },
    paginateLinks: {
        type: Array,
        default:()=> [],
    },
});
</script>

<template>
    <div>
        <div
            class="relative flex flex-col min-w-0 break-words w-full mb-6 rounded-md overflow-hidden border"
        >
            <slot name="table" />
        </div>

        <!-- Pagination -->
        <div
            v-if="paginateLinks?.length && dataCount > 0"
            class="flex items-center justify-center py-5"
        >
            <Pagination :links="paginateLinks" />
        </div>
        <div v-else>
            <NoTableDataCard />
        </div>
    </div>
</template>
