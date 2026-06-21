<script setup>
defineProps({
    variant: { type: String, default: 'primary' }, // primary, danger, success
});

const variants = {
    primary: 'text-indigo-600 hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-indigo-900/30',
    danger: 'text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/30',
    success: 'text-emerald-600 hover:bg-emerald-50 dark:text-emerald-400 dark:hover:bg-emerald-900/30',
};
</script>

<template>
    <button :class="[
        variants[variant],
        'w-9 h-9 p-2 rounded-lg transition-colors duration-200 flex items-center justify-center shadow-sm border border-gray-200/50 dark:border-gray-700/50 bg-white dark:bg-gray-800'
    ]">
        <slot />
    </button>
</template>