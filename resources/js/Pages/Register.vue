<template >
    <div class="my-10 flex items-center">
        <div class="border-[1px] border-black/20 rounded-lg w-[40%] mx-auto py-[40px] px-[40px]">
            <div class="flex items-end gap-2 mb-8">
                <h1 class="text-[50px] leading-[0.8] text-primary font-bold">Register</h1>
                <div class="w-[10px] h-[10px] bg-primary rounded-full"></div>
            </div>
            <form  @submit.prevent="() => {
                create('user',route('register'))
            }" class="flex flex-col gap-5">
                <Input label="Name" v-model="form.name" :errorMessage="errors.name" placeholder="Enter your name"  />
                <Input label="Email" type="email" v-model="form.email" :errorMessage="errors.email" placeholder="Enter your email"  />
                <Input label="Phone" v-model="form.phone" :errorMessage="errors.phone" placeholder="Enter your phone number"  />
                <Input label="Password" type="password" v-model="form.password" :errorMessage="errors.password" placeholder="Enter your password"  />
                <button type="submit" class="w-full py-4 text-white font-bold text-xl rounded-full bg-primary block">Register</button>
                <p class="text-sm text-center font-semibold">Already have an account? Login <Link class="text-primary underline" :href="route('login')">here.</Link></p>

            </form>
        </div>
    </div>
</template>
<script>
import Input from '@/Components/Common/Input.vue';
import { useCRUDOperations } from '@/Composables/useCRUDOperations';
import { Link } from '@inertiajs/vue3';
import * as yup from 'yup'
export default {
    components : {
        Input,
        Link
    },
    setup(){
        const schema = yup.object({
            'email' : yup.string().required().email(),
            'password' : yup.string().required().min(6),
            'name' : yup.string().required().min(2),
            'phone' : yup.string().required().min(6),
        })

        const {form,create,errors} = useCRUDOperations({
            'email' : '',
            'password' : '',
            'name' : '',
            'phone' :""
        },schema,true)

        return {
            form,create,errors
        }
    }
    
}
</script>
<style lang="">
    
</style>