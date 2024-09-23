<template >
    <div class="min-h-screen py-3 space-y-8">
        <Modal @close="showScreenShot = false" :show="showScreenShot" :closeable="true">
            <img :src="order?.screenshot" class="w-full h-full"/>
        </Modal>  
        <Breadcrumb
            icon="fa-box-open"
            label="Orders"
            :href="route('admin.orders.index')"
        >
            <BreadcrumbItem label="Order Detail" />
        </Breadcrumb>
        <h1 class="text-3xl font-bold">Order Detail</h1>
        <div class="flex gap-5 lg:flex-row flex-col">
            <div class="basis-[75%] grow-0 flex flex-col gap-3">
                <div class="bg-white rounded-lg border-[1px] px-5 py-4 shadow-[10px 10px 20px 3px rbga(0,0,0,0.4)]"> 
                    <div class="flex justify-between ">
                        <div class="flex flex-col gap-1">
                            <p class="font-bold ">Order ID : #{{ order?.id }}</p>
                            <p class="text-black/50 font-bold">{{ $formatDate(order?.created_at) }}</p>
                            <div :class="statusStyle" class="px-3 py-1 flex items-center text-sm font-bold w-max rounded-full">
                                {{ order.status }}
                            </div>
                            
                        </div>
                        <div>
                            <select :disabled="orderStatus == 'completed'" v-model="orderStatus" class="rounded-lg" name="" id="">
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex mt-5 items-center justify-between w-full">
                        <p class="text-lg font-semibold">Order Items Count</p>
                        <p class="text-xl font-bold">{{ order?.order_product_details.length }} Items</p>
                    </div>
                    <div class="flex mt-3 items-center justify-between w-full">
                        <p class="text-lg font-semibold">Total</p>
                        <p class="text-xl font-bold">{{ order?.total_amount }} MMK</p>
                    </div>
                    <div class="flex justify-end mt-5">
                        <Button text="View Payment ScreenShot" type="button" @click="showScreenShot = true"  />
                    </div>
                </div>
                <div class=" bg-white grow-0 border-[1px] rounded-lg px-5 py-4 shadow-[10px 10px 20px 3px rbga(0,0,0,0.4)]">
                    <h1 class="text-lg font-bold">Products</h1>
                    <div class="relative">
                        <table class="text-sm text-left rtl:text-right text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Product name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Options
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="productDetail in  order?.order_product_details" :key="productDetail?.id" class="bg-white border-b ">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        <div class="flex items-center gap-2"> 
                                            <img class="w-[50px] h-[50px] shrink-0 object-cover" :src="productDetail?.product_detail?.product?.images[0].url" alt="">
                                            <p>{{ productDetail?.product_detail?.product?.name }}</p>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{productDetail?.product_detail?.product?.category?.name}}
                                    </td>
                                    <td class="px-6 max-w-[1500px] text-black py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <p v-for="option in productDetail?.product_detail?.attribute_options" :key="option.id"><span class="font-medium">{{option?.attribute?.name}}</span> : <span class="text-primary">{{option.value}}</span> ,</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ productDetail?.price }} MMK
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ productDetail?.quantity }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="my-10 flex gap-5 items-center ">
                        <p class="text-2xl font-bold">Total : </p>
                        <p class="text-lg font-bold">{{ order?.total_amount }} MMK</p>
                    </div>
                </div>
            </div>
            <div class="basis-[25%] shrink-0 flex flex-col gap-3">
                <div class="bg-white border-[1px] rounded-lg px-5 py-4 shadow-[10px 10px 20px 3px rbga(0,0,0,0.4)]">
                    <h1 class="font-bold">Notes</h1>
                    <p>{{ order?.notes }}</p>
                </div>
                <div class="bg-white border-[1px] rounded-lg px-5 py-4 shadow-[10px 10px 20px 3px rbga(0,0,0,0.4)]">
                    <h1 class="font-bold">Customers</h1>
                    <div class="flex items-center gap-2 mt-2">
                        <UserOutline class="w-[25px] h-[25px]" />
                        {{ order?.user?.name }}
                    </div>
                </div>
                <div class="bg-white border-[1px] rounded-lg px-5 py-4 shadow-[10px 10px 20px 3px rbga(0,0,0,0.4)]">
                    <h1 class="font-bold">Contact Information</h1>
                    <div class="flex items-center gap-2 mt-2">
                        <Email class="w-[25px] h-[25px]" />
                        <p class="text-sm">{{ order?.user?.email }}</p>
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        <Phone class="w-[25px] text-gray-600 h-[25px]" />
                        <p class="text-sm">{{ order?.user?.phone }}</p>
                    </div>
                    <div v-if="order?.user?.fb_profile_link" class="flex items-center gap-2 mt-2">
                        <Facebook class="w-[25px] text-gray-600 h-[25px]" />
                        <a :href="order?.user?.fb_profile_link" target="_blank" class="text-sm">{{ order?.user?.fb_profile_link }}</a>
                    </div>
                    <div v-if="order?.user?.viber" class="flex items-center gap-2 mt-2">
                        <Viber class="w-[25px] text-gray-600 h-[25px]" />
                        <a :href="order?.user?.viber" target="_blank" class="text-sm">{{ order?.user?.viber }}</a>
                    </div>
                    <div v-if="order?.user?.telegram" class="flex items-center gap-2 mt-2">
                        <Viber class="w-[25px] text-gray-600 h-[25px]" />
                        <a :href="order?.user?.telegram" target="_blank" class="text-sm">{{ order?.user?.telegram }}</a>
                    </div>
                </div>
                <div class="bg-white border-[1px] rounded-lg px-5 py-4 shadow-[10px 10px 20px 3px rbga(0,0,0,0.4)]">
                    <h1 class="font-bold">Shipping Address</h1>
                    <div class="flex items-center gap-2 mt-2">
                        <UserOutline class="w-[25px] h-[25px]" />
                        {{ order?.user?.name }}
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        <Location class="w-[25px] h-[25px]"/>
                        <p>{{ order?.shipping_address ?? order?.user?.address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Email from '@/assets/icons/Email.vue';
import Facebook from '@/assets/icons/Facebook.vue';
import Location from '@/assets/icons/Location.vue';
import Phone from '@/assets/icons/Phone.vue';
import UserOutline from '@/assets/icons/UserOutline.vue';
import Viber from '@/assets/icons/Viber.vue';
import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue';
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';
import Button from '@/Components/Atoms/Button.vue';
import Modal from '@/Components/Modal.vue';
import {router} from '@inertiajs/vue3'


export default {
    components:{
        Breadcrumb,BreadcrumbItem,UserOutline,Email,Phone,Facebook,Viber,Location,Button,Modal
    },
    inject : ['$formatDate'],
    props : {
        order : {
            type :Object
        }
    },
    data(){
        return {
            showScreenShot : false,
            orderStatus : this.order.status
        }
    },
    watch:{
        orderStatus(){
            if(this.orderStatus == 'completed'){
                this.orderUpdate()
            }
        }
    },
    computed:{
        statusStyle(){
            if(this.order.status == 'pending') return 'bg-yellow-500/20 text-yellow-500'
            if(this.order.status == 'completed') return 'bg-green-500/20 text-green-500'
        }
    },
    methods : {
        orderUpdate(){
            router.post(route('admin.orders.update',{order : this.order}),{
                status : 'completed'
            })
        }
    }

}
</script>
<style lang="">
    
</style>