<script setup>
import Label from '@/Components/Atoms/Label.vue';
import InputField from '@/Components/Atoms/InputField.vue';
import ValidationError from '@/Components/Atoms/ValidationError.vue';
import FormButton from '@/Components/Atoms/FormButton.vue';
import { useForm, usePage } from '@inertiajs/vue3';


const form = useForm({
    current_password: '',
    new_password: '',
});

const updatePassword = () => {
    form.put(route('password.update',{user : usePage().props?.auth?.user}), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <div class="">
        <h1 class="font-bold text-2xl text-darkGray mb-3">Change Password</h1>

        <p class="text-sm text-darkGray mb-8 font-medium">
            Ensure your account is using a long, random password to stay secure.
        </p>

        <div data-cy="change-password-form">
            <form
                @submit.prevent="updatePassword"
            >
                <div class="space-y-5">
                    <div>
                        <Label label="Current Password" required />

                        <InputField
                            data-cy="current-password-input"
                            v-model="form.current_password"
                            type="password"
                            name="current-password"
                            placeholder="Enter current password"
                            required
                        />

                        <ValidationError :message="form.errors?.current_password" />
                    </div>
                    <div>
                        <Label label="New Password" required />

                        <InputField
                            data-cy="new-password-confirmation-input"
                            v-model="form.new_password"
                            type="password"
                            name="password-confirmation"
                            placeholder="New password"
                            required
                        />

                        <ValidationError :message="form.errors?.new_password" />
                    </div>

                    <div class="flex items-center justify-end">
                        <FormButton  data-cy="save-changes-btn" :processing="form.processing" :disabled="form.processing">
                            <i class="fa-solid fa-save mr-1"></i>
                            Save Changes
                        </FormButton>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import SettingLayout from './Layouts/SettingLayout.vue';

export default {
    layout:SettingLayout
};
</script>
