<script setup>
defineProps({
    params: {
        type: Object,
        required: true
    },
    sort: {
        type: String,
        default: 'desc'
    },
    direction: {
        type: String,
        default: 'desc'
    }
});
</script>

<template>
    <div class="inline-block">
        <span
            v-if="sort === params?.sort || direction === params.direction"
            class="flex flex-col items-center justify-center relative"
        >
            <svg :class="{
                    'text-primary': params?.direction === 'asc' && params?.sort === sort,
                    'visually-hidden':
                        params?.direction !== '' && params?.direction !== 'asc' && params?.sort === sort
                }" class="text-[.7rem] cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m7 14l5-5l5 5z"/></svg>
                 <svg
                 :class="{
                    'text-primary': params?.direction === 'desc' && params?.sort === sort,
                    'visually-hidden':
                        params?.direction !== '' && params?.direction !== 'desc' && params?.sort === sort
                }"
                 class="fa-solid fa-sort-down text-[.7rem] cursor-pointer absolute"
                 xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m12 15l-5-5h10z"/></svg>
            
        </span>
        <span v-else>
            <i
                class="fa-solid fa-sort text-[.7rem] text-white hover:text-primary cursor-pointer"
            ></i>
        </span>
    </div>
</template>
