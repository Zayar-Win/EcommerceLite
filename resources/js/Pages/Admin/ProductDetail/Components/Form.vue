<script setup>
import Label from "@/Components/Atoms/Label.vue";
// import InputField from "@/Components/Atoms/InputField.vue";
import ValidationError from "@/Components/Atoms/ValidationError.vue";
import FormButton from "@/Components/Atoms/FormButton.vue";
import { useCRUDOperations } from "@/Composables/useCRUDOperations";
import { onMounted, computed, watch, ref } from "vue";
import InertiaLinkButton from "@/Components/Atoms/InertiaLinkButton.vue";
import SelectBox from "@/Components/Atoms/SelectBox.vue";
import { productDetailSchema } from "@/Schemas/productDetailSchema";
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.css";
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
    attributes: {
        type: Array,
        required: true,
        default: () => [],
    },
    productDetail: {
        type: Object,
    },
});
const productId = () => {
    if (props.mode == "create") {
        return props.product?.id;
    } else {
        return props.productDetail?.product_id;
    }
};
console.log("this is attributes from props " + props.attributes);


// const isFormValid = computed(() => {
//     const isCommonValid = form.price && form.stock_quantity;
//     return isCommonValid;
// });

const attributesOptions = computed(() => {
    return Array.isArray(props.attributes)
        ? props.attributes.map((attribute) => ({
              id: attribute.id,
              name: attribute.name,
              options:
                  attribute.attribute_options.map((option) => ({
                      label: option.value,
                      value: option.id,
                  })) || [],
          }))
        : [];
});
// console.log(attributesOptions.value.attribute_options);
attributesOptions.value.forEach((options) => {
    console.log(options);
});

const tableColumns = ref(["Qty", "Price", "Discount Price","Action"]);
const variants = ref([{ qty: "", price: "", discount_price: "", attributes: {} }]);
const { form, create, edit, errors, processing } = useCRUDOperations(
    {
        attributes: props.productDetail?.attributes || [],
        // discount: props.productDetail?.discount || "",
        // price: props.productDetail?.price || "",
        // stock_quantity: props.productDetail?.stock_quantity || "",
        variants: variants.value,
        product_id: productId(),
    },
);
watch(
    () => form.attributes,
    (newAttributes) => {
        let newColumns = ["Qty", "Price", "Discount Price","Action"];

        newAttributes.forEach((attribute) => {
            newColumns.splice(newColumns.length - 4, 0, attribute.name);
        });

        tableColumns.value = newColumns;
    },
    { deep: true }
);

const addNewVariant = () => {
    variants.value.push({ qty: "", price: "", discount_price: "", attributes: [] });
};
const removeVariant = (index) => {
    variants.value.splice(index, 1);
};

</script>

<template>
    <div class="border p-10 bg-white rounded-md flex">
        <div>
            <img
                :src="`/storage/${product.images[0].url}`"
                alt="Product Image"
                class="w-[200px] h-auto"
            />
        </div>
        <div class="mx-5 grid gap-2">
            <p>Product Name : {{ product.name }}</p>
            <p>Price : {{ product.price }}</p>
            <p>Discount : {{ product.discount }}</p>
            <p>Description : {{ product.description }}</p>
        </div>
    </div>
    <div class="border p-10 bg-white rounded-md">
        <form
            class="space-y-4 md:space-y-6"
            @submit.prevent="
                mode === 'create'
                    ? create(
                          'Product Detail',
                          route('admin.product-details.store', {
                              id: props.product.id,
                          })
                      )
                    : edit(
                          'Product Detail',
                          route('admin.product-details.update', {
                              productId: productId(),
                              detailId: productDetail?.id,
                          })
                      )
            "
        >
            <div class="grid grid-cols-1  gap-5">
                <div class="">
                    <Label for="" label="Attributes" required />
                    <!-- <SelectBox
                        id="sizes"
                        name="size"
                        v-model="form.size_id"
                        :options="sizesOptions"
                        :selected="selectedSize"
                        placeholder="Select a category"
                        class="p-2 border w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    /> -->
                    <Multiselect
                        v-model="form.attributes"
                        :options="attributesOptions"
                        :multiple="true"
                        track-by="id"
                        label="name"
                        placeholder="Select Attributes"
                        class="block w-full p-0 rounded-md font-semibold text-sm text-black bg-gray-00 outline-none disabled:cursor-not-allowed transition-all focus:ring-2 focus:ring-slate-300 border border-gray-300 focus:border-slate-400': true"
                    />
                    <ValidationError
                        class="mt-2"
                        :message="errors?.attributes"
                    />
                </div>
                <!-- <div>
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
                </div> -->
            </div>
            <div>
                <div class="text-primary flex justify-end font-bold">
                    <p @click="addNewVariant" class="cursor-pointer">+ Add New Product Variant</p>
                </div>
            </div>
            <div>
                <table
                    class="min-w-full table-auto bg-white shadow-sm rounded-lg overflow-hidden border-collapse"
                >
                    <thead class="bg-secondary text-white rounded-lg">
                        <tr>
                            <th
                                v-for="(column, index) in tableColumns"
                                :key="index"
                                class="px-4 py-5 text-left"
                            >
                                {{ column }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(variant, index) in variants"
                            :key="index"
                            class="border-b hover:bg-gray-100"
                        >
                            <td
                                v-for="(attribute, idx) in form.attributes"
                                :key="idx"
                                class="px-4 py-2"
                            >
                                <!-- <input
                                    v-model="variant[attribute.name]"
                                    type="text"
                                    :placeholder="attribute.name"
                                    class="border p-2 rounded-md w-full"
                                /> -->
                                <SelectBox
                                    v-model="variant[attribute.name]"
                                    :options="
                                        attributesOptions.find(
                                            (attr) => attr.id === attribute.id
                                        )?.options || []
                                    "
                                    class="p-2 border w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                />
                            </td>
                            <td class="px-4 py-2">
                                <input
                                    v-model="variant.qty"
                                    type="number"
                                    placeholder="Qty"
                                    class="border p-2 rounded-md w-full"
                                />
                            </td>
                            <td class="px-4 py-2">
                                <input
                                    v-model="variant.price"
                                    type="number"
                                    placeholder="Price"
                                    class="border p-2 rounded-md w-full"
                                />
                            </td>
                            <td class="px-4 py-2">
                                <input
                                    v-model="variant.discount_price"
                                    type="number"
                                    placeholder="Discount Price"
                                    class="border p-2 rounded-md w-full"
                                />
                            </td>
                            <td class="px-4 py-2 text-center">
                        <button
                            @click="removeVariant(index)"
                            class="text-red-600 hover:text-red-800"
                        >
                            <i class="fas fa-trash"></i> 
                        </button>
                    </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-end space-x-5">
                <InertiaLinkButton
                    :href="
                        route('admin.product-details.index', {
                            id: productId(),
                        })
                    "
                    class="bg-gray-600 hover:bg-gray-700 text-white"
                >
                    Cancel
                </InertiaLinkButton>

                <FormButton
                    type="submit"
                    :processing="processing"
                    :disabled="processing "
                >
                    {{ mode === "create" ? "Create" : "Save Changes" }}
                </FormButton>
            </div>
        </form>
    </div>
</template>
<style></style>
