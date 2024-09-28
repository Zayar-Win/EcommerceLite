<script setup>
import { Head } from '@inertiajs/vue3';
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';
import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue';
import Form from './Components/Form.vue';

defineProps({
    productDetail: {
        type: Object,
        required: true,
    },
    sizes: {
        type: Object,
        required: true,
    },
});
// console.log(category);
</script>

<template>
    <Head title="Edit User" />
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb icon="fa-users" label="Users" :href="route('admin.products.index')">
                <BreadcrumbItem label="Edit" />
            </Breadcrumb>
        </div>

        <!-- Form Start -->
        <Form mode="edit"  :productDetail="productDetail" :sizes="sizes" />
    </div>
</template>
