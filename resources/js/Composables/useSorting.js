import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

export function useSorting(url)
{
    const params = computed(() => {
        return {
            sort: usePage().props.ziggy.query?.sort,
            direction: usePage().props.ziggy.query?.direction
        };
    });

    const updateSorting = (sort = 'id') => {
        params.value.sort = sort;
        params.value.direction = params.value.direction === 'asc' ? 'desc' : 'asc';
        router.get(
            url,
            {
                ...usePage().props.ziggy.query, sort: params.value.sort, direction: params.value.direction
            },
            {
                replace: true,
                preserveState: true,
                preserveScroll: true
            }
        );
    };

    return {
        params,
        updateSorting
    };
}
