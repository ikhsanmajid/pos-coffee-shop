<template>
    <div class="w-full">
        <label v-if="label"
            class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">
            {{ label }}
        </label>

        <div class="relative rounded-xl shadow-sm">
            <input :type="type" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
                :placeholder="placeholder" :disabled="disabled" :class="[
                    // Style Dasar
                    'w-full rounded-xl border text-sm px-4 py-2.5 bg-transparent transition-all focus:outline-none focus:ring-2 dark:text-white',

                    // Kondisi jika ada Error dari Laravel
                    error
                        ? 'border-red-500 focus:border-red-500 focus:ring-red-500/20 dark:border-red-500'
                        : 'border-gray-200 dark:border-gray-700 focus:border-amber-500 focus:ring-amber-500/20',

                    disabled ? 'bg-gray-50 dark:bg-gray-800/50 cursor-not-allowed opacity-60' : ''
                ]" />
        </div>

        <p v-if="error" class="mt-1.5 text-xs text-red-500 font-medium">
            {{ error }}
        </p>
    </div>
</template>

<script setup>
defineProps({
    modelValue: [String, Number],
    label: String,
    type: {
        type: String,
        default: 'text'
    },
    placeholder: String,
    error: String,
    disabled: {
        type: Boolean,
        default: false
    }
});

defineEmits(['update:modelValue']);
</script>