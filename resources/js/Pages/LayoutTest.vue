<script setup>
import { useForm } from '@inertiajs/vue3';
import BaseSearchableSelect from '@/Components/Shared/Components/Atoms/BaseSearchableSelect.vue';
import { useServerSearchSelect } from '@/Components/Shared/Composable/useServerSearchMultiSelect.js';

const form = useForm({
    id: null,
});

const { chosenData: chosenNamaSelect, fetchOptions: optionsNama } = useServerSearchSelect('fetch.test', form, 'id', 'value');

</script>

<template>
    <div class="min-h-screen container mx-auto pt-6">
        <div class="flex-col">
            <div class="p-6 max-w-sm">

                <BaseSearchableSelect v-model="chosenNamaSelect" label="Daftar Permission"
                    placeholder="Pilih permission..." :options="optionsNama" :isLocal="false" :resolveOnLoad="true"
                    mode="single" :returnObject="true" />

            </div>

            <div class="px-6 text-sm dark:text-gray-300">
                <p>Objek Terpilih:</p>
                <pre
                    class="bg-gray-800 p-3 mt-2 rounded-lg text-green-400 text-xs">{{ chosenNamaSelect?.label || 'Belum memilih' }}</pre>

                Form Id: {{ form.id }}
            </div>
        </div>
    </div>
</template>