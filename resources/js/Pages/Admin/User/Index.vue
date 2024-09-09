<template >
    <div class="my-3 flex sm:flex-row space-y-5 sm:space-y-0 items-center justify-center sm:justify-between overflow-auto p-1">
        <DashboardTableDataSearchBox
            placeholder="Search by id, name, email or phone"
            :href="route('admin.users.index')"
        />

        <!-- <div class="sm:block hidden">
            <UserTableFilters />
        </div> -->
    </div>
    <TableContainer :data-count="users?.data?.length" :paginate-links="users.links">
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="users.data">
                            <template #table-header>
                                <SortableTableHeaderCell
                                    label="ID"
                                    sort="id"
                                    :url="route('admin.users.index')"
                                />

                                <SortableTableHeaderCell
                                    label="Name"
                                    sort="name"
                                    :url="route('admin.users.index')"
                                />

                                <SortableTableHeaderCell
                                    label="Email"
                                    sort="email"
                                    :url="route('admin.users.index')"
                                />
                                <TableHeaderCell label="Actions" />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell class="min-w-[200px]">
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


                                

                                <TableDataCell>
                                    {{ item.email }}
                                </TableDataCell>

                                <TableActionCell class="min-w-[350px]">
                                    <InertiaLinkButton
                                        class="bg-blue-600 !py-1 flex gap-1 items-center hover:bg-blue-700 text-white !text-xs !font-semibold"
                                    >
                                    <Edit class="w-[20px]"/>
                                        Edit
                                    </InertiaLinkButton>
                                    <NormalButton
                                        type="button"
                                        @click="
                                            destroy(
                                                'User',
                                                route('admin.users.destroy.force', { user: item?.id })
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
</template>
<script>
import Delete from '@/assets/icons/Delete.vue';
import Edit from '@/assets/icons/Edit.vue';
import DashboardTableDataSearchBox from '@/Components/Admin/DashboardTableDataSearchBox.vue';
import InertiaLinkButton from '@/Components/Admin/InertiaLinkButton.vue';
import NormalButton from '@/Components/Admin/NormalButton.vue';
import TableActionCell from '@/Components/Admin/TableActionCell.vue';
import SortableTableHeaderCell from '@/Components/Common/SortableTableHeaderCell.vue';
import Table from '@/Components/Common/Table.vue';
import TableContainer from '@/Components/Common/TableContainer.vue';
import TableDataCell from '@/Components/Common/TableDataCell.vue';
import TableHeaderCell from '@/Components/Common/TableHeaderCell.vue';

export default {
    components:{
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
        DashboardTableDataSearchBox
    },
    props:{
        users  : {
            type : Object
        }
    }
}
</script>
<style lang="">
    
</style>