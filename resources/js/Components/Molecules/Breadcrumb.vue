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
        default: 'fa-home'
    },

    data: {
        type: Object
    }
});
</script>

<template>
    <nav
        class="flex mb-5 md:mb-0 overflow-x-auto w-full md:max-w-[1000px] px-0"
        aria-label="Breadcrumb"
    >
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <Link
                    :href="href"
                    :data="data"
                    class="inline-flex items-center text-sm font-bold text-darkGray hover:text-primary cursor-pointer"
                >
                    <span class="mr-2.5">
                        <i class="fa-solid" :class="icon"></i>
                    </span>
                    {{ label }}
                </Link>
            </li>
            <slot />
        </ol>
    </nav>
</template>
