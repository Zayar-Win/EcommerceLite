<template>
    <div
        class="bg-white shadow-md hover:shadow-xl transition-all cursor-pointer py-8 px-10 border-[1px] rounded-xl"
    >
        <h1 class="text-3xl font-semibold">{{ title }}</h1>
        <p class="mt-8" v-if="description">
            {{ description }}
        </p>
        <slot />
        <Button
            v-if="buttonText"
            :text="buttonText"
            :outline="true"
            class="mt-4"
            :href="route('home')"
            type="link"
        />
    </div>
</template>
<script>
import Button from './Button.vue';
export default {
    components: {
        Button,
    },
    props: {
        title: {
            type: String,
        },
        description: {
            type: String,
        },
        buttonText: {
            type: String,
        },
    },
};
</script>
<style></style>
