<script setup>
import { Head } from '@inertiajs/vue3';
import Tabs from '../Components/Tabs.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
</script>

<template>
    <Head :title="`${$page.props.auth.user?.name}'s Settings`" />
    <GuestLayout>
        <div class="flex flex-col items-start p-5 md:p-10 min-h-screen font-roboto mt-6 mb-24 max-w-[1500px] mx-auto">
            <div
                class="bg-white border w-full border-gray-200 shadow-sm rounded-md rounded-t-none flex items-start justify-between"
            >
                <div class="hidden md:block md:w-3/12 shrink-0">
                    <Tabs />
                </div>

                <div class="md:w-9/12 w-full h-full md:border-l border-gray-200 min-h-[350px]">
                    <div
                        class="tab-container flex-1 px-6 py-10 overflow-x-auto"
                    >
                        <transition name="tab-animation" mode="out-in">
                            <slot/>
                        
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script>

export default {
};
</script>


<style scoped>
.tab-wrapper {
  box-shadow: 0px -10px 20px 5px rgba(136, 136, 136, 0.16);
}

.tab-animation-enter-active,
.tab-animation-leave-active {
  transition: all 350ms ease;
}

.tab-animation-enter-from,
.tab-animation-leave-to {
  opacity: 0;
  transform: translateX(2%);
}

@media (max-width: 1380px) {
  .setting::after {
    border-radius: 0 0 75px 75px !important;
  }
}

@media (max-width: 820px) {
  .setting::after {
    border-radius: 0 0 60px 60px !important;
  }
}

@media (max-width: 600px) {
  .tab-wrapper {
    margin-top: -14rem;
  }

  .setting :deep(h4) {
    margin-top: 1rem !important;
  }

  .setting::after {
    min-height: 160px !important;
    border-radius: 0 0 30px 30px !important;
  }
}
</style>
