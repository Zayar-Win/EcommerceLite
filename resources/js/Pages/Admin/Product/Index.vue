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
                    placeholder="Search by id, name, email or phone"
                    :href="route('admin.products.index')"
                />

                <!-- <div class="sm:block hidden">
            <UserTableFilters />
        </div> -->
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

                                <!-- <SortableTableHeaderCell
                                    label="Stock Quantity"
                                    sort="product_detail_id"
                                    :url="route('admin.products.index')"
                                /> -->

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
                                    label="Discount"
                                    sort="discount"
                                    :url="route('admin.products.index')"
                                />
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
                                <!-- <TableDataCell class="min-w-[200px]">
                                    <div class="flex items-center space-x-2">
                                        <div>
                                            <p>
                                                {{ item.product_detail.stock_quantity }}
                                            </p>
                                        </div>
                                    </div>
                                </TableDataCell> -->

                                <TableDataCell class="min-w-[150px]">
                                    {{ item.category.name }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[150px]">
                                    {{ item.name }}
                                </TableDataCell>
                                <TableDataCell>
                                    {{ item.discount }}
                                </TableDataCell>
                                <TableDataCell>
                                    {{ item.priority }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[400px]">
                                    {{ item.description }}
                                </TableDataCell>

                                <TableActionCell class="min-w-[350px]">
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
                                                route('admin.products.destroy', {
                                                    product: item?.id,
                                                })
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
// import { Head } from '@inertiajs/vue3';
import { useCRUDOperations } from "@/Composables/useCRUDOperations";

defineProps({
    products:{
        type:Object,
        default:null,
    }
})

const { destroy} = useCRUDOperations();
</script>

<style scoped>

</style>