<template>
    <span :class="[
        'inline-flex items-center font-semibold ring-1 ring-inset tracking-wide gap-1',
        colors[variant],
        sizes[size]
    ]">
        <slot />

        <button v-if="dismissable" type="button" @click.stop="$emit('dismiss')" :class="[
            'rounded-sm p-0.5 inline-flex items-center justify-center transition-colors hover:bg-black/10 dark:hover:bg-white/10 focus:outline-none',
            buttonColors[variant]
        ]">
            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </span>
</template>

<script setup>
defineProps({
    variant: {
        type: String,
        default: 'info'
    },
    size: {
        type: String,
        default: 'md'
    },
    // 🛠️ PROP BARU: Untuk memunculkan tombol X
    dismissable: {
        type: Boolean,
        default: false
    }
});

// 🛠️ REGISTER EVENT EMIT UNTUK AKSI SAAT X DIKLIK
defineEmits(['dismiss']);

const sizes = {
    sm: 'px-1.5 py-0.5 text-[10px] rounded-md uppercase tracking-wider',
    md: 'px-2 py-0.5 text-xs rounded-md',
    lg: 'px-2.5 py-1 text-sm rounded-lg',
};

const colors = {
    amber: 'bg-amber-500/10 text-amber-500 ring-amber-500/20',
    success: 'bg-green-500/10 text-green-500 ring-green-500/20',
    warning: 'bg-yellow-500/10 text-yellow-500 ring-yellow-500/20',
    danger: 'bg-red-500/10 text-red-500 ring-red-500/20',
    info: 'bg-blue-500/10 text-blue-500 ring-blue-500/20',
    // Catatan: bg-color/10 adalah teknik transparansi modern Tailwind v3/v4 yang menghasilkan efek soft dark mode persis seperti di gambarmu!
};

// 🛠️ WARNA TEXT ICON SILANG AGAR SENADA DENGAN VARIANTNYA
const buttonColors = {
    amber: 'text-amber-500',
    success: 'text-green-500',
    warning: 'text-yellow-500',
    danger: 'text-red-500',
    info: 'text-blue-500',
};
</script>