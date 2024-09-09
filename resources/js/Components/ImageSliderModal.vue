<template>
    <Modal :show="true" maxWidth="2xl" containerClass="!bg-transparent !shadow-none">
        <div class="h-[80%] overflow-hidden">
            <swiper
            :style="{
                '--swiper-navigation-color': '#0285FF',
                '--swiper-pagination-color': '#fff',
                'height' : '100%'
            }"
            :loop="true"
            :spaceBetween="10"
            :navigation="true"
            :thumbs="{ swiper: thumbsSwiperValue }"
            :modules="[FreeMode, Navigation, Thumbs]"
            class="mySwiper2"
            >
            <swiper-slide
            v-for="image in images"
            :key="image"
                >
                <img :src="image" class="w-full h-full object-cover" />
            </swiper-slide>
            </swiper>
        </div>
        <div class="h-[20%] flex items-center">
            <div class="w-[80%] mx-auto">
                <swiper
                @swiper="setThumbsSwiper"
                :loop="true"
                :spaceBetween="10"
                :slidesPerView="4"
                :freeMode="true"
                :watchSlidesProgress="true"
                :modules="[FreeMode, Navigation, Thumbs]"
                class="mySwiper"
                >
                <swiper-slide
                v-for="image in images"
                :key="image"
                    >
                    <img 
                    :src="image" class="w-full h-full object-cover" />
                </swiper-slide>
                </swiper>
            </div>
        </div>
    </Modal>
  </template>
  <script>
    import { Swiper, SwiperSlide } from 'swiper/vue';
    import 'swiper/css';
    import 'swiper/css/free-mode';
    import 'swiper/css/navigation';
    import 'swiper/css/thumbs';
    import { FreeMode, Navigation, Thumbs } from 'swiper/modules';
    import Modal from './Modal.vue';
    export default {
        props:{
            images : {
                type : Array,
                default:[]
            }
        },
        components: {
            Swiper,
            SwiperSlide,
            Modal
        },
        data(){
            return {
                thumbsSwiper : null,
                FreeMode,
                Navigation,
                Thumbs
            }
        },
        computed:{
            thumbsSwiperValue(){
                return this.thumbsSwiper
            }
        },
        methods:{
            setThumbsSwiper(swiper) {
                this.thumbsSwiper = swiper
            }
        }
    };
  </script>
  