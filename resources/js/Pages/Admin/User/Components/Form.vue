<script setup>
import Label from "@/Components/Atoms/Label.vue";
import InputField from "@/Components/Atoms/InputField.vue";
import Textarea from "@/Components/Atoms/Textarea.vue";
import Datepicker from '@/Components/Atoms/Datepicker.vue';
import ValidationError from "@/Components/Atoms/ValidationError.vue";
import FormButton from "@/Components/Atoms/FormButton.vue";
import { useCRUDOperations } from "@/Composables/useCRUDOperations";
import { onMounted, computed } from "vue";
import InertiaLinkButton from "@/Components/Atoms/InertiaLinkButton.vue";
import SelectBox from '@/Components/Atoms/SelectBox.vue';

const props = defineProps({
    mode: {
        type: String,
        default: "create",
        validator: (value) => ["create", "edit"].includes(value),
    },
    user: {
        type: Object,
        required: true,
    },
    roles: {
        type: Object,
        required: true,
    },
});

// const syncCountryISO=ref(null);

const { form, create, edit, errors, processing } = useCRUDOperations({
    name: "",
    email: "",
    telegram: "",
    viber: "",
    fb_profile_link: "",
    password: "",
    password_confirmation: "",
    phone: "",
    dob: "",
    address: "",
    role_id: "",
});

onMounted(() => {
    if (props.user && props.mode === "edit") {
        form.name = props.user.name;
        form.email = props.user.email;
        form.password = "";
        form.password_confirmation = "";
        form.phone = props.user.phone;
        form.dob = props.user.dob;
        form.address = props.user.address;
        form.viber = props.user.viber;
        form.telegram = props.user.telegram;
        form.fb_profile_link = props.user.fb_profile_link;
        form.role_id = props.user.role_id;
    }
});

const isFormValid = computed(() => {
    const isCommonValid = form.name && form.email && form.phone && form.dob && form.address;
    if (props.mode === "create") {
        return isCommonValid && form.password && form.password_confirmation;
    }
    return isCommonValid;
});
</script>

<template>
    <div class="border p-10 bg-white rounded-md">
        <form
            class="space-y-4 md:space-y-6"
            @submit.prevent="
                mode === 'create'
                    ? create('User', route('admin.users.store'))
                    : edit('User', route('admin.users.update', { user }))
            "
        >
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <Label label="Display Name" required />

                    <InputField
                        v-model="form.name"
                        type="text"
                        name="display-name"
                        placeholder="Enter display name"
                        required
                    />

                    <ValidationError :message="errors?.name" />
                </div>

                <div>
                    <Label label="Email" required />

                    <InputField
                        v-model="form.email"
                        type="email"
                        name="email-address"
                        placeholder="Enter email address"
                        required
                    />

                    <ValidationError :message="errors?.email" />
                </div>

                <div>
                    <Label label="Phone" required />

                    <InputField
                        v-model="form.phone"
                        type="tel"
                        name="Phone Number"
                        placeholder="Enter Phone Number"
                        required
                    />

                    <ValidationError :message="errors?.phone_type" />
                </div>

                <div>
                    <Label label="Telegram"  />

                    <InputField
                        v-model="form.telegram"
                        type="text"
                        name="telegram"
                        placeholder="Enter Telegram Username"
                        
                    />

                    <ValidationError :message="errors?.telegram" />
                </div>

                
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div>
                    <Label label="Viber"  />

                    <InputField
                        v-model="form.viber"
                        type="text"
                        name="viber"
                        placeholder="Enter Viber Username"
                        
                    />

                    <ValidationError :message="errors?.viber" />
                </div>

              

                <div>
                    <Label label="Date of birth" />

                    <Datepicker v-model="form.dob" placeholder="Select date of birth" />

                    <ValidationError :message="errors?.dob" />
                </div>

                
                <div class="relative">
                    <Label label="Role" required />

                    <SelectBox
                        v-model="form.role_id"
                        name="phone-type"
                        :options="roles"
                        required
                        :selected="mode==='edit' && form?.role_id"

                    />

                    <ValidationError :message="errors?.role_id" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <Label label="Facebook Profile Link"  />

                    <Textarea
                        v-model="form.fb_profile_link"
                        placeholder="Enter Facebook Profile Link"
                        
                    />

                    <ValidationError :message="errors?.fb_profile_link" />
                </div>
                <div>
                    <Label label="Address" required />

                    <Textarea
                        v-model="form.address"
                       
                        placeholder="Enter Address"
                        required
                    />

                    <ValidationError :message="errors?.address" />
                </div>

                
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <Label label="Password" :required="mode === 'create'" />

                    <InputField
                        v-model="form.password"
                        type="password"
                        name="password"
                        placeholder="Enter password"
                        :required="mode === 'create'"
                    />

                    <ValidationError :message="errors?.password" />
                </div>

                <div>
                    <Label
                        label="Confirm Password"
                        :required="mode === 'create'"
                    />

                    <InputField
                        v-model="form.password_confirmation"
                        type="password"
                        name="confirm-password"
                        placeholder="Re-type password"
                        :required="mode === 'create'"
                    />
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
                    :disabled="processing || !isFormValid"
                >
                    {{ mode === "create" ? "Create" : "Save Changes" }}
                </FormButton>
            </div>
        </form>
    </div>
</template>
