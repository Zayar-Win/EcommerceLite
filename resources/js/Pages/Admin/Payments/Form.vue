<script setup>
import Label from "@/Components/Atoms/Label.vue";
import InputField from "@/Components/Atoms/InputField.vue";
import ValidationError from "@/Components/Atoms/ValidationError.vue";
import FormButton from "@/Components/Atoms/FormButton.vue";
import { useCRUDOperations } from "@/Composables/useCRUDOperations";
import { onMounted } from "vue";
import InertiaLinkButton from "@/Components/Atoms/InertiaLinkButton.vue";
import * as yup from 'yup'
import FilePond from "@/Components/Atoms/FilePond.vue";

const props = defineProps({
    mode: {
        type: String,
        default: "create",
        validator: (value) => ["create", "edit"].includes(value),
    },
    payment: {
        type: Object,
        required: false,
    },
});


let paymentSchema = yup.object({
    'name' : yup.string().required().min(2),
    'username'  :yup.string().required().min(3),
    'qr_code' : yup.mixed()
                    .required("Qr Code is required"),
    'icon' : yup.mixed()
                    .required("Payment Icon is required"),
    'description' : yup.string().required().min(20),
    'acc_number' : yup.string().required().min(6)
})

// const schema = computed(() => (props.mode === 'create' ? userCreateSchema : userEditSchema));

const { form, create, edit, errors, processing } = useCRUDOperations({
    name: "",
    username: "",
    qr_code: null,
    icon: null,
    description: "",
    acc_number: "",
},paymentSchema);


onMounted(() => {
    if (props.payment && props.mode === "edit") {
        form.name= props.payment?.name
        form.username= props.payment?.username
        form.qr_code =  props.payment?.qr_code
        form.icon =props?.payment?.icon
        form.description = props?.payment?.description
        form.acc_number = props.payment?.acc_number
    }
});

</script>

<template>
    <div class="border p-10 bg-white rounded-md">
        <form
            class="space-y-4 md:space-y-6"
            @submit.prevent="
                mode === 'create'
                    ? create('User', route('admin.payments.store'))
                    : edit('User', route('admin.payments.update', { payment }))
            "
        >
            <div>
                <Label label="Payment Qr Photo" required />
                <FilePond :image="form?.qr_code" @updateFile="(file) => form.qr_code = file" />
                <ValidationError :message="errors?.qr_code" />
            </div>
            <div>
                <Label label="Payment Icon" required />
                <FilePond :image="form?.icon" @updateFile="(file) => form.icon = file" />
                <ValidationError :message="errors?.icon" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <Label label="Payment Name" required />
                    <InputField
                        v-model="form.name"
                        type="text"
                        name="display-name"
                        placeholder="Enter payment name"
                        required
                    />

                    <ValidationError :message="errors?.name" />
                </div>

                <div>
                    <Label label="Acc Number" required />

                    <InputField
                        v-model="form.acc_number"
                        type="string"
                        name="Acc Number"
                        placeholder="Enter Acc Number"
                        required
                    />

                    <ValidationError :message="errors?.acc_number" />
                </div>

                <div>
                    <Label label="Acc User Name" required />

                    <InputField
                        v-model="form.username"
                        type="tel"
                        name="Acc User Name"
                        placeholder="Enter your acc user name."
                        required
                    />

                    <ValidationError :message="errors?.username" />
                </div>

                <div>
                    <Label label="Description"  />

                    <InputField
                        v-model="form.description"
                        type="text"
                        name="description"
                        placeholder="Enter description"
                        
                    />

                    <ValidationError :message="errors?.description" />
                </div>
            </div>

            <div class="flex items-center justify-end space-x-5">
                <InertiaLinkButton
                    :href="route('admin.users.index')"
                    class="bg-gray-600 hover:bg-gray-700 text-white"
                >
                    Cancel
                </InertiaLinkButton>

                <FormButton
                    type="submit"
                    :processing="processing"
                    :disabled="processing"
                >
                    {{ mode === "create" ? "Create" : "Save Changes" }}
                </FormButton>
            </div>
        </form>
    </div>
</template>
