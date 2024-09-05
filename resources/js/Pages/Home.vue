<template lang="">
    <SectionContainer>
        <div class="bg-[#F7F8F9]  py-24 my-10 rounded-xl flex flex-col items-center justify-center">
            <h1 class="text-3xl font-bold">Shop</h1>
            <p class="w-[50%] text-center mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
        </div>
        <div class="flex top-0 mb-[100px]">
            <div class="w-[25%] sticky self-start top-16">
                <div class="flex items-center pl-2 rounded-full bg-white border-[1px] h-[50px]">
                    <Search class="text-black/50" />
                    <input type="text" class="w-full p-0 border-none bg-transparent outline-none focus:ring-0" placeholder="Search for products" />
                </div>
                <div>
                    <p class="text mt-8 mb-3 font-bold">Product By Category</p>
                    <div>
                        <div v-for="(category,i) in categories" :key="category.categroy" class="flex items-center cursor-pointer gap-2 py-3 px-2  border-t-[1px] border-t-black/10" 
                        :class="[i == categories.length -1 ? 'border-b-[1px] border-b-black/10' : '']"
                        >
                            <component :is="category.icon" class='w-[20px] h-[20px] text-primary' />
                            <p class="text-sm hover:text-primary transition-all">{{category.category}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-[75%] pl-[8%]">
                <div class="grid grid-cols-4 mb-14 gap-x-5 gap-y-10">
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <div class="w-full h-auto group rounded-xl overflow-hidden">
                            <img class="w-full group-hover:scale-[1.1] transition-all duration-200 h-full" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template-p-500.png" />
                        </div>
                        <p class="mt-3 font-semibold">Basic Gray T-Shirt</p>
                        <div class="flex gap-2 text-sm items-center font-medium mt-1">
                            <p class="text-primary">$29.99 USD</p>
                            <p class='line-through'>$49.99 USD</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </SectionContainer>

</template>
<script>
import Cloth from '@/assets/icons/Cloth.vue';
import Cosmetic from '@/assets/icons/Cosmetic.vue';
import Electronic from '@/assets/icons/Electronic.vue';
import Hammer from '@/assets/icons/Hammer.vue';
import Pot from '@/assets/icons/Pot.vue';
import Search from '@/assets/icons/Search.vue';
import Footer from '@/Components/Common/Footer.vue';
import Navbar from '@/Components/Common/Navbar.vue';
import SectionContainer from '@/Components/Common/SectionContainer.vue';

export default {
    components:{
        Navbar,
        Footer,
        SectionContainer,
        Search
    },
    data(){
        return {
            categories : [
                {
                    icon : Cloth,
                    category :  'Clothes'
                },
                {
                    icon : Cosmetic,
                    category :  'Cosmetic'
                },
                {
                    icon : Electronic,
                    category :  'Electronic'
                },
                {
                    icon : Pot,
                    category :  'Food'
                },
                {
                    icon : Hammer,
                    category : "Home Accessories"
                }
            ]
        }
    }
}
</script>
<style lang="">
    
</style>