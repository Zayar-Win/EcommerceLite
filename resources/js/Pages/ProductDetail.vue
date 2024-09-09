<template>
    <SectionContainer>
        <div class="mt-10 flex md:flex-row flex-col xl:gap-10 gap-5">
            <div class="lg:basis-[65%] md:basis-[60%]">
                <div class="flex lg:flex-row flex-col-reverse gap-5">
                    <div class="basis-[10%] flex lg:flex-col flex-row gap-4">
                        <div class="w-full h-auto rounded-lg overflow-hidden group cursor-pointer">
                            <img class="w-full h-full group-hover:scale-[1.1] transition-all" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f697b67b9d8d605cd0fde8_more-image-1-shop-product-shopwave-template.png" />
                        </div>
                        <div class="w-full h-auto rounded-lg overflow-hidden group cursor-pointer">
                            <img class="w-full h-full group-hover:scale-[1.1] transition-all" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f697b67b9d8d605cd0fde8_more-image-1-shop-product-shopwave-template.png" />
                        </div>
                        <div class="w-full h-auto rounded-lg overflow-hidden group cursor-pointer">
                            <img class="w-full h-full group-hover:scale-[1.1] transition-all" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f697b67b9d8d605cd0fde8_more-image-1-shop-product-shopwave-template.png" />
                        </div>
                        <div class="w-full h-auto rounded-lg overflow-hidden group cursor-pointer">
                            <img class="w-full h-full group-hover:scale-[1.1] transition-all" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f697b67b9d8d605cd0fde8_more-image-1-shop-product-shopwave-template.png" />
                        </div>
                    </div>
                    <div class="basis-[90%]">
                        <div class="w-full h-auto cursor-pointer group rounded-xl overflow-hidden">
                            <img class="w-full h-full group-hover:scale-[1.1] transition-all duration-200" src="https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template.png" />
                        </div>
                    </div>
                </div>
                <div class="w-full h-[1px] bg-black/10 my-16"></div>
                <div class="border-[1px] md:hidden block border-black/10 rounded-xl py-6 px-6">
                    <div class="inline-block px-3 py-1 bg-primary rounded-full text-white font-semibold text-sm">Hot</div>
                    <h1 class="text-2xl mt-3 font-medium">Basic Gray T-Shirt</h1>
                    <p class="mt-2 text-[16px] mb-5 text-black/70 font-medium">Nisi quis eleifend quam adipiscing vitae aliquet bibendum enim facilisis gravida neque</p>
                    <p class="text-lg font-medium line-through text-black/60">$ 39.99 USD</p>
                    <div class="flex items-end mt-1 gap-2">
                        <p class="font-bold text-2xl">$ 29.99 USD</p>
                        <p class="text-primary font-semibold">%25 Off</p>
                    </div>
                    <div class="my-8 h-[1px] w-full bg-black/20"></div>
                    <p class="font-semibold text-lg">Product information</p>
                    <div class="flex flex-col gap-2 mt-3">
                        <div class="flex items-center ">
                            <p class="basis-[35%] font-semibold">Brand:</p>
                            <p class="basis-[65%] text-black/70">Fashion Co.</p>
                        </div>
                        <div class="flex items-center ">
                            <p class="basis-[35%] font-semibold">Model name:</p>
                            <p class="basis-[65%] text-black/70">Basic Gray T-Shirt</p>
                        </div>
                        <div class="flex items-center ">
                            <p class="basis-[35%] font-semibold">Color:</p>
                            <p class="basis-[65%] text-black/70">Gray</p>
                        </div>
                    </div>
                    <div class="my-8 h-[1px] w-full bg-black/20"></div>
                    <div class="flex lg:items-center lg:flex-row flex-col gap-3 mt-4 mb-2">
                        <div class="lg:basis-[40%]">
                            <p class="font-bold mb-2">Quantity</p>
                            <input class="w-full border-black/10 rounded-full py-3 pl-5" type="number" />
                        </div>
                        <div class="lg:basis-[60%] w-full">
                            <p class="font-bold mb-2">Color</p>
                            <select class="w-full border-black/10 rounded-full py-3 ">
                                <option>Red</option>
                                <option>Green</option>
                                <option>Blue</option>
                            </select>
                        </div>
                    </div>
                    <button class="w-full h-full text-white bg-primary rounded-full py-4 font-bold mt-3">Add to Cart</button>
                </div>
                <div class="md:mt-0 mt-10">
                    <h1 class="text-2xl font-semibold">Latest Products</h1>
                    <div class="grid lg:grid-cols-3 mb-10 mt-7 gap-3">
                        <ProductCard category="Fashion" name="Basis Gray Cap" :discountPrice="9.99" :normalPrice="19.99" />
                        <ProductCard category="Fashion" name="Basis Gray Cap" :discountPrice="9.99" :normalPrice="19.99" />
                        <ProductCard category="Fashion" name="Basis Gray Cap" :discountPrice="9.99" :normalPrice="19.99" />
                    </div>
                </div>
                <div class="w-full h-[1px] bg-black/10 my-16"></div>
                <div>
                    <h1 class="text-2xl font-semibold">Product information</h1>
                    <div class="mt-4">
                        <p class="text-lg text-black/50">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit lobortis arcu enim urna adipiscing praesent velit viverra sit semper lorem eu cursus vel hendrerit elementum morbi curabitur etiam nibh justo, lorem aliquet donec sed sit mi dignissim at ante massa mattis.

                            Viverra aliquet eget sit amet tellus cras. Cursus sit amet dictum sit amet. Diam donec adipiscing tristique risus nec. Diam donec adipiscing tristique risus nec feugiat in. Quisque egestas diam in arcu cursus euismod quis viverra nibh. Quis imperdiet massa tincidunt nunc.

                            Neque sodales ut etiam sit amet nisl purus non tellus orci ac auctor
                            Adipiscing elit ut aliquam purus sit amet viverra suspendisse potent purus in massa temp
                            Mauris commodo quis imperdiet massa tincidunt nunc pulvinar
                            Adipiscing elit ut aliquam purus sit amet viverra suspendisse potenti diam vel quam
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit lobortis arcu enim urna adipiscing praesent velit viverra sit semper lorem eu cursus vel hendrerit elementum morbi curabitur etiam nibh justo, lorem aliquet donec sed sit mi dignissim at ante massa mattis.
                        </p>
                    </div>
                </div>
                <div class="w-full h-[1px] bg-black/10 my-16"></div>
                <!-- <div>
                    <h1 class="text-2xl font-semibold">Product Details</h1>
                    <div class="bg-[#F7F8F9] mt-8 rounded-xl p-10">
                        <div class="flex items-center py-5  border-b-[1px] border-b-black/10">
                            <p class="basis-[35%] text-xl font-bold">Brand:</p>
                            <p class="basis-[65%] text-xl font-medium text-black/60">Fashion Co.</p>
                        </div>
                        <div class="flex items-center py-5  border-b-[1px] border-b-black/10">
                            <p class="basis-[35%] text-xl font-bold">Model Name:</p>
                            <p class="basis-[65%] text-xl font-medium text-black/60">Fashion Co.</p>
                        </div>
                        <div class="flex items-center py-5  border-b-[1px] border-b-black/10">
                            <p class="basis-[35%] text-xl font-bold">Color:</p>
                            <p class="basis-[65%] text-xl font-medium text-black/60">Fashion Co.</p>
                        </div>
                        <div class="flex items-center py-5  border-b-[1px] border-b-black/10">
                            <p class="basis-[35%] text-xl font-bold">Size:</p>
                            <p class="basis-[65%] text-xl font-medium text-black/60">Fashion Co.</p>
                        </div>
                        <div class="flex items-center py-5  border-b-[1px] border-b-black/10">
                            <p class="basis-[35%] text-xl font-bold">Package dimensions
                                :</p>
                            <p class="basis-[65%] text-xl font-medium text-black/60">Fashion Co.</p>
                        </div>
                        <div class="flex items-center py-5  border-b-[1px] border-b-black/10">
                            <p class="basis-[35%] text-xl font-bold">Item weight
                                :</p>
                            <p class="basis-[65%] text-xl font-medium text-black/60">Fashion Co.</p>
                        </div>
                    </div>
                </div> -->
                <div class="my-16">
                    <h1 class="text-2xl font-semibold">Shipping Information</h1>
                    <p class="text-lg text-black/50">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit lobortis arcu enim urna adipiscing praesent velit viverra sit semper lorem eu cursus vel hendrerit elementum morbi curabitur etiam nibh justo, lorem aliquet donec sed sit mi dignissim at ante massa mattis.

                        Viverra aliquet eget sit amet tellus cras. Cursus sit amet dictum sit amet. Diam donec adipiscing tristique risus nec. Diam donec adipiscing tristique risus nec feugiat in. Quisque egestas diam in arcu cursus euismod quis viverra nibh. Quis imperdiet massa tincidunt nunc.
                    </p>
                </div>
            </div>
            <div class="lg:basis-[35%] md:basis-[40%]">
                <div class="border-[1px] md:block hidden border-black/10 rounded-xl py-6 px-6">
                    <div class="inline-block px-3 py-1 bg-primary rounded-full text-white font-semibold text-sm">Hot</div>
                    <h1 class="text-2xl mt-3 font-medium">Basic Gray T-Shirt</h1>
                    <p class="mt-2 text-[16px] mb-5 text-black/70 font-medium">Nisi quis eleifend quam adipiscing vitae aliquet bibendum enim facilisis gravida neque</p>
                    <p class="text-lg font-medium line-through text-black/60">$ 39.99 USD</p>
                    <div class="flex items-end mt-1 gap-2">
                        <p class="font-bold text-2xl">$ 29.99 USD</p>
                        <p class="text-primary font-semibold">%25 Off</p>
                    </div>
                    <div class="my-8 h-[1px] w-full bg-black/20"></div>
                    <p class="font-semibold text-lg">Product information</p>
                    <div class="flex flex-col gap-2 mt-3">
                        <div class="flex items-center ">
                            <p class="basis-[35%] font-semibold">Brand:</p>
                            <p class="basis-[65%] text-black/70">Fashion Co.</p>
                        </div>
                        <div class="flex items-center ">
                            <p class="basis-[35%] font-semibold">Model name:</p>
                            <p class="basis-[65%] text-black/70">Basic Gray T-Shirt</p>
                        </div>
                        <div class="flex items-center ">
                            <p class="basis-[35%] font-semibold">Color:</p>
                            <p class="basis-[65%] text-black/70">Gray</p>
                        </div>
                    </div>
                    <div class="my-8 h-[1px] w-full bg-black/20"></div>
                    <div class="flex lg:items-center lg:flex-row flex-col gap-3 mt-4 mb-2">
                        <div class="lg:basis-[40%]">
                            <p class="font-bold mb-2">Quantity</p>
                            <input class="w-full border-black/10 rounded-full py-3 pl-5" type="number" />
                        </div>
                        <div class="lg:basis-[60%] w-full">
                            <p class="font-bold mb-2">Color</p>
                            <select class="w-full border-black/10 rounded-full py-3 ">
                                <option>Red</option>
                                <option>Green</option>
                                <option>Blue</option>
                            </select>
                        </div>
                    </div>
                    <button class="w-full h-full text-white bg-primary rounded-full py-4 font-bold mt-3">Add to Cart</button>
                </div>
                <div class="mt-12">
                    <h1 class="text-2xl font-medium mb-7">Related Product</h1>
                    <div class="flex flex-col gap-7">
                        <RelatedProductCard />
                        <RelatedProductCard />
                        <RelatedProductCard />
                        <RelatedProductCard />
                        <RelatedProductCard />
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full h-[1px] bg-black/10 mt-16"></div>
        <!-- <div>
            <div class="mt-24 flex items-center justify-between">
                <h1 class="text-2xl font-semibold">Latest Products</h1>
                <button  class="h-full button-shadow bg-white hover:border-primary hover:text-primary hover:-translate-y-2 transition-all duration-200  text-black rounded-full py-4 px-8 border-[1px] border-transparent">Explore Products</button>
            </div>
            <div class='grid grid-cols-4 gap-x-5 gap-y-10 mt-10 mb-24'>
                <ProductCard category="Fashion" name="Basis Gray Cap" :discountPrice="9.99" :normalPrice="19.99" />
                <ProductCard category="Fashion" name="Basis Gray Cap" :discountPrice="9.99" :normalPrice="19.99" />
                <ProductCard category="Fashion" name="Basis Gray Cap" :discountPrice="9.99" :normalPrice="19.99" />
                <ProductCard category="Fashion" name="Basis Gray Cap" :discountPrice="9.99" :normalPrice="19.99" />
            </div>
        </div> -->
    </SectionContainer>
</template>
<script>
import RelatedProductCard from '@/Components/Common/RelatedProductCard.vue';
import ProductCard from '@/Components/Common/ProductCard.vue';
import SectionContainer from '@/Components/Common/SectionContainer.vue';

export default {
    components:{
        SectionContainer,
        ProductCard,
        RelatedProductCard
    }
}
</script>
<style>
    .button-shadow{
        box-shadow: 0 4px 10px 0 rgba(20, 20, 43, .1);
    }
</style>
