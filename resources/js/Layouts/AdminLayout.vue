<script setup>

import SideNav from '@/Components/Admin/SideNav.vue';

</script>

<template>
    <div class="flex h-screen overflow-hidden font-roboto">
        <SideNav />
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- <HeaderNav /> -->
            <main>
                <div
                    class="mx-auto max-w-screen-2xl"
                    :class="{
                        'p-4 md:p-6 2xl:p-10 bg-gray-50': $page.component !== 'Admin/Dashboard',
                    }"
                >
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>