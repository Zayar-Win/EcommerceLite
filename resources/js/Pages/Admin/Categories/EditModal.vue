<template>
    <Modal :open="open" @closeModal="closeModal" can-close-backdrop>
        <form
            class="text-black space-y-2 p-4"
            @submit.prevent="submit"
        >
            <h1 class="text-xl font-bold mb-5">Edit Category</h1>
            <div class="mt-10">
                <Label label="Display Name" required />
                <InputField
                    v-model="form.name"
                    type="text"
                    name="display-name"
                    placeholder="Enter category name"
                />
                <ValidationError :message="form.errors?.name" />
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
                    type="submit" :disabled="form.processing" :processing="form.processing"
                    class="w-[150px] bg-primary text-white mt-10"
                >
                    Save Changes
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
        category: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.category?.name,
            }),
        };
    },
    watch:{
        'category'(){
            this.form.name = this.category?.name
        }
    },
    methods: {
        submit() {
            this.form.put(route('admin.categories.update', this.category.id), {
                onSuccess: () => {
                    this.form.reset();
                    this.$emit('closeModal');
                },
            });
        },
        cancel() {
            this.$emit("closeModal");
        }
    }
};
</script>
