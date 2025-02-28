<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Orders</h1>
        <TableContainer
                :data-count="orders?.data?.length"
                :paginate-links="orders.links"
            >
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="orders.data">
                            <template #table-header>
                                <TableHeaderCell
                                    class="min-w-[100px]"
                                    label="ID"
                                />
                                <TableHeaderCell label="Payment" />
                                <TableHeaderCell label="Status" />
                                <TableHeaderCell label="Total_Amount" />
                                <TableHeaderCell label="Actions" />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell class="">
                                    {{ item.id }}
                                </TableDataCell>
                                <TableDataCell class="capitalize">
                                    {{ item?.payment?.name }}
                                </TableDataCell>
                                <TableDataCell class="min-w-[150px]">
                                    <div :class="statusStyle(item)" class="px-3 py-1 flex items-center text-sm font-bold w-max rounded-full">
                                        {{ item?.status }}
                                    </div>
                                </TableDataCell>
                                <TableDataCell>
                                    {{ item?.total_amount }} MMK
                                </TableDataCell>
                                <TableActionCell>
                                    <InertiaLinkButton
                                        :href="
                                            route('orders.detail', {
                                                order: item?.id,
                                            })
                                        "
                                        class="bg-blue-600 !py-1 flex gap-1 items-center hover:bg-blue-700 text-white !text-xs !font-semibold"
                                    >
                                        <Edit class="w-[20px]" />
                                        Order Detail
                                    </InertiaLinkButton>
                                </TableActionCell>
                            </template>
                        </Table>
                    </div>
                </template>
            </TableContainer>
    </div>
</template>
<script>
import TableHeaderCell from '@/Components/Common/TableHeaderCell.vue';
import SettingLayout from './Layouts/SettingLayout.vue';
import TableContainer from '@/Components/Common/TableContainer.vue';
import Table from '@/Components/Common/Table.vue';
import TableDataCell from '@/Components/Common/TableDataCell.vue';
import TableActionCell from '@/Components/Admin/TableActionCell.vue';
import InertiaLinkButton from '@/Components/Admin/InertiaLinkButton.vue';
import Edit from '@/assets/icons/Edit.vue';

export default {
    layout : [SettingLayout],
    components:{
        TableContainer,
        Table,
        TableHeaderCell,
        TableDataCell,
        TableActionCell,
        InertiaLinkButton,
        Edit
    },
    computed:{
        statusStyle(){
            return function(order){
                if(order.status == 'pending') return 'bg-yellow-500/20 text-yellow-500'
                if(order.status == 'completed') return 'bg-green-500/20 text-green-500'
            }
        }
    },
    props : {
        orders : Object
    }
}
</script>
<style lang="">
    
</style>