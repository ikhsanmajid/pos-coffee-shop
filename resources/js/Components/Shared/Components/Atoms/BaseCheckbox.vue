<script setup>
defineProps(['checked', 'indeterminate'])
defineEmits(['change'])
</script>

<template>
    <input type="checkbox" :checked="checked" :indeterminate="indeterminate"
        @change="$emit('change', $event.target.checked)" class="rounded border-gray-300" />
</template>