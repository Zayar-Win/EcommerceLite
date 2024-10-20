<template>
    <ImageSliderModal :open="open" @close="open = false" :images="images" />
    <SectionContainer>
        <div class="mt-10 flex md:flex-row flex-col xl:gap-10 gap-5">
            <div class="lg:basis-[65%] md:basis-[60%] overflow-hidden">
                <div class="flex lg:flex-row flex-col-reverse gap-5">
                    <div class="basis-[10%] flex lg:flex-col flex-row gap-4">
                        <div @click="open = true" v-for="image in images" :key="image" class="w-full h-auto rounded-lg overflow-hidden group cursor-pointer">
                            <img class="w-full h-full group-hover:scale-[1.1] transition-all" :src="image" />
                        </div>
                    </div>
                    <div @click="open = true" class="basis-[90%]">
                        <div class="w-full h-auto cursor-pointer group rounded-xl overflow-hidden">
                            <img class="w-full h-full group-hover:scale-[1.1] transition-all duration-200" :src="images[0]" />
                        </div>
                    </div>
                </div>
                <div class="w-full h-[1px] bg-black/10 my-16"></div>
                <div class="border-[1px] md:hidden block border-black/10 rounded-xl py-6 px-6">
                    <div class="inline-block px-3 py-1 bg-primary rounded-full text-white font-semibold text-sm">Hot</div>
                    <h1 class="text-2xl mt-3 font-medium">{{product?.name}}</h1>
                    <a href="#description" class="mt-2 text-[16px] mb-5 line-clamp-3 text-black/70 font-medium">{{ product?.description }}</a>
                    <p  v-if="productDetail?.discount && productDetail?.discount > 0"class="text-lg font-medium line-through text-black/60">{{ productDetail?.price + ' MMK' ?? 'Out of Stock' }} </p>
                    <div class="flex items-end mt-1 gap-2">
                        <p v-if="productDetail?.price" class="font-bold text-2xl">{{Math.floor(productDetail?.price - (((productDetail?.discount ?? 0) / 100) * productDetail?.price))}} MMK</p>
                        <p v-else class="font-bold text-2xl">No product Yet</p>
                        <p v-if="productDetail?.discount && Number(productDetail?.discount) > 0" class="text-primary font-semibold">%{{ $formatNumber(productDetail?.discount) }} Off</p>
                    </div>
                    <div class="my-8 h-[1px] w-full bg-black/20"></div>
                    <p class="font-semibold text-lg">Product information</p>
                    <div class="flex flex-col gap-2 mt-3">
                        <div class="flex items-center ">
                            <p class="basis-[35%] font-semibold">Category:</p>
                            <p class="basis-[65%] text-black/70">{{product?.category?.name}}</p>
                        </div>
                        <div class="flex items-center ">
                            <p class="basis-[35%] font-semibold">Stock:</p>
                            <p :class="[totalStock ? '' : 'text-red-500']" class="basis-[65%] text-black/70">{{ totalStock > 0 ? totalStock : 'Out of stock' }}</p>
                        </div>
                        <div class="flex items-end cursor-pointer" :key="optionKey" v-for="optionKey in Object.keys(product?.groupAttributeOptions)">
                            <p class="basis-[35%] shrink-0 capitalize font-semibold">{{optionKey}}:</p>
                            <div class="flex items-center flex-wrap gap-2 w-full">
                                <p v-for="option in  product?.groupAttributeOptions[optionKey]"
                                :class="[
                                    params[optionKey] === option.value ? 'bg-primary text-white border-transparent' : ''
                                ]"
                                @click="handleGetProductDetail(optionKey,option.value)"
                                :key="option.value" class="shrink-0 border-[1px] border-black/30 rounded-full px-4 py-1 text-black/70">{{ option.value }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="my-8 h-[1px] w-full bg-black/20"></div>
                    <div class="flex lg:items-center lg:flex-row flex-col gap-3 mt-4 mb-2">
                        <div class="lg:basis-[40%]">
                            <p class="font-bold mb-2">Quantity</p>
                            <input :disabled="!totalStock" v-model="quantity" class="w-full border-black/10 rounded-full py-3 pl-5" :max="totalStock" type="number" />
                        </div>
                        <div v-if="isClothCategory" class="lg:basis-[60%] w-full">
                            <p class="font-bold mb-2">Size</p>
                            <select v-model="selectedSize" class="w-full border-black/10 rounded-full py-3 ">
                                <option v-for="size in sizes" :value="size" :key="size">{{size}}</option>
                            </select>
                        </div>
                    </div>
                    <button @click="handleAddItemToCart" :disabled="!totalStock" class="w-full h-full disabled:opacity-45 disabled:cursor-not-allowed text-white bg-primary rounded-full py-4 font-bold mt-3">Add to Cart</button>
                </div>
                <div class="md:mt-0 mt-10">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-semibold">Latest Products</h1>
                        <Link :href="route('home')" class="text-sm text-primary underline">View all</Link>
                    </div>
                        <div class="w-full mt-5">
                            <swiper
                                :slidesPerView="3"
                                :spaceBetween="10"
                                class="mySwiper"
                                :autoplay="{
                                    delay:1500,
                                    disableOnInteraction: false,
                                }"
                                :modules="[Autoplay]"
                                style="padding:30px 0px"
                            >
                                <swiper-slide
                                v-for="product in latestProducts"
                                :key="product.id"
                                >
                                    <ProductCard :product="product" />
                                </swiper-slide>
                            </swiper>
                        </div>
                    <!-- <div class="grid lg:grid-cols-3 mb-10 mt-7 gap-3">
                        <ProductCard v-for="product in latestProducts" :product="product" :key="product?.id"/>
                    </div> -->
                </div>
                <div class="w-full h-[1px] bg-black/10 my-16"></div>
                <div>
                    <h1 class="text-2xl font-semibold">Product information</h1>
                    <div class="mt-4" id="description">
                        <p class="text-lg text-black/50">
                        {{ product?.description }}
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
                    <h1 class="text-2xl font-semibold">Shipping Information Updated</h1>
                    <p class="text-lg text-black/50">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit lobortis arcu enim urna adipiscing praesent velit viverra sit semper lorem eu cursus vel hendrerit elementum morbi curabitur etiam nibh justo, lorem aliquet donec sed sit mi dignissim at ante massa mattis.
                        Viverra aliquet eget sit amet tellus cras. Cursus sit amet dictum sit amet. Diam donec adipiscing tristique risus nec. Diam donec adipiscing tristique risus nec feugiat in. Quisque egestas diam in arcu cursus euismod quis viverra nibh. Quis imperdiet massa tincidunt nunc.
                    </p>
                </div>
            </div>
            <div class="lg:basis-[35%] md:basis-[40%]">
                <div class="border-[1px] md:block hidden border-black/10 rounded-xl py-6 px-6">
                    <div class="inline-block px-3 py-1 bg-primary rounded-full text-white font-semibold text-sm">Hot</div>
                    <h1 class="text-2xl mt-3 font-medium">{{product?.name}} </h1>
                    <a href="#description" class="mt-2 text-[16px] mb-5 text-black/70 line-clamp-3 font-medium">{{product?.description}}</a>
                    <p v-if="productDetail?.discount && productDetail?.discount > 0" class="text-lg font-medium line-through text-black/60">{{ productDetail?.price + ' MMK' ?? 'Not Product Yet' }} </p>
                    <div class="flex items-end mt-1 gap-2">
                        <p v-if="productDetail?.price" class="font-bold text-2xl">{{Math.floor(productDetail?.price - (((productDetail?.discount ?? 0) / 100) * productDetail?.price))}} MMK</p>
                        <p v-else class="font-bold text-2xl">No product Yet</p>
                        <p v-if="productDetail?.discount && Number(productDetail?.discount) > 0" class="text-primary font-semibold">%{{ $formatNumber(productDetail?.discount) }} Off</p>
                    </div>
                    <div class="my-8 h-[1px] w-full bg-black/20"></div>
                    <p class="font-semibold text-lg">Product information</p>
                    <div class="flex flex-col gap-2 mt-3">
                        <div class="flex items-center ">
                            <p class="basis-[35%] font-semibold">Category:</p>
                            <p class="basis-[65%] text-black/70">{{product?.category?.name}}</p>
                        </div>
                        <div class="flex items-center ">
                            <p class="basis-[35%] font-semibold">Stock:</p>
                            <p :class="[totalStock ? '' : 'text-red-500']" class="basis-[65%] text-black/70">{{totalStock >0 ? totalStock : 'Out of stock'}}</p>
                        </div>
                        <div class="flex items-end cursor-pointer" :key="optionKey" v-for="optionKey in Object.keys(product?.groupAttributeOptions)">
                            <p class="basis-[35%] shrink-0 capitalize font-semibold">{{optionKey}}:</p>
                            <div class="flex items-center flex-wrap gap-2 w-full">
                                <p v-for="option in  product?.groupAttributeOptions[optionKey]"
                                :class="[
                                    params[optionKey] === option.value ? 'bg-primary text-white border-transparent' : ''
                                ]"
                                @click="handleGetProductDetail(optionKey,option.value)"
                                :key="option.value" class="shrink-0 border-[1px] border-black/30 rounded-full px-4 py-1 text-black/70">{{ option.value }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="my-8 h-[1px] w-full bg-black/20"></div>
                    <div class="flex lg:items-center lg:flex-row flex-col gap-3 mt-4 mb-2">
                        <div class="lg:basis-[40%]">
                            <p class="font-bold mb-2">Quantity</p>
                            <input :disabled="!totalStock" v-model="quantity" class="w-full border-black/10 rounded-full py-3 pl-5" :max="totalStock" type="number" />
                        </div>
                        <div v-if="isClothCategory" class="lg:basis-[60%] w-full">
                            <p class="font-bold mb-2">Size</p>
                            <select   v-model="selectedSize" class="w-full border-black/10 rounded-full py-3 ">
                                <option v-for="size in sizes" :value="size" :key="size">{{size}}</option>
                            </select>
                        </div>
                    </div>
                    <button @click="handleAddItemToCart" :disabled="!totalStock || totalStock <= 0" class="w-full h-full disabled:opacity-45 disabled:cursor-not-allowed text-white bg-primary rounded-full py-4 font-bold mt-3">Add to Cart</button>
                </div>
                <div class="mt-12">
                    <div class="flex items-center justify-between mb-7">
                        <h1 class="text-2xl font-medium ">Related Product</h1>
                        <Link :href="route('home')" class="text-sm text-primary underline">View all</Link>
                    </div>
                    <div class="flex flex-col gap-7">
                        <RelatedProductCard v-for="product in relatedProducts" :key="product?.id" :product="product" />
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
import ImageSliderModal from '@/Components/ImageSliderModal.vue';
import { mapMutations } from 'vuex';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/free-mode';
import 'swiper/css/navigation';
import 'swiper/css/thumbs';
import { Link } from '@inertiajs/vue3';

export default {
    components:{
        SectionContainer,
        ProductCard,
        RelatedProductCard,
        ImageSliderModal,
        Swiper,
        SwiperSlide,
        Link
    },
    props:{
        product : {
            type : Object
        },
        productDetail:{
            type : Object
        },
        sizes : {
            type :Object
        },
        latestProducts : {
            type:Object
        },
        relatedProducts:{
            type : Object
        },
        filters : {
            type : Object
        }
    },
    computed:{
        totalStock(){
                return this.productDetail?.stock_quantity;
        }
    },
    inject:['$formatNumber'],
    data(){
        return {
            images : this.product?.images.map(image => image?.url),
            open:false,
            selectedSize : this.sizes[0],
            quantity : this.totalStock ? 1 : 0,
            params : this.filters,
            Autoplay : Autoplay
        }
    },
    methods:{
        ...mapMutations(['addItemToCart']),
        handleAddItemToCart(){
            let item = {
                product : {
                    ...this.product,
                    product_details : [],
                    product_detail : this.productDetail,
                    quantity : this.quantity
                }
            };

            this.addItemToCart(item);

        },
        handleGetProductDetail(paramKey,value){
            let params = {};
            Object.keys(this.filters).forEach((key) => {
                params[key] = this.filters[key]
            });
            if(paramKey){
                // if(params[paramKey] != value){
                //     params[paramKey] = value
                // }else{
                //     delete params[paramKey]
                // }
                params[paramKey] = value
            }
            this.params = params;
            this.$inertia.get(route('product-detail',{product : this.product,...this.params}))
        }
    },
    mounted(){
        this.quantity = this.totalStock ? 1 : 0
        // this.handleGetProductDetail()
    }
}
</script>
<style>
    .button-shadow{
        box-shadow: 0 4px 10px 0 rgba(20, 20, 43, .1);
    }
</style>
