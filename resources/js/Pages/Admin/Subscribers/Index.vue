<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex flex-col sm:flex-row items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb
                icon="fa-bell"
                label="Subscribers"
                :href="route('admin.subscribers.index')"
            >
                <BreadcrumbItem label="Subscribers" />
            </Breadcrumb>
        </div>
        <div
            class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 px-5 py-3"
        >
            <!-- <Head title="attributes" /> -->
            <div
                class="my-3 flex sm:flex-row space-y-5 sm:space-y-0 items-center justify-center sm:justify-between overflow-auto p-1"
            >
                <DashboardTableDataSearchBox
                    placeholder="Search by email"
                    :href="route('admin.subscribers.index')"
                />

                <!-- <div class="sm:block hidden">
            <UserTableFilters />
        </div> -->
            </div>
            <TableContainer
                :data-count="subscribers?.data?.length"
                :paginate-links="subscribers.links"
            >
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="subscribers.data">
                            <template #table-header>
                                <TableHeaderCell
                                    class="min-w-[100px]"
                                    label="ID"
                                />

                                <TableHeaderCell
                                    label="Email"
                                />

                                <TableHeaderCell label="Actions" />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell class="">
                                    {{ item.id }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[200px]">
                                    <div class="flex items-center space-x-2">
                                        <div>
                                            <p>
                                                {{ item.email }}
                                            </p>
                                        </div>
                                    </div>
                                </TableDataCell>
                                <TableActionCell class="min-w-[200px]">
                                    <NormalButton
                                        type="button"
                                        @click="
                                            destroy(
                                                'Subscriber',
                                                route(
                                                    'admin.subscribers.destroy',
                                                    {
                                                        subscriber: item?.id,
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
    </div>
</template>
<script>
import Delete from "@/assets/icons/Delete.vue";
import DashboardTableDataSearchBox from "@/Components/Admin/DashboardTableDataSearchBox.vue";
import InertiaLinkButton from "@/Components/Admin/InertiaLinkButton.vue";
import NormalButton from "@/Components/Admin/NormalButton.vue";
import TableActionCell from "@/Components/Admin/TableActionCell.vue";
import SortableTableHeaderCell from "@/Components/Common/SortableTableHeaderCell.vue";
import Table from "@/Components/Common/Table.vue";
import TableContainer from "@/Components/Common/TableContainer.vue";
import TableDataCell from "@/Components/Common/TableDataCell.vue";
import TableHeaderCell from "@/Components/Common/TableHeaderCell.vue";
// import { Head } from '@inertiajs/vue3';
import { useCRUDOperations } from "@/Composables/useCRUDOperations";
import Breadcrumb from "@/Components/Molecules/Breadcrumb.vue";
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
        DashboardTableDataSearchBox,
        Breadcrumb,
    },
    props: {
        subscribers: {
            type: Object,
            required:true,
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
