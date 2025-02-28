<template>
    <Link :href="route('product-detail',{product : product.slug})">
        <div class="flex items-center gap-5 group cursor-pointer">
            <div class="basis-[30%] h-auto rounded-xl overflow-hidden">
                <img class="w-full h-full group-hover:scale-[1.1] transition-all duration-200 object-cover" :src="product?.images[0].url" />
            </div>
            <div class="basis-[70%]">
                <p class="text-lg group-hover:text-primary transition-all duration-200 font-semibold ">{{product?.name}}</p>
                <div class="flex items-center gap-2">
                    <p  class="font-semibold text-primary text-black/60">{{ product?.product_details[0]?.price ?? 'No price' }} MMK</p>
                </div>
            </div>
        </div>
    </Link>
</template>
<script>
import { Link } from '@inertiajs/vue3';

export default {
    components:{
        Link
    },
    props : {
        product : {
            type : Object,
        }
    },
    mounted(){
        console.log(this.product)
    }
}
</script>
<style lang="">
    
</style>