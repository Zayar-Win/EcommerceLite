<script setup>
import DashboardFilterContainer from '@/Components/Common/DashboardFilterContainer.vue';
import Label from '@/Components/Atoms/Label.vue';
import SelectBox from '@/Components/Atoms/SelectBox.vue';
import { reactive, watch, ref, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useQueryParams } from '@/Composables/useQueryParams';

const delayedSearch = ref(null);
const activeFiltersCount = ref(0);
const filterOptions = reactive({
    categories: usePage().props.ziggy.query?.categories,
});

let props = defineProps({
    categories: Object,
    default: null,
});

const categoryOptions = [];
const hasOwnProperty = Object.prototype.hasOwnProperty;
for (let key in props.categories.categories) {
    if (hasOwnProperty.call(props.categories.categories, key)) {
        categoryOptions.push({
            label: props.categories.categories[key],
            value: props.categories.categories[key]
        });
    }
}

const { getActiveFilterQueryCount } = useQueryParams();

const getFilteredUsers = () => {
    if (delayedSearch.value) {
        clearTimeout(delayedSearch.value);
    }
    delayedSearch.value = setTimeout(() => {
        router.get(
            route('admin.products.index'),
            {
                ...usePage().props.ziggy?.query,
                category: filterOptions.categories,
            },
            {
                replace: true,
                preserveState: true,
                onSuccess: () => {
                    activeFiltersCount.value = getActiveFilterQueryCount();
                },
            }
        );
    }, 0);
};

watch(filterOptions, () => getFilteredUsers());

onMounted(() => (activeFiltersCount.value = getActiveFilterQueryCount()));


</script>

<template>
    <DashboardFilterContainer :activeFiltersCount="activeFiltersCount">

        <div>
            <Label label="Category" />

            <SelectBox
                :selected="filterOptions.categories"
                v-model="filterOptions.categories"
                :options="categoryOptions"
            />
        </div>
    </DashboardFilterContainer>
</template>
