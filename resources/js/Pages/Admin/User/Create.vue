<script setup>
import { Head } from '@inertiajs/vue3';
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';
import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue';
import Form from './Components/Form.vue';

defineProps({
    roles: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Create User" />
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb icon="fa-users" label="Users" :href="route('admin.users.index')">
                <BreadcrumbItem label="Create" />
            </Breadcrumb>
        </div>

        <!-- Form Start -->
        <Form mode="create" :roles="roles" />
    </div>
</template>
