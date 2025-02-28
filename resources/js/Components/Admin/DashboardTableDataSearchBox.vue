<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },

    placeholder: {
        type: String,
        default: 'Search by name',
    },
});

const search = ref(usePage().props.ziggy.query?.search);

const delayedSearch = ref(null);

const handleSearch = () => {
    if (delayedSearch.value) {
        clearTimeout(delayedSearch.value);
    }
    delayedSearch.value = setTimeout(() => {
        router.get(props.href,
            {
                ...usePage().props.ziggy.query,
                page: 1,
                search: search.value,
            },
            {
                replace: true,
                preserveState: true,
            }
        );
    }, 500);
};

watch(
    () => search.value,
    () => {
        handleSearch();
    }
);
</script>

<template>
    <div class="min-w-[250px] sm:max-w-[400px] w-full">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                <svg
                    class="w-4 h-4 text-gray-500"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 20 20"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                    />
                </svg>
            </div>

            <button
                v-show="search"
                @click="search = undefined"
                type="button"
                class="absolute inset-y-0 right-0 flex items-center pr-5 hover:cursor-pointer text-gray-500 hover:text-red-600 transition-all"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>
            <input
                v-model="search"
                id="default-search"
                type="text"
                class="block w-full p-3.5 pl-10 text-[14px] text-darkGray rounded-md bg-gray-50 transition-all focus:outline-none focus:ring-2 focus:ring-gray-300 border border-gray-300 focus:border-gray-400 font-semibold"
                :placeholder="placeholder"
                required
            />
        </div>
    </div>
</template>
