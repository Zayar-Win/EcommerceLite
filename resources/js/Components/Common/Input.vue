<template lang="">
    <div class="flex flex-col">
        <label class="font-semibold text-sm">{{label}}</label>
        <input class="outline-none focus:ring-0 border-[1px] border-black/10 py-4 rounded-lg focus:border-primary transition-all mt-2" :type='type' :placeholder="placeHolder" />
    </div>
</template>
<script>
export default {
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
        }
    }
}
</script>
<style lang="">
    
</style>