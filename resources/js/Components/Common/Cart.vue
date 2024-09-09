<template>
    <Modal :show="isCartOpen" @close="setIsCartOpen(false)">
        <div class="bg-white overflow-hidden relative h-[95%] rounded-xl">
            <div class="flex items-center justify-between border-b-[1px] border-b-black/10 px-7 py-6">
                <p class="text-lg font-bold">Your Cart</p>
                <Close @click="setIsCartOpen(false)" class="text-black cursor-pointer" />
            </div>
            <div class="pt-8 pb-72 px-7 overflow-y-auto h-full flex flex-col gap-10 border-b-[1px] border-b-black/10">
                <div class="flex items-start justify-between">
                    <div class="md:basis-[80%] basis-[60%] flex md:flex-row flex-col gap-3 md:items-center">
                        <div class="md:basis-[30%] w-[50%] border-[1px] border-black/30 rounded-xl overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template.png" />
                        </div>
                        <div class="md:basis-[70%] flex flex-col ">
                            <p class="text-lg font-semibold">Basic Gray T-Shirt</p>
                            <p class="text-black/60">$ 29.99 USD</p>
                            <p class="text-black/60">color : Gray</p>
                            <p class="mt-3 text-lg font-medium underline text-primary">Remove</p>
                        </div>
                    </div>
                    <div class="shrink-0 md:basis-[20%] basis-[30%]">
                        <input type="number" class="w-full rounded-full pl-5" />
                    </div>
                </div>
                <div class="flex items-start justify-between">
                    <div class="md:basis-[80%] basis-[60%] flex md:flex-row flex-col gap-3 md:items-center">
                        <div class="md:basis-[30%] w-[50%] border-[1px] border-black/30 rounded-xl overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template.png" />
                        </div>
                        <div class="md:basis-[70%] flex flex-col ">
                            <p class="text-lg font-semibold">Basic Gray T-Shirt</p>
                            <p class="text-black/60">$ 29.99 USD</p>
                            <p class="text-black/60">color : Gray</p>
                            <p class="mt-3 text-lg font-medium underline text-primary">Remove</p>
                        </div>
                    </div>
                    <div class="shrink-0 md:basis-[20%] basis-[30%]">
                        <input type="number" class="w-full rounded-full pl-5" />
                    </div>
                </div>
                <div class="flex items-start justify-between">
                    <div class="md:basis-[80%] basis-[60%] flex md:flex-row flex-col gap-3 md:items-center">
                        <div class="md:basis-[30%] w-[50%] border-[1px] border-black/30 rounded-xl overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template.png" />
                        </div>
                        <div class="md:basis-[70%] flex flex-col ">
                            <p class="text-lg font-semibold">Basic Gray T-Shirt</p>
                            <p class="text-black/60">$ 29.99 USD</p>
                            <p class="text-black/60">color : Gray</p>
                            <p class="mt-3 text-lg font-medium underline text-primary">Remove</p>
                        </div>
                    </div>
                    <div class="shrink-0 md:basis-[20%] basis-[30%]">
                        <input type="number" class="w-full rounded-full pl-5" />
                    </div>
                </div>
                <div class="flex items-start justify-between">
                    <div class="md:basis-[80%] basis-[60%] flex md:flex-row flex-col gap-3 md:items-center">
                        <div class="md:basis-[30%] w-[50%] border-[1px] border-black/30 rounded-xl overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template.png" />
                        </div>
                        <div class="md:basis-[70%] flex flex-col ">
                            <p class="text-lg font-semibold">Basic Gray T-Shirt</p>
                            <p class="text-black/60">$ 29.99 USD</p>
                            <p class="text-black/60">color : Gray</p>
                            <p class="mt-3 text-lg font-medium underline text-primary">Remove</p>
                        </div>
                    </div>
                    <div class="shrink-0 md:basis-[20%] basis-[30%]">
                        <input type="number" class="w-full rounded-full pl-5" />
                    </div>
                </div>
                <div class="flex items-start justify-between">
                    <div class="md:basis-[80%] basis-[60%] flex md:flex-row flex-col gap-3 md:items-center">
                        <div class="md:basis-[30%] w-[50%] border-[1px] border-black/30 rounded-xl overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template.png" />
                        </div>
                        <div class="md:basis-[70%] flex flex-col ">
                            <p class="text-lg font-semibold">Basic Gray T-Shirt</p>
                            <p class="text-black/60">$ 29.99 USD</p>
                            <p class="text-black/60">color : Gray</p>
                            <p class="mt-3 text-lg font-medium underline text-primary">Remove</p>
                        </div>
                    </div>
                    <div class="shrink-0 md:basis-[20%] basis-[30%]">
                        <input type="number" class="w-full rounded-full pl-5" />
                    </div>
                </div>
                <div class="flex items-start justify-between">
                    <div class="md:basis-[80%] basis-[60%] flex md:flex-row flex-col gap-3 md:items-center">
                        <div class="md:basis-[30%] w-[50%] border-[1px] border-black/30 rounded-xl overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template.png" />
                        </div>
                        <div class="md:basis-[70%] flex flex-col ">
                            <p class="text-lg font-semibold">Basic Gray T-Shirt</p>
                            <p class="text-black/60">$ 29.99 USD</p>
                            <p class="text-black/60">color : Gray</p>
                            <p class="mt-3 text-lg font-medium underline text-primary">Remove</p>
                        </div>
                    </div>
                    <div class="shrink-0 md:basis-[20%] basis-[30%]">
                        <input type="number" class="w-full rounded-full pl-5" />
                    </div>
                </div>
                
            </div>
            <div class='px-8 absolute bottom-0 bg-white left-0 w-full z-10 mt-10 py-10'>
                <div class="flex text-lg items-center justify-between">
                    <p class="text-black/60">Subtotal :</p>
                    <p class="font-bold">$ 107.98 USD</p>
                </div>
                <button class="w-full h-full text-white bg-primary rounded-full py-4 font-bold mt-3">Continue to Checkout</button>
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
        ...mapGetters(['isCartOpen']),
    },
    methods:{
        ...mapMutations(['setIsCartOpen'])
    }
}
</script>
<style lang="">
    
</style>