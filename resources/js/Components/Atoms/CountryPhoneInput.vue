<script setup>
import intlTelInput from 'intl-tel-input';
import 'intl-tel-input/build/css/intlTelInput.css';
import { onMounted, ref, computed,watchEffect } from 'vue';

const props = defineProps({
    name: {
        type: String,
        required: false,
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
    disabled: {
        type: Boolean,
        default: false,
    },
    required: {
        type: Boolean,
        default: false,
    },
    defaultValue: {
        type: String,
        required: false,
    },
    modelValue: {
        type: String,
        required: true,
    },
    syncCountryISO: {
        type: String,
    },
});
const emit = defineEmits(['update:modelValue', 'update:dialCode']);

const iti = ref(null);
const countryPhoneInput = ref(null);

const isoCode=computed(()=>props.syncCountryISO?.toLowerCase());

onMounted(() => {
    const input = countryPhoneInput.value;
    iti.value = intlTelInput(input, {
        utilsScript: '/node_modules/intl-tel-input/build/js/utils.js',
        containerClass: 'w-full',
        initialCountry: isoCode.value,
        nationalMode: true,
        separateDialCode: true,
        strictMode: true,
        geoIpLookup: function (success, failure) {
            fetch('https://ipapi.co/json')
                .then(function (res) {
                    return res.json();
                })
                .then(function (data) {
                    success(data.country_code);
                })
                .catch(function () {
                    failure();
                });
        },
    });

    input.addEventListener('countrychange', () => {
        const dialCode = iti.value.getSelectedCountryData().dialCode;
        localStorage.setItem('isoCode', iti.value.getSelectedCountryData().iso2);
        emit('update:dialCode', dialCode);
    });

    if (input && props.autofocus) {
        input.focus();
    }
});

const inputClasses = computed(() => ({
    'block w-full p-3.5 rounded-md font-semibold text-sm text-darkGray bg-gray-50 outline-none disabled:cursor-not-allowed transition-all focus:ring-2 focus:ring-slate-300 border border-gray-300 focus:border-slate-400': true,
    [props.class]: !!props.class,
}));

const handleInput = (event) => {
    const target = event.target;

    if (target && target.value !== undefined) {
        emit('update:modelValue', target.value);

        if (iti.value) {
            const dialCode = iti.value.getSelectedCountryData().dialCode;
            localStorage.setItem('isoCode',iti.value.getSelectedCountryData().iso2);
            emit('update:dialCode', dialCode);
        }
    }
};
watchEffect(()=>{
    if(props.syncCountryISO&&iti.value){
        iti.value?.setCountry(props.syncCountryISO.toLowerCase());
    }
});
</script>

<template>
    <div>
        <input
            ref="countryPhoneInput"
            id="phone"
            type="tel"
            :name="name"
            :placeholder="placeholder"
            :class="inputClasses"
            :value="modelValue"
            :disabled="disabled"
            :required="required"
            :defaultValue="defaultValue"
            :autofocus="autofocus"
            @input="handleInput"
        />
    </div>
</template>

<style>
.iti {
  --iti-path-flags-1x: url("/node_modules/intl-tel-input/build/img/flags.png");
  --iti-path-flags-2x: url("/node_modules/intl-tel-input/build/img/flags@2x.png");
  --iti-path-globe-1x: url("/node_modules/intl-tel-input/build/img/globe.png");
  --iti-path-globe-2x: url("/node_modules/intl-tel-input/build/img/globe@2x.png");
}
</style>
