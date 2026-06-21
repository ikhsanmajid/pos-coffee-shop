<script setup>
import { useCan } from '@/Components/Shared/Composable/useCan';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

// Import icon dari paket resmi lucide-vue-next
import {
    LayoutDashboard,
    User,
    Users,
    ShieldCheck,
    KeyRound
} from '@lucide/vue';

defineProps({
    isOpen: {
        type: Boolean,
        default: true,
    },
    isMobile: {
        type: Boolean,
        default: false,
    },
});

defineEmits(['close']);

const { can } = useCan();
const page = usePage();

const currentRoute = computed(() => route().current());

const isActive = (routeName) => {
    return currentRoute.value === routeName;
};

// Pastikan properti "route" diisi dengan nama route inertia aslimu (contoh: 'users.index')
const menus = [
    {
        name: 'Menu Utama',
        type: 'heading'
    },
    {
        name: 'Dashboard',
        route: 'dashboard',
        permission: [],
        icon: LayoutDashboard,
    },
    {
        name: 'Profile',
        route: 'profile', // Contoh route profile asli
        permission: [],
        icon: User,
    },
    {
        name: 'Manajemen',
        type: 'heading'
    },
    {
        name: 'User Management',
        route: 'users', // Contoh route user asli
        permission: ['users:view'],
        icon: Users,
    },
    {
        name: 'Roles Management',
        route: 'dashboard', // Contoh route roles asli
        permission: ['users:view'],
        icon: ShieldCheck,
    },
    {
        name: 'Permissions',
        route: 'dashboard', // Contoh route permissions asli
        permission: ['users:view'],
        icon: KeyRound,
    },
];
</script>

<template>
    <aside :class="[
        'fixed top-0 bottom-0 left-0 z-50 bg-white dark:bg-gradient-to-b dark:from-gray-900 dark:via-gray-900 dark:to-gray-950 border-r border-gray-200 dark:border-none transform transition-all duration-500 ease-in-out flex flex-col',
        isMobile
            ? isOpen ? 'w-64 translate-x-0' : 'w-64 -translate-x-full'
            : isOpen ? 'w-64 translate-x-0' : 'w-20 translate-x-0',
    ]">

        <div
            class="h-16 flex items-center px-5 border-b border-gray-100 dark:border-white/[0.06] overflow-hidden shrink-0">
            <div class="flex items-center gap-3">
                <div
                    class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white text-lg shrink-0 shadow-lg shadow-amber-500/20">
                    KB
                </div>
                <div v-show="isMobile || isOpen" class="flex flex-col transition-opacity duration-200">
                    <span class="font-bold text-sm leading-tight text-gray-800 dark:text-white">Kopi Bersama</span>
                    <span
                        class="text-[10px] text-gray-400 dark:text-gray-500 font-semibold tracking-wider uppercase">POS
                        System</span>
                </div>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto overflow-x-hidden px-3 py-5 space-y-3">
            <template v-for="menu in menus" :key="menu.name">

                <div v-if="menu.type === 'heading'">
                    <p v-show="isMobile || isOpen"
                        class="px-3 mt-4 mb-1 text-[10px] font-bold tracking-widest uppercase text-gray-400 dark:text-gray-500">
                        {{ menu.name }}
                    </p>
                    <div v-show="!(isMobile || isOpen)" class="h-px bg-gray-100 dark:bg-white/[0.06] mx-2 mt-4 mb-2">
                    </div>
                </div>

                <Link v-else-if="menu.permission.length === 0 || can(menu.permission)" :href="route(menu.route)" :class="[
                    'relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group whitespace-nowrap',
                    isActive(menu.route)
                        ? 'bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-500 shadow-sm font-semibold'
                        : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-white/[0.05] dark:hover:text-white',
                ]" :title="menu.name">

                    <div v-if="isActive(menu.route)"
                        class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-5 rounded-r-full bg-amber-500"></div>

                    <component :is="menu.icon"
                        class="h-5 w-5 shrink-0 transition-transform duration-200 group-hover:scale-110" />

                    <span v-show="isMobile || isOpen" class="transition-opacity duration-200">
                        {{ menu.name }}
                    </span>
                </Link>

            </template>
        </nav>

        <div class="px-4 py-3 border-t border-gray-100 dark:border-white/[0.06] shrink-0">
            <div v-show="isMobile" class="flex items-center gap-2">
                <span class="text-[10px] text-gray-400 dark:text-gray-500 font-medium">Made With Love - Syaharudin
                    Ikhsan</span>
            </div>
            <div v-show="(!isMobile && isOpen)" class="flex justify-center">
                <span class="text-[10px] text-gray-400 dark:text-gray-500 font-medium">Made With Love - Syaharudin
                    Ikhsan</span>
            </div>
            <div v-show="(!isMobile && !isOpen)" class="flex justify-center">
                <span class="text-[10px] text-gray-400 dark:text-gray-500 font-medium">By Ikhsan</span>
            </div>
        </div>
    </aside>
</template>