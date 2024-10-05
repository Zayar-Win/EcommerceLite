<script setup>
import Label from "@/Components/Atoms/Label.vue";
import InputField from "@/Components/Atoms/InputField.vue";
import Textarea from "@/Components/Atoms/Textarea.vue";
import ValidationError from "@/Components/Atoms/ValidationError.vue";
import FormButton from "@/Components/Atoms/FormButton.vue";
import { useCRUDOperations } from "@/Composables/useCRUDOperations";
import { onMounted, computed } from "vue";
import InertiaLinkButton from "@/Components/Atoms/InertiaLinkButton.vue";
import SelectBox from "@/Components/Atoms/SelectBox.vue";
import { productSchema } from "@/Schemas/productSchema";
import FilePond from '@/Components/Atoms/FilePond.vue';

const props = defineProps({
    mode: {
        type: String,
        default: "create",
        validator: (value) => ["create", "edit"].includes(value),
    },
    product: {
        type: Object,
        required: true,
    },
    categories: {
        type: Object,
        required: true,
        default: () => ({})
    },
});
// console.log(props.product.images)
// const handleImages=computed()=>{

// }
// const schema = computed(() => (props.mode === 'create' ? userCreateSchema : userEditSchema));
const { form, create, edit, errors, processing } = useCRUDOperations(
        {
        name: props.product?.name || "",
        description: props.product?.description || "",
        price: props.product?.price || "",
        discount: props.product?.discount || "",
        category_id: props.product?.category_id || "",
        images: props.product?.images ? props.product?.images.map(image => image.url) : [],
    },
    productSchema
);

    // if (props.product && props.mode === "edit") {
    //     form.name = props.product.name;
    //     form.description = props.product.description;
    //     form.discount = props.product.discount;
    //     form.price = props.product.price;
    //     // form.prority = props.product.prority;
    //     form.category_id = props.product.category_id;
    //     form.images = props.product.images;
    //     console.log("this is form.vue",form.images);
        
    // }

const isFormValid = computed(() => {
    const isCommonValid = form.name && form.category_id;
    return isCommonValid;
});

const handleAvatar = (files) => {
    if (files.length) {
        form.images = files.map(file => file);  
    } else {
        form.images = [];
    }
};

const categoryOptions = computed(() => 
    Object.entries(props.categories).map(([key, value]) => ({ label: value, value: key }))
);

const selectedCategory = computed(() => {
  return props.mode === "edit" ? form.category_id : null;
});
</script>

<template>
    <div class="border p-10 bg-white rounded-md">
        <form
            class="space-y-4 md:space-y-6"
            @submit.prevent="
                mode === 'create'
                    ? create('Product', route('admin.products.store'))
                    : edit(
                          'Product',
                          route('admin.products.update', { product })
                      )
            "
        >
        <div class="">
                <div class="image-wrapper">
                    <FilePond
                    mode="image"
                        name="image"
                        labelIdle="Click to choose image, or Drop files here..."
                        :allowMultiple="true"
                        :files="form.images"
                        :acceptedFileTypes="['image/*']"
                        :imageCropAspectRatio="'1:1'"
                        :imagePreviewHeight="300"
                        :imageResizeTargetWidth="300"
                        :imageResizeTargetHeight="300"
                        :maxFiles=5
                        @updateFile="handleAvatar"
                        ></FilePond>
                </div>
                <ValidationError :message="errors?.image" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <Label label="Product Name" required />

                    <InputField
                        v-model="form.name"
                        type="text"
                        name="product-name"
                        placeholder="Enter product name"
                        required
                    />

                    <ValidationError :message="errors?.name" />
                </div>

                <div class="" v-if="props.mode == 'create'">
                    <Label for="category" label="Category" required />
                    <SelectBox
                        id="category"
                        name="category"
                        v-model="form.category_id"
                        :options="categoryOptions"
                        :selected="selectedCategory"
                        placeholder="Select a category"
                        class="p-2 border w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    />
                    <ValidationError
                        class="mt-2"
                        :message="errors?.category_id"
                    />
                </div>

                <div>
                    <Label label="Price" required />

                    <InputField
                        v-model="form.price"
                        type="number"
                        name="price"
                        placeholder="Enter Price"
                        required
                    />

                    <ValidationError :message="errors?.price" />
                </div>

                <div>
                    <Label label="Discount" />

                    <InputField
                        v-model="form.discount"
                        type="text"
                        name="discount"
                        placeholder="Enter Discount"
                    />

                    <ValidationError :message="errors?.discount" />
                </div>

                
            </div>
            <div>
                <div>
                    <Label label="Description"  />

                    <Textarea
                        v-model="form.description"
                        placeholder="Enter Description"
                        
                    />

                    <ValidationError :message="errors?.description" />
                </div>
            </div>
            <div class="flex items-center justify-end space-x-5">
                <InertiaLinkButton
                    :href="route('admin.products.index')"
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
<style>
    .filepond--item {
    width: calc(20% - 0.5em);
}
</style>