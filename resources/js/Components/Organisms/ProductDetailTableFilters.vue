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
    sizes: usePage().props.ziggy.query?.sizes,
});

let props = defineProps({
    sizes: {
        type:Object,
        default: null,
    },
    id:{
        type:Number,
        default: null,
    }
});

const sizesOptions = [];
console.log("this is size"+props.sizes)
const hasOwnProperty = Object.prototype.hasOwnProperty;
for (let key in props.sizes.sizes) {
    if (hasOwnProperty.call(props.sizes.sizes, key)) {
        sizesOptions.push({
            label: props.sizes.sizes[key],
            value: props.sizes.sizes[key]
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
            route('admin.product-details.index',{id:props.id}),
            {
                ...usePage().props.ziggy?.query,
                size: filterOptions.sizes,
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
            <Label label="Size" />

            <SelectBox
                :selected="filterOptions.sizes"
                v-model="filterOptions.sizes"
                :options="sizesOptions"
            />
        </div>
    </DashboardFilterContainer>
</template>
