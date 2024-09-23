import { onMounted, onUnmounted } from 'vue';

export function useClickOutside(targetRef, callbackFunction)
{
    const handleClickOutside = (event) => {
        if (targetRef.value && !targetRef.value.contains(event.target)) {
            callbackFunction();
        }
    };

    onMounted(() => {
        document.addEventListener('click', handleClickOutside);
    });

    onUnmounted(() => {
        document.removeEventListener('click', handleClickOutside);
    });
}
