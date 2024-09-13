import { computed, ref,reactive } from 'vue';
import { router } from '@inertiajs/vue3';
// import { createToaster } from '@meforma/vue-toaster';
import { emitter } from '@/Helpers/emitter';
import { useField, useForm } from 'vee-validate';

export function useCRUDOperations(initialFormFields = {}, validationSchema = {},preserveScroll = true) {
    // const toast = createToaster();
    const processing = ref(false);
    const backendErrors = ref(null);

    const confirmation = {
        title: 'Delete Action',
        body: 'Are you sure you would like to do this ?',
    };

    // Initialize Form and Fields For Frontend Validation
    const { handleSubmit, errors:frontendErrors } = useForm({
        validationSchema: validationSchema ?? undefined,
        initialValues: initialFormFields,
    });

    // Define individual fields using useField from vee validate
    const form = reactive({});
    Object.keys(initialFormFields).forEach((key) => form[key] = useField(key).value);


    // Get Values from From
    // const getFormValues = () => {
    //     return Object.fromEntries(
    //         Object.entries(form).map(([key, { value }]) => [key, value?.value])
    //     );
    // };


    // Create Action
    const create = (model, url,onSuccess = () => {}) => {
        return handleSubmit((values)=>{
            processing.value = true;
            router.post(url,
                {
                    ...values
                },
                {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        if (backendErrors.value) backendErrors.value = null;
                        // if(model=='Settings'){
                        //     toast.success(`${model} saved successfully.`);
                        // }else{
                        //     toast.success(`${model} created successfully.`);
                        // }
                        onSuccess()
                    },
                    onFinish: () => (processing.value = false),
                    onError: (errors) => {
                        backendErrors.value = errors;
                    }
                }
            );
        })();
    };

    // Edit Action
    const edit = (model, url, method = 'put') => {
        console.log(url);
        handleSubmit(()=>{
            // console.log(form);
            // console.log(values);
            processing.value = true;
            router.post(
                url,
                {
                    _method: method === 'put' || method === 'patch' ? method : undefined,
                    // ...getFormValues()
                    ...form
                },
                {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        if (backendErrors.value) backendErrors.value = null;
                        // toast.success(`${model} updated successfully.`);
                    },
                    onFinish: () => (processing.value = false),
                    onError: (errors) => {
                        backendErrors.value = errors;
                    }
                }
            );
        })();

    };

    // Delete Action
    const destroy = async(model, url, confirmationOptions = null) => {
        emitter.emit('open-confirmation-dialog', {
            title: confirmationOptions?.title ?? (model === 'Membership' ? 'Inactivate membership' : `Delete ${model}`),
            body: confirmationOptions?.body ?? confirmation.body,
            confirmLabel: 'Confirm',
            cancelLabel: 'Cancel',
            confirmBtnClass:'!bg-red-600',
            svgIcon: 'warning',
            onConfirm: () => {
                router.delete(url, {
                    preserveScroll: true,
                    onSuccess: () => {
                        emitter.emit('close-confirmation-dialog');
                        // toast.success(model === 'Membership' ? 'Membership inactivated successfully.':`${model} deleted successfully.`);
                    },
                });
            },
        });
    };

    // Restore Action
    const restore = async(model, url, confirmationOptions = null) => {
        emitter.emit('open-confirmation-dialog', {
            title: confirmationOptions?.title ?? (model === 'Membership' ? 'Activate membership' : `Restore ${model}`),
            body: confirmationOptions?.body ?? confirmation.body,
            confirmLabel: 'Confirm',
            cancelLabel: 'Cancel',
            confirmBtnClass:'!bg-primary',
            svgIcon: 'question',
            onConfirm: () => {
                router.post(url,{},{
                    preserveScroll: true,
                    onSuccess: () => {
                        emitter.emit('close-confirmation-dialog');
                        // toast.success(model === 'Membership' ? 'Membership activated successfully.':`${model} restored successfully.`);
                    },
                });
            },
        });
    };

    const errors = computed(() => ({ ...frontendErrors?.value, ...backendErrors?.value }));
    const isFormValid = computed(() => Object.values(form).every(field => field.value !== undefined && field.value !== ''));

    return {
        form,
        errors,
        processing,
        create,
        edit,
        destroy,
        restore,
        isFormValid
    };
}
