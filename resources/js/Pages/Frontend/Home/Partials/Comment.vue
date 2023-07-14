<template>
    <Carousel :items-to-show="3.5" :wrap-around="true">
        <Slide v-for="slide in 10" :key="slide">
            <div class="carousel__item">
                <div
                    class="bg-white mx-5 rounded-lg shadow-lg p-8 grid grid-cols-1 justify-center"
                >
                    <div class="flex justify-center">
                        <img
                            src="/img/profile.png"
                            alt="profile"
                            class="w-24"
                        />
                    </div>

                    <h1 class="font-bold mb-1">David Maulana</h1>
                    <p>
                        "Saya sangat senang sekali dengan adanya sistem ini saya
                        sangat terbantu dari segi pemesanan tiket"
                    </p>
                </div>
            </div>
        </Slide>

        <template #addons>
            <Navigation />
        </template>
    </Carousel>
</template>

<script>
import { defineComponent } from "vue";
import { Carousel, Navigation, Slide } from "vue3-carousel";

import "vue3-carousel/dist/carousel.css";

export default defineComponent({
    name: "WrapAround",
    components: {
        Carousel,
        Slide,
        Navigation,
    },
});
</script>
