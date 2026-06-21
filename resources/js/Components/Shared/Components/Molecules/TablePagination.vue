<script setup>
import { computed, ref, watch } from 'vue';
import { useBreakpoint } from '@/Components/Shared/Composable/useBreakpoint';

const props = defineProps({
    table: Object
});

const { isMobile } = useBreakpoint();

const currentPage = computed(() => props.table.getState().pagination.pageIndex + 1);
const totalPages = computed(() => props.table.getPageCount());
const visiblePagesMobileorDesktop = ref(isMobile.value ? 3 : 5);

watch(isMobile, () => {
    props.table.setPageIndex(0);
    visiblePagesMobileorDesktop.value = isMobile.value ? 3 : 5;
});

const visiblePages = computed(() => {
    const total = totalPages.value;
    const current = currentPage.value;
    const maxVisible = visiblePagesMobileorDesktop.value;

    if (total <= maxVisible) {
        return Array.from({ length: total }, (_, i) => i + 1);
    }

    const half = Math.floor(maxVisible / 2);

    if (current <= half + 1) {
        return Array.from({ length: maxVisible }, (_, i) => i + 1);
    }

    if (current >= total - half) {
        return Array.from({ length: maxVisible }, (_, i) => total - maxVisible + 1 + i);
    }

    return Array.from({ length: maxVisible }, (_, i) => current - half + i);
});

</script>

<template>
    <div
        class="flex flex-col sm:flex-row items-center justify-between gap-4 px-6 py-4 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
        <div class="text-sm text-gray-600 dark:text-gray-400 order-2 sm:order-1">
            <span class="sm:inline">
                Menampilkan halaman
                <span class="font-medium text-gray-900 dark:text-gray-100">{{ currentPage }}</span>
                dari
                <span class="font-medium text-gray-900 dark:text-gray-100">{{ totalPages }}</span>
            </span>
        </div>

        <div class="flex gap-1.5">
            <BaseButton variant="ghost" size="sm" :disabled="!table.getCanPreviousPage()"
                @click="table.setPageIndex(0)">
                &laquo;
            </BaseButton>
            <BaseButton variant="ghost" size="sm" :disabled="!table.getCanPreviousPage()" @click="table.previousPage()">
                &lsaquo;
            </BaseButton>

            <BaseButton v-for="page in visiblePages" :key="page"
                :variant="page === currentPage ? 'paginationActive' : 'pagination'" size="sm"
                @click="table.setPageIndex(page - 1)">
                {{ page }}
            </BaseButton>
            <BaseButton variant="ghost" size="sm" :disabled="!table.getCanNextPage()" @click="table.nextPage()">
                &rsaquo;
            </BaseButton>
            <BaseButton variant="ghost" size="sm" :disabled="!table.getCanNextPage()"
                @click="table.setPageIndex(totalPages - 1)">
                &raquo;
            </BaseButton>
        </div>
    </div>
</template>



<script>
import BaseButton from '../Atoms/BaseButton.vue';
export default { components: { BaseButton } }
</script>