<template>
    <div
        ref="modal"
        class="modal z-[200] fixed inset-0 w-full flex justify-center transition-all duration-300 overflow-y-hidden px-5"
        :class="[open ? 'opacity-100' : 'invisible opacity-0']"
        :style="positionClasses"
    >
        <div
            class=" w-full h-full absolute backdrop-blur-sm"
            :class="[overlayBackground ? overlayBackground : 'bg-[rgba(0,0,0,0.5)]']"
            @click="closeModal"
        />
        <div
            ref="modalContent"
            :class="['modal-content w-full bg-white scroll py-3 px-2 md:px-10 rounded-md max-w-[500px] transition-all duration-300 z-50 text-white overflow-x-hidden overflow-y-auto border border-gray-300', contentClasses,
                     open ? 'translate-y-0' : 'invisible translate-y-40', position==='top' ? 'mt-28' : '' ]"
        >
            <slot />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        open: {
            type: Boolean,
            default: false,
        },
        isLoading:{
            type:Boolean,
            default:false
        },
        contentClasses: {
            type: String
        },
        overlayBackground: {
            type: String
        },
        position: {
            type: String
        },
        canCloseBackdrop:{
            type: Boolean,
            default:false
        }
    },
    computed: {
        positionClasses() {
            let pos = null;
            switch (this.position) {
            case 'top':
                pos = 'align-items: flex-start;';
                break;
            case 'bottom':
                pos = 'align-items: flex-end;';
                break;
            default:
                pos = 'align-items: center;';
                break;
            }

            return pos;
        }
    },
    watch:{
        '$page.url':function(){
            this.enableScroll();
        },
        open(){
            if(this.open){
                this.disableScroll();
            }else{
                this.enableScroll();
                this.$refs.modalContent.scrollTop = 0;
            }
        }
    },
    methods:{
        disableScroll(){
            document.body.style.overflow = 'hidden';
            document.querySelector('html').style.overflow = 'hidden';
            if(document.querySelector('.mainContent')) {
                document.querySelector('.mainContent').style.overflow = 'hidden';
            }
        },
        enableScroll(){
            document.body.style.overflow = '';
            document.querySelector('html').style.overflow = '';
            if(document.querySelector('.mainContent')) {
                document.querySelector('.mainContent').style.overflow = '';
            }
        },
        closeModal(){
            if(!this.isLoading&&this.canCloseBackdrop) {
                this.$emit('closeModal');
            }else{
                return;
            }
        }
    },
    mounted() {
        this.$refs.modal.style.height = 'calc(var(--vh, 1vh) * 100)';
        this.$refs.modalContent.style.maxHeight = 'calc(var(--vh, 1vh) * 90)';
    }
};
</script>

<style scoped>
.scroll::-webkit-scrollbar{
    display: none;
}
</style>
