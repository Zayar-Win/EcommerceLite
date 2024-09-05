<template lang="">
    <div class="rounded-lg cursor-pointer hover:translate-y-[-10px] transition-all duration-200 group shadow-md hover:shadow-lg overflow-hidden">
        <div class="w-full overflow-hidden">
            <img :src="image" class="w-full h-full group-hover:scale-[1.1] transition-all duration-200" />
        </div>
        <div class="py-4 px-6">
            <p class="text-sm text-primary">{{category}}</p>
            <h1 class="mt-2 text-lg font-bold group-hover:text-primary transition-all duration-200">{{name}}</h1>
            <div class="flex items-center font-semibold gap-2">
                <p class="text-black/60">$ {{discountPrice}} USD</p>
                <p class="text-black/40 line-through">$ {{normalPrice}} USD</p>
            </div>
        </div>  
    </div>
</template>
<script>
export default {
    props : {
        category : {
            type : String
        },
        name : {
            type : String
        },
        normalPrice : {
            type : Number
        },
        discountPrice : {
            type : Number
        },
        image : {
            type : String,
            default : "https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a67c4666f047ada3ba87_image-10-shop-product-shopwave-template-p-500.png"
        }
    }
}
</script>
<style lang="">
    
</style>