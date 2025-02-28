<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type:String,
        required:true
    },

    label: {
        type: String,
        required: true
    },

    icon: {
        type: String,
        default: ''
    },

    data: {
        type: Object,
        default: () => ({})
    }
});
</script>

<template>
    <li>
        <div class="flex items-center">
            <i class="fa-solid fa-angle-right text-darkGray"></i>
            <Link
                :href="href"
                :data="data"
                class="ml-1 inline-flex items-center text-sm font-bold text-darkGray hover:text-primary cursor-pointer md:ml-2"
            >
                <span v-if="icon" class="mr-2.5">
                    <i class="fa-solid" :class="icon"></i>
                </span>
                {{ label }}
            </Link>
        </div>
    </li>
</template>
