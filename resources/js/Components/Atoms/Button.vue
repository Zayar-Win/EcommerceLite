<template>
    <Link
        v-if="type === 'link'"
        :href="href"
        :class="[
            outline
                ? 'text-primary border-2 border-primary'
                : 'bg-primary text-white',
        ]"
        class="px-8 py-4 font-bold rounded-lg inline-block text-center"
    >
        
        {{ text }}
    </Link>
    <button v-else
            :class="[
                outline
                    ? 'text-primary border-2 border-primary'
                    : 'bg-primary text-white',
            ]" class="px-8 py-4 font-bold rounded-lg">
       
        {{ text }}

    </button>
</template>
<script>
import { Link } from '@inertiajs/vue3';
export default {
    components: { Link },
    props: {
        type: {
            type: String,
            default: 'link',
        },
        outline: {
            type: Boolean,
            default: false,
        },
        text: {
            type: String,
        },
        href: {
            type: String,
        }
    },
};
</script>
<style></style>
