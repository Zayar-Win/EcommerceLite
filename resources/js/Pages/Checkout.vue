<template>
    <div class="flex lg:flex-row flex-col gap-5 xl:px-32 sm:px-5 px-2 mt-10 mb-10">
        <div class="basis-[60%]">
            <h1 class="font-bold text-2xl ">Billing Details</h1>
            <div class="mt-6 border-[1px] border-black/10  px-6 pt-8 pb-8">
                <div class="grid md:grid-cols-2 gap-4">
                    <Input label="FirstName" placeHolder="Enter your first name" />
                    <Input label="LastName" placeHolder="Enter your last name" />
                    <Input label="Phone" placeHolder="Enter your mobile phone number" />
                    <Input label="Email" placeHolder="Enter your email address" type="email" />
                    <div class="md:col-span-2">
                        <select class="w-full border-[1px] border-black/20 focus:border-primary transition-all py-3 rounded-lg">
                            <option>Yangon</option>
                            <option>Bahan</option>
                        </select>
                    </div>
                    <Input class="md:col-span-2" label="Account UserName" placeHolder="Username"  />
                    <Input class="md:col-span-2" label="Create Account Password" placeHolder="Password" type="password" />
                    <div class="flex md:col-span-2 flex-col">
                        <label class="font-semibold text-sm">Order Notes(optional)</label>
                        <textarea rows="5" class="outline-none focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2" :type='type' :placeholder="placeHolder"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="basis-[40%]">
            <h1 class="font-bold text-2xl ">Your Order</h1>
            <div class="mt-6 border-[1px] border-black/10  px-6 pt-8 pb-8">
                <p class="font-semibold">Product</p>
                <div class="mt-3 pb-7 flex flex-col text-sm gap-3 border-b-[1px] border-b-black/10">
                    <div class="flex items-center gap-8">
                        <div class="flex font-bold items-center justify-between grow">
                            <p>Waffle Coral Velet Full Modle </p>
                        </div>
                        <div class="font-bold flex gap-2 shrink-0">
                            <p class="text-black/50">x 1</p>
                            <p>4850 ks</p>
                        </div> 
                    </div>
                    <div class="flex items-center gap-8">
                        <div class="flex font-bold items-center justify-between grow">
                            <p>Waffle Coral Velet Full Modle </p>
                        </div>
                        <div class="font-bold flex gap-2 shrink-0">
                            <p class="text-black/50">x 1</p>
                            <p>4850 ks</p>
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
                    <p class="font-extrabold">8850 Ks</p>
                </div>
                <div class="mt-8 ">
                    <p class="font-semibold mb-3">Bank Transfer</p>
                    <div class="grid grid-cols-5 gap-2">
                        <div v-for="payment in payments" @click="selectedPayment = payment?.name" class="border  rounded-md overflow-hidden" :class="[payment?.name == selectedPayment ? 'border-primary border-2' : 'border-black/30']">
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
                    </div>
                </div>
                <div class="flex items-center cursor-pointer gap-2">
                    <input id="termandcondition" type="checkbox" class="outline-none focus:ring-0 border-2 border-black/10" name="" >
                    <label for="termandcondition" class="text-sm font-bold text-black/50 my-4">I have read and agree to the website <span class="underline text-black">terms and conditions</span></label>
                </div>
                <button class="w-full h-full text-white bg-primary rounded-full py-4 font-bold mt-3">Add to Cart</button>
            </div>
        </div>
    </div>
</template>
<script>
import Input from '@/Components/Common/Input.vue';

export default {
    components:{
        Input,
    },
    props:{
        payments : {
            type :Array
        }
    },
    data(){
        return{
            selectedPayment : this.payments[0]?.name ?? null
        }
    }

}
</script>
<style>
    
</style>