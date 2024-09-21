<script setup>
import { computed } from 'vue';
import {Link,router} from '@inertiajs/vue3';
import { emitter } from '@/Helpers/emitter';


//Handle OMISE OLD USERS
const tabs =computed(()=>[
    {'label':'Profile Details','href':route('settings.profile-details'),'component':'Private/Settings/ProfileDetails','cypress_selector':'profile-details-tab',show:true},
    {'label':'Orders','href':route('settings.orders'),'component':'Private/Settings/Orders','cypress_selector':'orders',show:true},
    {'label':'Change Password','href':route('settings.change-password'),'component':'Private/Settings/ChangePassword','cypress_selector':'change-password-tab',show:true},
])
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
</script>

<template>
    <div class="w-full  py-4 hidden md:block">
        <ul>
            <li v-for="(tab, index) in tabs" :key="index">
                <Link
                    v-if="tab.show"
                    as="button"
                    class="block relative w-full transition-all text-left text-md py-4 px-6 font-semibold cursor-pointer"
                    :class="{'text-white bg-primary':$page.component===tab.component,'text-darkGray  transition-color  hover:bg-[rgba(0,0,0,0.1)]':$page.component!==tab.component}"
                    :href="tab.href"
                >
                    {{ tab.label }}
                </Link>
            </li>
            <hr />
            <li class="px-6">
                <button
                    data-cy="logout-tab"
                    type="button"
                    @click="handleLogout"
                    class="block w-full text-left text-red-500 text-md py-4 font-semibold cursor-pointer"
                >
                    Logout
                </button>
            </li>
        </ul>
    </div>
</template>
