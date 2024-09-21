<template >
    <div class="min-h-screen py-3 space-y-8">
        <Breadcrumb
            icon="fa-box-open"
            label="Orders"
            :href="route('admin.orders.index')"
        >
            <BreadcrumbItem label="Order Detail" />
        </Breadcrumb>
        <h1 class="text-3xl font-bold">Order Detail</h1>
        <div class="bg-white rounded-lg px-5 py-6 shadow-[10px 10px 20px 3px rbga(0,0,0,0.4)]"> 
            <div class="flex justify-between ">
                <div class="flex flex-col gap-1">
                    <p class="font-bold ">Order ID : #{{ order?.id }}</p>
                    <p class="text-black/50 font-bold">{{ $formatDate(order?.created_at) }}</p>
                    <div :class="statusStyle" class="px-3 py-1 flex items-center text-sm font-bold w-max rounded-full">
                        {{ order.status }}
                    </div>
                </div>
                <div>
                    <select class="rounded-lg" name="" id="">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>
            <div class="grid my-16 grid-cols-3 gap-3"> 
                <div class="flex items-start gap-3">
                    <div class="w-[50px] shrink-0 h-[50px] flex items-center justify-center rounded-full bg-black/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 256 256"><path fill="currentColor" d="M230.92 212c-15.23-26.33-38.7-45.21-66.09-54.16a72 72 0 1 0-73.66 0c-27.39 8.94-50.86 27.82-66.09 54.16a8 8 0 1 0 13.85 8c18.84-32.56 52.14-52 89.07-52s70.23 19.44 89.07 52a8 8 0 1 0 13.85-8M72 96a56 56 0 1 1 56 56a56.06 56.06 0 0 1-56-56"/></svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">Customer</h1>
                        <div class="flex flex-col gap-1"> 
                            <div class="flex text-black/30 text-sm items-center">
                                <p class="font-medium">Name:</p>
                                <p class="pl-3 text-black">{{ order?.shipping_recipient_name }}</p>
                            </div>
                            <div class="flex text-black/30 text-sm items-center">
                                <p class="font-medium">Email:</p>
                                <p class="pl-3 text-black">{{ order?.user?.email }}</p>
                            </div>
                            <div class="flex text-black/30 text-sm items-center">
                                <p class="font-medium">Phone:</p>
                                <p class="pl-3 text-black">{{ order?.shipping_ph_number }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-[50px] shrink-0 h-[50px] flex items-center justify-center rounded-full bg-black/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 21a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m-8 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3M3.71 5.4h15.214c1.378 0 2.373 1.27 1.995 2.548l-1.654 5.6C19.01 14.408 18.196 15 17.27 15H8.112c-.927 0-1.742-.593-1.996-1.452zm0 0L3 3"/></svg>
                    </div>
                    <div class="w-full">
                        <h1 class="text-lg font-bold">Order Info</h1>
                        <div class="flex flex-col gap-1"> 
                            <div class="flex text-black/30 text-sm items-start">
                                <p class="font-medium">Product Count:</p>
                                <p class="pl-3 text-black">{{ order?.order_product_details?.length }}</p>
                            </div>
                            <div class="flex text-black/30 text-sm items-start">
                                <p class="font-medium">Total Amount:</p>
                                <p class="pl-3 capitalize text-black">{{ order?.total_amount }} MMK</p>
                            </div>
                            <div class="flex w-full text-black/30 text-sm items-start">
                                <p class="font-medium">Shipping Address:</p>
                                <p class="pl-3 capitalize text-black" style="word-break: break-all;">{{ order?.shipping_address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-[50px] shrink-0 h-[50px] flex items-center justify-center rounded-full bg-black/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 14 14"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M7 4.5V3M5.5 8.5c0 .75.67 1 1.5 1s1.5 0 1.5-1c0-1.5-3-1.5-3-3c0-1 .67-1 1.5-1s1.5.38 1.5 1M7 9.5V11"/><circle cx="7" cy="7" r="6.5"/></g></svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">Payment Info</h1>
                        <div class="flex flex-col gap-1"> 
                            <div class="flex text-black/30 text-sm items-center">
                                <p class="font-medium">Payment Method:</p>
                                <p class="pl-3 text-black capitalize">{{ order?.payment?.name }}</p>
                            </div>
                            <div class="flex text-black/30 text-sm items-center">
                                <p class="font-medium">Order Status:</p>
                                <p class="pl-3 capitalize text-black">{{ order?.status }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h1 class="text-lg font-bold">Notes</h1>
                <p>{{ order?.notes }}</p>
            </div>
            <div class="mt-16">
                <h1 class="text-lg font-bold">Products</h1>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
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
                <h1 class="text-lg font-bold">Products</h1>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
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
    </div>
</template>
<script>
import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue';
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';


export default {
    components:{
        Breadcrumb,BreadcrumbItem
    },
    inject : ['$formatDate'],
    props : {
        order : {
            type :Object
        }
    },
    computed:{
        statusStyle(){
            if(this.order.status == 'pending') return 'bg-yellow-500/20 text-yellow-500'
        }
    },
    mounted(){
        console.log(this.order)
    }
}
</script>
<style lang="">
    
</style>