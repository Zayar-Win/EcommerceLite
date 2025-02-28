<script setup>
import { ref, computed, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import SideNavItem from './SideNavItem.vue';

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
    closeOthers: {
        type: Boolean,
        default: true,
    },
});

const isOpen = ref(false);
const height = ref(0);
const dropdownContent = ref(null);

const toggleHeight = computed(() => ({ height: height.value + 'px' }));

const toggleDropdown = (e) => {
    if (props.closeOthers) hide(e);

    isOpen.value = !isOpen.value;
    height.value = height.value === 0 ? dropdownContent.value.clientHeight : 0;
};

const hide = (e) => {
    const dropdowns = document.querySelectorAll('[data-admin-dropdown-title]');

    dropdowns.forEach((dropdown) => {
        if (
            e.target.dataset.adminDropdownTitle !== dropdown.dataset.adminDropdownTitle &&
      dropdown.nextElementSibling.clientHeight > 0
        )
            dropdown.click();
    });
};

onMounted(() => {
    router.on('navigate', () => {
        const isCurrentPage = props.item.subPaths.some((link) => {
            return link.component === usePage().component;
        });

        if (!isCurrentPage) return;

        if (dropdownContent.value) height.value = dropdownContent.value.clientHeight;

        isOpen.value = true;
    });
});
</script>

<template>
    <div class="relative">
        <div
            class="flex w-full h-full justify-between font-semibold text-sm items-center link-wrapper transition duration-150 rounded-md hover:bg-primary hover:text-white focus-within:bg-gray-700 cursor-pointer pr-3"
            :data-admin-dropdown-title="item.title"
            @click="toggleDropdown"
        >
            <button
                class="w-full capitalize rounded-[5px] bg-transparent whitespace-nowrap leading-4 text-left truncate font-semibold text-sm py-[15px] px-4 select-none pointer-events-none"
            >
                <span v-if="item.icon" class="mr-1.5">
                    <i :class="['fa-solid', item.icon]"></i>
                </span>

                {{ item.title }}
            </button>

            <svg
                class="icon h-[14px] w-[14px] cursor-pointer flex-shrink-0 transition-transform duration-150 ease-linear select-none pointer-events-none"
                :class="{ 'rotate-180': isOpen }"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        <div
            class="overflow-hidden mt-1 transition-[height] duration-[.4s] ease"
            :style="toggleHeight"
        >
            <!-- <div ref="dropdownContent" class="nav rounded-md bg-yellow-800 p-2"> -->
            <div ref="dropdownContent" class="nav rounded-md p-2">

                <SideNavItem v-for="subItem in item.subPaths" :key="subItem" :item="subItem"
                             :class="$page.url === subItem.path ? 'text-white bg-primary hover:bg-primary' : ''"
                />
            </div>
        </div>
    </div>
</template>
