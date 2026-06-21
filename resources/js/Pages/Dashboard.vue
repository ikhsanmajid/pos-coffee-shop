<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
const page = usePage();
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>Dashboard</template>

    </AuthenticatedLayout>
</template>