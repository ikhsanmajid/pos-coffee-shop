<script setup>
defineProps({
    cell: Object
});
</script>

<template>
    <td :style="{ width: `${cell.column.getSize()}px` }"
        class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100 border-b border-gray-100 dark:border-gray-800/50">
        <slot />
    </td>
</template>