<template>
    <div class="flex gap-x-4 items-center">
        <div class="relative">
            <transition name="profile">
                <div
                    :key="toggle"
                    class="w-[80px] h-[80px] md:w-[100px] md:h-[100px] relative"
                >
                    <template v-if="!currentUser?.avatar&&!previewUrl">
                        <div>
                            <Avatar :unique-name="currentUser?.name" large/>
                        </div>
                    </template>
                    <template v-if="previewUrl">
                        <img
                            ref="previewImg"
                            class="w-full h-full rounded-full object-cover"
                            :src="previewUrl"
                        />
                    </template>
                </div>
            </transition>
        </div>
        <div class="flex gap-4 items-center">
            <input
                ref="profileInput"
                type="file"
                hidden
                accept="image/png, image/jpg, image/jpeg"
                @change="uploadProfile"
            />
            <button
                @click="isReferalModalOpen = true"
                v-if="hasUserActiveSubscription"
                class="px-8 py-3 font-bold rounded-lg bg-primary text-white">
                Membership Reward
            </button>
            
            <ReferalModal :open="isReferalModalOpen" @closeModal="isReferalModalOpen = false" />

        </div>
    </div>
</template>

<script>
import Avatar from '@/Components/Atoms/Avatar.vue';
import ReferalModal from '@/Components/Common/ReferalModal.vue';
import { router, usePage } from '@inertiajs/vue3';
// import FormButton from '@/Components/Atoms/FormButton.vue';

// import Camera from '@/Components/Icons/Camera.vue';
export default {
    components: {
        Avatar,
        ReferalModal
        // FormButton
        // Camera
    },
    props: {
        modelValue: {
            type: [File, String],
            default: null,

        },
    },
    data() {
        return {
            toggle: false,
            profileToggle: false,
            previewUrl: this.$page.props.auth?.user?.avatar,
            isReferalModalOpen  :false
        };
    },
    computed: {
        currentPlans() {
            return this.$page.props.auth?.user?.current_plans;
        },
        currentUser() {
            return this.$page.props.auth?.user;
        },
        hasUserActiveSubscription(){
            let user = usePage().props.auth.user;
            let hasUserActiveSubscription =false;
            let subscriptionKeys =Object.keys(user.subscribed);
            subscriptionKeys.forEach(key => {
                if(!hasUserActiveSubscription){
                    let periodKeys = Object.keys(user.subscribed[key]);
                    periodKeys.forEach(period => {
                        if(user.subscribed[key][period].subscribed){
                            hasUserActiveSubscription = true;
                            return;
                        }
                    });
                }
            });
            return hasUserActiveSubscription;
        }
        
    },
    methods: {
        uploadProfile(event) {
            const file = event.target.files[0];
            if (!file) return;

            this.previewUrl = null;
            const reader = new FileReader();
            reader.addEventListener('load', () => {
                this.previewUrl = reader.result;
            });
            reader.readAsDataURL(file);
            this.toggle = !this.toggle;

            this.$emit('update:modelValue', file);

            event.target.value = '';
        },
        clickHandler(){
            let hasUserActiveSubscription =this.hasUserActiveSubscription;
            if(!hasUserActiveSubscription){
                return router.visit(route('settings.subscriptions'));
            }else{
                this.isModalOpen = true;
            }

        },
    }
};
</script>

<style scoped>
.profile-enter-active,
.profile-leave-active {
  transition: all 300ms ease;
}

.profile-enter-from,
.profile-leave-to {
  position: absolute;
  top: 0;
  opacity: 0;
  transform: translateY(5%);
}
</style>
