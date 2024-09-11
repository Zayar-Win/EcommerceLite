<template>
    <Modal :show="isCartOpen" @close="setIsCartOpen(false)">
        <div :class="[cartItems.length ? 'pb-[220px]' : '']" class="bg-white overflow-hidden relative h-full rounded-xl">
            <div class="flex items-center justify-between border-b-[1px] border-b-black/10 px-7 py-6">
                <p class="text-lg font-bold">Your Cart</p>
                <Close @click="setIsCartOpen(false)" class="text-black cursor-pointer" />
            </div>
            <div v-if="cartItems?.length" class="overflow-y-auto   h-full">
                <div class="pt-8 px-7 h-full flex flex-col gap-10 ">
                    <div v-for="(item,index) in cartItems" :key="item?.product_detail?.id" class="flex items-start justify-between">
                        <div class="md:basis-[80%] basis-[60%] flex md:flex-row flex-col gap-3 md:items-center">
                            <div class="md:basis-[30%] w-[50%] border-[1px] border-black/30 rounded-xl overflow-hidden">
                                <img class="w-full h-full object-cover" :src="item?.product?.images[0]?.url" />
                            </div>
                            <div class="md:basis-[70%] flex flex-col ">
                                <p class="text-lg font-semibold">{{item?.product?.name}}</p>
                            <p class="text-black/60">{{Math.floor(item?.product?.product_detail?.price - (((item?.product?.product_detail?.discount ?? 0) / 100) * item?.product?.product_detail?.price))}} MMK</p>
                                <!-- <p class="text-black/60">color : Gray</p> -->
                                <p @click="deleteItemFromCart(index)" class="mt-3 text-lg cursor-pointer font-medium underline text-primary">Remove</p>
                            </div>
                        </div>
                        <div class="shrink-0 md:basis-[20%] basis-[30%]">
                            <input :value="item?.product.quantity" @input="e => updateCartItem({index,quantity : Number(e.target.value)})" type="number" class="w-full rounded-full pl-5" />
                        </div>
                    </div>
                </div>
                <div class='px-8 absolute bottom-0 border-t-[1px] border-t-black/10  bg-white left-0 w-full z-10 py-5'>
                    <div class="flex text-lg items-center justify-between">
                        <p class="text-black/60">Subtotal :</p>
                        <p class="font-bold">{{ totalPrice }} MMK</p>
                    </div>
                    <button @click="() => {
                        $inertia.get(route('checkout'))
                        setIsCartOpen(false)
                    }"  class="w-full h-full text-white bg-primary rounded-full py-4 font-bold mt-3">Continue to Checkout</button>
                </div>
            </div>
            <div v-else class="flex flex-col w-full h-[85%] items-center justify-center">
                <p class="text-lg font-bold text-black/50">No items found.</p>
                <button @click="() => {
                    setIsCartOpen(false)
                    $inertia.get(route('home'))
                }" class=" text-white bg-primary rounded-full py-4 px-7 font-bold mt-3">Start Shopping</button>
            </div>
        </div>
    </Modal>
</template>
<script>
import Close from '@/assets/icons/Close.vue';
import { mapGetters, mapMutations } from 'vuex';
import Modal from '../Modal.vue';

export default {
    components:{
        Close,
        Modal
    },
    computed : {
        ...mapGetters(['isCartOpen','cartItems']),
        totalPrice(){
             return this.cartItems.reduce((prev,curr) => {
                let itemTotalPrice = (Math.floor(curr?.product?.product_detail?.price - (((curr?.product?.product_detail?.discount ?? 0) / 100) * curr?.product?.product_detail?.price))) * curr?.product?.quantity;
                prev += itemTotalPrice;
                return prev;
            },0)
        }
    },
    methods:{
        ...mapMutations(['setIsCartOpen','updateCartItem','deleteItemFromCart'])
    },
}
</script>
<style lang="">
    
</style>