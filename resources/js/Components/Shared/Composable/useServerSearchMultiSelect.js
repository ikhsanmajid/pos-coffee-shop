import { ref, watch } from 'vue';
import axios from 'axios';


export function useServerSearchSelect(routeName, form = null, formKey = 'id', valueKey = 'value') {
    const chosenData = ref(null);

    const fetchOptions = async (query) => {
        try {
            const response = await axios.get(route(routeName), {
                params: { search: query || '' }
            });
            return response.data;
        } catch (error) {
            console.error(`Gagal memuat data dari ${routeName}:`, error);
            return [];
        }
    };

    if (form) {
        watch(chosenData, (newVal) => {
            if (newVal) {
                form[formKey] = newVal[valueKey];
            } else {
                form[formKey] = null;
            }
        });
    }

    return {
        chosenData,
        fetchOptions
    };
}