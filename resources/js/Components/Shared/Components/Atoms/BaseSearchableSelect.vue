<template>
    <div class="w-full CustomMultiselect">
        <label v-if="label"
            class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">
            {{ label }}
        </label>

        <Multiselect :value="modelValue" @change="(val) => $emit('update:modelValue', val)" :searchable="true"
            :placeholder="placeholder" :disabled="disabled" :class="[error ? 'is-invalid' : '']" :mode="mode"
            :object="returnObject" :value-prop="valueProp" :label="labelProp" v-bind="dynamicConfig" />

        <p v-if="error" class="mt-1.5 text-xs text-red-500 font-medium">
            {{ error }}
        </p>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import Multiselect from '@vueform/multiselect';

const props = defineProps({
    modelValue: [String, Number, Array, Object],

    options: {
        type: [Array, Object, Function],
        required: true
    },
    isLocal: {
        type: Boolean,
        default: true
    },
    mode: {
        type: String,
        default: 'single'
    },
    resolveOnLoad: {
        type: Boolean,
        default: false
    },
    label: String,
    placeholder: {
        type: String,
        default: 'Pilih opsi...'
    },
    error: String,
    disabled: {
        type: Boolean,
        default: false
    },

    returnObject: {
        type: Boolean,
        default: false
    },

    valueProp: {
        type: String,
        default: 'value'
    },

    labelProp: {
        type: String,
        default: 'label'
    }
});

defineEmits(['update:modelValue']);

const dynamicConfig = computed(() => {
    if (props.isLocal) {
        return {
            options: props.options,
            filterResults: true,
            resolveOnLoad: false,
            delay: -1,
            loading: false
        };
    }

    return {
        options: props.options,
        filterResults: false,
        resolveOnLoad: props.resolveOnLoad,
        delay: 500
    };
});
</script>

<style src="@vueform/multiselect/themes/default.css"></style>


<style>
.CustomMultiselect {

    --ms-radius: 0.75rem;

    --ms-border-color: #e5e7eb;

    --ms-bg: #ffffff;

    --ms-font-size: 0.875rem;

    --ms-py: 0.625rem;

    --ms-px: 1rem;

    --ms-ring-color: rgba(217, 119, 6, 0.2);

}


.dark .CustomMultiselect {

    --ms-bg: #111827;

    --ms-border-color: #374151;

    --ms-dropdown-bg: #111827;

    --ms-dropdown-border-color: #374151;

    --ms-option-bg-pointed: #1f2937;

    --ms-option-color-pointed: #ffffff;

    --ms-option-bg-selected: #d97706;

    --ms-option-bg-selected-pointed: #b45309;

}


.CustomMultiselect .is-invalid {

    --ms-border-color: #ef4444 !important;

}
</style>