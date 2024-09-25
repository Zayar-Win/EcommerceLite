<template>
    <div class="w-full h-[80vh] flex items-center justify-center ">
        <div class="w-[50%] rounded-lg bg-white shadow-lg flex flex-col items-center justify-center py-8" >
            <div class="w-[70px] h-[70px] rounded-full flex items-center justify-center bg-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-white " width="40" height="40" viewBox="0 0 24 24"><path fill="currentColor" d="m9.55 18l-5.7-5.7l1.425-1.425L9.55 15.15l9.175-9.175L20.15 7.4z"/></svg>
            </div>
            <h1 class="text-2xl mt-5 font-bold">Thanks For Your Order 🤩</h1>
            <p class="w-[70%] text-center mt-4">We will check your order and later we will contact you about that your order is confirmed or not.</p>
            <div class="flex items-center gap-4">
                <button @click="$inertia.get(route('home'))" class="text-white bg-primary rounded-full py-4 px-8  font-bold mt-6">Continue Shopping</button>
                <button
                    data-cy="go-to-settings-btn"
                    type="button"
                    @click="goToOrders"
                    class="text-white bg-primary rounded-full py-4 px-8  font-bold mt-6"
                >
                    Go To Orders ( {{ countdown }} )
                    <i class="fa-solid fa-arrow-right ml-1.5"></i>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import confetti from 'canvas-confetti';
import { router } from '@inertiajs/vue3';
export default {
    data(){
        return {
            countdown : 10,
            countdownInterval : null
        }
    },
    methods: {
        startCountdown(){
            this.countdownInterval = setInterval(() => {
                if (this.countdown > 0) {
                    this.countdown -= 1;
                } else {
                    this.goToOrders();
                }
            }, 1000);
        },
        goToOrders(){
            clearInterval(this.countdownInterval);
            router.get(route('settings.orders'));
        },
        triggerConfetti() {
        confetti({
            particleCount: 300, // Number of confetti particles
            spread: 100,         // Spread angle
            shapes : ['circle', '', 'square'],
            angle : 60,
            startVelocity : 30,
            origin: {
            x: 0.2, // Horizontal start point (0.5 = center)
            y: 0.6, // Vertical start point (0.5 = center)
            },
            colors: ['#ff69b4', '#ff4500', '#ffd700', '#87ceeb', '#32cd32'], // Custom confetti colors (red and white)
        });
        confetti({
            particleCount: 300, // Number of confetti particles
            spread: 100,         // Spread angle
            shapes : ['circle', '', 'square'],
            angle : 120,
            startVelocity : 30,
            origin: {
            x: 0.8, // Horizontal start point (0.5 = center)
            y: 0.6, // Vertical start point (0.5 = center)
            },
            colors: ['#ff69b4', '#ff4500', '#ffd700', '#87ceeb', '#32cd32'], // Custom confetti colors (red and white)
        });
        confetti({
            particleCount: 300, // Number of confetti particles
            spread: 100,         // Spread angle
            shapes : ['circle', '', 'square'],
            startVelocity : 30,
            origin: {
            x: 0.5, // Horizontal start point (0.5 = center)
            y: 0.3, // Vertical start point (0.5 = center)
            },
            colors: ['#ff69b4', '#ff4500', '#ffd700', '#87ceeb', '#32cd32'], // Custom confetti colors (red and white)
        });
        },
    },
    mounted(){
        this.startCountdown()
        this.triggerConfetti()
    }
}
</script>
<style lang="">
    
</style>