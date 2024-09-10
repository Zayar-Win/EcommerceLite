<script setup>
import { ref,computed } from 'vue';
import {usePage} from '@inertiajs/vue3';
import { useClickOutside } from '@/Composables/useClickOutside';

const emit=defineEmits(['open']);

const dropdownOpen = ref(false);
const dropdownButton = ref(null);

const user=computed(()=>usePage().props.auth?.user);

const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
    emit('open',dropdownOpen.value);
};

useClickOutside(dropdownButton, () => {
    dropdownOpen.value = false;
});
</script>

<template>
    <div class="relative inline-block text-left">
        <button type="button" @click="toggleDropdown" ref="dropdownButton">
            <slot name="dropdown-button" />
        </button>
        <div
            class="shadow-1 absolute right-0 z-50 mt-3 w-full rounded-md bg-white  border py-[10px] transition-all duration-200 px-2"
            :class="{
                'top-full opacity-100 visible': dropdownOpen,
                'top-[110%] invisible opacity-0': !dropdownOpen,
                'min-w-[240px]':user?.current_plans?.some(plan => plan.name === 'Personal'),
                'min-w-[210px]':!user?.current_plans?.some(plan => plan.name === 'Personal')
            }"
        >
            <slot name="dropdown-items" />
        </div>
    </div>
</template>
