<script setup>
import { computed, onMounted, ref, watch } from 'vue';
import { useClickOutside } from '@/Composables/useClickOutside';

const props = defineProps({
    selected: {
        type: [Object, Boolean, String, Number, null],
        default: null,
    },
    options: {
        type: Array,
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
        default: 'fa-globe',
    },
});

const emit = defineEmits(['update:modelValue', 'change']);

const search = ref('');
const selectedOption = ref(null);
const isDropdownOpen = ref(false);
const dropdownRef = ref(null);
const noResults = ref(false);

const searchResult = computed(() => {
    if (search.value === '') {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        noResults.value = false;
        return props.options;
    }

    const results = props.options.filter((option) => {
        return option.name.toLowerCase().includes(search.value.toLowerCase());
    });
    // eslint-disable-next-line vue/no-side-effects-in-computed-properties
    noResults.value = results.length === 0;
    return results;
});

const inputClasses = computed(() => ({
    'block w-full p-3.5 rounded-md font-semibold text-sm text-darkGray bg-gray-50 outline-none disabled:cursor-not-allowed transition-all focus:ring-2 focus:ring-slate-300 border border-gray-300 focus:border-slate-400': true,
    'pl-10': props.icon,
    [props.class]: !!props.class,
}));

const handleSelectInput = (event) => {
    const target = event.target;

    if (target && target.value !== undefined) {
        const isValidOption = props.options.some((option) => option.name === target.value);
        if (isValidOption) {
            emit('update:modelValue', target.value);
        } else {
            //   search.value = '';
            selectedOption.value = null;
        }
    }
};

const setSelectedOption = (option) => {
    search.value = option.name;
    selectedOption.value = option;
    isDropdownOpen.value = false;
    emit('update:modelValue', option.name);
    emit('change', option);
};

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

useClickOutside(dropdownRef, () => {
    isDropdownOpen.value = false;
});

onMounted(() => {
    if (props.selected) {
        const option = props.options.find(
            (opt) => opt.name === props.selected || opt.label === props.selected
        );
        if (option) {
            setSelectedOption(option);
        }
    }
});

watch(
    () => props.selected,
    (newSelected) => {
        if (newSelected) {
            const option = props.options.find(
                (opt) => opt.name === newSelected || opt.label === newSelected
            );
            if (option) {
                setSelectedOption(option);
            }
        } else {
            selectedOption.value = null;
            search.value = '';
        }
    }
);
</script>

<template>
    <div>
        <div class="relative">
            <input
                ref="dropdownRef"
                v-model="search"
                type="text"
                :id="name"
                :name="name"
                :class="inputClasses"
                :disabled="disabled"
                :required="required"
                @input="handleSelectInput"
                @click="toggleDropdown"
                :placeholder="placeholder"
                autocomplete="off"
            />
            <div class="absolute z-30 inset-y-0 left-0 flex items-center pl-3">
                <span v-if="selectedOption && search">
                    <img :src="selectedOption.flag" alt="flag-image" class="size-5 mr-2" />
                </span>
                <span v-else class="text-gray-600">
                    <i class="fa-solid" :class="[icon]"></i>
                </span>
            </div>
        </div>

        <ul
            v-if="isDropdownOpen"
            data-cy="search-result"
            class="absolute z-10 w-full block bg-white border border-gray-300 rounded-md shadow-lg mt-1 max-h-[200px] overflow-scroll"
        >
            <li v-if="noResults" class="p-2 text-gray-700 font-bold text-sm text-center">Your search value was not found.</li>
            <li
                v-for="(option, index) in searchResult"
                :key="index"
                @click="setSelectedOption(option)"
                class="cursor-pointer p-2 hover:bg-gray-100"
            >
                <span>
                    <img :src="option?.flag" alt="flag-image" class="size-5 inline-block mr-1.5" />
                    {{ option.name }}
                </span>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.size-5 {
  width: 20px;
  height: 20px;
}
</style>
