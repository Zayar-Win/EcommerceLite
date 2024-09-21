<template>
    <Modal data-cy="confirmation-modal" :open="isOpen" @closeModal="handleCloseModal" :can-close-backdrop="dialogOptions.allowClickOutside">
        <form class="p-5 space-x-3" @submit.prevent="confirmDialog">
            <ConfirmWarning v-if="dialogOptions.svgIcon === 'warning'" class="mx-auto mb-5" />
            <h1 class="text-center font-semibold text-lg text-darkGray mb-5 text-black" :class="dialogOptions.titleClass">
                {{ dialogOptions.title }}
            </h1>
            <div v-if="dialogOptions.body">
                <p class="text-center my-2 font-medium text-gray-600">
                    {{ dialogOptions.body }}
                </p>
            </div>
            <slot name="message" />
            <div class="flex items-center mt-8 justify-center space-x-8">
                <NormalButton
                    data-cy="cancel-btn"
                    :disabled="processing"
                    class="!px-5 !shadow-none !rounded-md !bg-gray-500 !text-white"
                    :class="{
                        'w-15': $page.props.language === 'en',
                        'w-40': $page.props.language !== 'en',
                        [dialogOptions.cancelBtnClass]: true,
                    }"
                    @click="handleCloseModal"
                >
                    {{ dialogOptions.cancelLabel }}
                </NormalButton>
                <FormButton
                    data-cy="confirm-btn"
                    :processing="processing"
                    :disabled="processing"
                    class="!px-5 !shadow-none !rounded-md"
                    :class="{
                        'w-15': $page.props.language === 'en',
                        'w-40': $page.props.language !== 'en',
                        [dialogOptions.confirmBtnClass]: true,
                    }"

                >
                    {{ dialogOptions.confirmLabel }}
                </FormButton>
            </div>
        </form>
    </Modal>
</template>

<script setup>
import { ref, reactive, watch } from 'vue';
import { emitter } from '@/Helpers/emitter';
import Modal from '@/Components/Atoms/Modal.vue';
import NormalButton from '@/Components/Atoms/NormalButton.vue';
import FormButton from '@/Components/Atoms/FormButton.vue';
import ConfirmWarning from '@/Components/Icons/ConfirmWarning.vue';

const props = defineProps({
    title: {
        type: String,
        default: 'Are you Sure You Want to Delete this?',
    },
    body: {
        type: String,
        default: '',
    },
    confirmLabel: {
        type: String,
        default: 'Yes',
    },
    cancelLabel: {
        type: String,
        default: 'No',
    },
    confirmBtnClass: {
        type: String,
        default: '!bg-red-600',
    },
    cancelBtnClass: {
        type: String,
        default: '!bg-gray-100 border !text-black',
    },
    titleClass: {
        type: String,
        default: 'text-xl font-semibold',
    },
    svgIcon: {
        type: String,
        default: '',
    },
    allowClickOutside:{
        type:Boolean,
        default:false
    }
});

const isOpen = ref(false);
const processing = ref(false);
const dialogOptions = reactive({
    title: props.title,
    body: props.body,
    confirmLabel: props.confirmLabel,
    cancelLabel: props.cancelLabel,
    confirmBtnClass: props.confirmBtnClass,
    cancelBtnClass: props.cancelBtnClass,
    titleClass: props.titleClass,
    svgIcon: props.svgIcon,
    allowClickOutside: props.allowClickOutside,
});

let onConfirmCallback = null;

watch(() => props, (newProps) => {
    Object.assign(dialogOptions, newProps);
}, { deep: true });


const handleCloseModal = () => {
    isOpen.value = false;
};

const confirmDialog = () => {
    if (typeof onConfirmCallback === 'function') {
        onConfirmCallback();
        processing.value=true;
    };

    // handleCloseModal();
};

// Listen for 'open-confirmation-dialog' events
emitter.on('open-confirmation-dialog', (options) => {
    console.log('open confirmation dialog')
    Object.assign(dialogOptions, options);
    onConfirmCallback = options.onConfirm || null;
    isOpen.value = true;
});

// Listen for 'close-confirmation-dialog' events
emitter.on('close-confirmation-dialog', () => {
    isOpen.value = false;
    processing.value=false;
});
</script>
