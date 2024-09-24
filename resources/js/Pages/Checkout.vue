<template>
    <div class="flex lg:flex-row flex-col gap-5 xl:px-32 sm:px-5 px-2 mt-10 mb-10">
        <div class="basis-[60%]">
            <h1 class="font-bold text-2xl ">Billing Details</h1>
            <div class="mt-6 border-[1px] border-black/10  px-6 pt-8 pb-8">
                <form class="grid md:grid-cols-2 gap-4" @submit.prevent="() => {
                    create('Order',route('order.create'),onSuccessHandler)
                }">
                    <Input class="md:col-span-2" label="Name" v-model="form.name"  :errorMessage="errors.name" placeHolder="Enter your name" />
                    <Input label="Phone" placeHolder="Enter your mobile phone number" v-model="form.phone" :errorMessage="errors?.phone" />
                    <Input label="Email" placeHolder="Enter your email address" type="email" v-model="form.email" :errorMessage="errors?.email" />
                    <div class="md:col-span-2">
                        <label class="font-semibold text-sm">Town / City</label>
                        <select v-model="form.town" class="w-full border-[1px] mt-2 border-black/20 focus:border-primary transition-all py-3 rounded-lg">
                            <option :value="city.name_en" v-for="city in yangonCities" :key="city.id">{{city.name_en}}</option>
                        </select>
                        <ValidationError :message="errors?.town" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="font-semibold text-sm">Payment(Make sure to select correctly  your payment before submit)</label>
                        <select v-model="form.payment_id" class="w-full border-[1px] mt-2 border-black/20 focus:border-primary transition-all py-3 rounded-lg">
                            <option :selected="selectedPayment == payment.name" :value="payment.id" v-for="payment in payments" :key="payment.id">{{payment.name}}</option>
                        </select>
                        <ValidationError :message="errors?.payment_id" />
                    </div>
                    <Input class="md:col-span-2" label="Shipping Address" placeHolder="Enter your shipping address" v-model="form.shippingAddress" :errorMessage="errors?.shippingAddress"  />
                    <!-- <Input class="md:col-span-2" label="Account UserName" placeHolder="Username"  /> -->
                    <Input class="md:col-span-2" label="Create Account Password" placeHolder="Password" type="password" v-model="form.password" :errorMessage="errors?.password" />
                    <Input label="Viber" placeHolder="Enter your viber Phone no or name" v-model="form.viber" />
                    <Input label="Telegram" placeHolder="Enter your telegram Phone no or name" v-model="form.telegram" />
                    <Input class="md:col-span-2" label="Fb Profile link" v-model="form.fb_profile_link" placeHolder="Paste your Fackbook Profile link" />
                    <div class="flex md:col-span-2 flex-col">
                        <label class="font-semibold text-sm">Order Notes(optional)</label>
                        <textarea rows="5" v-model="form.notes" class="outline-none focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2"></textarea>
                    </div>
                    <div class="md:col-span-2 flex  flex-col justify-center">
                        <!-- <div class="border-[1px] relative cursor-pointer border-dashed py-4 rounded-lg w-full gap-2 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-black/60" width="25" height="25" viewBox="0 0 24 24"><path fill="currentColor" d="M18 15.75q0 2.6-1.825 4.425T11.75 22t-4.425-1.825T5.5 15.75V6.5q0-1.875 1.313-3.187T10 2t3.188 1.313T14.5 6.5v8.75q0 1.15-.8 1.95t-1.95.8t-1.95-.8t-.8-1.95V6h2v9.25q0 .325.213.538t.537.212t.538-.213t.212-.537V6.5q-.025-1.05-.737-1.775T10 4t-1.775.725T7.5 6.5v9.25q-.025 1.775 1.225 3.013T11.75 20q1.75 0 2.975-1.237T16 15.75V6h2z"/></svg>
                            <p class="text-lg font-bold text-black/60">Attach your screenshot here.</p>
                            <input type="file" name="" class="absolute top-0 left-0 w-full h-full opacity-0"id="">
                        </div> -->
                        <label class="font-semibold text-sm">Paid ScreenShot</label>
                        <FilePond class="w-full mt-2" @updateFile="(value) => form.screenshot = value" />
                        <ValidationError :message="errors?.screenshot" />
                    </div>
                    <button type="submit"  class="w-full h-full col-span-2 text-white bg-primary rounded-full py-4 font-bold mt-3">Confirm order</button>
                </form>
            </div>
        </div>
        <div class="basis-[40%]">
            <h1 class="font-bold text-2xl ">Your Order</h1>
            <div class="mt-6 border-[1px] border-black/10  px-6 pt-8 pb-8">
                <p class="font-semibold">Product</p>
                <div class="mt-3 pb-7 flex flex-col text-sm gap-3 border-b-[1px] border-b-black/10">
                    <div v-for="item in cartItems" :key="item?.product_detail?.id" class="flex items-center gap-8">
                        <div class="flex font-bold items-center justify-between grow">
                            <p>{{item?.product?.name}}</p>
                        </div>
                        <div class="font-bold flex gap-2 shrink-0">
                            <p class="text-black/50">x {{ item?.product?.quantity }}</p>
                            <p class="">{{Math.floor(item?.product?.product_detail?.price - (((item?.product?.product_detail?.discount ?? 0) / 100) * item?.product?.product_detail?.price))}} MMK</p>
                        </div> 
                    </div>
                </div>
                <div class="mt-6 pb-8 border-b-[1px] border-b-black/10">
                    <p class="font-semibold">Shipping</p>
                    <div class="mt-3 text-sm font-bold  flex items-center justify-between">
                        <p>Delivery Fees:</p>
                        <p>4000 Ks</p>
                    </div>
                </div>
                <div class="mt-8 pb-8 flex border-b-[1px] border-b-black/10 items-center justify-between">
                    <p class="font-semibold">Total</p>
                    <p class="font-extrabold">{{totalPrice}} Ks</p>
                </div>
                <div class="mt-8 ">
                    <p class="font-semibold mb-3">Bank Transfer</p>
                    <div class="grid grid-cols-5 gap-2">
                        <div v-for="payment in payments" @click="() => {
                            selectedPayment = payment?.name
                        }" class="border  rounded-md overflow-hidden" :class="[payment?.name == selectedPayment ? 'border-primary border-2' : 'border-black/30']">
                            <img class="w-full h-full object-cover" :src="payment?.icon" />
                        </div> 
                    </div>
                    <p class="mt-4 text-sm font-bold text-black/50">
                        Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                    </p>
                    <div v-for="payment in payments" class="mt-5 flex-col gap-3" :class="[payment.name === selectedPayment ? 'flex' :'hidden']">
                        <div>
                            <p class="font-semibold text-lg">Acc No.</p>
                            <p class=" font-semibold text-black">{{payment?.ph_number}}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Username.</p>
                            <p class=" font-semibold text-black">Zayarwin</p>
                        </div>
                        <div>
                            <h1 class="font-semibold text-lg">QR Code.</h1>
                            <img class="w-[300px] mx-auto h-auto" :src="payment?.qr_code" />
                        </div>
                        <div v-if="payment?.description">
                            <h1 class="font-semibold text-lg">Description</h1>
                            <p class=" font-semibold text-black">{{payment?.description}}</p>

                        </div>

                    </div>
                </div>
                <div class="flex items-center cursor-pointer gap-2">
                    <input id="termandcondition" type="checkbox" class="outline-none focus:ring-0 border-2 border-black/10" name="" >
                    <label for="termandcondition" class="text-sm font-bold text-black/50 my-4">I have read and agree to the website <span class="underline text-black">terms and conditions</span></label>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Input from '@/Components/Common/Input.vue';
import { mapGetters, mapMutations } from 'vuex';
import myanmarCity from '@bilions/myanmar-cities'
import * as yup from 'yup'
import { router } from '@inertiajs/vue3';
import { useCRUDOperations } from '@/Composables/useCRUDOperations';
import ValidationError from '@/Components/Atoms/ValidationError.vue';
import FilePond from '@/Components/Atoms/FilePond.vue';
export default {
    components:{
        Input,
        FilePond,
        ValidationError
    },
    props:{
        payments : {
            type :Array
        }
    },
    computed:{
        ...mapGetters(['cartItems']),
        totalPrice(){
             return this.cartItems.reduce((prev,curr) => {
                let itemTotalPrice = (Math.floor(curr?.product?.product_detail?.price - (((curr?.product?.product_detail?.discount ?? 0) / 100) * curr?.product?.product_detail?.price))) * curr?.product?.quantity;
                prev += itemTotalPrice;
                return prev;
            },0)
        },
        
    },
    methods:{
        ...mapMutations(['clearAllItemsFromCart']),
        onSuccessHandler(){
            this.clearAllItemsFromCart()
        }
    },  
    data(){
        return{
            selectedPayment : this.payments[0]?.name ?? null,
            yangonCities : [],
            
        }
    },
    setup(){ 
        const schema = yup.object({
            name : yup.string().required().min(2),
            phone : yup.string().required(),
            email : yup.string().email().required('Email is required').matches(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/, 'Please enter correct email.'),
            town : yup.string().required(),
            shippingAddress : yup.string().required(),
            password : yup.string().required().min('6'),
            screenshot : yup.mixed()
                            .required("File is required")
                            .test(
                            "fileType",
                            "Only images are allowed",
                            (value) => value && ["image/jpeg", "image/png"].includes(value.type)
                            ),
        });

        const {form,errors,create} = useCRUDOperations({
            name : '',
            phone : '',
            email : '',
            town : '',
            shippingAddress : '',
            password : '',
            viber : '',
            telegram : '',
            fb_profile_link : '',
            notes : '',
            screenshot : null,
            orderItems : [],
            totalAmount : null,
            payment_id : null
        },schema,false)

        return {
            errors,
            form,
            create
        }

    },
    watch:{
        'form.payment_id'(){
            this.selectedPayment = this.payments.filter(payment => payment.id == this.form.payment_id)[0].name
        },
    },
    mounted(){
        if(!this.cartItems.length){
            return router.get(route('home'));
        }
        let allRegions = myanmarCity.getRegions();
        let yangonIndex = allRegions.findIndex(region => region.name_en == 'Yangon');
        let yangonCities = myanmarCity.getCities(yangonIndex + 1)
        this.yangonCities = yangonCities
        this.form.orderItems = this.cartItems
        this.form.totalAmount = this.totalPrice
        this.form.payment_id = this.payments.filter(payment => payment.name == this.selectedPayment)[0].id
    }

}
</script>
<style>
    
</style>