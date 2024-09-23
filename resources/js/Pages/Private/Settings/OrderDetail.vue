<template>
    <div>
        <h1 class="text-2xl font-bold mb-5">Order Detail</h1>
        <div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-white uppercase bg-primary ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Product name
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
                            <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap ">
                                <div class="flex items-center gap-2"> 
                                    <img class="w-[50px] h-[50px] shrink-0 object-cover" :src="productDetail?.product_detail?.product?.images[0].url" alt="">
                                    <p class="line-clamp-1">{{ productDetail?.product_detail?.product?.name }}</p>
                                </div>
                            </th>
                            <td class="px-6 max-w-[1500px] text-black py-4">
                                <div class="flex flex-wrap gap-2">
                                    <p v-for="option in productDetail?.product_detail?.attribute_options" :key="option.id"><span class="font-medium">{{option?.attribute?.name}}</span> : <span class="text-primary">{{option.value}}</span> ,</p>
                                </div>
                            </td>
                            <td class="px-6 text-black py-4">
                                {{ productDetail?.price }} MMK
                            </td>
                            <td class="px-6 text-black py-4">
                                {{ productDetail?.quantity }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import SettingLayout from './Layouts/SettingLayout.vue';

export default {
    layout : [SettingLayout],
    props : {
        order : {
            type :Object
        }
    },
    
    mounted(){
        console.log(this.order)
    }
}
</script>
<style lang="">
    
</style>