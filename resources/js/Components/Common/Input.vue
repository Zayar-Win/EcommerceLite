<template lang="">
    <div class="flex flex-col">
        <label class="font-semibold text-sm">{{label}}</label>
        <input @input="handleInput" class="outline-none focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2" :type='type' :placeholder="placeHolder" />
        <ValidationError :message="errorMessage" />
    </div>
</template>
<script>
import ValidationError from "@/Components/Atoms/ValidationError.vue";

export default {
    components:{
        ValidationError
    },
    props:{
        label :{
            type : String
        },
        type : {
            type : String,
            default : 'text'
        },
        placeHolder:{
            type : String,
        },
        errorMessage : {
            type : String
        },
        modelValue : {
            type : String,
            required : true
        }
    },
    methods:{
         handleInput(event) {
        const target = event.target;
        if (target && target.value !== undefined) this.$emit('update:modelValue', target.value);
    }
}
}
</script>
<style lang="">
    
</style>