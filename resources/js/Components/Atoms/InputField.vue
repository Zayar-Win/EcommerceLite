<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    id: {
        type: String,
        required: false,
    },
    name: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: 'text',
        validator: (value) => ['text', 'password', 'number', 'email'].includes(value),
    },
    placeholder: {
        type: String,
        required: false,
    },
    class: {
        type: String,
        default: '',
    },
    autofocus: {
        type: Boolean,
        default: false,
    },
    autocomplete: {
        type: String,
        default: 'off',
        validator: (value) => ['on', 'off'].includes(value),
    },
    readOnly: {
        type: Boolean,
        default: false,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    required: {
        type: Boolean,
        default: false,
    },
    maxLength: {
        type: String,
        required: false,
    },
    minLength: {
        type: String,
        required: false,
    },
    pattern: {
        type: String,
        required: false,
    },
    defaultValue: {
        type: String,
        required: false,
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

const emit = defineEmits(['update:modelValue']);

const input = ref(null);

// onMounted(() => {
//     if (input.value && input.value.autofocus) input.value.focus();
// });

const inputClasses = computed(() => ({
    'block w-full p-3.5 rounded-md font-semibold text-sm text-darkGray bg-gray-50 outline-none disabled:cursor-not-allowed transition-all focus:ring-2 focus:ring-slate-300 border border-gray-300 focus:border-slate-400': true,
    'pl-12': props.icon,
    [props.class]: !!props.class,
}));

const handleInput = (event) => {
    const target = event.target;

    if (target && target.value !== undefined) emit('update:modelValue', target.value);
};
</script>

<template>
    <input
        ref="input"
        :id="id"
        :name="name"
        :type="type"
        :placeholder="placeholder"
        :class="inputClasses"
        :value="modelValue"
        :readonly="readOnly"
        :disabled="disabled"
        :required="required"
        :pattern="pattern"
        :maxlength="maxLength"
        :minlength="minLength"
        :defaultValue="defaultValue"
        :autofocus="autofocus"
        :autocomplete="autocomplete"
        @input="handleInput"
    />
</template>
