<script setup>
import SortingArrow from '@/Components/Atoms/SortingArrows.vue';
import { useSorting } from '@/Composables/useSorting';

const props = defineProps({
    label: {
        type: String,
        required: true,
    },
    sort: {
        type: String,
        default: 'desc',
    },
    url: {
        type: String,
        required: true,
    },
});

const { params, updateSorting } = useSorting(props.url);
</script>

<template>
    <th scope="col" class="px-6 py-3" @click="updateSorting(props.sort)">
        {{ label }}
        <SortingArrow :params="params" :sort="sort" />
    </th>
</template>
