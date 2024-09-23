<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex flex-col sm:flex-row items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb
                icon="fa-credit-card"
                label="Payment"
                :href="route('admin.payments.index')"
            >
                <BreadcrumbItem label="Lists" />
            </Breadcrumb>

            <!-- Create Button -->
            <div class="min-w-[270px] flex justify-end">
                <!-- <DownloadReportDropdown type="users" /> -->

                <InertiaLinkButton :href="route('admin.payments.create')">
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
                    placeholder="Search by name"
                    :href="route('admin.payments.index')"
                />

                <!-- <div class="sm:block hidden">
            <UserTableFilters />
        </div> -->
            </div>
            <TableContainer
                :data-count="payments?.data?.length"
                :paginate-links="payments.links"
            >
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="payments.data">
                            <template #table-header>
                                <TableHeaderCell
                                    class="min-w-[200px]"
                                    label="Name"
                                />

                                <TableHeaderCell
                                    label="Acc No."
                                />

                                <TableHeaderCell
                                class="min-w-[200px]"
                                    label="Acc User Name"
                                />
                                <TableHeaderCell
                                    label="QR Code"
                                />
                                <TableHeaderCell
                                    label="Icon"
                                />
                                <TableHeaderCell
                                    label="Description"
                                />
                                <TableHeaderCell label="Actions" />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell class="">
                                    {{ item?.name }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[200px]">
                                    <div class="flex items-center space-x-2">
                                        <div>
                                            <p>
                                                {{ item?.acc_number }}
                                            </p>
                                        </div>
                                    </div>
                                </TableDataCell>

                                <TableDataCell>
                                    {{ item?.username }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[150px]">
                                    <img :src="item?.qr_code" alt="" class="w-[60px] object-contain h-[60px]">
                                </TableDataCell>
                                <TableDataCell>
                                    <img :src="item?.icon" alt="" class="w-[60px] object-contain h-[60px]">
                                </TableDataCell>
                                <TableDataCell class="min-w-[350px]">
                                    {{ item?.description }}
                                </TableDataCell>
                                <TableActionCell class="min-w-[350px]">
                                    <InertiaLinkButton
                                        :href="
                                            route('admin.payments.edit', {
                                                payment: item?.id,
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
                                                'User',
                                                route('admin.payments.destroy', {
                                                    payment: item?.id,
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
<script>
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
export default {
    components: {
        TableContainer,
        Table,
        SortableTableHeaderCell,
        TableHeaderCell,
        TableDataCell,
        InertiaLinkButton,
        NormalButton,
        TableActionCell,
        Delete,
        Edit,
        DashboardTableDataSearchBox,
        // Head
        Breadcrumb,
        useCRUDOperations,
    },
    props: {
        payments: {
            type: Object,
        },
    },
    setup() {
        const { destroy } = useCRUDOperations();

        return {
            destroy,
        };
    },
};
</script>
<style lang=""></style>
