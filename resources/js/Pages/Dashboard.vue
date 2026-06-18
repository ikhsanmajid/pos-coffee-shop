<script setup>
import BaseBadge from '@/Components/Shared/Components/Atoms/BaseBadge.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

// 🛠️ IMPORT ICON DARI LUCIDE (Icon yang tidak terpakai sudah dihapus)
import {
    Banknote,
    Receipt,
    PackageOpen,
    Wallet,
    ShieldCheck,
    ChevronDown,
    Activity,
    Clock
} from '@lucide/vue';

const page = usePage();

const user = computed(() => page.props.auth.user);
const permissions = computed(() => page.props.auth.permissions);

const permissionlist = ref(
    Array.isArray(permissions.value)
        ? permissions.value
        : Object.values(permissions.value),
);

const removePermission = (index) => {
    permissionlist.value.splice(index, 1);
};

const showPermissions = ref(false);

const greeting = computed(() => {
    const hour = new Date().getHours();
    if (hour < 12) return 'Selamat Pagi';
    if (hour < 15) return 'Selamat Siang';
    if (hour < 18) return 'Selamat Sore';
    return 'Selamat Malam';
});

const greetingIcon = computed(() => {
    const hour = new Date().getHours();
    if (hour < 12) return '☀️';
    if (hour < 15) return '🌤️';
    if (hour < 18) return '🌅';
    return '🌙';
});

const statCards = [
    {
        label: 'Total Penjualan',
        value: 'Rp 2.450.000',
        change: '+12%',
        icon: Banknote,
        color: 'amber',
    },
    {
        label: 'Transaksi Hari Ini',
        value: '48',
        change: '+5',
        icon: Receipt,
        color: 'blue',
    },
    {
        label: 'Produk Aktif',
        value: '24',
        change: '0',
        icon: PackageOpen,
        color: 'emerald',
    },
    {
        label: 'Pendapatan Bulan Ini',
        value: 'Rp 32.5 Jt',
        change: '+8%',
        icon: Wallet,
        color: 'violet',
    },
];

const colorMap = {
    amber: {
        iconBg: 'bg-amber-500/10',
        text: 'text-amber-500',
        badge: 'bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-500',
    },
    blue: {
        iconBg: 'bg-blue-500/10',
        text: 'text-blue-500',
        badge: 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-500',
    },
    emerald: {
        iconBg: 'bg-emerald-500/10',
        text: 'text-emerald-500',
        badge: 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-500',
    },
    violet: {
        iconBg: 'bg-violet-500/10',
        text: 'text-violet-500',
        badge: 'bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-500',
    },
};
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>Dashboard</template>

        <div class="mb-6">
            <div
                class="relative overflow-hidden rounded-2xl bg-amber-600 dark:bg-amber-700/40 p-6 sm:p-8 text-white border border-transparent dark:border-amber-600/20">
                <div
                    class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-white via-transparent to-transparent">
                </div>

                <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="text-xl">{{ greetingIcon }}</span>
                            <p class="text-sm font-medium text-amber-100">{{ greeting }}</p>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-bold tracking-tight">{{ user.name }}</h2>
                        <p class="mt-2 text-sm text-amber-50 max-w-lg leading-relaxed">
                            Selamat datang kembali di sistem POS Kopi Bersama. Berikut adalah ringkasan performa dan
                            aktivitas
                            harian toko Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div v-for="stat in statCards" :key="stat.label"
                class="group bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5 transition-all duration-200 hover:shadow-md hover:border-gray-300 dark:hover:border-gray-700">
                <div class="flex items-start justify-between mb-4">
                    <div
                        :class="[colorMap[stat.color].iconBg, 'w-10 h-10 rounded-xl flex items-center justify-center transition-transform duration-200 group-hover:-translate-y-1']">
                        <component :is="stat.icon" :class="['h-5 w-5', colorMap[stat.color].text]" />
                    </div>
                    <span :class="[colorMap[stat.color].badge, 'text-[10px] font-bold px-2.5 py-1 rounded-full']">
                        {{ stat.change }}
                    </span>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">{{ stat.value }}</p>
                <p class="text-xs font-medium text-gray-500 mt-1">{{ stat.label }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

            <div
                class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden flex flex-col h-fit">
                <button type="button" @click="showPermissions = !showPermissions"
                    class="flex items-center justify-between w-full px-5 py-4 text-left focus:outline-none group hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                            <ShieldCheck class="h-4 w-4 text-emerald-600 dark:text-emerald-400" />
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Daftar Hak Akses
                                (Permissions)
                            </h3>
                            <p class="text-[10px] text-gray-500 mt-0.5">{{ permissionlist.length }} izin sistem aktif
                            </p>
                        </div>
                    </div>
                    <ChevronDown
                        :class="['h-4 w-4 text-gray-400 transition-transform duration-200', showPermissions ? 'rotate-180' : '']" />
                </button>

                <Transition enter-active-class="transition-all duration-200 ease-out"
                    enter-from-class="opacity-0 max-h-0" enter-to-class="opacity-100 max-h-96"
                    leave-active-class="transition-all duration-150 ease-in" leave-from-class="opacity-100 max-h-96"
                    leave-to-class="opacity-0 max-h-0">
                    <div v-show="showPermissions" class="px-5 pb-4 overflow-hidden">
                        <div
                            class="flex flex-wrap items-center gap-2 pt-3 border-t border-gray-100 dark:border-gray-800">
                            <BaseBadge v-for="(permission, index) in permissionlist" :key="index" variant="success"
                                size="md" :dismissable="true" @dismiss="removePermission(index)">
                                {{ permission }}
                            </BaseBadge>
                            <span v-if="permissionlist.length === 0" class="text-xs text-gray-400 italic">Tidak ada izin
                                terkait
                                akun ini.</span>
                        </div>
                    </div>
                </Transition>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center">
                            <Activity class="h-4 w-4 text-blue-600 dark:text-blue-400" />
                        </div>
                        <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Aktivitas Terakhir</h3>
                    </div>
                    <button class="text-[10px] font-semibold text-blue-600 dark:text-blue-400 hover:underline">Lihat
                        Semua</button>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-600 dark:text-gray-400 truncate">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Transaksi #1048</span>
                                berhasil
                                diselesaikan
                            </p>
                            <p class="text-[10px] text-gray-400 flex items-center gap-1 mt-0.5">
                                <Clock class="w-3 h-3" /> 2 menit yang lalu
                            </p>
                        </div>
                        <span class="text-xs font-semibold text-emerald-600 dark:text-emerald-400">+Rp 45.000</span>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 w-1.5 h-1.5 rounded-full bg-amber-500 shrink-0"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-600 dark:text-gray-400 truncate">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Pembaruan Stok</span>
                                dilakukan
                                pada item Kopi Susu
                            </p>
                            <p class="text-[10px] text-gray-400 flex items-center gap-1 mt-0.5">
                                <Clock class="w-3 h-3" /> 1 jam yang lalu
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 w-1.5 h-1.5 rounded-full bg-blue-500 shrink-0"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-600 dark:text-gray-400 truncate">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Sistem Login</span> Kasir
                                Shift A
                                mulai beroperasi
                            </p>
                            <p class="text-[10px] text-gray-400 flex items-center gap-1 mt-0.5">
                                <Clock class="w-3 h-3" /> 3 jam yang lalu
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>