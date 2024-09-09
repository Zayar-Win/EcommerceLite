<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    item: Object,
});
</script>

<template>
    <div
        class=" w-full rounded-[4px] transition-all duration-150 mb-3"
        :class="[
            $page.url.startsWith(item.url) ? 'text-white bg-primary': 'hover:bg-primary',
        ]"
    >
        <Link
            :href="item.path"
            class="relative flex items-center gap-2.5 rounded-sm py-3 px-4 font-semibold text-sm duration-300 ease-in-out"
        >
            <span v-if="item.icon">
                <i :class="['fa-solid', item.icon]"></i>
            </span>

            {{ item.title }}
        </Link>
    </div>
</template>
