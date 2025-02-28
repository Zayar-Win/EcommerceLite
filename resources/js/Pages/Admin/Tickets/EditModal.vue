<template>
    <Modal :open="open" @closeModal="closeModal" can-close-backdrop>
        <form
            class="text-black space-y-2 p-4"
        >
            <h1 class="text-xl font-bold mb-5">Detail Ticket</h1>
            <div class="mt-10">
                <Label label="Name" required />
                <InputField
                    :value="ticket?.name"
                    type="text"
                    disabled
                    name="display-name"
                    placeholder="Enter name"
                />
            </div>
            <div class="mt-10">
                <Label label="Email" required />
                <InputField
                    type="text"
                    :value="ticket?.email"
                    disabled
                    name="display-name"
                    placeholder="Enter name"
                />
            </div>
            <div class="mt-10">
                <Label label="Phone" required />
                <InputField
                    type="text"
                    :value="ticket?.phone"

                    disabled
                    name="display-name"
                    placeholder="Enter name"
                />
            </div>
            <div class="mt-10">
                <Label label="Message" required />
                <Textarea
                    name="message"
                    disabled
                    :value="ticket?.message"
                    
                    placeholder="Describe your cases"
                    required
                    class="w-full rounded-md border-[1px] outline-none border-gray-300"
                />
            </div>

            <div class="flex justify-end space-x-3 mt-10">
                <button
                    type="button"
                    @click="cancel"
                    class="bg-gray-300 text-black px-4 py-2 rounded mt-10"
                >
                    Close
                </button>
            </div>
        </form>
    </Modal>
</template>

<script>
import Modal from "@/Components/Atoms/Modal.vue";
import Label from "@/Components/Atoms/Label.vue";
import FormButton from "@/Components/Atoms/FormButton.vue";
import InputField from "@/Components/Atoms/InputField.vue";

export default {
    components: {
        Modal,
        Label,
        FormButton,
        InputField,
    },
    props: {
        open: {
            type: Boolean,
            required: true,
        },
        ticket: {
            type: Object,
            required: true,
        },
    },
    methods: {
        cancel() {
            this.$emit("closeModal");
        }
    }
};
</script>
