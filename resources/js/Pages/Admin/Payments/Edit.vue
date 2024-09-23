<script setup>
import { Head } from '@inertiajs/vue3';
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';
import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue';
import Form from './Form.vue';

defineProps({
    payment : {
        type : Object
    }
})

</script>

<template>
    <Head title="Create Payment" />
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb icon="fa-users" label="Payments" :href="route('admin.payments.index')">
                <BreadcrumbItem label="Create" />
            </Breadcrumb>
        </div>

        <!-- Form Start -->
        <Form mode="edit" :payment="payment" />
    </div>
</template>
