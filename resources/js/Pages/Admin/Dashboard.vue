<template>
    <div class="mt-10 px-5">
        <h1 class="text-lg font-semibold">P&P Performance Overview</h1>
        <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5 mt-4">
            <div class="border-[1px] rounded-lg py-7 px-4">
                <p class="text-sm font-medium text-gray-500">Ecommerce Revenue</p>
                <p class="mt-2 text-lg font-semibold">{{totalAmount}} MMK</p>
            </div>
            <div class="border-[1px] rounded-lg py-7 px-4">
                <p class="text-sm font-medium text-gray-500">Customers</p>
                <p class="mt-2 text-lg font-semibold">{{userCount}}</p>
            </div>
            <div class="border-[1px] rounded-lg py-7 px-4">
                <p class="text-sm font-medium text-gray-500">Orders</p>
                <p class="mt-2 text-lg font-semibold">{{orderCount}}</p>
            </div>
            <div class="border-[1px] rounded-lg py-7 px-4">
                <p class="text-sm font-medium text-gray-500">Support Ticket</p>
                <p class="mt-2 text-lg font-semibold">{{ticketCount}}</p>
            </div>
        </div>  

        <div class="flex gap-5 mt-6 lg:flex-row flex-col">
            <div class="basis-[50%] grow-0 overflow-auto">
                <div>
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-semibold my-4">Latest Products</h1>
                        <!-- <Link class="underline text-sm text-primary" :href="route('admin.products.index')">View All</Link> -->
                    </div>
                    <TableContainer
                        :showPagination="false"
                        :data-count="latestProducts?.data?.length"
                        :paginate-links="latestProducts.links"
                        >
                            <template #table>
                                <div class="overflow-x-auto w-full">
                                    <Table :items="latestProducts.data">
                                        <template #table-header>
                                            <TableHeaderCell
                                                class="min-w-[100px]"
                                                label="ID"
                                            />

                                            <TableHeaderCell
                                                label="Name"
                                            />
                                            <TableHeaderCell
                                                label="Image"
                                            />
                                            <TableHeaderCell
                                                label="Category"
                                            />
                                        </template>

                                        <template #table-data="{ item }">
                                            <TableDataCell class="">
                                                {{ item.id }}
                                            </TableDataCell>
                                            <TableDataCell class="min-w-[100px]">
                                                <div class="flex items-center space-x-2">
                                                    <div>
                                                        <p>
                                                            {{ item.name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </TableDataCell>
                                            <TableDataCell class="w-[100px]">
                                                <img :src="item.images[0]?.url" class="w-[50px] h-[40px] object-cover" />
                                            </TableDataCell>
                                            <TableDataCell class="w-[100px]">
                                                <p>{{ item.category.name }}</p>
                                            </TableDataCell>
                                        </template>
                                    </Table>
                                </div>
                            </template>
                    </TableContainer>
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-semibold my-4">Latest Orders</h1>
                        <Link class="underline text-sm text-primary" :href="route('admin.orders.index')">View All</Link>
                    </div>
                    <TableContainer
                        :showPagination="false"
                        :data-count="latestOrders?.data?.length"
                        :paginate-links="latestOrders.links"
                        >
                            <template #table>
                                <div class="overflow-x-auto w-full">
                                    <Table :items="latestOrders.data">
                                        <template #table-header>
                                            <TableHeaderCell
                                                class="min-w-[100px]"
                                                label="ID"
                                            />

                                            <TableHeaderCell
                                                label="UserName"
                                            />
                                            <TableHeaderCell
                                                label="Payment"
                                            />
                                            <TableHeaderCell
                                                label="Status"
                                            />
                                            <TableHeaderCell
                                                label="Total Amount"
                                            />
                                        </template>

                                        <template #table-data="{ item }">
                                            <TableDataCell class="">
                                                {{ item.id }}
                                            </TableDataCell>
                                            <TableDataCell class="min-w-[100px]">
                                                <div class="flex items-center space-x-2">
                                                    <div>
                                                        <p>
                                                            {{ item.user?.name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </TableDataCell>
                                            <TableDataCell class="w-[100px]">
                                                <p>{{ item?.payment?.name }}</p>
                                            </TableDataCell>
                                            <TableDataCell>
                                                <div class="px-2 py-1 text-xs font-black rounded-full text-white" :class="statusStyle(item.status)">
                                                    {{ item.status }}
                                                </div>
                                            </TableDataCell>
                                            <TableDataCell class="min-w-[250px]">
                                                <p>{{ item.total_amount }} MMK</p>
                                            </TableDataCell>
                                        </template>
                                    </Table>
                                </div>
                            </template>
                    </TableContainer>
                </div>
            </div>
            <div class="basis-[50%] grow-0 overflow-auto">
                <div>
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-semibold my-4">Latest Users</h1>
                        <Link class="underline text-sm text-primary" :href="route('admin.users.index')">View All</Link>
                    </div>
                    <TableContainer
                        :showPagination="false"
                        :data-count="latestUsers?.data?.length"
                        :paginate-links="latestUsers.links"
                        >
                            <template #table>
                                <div class="overflow-x-auto w-full">
                                    <Table :items="latestUsers.data">
                                        <template #table-header>
                                            <TableHeaderCell
                                                class="min-w-[100px]"
                                                label="ID"
                                            />

                                            <TableHeaderCell
                                                label="Name"
                                            />
                                            <TableHeaderCell
                                                label="email"
                                            />
                                            <TableHeaderCell
                                                label="phone"
                                            />
                                        </template>

                                        <template #table-data="{ item }">
                                            <TableDataCell class="">
                                                {{ item.id }}
                                            </TableDataCell>
                                            <TableDataCell class="min-w-[100px]">
                                                <div class="flex items-center space-x-2">
                                                    <div>
                                                        <p>
                                                            {{ item.name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </TableDataCell>
                                            <TableDataCell class="w-[150px]">
                                                <p>{{ item.email }}</p>
                                            </TableDataCell>
                                            <TableDataCell class="w-[100px]">
                                                <p>{{ item.phone }}</p>
                                            </TableDataCell>
                                        </template>
                                    </Table>
                                </div>
                            </template>
                    </TableContainer>
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-semibold my-4">Latest Tickets</h1>
                        <Link class="underline text-sm text-primary" :href="route('admin.tickets.index')">View All</Link>
                    </div>
                    <TableContainer
                        :showPagination="false"
                        :data-count="latestTickets?.data?.length"
                        :paginate-links="latestTickets.links"
                        >
                            <template #table>
                                <div class="overflow-x-auto w-full">
                                    <Table :items="latestTickets.data">
                                        <template #table-header>
                                            <TableHeaderCell
                                                class="min-w-[100px]"
                                                label="ID"
                                            />

                                            <TableHeaderCell
                                                label="Name"
                                            />
                                            <TableHeaderCell
                                                label="email"
                                            />
                                            <TableHeaderCell
                                                label="phone"
                                            />
                                            <TableHeaderCell
                                                label="Message"
                                            />
                                        </template>

                                        <template #table-data="{ item }">
                                            <TableDataCell class="">
                                                {{ item.id }}
                                            </TableDataCell>
                                            <TableDataCell class="min-w-[100px]">
                                                <div class="flex items-center space-x-2">
                                                    <div>
                                                        <p>
                                                            {{ item.name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </TableDataCell>
                                            <TableDataCell class="w-[150px]">
                                                <p>{{ item.email }}</p>
                                            </TableDataCell>
                                            <TableDataCell class="w-[100px]">
                                                <p>{{ item.phone }}</p>
                                            </TableDataCell>
                                            <TableDataCell class="w-[250px]">
                                                <p class="line-clamp-2">{{ item.message }}</p>
                                            </TableDataCell>
                                        </template>
                                    </Table>
                                </div>
                            </template>
                    </TableContainer>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Table from '@/Components/Common/Table.vue';
import TableContainer from '@/Components/Common/TableContainer.vue';
import TableDataCell from '@/Components/Common/TableDataCell.vue';
import TableHeaderCell from '@/Components/Common/TableHeaderCell.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components : {
        Table,
        TableContainer,
        TableDataCell,
        TableHeaderCell,
        Link
    },
    props : {
        latestProducts : {
            type : Object
        },
        latestUsers : {
            type : Object
        },
        latestOrders : {
            type : Object
        },
        latestTickets : {
            type : Object
        },
        userCount:{
            type : Number
        },
        orderCount:{
            type : Number
        },
        ticketCount:{
            type : Number
        },
        totalAmount:{
            type : Number
        }
    }
    ,
    methods:{
        statusStyle(status){
                if(status == 'pending')return  'bg-yellow-500';
                if(status == 'cancel')return 'bg-red-500'
                if(status == 'completed')return 'bg-green-500'
        },
    },
    mounted(){
        console.log(this.latestProducts)
    }
}
</script>
<style lang="">
    
</style>