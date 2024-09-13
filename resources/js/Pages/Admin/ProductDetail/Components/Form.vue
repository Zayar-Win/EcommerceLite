<script setup>
import Label from "@/Components/Atoms/Label.vue";
import InputField from "@/Components/Atoms/InputField.vue";
import ValidationError from "@/Components/Atoms/ValidationError.vue";
import FormButton from "@/Components/Atoms/FormButton.vue";
import { useCRUDOperations } from "@/Composables/useCRUDOperations";
import { onMounted, computed } from "vue";
import InertiaLinkButton from "@/Components/Atoms/InertiaLinkButton.vue";
import SelectBox from "@/Components/Atoms/SelectBox.vue";
import { productDetailSchema } from "@/Schemas/productDetailSchema";

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
    sizes: {
        type: Object,
        required: true,
        default: () => ({})
    },
    productDetail:{
        type: Object,
    }
});
const productId = () => {
    if (props.mode == 'create') {
        return props.product?.id;
    } else {
        return props.productDetail?.product_id;
    }
}
console.log(props.productDetail)
const { form, create, edit, errors, processing } = useCRUDOperations(
    {
        size_id: props.productDetail?.size_id || "",
        discount: props.productDetail?.discount || "",
        price: props.productDetail?.price || "",
        stock_quantity: props.productDetail?.stock_quantity || "",
        product_id: productId(), 
    },
    productDetailSchema
);

const isFormValid = computed(() => {
    const isCommonValid = form.size_id && form.price && form.stock_quantity;
    return isCommonValid;
});

const sizesOptions = computed(() => 
    Object.entries(props.sizes).map(([key, value]) => ({ label: value, value: key }))
);

const selectedSize = computed(() => {
  return props.mode === "edit" ? form.size_id : null;
});
</script>

<template>
    <div class="border p-10 bg-white rounded-md">
        <form
            class="space-y-4 md:space-y-6"
            @submit.prevent="
                mode === 'create'
                    ? create('Product Detail', route('admin.product-details.store',{id : props.product.id}))
                    : edit(
                          'Product Detail',
                          route('admin.product-details.update', { productId: productId(), detailId: productDetail?.id })
                      )
            "
        >
       
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div class="">
                    <Label for="sizes" label="Size" required />
                    <SelectBox
                        id="sizes"
                        name="size"
                        v-model="form.size_id"
                        :options="sizesOptions"
                        :selected="selectedSize"
                        placeholder="Select a category"
                        class="p-2 border w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    />
                    <ValidationError
                        class="mt-2"
                        :message="errors?.size_id"
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
                    <Label label="Stock Quantity" required />

                    <InputField
                        v-model="form.stock_quantity"
                        type="number"
                        name="stock-quantity"
                        placeholder="Enter Stock Quantity"
                        required
                    />

                    <ValidationError :message="errors?.stock_quantity" />
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
           
            <div class="flex items-center justify-end space-x-5">
                <InertiaLinkButton
                    :href="route('admin.product-details.index',{id:productId()})"
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

</style>