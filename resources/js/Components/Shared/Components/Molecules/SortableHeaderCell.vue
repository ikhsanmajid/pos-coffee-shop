<script setup>
defineProps({
    label: String,
    sorted: { type: [String, Boolean], default: false },
})
defineEmits(['toggle-sort'])
</script>

<template>
    <button class="flex items-center gap-1 font-medium text-sm select-none" @click="$emit('toggle-sort')">
        {{ label }}
        <span v-if="sorted === 'asc'">▲</span>
        <span v-else-if="sorted === 'desc'">▼</span>
    </button>
</template>