<template>
    <div class="bg-secondary xl:px-32 sm:px-5 px-2 grid gap-y-10 xl:grid-cols-5 gap-4 md:grid-cols-3 py-20 text-white">
        <div>
            <h1 class="text-lg font-bold">Menu</h1>
            <ul class="mt-6 gap-2 font-semibold flex flex-col">
                <li>
                    <Link href="/">Home</Link>
                </li>
                <li v-for="category in categories" :key="category.id">
                    <Link :href="route('home',{category : category.name})">{{category.name}}</Link>
                </li>
            </ul>
        </div>
        <div class="col-span-2">
            <h1 class="text-lg font-bold">Popular Products</h1>
            <div class="mt-6 grid md:grid-cols-2 gap-4">
                <Link v-for="product in popularProducts" :key="product.id" :href="route('product-detail',{product : product?.slug})">
                    <div  class="flex gap-4 items-center">
                        <div class="w-[80px] h-[80px] shrink-0 rounded-md overflow-hidden">
                            <img class="w-full h-full object-cover" :src="product?.images[0].url" />
                        </div>
                        <div>
                            <h1 class="font-bold">{{product?.name}}</h1>
                            <p v-if="product?.price" class=" text-sm text-primary font-semibold">{{Math.floor(product?.price - (((product?.discount ?? 0) / 100) * product?.price))}} MMK</p>
                        </div>
                    </div>
                </Link>
            </div>
        </div>
        <div class="xl:col-span-2 md:col-span-3">
            <div class="bg-[#383E52] flex flex-col items-center p-10 rounded-xl">
                <h1 class="text-lg font-extrabold mb-2">Get 10% OFF of your first purchase
                </h1>
                <div class="xl:w-full md:w-[50%] w-full h-[55px] bg-white rounded-full">
                    <input class="w-full h-full text-black text-sm pl-6 bg-transparent border-none outline-none focus:ring-0 " placeholder="Enter your email address" />
                </div>
                <button class="xl:w-full md:w-[50%] w-full h-full bg-primary rounded-full py-4 font-bold mt-3">Subscribe</button>
            </div>
        </div>
    </div>
</template>
<script>
import { Link, usePage } from '@inertiajs/vue3';

export default {
    components:{
        Link
    },
    data(){
        return {
            popularProducts : usePage().props?.popularProducts,
            categories : usePage().props.categories
        }
    }
}
</script>
<style lang="">
    
</style>