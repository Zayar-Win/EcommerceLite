import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
// import { createToaster } from '@meforma/vue-toaster';
import { emitter } from '@/Helpers/emitter';

export function useCRUDOperations(initialFormFields = {})
{
    // const toast = createToaster();
    const processing = ref(false);
    const errors = ref(null);

    const confirmation = {
        title: 'Delete Action',
        body: 'Are you sure you would like to do this ?',
    };

    // Dynamic Form Fields For ( Create and Edit )
    const form = useForm({ ...initialFormFields });

    //  Create Action
    const create = async(model, url) => {
        processing.value = true;
        router.post(
            url,
            {
                ...form
            },
            {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    if (errors.value) {
                        errors.value = null;
                    }
                    if (model == 'Settings') {
                        toast.success(`${model} saved successfully.`);
                    } else {
                        toast.success(`${model} created successfully.`);
                    }
                },
                onFinish: () => (processing.value = false),
                onError: (backendErrors) => {
                    errors.value = backendErrors;
                }
            }
        );
    };

    // Edit Action
    const edit = async(model, url, method = 'patch') => {
        processing.value = true;
        router.post(
            url,
            {
                _method: method === 'put' || method === 'patch' ? method : undefined,
                ...form
            },
            {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    if (errors.value) {
                        errors.value = null;
                    }
                    toast.success(`${model} updated successfully.`);
                },
                onFinish: () => (processing.value = false),
                onError: (backendErrors) => {
                    errors.value = backendErrors;
                }
            }
        );
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
                        toast.success(model === 'Membership' ? 'Membership inactivated successfully.':`${model} deleted successfully.`);
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
                        toast.success(model === 'Membership' ? 'Membership activated successfully.':`${model} restored successfully.`);
                    },
                });
            },
        });
    };

    return {
        form,
        errors,
        processing,
        create,
        edit,
        destroy,
        restore
    };
}
