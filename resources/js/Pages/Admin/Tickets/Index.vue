<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex flex-col sm:flex-row items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb
                icon="fa-list"
                label="Tickets"
                :href="route('admin.tickets.index')"
            >
                <BreadcrumbItem label="Tickets" />
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
                    placeholder="Search by name or message"
                    :href="route('admin.tickets.index')"
                />
            </div>
            <TableContainer
                :data-count="tickets?.data?.length"
                :paginate-links="tickets.links"
            >
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="tickets.data">
                            <template #table-header>
                                <TableHeaderCell
                                    class="min-w-[100px]"
                                    label="ID"
                                />
                                <TableHeaderCell
                                    label="Name"
                                />
                                <TableHeaderCell
                                    label="Email"
                                />
                                <TableHeaderCell
                                    label="Phone"
                                />
                                <TableHeaderCell
                                    label="Status"
                                />
                                <TableHeaderCell
                                    label="Message"
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
                                                {{ item.name }}
                                            </p>
                                        </div>
                                    </div>
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
                                <TableDataCell class="min-w-[200px]">
                                    <div class="flex items-center space-x-2">
                                        <div>
                                            <p>
                                                {{ item.phone }}
                                            </p>
                                        </div>
                                    </div>
                                </TableDataCell>
                                <TableDataCell class=" text-sm capitalize" > 
                                    <div class="px-2 py-1 text-xs font-black rounded-full text-white" :class="statusStyle(item.status)">
                                        {{ item.status }}
                                    </div>
                                </TableDataCell>
                                <TableDataCell class="min-w-[200px]">
                                    <div class="flex items-center space-x-2">
                                        <div>
                                            <p class="line-clamp-2">
                                                {{ item.message }}
                                            </p>
                                        </div>
                                    </div>
                                </TableDataCell>
                                <TableActionCell class="min-w-[350px]">
                                    <!-- <InertiaLinkButton
                                        :href="
                                            route('admin.attributes.edit', {
                                                attribute: item?.id,
                                            })
                                        "
                                        class="bg-blue-600 !py-1 flex gap-1 items-center hover:bg-blue-700 text-white !text-xs !font-semibold"
                                    >
                                        <Edit class="w-[20px]" />
                                        Edit
                                    </InertiaLinkButton> -->
                                    <button v-if="item.status !== 'completed'"  @click="markAsComplete(item)" class="btn-edit px-4 rounded-lg bg-blue-600 !py-1 flex gap-1 items-center hover:bg-blue-700 text-white !text-xs !font-semibold">
                                        Mark As Complete
                                    </button>
                                    <button  @click="editTicket(item)" class="btn-edit px-4 rounded-lg bg-blue-600 !py-1 flex gap-1 items-center hover:bg-blue-700 text-white !text-xs !font-semibold">
                                        <Edit class="w-[20px]" />
                                        View Detail
                                    </button>
                                    <NormalButton
                                        type="button"
                                        @click="
                                            destroy(
                                                'Category',
                                                route(
                                                    'admin.tickets.destroy',
                                                    {
                                                        ticket: item?.id,
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
    <EditModal  :open="showEditModal"
    @closeModal="closeEditModal"
    :ticket="selectedTicket"/>
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
import { ref } from "vue";
import { useCRUDOperations } from "@/Composables/useCRUDOperations";
import EditModal from "./EditModal.vue";
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
        EditModal
    },
    props: {
        tickets: {
            type: Object,
            required:true,
        },
    },
    setup(props) {
        const { destroy,edit } = useCRUDOperations();
        const showEditModal = ref(false);
        const selectedTicket = ref(null);
        function closeEditModal(){
            showEditModal.value = false;
        }
        const editTicket = (ticket) => {
            selectedTicket.value = ticket;
            showEditModal.value = true; 
        };
        return {
            destroy,
            edit,
            showEditModal,
            closeEditModal,
            selectedTicket,
            editTicket 
        };
    },
    methods:{
        statusStyle(status){
                if(status == 'pending')return  'bg-yellow-500';
                if(status == 'cancel')return 'bg-red-500'
                if(status == 'completed')return 'bg-green-500'
        },
        markAsComplete(ticket){
            this.edit('Ticket',route('admin.tickets.update',{ticket : ticket.id}))
        }
    }
};
</script>
<style lang=""></style>
