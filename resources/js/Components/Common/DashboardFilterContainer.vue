<script setup>
import { ref } from 'vue';
import { onClickOutside } from '@vueuse/core';
import { router, usePage } from '@inertiajs/vue3';

defineProps({
    activeFiltersCount: {
        type: Number,
        required: false,
    },
});

const dropdownOpen = ref(false);
const dropDownBoxRef = ref(null);
const sort = ref(usePage().props.ziggy.query?.sort);
const direction = ref(usePage().props.ziggy.query?.direction);

const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
};

onClickOutside(dropDownBoxRef, (event) => {
    if (dropdownOpen.value && !event.target.closest('button')) {
        dropdownOpen.value = false;
    }

});

const resetFilters = () => {
    const currentLocationPath = window.location.pathname;
    router.visit(currentLocationPath, { sort: sort.value, direction: direction.value });
};
</script>

<template>
    <div class="absolute right-5 top-8 z-30 space-y-3 flex flex-col items-end justify-end">
        <div class="relative">
            <button
                @click="toggleDropdown"
                class="text-sm border px-5 py-3 rounded-md ml-5 font-semibold border-gray-300 bg-gray-50 hover:bg-gray-100 text-gray-700"
                :class="{'border-yellow-500 text-primary':dropdownOpen}"
            >
                <i class="fa-solid fa-filter"></i>
                <span class="hidden md:inline-block ml-1">Filters</span>
            </button>
            <div
                v-if="activeFiltersCount > 0"
                class="absolute -top-1 -right-1 size-4 flex items-center justify-center rounded-full bg-primary font-semibold text-white text-xs"
            >
                {{ activeFiltersCount }}
            </div>
        </div>

        <div ref="dropDownBoxRef">
            <div
                v-if="dropdownOpen"
                class="relative w-[350px] sm:w-[390px] border border-gray-300 shadow-lg bg-white px-5 py-4 rounded-md space-y-4"
            >
                <slot />
                <div class="w-full flex items-center">
                    <button
                        @click="resetFilters"
                        class="text-xs font-semibold px-3 ml-auto py-2 text-white bg-red-600 rounded-[4px] disabled:opacity-80 disabled:hover:bg-red-600 disabled:cursor-not-allowed hover:bg-red-700 transition-all"
                        :disabled="activeFiltersCount < 1"
                    >
                        Reset Filters
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
