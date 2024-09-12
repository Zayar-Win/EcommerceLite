<script setup>
import { Head } from '@inertiajs/vue3';
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';
import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue';
import Form from './Components/Form.vue';

defineProps({
    user: {
        type: Object,
        required: true,
    },
    roles: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <Head title="Edit User" />
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb icon="fa-users" label="Users" :href="route('admin.users.index')">
                <BreadcrumbItem label="Edit" />
            </Breadcrumb>
        </div>

        <!-- Form Start -->
        <Form mode="edit" :user="user" :roles="roles" />
    </div>
</template>
