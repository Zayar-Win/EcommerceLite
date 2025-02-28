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
import { createToaster } from "@meforma/vue-toaster";
import { router } from "@inertiajs/vue3";
import CreateModal from "../../Attributes/CreateModal.vue";
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
    previousAttributes : {
        type : Array
    }
});
const productId = () => {
    if (props.mode == "create") {
        return props.product?.id;
    } else {
        return props.productDetail?.product_id;
    }
};

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

console.log(attributesOptions.value)

let generateTableColumns = () => {
    let columns = ["Qty", "Price", "Action"];

    props.previousAttributes.forEach(attribute => {
        columns.unshift(attribute);
    })
    return columns;
}

const tableColumns = ref(generateTableColumns());


let generateVariantAttributes = () => {
    let attributes = {};
    props.previousAttributes.forEach(attribute => {
        if(props.productDetail){
            attributes[attribute] = props.productDetail?.attribute_options.filter(option => attribute == option?.attribute?.name)[0].id
        }else{
            attributes[attribute] = ''
        }
    })
    return attributes;
}

const generateDefaultAttributes = () => {
    let attributes = [];
    props.previousAttributes.forEach(attribute => {
        attributes.push(attributesOptions.value.filter(attributeOption => attributeOption?.name == attribute)[0])
    })
    return attributes
}


const showCreateModal = ref(false);

const closeCreateModal = () => {
    showCreateModal.value = false
}

const variants = ref([{ qty:props.productDetail ? props.productDetail?.stock_quantity : "", price: props.productDetail ? props.productDetail?.price : "", discount_price:props.productDetail ? props.productDetail?.discount :  "", attributes: generateVariantAttributes() }]);
let alreadyHasVariants = ref([]);
const { form, edit,create, errors, processing } = useCRUDOperations(
    {
        attributes: generateDefaultAttributes(),
        variants: variants.value,
        product_id: productId(),
    },
);

watch(
    () => form.attributes,
    (newAttributes) => {
        let newColumns = ["Qty", "Price", "Action"];
        newAttributes.forEach((attribute) => {
            newColumns.splice(newColumns.length - 3, 0, attribute.name);
        });

        form.variants = form.variants.map(variant => {
            let attributes = {};
            newAttributes.forEach(attribute => {
                if(Object.keys(variant.attributes).includes(attribute.name)){
                    attributes[attribute.name] = variant.attributes[attribute.name]
                }else{
                    attributes[attribute.name] = ''
                }
            })
            return {
                ...variant,
                attributes
            }
        })

        tableColumns.value = newColumns;

    },
    { deep: true }
);

const areAttributeValuesEqual = (mainAttributes,checkAttributes)  => {
    let mainKeys = Object.keys(mainAttributes);
    for(let key of mainKeys){
        if(mainAttributes[key] && checkAttributes[key]){
            if(mainAttributes[key] !== checkAttributes[key]){
                return false;
            }
        }else{
            return false;
        }
    }
    return true;
}

watch(
    () => form.variants,
    (newVariants) => {
        let variantAttributes = newVariants.map(variant => variant.attributes)
        let shouldGiveDefaultValue = true;
        alreadyHasVariants.value = []
        for(let i = 0 ; i < variantAttributes.length ; i++){
            for (let j = i + 1 ; j < variantAttributes.length ; j++){
                if(variantAttributes[i] && variantAttributes[j]){
                    if(areAttributeValuesEqual(variantAttributes[i],variantAttributes[j])){
                        shouldGiveDefaultValue  = false;
                        alreadyHasVariants.value.push(i)
                        alreadyHasVariants.value.push(j);
                    }
                }
            }
        }
        if(shouldGiveDefaultValue){
            alreadyHasVariants.value = []
        }

    } ,{
        deep:true
    }
)

watch(
    () => alreadyHasVariants,
    (newValue) => {
        if(newValue.value.length){
            const toaster = createToaster({
                position: 'bottom-right',
                useDefaultCss: true,
                maxToasts: 1,
            })
            toaster.clear()
            toaster.error('You have duplicated varient.Please check again.')
        }
    },
    {
        deep:true
    }
)


const addNewVariant = () => {
    let attributes = {}
    form.attributes.forEach((attribute) => {
        attributes[attribute.name] = ''
    })
    form.variants.push({ qty: "", price: "", discount_price: "", attributes  });
};
const removeVariant = (index) => {
    form.variants.splice(index, 1);
};

</script>

<template>
    <!-- <div class="border p-10 bg-white rounded-md flex">
        <div>
            <img
                :src="product.images[0].url"
                alt="Product Image"
                class="w-[200px] h-auto"
            />
        </div>
        <div class="mx-5  gap-2">
            <p>Product Name : {{ product.name }}</p>
            <p>Description : {{ product.description }}</p>
        </div>
    </div> -->
    <div class="border p-10 bg-white rounded-md">
        <form
            class="space-y-4 md:space-y-6"
            @submit.prevent="
                mode === 'create'
                    ? create('Product Detail',
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
            <div v-if="!previousAttributes.length &&  mode == 'create'" class="grid grid-cols-1  gap-5">
                    <div class="">
                        <div class="flex items-center justify-between">
                        <Label class="w-max " for="" label="Attributes" required />
                            <p @click="showCreateModal = true" class="cursor-pointer text-sm font-semibold">
                                Add New Attribute
                            </p>
                    </div>
                    <Multiselect
                        v-model="form.attributes"
                        :options="attributesOptions"
                        :multiple="true"
                        track-by="id"
                        :show-labels="false"
                        label="name"
                        :hide-selected="true"
                        placeholder="Select Attributes"
                        class="block w-full p-0  rounded-md font-semibold text-sm text-primary bg-gray-00 outline-none disabled:cursor-not-allowed transition-all focus:ring-2 focus:ring-slate-300 border border-gray-300 focus:border-slate-400': true"
                    />
                    <ValidationError
                        class="mt-2"
                        :message="errors?.attributes"
                    />
                </div>
            </div>
            <div v-if="mode == 'create'">
                <div class="text-primary flex justify-end font-bold">
                    <p @click="addNewVariant" class="cursor-pointer">+ Add New Product Variant</p>
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <table
                    class="min-w-full table-auto bg-white shadow-sm rounded-lg overflow-hidden border-collapse"
                >
                    <thead class="bg-primary text-white rounded-lg">
                        <tr>
                            <th
                                v-for="(column, index) in tableColumns"
                                :key="index"
                                class="px-4 py-5 text-left min-w-[200px]"
                            >
                                {{ column }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(variant, index) in form.variants"
                            :key="index"
                            class="border-b hover:bg-gray-100"
                            :class="[alreadyHasVariants.includes(index) ? 'shake' : '']"
                        >
                            <td
                                v-for="(attributeKey, idx) in Object.keys(variant.attributes)"
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
                                    v-model="variant.attributes[attributeKey]"
                                    :selected="mode == 'create' ? null : variant.attributes[attributeKey]"
                                    :options="
                                        attributesOptions.find(
                                            (attr) => attr.name === attributeKey
                                        )?.options || []
                                    "
                                    class="p-2 border w-full  rounded-md shadow-sm"
                                    :class="[alreadyHasVariants.includes(index) ? 'border-red-500 focus focus:border-red-500 focus:ring-red-500'  : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500']"
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
                            <!-- <td class="px-4 py-2">
                                <input
                                    v-model="variant.discount_price"
                                    type="number"
                                    placeholder="Discount Price"
                                    class="border p-2 rounded-md w-full"
                                />
                            </td> -->
                            <td class="px-4 py-2 ">
                        <button
                        type="button"
                            @click="removeVariant(index)"
                            :disabled="mode == 'edit'"
                            class="text-red-600 hover:text-red-800"
                            :class="[mode == 'edit' ? 'cursor-not-allowed pointer-events-none' : 'pointer-events-auto']"
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
                    :disabled="processing || alreadyHasVariants.length"
                >
                    {{ mode === "create" ? "Create" : "Save Changes" }}
                </FormButton>
            </div>
        </form>
        <CreateModal 
            :open="showCreateModal"
            @closeModal="closeCreateModal"
            :href="route('admin.attributes.create')"
        />
    </div>
</template>
<style>
.multiselect__tag {
  background-color: #0285FF; /* Your desired color */
}


/* Change background color when option is highlighted (hovered) */
.multiselect__option--highlight {
  background-color: #0285FF; /* Your desired highlight color */
}

.multiselect__option--selected.multiselect__option--highlight[data-deselect="Selected"] { background:#f3f3f3; color:unset;
  &:after { background:unset; color:unset; }
}
</style>
