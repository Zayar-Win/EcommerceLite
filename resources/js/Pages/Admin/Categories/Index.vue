<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex flex-col sm:flex-row items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb
                icon="fa-list"
                label="Categories"
                :href="route('admin.categories.index')"
            >
                <BreadcrumbItem label="Categories" />
            </Breadcrumb>

            <!-- Create Button -->
            <div class="min-w-[270px] flex justify-end">
                <!-- <DownloadReportDropdown type="attributes" /> -->
                <button @click="showCreateModal = true" class="btn-create bg-primary hover:bg-blue-700 text-white px-4 py-3 text-sm rounded-lg">
                    <i class="fa-solid fa-file-circle-plus mr-1"></i>
                    Create
                </button>
                <!-- CreateModal Component -->
                <!-- <CreateModal :href="route('admin.attributes.create')">
                    <i class="fa-solid fa-file-circle-plus mr-1"></i>
                    Create
                </CreateModal> -->
            </div>
        </div>
        <div
            class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 px-5 py-3"
        >
            <!-- <Head title="attributes" /> -->
            <div
                class="my-3 flex sm:flex-row space-y-5 sm:space-y-0 items-center justify-center sm:justify-between overflow-auto p-1"
            >
                <DashboardTableDataSearchBox
                    placeholder="Search by name or value"
                    :href="route('admin.categories.index')"
                />

                <!-- <div class="sm:block hidden">
            <UserTableFilters />
        </div> -->
            </div>
            <TableContainer
                :data-count="categories?.data?.length"
                :paginate-links="categories.links"
            >
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="categories.data">
                            <template #table-header>
                                <TableHeaderCell
                                    class="min-w-[100px]"
                                    label="ID"
                                />

                                <TableHeaderCell
                                    label="Name"
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
                                    <button  @click="editCategory(item)" class="btn-edit px-4 rounded-lg bg-blue-600 !py-1 flex gap-1 items-center hover:bg-blue-700 text-white !text-xs !font-semibold">
                                        <Edit class="w-[20px]" />
                                        Edit
                                    </button>
                                    <NormalButton
                                        type="button"
                                        @click="
                                            destroy(
                                                'Category',
                                                route(
                                                    'admin.categories.destroy',
                                                    {
                                                        category: item?.id,
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
    <!-- CreateModal Component -->
    <CreateModal
        :open="showCreateModal"
        @closeModal="closeCreateModal"
    />
    <EditModal  :open="showEditModal"
    @closeModal="closeEditModal"
    :category="selectedCategory"/>
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
import CreateModal from "./CreateModal.vue";
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
        CreateModal,
        EditModal
    },
    props: {
        categories: {
            type: Object,
            required:true,
        },
    },
    setup(props) {
        const { destroy } = useCRUDOperations();
        const showCreateModal = ref(false);
        const showEditModal = ref(false);
        const selectedCategory = ref(null);
        function closeCreateModal() {
            showCreateModal.value = false;
        }
        function closeEditModal(){
            showEditModal.value = false;
        }
        const editCategory = (category) => {
            selectedCategory.value = category;
            showEditModal.value = true; 
        };
        return {
            destroy,
            showCreateModal,
            showEditModal,
            closeCreateModal,
            closeEditModal,
            selectedCategory,
            editCategory 
        };
    },
};
</script>
<style lang=""></style>
