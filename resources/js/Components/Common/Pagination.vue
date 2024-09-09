<script setup>
import { Link } from '@inertiajs/vue3';

const props =defineProps({
    links: Object,
});
</script>

<template>
    <div class="flex items-center justify-center">
        <div v-if="props.links.length > 3">
            <div class="flex flex-wrap -mb-1">
                <template v-for="(link, p) in props.links" :key="p">
                    <div
                        v-if="link.url === null"
                        class="mr-[2px] mb-1 px-2 py-1 text-sm leading-1 sm:mr-1 sm:mb-1 sm:px-4 sm:py-3 sm:leading-4 text-darkGray border disabled:opacity-50 disabled:pointer-events-none border-gray-300 font-small rounded-lg"
                        v-html="link.label"
                    />

                    <div v-else class="flex items-center">
                        <Link
                            class="mr-[2px] mb-1 px-2 py-1 text-sm leading-1 sm:mr-1 sm:mb-1 sm:px-4 sm:py-3 sm:leading-4 border rounded-lg disabled:opacity-50 disabled:pointer-events-none font-small hover:border-primary focus:border-primary focus:text-primary"
                            :class="{
                                'bg-primary text-white border-primary': link.active,
                                'hover:text-primary border-gray-300': !link.active,
                            }"
                            :href="link.url"
                        >
                            <span v-html="link.label"></span>
                        </Link>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>
<!-- mr-1 mb-1 px-4 py-3 -->
