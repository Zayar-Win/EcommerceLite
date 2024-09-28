export function useQueryParams()
{

    const getActiveFilterQueryCount = () => {
        const query = new URLSearchParams(window.location.search);
        let filterCount = 0;
        query.forEach((value, key) => {
            if (key !== 'sort' && key !== 'direction' && key !== 'page' && key !== 'search') {
                filterCount++;
            }
        });
        return filterCount;
    };


    return {
        getActiveFilterQueryCount
    };
}
