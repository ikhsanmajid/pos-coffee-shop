<script setup>
defineProps({
    header: Object
});
</script>

<template>
    <th :style="{ width: `${header.getSize()}px` }"
        class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-200 dark:border-gray-800 dark:text-gray-400 bg-gray-50/70 dark:bg-gray-900/40">
        <div v-if="header.column.getCanSort()"
            class="cursor-pointer select-none flex items-center gap-2 w-max px-2 py-1 -ml-2 rounded-md transition-all duration-200 hover:bg-gray-200/50 hover:text-gray-900 dark:hover:bg-gray-800/70 dark:hover:text-gray-100"
            @click="header.column.getToggleSortingHandler()?.($event)">
            <slot />

            <span class="text-gray-400 dark:text-gray-500 transition-colors">
                {{ { asc: '▲', desc: '▼' }[header.column.getIsSorted()] ?? '↕' }}
            </span>
        </div>

        <div v-else class="px-2 py-1 -ml-2">
            <slot />
        </div>
    </th>
</template>