<template>
    <div class="h-[80vh] flex items-center">
        <div class="border-[1px] border-black/20 rounded-lg w-[40%] mx-auto py-[60px] px-[40px]">
            <div class="flex items-end gap-2 mb-8">
                <h1 class="text-[50px] leading-[0.8] text-primary font-bold">Login</h1>
                <div class="w-[10px] h-[10px] bg-primary rounded-full"></div>
            </div>
            <form  @submit.prevent="() => {
                create('user',route('login'))
            }" class="flex flex-col gap-5">
                <Input label="Email" v-model="form.email" :errorMessage="errors.email" placeholder="Enter your email"  />
                <Input label="Password" v-model="form.password" :errorMessage="errors.password" placeholder="Enter your password"  />
                <button type="submit" class="w-full py-4 text-white font-bold text-xl rounded-full bg-primary block">Login</button>
            </form>
        </div>
    </div>
</template>
<script>
import Input from '@/Components/Common/Input.vue';
import { useCRUDOperations } from '@/Composables/useCRUDOperations';
import * as yup from 'yup'
export default {
    components : {
        Input
    },
    setup(){
        const schema = yup.object({
            'email' : yup.string().required().email(),
            'password' : yup.string().required().min(6)
        })

        const {form,create,errors} = useCRUDOperations({
            'email' : '',
            'password' : '',
        },schema,true)

        return {
            form,create,errors
        }
    }
}
</script>
<style lang="">
    
</style>