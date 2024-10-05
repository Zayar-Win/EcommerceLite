<script setup>
import { Link,router,usePage } from '@inertiajs/vue3';
import SideNavItem from './SideNavItem.vue';
import { useStore } from 'vuex';
import { computed,ref } from 'vue';
import { onClickOutside } from '@vueuse/core';
import { emitter } from '@/Helpers/emitter';
import getSideNavLinks from '@/Data/sidenav-links';
import SubSideNavItemDropdown from './SubSideNavItemDropdown.vue';
const target=ref(null);
const sidenavLinks = getSideNavLinks();
const store = useStore();

const isSideNavOpen = computed(() => store.state.isSideNavOpen);

// onClickOutside(target, () => {
//     store.commit('toggleSideNav',false);
// });
const handleLogout=()=>{
    emitter.emit('open-confirmation-dialog', {
        title:'Account Logout',
        body:'Are you sure you would like to do this ?',
        confirmLabel: 'Yes, Do it',
        cancelLabel: 'No, I don\'t',
        confirmBtnClass:'!bg-primary',
        svgIcon: 'question',
        allowClickOutside:true,
        onConfirm: () => {
            router.post(route('logout'),{},{
                onFinish:()=>{
                    emitter.emit('close-confirmation-dialog');
                }
            });
        },
    });
};

// const isAuthorized=(allowedRoles)=> {
//     const userRole = usePage().props.auth?.user?.role?.slug;

//     return allowedRoles?.includes(userRole);
// };
</script>

<template>
    <aside
        ref="target"
        class="absolute left-0 top-0 z-[9999] flex h-screen w-[270px] flex-col overflow-y-hidden text-white bg-secondary duration-300 ease-linear lg:static transition-all lg:translate-x-0"
        :class="{
            'translate-x-0': isSideNavOpen,
            '-translate-x-full': !isSideNavOpen,
        }"
    >
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between gap-2 py-5.5 lg:py-6.5">
            <!-- Logo -->
            <Link :href="route('home')" class="block w-full">
                <div
                    class="py-[1rem] border-b border-b-gray-300 px-6 w-full flex items-center space-x-3"
                >
                    <img
                        src="/Logo.png"
                        alt="logo"
                        class="w-[80px]"
                    />
                    <h3 class="font-bold text-md text-center">P & P Market</h3>
                </div>
            </Link>
        </div>
        <!-- Sidebar Header -->

        <div class=" flex flex-col overflow-y-auto scroll duration-300 ease-linear">
            <div class="py-4 px-3">
                <div class="my-3.5 mx-4">
                    <h1 class="font-bold text-xs uppercase text-gray-200">
                        Dashboard Administration
                    </h1>
                </div>
                <!-- Sidebar Menu -->
                <nav class="">
                    <div class="flex flex-col h-auto overflow-y-auto scroll pb-12">
                        <div v-for="(item, index) in sidenavLinks" :key="index" class="">
                            <SideNavItem v-if="!item.subPaths" :item="item" />
                            <SubSideNavItemDropdown v-else-if="item.subPaths" :item="item" />
                        </div>
                    </div>
                    <!-- logout -->
                </nav>
            </div>

        </div>
        <div
            class="w-full px-3 font-roboto transition-all  duration-150  absolute left-0 bottom-2 bg-secondary"
        >
            <a
                class="font-bold text-md rounded-[4px] flex h-[48px] items-center cursor-pointer mb-1
                            pl-3 bg-[#BE1700]"
                @click="handleLogout"
            >
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    class="mr-1"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M13.75 3.66757H4.58331V16.5009C4.58331 16.9871 4.77647 17.4535 5.12028 17.7973C5.4641 18.1411 5.93042 18.3342 6.41665 18.3342H13.75M14.6666 13.7509L17.4166 11.0009M17.4166 11.0009L14.6666 8.25091M17.4166 11.0009H8.24998"
                        stroke="#FDFDFD"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                Logout
            </a>
        </div>
    </aside>
</template>
<style>
.scroll::-webkit-scrollbar{
    display: none;
}
</style>
