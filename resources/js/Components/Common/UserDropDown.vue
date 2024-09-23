<script setup>
import { ref,computed } from 'vue';
import { router,usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Molecules/Dropdown.vue';
import DropdownItem from '@/Components/Atoms/DropdownItem.vue';
import User from '@/Components/Icons/User.vue';
import Lock from '@/Components/Icons/Lock.vue';
import Avatar from '@/Components/Atoms/Avatar.vue';
import { emitter } from '@/Helpers/emitter';
import {useStore} from 'vuex';
import Order from '@/Components/Icons/Order.vue';
import Admin from '../Icons/Admin.vue';

const user=ref(usePage().props.auth?.user);
const store=useStore();

const dropDownOpen = ref(false);

const dropdownItems = computed(() => {
    const items = [
        {
            text: 'Profile Details',
            href: route('settings.profile-details'),
            icon: User,
        },
        {
            text : 'Orders',
            href : route('settings.orders'),
            icon : Order
        },
        {
            text: 'Change Password',
            href: route('settings.change-password'),
            icon: Lock,
        },
    ];


    if (user.value?.role?.slug === 'admin') {
        items.unshift({
            text: 'Admin Dashboard',
            href: route('admin.dashboard'),
            icon: Admin,
        });
    }
    return items;
});

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
                    store.commit('clearCartItems');
                }
            });
        },
    });
};
</script>

<template>
    <Dropdown @open="dropDownOpen = !dropDownOpen">
        <template #dropdown-button>
            <!-- Avatar and Headline -->
            <div class="flex items-center gap-4">
                <div v-if="$page.url.startsWith('/admin')" class="hidden text-right lg:block">
                    <span class="block text-sm font-bold text-darkGray">{{ user?.name }}</span>
                    <span class="block text-xs font-medium text-gray-600 capitalize">{{user?.role?.slug==='super_admin' ? "Super Admin": user?.role?.name}}</span>
                </div>

                <div v-if="!user?.avatar">
                    <Avatar :unique-name="user?.name"/>
                </div>

                <div v-else class="h-10 w-10 rounded-full overflow-hidden">
                    <img
                        :src="user?.avatar"
                        alt="avatar"
                        class="w-full h-full object-cover"
                    />
                </div>

                <svg
                    class="hidden fill-current sm:block"
                    :class="dropDownOpen && 'rotate-180'"
                    width="12"
                    height="8"
                    viewBox="0 0 12 8"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"
                        fill=""
                    />
                </svg>
            </div>
        </template>

        <template #dropdown-items>
            <template v-for="(item,index) in dropdownItems" :key="index">
                <DropdownItem :href="item.href">
                    <span class="mr-1">
                        <component class="w-[18px] inline-block" :is="item.icon" />
                    </span>
                    {{ item.text }}
                </DropdownItem>
            </template>

            <hr class="my-2" />

            <button
                @click="handleLogout"
                type="button"
                class="block py-2 px-5 w-full text-sm text-left cursor-pointer font-semibold text-red-600 hover:bg-gray-100 rounded-md transition-all"
            >
                Logout
            </button>
        </template>
    </Dropdown>
</template>
