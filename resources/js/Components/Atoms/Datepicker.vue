<script setup>
import { ref, watch,computed } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const props=defineProps({
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
    disabled: {
        type: Boolean,
        default: false,
    },
    required: {
        type: Boolean,
        default: false,
    },
    range: {
        type: Boolean,
        default: false,
    },
    multiCalendars: {
        type: Boolean,
        default: false,
    },
    monthPicker: {
        type: Boolean,
        default: false,
    },
    weekPicker: {
        type: Boolean,
        default: false,
    },
    yearPicker: {
        type: Boolean,
        default: false,
    },
    reverseYears: {
        type: Boolean,
        default: false,
    },
    class: {
        type: String,
        default: 'font-bold text-darkGray',
    },
    maxDate: {
        type : String,
    },
    yearRange: {
        type : Array,
        default:()=>[1930,new Date().getFullYear()]
    }
});


const emits = defineEmits(['update:modelValue']);

const selectedDate = ref(null);

const computedClasses=computed(()=>props.class);

watch(selectedDate,(newValue)=>{
    selectedDate.value = newValue;
    emits('update:modelValue', newValue);
});

</script>

<template>
    <!-- :max-date="maxDate" -->
    <VueDatePicker
        text-input
        v-bind="$attrs"
        v-model="selectedDate"
        :required="required"
        :enable-time-picker="false"
        :placeholder="placeholder"
        :class="computedClasses"
        :disabled="disabled"
        :range="range"
        :multi-calendars="multiCalendars"
        :month-picker="monthPicker"
        :year-picker="yearPicker"
        :week-picker="weekPicker"
        :reverse-years="reverseYears"
        :year-range="yearRange"
        class="disabled:cursor-not-allowed"
    />
</template>

<style>
:root {
  --dp-font-family: roboto;
  --dp-border-radius: 6px;
  --dp-input-padding: 13.5px;
  --dp-font-size: 0.875rem;
  --dp-preview-font-size: 0.8rem;
  --dp-time-font-size: 0.8rem;
}

.dp__theme_light {
  --dp-background-color: #f9fafb;
  --dp-text-color: rgb(31 41 55);
  --dp-border-color: rgb(209 213 219);
  --dp-menu-border-color: rgb(209 213 219);
}

.input-slot-image {
  width: auto;
  margin-left: 5px;
}
</style>
