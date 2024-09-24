<template>
    <div>
        <div class="my-10 flex items-center">
            <div class="border-[1px] border-black/20 rounded-lg w-[40%] mx-auto py-[40px] px-[40px]">
                <h1 class="text-[34px] mb-5 leading-[0.8] text-primary font-bold">Support Ticket</h1>
                <form class="space-y-4"
                @submit.prevent="create('Ticket',route('ticket.store'))"
                >
                    <div>
                        <Label label="Name" required />

                        <InputField
                            v-model="form.name"
                            type="text"
                            name="display-name"
                            placeholder="Enter your name"
                            required
                        />
                        <ValidationError :message="errors?.name" />
                    </div>
                    <div>
                        <Label label="Email" required />

                        <InputField
                            v-model="form.email"
                            type="email"
                            name="email"
                            placeholder="Enter your email"
                            required
                        />
                        <ValidationError :message="errors?.email" />
                    </div>
                    <div>
                        <Label label="Phone" required />

                        <InputField
                            v-model="form.phone"
                            type="text"
                            name="phone"
                            placeholder="Enter your phone"
                            required
                        />
                        <ValidationError :message="errors?.phone" />
                    </div>
                    <div>
                        <Label label="Description" required />

                        <Textarea
                            v-model="form.description"
                            name="description"
                            placeholder="Describe your cases"
                            required
                            class="w-full rounded-md border-[1px] outline-none border-gray-300"
                        />
                        <ValidationError :message="errors?.description" />
                    </div>
                    <button type="submit" class="w-full py-4 text-white font-bold text-xl rounded-full bg-primary block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import InputField from '@/Components/Atoms/InputField.vue';
import Label from '@/Components/Atoms/Label.vue';
import Textarea from '@/Components/Atoms/Textarea.vue';
import ValidationError from '@/Components/Atoms/ValidationError.vue';
import { useCRUDOperations } from '@/Composables/useCRUDOperations';
import * as yup from 'yup'

export default {
    components:{
        InputField,
        Label,
        ValidationError,
        Textarea
    },
    setup(){
        const ticketSchema =  yup.object({
            'name' : yup.string().required().min(2),
            'email'  : yup.string().required().email(),
            'phone' : yup.string().required(),
            'description'  : yup.string().required().min(10)
        })
        const { form, create, errors, processing } = useCRUDOperations({
            name: "",
            email: "",
            phone: "",
            description:''
        },ticketSchema);

        return {
            form,
            errors,
            create,
            processing
        }
    }
}
</script>
<style lang="">
    
</style>