import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import debounce from 'lodash.debounce';

export function useServerTable({ propName, initialFilters, defaultSortField = 'id' }) {
    const search = ref(initialFilters?.search || '');
    const isLoading = ref(false);

    const sorting = ref(
        initialFilters?.sort_field
            ? [{ id: initialFilters.sort_field, desc: initialFilters.sort_direction === 'desc' }]
            : [{ id: defaultSortField, desc: false }]
    );

    const pagination = ref({
        pageIndex: 0,
        pageSize: 10,
    });

    const fetchData = () => {
        isLoading.value = true;
        router.reload({
            only: [propName],
            data: {
                page: pagination.value.pageIndex + 1,
                per_page: pagination.value.pageSize,
                search: search.value,
                sort_field: sorting.value[0]?.id || '',
                sort_direction: sorting.value[0]?.desc ? 'desc' : 'asc'
            },
            preserveState: true,
            preserveScroll: true,
            onFinish: () => {
                isLoading.value = false;
            }
        });
    };

    const handlePaginationChange = (updater) => {
        pagination.value = typeof updater === 'function' ? updater(pagination.value) : updater;
        fetchData();
    };

    const handleSortingChange = (updater) => {
        sorting.value = typeof updater === 'function' ? updater(sorting.value) : updater;
        fetchData();
    };

    watch(search, debounce(() => {
        pagination.value.pageIndex = 0;
        fetchData();
    }, 400));

    return {
        search,
        sorting,
        pagination,
        handlePaginationChange,
        handleSortingChange,
        isLoading,
        syncPagination: (currentPage, perPage) => {
            pagination.value.pageIndex = currentPage - 1;
            pagination.value.pageSize = perPage;
        }
    };
}