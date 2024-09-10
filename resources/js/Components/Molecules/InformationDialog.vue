<template>
    <Modal :open="isOpen" @closeModal="handleCloseModal" can-close-backdrop>
        <div class="w-full py-5 space-y-8 md:px-0 px-6">
            <template v-if="type==='Review'">
                <ReviewInformation :review="data"/>
            </template>
            <template v-if="type==='Terms And Conditions'">
                <TermsAndConditionsInformation :termAndCondition="data"/>
            </template>
            <template v-if="type==='Support Ticket'">
                <SupportTicketInformation :supportTicket="data"/>
            </template>

            <NormalButton @click="handleCloseModal" class="w-full bg-primary text-white">
                <i class="fa-solid fa-xmark mr-1.5"></i>
                Close
            </NormalButton>
        </div>
    </Modal>
</template>

<script setup>
import { ref } from 'vue';
import { emitter } from '@/Helpers/emitter';
import Modal from '@/Components/Atoms/Modal.vue';
import ReviewInformation from '@/Components/Organisms/ReviewInformation.vue';
import TermsAndConditionsInformation from '@/Components/Organisms/TermsAndConditionsInformation.vue';
import SupportTicketInformation from '@/Components/Organisms/SupportTicketInformation.vue';
import NormalButton from '@/Components/Atoms/NormalButton.vue';

const isOpen = ref(false);
const data=ref(null);
const type=ref('');

const handleCloseModal = () => {
    isOpen.value = false;
};

emitter.on('open-information-dialog', (item) => {
    isOpen.value = true;
    data.value = item.data;
    type.value = item.type;
});
</script>
