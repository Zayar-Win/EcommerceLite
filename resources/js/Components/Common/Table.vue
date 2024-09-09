<script setup>
defineProps({
    items: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div>
        <table class="w-full text-sm text-left">
            <thead class="text-white bg-primary">
                <tr>
                    <slot name="table-header"></slot>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(item, index) in items"
                    :key="index"
                    :class="{
                        'border-b': index !== items.length - 1
                    }"
                    data-cy="table-data-rows"
                >
                    <slot name="table-data" :item="item" :index="index" />
                </tr>
            </tbody>
        </table>
    </div>
</template>
