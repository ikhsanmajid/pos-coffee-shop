<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Sidebar from '@/Components/Sidebar.vue';
import Header from '@/Components/Header.vue';

const isSidebarOpen = ref(true);
const isMobile = ref(false);

let lastWidth = window.innerWidth;

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const checkBreakpoint = () => {
    if (window.innerWidth === lastWidth) return;
    lastWidth = window.innerWidth;

    const prevMobileStatus = isMobile.value;
    isMobile.value = window.innerWidth < 1024;

    if (prevMobileStatus !== isMobile.value) {
        if (isMobile.value) {
            isSidebarOpen.value = false;
        } else {
            isSidebarOpen.value = true;
        }
    }
};

onMounted(() => {
    isMobile.value = window.innerWidth < 1024;
    isSidebarOpen.value = window.innerWidth >= 1024;
    lastWidth = window.innerWidth;

    window.addEventListener('resize', checkBreakpoint);
});

onUnmounted(() => {
    window.removeEventListener('resize', checkBreakpoint);
});
</script>

<template>
    <div
        class="min-h-screen bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 overflow-x-hidden relative font-sans antialiased">

        <Transition enter-active-class="transition-opacity duration-300 ease-out" enter-from-class="opacity-0"
            enter-to-class="opacity-100" leave-active-class="transition-opacity duration-200 ease-in"
            leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-if="isSidebarOpen && isMobile" @click="isSidebarOpen = false"
                class="fixed inset-0 z-40 bg-gray-950/50 backdrop-blur-sm lg:hidden"></div>
        </Transition>

        <Sidebar :is-open="isSidebarOpen" :is-mobile="isMobile" @close="isSidebarOpen = false" />

        <div :class="[
            isMobile ? 'pl-0' : (isSidebarOpen ? 'lg:pl-64' : 'lg:pl-20'),
            'flex flex-col min-h-screen transition-all duration-300 ease-in-out'
        ]">

            <Header @toggle-sidebar="toggleSidebar">
                <template #header>
                    <slot name="header" />
                </template>
            </Header>

            <div class="flex flex-col flex-1">
                <main class="p-4 sm:p-6 max-w-7xl w-full mx-auto">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>