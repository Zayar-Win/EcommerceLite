<script setup>
import { computed } from 'vue';

const props = defineProps({
    selected: {
        type: [Object, Boolean, String, Number, null],
        default: () => {},
    },
    options: {
        type: Object,
        required: true,
    },
    id: {
        type: String,
        required: false,
    },
    name: {
        type: String,
        required: true,
    },

    placeholder: {
        type: String,
        default: 'Select an option',
        required: false,
    },

    class: {
        type: String,
        default: '',
    },

    disabled: {
        type: Boolean,
        default: false,
    },
    required: {
        type: Boolean,
        default: false,
    },

    modelValue: {
        type: String,
        required: true,
    },
    icon: {
        type: String,
        required: false,
    },
});

defineEmits(['update:modelValue']);

const optionKey = (index) => {
    return `select_option_${index}`;
};

const optionValue = (option) => {
    return option.id || option.value;
};

const isSelected = (option) => {
    return props.selected == optionValue(option);
};

const optionLabel = (option) => {
    return option.name || option.label;
};

const inputClasses = computed(() => ({
    'block w-full p-3.5 rounded-md font-semibold text-sm text-darkGray bg-gray-50 outline-none disabled:cursor-not-allowed transition-all focus:ring-2 focus:ring-slate-300 border border-gray-300 focus:border-slate-400': true,
    'pl-12': props.icon,
    [props.class]: !!props.class,
}));
</script>

<template>
    <div class="relative">
        <div
            class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-500"
        >
            <i class="fa-solid" :class="icon"></i>
        </div>

        <select
            :id="name"
            :name="name"
            :class="inputClasses"
            :disabled="disabled"
            :required="required"
            @change="$emit('update:modelValue', $event.target.value)"
        >
            <option
                value=""
                :selected="modelValue === '' || !modelValue || modelValue === null"
                disabled
            >
                {{ placeholder }}
            </option>
            <option
                v-for="(option, index) in options"
                :key="optionKey(index)"
                :value="optionValue(option)"
                :selected="isSelected(option)"
            >
                {{ optionLabel(option) }}
            </option>
        </select>
    </div>
</template>
