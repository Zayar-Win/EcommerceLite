<script setup>
import Delete from "@/assets/icons/Delete.vue";
import Edit from "@/assets/icons/Edit.vue";
import DashboardTableDataSearchBox from "@/Components/Admin/DashboardTableDataSearchBox.vue";
import InertiaLinkButton from "@/Components/Admin/InertiaLinkButton.vue";
import NormalButton from "@/Components/Admin/NormalButton.vue";
import TableActionCell from "@/Components/Admin/TableActionCell.vue";
import SortableTableHeaderCell from "@/Components/Common/SortableTableHeaderCell.vue";
import Table from "@/Components/Common/Table.vue";
import TableContainer from "@/Components/Common/TableContainer.vue";
import TableDataCell from "@/Components/Common/TableDataCell.vue";
import TableHeaderCell from "@/Components/Common/TableHeaderCell.vue";
import Breadcrumb from "@/Components/Molecules/Breadcrumb.vue";
import { useCRUDOperations } from "@/Composables/useCRUDOperations";

const props = defineProps({
    productDetails: {
        type: Object,
        default: null,
    },
    sizes: {
        type: Object,
        default: null,
    },
    product: {
        type: Object,
        default: null,
    },
    attributeOptions : {
        type : Array ,
    }
});

console.log(props.productDetails)



const { destroy } = useCRUDOperations();
</script>

<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex flex-col sm:flex-row items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb
                icon="fa-box"
                label="Product Details"
                :href="
                    route('admin.product-details.index', { product: product?.id })
                "
            >
                <BreadcrumbItem label="Lists" />
            </Breadcrumb>

            <!-- Create Button -->
            <div class="min-w-[270px] flex justify-end">
                <InertiaLinkButton
                    :href="
                        route('admin.product-details.create', {
                            id: product?.id,
                        })
                    "
                >
                    <i class="fa-solid fa-file-circle-plus mr-1"></i>
                    Create
                </InertiaLinkButton>
            </div>
        </div>
        <div
            class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 px-5 py-3"
        >
            <!-- <Head title="Users" /> -->
            <div
                class="my-3 flex sm:flex-row space-y-5 sm:space-y-0 items-center justify-center sm:justify-between overflow-auto p-1"
            >
                <DashboardTableDataSearchBox
                    placeholder="Search by price"
                    :href="
                        route('admin.product-details.index', {
                            product: product?.id,
                        })
                    "
                />

            </div>
            <TableContainer
                :data-count="productDetails?.data?.length"
                :paginate-links="productDetails.links"
            >
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="productDetails.data">
                            <template #table-header>
                                <SortableTableHeaderCell
                                    class="min-w-[100px]"
                                    label="ID"
                                    sort="id"
                                    :url="
                                        route('admin.product-details.index', {
                                            product: product?.id,
                                        })
                                    "
                                />
                                <TableHeaderCell
                                label="Name"
                                />

                                <TableHeaderCell v-for="attribute in attributeOptions" :label="attribute" :key="attribute" />

                                <SortableTableHeaderCell
                                    label="Price"
                                    sort="price"
                                    :url="
                                        route('admin.product-details.index', {
                                            product: product?.id,
                                        })
                                    "
                                />
                                
                                <SortableTableHeaderCell
                                    label="Stock Quantity"
                                    sort="stock_quantity"
                                    :url="
                                        route('admin.product-details.index', {
                                            product: product?.id,
                                        })
                                    "
                                />

                                <SortableTableHeaderCell
                                    label="Discount"
                                    sort="discount"
                                    :url="
                                        route('admin.product-details.index', {
                                            product: product?.id,
                                        })
                                    "
                                />

                                <TableHeaderCell label="Actions" />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell class="">
                                    {{ item.id }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[200px]">
                                    <div class="flex items-center gap-2">
                                        <img class="w-[40px] h-[40px] object-cover" :src="product?.images[0].url" />
                                        <p>
                                            {{ product?.name }}
                                        </p>
                                    </div>
                                </TableDataCell>
                                <!-- <TableDataCell class="min-w-[200px]">
                                    <div class="flex items-center space-x-2">
                                        <div>
                                            <p>
                                                {{ item.product_detail.stock_quantity }}
                                            </p>
                                        </div>
                                    </div>
                                </TableDataCell> -->
                                
                                <TableDataCell v-for="attribute in attributeOptions" :key="attribute" class="min-w-[200px]">
                                    {{ item.attribute_options.filter(option => option?.attribute?.name == attribute)[0]?.value }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[150px]">
                                    {{ item.price }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[150px]">
                                    {{ item.stock_quantity }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[150px]">
                                    {{ item.discount }}
                                </TableDataCell>

                                <TableActionCell class="min-w-[350px]">
                                    <InertiaLinkButton
                                        :href="
                                            route(
                                                'admin.product-details.edit',
                                                {
                                                    productId: product?.id,
                                                    detailId: item?.id,
                                                }
                                            )
                                        "
                                        class="bg-blue-600 !py-1 flex gap-1 items-center hover:bg-blue-700 text-white !text-xs !font-semibold"
                                    >
                                        <Edit class="w-[20px]" />
                                        Edit
                                    </InertiaLinkButton>
                                    <NormalButton
                                        type="button"
                                        @click="
                                            destroy(
                                                'Product',
                                                route(
                                                    'admin.product-details.destroy',
                                                    {
                                                        productId: product?.id,
                                                        detailId: item?.id,
                                                    }
                                                )
                                            )
                                        "
                                        class="bg-red-600 flex items-center gap-1 !py-1 hover:bg-red-700 text-white !text-xs !font-semibold"
                                    >
                                        <Delete class="w-[20px]" />
                                        Delete
                                    </NormalButton>
                                </TableActionCell>
                            </template>
                        </Table>
                    </div>
                </template>
            </TableContainer>
            <InertiaLinkButton
                class="flex items-center mt-5 bg-gray-600 hover:bg-gray-700 text-white"
                :href="route('admin.products.index')"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M15 18l-6-6 6-6" />
                </svg>
                Back
                </InertiaLinkButton
            >
        </div>
    </div>
</template>



<style scoped></style>
