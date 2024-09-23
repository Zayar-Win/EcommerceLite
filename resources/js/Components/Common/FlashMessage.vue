<template>
    <div>
        
    </div>
</template>
<script>
import { router, usePage } from '@inertiajs/vue3';
import { createToaster } from "@meforma/vue-toaster";

export default {
    data(){
        return {
            finishEventListener :null
        }
    },  
    methods:{
        handleFlashMessage : () => {
            let flash = usePage().props.flash;
            let type;
            let message;
            if(flash.success || flash.warning || flash.error){
                if(flash.success){
                    type = 'success',
                    message = flash.success
                }
                
                if(flash.warning){
                    type = 'warning',
                    message = flash.warning
                }
                
                if(flash.error){
                    type = 'error',
                    message = flash.error
                }
                const toaster = createToaster({
                    position: 'bottom-right',
                    useDefaultCss: true,
                    maxToasts: 1,
                })
                console.log(toaster,type,message)
                toaster.clear()
                toaster[type](message)
            }
        }
    },
    mounted(){
        this.handleFlashMessage();
        this.finishEventListener = router.on('finish',function(){
            this.handleFlashMessage();
        }.bind(this))
    },
    beforeUnmount(){
        this.finishEventListener && this.finishEventListener()
    }
}
</script>
<style lang="">
    
</style>