<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import ThemeToggle from '@/Components/ThemeToggle.vue';
import { Menu, Bell, ChevronDown, UserCircle2, LogOut } from '@lucide/vue';

defineEmits(['toggle-sidebar']);

const isProfileOpen = ref(false);
</script>

<template>
    <header
        class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8 sticky top-0 z-10 backdrop-blur-xl bg-white/80 dark:bg-gray-900/80 border-b border-gray-200/60 dark:border-gray-800/60 ">
        <div class="flex items-center gap-4">
            <button @click="$emit('toggle-sidebar')" type="button"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none transition-all duration-200">
                <Menu class="h-5 w-5" />
            </button>
            <div class="hidden sm:block h-6 w-px bg-gray-200 dark:bg-gray-700/60"></div>
            <h1 class="text-base font-semibold text-gray-800 dark:text-white">
                <slot name="header" />
            </h1>
        </div>

        <div class="flex items-center gap-2">
            <ThemeToggle />

            <button type="button"
                class="relative p-2 rounded-xl text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 focus:outline-none">
                <Bell class="h-5 w-5" />
                <span
                    class="absolute top-2 right-2 w-2 h-2 bg-amber-500 rounded-full ring-2 ring-white dark:ring-gray-900"></span>
            </button>

            <div class="h-8 w-px bg-gray-200 dark:bg-gray-700/60 mx-1"></div>

            <button @click="isProfileOpen = !isProfileOpen" type="button"
                class="flex items-center gap-3 py-1.5 px-2 rounded-xl cursor-pointer focus:outline-none group hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                <div class="flex flex-col items-end hidden sm:flex">
                    <span
                        class="text-xs font-semibold text-gray-700 dark:text-gray-200 group-hover:text-amber-600 dark:group-hover:text-amber-500 transition-colors">{{
                            $page.props.auth.user.name }}</span>
                    <span class="text-[10px] text-gray-400 font-medium">{{ $page.props.auth.roles[0] }}</span>
                </div>
                <div
                    class="w-9 h-9 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 font-bold flex items-center justify-center text-xs text-white shrink-0 ring-2 ring-white dark:ring-gray-900 shadow-md relative">
                    {{ $page.props.auth.user.name.charAt(0).toUpperCase() +
                        $page.props.auth.user.name.charAt(1).toUpperCase() }}
                    <span
                        class="absolute -bottom-1 -right-1 bg-white dark:bg-gray-900 rounded-full p-0.5 border border-gray-200 dark:border-gray-800 shadow-sm transition-transform duration-200"
                        :class="[isProfileOpen ? 'rotate-180' : '']">
                        <ChevronDown class="h-2 w-2 text-gray-400" />
                    </span>
                </div>
            </button>
        </div>
    </header>

    <Teleport to="body">
        <div v-if="isProfileOpen" @click="isProfileOpen = false" class="fixed inset-0 z-40"></div>

        <Transition enter-active-class="transition-all duration-200 ease-out"
            enter-from-class="opacity-0 -translate-y-2 scale-95" enter-to-class="opacity-100 translate-y-0 scale-100"
            leave-active-class="transition-all duration-150 ease-in"
            leave-from-class="opacity-100 translate-y-0 scale-100" leave-to-class="opacity-0 -translate-y-2 scale-95">
            <div v-if="isProfileOpen"
                class="fixed top-[4.5rem] right-4 z-50 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/60 rounded-2xl w-56 p-1.5 shadow-xl flex flex-col gap-0.5">

                <Link :href="route('dashboard')" @click="isProfileOpen = false"
                    class="flex items-center gap-2.5 px-3 py-2.5 text-xs font-medium rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <UserCircle2 class="w-4 h-4 text-gray-400" />
                    Lihat Profil Akun
                </Link>

                <div class="h-px bg-gray-100 dark:bg-gray-700/40 mx-2"></div>

                <Link :href="route('logout')" method="post" as="button"
                    class="flex items-center gap-2.5 px-3 py-2.5 text-xs font-medium rounded-xl text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/30 text-left w-full transition-colors">
                    <LogOut class="w-4 h-4" />
                    Keluar Sistem
                </Link>
            </div>
        </Transition>
    </Teleport>
</template>