<script setup>
import { useCRUDOperations } from '@/Composables/useCRUDOperations';
import {  onMounted, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import * as yup from 'yup'

const user = ref(usePage().props.auth?.user);
const userSchema = yup.object({
    'name'  : yup.string().required().min(2),
    'email' : yup.string().email().required(),
    'phone' : yup.string().required().min(6),
    'address' : yup.string().required().min(4)
})

const { form, edit, errors, processing } = useCRUDOperations({
    name: '',
    email: '',
    phone: '',
    telegram : '',
    viber : '',
    fb_profile_link : '',
    address : '',
},userSchema);

onMounted(() => {
    if (user.value) {
        form.name = user.value.name;
        form.email = user.value.email;
        form.phone = user.value.phone;
        form.telegram = user.value.telegram;
        form.viber = user.value.viber;
        form.fb_profile_link = user.value.fb_profile_link;
        form.address = user.value.address;
        form.dob = user.value.dob;
    }
});

</script>

<template>
    <div data-cy="profile-details-form">
        <h1 class="font-bold text-2xl text-darkGray !mb-8">Profile Details</h1>
        <form
            @submit.prevent="
                edit('Profile', route('settings.profile.update', { user: user?.id }))
            "
        >
            <div class="space-y-5">
                <div>
                    <Label label="Display Name" required />
                    <InputField
                        data-cy="display-name-input"
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
                        name="email"
                        placeholder="Enter your email"
                        required
                    />
                    <ValidationError :message="errors?.name" />
                </div>
                <div>
                    <Label label="Phone" required />
                    <InputField
                        v-model="form.phone"
                        type="text"
                        name="phone"
                        placeholder="Enter your phone number"
                        required
                    />
                    <ValidationError :message="errors?.phone" />
                </div>
                <div>
                    <Label label="Telegram"  />
                    <InputField
                        v-model="form.telegram"
                        type="text"
                        name="telegram"
                        placeholder="Enter your telegram phone number"
                    />
                    <ValidationError :message="errors?.telegram" />
                </div>
                <div>
                    <Label label="Viber"  />
                    <InputField
                        v-model="form.viber"
                        type="text"
                        name="viber"
                        placeholder="Enter your viber phone number"
                    />
                    <ValidationError :message="errors?.viber" />
                </div>
                <div>
                    <Label label="FB Profile Link"  />
                    <InputField
                        v-model="form.fb_profile_link"
                        type="text"
                        name="fb_profile_link"
                        placeholder="Enter your FB Profile Link"
                    />
                    <ValidationError :message="errors?.fb_profile_link" />
                </div>
                <div>
                    <Label label="Address" required />
                    <InputField
                        v-model="form.address"
                        type="text"
                        name="address"
                        placeholder="Enter your address"
                        required
                    />
                    <ValidationError :message="errors?.address" />
                </div>
                <div class="flex items-center justify-end">
                    <FormButton data-cy="save-changes-btn"  :processing="processing" :disabled="processing || verifyCountDown">
                        <i class="fa-solid fa-save mr-1"></i>
                        Save Changes
                    </FormButton>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import SettingLayout from './Layouts/SettingLayout.vue';
import Label from '@/Components/Atoms/Label.vue';
import InputField from '@/Components/Atoms/InputField.vue';
import ValidationError from '@/Components/Atoms/ValidationError.vue';
import FormButton from '@/Components/Atoms/FormButton.vue';

export default {
    layout:SettingLayout,
};
</script>
