<template>
    <div :class="`max-w-[450px] md:max-w-[1400px] mt-[30px] mx-auto bg-${color}-100 border border-${color}-400 text-${color}-700 px-4 py-3 rounded relative font-bold`" role="alert">
        <slot/>
    </div>
</template>

<script>
export default {
    props : {
        type : {
            type : String,
            default : 'success'
        }
    },
    computed : {
        color() {
            let color = null;
            switch (this.type) {
            case 'danger':
                color = 'red' ;
                break;
            case 'warning':
                color = 'yellow' ;
                break;
            case 'success':
                color = 'green' ;
                break;
            default:
                color = 'green' ;
                break;
            }
            return color;
        }
    }
};
</script>

<style>

</style>