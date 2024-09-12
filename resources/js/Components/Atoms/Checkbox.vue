<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: {
        type: String,
        required: false
    },
    checked: {
        type: Boolean,
        default: false
    },
    value: {
        type: [String, Number, Boolean]
    }
});

const emit = defineEmits(['update:checked']);

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    // emit("update:checked", val ? props.value : null);
    }
});
</script>

<template>
    <label class="flex items-center cursor-pointer select-none text-light-text dark:text-dark-text">
        <div class="relative">
            <input
                type="checkbox"
                :value="value"
                v-model="proxyChecked"
                class="rounded border-gray-300 text-yellow-600 shadow-sm focus:ring-yellow-500 mr-2"
            />
        </div>

        <span v-if="label" class="label flex items-center font-semibold text-sm text-darkGray">
            {{ label }}
        </span>
    </label>
</template>
