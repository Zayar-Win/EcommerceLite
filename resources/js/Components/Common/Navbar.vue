<template lang="">
    <div class="flex items-center justify-between px-32 bg-secondary">
        <div>
            <img src="/Logo.png" class="w-[150px] object-cover h-[12
            0px]" />
        </div>
        <div class="flex items-center px-2 py-2 bg-white grow rounded-full max-w-[550px] h-[56px]">
            <input placeholder="Search..." class="bg-transparent text-sm w-full h-full border-none outline-none focus:ring-0" />
            <div class="w-[44px] h-[44px] shrink-0 bg-primary rounded-full flex items-center justify-center text-white">
                <Search class="w-[25px]" />
            </div>
        </div>
        <div class="flex items-center text-white">
            <div class="flex items-center">
                <p class="w-[25px] rounded-full flex text-sm items-center justify-center h-[25px] bg-primary" >0</p>
                <Bag class="w-[50px] h-[80px]" />
            </div>
            <p>Your Cart</p>
        </div>
    </div>
</template>
<script>
import Bag from '@/assets/icons/Bag.vue';
import Search from '@/assets/icons/Search.vue';

export default {
    components:{
        Search,
        Bag
    }
}
</script>
<style lang="">
    
</style>