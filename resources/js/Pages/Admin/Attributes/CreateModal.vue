<template>
    <Modal :open="open" @closeModal="closeModal" can-close-backdrop>
        <form class="text-black space-y-2 p-4" @keydown="e => {
            if(e.key == 'Enter'){
                e.preventDefault();
            }
        }" @submit.prevent="submit">
            <h1 class="text-xl font-bold mb-5">Create Attribute</h1>
            <div class="mt-10">
                <Label label="Display Name" required />
                <InputField
                    v-model="form.name"
                    type="text"
                    name="display-name"
                    placeholder="Enter display name"
                    @input="form.name = form.name.toLowerCase()"
                />
                <ValidationError :message="form.errors?.name" />
            </div>

            <div class="mt-5">
                <div class="flex justify-end mt-5">
                    <button
                        type="button"
                        @click="addValue"
                        class="bg-blue-500 text-white px-1 py-1 w-[150px] rounded"
                    >
                        + Add Value
                    </button>
                </div>
                <Label label="Values" />
                <div
                    v-for="(value, index) in form.values"
                    :key="index"
                    class="mb-2 flex items-center"
                >
                    <InputField
                        v-model="form.values[index]"
                        type="text"
                        placeholder="Enter value"
                        @keyup.enter="addValue"
                    />
                    <button
                        type="button"
                        @click="removeValue(index)"
                        class="ml-4"
                    >
                        <i class="fas fa-trash-alt text-red-500"></i>
                    </button>
                </div>
                <ValidationError :message="form.errors?.values" />
            </div>

            <div class="flex justify-end space-x-3 mt-10">
                <button
                    type="button"
                    @click="cancel"
                    class="bg-gray-300 text-black px-4 py-2 rounded mt-10"
                >
                    Cancel
                </button>
                <FormButton
                :disabled="form.processing"
                    :processing="form.processing"
                    type="submit"
                    class="w-[150px] bg-primary text-white mt-10"
                >
                    Create
                </FormButton>
            </div>
        </form>
    </Modal>
</template>

<script>
import Modal from "@/Components/Atoms/Modal.vue";
import Label from "@/Components/Atoms/Label.vue";
import FormButton from "@/Components/Atoms/FormButton.vue";
import InputField from "@/Components/Atoms/InputField.vue";
import ValidationError from "@/Components/Atoms/ValidationError.vue";
// Import useCRUDOperations if needed
// import { useCRUDOperations } from "@/Composables/useCRUDOperations";

export default {
    components: {
        Modal,
        Label,
        FormButton,
        InputField,
        ValidationError,
    },
    props: {
        open: {
            type: Boolean,
            required: true,
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                name: "",
                values: [""],
            }),
        };
    },
    methods: {
        addValue() {
            this.form.values.push("");
        },
        removeValue(index) {
            this.form.values.splice(index, 1);
        },
        submit() {
            this.form.name = this.form.name.toLowerCase();
            if (this.form.name.trim() === "") {
                this.form.errors.name = "Display Name cannot be empty";
                return;
            }

            if (
                this.form.values.filter((value) => value.trim() !== "")
                    .length === 0
            ) {
                this.form.errors.values = "You must provide at least one value";
                return;
            }
            this.form.post(this.route("admin.attributes.store"), {
                onSuccess: () => {
                    this.form.reset();
                    this.$emit("closeModal");
                },
            });
        },
        cancel() {
            this.$emit("closeModal");
        },
    },
};
</script>
