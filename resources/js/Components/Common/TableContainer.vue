<script setup>
import NoTableDataCard from './NoTableDataCard.vue';
import Pagination from './Pagination.vue';

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
    showPagination:{
        type : Boolean,
        default : true
    }
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
            v-if="paginateLinks?.length && dataCount > 0 && showPagination"
            class="flex items-center justify-center py-5"
        >
            <Pagination :links="paginateLinks" />
        </div>
        <div v-if=" dataCount == 0">
            <NoTableDataCard />
        </div>
    </div>
</template>
