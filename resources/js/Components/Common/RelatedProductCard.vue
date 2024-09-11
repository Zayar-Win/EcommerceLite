<template>
    <div class="flex items-center gap-5 group cursor-pointer">
        <div class="basis-[30%] h-auto rounded-xl overflow-hidden">
            <img class="w-full h-full group-hover:scale-[1.1] transition-all duration-200 object-cover" :src="product?.images[0].url" />
        </div>
        <div class="basis-[70%]">
            <p class="text-lg group-hover:text-primary transition-all duration-200 font-semibold ">{{product?.name}}</p>
            <div class="flex items-center gap-2">
                <p class="font-bold">{{Math.floor(product?.price - (((product?.discount ?? 100) / 100) * product?.price))}} MMK</p>
                <p v-if="product?.discount && product?.discount > 0" class="font-medium line-through text-black/60">{{ product?.price ?? '1000' }} MMK</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
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