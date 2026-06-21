<script setup>
import { FlexRender, useVueTable, getCoreRowModel, getSortedRowModel } from '@tanstack/vue-table'
import TableTh from '../Atoms/TableTh.vue'
import TableTd from '../Atoms/TableTd.vue'
import TablePagination from '../Molecules/TablePagination.vue'

const props = defineProps({
    data: { type: Array, required: true },
    columns: { type: Array, required: true },
    pageCount: { type: Number, required: true },
    paginationState: { type: Object, required: true },
    sortingState: { type: Array, required: true },
    isLoading: { type: Boolean, default: false }
})

const emit = defineEmits(['onPaginationChange', 'onSortingChange']);

const table = useVueTable({
    get data() { return props.data },
    get columns() { return props.columns },

    // Beritahu Tanstack Table bahwa proses dilakukan di Server
    manualPagination: true,
    manualSorting: true,

    // Ambil total halaman dari backend
    get pageCount() { return props.pageCount },

    state: {
        get pagination() { return props.paginationState },
        get sorting() { return props.sortingState },
    },

    onPaginationChange: (updater) => emit('onPaginationChange', updater),
    onSortingChange: (updater) => emit('onSortingChange', updater),

    getCoreRowModel: getCoreRowModel(),
})
</script>

<style scoped>
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: transparent;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background-color: #cbd5e1;
    border-radius: 20px;
}

:deep(.dark) .overflow-x-auto::-webkit-scrollbar-thumb {
    background-color: #4b5563;
}
</style>

<template>
    <div
        class="w-full overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm relative">

        <Transition enter-active-class="transition duration-200 ease-out" enter-from-class="opacity-0"
            enter-to-class="opacity-100" leave-active-class="transition duration-150 ease-in"
            leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-if="isLoading"
                class="absolute inset-0 bg-white/50 dark:bg-gray-900/50 backdrop-blur-[1px] z-20 flex items-center justify-center">
                <div
                    class="flex flex-col items-center gap-2 bg-white dark:bg-gray-800 px-4 py-3 rounded-lg shadow-md border border-gray-100 dark:border-gray-700">
                    <svg class="animate-spin h-5 w-5 text-indigo-600 dark:text-indigo-400"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span class="text-xs font-medium text-gray-600 dark:text-gray-400">Loading...</span>
                </div>
            </div>
        </Transition>

        <div class="overflow-x-auto w-full">
            <table class="w-max min-w-full table-fixed border-collapse text-left">
                <thead>
                    <tr v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                        <TableTh v-for="header in headerGroup.headers" :key="header.id" :header="header">
                            <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
                                :props="header.getContext()" />
                        </TableTh>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in table.getRowModel().rows" :key="row.id"
                        class="bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-colors duration-200">
                        <TableTd v-for="cell in row.getVisibleCells()" :key="cell.id" :cell="cell">
                            <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                        </TableTd>
                    </tr>
                    <tr v-if="data.length === 0">
                        <td :colspan="columns.length" class="text-center py-8 text-gray-500 dark:text-gray-400 text-sm">
                            Tidak ada data.
                        </td>
                    </tr>
                </tbody>
            </table>


        </div>
        <TablePagination :table="table" />
    </div>
</template>