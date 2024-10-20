<template >
    <SectionContainer>
        <div class="bg-[#F7F8F9]  py-24 my-10 rounded-xl flex flex-col items-center justify-center">
            <h1 class="text-3xl font-bold">Shop</h1>
            <p class="lg:w-[50%] w-[70%] text-center mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
        </div>
        <div class="flex md:flex-row flex-col top-0 mb-[100px]">
            <div class="lg:w-[25%] md:w-[35%] w-full md:sticky self-start top-16">
                <div class="flex items-center pl-2 rounded-full bg-white border-[1px] h-[50px]">
                    <Search class="text-black/50" />
                    <input v-model="search" type="text" class="w-full p-0 pl-2 border-none bg-transparent outline-none focus:ring-0" placeholder="Search for products" />
                </div>
                <div>
                    <p class="text mt-8 mb-3 font-bold">Product By Category</p>
                    <div>
                        <div   @click="category ='all'" class="flex  items-center cursor-pointer gap-2 py-3 px-2  border-t-[1px] border-t-black/10" 
                        >
                            <!-- <component :is="c.icon" class='w-[20px] h-[20px] text-primary' /> -->
                            <p class="text-sm hover:text-primary transition-all">All</p>
                        </div>
                        <div v-for="(c,i) in categories" :key="c.name" @click="category = c.name" class="flex items-center cursor-pointer gap-2 py-3 px-2  border-t-[1px] border-t-black/10" 
                        :class="[i == categories.length -1 ? 'border-b-[1px] border-b-black/10' : '']"
                        >
                            <!-- <component :is="c.icon" class='w-[20px] h-[20px] text-primary' /> -->
                            <p :class="[c.name == category ? 'text-primary font-medium' : 
                                ''
                            ]" class="text-sm hover:text-primary transition-all">{{c.name}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-[75%] md:w-[65%] md:mt-0 mt-10 w-full mb-12 md:pl-[8%]">
                <div v-if="products?.length > 0" class="grid lg:grid-cols-4 md:grid-cols-2 mb-14 gap-x-5 gap-y-10">
                    <div  v-for="product in products" :key="product.id" class="cursor-pointer">
                        <Link :href="route('product-detail',{product})">
                            <div class="w-full h-auto bg-[#F7F8F9] group rounded-xl overflow-hidden">
                                <img class="w-full h-full group-hover:scale-[1.1] transition-all duration-200" :src="product.images[0]?.url" />
                            </div>
                            <p class="mt-3 font-semibold">{{product?.name}}</p>
                            <div class="flex gap-2 text-sm items-center font-semibold mt-1">
                                <!-- <p class="text-primary">{{Math.floor(product?.price - ((product?.discount / 100) * product?.price))}} MMK</p> -->
                                <p v-if="product?.discount || product?.discount !== 0" class="text-primary">{{ product?.price ?? '1000' }} MMK</p>
                            </div>
                        </Link>
                    </div>
                </div>
                <div v-else class="w-full h-[300px] flex items-center justify-center font-bold font-lg text-black/40">
                    <p>No Products yet.</p>
                </div>
                <p ref="observer" v-if="products?.length > 0" class="opacity-0">Load More</p>
                <div class="w-full flex justify-center">
                    <div v-if="products?.length && isLoading" class="w-8 h-8  animate-spin rounded-full border-[3px] border-primary border-t-transparent"></div>
                </div>
                <p v-if="currentPage == lastPage && products?.length" class="text-center">No more products</p>
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
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { debounce } from 'lodash';

export default {
    components:{
        Navbar,
        Footer,
        SectionContainer,
        Search,
        Link
    },
    props:{
        productsData : {
            type : Object
        },
        filters : {
            type : Object
        },
        categories : {
            type : Object
        }
    },
    data(){
        return {
            search : this.filters.search ?? '',
            category : this.filters.category ?? null,
            products : this.productsData?.data,
            currentPage : this.productsData?.current_page,
            lastPage :this.productsData?.last_page,
            isLoading : false,
            observer : null,
            // categories : [
            //     {
            //         icon : Cloth,
            //         category :  'Clothes'
            //     },
            //     {
            //         icon : Cosmetic,
            //         category :  'Cosmetic'
            //     },
            //     {
            //         icon : Electronic,
            //         category :  'Electronic'
            //     },
            //     {
            //         icon : Pot,
            //         category :  'Food'
            //     },
            //     {
            //         icon : Hammer,
            //         category : "Home Accessories"
            //     }
            // ]
        }
    },
    computed:{
        dynamicParams(){
            let params = {}
            if(this.search) params.search = this.search;
            if(this.category !== 'all') params.category = this.category;
            return params
        }   
    },  
    watch:{
        search(){
            this.fetchProducts()

        },
        category(){
            this.fetchProducts()
        }
    },
    methods:{
        fetchProducts: debounce( function (){
            this.$inertia.get(route('home',this.dynamicParams),{},{
                preserveScroll : true,
                preserveState : true,
                onSuccess:(data) => {
                    this.products = data.props.productsData.data;
                    this.currentPage = 1;
                    this.lastPage = data.props.productsData.last_page
                }
            })
            //we need to reset our products bcz if dont reset our products 
            //the products will concat with old products
        },300),
        initObserver(){
            const options = {
                root :null,
                rootMargin : '0px',
                threshold : 0.1
            }
            this.observer = new IntersectionObserver(async(entries) => {
                const [entry] = entries;
                if(entry.isIntersecting){
                console.log(this.currentPage,this.lastPage)
                    if(this.currentPage < this.lastPage && !this.isLoading){
                        this.isLoading = true;
                        this.currentPage = this.currentPage + 1;
                        const response = await axios.get(route('home',{page : this.currentPage , ...this.dynamicParams}));
                        this.products = [...this.products,...response?.data?.productsData.data]
                        this.isLoading = false;
                    }
                }
            },options)
            this.observer.observe(this.$refs.observer)
        }
    },
    mounted(){
        this.initObserver();
    },
    beforeMount(){
        this.observer?.disconnect();
    }
}
</script>
<style lang="">
    
</style>