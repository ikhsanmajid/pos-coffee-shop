<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DataTable from "@/Components/Shared/Components/Organism/DataTable.vue";
import { useServerTable } from '@/Components/Shared/Composable/useServerTable';
import { ref, watchEffect, h } from "vue";
import BaseActionButton from "@/Components/Shared/Components/Atoms/BaseActionButton.vue";
import { Trash, Pen } from "@lucide/vue";
const page = usePage();

const props = defineProps({
    users: Object,
    filters: Object
});

const {
    search, sorting, pagination, isLoading,
    handlePaginationChange, handleSortingChange, syncPagination
} = useServerTable({
    propName: 'users',
    initialFilters: props.filters
});

watchEffect(() => {
    syncPagination(props.users.current_page, props.users.per_page);
});

const columns = [
    {
        id: 'rowNumber',
        header: 'No',
        size: 10,
        enableSorting: false,
        cell: ({ row, table }) => {
            const { pageIndex, pageSize } = table.getState().pagination;
            return (pageIndex * pageSize) + row.index + 1;
        },
    },
    { accessorKey: 'name', header: 'Nama', size: 100 },
    { accessorKey: 'email', header: 'Email', size: 100 },
    {
        accessorKey: 'created_at', header: 'Tanggal Dibuat', size: 50, cell: ({ getValue }) => {
            const rawDate = getValue();
            if (!rawDate) return '-'; // Antisipasi jika data null

            // 1. Ubah string tanggal dari DB (ISO format) menjadi Objek Date JavaScript
            const date = new Date(rawDate);

            // 2. Format menggunakan Intl bawaan JS (Tanpa butuh library tambahan seperti moment/dayjs)
            return new Intl.DateTimeFormat('id-ID', {
                day: 'numeric',
                month: 'long',   // Menampilkan nama bulan penuh (contoh: Juni)
                year: 'numeric',  // Menampilkan 4 digit tahun
            }).format(date);
        }
    },
    {
        accessorKey: 'updated_at', header: 'Tanggal Diperbarui', size: 50, cell: ({ getValue }) => {
            const rawDate = getValue();
            if (!rawDate) return '-'; // Antisipasi jika data null

            // 1. Ubah string tanggal dari DB (ISO format) menjadi Objek Date JavaScript
            const date = new Date(rawDate);

            // 2. Format menggunakan Intl bawaan JS (Tanpa butuh library tambahan seperti moment/dayjs)
            return new Intl.DateTimeFormat('id-ID', {
                day: 'numeric',
                month: 'long',   // Menampilkan nama bulan penuh (contoh: Juni)
                year: 'numeric',  // Menampilkan 4 digit tahun
            }).format(date);
        }
    },
    {
        id: 'actions',
        header: 'AKSI',
        size: 120,
        cell: ({ row }) => {
            const id = row.original.id;

            return h('div', { class: 'flex items-center gap-1.5' }, [
                h(BaseActionButton, {
                    variant: 'primary',
                    onClick: () => console.log(id),
                    title: 'Edit Data'
                }, {
                    default: () => h(Pen, { class: 'w-4 h-4' })
                }),

                h(BaseActionButton, {
                    variant: 'danger',
                    onClick: () => deleteUser(id),
                    title: 'Hapus Data'
                }, {
                    default: () => h(Trash, { class: 'w-4 h-4' })
                }),

            ]);
        }
    }
]

</script>

<template>

    <Head title="User Management"></Head>
    <AuthenticatedLayout>
        <template #header>User Management</template>

        <div class="p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Daftar Pengguna</h1>
                <input v-model="search" type="text" placeholder="Cari pengguna..."
                    class="px-4 py-2 rounded-lg border dark:bg-gray-800 text-sm w-64 outline-none" />
            </div>

            <DataTable :data="users.data" :columns="columns" :page-count="users.last_page" :is-loading="isLoading"
                :pagination-state="pagination" :sorting-state="sorting" @on-pagination-change="handlePaginationChange"
                @on-sorting-change="handleSortingChange" />
        </div>


    </AuthenticatedLayout>

</template>