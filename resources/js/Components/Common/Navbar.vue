<template lang="">
    <div class="flex items-center justify-between xl:px-32 sm:px-5 px-2 bg-secondary">
        <Link :href="route('home')">
            <img src="/Logo.png" class="md:w-[150px] w-[100px] h-[80px] object-cover md:h-[12
            0px]" />
        </Link>
        <div class="md:flex hidden items-center px-2 py-2 bg-white grow rounded-full lg:max-w-[550px] max-w-[350px] h-[56px]">
            <input placeholder="Search..." class="bg-transparent text-sm w-full h-full border-none outline-none focus:ring-0" />
            <div class="w-[44px] h-[44px] shrink-0 bg-primary rounded-full flex items-center justify-center text-white">
                <Search class="w-[25px]" />
            </div>
        </div>
        <div @click="setIsCartOpen(true)" class="flex items-center text-white">
            <div class="flex items-center">
                <p class="w-[25px] rounded-full flex text-sm items-center justify-center h-[25px] bg-primary" >0</p>
                <Bag class="md:w-[50px] w-[30px] h-[50px] md:h-[80px]" />
            </div>
            <p>Your Cart</p>
        </div>
    </div>
</template>
<script>
import Bag from '@/assets/icons/Bag.vue';
import Search from '@/assets/icons/Search.vue';
import { Link } from '@inertiajs/vue3';
import { mapMutations } from 'vuex';

export default {
    components:{
        Search,
        Bag,
        Link
    },
    methods:{
        ...mapMutations(['setIsCartOpen'])
    }
}
</script>
<style lang="">
    
</style>