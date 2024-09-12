<script setup>
import { onMounted, ref,computed } from 'vue';

const props = defineProps({
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
    rows: {
        type: Number,
        default: 6,
    },
    cols: {
        type: Number,
        default: 10,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    readOnly: {
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

const emit = defineEmits(['update:modelValue']);

const textarea = ref(null);

onMounted(() => {
    if (textarea.value && textarea.value.autofocus) textarea.value.focus();
});


const textareaClasses = computed(() => ({
    'block w-full p-3.5 rounded-md font-semibold text-sm text-darkGray bg-gray-50 outline-none transition-all disabled:cursor-not-allowed focus:ring-2 focus:ring-slate-300 border border-gray-300 focus:border-slate-400': true,
    'pl-12': props.icon,
    [props.class]: !!props.class,
}));

const handleTextarea = (event) => {
    const target = event.target;

    if (target && target.value !== undefined) emit('update:modelValue', target.value);
};
</script>

<template>
    <textarea
        ref="textarea"
        :id="id"
        :name="name"
        :rows="rows"
        :cols="cols"
        :value="modelValue"
        :readonly="readOnly"
        :disabled="disabled"
        :required="required"
        :maxlength="maxLength"
        :class="textareaClasses"
        :placeholder="placeholder"
        :autofocus="autofocus"
        @input="handleTextarea"
    ></textarea>
</template>


