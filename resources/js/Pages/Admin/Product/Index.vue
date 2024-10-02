<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex flex-col sm:flex-row items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb
                icon="fa-shopping-cart"
                label="Products"
                :href="route('admin.products.index')"
            >
                <BreadcrumbItem label="Lists" />
            </Breadcrumb>

            <!-- Create Button -->
            <div class="min-w-[270px] flex justify-end">
                <InertiaLinkButton :href="route('admin.products.create')">
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
                    placeholder="Search by name or price"
                    :href="route('admin.products.index')"
                />

                <div class="sm:block hidden">
                    <ProductTableFilters :categories="{ categories }" />
                </div>
            </div>
            <TableContainer
                :data-count="products?.data?.length"
                :paginate-links="products.links"
            >
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="products.data">
                            <template #table-header>
                                <SortableTableHeaderCell
                                    class="min-w-[100px]"
                                    label="ID"
                                    sort="id"
                                    :url="route('admin.products.index')"
                                />

                                <TableHeaderCell label="Preview" />

                                <SortableTableHeaderCell
                                    label="Category"
                                    sort="category_id"
                                    :url="route('admin.products.index')"
                                />
                                <SortableTableHeaderCell
                                    label="Name"
                                    sort="name"
                                    :url="route('admin.products.index')"
                                />
                                <SortableTableHeaderCell
                                    label="Price"
                                    sort="price"
                                    :url="route('admin.products.index')"
                                />

                                <!-- <SortableTableHeaderCell
                                    label="Discount"
                                    sort="discount"
                                    :url="route('admin.products.index')"
                                /> -->
                                <SortableTableHeaderCell
                                    label="Priority"
                                    sort="priority"
                                    :url="route('admin.products.index')"
                                />
                                <SortableTableHeaderCell
                                    label="Description"
                                    sort="description"
                                    :url="route('admin.products.index')"
                                />

                                <TableHeaderCell label="Actions" />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell class="">
                                    {{ item.id }}
                                </TableDataCell>
                                <TableDataCell >
                                    <div
                                        v-if="
                                            item.images &&
                                            item.images.length > 0
                                        "
                                    >
                                        <img
                                             :src="item.images[0].url"
                                            alt="Product Image"
                                            class="w-16 h-16 object-cover"
                                        />
                                    </div>
                                    <div v-else>
                                        <p>No image available</p>
                                    </div>
                                </TableDataCell>

                                <TableDataCell class="min-w-[150px]">
                                    {{ item.category?.name }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[150px]">
                                    {{ item.name }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[150px]">
                                    {{ item.price }}
                                </TableDataCell>
                                <!-- <TableDataCell class="min-w-[100px]">
                                    {{ item.discount }}
                                </TableDataCell> -->
                                <TableDataCell class="min-w-[100px]">
                                    {{ item.priority }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[400px]">
                                    {{ item.description }}
                                </TableDataCell>

                                <TableActionCell class="min-w-[350px]">
                                    <InertiaLinkButton
                                        :href="
                                            route(
                                                'admin.product-details.index',
                                                { product: item?.id }
                                            )
                                        "
                                        class="bg-blue-600 h-[40px] !py-1 flex gap-1 items-center hover:bg-blue-700 text-white !text-xs !font-semibold"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            class="w-4 h-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 4v16m8-8H4"
                                            />
                                        </svg>
                                        Product Detail
                                    </InertiaLinkButton>
                                    <InertiaLinkButton
                                        :href="
                                            route('admin.products.edit', {
                                                product: item?.id,
                                            })
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
                                                    'admin.products.destroy',
                                                    {
                                                        product: item?.id,
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
        </div>
        <DragAndDrop />
    </div>
</template>

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
import ProductTableFilters from "@/Components/Organisms/ProductTableFilters.vue";
import { useCRUDOperations } from "@/Composables/useCRUDOperations";
import DragAndDrop from "./DragAndDrop.vue";

defineProps({
    products: {
        type: Object,
        default: null,
    },
    categories: {
        type: Object,
        default: null,
    },
});

const { destroy } = useCRUDOperations();

</script>

<style scoped></style>
