<template>
    <button :type="type" :disabled="disabled || loading" :class="[
        // Class Dasar (Struktur & Transisi)
        'inline-flex items-center justify-center font-semibold rounded-xl tracking-wide transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-950',

        // Dinamis berdasarkan Ukuran (Size)
        sizes[size],

        // Dinamis berdasarkan Warna (Variant)
        variants[variant],

        // Kondisi ketika Disabled atau Loading
        (disabled || loading) ? 'opacity-50 cursor-not-allowed shadow-none' : 'active:scale-[0.98]'
    ]">
        <svg v-if="loading" class="animate-spin -ml-1 mr-2 h-4 w-4 current-color" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>

        <slot />
    </button>
</template>

<script setup>
defineProps({
    // Tipe button native: 'button', 'submit', atau 'reset'
    type: {
        type: String,
        default: 'button'
    },
    // Pilihan warna: 'primary', 'secondary', 'danger', 'ghost'
    variant: {
        type: String,
        default: 'primary'
    },
    // Pilihan ukuran: 'sm', 'md', 'lg'
    size: {
        type: String,
        default: 'md'
    },
    disabled: {
        type: Boolean,
        default: false
    },
    loading: {
        type: Boolean,
        default: false
    }
});

// Mapping Ukuran Tailwind
const sizes = {
    sm: 'px-3 py-1.5 text-xs gap-1.5',
    md: 'px-4 py-2.5 text-sm gap-2',
    lg: 'px-5 py-3 text-base gap-2.5'
};

// Mapping Warna Tailwind (Mendukung Light & Dark Mode)
const variants = {
    primary: 'bg-amber-600 text-white hover:bg-amber-500 shadow-sm shadow-amber-600/10 focus:ring-amber-500',

    secondary: 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-700/50 shadow-sm focus:ring-amber-500',

    danger: 'bg-red-600 text-white hover:bg-red-500 shadow-sm shadow-red-600/10 focus:ring-red-500',

    ghost: 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white focus:ring-gray-500'
};
</script>