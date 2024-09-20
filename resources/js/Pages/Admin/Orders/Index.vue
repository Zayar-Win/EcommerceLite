<template >
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex flex-col sm:flex-row items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb
                icon="fa-box-open"
                label="Orders"
                :href="route('admin.orders.index')"
            >
                <BreadcrumbItem label="Lists" />
            </Breadcrumb>

            <!-- Create Button -->
            <div class="min-w-[270px] flex justify-end">
                <!-- <DownloadReportDropdown type="users" /> -->

                <InertiaLinkButton :href="route('admin.users.create')">
                    <i class="fa-solid fa-file-circle-plus mr-1"></i>
                    Create
                </InertiaLinkButton>
            </div>
        </div>
        <div
            class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 px-5 py-3"
        >
            <div
                class="my-3 flex sm:flex-row space-y-5 sm:space-y-0 items-center justify-center sm:justify-between overflow-auto p-1"
            >
                <DashboardTableDataSearchBox
                    placeholder="Search by id, name, email or phone"
                    :href="route('admin.orders.index')"
                />

                <!-- <div class="sm:block hidden">
            <UserTableFilters />
        </div> -->
            </div>
            <TableContainer
                :data-count="orders?.data?.length"
                :paginate-links="orders.links"
            >
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="orders.data">
                            <template #table-header>
                                <SortableTableHeaderCell
                                    class="min-w-[100px]"
                                    label="ID"
                                    sort="id"
                                    :url="route('admin.orders.index')"
                                />
                                <TableHeaderCell
                                    label="Order User"
                                />
                                <TableHeaderCell
                                    label="Pyament"
                                />
                                <TableHeaderCell
                                label="Phone Number"
                                />
                                <TableHeaderCell
                                    label="Status"
                                />
                                <TableHeaderCell
                                class="min-w-[150px]"
                                label="Total Amount"
                                />
                                <TableHeaderCell label="Actions" />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell class="">
                                    {{ item?.id }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[150px]">
                                    <p class="line-clamp-1">{{ item?.shipping_recipient_name }}</p>
                                </TableDataCell>
                                <TableDataCell class="min-w-[100px]">
                                    {{ item?.payment?.name }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[150px]">
                                    {{ item.shipping_ph_number }}
                                </TableDataCell>
                                <TableDataCell class=" text-sm capitalize" > 
                                    <div class="px-2 py-1 text-xs font-black rounded-full text-white" :class="statusStyle(item.status)">
                                        {{ item.status }}
                                    </div>
                                </TableDataCell>
                                <TableDataCell class="min-w-[200px]">
                                    {{ item.total_amount }} MMK
                                </TableDataCell>
                                <TableActionCell class="min-w-[250px]">
                                    <InertiaLinkButton
                                        :href="
                                            route('admin.orders.orderDetail', {
                                                order: item?.id,
                                            })
                                        "
                                        class="bg-blue-600 !py-1 flex gap-1 items-center hover:bg-blue-700 text-white !text-xs !font-semibold"
                                    >
                                        <Edit class="w-[20px]" />
                                        Order Detail
                                    </InertiaLinkButton>
                                    <NormalButton
                                        type="button"
                                        @click="
                                            destroy(
                                                'User',
                                                route('admin.users.destroy', {
                                                    user: item?.id,
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
    props : {
        orders : {
            type : Object
        }
    },
    methods:{
        statusStyle(status){
                if(status == 'pending')return  'bg-yellow-500';
                if(status == 'cancel')return 'bg-red-500'
                if(status == 'completed')return 'bg-green-500'
        }
    },  
    setup() {
        const { destroy } = useCRUDOperations();

        return {
            destroy,
        };
    },
}
</script>
<style lang="">
    
</style>